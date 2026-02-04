<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Webhook;

/**
 * CheckoutController
 * 
 * Handles the checkout process including COD and Stripe payments.
 * Supports guest checkout - no authentication required.
 */
class CheckoutController extends Controller
{
    /**
     * The cart service instance.
     */
    protected CartService $cartService;

    /**
     * Create a new controller instance.
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display the checkout page.
     */
    public function index()
    {
        if ($this->cartService->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty. Please add some products before checkout.');
        }

        // Validate cart items
        $messages = $this->cartService->validateAndSync();

        if ($this->cartService->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'All items in your cart are no longer available.');
        }

        $items = $this->cartService->getItemsWithProducts();

        return view('checkout.index', [
            'items' => $items,
            'subtotal' => $this->cartService->subtotal(),
            'tax' => $this->cartService->tax(),
            'total' => $this->cartService->total(),
            'taxRate' => config('cafe.tax_rate', 0),
            'messages' => $messages,
            'stripeEnabled' => config('cafe.stripe.enabled') && !empty(config('cafe.stripe.key')),
            'stripeKey' => config('cafe.stripe.key'),
        ]);
    }

    /**
     * Process the checkout (COD or Stripe).
     */
    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:1000',
            'notes' => 'nullable|string|max:500',
            'payment_method' => 'required|in:cod,stripe',
        ]);

        if ($this->cartService->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        // Validate cart items one more time
        $this->cartService->validateAndSync();

        if ($this->cartService->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'All items in your cart are no longer available.');
        }

        // Handle Stripe payment
        if ($request->payment_method === 'stripe') {
            return $this->createStripeSession($request);
        }

        // Handle COD payment
        return $this->processOrder($request);
    }

    /**
     * Process the order (COD).
     */
    protected function processOrder(Request $request, ?string $stripePaymentId = null)
    {
        try {
            DB::beginTransaction();

            // Create the order
            $order = Order::create([
                'user_id' => auth()->id(),
                'customer_name' => $request->name,
                'customer_email' => $request->email,
                'customer_phone' => $request->phone,
                'shipping_address' => $request->address,
                'notes' => $request->notes,
                'subtotal' => $this->cartService->subtotal(),
                'tax' => $this->cartService->tax(),
                'total' => $this->cartService->total(),
                'payment_method' => $request->payment_method ?? 'cod',
                'payment_status' => $stripePaymentId ? Order::PAYMENT_PAID : Order::PAYMENT_PENDING,
                'stripe_payment_id' => $stripePaymentId,
                'status' => Order::STATUS_PENDING,
            ]);

            // Create order items
            foreach ($this->cartService->getItems() as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'total' => $item['price'] * $item['quantity'],
                ]);

                // Reduce stock if applicable
                $product = \App\Models\Product::find($item['product_id']);
                if ($product && $product->stock !== null) {
                    $product->decrement('stock', $item['quantity']);
                }
            }

            // Create initial status history
            $order->statusHistory()->create([
                'user_id' => null,
                'old_status' => null,
                'new_status' => Order::STATUS_PENDING,
                'notes' => 'Order placed',
            ]);

            DB::commit();

            // Clear the cart
            $this->cartService->clear();

            // Send order confirmation email (using log driver for demo)
            $this->sendOrderConfirmationEmail($order);

            return redirect()->route('checkout.success', $order->order_number)
                ->with('success', 'Your order has been placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order creation failed: ' . $e->getMessage());

            return back()->with('error', 'An error occurred while processing your order. Please try again.');
        }
    }

    /**
     * Create a Stripe Checkout Session.
     */
    protected function createStripeSession(Request $request)
    {
        if (!config('cafe.stripe.enabled') || empty(config('cafe.stripe.secret'))) {
            return back()->with('error', 'Stripe payments are not configured.');
        }

        Stripe::setApiKey(config('cafe.stripe.secret'));

        $lineItems = [];
        foreach ($this->cartService->getItems() as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => strtolower(config('cafe.currency.code', 'usd')),
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount' => (int) ($item['price'] * 100), // Stripe uses cents
                ],
                'quantity' => $item['quantity'],
            ];
        }

        // Add tax as a line item if applicable
        $tax = $this->cartService->tax();
        if ($tax > 0) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => strtolower(config('cafe.currency.code', 'usd')),
                    'product_data' => [
                        'name' => 'Tax',
                    ],
                    'unit_amount' => (int) ($tax * 100),
                ],
                'quantity' => 1,
            ];
        }

        try {
            // Store checkout data in session for later retrieval
            session([
                'checkout_data' => [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'notes' => $request->notes,
                    'payment_method' => 'stripe',
                ],
            ]);

            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('checkout.stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout.index'),
                'customer_email' => $request->email,
                'metadata' => [
                    'customer_name' => $request->name,
                    'customer_phone' => $request->phone,
                ],
            ]);

            return redirect($session->url);

        } catch (\Exception $e) {
            Log::error('Stripe session creation failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to initialize payment. Please try again.');
        }
    }

    /**
     * Handle Stripe success callback.
     */
    public function stripeSuccess(Request $request)
    {
        if (!$request->has('session_id')) {
            return redirect()->route('checkout.index')
                ->with('error', 'Invalid payment session.');
        }

        Stripe::setApiKey(config('cafe.stripe.secret'));

        try {
            $session = StripeSession::retrieve($request->session_id);

            if ($session->payment_status !== 'paid') {
                return redirect()->route('checkout.index')
                    ->with('error', 'Payment was not completed.');
            }

            // Retrieve checkout data from session
            $checkoutData = session('checkout_data');
            if (!$checkoutData) {
                return redirect()->route('cart.index')
                    ->with('error', 'Session expired. Please try again.');
            }

            // Create a request with the stored checkout data
            $fakeRequest = new Request($checkoutData);

            // Clear the checkout session data
            session()->forget('checkout_data');

            return $this->processOrder($fakeRequest, $session->payment_intent);

        } catch (\Exception $e) {
            Log::error('Stripe success handling failed: ' . $e->getMessage());
            return redirect()->route('checkout.index')
                ->with('error', 'Failed to verify payment. Please contact support.');
        }
    }

    /**
     * Handle Stripe webhook events.
     */
    public function stripeWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $webhookSecret = config('cafe.stripe.webhook_secret');

        if (empty($webhookSecret)) {
            Log::warning('Stripe webhook secret not configured');
            return response()->json(['error' => 'Webhook not configured'], 400);
        }

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $webhookSecret);
        } catch (\Exception $e) {
            Log::error('Stripe webhook signature verification failed: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Handle specific events
        switch ($event->type) {
            case 'checkout.session.completed':
                // Payment was successful
                Log::info('Stripe payment completed', ['session_id' => $event->data->object->id]);
                break;

            case 'payment_intent.payment_failed':
                // Payment failed
                Log::warning('Stripe payment failed', ['intent_id' => $event->data->object->id]);
                break;

            default:
                Log::info('Unhandled Stripe webhook event', ['type' => $event->type]);
        }

        return response()->json(['received' => true]);
    }

    /**
     * Display the order success page.
     */
    public function success(string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->with(['items.product.images'])
            ->firstOrFail();

        return view('checkout.success', compact('order'));
    }

    /**
     * Display the order confirmation page.
     */
    public function confirmation(Order $order)
    {
        $order->load(['items.product.primaryImage']);

        return view('checkout.confirmation', compact('order'));
    }

    /**
     * Simulate a successful payment (for demo purposes).
     */
    public function simulatePayment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:1000',
            'notes' => 'nullable|string|max:500',
        ]);

        // Set payment method to stripe for the simulated payment
        $request->merge(['payment_method' => 'stripe']);

        return $this->processOrder($request, 'simulated_' . uniqid());
    }

    /**
     * Send order confirmation email.
     * Uses log mail driver for demo purposes.
     */
    protected function sendOrderConfirmationEmail(Order $order): void
    {
        try {
            // Log the email instead of sending (using log mail driver)
            Log::info('Order Confirmation Email', [
                'to' => $order->customer_email,
                'order_number' => $order->order_number,
                'total' => $order->total,
                'items_count' => $order->items->count(),
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send order confirmation email: ' . $e->getMessage());
        }
    }
}

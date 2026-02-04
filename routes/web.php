<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Storefront)
|--------------------------------------------------------------------------
*/

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Shop
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{product:slug}', [ShopController::class, 'show'])->name('shop.show');

// Static pages
Route::get('/about', [PageController::class, 'about'])->name('pages.about');
Route::get('/faqs', [PageController::class, 'faqs'])->name('pages.faqs');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('pages.contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Cart
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::patch('/update', [CartController::class, 'update'])->name('update');
    Route::delete('/remove', [CartController::class, 'remove'])->name('remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('clear');
    Route::get('/data', [CartController::class, 'data'])->name('data');
});

// Checkout
Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/process', [CheckoutController::class, 'process'])->name('process');
    Route::get('/success/{orderNumber}', [CheckoutController::class, 'success'])->name('success');
    Route::get('/confirmation/{order}', [CheckoutController::class, 'confirmation'])->name('confirmation');
    Route::post('/simulate-payment', [CheckoutController::class, 'simulatePayment'])->name('simulate');
    Route::get('/stripe/success', [CheckoutController::class, 'stripeSuccess'])->name('stripe.success');
});

// Stripe Webhook (no CSRF)
Route::post('/stripe/webhook', [CheckoutController::class, 'stripeWebhook'])
    ->name('stripe.webhook')
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

// Sitemap
Route::get('/sitemap.xml', function () {
    $products = \App\Models\Product::active()->get(['slug', 'updated_at']);
    $categories = \App\Models\Category::active()->get(['slug', 'updated_at']);

    return response()->view('sitemap', compact('products', 'categories'))
        ->header('Content-Type', 'application/xml');
})->name('sitemap');

/*
|--------------------------------------------------------------------------
| Auth Routes (Laravel Breeze)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Customer Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', \App\Http\Middleware\EnsureUserIsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Categories
        Route::resource('categories', AdminCategoryController::class)->except(['show']);

        // Products
        Route::resource('products', AdminProductController::class);
        Route::delete('products/{product}/images/{image}', [AdminProductController::class, 'deleteImage'])
            ->name('products.images.delete');
        Route::post('products/{product}/images/{image}/primary', [AdminProductController::class, 'setPrimaryImage'])
            ->name('products.images.primary');

        // Orders
        Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('orders/statistics', [AdminOrderController::class, 'statistics'])->name('orders.statistics');
        Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');

        // Contacts
        Route::get('contacts', [AdminContactController::class, 'index'])->name('contacts.index');
        Route::get('contacts/{contact}', [AdminContactController::class, 'show'])->name('contacts.show');
        Route::delete('contacts/{contact}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');
        Route::post('contacts/{contact}/read', [AdminContactController::class, 'markAsRead'])->name('contacts.read');
    });

require __DIR__ . '/auth.php';

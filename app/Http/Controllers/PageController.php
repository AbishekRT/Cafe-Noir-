<?php

namespace App\Http\Controllers;

/**
 * PageController
 * 
 * Handles static pages like About Us and FAQs.
 */
class PageController extends Controller
{
    /**
     * Display the About Us page.
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Display the FAQs page.
     */
    public function faqs()
    {
        $faqs = [
            [
                'question' => 'What types of coffee do you offer?',
                'answer' => 'We offer a wide variety of premium coffee including single-origin beans, blends, espresso roasts, and specialty selections from around the world. Our collection includes light, medium, and dark roasts to suit every preference.',
            ],
            [
                'question' => 'How is your coffee roasted?',
                'answer' => 'All our coffee is freshly roasted in small batches to ensure maximum flavor and freshness. We use traditional roasting methods combined with modern precision to bring out the unique characteristics of each bean.',
            ],
            [
                'question' => 'What is your shipping policy?',
                'answer' => 'We offer free shipping on orders over $50. Standard shipping typically takes 3-5 business days. Expedited shipping options are also available at checkout.',
            ],
            [
                'question' => 'How should I store my coffee?',
                'answer' => 'For optimal freshness, store your coffee in an airtight container in a cool, dark place. Avoid storing coffee in the refrigerator or freezer, as moisture can affect the flavor.',
            ],
            [
                'question' => 'Do you offer subscription services?',
                'answer' => 'Yes! We offer flexible coffee subscriptions that deliver fresh coffee to your door weekly, bi-weekly, or monthly. You can customize your subscription based on your preferred roast and quantity.',
            ],
            [
                'question' => 'What is your return policy?',
                'answer' => 'We want you to be completely satisfied with your purchase. If you\'re not happy with your coffee, please contact us within 14 days of delivery and we\'ll make it right.',
            ],
            [
                'question' => 'Are your products organic?',
                'answer' => 'We offer both organic and conventional coffee options. Our organic selections are certified and clearly labeled on the product page.',
            ],
            [
                'question' => 'How can I contact customer support?',
                'answer' => 'You can reach our customer support team via email, phone, or through the contact form on our website. We typically respond within 24 hours on business days.',
            ],
        ];

        return view('pages.faqs', compact('faqs'));
    }
}

{{--
Contact Us Page
Features: Contact form, Contact info, Map placeholder, Business hours
--}}
<x-app-layout>
    <x-slot name="title">Contact Us - {{ config('cafe.name') }}</x-slot>
    <x-slot name="metaDescription">Get in touch with {{ config('cafe.name') }}. We're here to help with orders,
        questions, or just to chat about coffee.</x-slot>

    <!-- Hero Section -->
    <section class="relative bg-primary py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-heading font-bold text-secondary mb-4">Get In Touch</h1>
            <p class="text-xl text-secondary/80 max-w-2xl mx-auto">
                Have a question or feedback? We'd love to hear from you.
            </p>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div>
                    <h2 class="text-2xl font-heading font-bold text-heading mb-6">Send Us a Message</h2>

                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-800 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-heading mb-2">
                                    Your Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                    class="w-full px-4 py-3 border border-primary/20 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent transition-colors @error('name') border-red-500 @enderror"
                                    placeholder="John Doe">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-heading mb-2">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                    class="w-full px-4 py-3 border border-primary/20 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent transition-colors @error('email') border-red-500 @enderror"
                                    placeholder="john@example.com">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-heading mb-2">
                                Phone Number <span class="text-muted">(Optional)</span>
                            </label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                class="w-full px-4 py-3 border border-primary/20 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent transition-colors @error('phone') border-red-500 @enderror"
                                placeholder="+1 (555) 000-0000">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subject -->
                        <div>
                            <label for="subject" class="block text-sm font-medium text-heading mb-2">
                                Subject <span class="text-red-500">*</span>
                            </label>
                            <select id="subject" name="subject" required
                                class="w-full px-4 py-3 border border-primary/20 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent transition-colors @error('subject') border-red-500 @enderror">
                                <option value="">Select a subject</option>
                                <option value="general" {{ old('subject') == 'general' ? 'selected' : '' }}>General
                                    Inquiry</option>
                                <option value="order" {{ old('subject') == 'order' ? 'selected' : '' }}>Order Question
                                </option>
                                <option value="product" {{ old('subject') == 'product' ? 'selected' : '' }}>Product
                                    Information</option>
                                <option value="wholesale" {{ old('subject') == 'wholesale' ? 'selected' : '' }}>Wholesale
                                    Inquiry</option>
                                <option value="feedback" {{ old('subject') == 'feedback' ? 'selected' : '' }}>Feedback
                                </option>
                                <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('subject')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-sm font-medium text-heading mb-2">
                                Message <span class="text-red-500">*</span>
                            </label>
                            <textarea id="message" name="message" rows="5" required
                                class="w-full px-4 py-3 border border-primary/20 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent transition-colors resize-none @error('message') border-red-500 @enderror"
                                placeholder="How can we help you?">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <x-button type="submit" class="w-full md:w-auto">
                                Send Message
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                            </x-button>
                        </div>
                    </form>
                </div>

                <!-- Contact Info -->
                <div>
                    <h2 class="text-2xl font-heading font-bold text-heading mb-6">Contact Information</h2>

                    <div class="space-y-6">
                        <!-- Address -->
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-heading">Our Location</h3>
                                <p class="text-body mt-1">
                                    123 Coffee Lane, Suite 100<br>
                                    Seattle, WA 98101<br>
                                    United States
                                </p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-heading">Phone</h3>
                                <p class="text-body mt-1">
                                    <a href="tel:{{ config('cafe.contact.phone') }}"
                                        class="hover:text-accent transition-colors">
                                        {{ config('cafe.contact.phone') }}
                                    </a>
                                </p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-heading">Email</h3>
                                <p class="text-body mt-1">
                                    <a href="mailto:{{ config('cafe.contact.email') }}"
                                        class="hover:text-accent transition-colors">
                                        {{ config('cafe.contact.email') }}
                                    </a>
                                </p>
                            </div>
                        </div>

                        <!-- WhatsApp -->
                        <div class="flex items-start space-x-4">
                            <div
                                class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-heading">WhatsApp</h3>
                                <p class="text-body mt-1">
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', config('cafe.contact.whatsapp')) }}"
                                        target="_blank" rel="noopener" class="hover:text-accent transition-colors">
                                        {{ config('cafe.contact.whatsapp') }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Business Hours -->
                    <div class="mt-10 p-6 bg-secondary rounded-lg">
                        <h3 class="font-heading font-semibold text-heading mb-4">Business Hours</h3>
                        <div class="space-y-2 text-body">
                            <div class="flex justify-between">
                                <span>Monday - Friday</span>
                                <span class="font-medium">8:00 AM - 6:00 PM</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Saturday</span>
                                <span class="font-medium">9:00 AM - 5:00 PM</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Sunday</span>
                                <span class="font-medium">Closed</span>
                            </div>
                        </div>
                        <p class="mt-4 text-sm text-muted">
                            * Online orders are processed 24/7
                        </p>
                    </div>

                    <!-- Social Links -->
                    <div class="mt-8">
                        <h3 class="font-heading font-semibold text-heading mb-4">Follow Us</h3>
                        <div class="flex space-x-4">
                            @if(config('cafe.social.facebook'))
                                <a href="{{ config('cafe.social.facebook') }}" target="_blank" rel="noopener"
                                    class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-secondary hover:bg-accent hover:text-primary transition-colors"
                                    aria-label="Facebook">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z">
                                        </path>
                                    </svg>
                                </a>
                            @endif
                            @if(config('cafe.social.instagram'))
                                <a href="{{ config('cafe.social.instagram') }}" target="_blank" rel="noopener"
                                    class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-secondary hover:bg-accent hover:text-primary transition-colors"
                                    aria-label="Instagram">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z">
                                        </path>
                                    </svg>
                                </a>
                            @endif
                            @if(config('cafe.social.twitter'))
                                <a href="{{ config('cafe.social.twitter') }}" target="_blank" rel="noopener"
                                    class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-secondary hover:bg-accent hover:text-primary transition-colors"
                                    aria-label="Twitter">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z">
                                        </path>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section (Placeholder) -->
    <section class="bg-secondary">
        <div class="container mx-auto px-4 py-8">
            <div class="bg-primary/10 rounded-lg h-64 flex items-center justify-center">
                <div class="text-center">
                    <svg class="w-16 h-16 text-primary/40 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <p class="text-muted">Map integration available with Google Maps API key</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>

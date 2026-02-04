{{-- 
    Admin Contact Message Detail
--}}
<x-app-layout>
    <x-slot name="title">Message from {{ $contact->name }} - Admin - {{ config('cafe.name') }}</x-slot>

    <div class="min-h-screen bg-gray-100">
        <!-- Admin Header -->
        <div class="bg-primary shadow">
            <div class="container mx-auto px-4 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <nav class="text-secondary/60 text-sm mb-1">
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-secondary">Dashboard</a>
                            <span class="mx-2">/</span>
                            <a href="{{ route('admin.contacts.index') }}" class="hover:text-secondary">Contact Messages</a>
                            <span class="mx-2">/</span>
                            <span class="text-secondary">View</span>
                        </nav>
                        <h1 class="text-2xl font-heading font-bold text-secondary">Message from {{ $contact->name }}</h1>
                    </div>
                    <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center px-4 py-2 bg-secondary/20 text-secondary text-sm font-medium rounded-lg hover:bg-secondary/30 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Messages
                    </a>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            <div class="max-w-3xl mx-auto">
                <!-- Message Card -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <!-- Header -->
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center">
                                <span class="text-secondary font-semibold text-lg">{{ substr($contact->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <h2 class="font-medium text-heading">{{ $contact->name }}</h2>
                                <p class="text-sm text-muted">{{ $contact->email }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            @if($contact->status === 'unread')
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Unread</span>
                            @elseif($contact->status === 'read')
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Read</span>
                            @else
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Replied</span>
                            @endif
                            <p class="text-sm text-muted mt-1">{{ $contact->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="p-6">
                        <div class="mb-4">
                            <span class="text-sm text-muted">Subject:</span>
                            <span class="ml-2 px-2 py-1 bg-gray-100 text-heading text-sm font-medium rounded capitalize">{{ $contact->subject }}</span>
                        </div>
                        
                        @if($contact->phone)
                        <div class="mb-4">
                            <span class="text-sm text-muted">Phone:</span>
                            <a href="tel:{{ $contact->phone }}" class="ml-2 text-accent hover:underline">{{ $contact->phone }}</a>
                        </div>
                        @endif
                        
                        <div class="border-t border-gray-200 pt-4">
                            <h3 class="text-sm text-muted mb-2">Message:</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-body whitespace-pre-wrap">{{ $contact->message }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Actions -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                        <div class="flex flex-wrap gap-3">
                            <a href="mailto:{{ $contact->email }}?subject=Re: {{ ucfirst($contact->subject) }}" class="inline-flex items-center px-4 py-2 bg-accent text-primary font-medium rounded-lg hover:bg-accent/90 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Reply via Email
                            </a>
                            
                            @if($contact->phone)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->phone) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-500 text-white font-medium rounded-lg hover:bg-green-600 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"></path>
                                </svg>
                                WhatsApp
                            </a>
                            @endif
                            
                            @if($contact->status !== 'replied')
                                <form action="{{ route('admin.contacts.mark-replied', $contact) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary text-secondary font-medium rounded-lg hover:bg-primary/90 transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Mark as Replied
                                    </button>
                                </form>
                            @endif
                            
                            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this message?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-100 text-red-700 font-medium rounded-lg hover:bg-red-200 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

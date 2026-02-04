{{--
Admin Contact Messages List
--}}
<x-app-layout>
    <x-slot name="title">Contact Messages - Admin - {{ config('cafe.name') }}</x-slot>

    <div class="min-h-screen bg-gray-100">
        <!-- Admin Header -->
        <div class="bg-primary shadow">
            <div class="container mx-auto px-4 py-6">
                <nav class="text-secondary/60 text-sm mb-1">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-secondary">Dashboard</a>
                    <span class="mx-2">/</span>
                    <span class="text-secondary">Contact Messages</span>
                </nav>
                <h1 class="text-2xl font-heading font-bold text-secondary">Contact Messages</h1>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            <!-- Filters -->
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.contacts.index') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ !request('status') ? 'bg-primary text-secondary' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        All Messages
                    </a>
                    <a href="{{ route('admin.contacts.index', ['status' => 'unread']) }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request('status') === 'unread' ? 'bg-red-500 text-white' : 'bg-red-100 text-red-800 hover:bg-red-200' }}">
                        Unread
                    </a>
                    <a href="{{ route('admin.contacts.index', ['status' => 'read']) }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request('status') === 'read' ? 'bg-blue-500 text-white' : 'bg-blue-100 text-blue-800 hover:bg-blue-200' }}">
                        Read
                    </a>
                    <a href="{{ route('admin.contacts.index', ['status' => 'replied']) }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request('status') === 'replied' ? 'bg-green-500 text-white' : 'bg-green-100 text-green-800 hover:bg-green-200' }}">
                        Replied
                    </a>
                </div>
            </div>

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Messages Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-muted uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-muted uppercase tracking-wider">
                                    From</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-muted uppercase tracking-wider">
                                    Subject</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-muted uppercase tracking-wider">
                                    Message</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-muted uppercase tracking-wider">
                                    Date</th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-muted uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($contacts as $contact)
                                <tr class="hover:bg-gray-50 {{ $contact->status === 'unread' ? 'bg-red-50' : '' }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($contact->status === 'unread')
                                            <span
                                                class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Unread</span>
                                        @elseif($contact->status === 'read')
                                            <span
                                                class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Read</span>
                                        @else
                                            <span
                                                class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Replied</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-heading">{{ $contact->name }}</div>
                                        <div class="text-sm text-muted">{{ $contact->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-body capitalize">
                                        {{ $contact->subject }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm text-body line-clamp-2 max-w-xs">{{ $contact->message }}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-muted">
                                        {{ $contact->created_at->format('M d, Y') }}
                                        <div class="text-xs">{{ $contact->created_at->format('h:i A') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('admin.contacts.show', $contact) }}"
                                                class="text-accent hover:text-accent/80 font-medium text-sm">
                                                View
                                            </a>
                                            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Are you sure you want to delete this message?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-700 font-medium text-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <p class="text-muted">No messages found.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($contacts->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $contacts->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

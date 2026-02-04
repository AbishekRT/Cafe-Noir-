{{-- 
    Admin Create Category
--}}
<x-app-layout>
    <x-slot name="title">Add Category - Admin - {{ config('cafe.name') }}</x-slot>

    <div class="min-h-screen bg-gray-100">
        <!-- Admin Header -->
        <div class="bg-primary shadow">
            <div class="container mx-auto px-4 py-6">
                <nav class="text-secondary/60 text-sm mb-1">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-secondary">Dashboard</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('admin.categories.index') }}" class="hover:text-secondary">Categories</a>
                    <span class="mx-2">/</span>
                    <span class="text-secondary">Add Category</span>
                </nav>
                <h1 class="text-2xl font-heading font-bold text-secondary">Add New Category</h1>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            <div class="max-w-2xl mx-auto">
                <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 space-y-6">
                    @csrf
                    
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-heading mb-2">
                            Category Name <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent @error('name') border-red-500 @enderror"
                            placeholder="Enter category name"
                        >
                        @error('name')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Slug -->
                    <div>
                        <label for="slug" class="block text-sm font-medium text-heading mb-2">
                            URL Slug
                        </label>
                        <input 
                            type="text" 
                            id="slug" 
                            name="slug" 
                            value="{{ old('slug') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent @error('slug') border-red-500 @enderror"
                            placeholder="auto-generated-from-name"
                        >
                        <p class="mt-1 text-xs text-muted">Leave empty to auto-generate from name</p>
                        @error('slug')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-heading mb-2">
                            Description
                        </label>
                        <textarea 
                            id="description" 
                            name="description" 
                            rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent resize-none @error('description') border-red-500 @enderror"
                            placeholder="Brief description of the category"
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Image -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-heading mb-2">
                            Category Image
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-accent transition-colors">
                            <input 
                                type="file" 
                                id="image" 
                                name="image" 
                                accept="image/*"
                                class="hidden"
                            >
                            <label for="image" class="cursor-pointer">
                                <svg class="w-10 h-10 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-heading font-medium">Click to upload image</p>
                                <p class="text-sm text-muted mt-1">PNG, JPG, GIF up to 2MB</p>
                            </label>
                        </div>
                        @error('image')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Status -->
                    <div>
                        <label class="flex items-center">
                            <input 
                                type="checkbox" 
                                name="is_active" 
                                value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}
                                class="w-4 h-4 text-accent border-gray-300 rounded focus:ring-accent"
                            >
                            <span class="ml-2 text-sm text-heading">Active (visible in store)</span>
                        </label>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                        <a href="{{ route('admin.categories.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-300 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-3 bg-accent text-primary font-medium rounded-lg hover:bg-accent/90 transition-colors">
                            Create Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($book) ? __('Edit Book') : __('Add Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ isset($book) ? route('books.update', $book) : route('books.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($book))
                            @method('PUT')
                        @endif
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $book->title ?? '')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="category_id" :value="__('Category')" />
                            <select name="category_id" id="category_id" class="block mt-1 w-full" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ (old('category_id') ?? $book->category_id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea name="description" id="description" class="block mt-1 w-full">{{ old('description', $book->description ?? '') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="quantity" :value="__('Quantity')" />
                            <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" :value="old('quantity', $book->quantity ?? 1)" required />
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <label for="file" class="block font-medium text-sm text-gray-700">{{ __('Book File (PDF)') }}</label>
                            @if(isset($book) && $book->file_path)
                                <p class="text-sm text-gray-500">Current file: <a href="{{ Storage::url($book->file_path) }}" target="_blank" class="text-blue-600">View PDF</a></p>
                            @endif
                            <input id="file" class="block mt-1 w-full" type="file" name="file" {{ isset($book) ? '' : 'required' }} />
                            @error('file')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="cover" class="block font-medium text-sm text-gray-700">{{ __('Cover Image (JPEG/PNG)') }}</label>
                            @if(isset($book) && $book->cover_path)
                                <p class="text-sm text-gray-500">Current cover: <img src="{{ Storage::url($book->cover_path) }}" alt="Cover Image" class="w-20 h-20 rounded mt-2"></p>
                            @endif
                            <input id="cover" class="block mt-1 w-full" type="file" name="cover" {{ isset($book) ? '' : 'required' }} />
                            @error('cover')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <x-primary-button>
                            {{ isset($book) ? __('Update') : __('Create') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

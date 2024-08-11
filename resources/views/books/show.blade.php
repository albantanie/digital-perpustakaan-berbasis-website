<!-- resources/views/books/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>{{ __('Book Details') }}</h3>
                    <div>
                        <h4 class="font-bold">{{ $book->title }}</h4>
                        <p><strong>Category:</strong> {{ $book->category->name }}</p>
                        <p><strong>Quantity:</strong> {{ $book->quantity }}</p>
                        <p><strong>Cover:</strong>   @if($book->cover_path)
                            <img src="{{ Storage::url($book->cover_path) }}" alt="Cover Image" class="w-16 h-16 rounded">
                        @else
                            <span class="text-gray-500">No Cover</span>
                        @endif</p>
                        <p><strong>PDF File:</strong>  @if($book->file_path)
                            <a href="{{ Storage::url($book->file_path) }}" target="_blank" class="text-blue-600">View PDF</a>
                        @else
                            <span class="text-gray-500">No File</span>
                        @endif</p>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary">{{ __('Edit') }}</a>
                        <a href="{{ route('books.index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

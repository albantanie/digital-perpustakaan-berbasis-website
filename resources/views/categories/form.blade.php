<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($category) ? __('Edit Category') : __('Add Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}">
                        @csrf
                        @if(isset($category))
                            @method('PUT')
                        @endif
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Category Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $category->name ?? '')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <x-primary-button>
                            {{ isset($category) ? __('Update') : __('Create') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

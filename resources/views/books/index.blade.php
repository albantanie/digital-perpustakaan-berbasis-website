<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>{{ __("List of Books") }}</h3>
                    <form method="GET" action="{{ route('books.index') }}" class="mb-4">
                        <select name="category" class="form-select">
                            <option value="">{{ __('All Categories') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">{{ __('Filter') }}</button>
                    </form>

                    <!-- Include DataTables CSS -->
                    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

                    <!-- Table -->
                    <table id="books-table" class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Title
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Category
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Quantity
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cover
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    PDF File
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($books as $book)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $book->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $book->category->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $book->quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($book->cover_path)
                                        <img src="{{ Storage::url($book->cover_path) }}" alt="Cover Image" class="w-16 h-16 rounded">
                                    @else
                                        <span class="text-gray-500">No Cover</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($book->file_path)
                                        <a href="{{ Storage::url($book->file_path) }}" target="_blank" class="text-blue-600">View PDF</a>
                                    @else
                                        <span class="text-gray-500">No File</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">View</a>
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-secondary">Edit</a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Include DataTables JS -->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

                    <!-- Initialize DataTables -->
                    <script>
                        $(document).ready(function() {
                            $('#books-table').DataTable();
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

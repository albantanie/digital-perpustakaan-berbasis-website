<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header>
            <!-- Include navigation or header content here -->
            <nav>
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('books.index') }}">Books</a>
                <a href="{{ route('categories.index') }}">Categories</a>
            </nav>
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>

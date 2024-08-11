<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\Exports\BooksExport; // Ensure this exists or create it
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Import the AuthorizesRequests trait

class BookController extends Controller
{
    use AuthorizesRequests; // Use the AuthorizesRequests trait



    

    public function index(Request $request)
    {
        $categories = Category::all();
        
        $query = Book::query();
        if (!Auth::user()->isAdmin()) {
            $query->where('user_id', Auth::id());
        }

        $books = $query->when($request->category, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->get();

        return view('books.index', compact('books', 'categories'));
    }

    public function create()
    {
        $this->authorize('create', Book::class);
        $categories = Category::all();
        return view('books.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
            'file' => 'required|mimes:pdf|max:2048', // Limit file size
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $filePath = $request->file('file')->store('public/books');
        $coverPath = $request->file('cover')->store('public/covers');
    
        Book::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'file_path' => $filePath,
            'cover_path' => $coverPath,
            'user_id' => Auth::id(),
        ]);
    
        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }
    

    public function show(Book $book)
    {
        $this->authorize('view', $book);
        $categories = Category::all();
        return view('books.show', compact('book', 'categories'));
    }

    public function edit(Book $book)
    {
        $this->authorize('update', $book);
        $categories = Category::all();
        return view('books.form', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $this->authorize('update', $book);

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
            'file' => 'nullable|mimes:pdf',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        if ($request->hasFile('file')) {
            Storage::delete($book->file_path);
            $book->file_path = $request->file('file')->store('books');
        }

        if ($request->hasFile('cover')) {
            Storage::delete($book->cover_path);
            $book->cover_path = $request->file('cover')->store('covers');
        }

        $book->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'file_path' => $book->file_path,
            'cover_path' => $book->cover_path,
        ]);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);

        Storage::delete([$book->file_path, $book->cover_path]);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }

    public function exportExcel()
    {
        return Excel::download(new BooksExport(Auth::user()), 'books.xlsx');
    }

    public function exportPDF()
    {
        $query = Book::query();
        if (!Auth::user()->isAdmin()) {
            $query->where('user_id', Auth::id());
        }
        $books = $query->get();

        $pdf = PDF::loadView('books.pdf', compact('books'));
        return $pdf->download('books.pdf');
    }
}

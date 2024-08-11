<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $adminUser = User::where('role', 'admin')->first();

        // Create sample books
        foreach ($categories as $category) {
            Book::create([
                'title' => "Sample Book in {$category->name}",
                'category_id' => $category->id,
                'description' => "This is a sample description for a book in the {$category->name} category.",
                'quantity' => rand(1, 20),
                'file_path' => 'books/sample.pdf', // Adjust this path as needed
                'cover_path' => 'covers/sample.jpg', // Adjust this path as needed
                'user_id' => $adminUser->id,
            ]);
        }
    }
}

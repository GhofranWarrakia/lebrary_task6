<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getAllBooks()
    {
        $books = Book::all();
        return response()->json(['books' => $books], 200);
    }

    public function getBook($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json(['book' => $book], 200);
    }

    public function getAllCategories()
    {
        $categories = Category::all();
        return response()->json(['categories' => $categories], 200);
    }

    public function getBooksByCategory($category_id)
    {
        $category = Category::find($category_id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json(['books' => $category->books], 200);
    }

    public function addBook(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'category_id' => $request->category_id,
        ]);

        return response()->json(['book' => $book], 201);
    }

    public function updateBook(Request $request, $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $book->title = $request->title;
        $book->author = $request->author;
        $book->category_id = $request->category_id;
        $book->save();

        return response()->json(['book' => $book], 200);
    }

    public function deleteBook($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Book deleted successfully'], 200);
    }
}



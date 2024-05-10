<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Book;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function browseBooks()
    {
        return Book::all();
    }

    public function filterBooksByCategory(Request $request)
    {
        $categoryId = $request->input('category_id');
        $category = Category::find($categoryId);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return $category->books;
    }
}

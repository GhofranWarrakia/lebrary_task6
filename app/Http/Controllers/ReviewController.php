<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function addReview(Request $request, $book_id)
    {
        $user = $request->user();
        $book = Book::find($book_id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string',
        ]);

        $review = $user->reviews()->create([
            'book_id' => $book_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json(['review' => $review], 200);
    }

}

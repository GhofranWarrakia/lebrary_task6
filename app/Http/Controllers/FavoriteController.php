<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function addFavorite(Request $request, $book_id)
    {
        $user = $request->user();
        $book = Book::find($book_id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $user->favorites()->attach($book);

        return response()->json(['message' => 'Book added to favorites'], 200);
    }

    public function removeFavorite(Request $request, $book_id)
    {
        $user = $request->user();
        $user->favorites()->detach($book_id);

        return response()->json(['message' => 'Book removed from favorites'], 200);
    }
}

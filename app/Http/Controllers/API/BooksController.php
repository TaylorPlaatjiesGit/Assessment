<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use App\Models\Book;

class BooksController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => 'required|unique:books',
            'description' => 'nullable'
        ]);

        $request->user()->books()->create($data);

        Cache::forget('books_all');

        return response()->json($book);
    }

    public function get(Request $request): JsonResponse
    {
        $books = Cache::remember('books_all', 60, function () {
            // If not found, retrieve from the database and cache it
            return Book::all();
        });

        return response()->json($books);
    }

    public function update(Request $request, Book $book): JsonResponse
    {
        $data = $request->validate([
            'title' => 'required|unique:books,' . $book->id,
            'description' => 'nullable'
        ]);

        $book->update($data);

        Cache::forget('books_all');

        return response()->json($book);
    }

    public function delete(Request $request, Book $book): JsonResponse
    {
        $book->delete();

        Cache::forget('books_all');

        return response()->json($book);
    }

    public function getSingular(Request $request, Book $book): JsonResponse
    {
        return response()->json($book);
    }
}
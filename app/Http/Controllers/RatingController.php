<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use App\Models\Rating;

class RatingController extends Controller
{
    // Menampilkan form input rating
    public function create()
    {
        // Ambil semua author (id & name saja biar ringan)
        $authors = Author::select('id', 'name')
            ->orderBy('name')
            ->get();

        return view('ratings.create', compact('authors'));
    }

    // Menangani submit rating
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating'  => 'required|integer|min:1|max:10'
        ]);

        Rating::create([
            'book_id' => $request->book_id,
            'rating'  => $request->rating
        ]);

        return redirect()->route('books.index')->with('success', 'Rating berhasil ditambahkan!');
    }

    // API untuk ambil daftar buku berdasarkan author
    public function getBooksByAuthor($authorId)
    {
        return Book::select('id', 'title')
            ->where('author_id', $authorId)
            ->orderBy('title')
            ->get();
    }
}

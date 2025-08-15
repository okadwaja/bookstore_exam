<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        // Ambil top 10 penulis dengan jumlah voter terbanyak, hanya rating > 5
        $authors = Author::withCount(['books as voters_count' => function ($query) {
                $query->join('ratings', 'books.id', '=', 'ratings.book_id')
                        ->where('ratings.rating', '>', 5);
            }])
            ->orderByDesc('voters_count')
            ->take(10)
            ->get();

        return view('authors.index', compact('authors'));
    }
}

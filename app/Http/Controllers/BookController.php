<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search  = $request->input('search');

        // Subquery untuk ratings
        $ratingsSub = DB::table('ratings')
            ->select('book_id',
                    DB::raw('AVG(rating) as avg_rating'),
                    DB::raw('COUNT(id) as voters'))
            ->groupBy('book_id');

        $booksQuery = DB::table('books')
            ->select(
                'books.id',
                'books.title',
                'authors.name as author_name',
                'r.avg_rating',
                'r.voters'
            )
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->leftJoinSub($ratingsSub, 'r', function ($join) {
                $join->on('books.id', '=', 'r.book_id');
            });

        // Pencarian
        if ($search) {
            $booksQuery->where(function ($q) use ($search) {
                $q->where('books.title', 'like', "%{$search}%")
                ->orWhere('authors.name', 'like', "%{$search}%");
            });
        }

        $books = $booksQuery->orderByDesc('r.avg_rating')
            ->paginate($perPage);

        return view('books.index', compact('books', 'perPage', 'search'));

    }
}

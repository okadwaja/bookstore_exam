<!DOCTYPE html>
<html>
<head>
    <title>List Books</title>
</head>
<body>
    <h1>List of Books</h1>

    <div style="margin-bottom: 15px;">
        <a href="{{ route('authors.index') }}"
        style="padding: 8px 12px; background-color: #28a745; color: white; text-decoration: none; border-radius: 4px;">
            Top Authors
        </a>

        <a href="{{ route('ratings.create') }}"
        style="padding: 8px 12px; background-color: #007bff; color: white; text-decoration: none; border-radius: 4px; margin-left: 5px;">
            Insert Rating
        </a>
    </div>


    {{-- Filter Form --}}
    <form method="GET" action="{{ route('books.index') }}">
        <label>Show:
            <select name="per_page" onchange="this.form.submit()">
                @foreach(range(10, 100, 10) as $num)
                    <option value="{{ $num }}" {{ $perPage == $num ? 'selected' : '' }}>
                        {{ $num }}
                    </option>
                @endforeach
            </select>
        </label>

        <label>Search:
            <input type="text" name="search" value="{{ $search }}" placeholder="Book or Author">
        </label>

        <button type="submit">Filter</button>
    </form>

    {{-- Table Books --}}
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Author</th>
                <th>Average Rating</th>
                <th>Voters</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $index => $book)
                <tr>
                    {{-- Nomor urut mengikuti pagination --}}
                    <td>{{ ($books->currentPage() - 1) * $books->perPage() + $index + 1 }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author_name }}</td>
                    <td>{{ number_format($book->avg_rating, 2) }}</td>
                    <td>{{ $book->voters }}</td>
                </tr>
            @endforeach

            {{-- Baris titik-titik --}}
            <tr>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
            </tr>
        </tbody>
    </table>

    {{-- Pagination --}}
    {{ $books->appends(['per_page' => $perPage, 'search' => $search])->links('pagination::simple-default') }}
</body>
</html>

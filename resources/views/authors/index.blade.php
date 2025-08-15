<!DOCTYPE html>
<html>
<head>
    <title>Top 10 Most Famous Authors</title>
</head>
<body>
    <h1>Top 10 Most Famous Authors</h1>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Author</th>
                <th>Voters</th>
            </tr>
        </thead>
        <tbody>
            @foreach($authors as $index => $author)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $author->name }}</td>
                    <td>{{ $author->voters_count }}</td>
                </tr>
            @endforeach

            {{-- Baris titik-titik --}}
            <tr>
                <td>...</td>
                <td>...</td>
                <td>...</td>
            </tr>
        </tbody>
    </table>

    <br>
    <a href="{{ route('books.index') }}">← Back to Books</a>
</body>
</html>

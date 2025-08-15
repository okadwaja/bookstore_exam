<!DOCTYPE html>
<html>
<head>
    <title>Insert Rating</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Insert Rating</h1>

    <form method="POST" action="{{ route('ratings.store') }}">
        @csrf

        <label>Book Author:</label>
        <select name="author_id" id="author_id" required>
            <option value="">-- Choose Author --</option>
            @foreach ($authors as $author)
                <option value="{{ $author->id }}">{{ $author->name }}</option>
            @endforeach
        </select>
        <br><br>

        <label>Book Name:</label>
        <select name="book_id" id="book_id" required>
            <option value="">-- Choose Book --</option>
        </select>
        <br><br>

        <label>Rating:</label>
        <select name="rating" required>
            @for ($i = 1; $i <= 10; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        <br><br>

        <button type="submit">Submit</button>
    </form>

    <script>
        $('#author_id').change(function() {
            let authorId = $(this).val();
            if (authorId) {
                $.get('/api/books-by-author/' + authorId, function(data) {
                    $('#book_id').empty().append('<option value="">-- Choose Book --</option>');
                    data.forEach(function(book) {
                        $('#book_id').append('<option value="'+book.id+'">'+book.title+'</option>');
                    });
                });
            } else {
                $('#book_id').empty().append('<option value="">-- Choose Book --</option>');
            }
        });
    </script>
</body>
</html>

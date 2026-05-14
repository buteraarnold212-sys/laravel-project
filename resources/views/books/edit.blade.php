@extends('layout')

@section('content')
    <h2>Edit Book</h2>

    <form action="{{ route('books.update', $book) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" required>

        <label for="author">Author</label>
        <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}" required>

        <label for="quantity">Quantity</label>
        <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $book->quantity) }}" min="0" required>

        <button type="submit">Update book</button>
    </form>
@endsection

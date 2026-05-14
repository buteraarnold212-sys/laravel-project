@extends('layout')

@section('content')
    <h2><i class="fas fa-book-edit"></i> Edit Book</h2>

    <form action="{{ route('books.update', $book) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="title"><i class="fas fa-book"></i> Title</label>
        <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" required>

        <label for="author"><i class="fas fa-pen-fancy"></i> Author</label>
        <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}" required>

        <label for="quantity"><i class="fas fa-boxes"></i> Quantity</label>
        <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $book->quantity) }}" min="0" required>

        <button type="submit"><i class="fas fa-save"></i> Update book</button>
    </form>
@endsection

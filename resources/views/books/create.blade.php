@extends('layout')

@section('content')
    <h2>Add Book</h2>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}" required>

        <label for="author">Author</label>
        <input type="text" id="author" name="author" value="{{ old('author') }}" required>

        <label for="quantity">Quantity</label>
        <input type="number" id="quantity" name="quantity" value="{{ old('quantity', 1) }}" min="0" required>

        <button type="submit">Save book</button>
    </form>
@endsection

@extends('layout')

@section('content')
    <h2><i class="fas fa-book-medical"></i> Add Book</h2>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <label for="title"><i class="fas fa-book"></i> Title</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}" required>

        <label for="author"><i class="fas fa-pen-fancy"></i> Author</label>
        <input type="text" id="author" name="author" value="{{ old('author') }}" required>

        <label for="quantity"><i class="fas fa-boxes"></i> Quantity</label>
        <input type="number" id="quantity" name="quantity" value="{{ old('quantity', 1) }}" min="0" required>

        <button type="submit"><i class="fas fa-save"></i> Save book</button>
    </form>
@endsection

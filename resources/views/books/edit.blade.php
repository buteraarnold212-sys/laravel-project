@extends('layout')

@section('content')
    <div class="page-header">
        <div>
            <div class="page-header__title"><i class="fas fa-book-edit" style="margin-right:0.5rem;"></i> Edit Book</div>@extends('layout')

@section('content')
    <div class="page-header">
        <div>
            <div class="page-header__title"><i class="fas fa-book-edit" style="margin-right:0.5rem;"></i> Edit Book</div>
            <div class="page-header__subtitle">Update the book details or adjust the available inventory count.</div>
        </div>
        <div class="page-actions">
            <a href="{{ route('books.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Books</a>
        </div>
    </div>

    <div class="card">
        <form action="{{ route('books.update', $book) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="field">
                    <label for="title"><i class="fas fa-book"></i> Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" required />
                </div>

                <div class="field">
                    <label for="author"><i class="fas fa-pen-fancy"></i> Author</label>
                    <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}" required />
                </div>

                <div class="field">
                    <label for="quantity"><i class="fas fa-boxes"></i> Quantity</label>
                    <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $book->quantity) }}" min="0" required />
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn--primary"><i class="fas fa-save"></i> Update Book</button>
            </div>
        </form>
    </div>
@endsection

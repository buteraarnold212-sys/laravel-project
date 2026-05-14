@extends('layout')

@section('content')
    <h2>Books Collection</h2>
    <p><a href="{{ route('books.create') }}" class="btn-add"><i class="fas fa-plus"></i> Add Book</a></p>

    @if($books->isEmpty())
        <p><i class="fas fa-info-circle"></i> No books found.</p>
    @else
        <table>
            <tr>
                <th><i class="fas fa-hashtag"></i> ID</th>
                <th><i class="fas fa-book"></i> Title</th>
                <th><i class="fas fa-pen-fancy"></i> Author</th>
                <th><i class="fas fa-boxes"></i> Quantity</th>
                <th><i class="fas fa-cogs"></i> Actions</th>
            </tr>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->quantity }}</td>
                    <td class="actions">
                        <a href="{{ route('books.edit', $book) }}"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection

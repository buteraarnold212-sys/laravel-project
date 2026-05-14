@extends('layout')

@section('content')
    <p>Welcome to the library system. Use the links above to manage members, books, or borrowing records.</p>
    <ul>
        <li><a href="{{ route('members.index') }}">View members</a></li>
        <li><a href="{{ route('books.index') }}">View books</a></li>
        <li><a href="{{ route('borrowings.index') }}">View borrowings</a></li>
    </ul>
@endsection

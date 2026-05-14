@extends('layout')

@section('content')
    <h2>Borrowings</h2>
    <p><a href="{{ route('borrowings.create') }}">New borrowing</a></p>

    @if($borrowings->isEmpty())
        <p>No borrowing records yet.</p>
    @else
        <table>
            <tr>
                <th>ID</th>
                <th>Member</th>
                <th>Book</th>
                <th>Borrowed</th>
                <th>Return</th>
                <th>Actions</th>
            </tr>
            @foreach($borrowings as $borrowing)
                <tr>
                    <td>{{ $borrowing->id }}</td>
                    <td>{{ $borrowing->member->name ?? 'Unknown' }}</td>
                    <td>{{ $borrowing->book->title ?? 'Unknown' }}</td>
                    <td>{{ $borrowing->borrowing_date }}</td>
                    <td>{{ $borrowing->return_date ?? '-' }}</td>
                    <td class="actions">
                        <a href="{{ route('borrowings.edit', $borrowing) }}">Edit</a>
                        <form action="{{ route('borrowings.destroy', $borrowing) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection

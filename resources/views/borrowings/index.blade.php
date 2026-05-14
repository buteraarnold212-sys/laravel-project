@extends('layout')

@section('content')
    <h2>Borrowing Records</h2>
    <p><a href="{{ route('borrowings.create') }}" class="btn-add"><i class="fas fa-plus"></i> New Borrowing</a></p>

    @if($borrowings->isEmpty())
        <p><i class="fas fa-info-circle"></i> No borrowing records yet.</p>
    @else
        <table>
            <tr>
                <th><i class="fas fa-hashtag"></i> ID</th>
                <th><i class="fas fa-user"></i> Member</th>
                <th><i class="fas fa-book"></i> Book</th>
                <th><i class="fas fa-calendar"></i> Borrowed</th>
                <th><i class="fas fa-calendar-check"></i> Return</th>
                <th><i class="fas fa-cogs"></i> Actions</th>
            </tr>
            @foreach($borrowings as $borrowing)
                <tr>
                    <td>{{ $borrowing->id }}</td>
                    <td>{{ $borrowing->member->name ?? 'Unknown' }}</td>
                    <td>{{ $borrowing->book->title ?? 'Unknown' }}</td>
                    <td>{{ $borrowing->borrowing_date }}</td>
                    <td>{{ $borrowing->return_date ?? '-' }}</td>
                    <td class="actions">
                        <a href="{{ route('borrowings.edit', $borrowing) }}"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('borrowings.destroy', $borrowing) }}" method="POST" style="display:inline;">
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

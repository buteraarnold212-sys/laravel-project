@extends('layout')

@section('content')
    <h2><i class="fas fa-edit"></i> Edit Borrowing</h2>

    <form action="{{ route('borrowings.update', $borrowing) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="member_id"><i class="fas fa-user"></i> Member</label>
        <select id="member_id" name="member_id" required>
            <option value="">Select member</option>
            @foreach($members as $member)
                <option value="{{ $member->id }}" {{ old('member_id', $borrowing->member_id) == $member->id ? 'selected' : '' }}>
                    {{ $member->name }}
                </option>
            @endforeach
        </select>

        <label for="book_id"><i class="fas fa-book"></i> Book</label>
        <select id="book_id" name="book_id" required>
            <option value="">Select book</option>
            @foreach($books as $book)
                <option value="{{ $book->id }}" {{ old('book_id', $borrowing->book_id) == $book->id ? 'selected' : '' }}>
                    {{ $book->title }}
                </option>
            @endforeach
        </select>

        <label for="borrowing_date"><i class="fas fa-calendar"></i> Borrowing Date</label>
        <input type="date" id="borrowing_date" name="borrowing_date" value="{{ old('borrowing_date', $borrowing->borrowing_date) }}" required>

        <label for="return_date"><i class="fas fa-calendar-check"></i> Return Date</label>
        <input type="date" id="return_date" name="return_date" value="{{ old('return_date', $borrowing->return_date) }}">

        <button type="submit"><i class="fas fa-save"></i> Update borrowing</button>
    </form>
@endsection

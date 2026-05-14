@extends('layout')

@section('content')
    <h2>Add Member</h2>

    <form action="{{ route('members.store') }}" method="POST">
        @csrf

        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>

        <label for="address">Address</label>
        <input type="text" id="address" name="address" value="{{ old('address') }}" required>

        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>

        <button type="submit">Save member</button>
    </form>
@endsection

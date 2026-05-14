@extends('layout')

@section('content')
    <h2>Edit Member</h2>

    <form action="{{ route('members.update', $member) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name', $member->name) }}" required>

        <label for="address">Address</label>
        <input type="text" id="address" name="address" value="{{ old('address', $member->address) }}" required>

        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone', $member->phone) }}" required>

        <button type="submit">Update member</button>
    </form>
@endsection

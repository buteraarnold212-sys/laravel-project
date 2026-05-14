@extends('layout')

@section('content')
    <h2><i class="fas fa-user-edit"></i> Edit Member</h2>

    <form action="{{ route('members.update', $member) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name"><i class="fas fa-user"></i> Name</label>
        <input type="text" id="name" name="name" value="{{ old('name', $member->name) }}" required>

        <label for="address"><i class="fas fa-map-marker-alt"></i> Address</label>
        <input type="text" id="address" name="address" value="{{ old('address', $member->address) }}" required>

        <label for="phone"><i class="fas fa-phone"></i> Phone</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone', $member->phone) }}" required>

        <button type="submit"><i class="fas fa-save"></i> Update member</button>
    </form>
@endsection

@extends('layout')

@section('content')
    <h2><i class="fas fa-user-plus"></i> Add Member</h2>

    <form action="{{ route('members.store') }}" method="POST">
        @csrf

        <label for="name"><i class="fas fa-user"></i> Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>

        <label for="address"><i class="fas fa-map-marker-alt"></i> Address</label>
        <input type="text" id="address" name="address" value="{{ old('address') }}" required>

        <label for="phone"><i class="fas fa-phone"></i> Phone</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>

        <button type="submit"><i class="fas fa-save"></i> Save member</button>
    </form>
@endsection

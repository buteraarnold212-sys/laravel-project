@extends('layout')

@section('content')
    <h2>Members</h2>
    <p><a href="{{ route('members.create') }}">Add member</a></p>

    @if($members->isEmpty())
        <p>No members yet.</p>
    @else
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
            @foreach($members as $member)
                <tr>
                    <td>{{ $member->id }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->address }}</td>
                    <td>{{ $member->phone }}</td>
                    <td class="actions">
                        <a href="{{ route('members.edit', $member) }}">Edit</a>
                        <form action="{{ route('members.destroy', $member) }}" method="POST" style="display:inline;">
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

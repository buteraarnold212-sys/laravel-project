@extends('layout')

@section('content')
    <h2>Members List</h2>
    <p><a href="{{ route('members.create') }}" class="btn-add"><i class="fas fa-plus"></i> Add Member</a></p>

    @if($members->isEmpty())
        <p><i class="fas fa-info-circle"></i> No members yet.</p>
    @else
        <table>
            <tr>
                <th><i class="fas fa-hashtag"></i> ID</th>
                <th><i class="fas fa-user"></i> Name</th>
                <th><i class="fas fa-map-marker-alt"></i> Address</th>
                <th><i class="fas fa-phone"></i> Phone</th>
                <th><i class="fas fa-cogs"></i> Actions</th>
            </tr>
            @foreach($members as $member)
                <tr>
                    <td>{{ $member->id }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->address }}</td>
                    <td>{{ $member->phone }}</td>
                    <td class="actions">
                        <a href="{{ route('members.edit', $member) }}"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('members.destroy', $member) }}" method="POST" style="display:inline;">
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

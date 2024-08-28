@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Trashed Users</h2>
            @if($users->isEmpty())
                <p>No trashed users found.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Prefix</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->prefixname }}</td>
                                <td>{{ $user->firstname }}</td>
                                <td>{{ $user->lastname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <form action="{{ route('users.restore', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">Restore</button>
                                    </form>
                                    <form action="{{ route('users.delete', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete Permanently</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection

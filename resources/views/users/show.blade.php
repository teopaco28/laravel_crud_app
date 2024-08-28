@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>User Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $user->fullname }}</h5>
                <p class="card-text">Email: {{ $user->email }}</p>
                <p class="card-text">Type: {{ $user->type }}</p>
                <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
@endsection

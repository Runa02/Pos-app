@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Profile</h4>
                </div>
                <div class="card-body">
                    {{-- Display user information --}}
                    <div class="mb-3">
                        <strong>Nama:</strong> {{ $user->name }}
                    </div>
                    <div class="mb-3">
                        <strong>Email:</strong> {{ $user->email }}
                    </div>
                    {{-- Add more user details as needed --}}

                    {{-- Update button --}}
                    <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#updateModal">
                        Update Profile
                    </button>
                    @auth
                    <a href="{{ route('profile.orders') }}" class="btn btn-outline-success">
                        Order
                    <span class="badge bg-success text-white ms-1 rounded-pill">{{ count(auth()->user()->order ?? []) }}</span>
                    @else
                    <a href="{{ route('profile.orders') }}" class="btn btn-outline-success">
                        Order
                    <span class="badge bg-success text-white ms-1 rounded-pill">0</span>
                    @endauth
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Update Profile Modal --}}
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- Add your update form here --}}
                <form action="{{ route('profile.update', ['id' => $user->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    {{-- Add form fields for updating user details --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" class="form-control" aria-describedby="passwordHelpInline" id="password" name="password">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
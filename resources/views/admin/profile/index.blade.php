@extends('layout.template')

@section('konten')

    <div class="profile-card">
        <img src="{{ !empty($user->profile_image) ? asset('storage/' . $user->profile_image) : asset('/image/default.jpg') }}" alt="Profile Image">
        <h2>{{ $user->name }}</h2>
        <p>Email: {{ $user->email }}</p>
        <a href="{{ route('admin.profile.edit') }}">
            <button class="btn btn-primary">
                <i class="fas fa-edit mr-2"></i>Edit Profile
            </button>
        </a>
    </div>
@endsection

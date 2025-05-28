@extends('layout.template_user')

@section('konten')

    <div class="profile-card">
        <a href='{{ route('user.index') }}' class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i></a>
        <img src="{{ !empty($user->profile_image) ? asset('storage/' . $user->profile_image) : asset('/image/default.jpg') }}" alt="Profile Image">
        <h2>{{ $user->name }}</h2>
        <p>Email: {{ $user->email }}</p>
        <a href="{{ route('user.profile.edit') }}">
            <button class="btn btn-primary">
                <i class="fas fa-edit mr-2"></i>Edit Profile
            </button>
        </a>
    </div>
@endsection



@extends('layout.template_user')

@section('konten')

<div class="container-edit">
    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <a href='{{ url('user/profile') }}' class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i></a>
        <div class="mb-3">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="mb-3">
            <label for="profile_image">Profile Image</label>
            <input type="file" id="profile_image" name="profile_image" class="form-control" value="{{ $user->profile_image}}" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
    </form>
</div>
@endsection

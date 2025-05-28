<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
        }
        .background-image {
            position: fixed;
            width: 50vw; /* Gambar memenuhi setengah layar */
            height: 100vh; /* Setinggi layar */
            object-fit: cover; /* Gambar tidak terdistorsi */
            z-index: -1;
            left: 0;
        }
        .card {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>

</head>
<body>
    {{-- <img alt="bgimg" class="background-image" src="/image/informasipublik.png" height="687"/> --}}
    <img src="{{ asset('/image/informasipublik.png') }}" class="background-image" height="687">
    <div class="container pt-5 pb-5">
        <div class="row justify-content-end">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        {{-- <img alt="ditstandalitu logo" class="mx-auto" src="/image/onlylogo.svg" height="50"/> --}}
                        <img src="{{ asset('/image/onlylogo.svg') }}" class="mx-auto" height="50">

                        <h3>Register User</h3>
                    </div>
                    <div class="card-body m-2">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <input type="hidden" name="role" value="user"> <!-- Default role: user -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" id="password" name="password" class="form-control" required>
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                        <i class="bi bi-eye-slash"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>                            
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                                    <button type="button" class="btn btn-outline-secondary" id="togglePasswordConfirm">
                                        <i class="bi bi-eye-slash"></i>
                                    </button>
                                </div>
                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Register</button>
                        </form>
                        <div class="text-center mt-3">
                            <p>Sudah punya akun? <a href="{{ route('login') }}">Log in</a></p>
                        </div>
                        <div class="text-center mt-3">
                            <p>Ingin mendaftar sebagai admin? <a href="{{ route('register.admin') }}" class="btn btn-outline-secondary btn-sm">Registrasi Admin</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    // Fungsi untuk toggle visibility password
    function togglePasswordVisibility(passwordFieldId, toggleButtonId) {
        const passwordField = document.getElementById(passwordFieldId);
        const toggleButton = document.getElementById(toggleButtonId);
        const toggleIcon = toggleButton.querySelector('i');

        toggleButton.addEventListener('click', () => {
            const isPasswordVisible = passwordField.type === 'text';
            passwordField.type = isPasswordVisible ? 'password' : 'text';
            toggleIcon.classList.toggle('bi-eye-slash', isPasswordVisible);
            toggleIcon.classList.toggle('bi-eye', !isPasswordVisible);
        });
    }

    // Terapkan fungsi untuk kedua input
    togglePasswordVisibility('password', 'togglePassword');
    togglePasswordVisibility('password_confirmation', 'togglePasswordConfirm');
</script>


</html>

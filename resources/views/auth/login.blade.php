<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
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
    <!-- Gambar Latar -->
    {{-- <img src="/image/informasipublik.png" alt="bgimg" class="background-image"> --}}
    <img src="{{ asset('/image/informasipublik.png') }}" class="background-image">

    
    <!-- Form Login -->
    <div class="container pt-5 pb-5">
        <div class="row justify-content-end">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        {{-- <img alt="ditstandalitu logo" class="mx-auto" src="/image/onlylogo.svg" width="50"/> --}}
                        <img src="{{ asset('/image/onlylogo.svg') }}" class="mx-auto" width="50">
                        <h3>Log in</h3>
                    </div>
                    <div class="card-body m-2">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" id="password" name="password" class="form-control" required>
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                        <i class="bi bi-eye-slash"></i>
                                    </button>
                                </div>
                            </div>                            
                            <button type="submit" class="btn btn-primary w-100">Log in</button>
                        </form>
                        <div class="text-center mt-3">
                            <p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    const passwordField = document.getElementById('password');
    const togglePasswordButton = document.getElementById('togglePassword');
    const toggleIcon = togglePasswordButton.querySelector('i');

    togglePasswordButton.addEventListener('click', () => {
        const isPasswordVisible = passwordField.type === 'text';
        passwordField.type = isPasswordVisible ? 'password' : 'text';
        toggleIcon.classList.toggle('bi-eye-slash', isPasswordVisible);
        toggleIcon.classList.toggle('bi-eye', !isPasswordVisible);
    });
</script>

</html>

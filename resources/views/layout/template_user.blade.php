<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg" href="{{ asset('/image/onlylogo.svg') }}">


    @php
    $titles = [
        'user.index' => 'Dashboard - Form Permohonan ATK',
        'form.index' => 'Keranjang - Form Permohonan ATK',
        'form.edit' => 'Edit Form - Form Permohonan ATK',
        'checkout.show' => 'Check out - Form Permohonan ATK',
        'user.profile.index' => 'Profile - Form Permohonan ATK',
        'user.profile.edit' => 'Edit Profile - Form Permohonan ATK',
        // Tambahkan mapping route lainnya di sini
    ];

    $currentRoute = request()->route()->getName();
    $pageTitle = $titles[$currentRoute] ?? 'Default Title';
    @endphp
    <title>{{ $pageTitle }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: Poppins, sans-serif;
            background-color: #f5f5f5;
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card-container {
            margin-top: 90px; /* Menghindari navbar */
            height: calc(100vh - 110px); /* Tinggi penuh minus navbar */
            overflow-y: auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .card {
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 16px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .card h3 {
            font-size: 1em;
            margin: 10px 0;
        }

        .card .stock {
            font-size: 0.9em;
            color: #555;
            margin-bottom: 10px;
        }

        .quantity-input {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .quantity-input input[type="number"] {
            width: 50px;
            text-align: center;
            margin: 0 5px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .input-btn {
            padding: 8px 16px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .input-btn:hover {
            background-color: #555;
        }

        /* form */
        .table-responsive {
            font-family: Poppins;
            display: block;
            width: 100%;
            overflow-x: auto;
            white-space: nowrap;
        }

        .thead, tbody, td, th {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        /* checkout */
        .button-form {
            justify-content: flex-end;
            display: flex;
        }

        /*.fa-print {
            color: #ababab;
        }

        .fa-file-pdf {
            color: #ff0000;
        }

        .fa-file-excel {
            color: #008000;
        }*/

        .container-edit {
            margin-top: 90px; /* Menghindari navbar */
            margin-left: 3em;
            margin-right: 3em;
        }

        /* Profile card styling */
        .profile-card {
            margin-top: 90px;
            margin-left: 3em;
            margin-right: 3em;
            max-width: 500px;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .profile-card img {
            width: 250px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto;
            margin-bottom: 15px;
        }
        .profile-card h2 {
            font-size: 1.5em;
            margin-bottom: 5px;
        }
        .profile-card p {
            font-size: 1em;
            color: #777;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                {{-- <img src="/image/onlylogo.svg" alt="ditstandalitu logo" height="30" width="50" class="me-2"> --}}
                <img src="{{ asset('/image/onlylogo.svg') }}" class="me-2" height="30" width="50">

                <h1 class="h5 mb-0">Form Permohonan Alat Tulis Kantor (ATK)</h1>
            </div>
            <div class="d-flex align-items-center">
                {{-- <input type="text" id="searchInput" class="form-control me-2" placeholder="Search" onkeyup="filterCards()">
                <button class="btn btn-secondary me-5" type="submit"><i class="fas fa-search"></i></button>                     --}}
                <!-- Form Pencarian -->
                @if (Route::currentRouteName() === 'user.index')
                <form class="d-flex me-2" action="{{ url()->current() }}" method="get">
                    <input type="search" name="katakunci" value="{{ request()->katakunci }}" placeholder="Cari nama barang" class="form-control">
                    <button class="btn btn-secondary" type="submit"><i class="fas fa-search"></i></button>
                </form>
                @endif

                @if (in_array(Route::currentRouteName(), ['form.index', 'checkout.index']))
                <!-- Jika di halaman form.index, tampilkan tombol Home -->
                        <a href="{{ route('user.index') }}" class="btn btn-primary">
                            <i class="fas fa-home fa-lg"></i> <!-- Ikon Home -->
                        </a>
                    @else
                        <!-- Jika di halaman lain, tampilkan tombol Cart -->
                        <a href="{{ route('form.index') }}" class="btn btn-primary">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                        </a>
                    @endif
                    {{-- <form onsubmit="return confirm('Apakah anda ingin log out?')" id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger ml-2"><i class="fas fa-sign-out-alt"></i></button>
                    </form>                      --}}
                    <!-- Profile Dropdown -->
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ !empty(Auth::user()->profile_image) ? asset('storage/' . Auth::user()->profile_image) : asset('/image/default.jpg') }}"
                        alt="Profile"
                        width="40"
                        height="40"
                        class="rounded-circle ml-3">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="{{ route('user.profile.index') }}"><i class="fas fa-user me-2"></i>Profile</a></li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="button" class="mt-2 ml-4" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Log Out
                                </button>
                            </form>    
                        </li>
                    </ul>
                </div>   
               </div>
            </div>
        </div>
    </nav>

    @yield('konten')

    {{-- modal logout --}}
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin keluar?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" onclick="submitLogoutForm()">Log Out</button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal Delete --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus barang ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" onclick="submitDeleteForm()">Delete</button>
                </div>
            </div>
        </div>
    </div>
    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function filterCards() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const cards = document.querySelectorAll('.card');
    
            cards.forEach(card => {
                const cardTitle = card.querySelector('h3').textContent.toLowerCase();
                if (cardTitle.includes(filter)) {
                    card.style.display = ''; // Tampilkan kartu jika cocok
                } else {
                    card.style.display = 'none'; // Sembunyikan kartu jika tidak cocok
                }
            });
        }
    </script>  

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jumlahInput = document.getElementById('jumlah');

        jumlahInput.addEventListener('input', function() {
            validateInput(this);
        });

        jumlahInput.addEventListener('blur', function() {
            validateInput(this);
        });
    });

    function validateInput(input) {
        const min = parseInt(input.min) || 1;
        const max = parseInt(input.max);
        let value = parseInt(input.value);

        if (value < min) {
            input.value = min;
        } else if (value > max) {
            input.value = max;
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dateInput = document.getElementById('tanggal');

        // Mencegah karakter non-angka dan non-'/'
        dateInput.addEventListener('keypress', function (e) {
            const key = String.fromCharCode(e.which);
            if (!/[0-9/]/.test(key)) {
                e.preventDefault(); // Cegah input karakter tidak valid
            }
        });

        // Tambahkan format otomatis (dd/mm/yyyy)
        dateInput.addEventListener('input', function () {
            let value = this.value.replace(/[^0-9]/g, ''); // Hapus karakter non-angka
            if (value.length > 2 && value.length <= 4) {
                value = value.slice(0, 2) + '/' + value.slice(2); // Tambahkan '/' setelah tanggal
            } else if (value.length > 4) {
                value = value.slice(0, 2) + '/' + value.slice(2, 4) + '/' + value.slice(4); // Tambahkan '/' setelah bulan
            }
            this.value = value.slice(0, 10); // Batasi panjang maksimal 10 karakter
        });

        // Validasi panjang input saat kehilangan fokus
        dateInput.addEventListener('blur', function () {
            if (this.value.length !== 10) {
                alert('Format tanggal harus dd/mm/yyyy!');
                this.value = ''; // Kosongkan input jika format tidak valid
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#tanggal", {
            dateFormat: "d/m/Y", // Format dd/mm/yyyy
            allowInput: false,    // Izinkan input manual, jika Anda ingin input otomatis formatnya (pilih dari picker)
            altInput: true,      // Gunakan input alternatif (untuk menunjukkan tanggal dalam format yang lebih mudah dibaca)
            altFormat: "d/m/Y",  // Format tanggal alternatif untuk tampilan
        });
    });
</script>

<script>
    function submitLogoutForm() {
        // Menutup modal
        var myModal = new bootstrap.Modal(document.getElementById('logoutModal'));
        myModal.hide();

        // Kirim form logout secara normal
        document.getElementById('logout-form').submit();
    }
</script>

<script>
    let formToDelete = null;

    function setDeleteFormId(formId) {
        formToDelete = document.getElementById(formId);
    }

    function submitDeleteForm() {
        if (formToDelete) {
            formToDelete.submit();
        } else {
            console.error("Form untuk dihapus tidak ditemukan.");
        }
    }
</script>

<script>
    function submitLogoutForm() {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route('logout') }}';
    
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);
    
        document.body.appendChild(form);
        form.submit();
    }
</script>
    
<script>
document.addEventListener('DOMContentLoaded', function () {
    const jumlahInput = document.getElementById('jumlah');;

    // Listener input realtime
    if (jumlahInput) {
        jumlahInput.addEventListener('input', () => validateJumlah(jumlahInput, 'error-jumlah'));
    }

    // Validasi masing-masing field
    function validateJumlah(input, errorId) {
        const error = document.getElementById(errorId);
        if (!input.value.trim()) {
            error.textContent = 'Jumlah Wajib diisi';
            input.classList.add('is-invalid');
        } else if (isNaN(input.value)) {
            error.textContent = 'Jumlah harus berupa angka';
            input.classList.add('is-invalid');
        } else {
            error.textContent = '';
            input.classList.remove('is-invalid');
        }
    }
});
</script>


</body>
</html>
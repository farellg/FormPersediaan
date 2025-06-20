<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg" href="{{ asset('/image/onlylogo.svg') }}">

    @php
$titles = [
    'admin.index' => 'Dashboard - Admin Form Permohonan ATK',
    'databarang.index' => 'Data Barang - Admin Form Permohonan ATK',
    'databarang.create' => 'Buat Data Barang - Admin Form Permohonan ATK',
    'databarang.edit' => 'Edit Data Barang - Admin Form Permohonan ATK',
    'datatransaksi.index' => 'Data Transaksi - Admin Form Permohonan ATK',
    'datatransaksi.show' => 'Detail Transaksi - Admin Form Permohonan ATK',
    'admin.profile.index' => 'Profile User - Admin Form Permohonan ATK',
    'admin.profile.edit' => 'Edit Profile User - Admin Form Permohonan ATK',
];

$shortTitles = [
    'admin.index' => 'Dashboard',
    'databarang.index' => 'Data Barang',
    'databarang.create' => 'Buat Data Barang',
    'databarang.edit' => 'Edit Data Barang',
    'datatransaksi.index' => 'Data Transaksi',
    'datatransaksi.show' => 'Detail Transaksi',
    'admin.profile.index' => 'Profile',
    'admin.profile.edit' => 'Edit Profile',
];

$currentRoute = request()->route()->getName();
$pageTitle = $titles[$currentRoute] ?? 'Default Title';
$navbarTitle = $shortTitles[$currentRoute] ?? 'Default Title';
@endphp
    <title>{{ $pageTitle }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Poppins;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .custom-height {
            height: 1.7cm;
        }

        .custom-font-size {
            font-size: 0.75rem;
        }

        .custom-font-size-large {
            font-size: 1rem;
        }

        .flex-center {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        /* Flex container for sidebar and main content */
        .flex-container {
            display: flex;
            min-height: 100vh;
        }

        .navbar-title {
            display: flex;
            justify-content: space-between;
            width: 100%;
            position: fixed;
            padding: 1em;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-weight: semibold;
        }

        .title {
            margin-left: 270px;
        }

        /* Sidebar styling */
        .sidebar {
            width: 270px;
            background-color: white;
            min-height: 100vh;
            position: fixed; /* Fix the sidebar position */
            top: 0;
            left: 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000; /* Make sure sidebar stays above other content */
            padding-top: 20px; /* Add padding to the top to avoid overlap with content */
        }

        /* Main content styling */
        .main-content {
            flex-grow: 1;
            margin-top: 4em;
            margin-left: 270px; /* Add margin to ensure the content doesn't overlap with the sidebar */
            padding: 20px;
            background-color: #f5f5f5;
            height: 100vh;
            overflow-y: auto; /* Enable scrolling for the main content */
        }

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

        /*Card styling */
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
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

        /* Text styling */
        .welcome {
            text-align: center;
            color: #555;
        }

        .centered {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* card dashboard */
        .card-dashboard-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .card-dashboard {
            border-radius: 8px;
            border: 1px solid #0D47A1;
            padding: 16px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        /* Consistent box-sizing */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }
        /* Profile card styling */
        .profile-card {
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

        .print-only {
            display: none;
        }


        /* Hanya berlaku untuk media cetak */
    @media print {
        .d-print-none {
            display: none !important; /* Sembunyikan elemen saat cetak */
        }

        body {
            font-family: Arial, sans-serif;
        }

        /* Sembunyikan semua elemen kecuali tabel */
        body * {
            visibility: hidden; /* Semua elemen disembunyikan */
        }

        table, h3 {
            visibility: visible; /* Hanya tabel dan judul terlihat */
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table th, table td {
            border: 1px solid #000000;
            padding: 8px;
            text-align: left;
        }

        h3 {
            text-align: center;
            margin-bottom: 2em;
        }

        /* Pastikan tabel tetap tampil penuh */
        table {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            margin: auto;
        }
        
        .table-container, .table-container * {
        visibility: visible; /* Tampilkan tabel */
        }
    }
    </style>
</head>
<body>
    <!-- Flex container -->
    <div class="flex-container">
        <div class="navbar-title">
            <div class="text-xl">
                <h1 class="title">{{ $navbarTitle }}</h1>
            </div>
            {{-- <form onsubmit="return confirm('Apakah anda ingin log out?')" id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger"><i class="fas fa-sign-out-alt mr-2"></i><a>Log Out</a></button>
            </form>    --}}
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="ms-2 text-dark">{{ Auth::user()->name }}</span>
                    <img src="{{ !empty(Auth::user()->profile_image) ? asset('storage/' . Auth::user()->profile_image) : asset('/image/default.jpg') }}"
                    alt="Profile"
                    width="40"
                    height="40"
                    class="rounded-circle ml-3">
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="{{ route('admin.profile.index') }}"><i class="fas fa-user me-2"></i>Profile</a></li>
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
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="flex items-center justify-center p-2 py-3">
                {{-- <img alt="ditstandalitu logo" class="mx-auto" src="/image/onlylogo.svg" height="30" width="50" /> --}}
                <img src="{{ asset('/image/onlylogo.svg') }}" class="mx-auto" height="30" width="50">

                <div class="ml-1">
                    <h1 class="text-2xl font-bold">SIPERA</h1>
                    <p class="text-xs">SI Form Persediaan Barang</p>
                </div>
            </div>
            <nav class="mt-10">
                <a class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200 {{ request()->routeIs('admin.index') ? 'bg-blue-900 text-white' : '' }}" 
                   href="{{ route('admin.index') }}">
                    Dashboard
                </a>
                <a class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200 {{ request()->routeIs('databarang.index') ? 'bg-blue-900 text-white' : '' }}" 
                   href="{{ route('databarang.index') }}">
                    Data Barang
                </a>
                <a class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200 {{ request()->routeIs('datatransaksi.index') ? 'bg-blue-900 text-white' : '' }}" 
                    href="{{ route('datatransaksi.index') }}">
                     Data Transaksi
                 </a>
                <a class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200 {{ request()->routeIs('admin.profile.index') ? 'bg-blue-900 text-white' : '' }}" 
                   href="{{ route('admin.profile.index') }}">
                    Profile
                </a>
            </nav>
        </div>

        <!-- Main content -->
        <div class="main-content overflow-y-auto">
            @include('komponen.pesan')

            @yield('konten')
        </div>
    </div>

{{-- modal Logout --}}
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

    {{-- modal Delete --}}
    <div class="modal fade" id="deletetranModal" tabindex="-1" aria-labelledby="deletetranModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletetranModalLabel">Konfirmasi Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus Transaksi ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" onclick="submitDeletetranForm()">Delete</button>
                </div>
            </div>
        </div>
    </div>
    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        function previewImage(event) {
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.src = URL.createObjectURL(event.target.files[0]);
            imagePreview.onload = function () {
                URL.revokeObjectURL(imagePreview.src);
            };
        }
    
        document.getElementById('imagePreview').addEventListener('click', function () {
            document.getElementById('image_barang').click();
        });


        function printTable() {
            const printContents = document.querySelector('.table-responsive').innerHTML;
            const originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            window.location.reload(); // Reload to restore the original view
        }
    </script>
    <script>
        function printTableBarang() {
            window.print();
        }
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
        let formToDeletetran = null;
    
        function setDeletetranFormId(formId) {
            formToDeletetran = document.getElementById(formId);
        }

        function submitDeletetranForm() {
            if (formToDeletetran) {
                formToDeletetran.submit();
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
        
</body>
</html>

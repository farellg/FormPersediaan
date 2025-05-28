<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    {{-- @vite('resources/css/app.css') --}}
    <style>
        body {
            background-color: #f5f5f5;
        }
        .background-image {
            z-index: -1;
        }

        .text-image {
            backdrop-filter: invert(60%);
            font-family: Poppins;
        }
        .card {
            background-color: #ffffff;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
        }
    </style>
</head>
<body>
    @include('komponen.pesan')

    @yield('konten')


@extends('layout.template')
@section('konten')

            {{-- <div class="text-3x1 font-bold mb-6">
                <h1>Dashboard</h1>
            </div> --}}
            <p class="mb-6 welcome">Selamat datang {{ Auth::user()->name }}</p>
            <div class="card-dashboard-container">
            <a class="list-none" href="{{ route('databarang.index') }}">
                <div class="card-dashboard bg-blue-900 text-white">
                    <i class="fas fa-cube fa-5x"></i>
                    <h3>Barang</h3>
                    <p class="stock">Terdaftar: {{ $databarang }}</p>
                </div>
            </a>

            <a class="list-none" href="{{ route('datatransaksi.index') }}">
                <div class="card-dashboard bg-blue-900 text-white">
                    <i class="fas fa-newspaper fa-5x"></i>
                    <h3>Transaksi</h3>
                    <p class="stock">Terdaftar: {{ $checkout }}</p>
                </div>
            </a>
            </div>
@endsection

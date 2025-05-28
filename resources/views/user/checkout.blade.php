<!-- resources/views/user/checkout.blade.php -->

@extends('layout.template_user')

@section('konten')
<div class="container">
    <div class="navbar mb-5">
        <h1>Checkout Kebutuhan Alat Tulis Kantor (ATK)</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="title m-3 text-center font-bold">
            <h1>PERMOHONAN KEBUTUHAN ALAT TULIS KANTOR (ATK)</h1>
        </div>
        <div class="mb-3">
            <h5>Unit: {{ $unit }}</h5>
        </div>
        <div class="mb-3">
            <h5>Tanggal: {{ $tanggal }}</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th colspan="3">Kebutuhan</th>
                        <th rowspan="2">Keterangan</th>
                    </tr>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item['nama_barang'] }}</td>
                            <td>{{ $item['jumlah'] }}</td>
                            <td>{{ $item['satuan'] }}</td>
                            <td>{{ $item['keterangan'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="button-form">
            {{-- <div class="max-h-1 mr-2">
                <button onclick="printTable()" class="btn btn-info">
                    <i class="fas fa-print"></i> Print
                </button>
            </div> --}}
            <div class="max-h-1 mr-2">
                <a href="{{ route('coexportpdf') }}" class="btn btn-danger">
                    <i class="fas fa-file-pdf"></i> Download PDF
                </a>
            </div>
            <div class="max-h-1 mr-2">
                <a href="{{ route('coexportexcel') }}" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Download Excel
                </a>
            </div>    
            <div class="max-h-1">
                <a href="{{ route('user.index') }}"><button class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali</button></a>
            </div>
        </div>
    </div>
</div>
@endsection

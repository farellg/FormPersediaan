@extends('layout.template')

@section('konten')
<div class="container">

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
                <!-- Tombol Tambah Data -->
                <div class="left-side d-flex">
                        <a href="{{ route('datatransaksi.index') }}" class="btn btn-secondary mr-2">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    {{-- <div class="max-h-1 mr-2">
                        <button onclick="printTable()" class="btn btn-info">
                            <i class="fas fa-print"></i>
                        </button>
                    </div> --}}
                    <div class="max-h-1 mr-2">
                        <a href="{{ route('detailtranexportpdf', $id) }}" class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    </div>
                    <div class="max-h-1">
                        <a href="{{ route('detailtranexportexcel', $id) }}" class="btn btn-success">
                            <i class="fas fa-file-excel"></i>
                        </a>
                    </div>                    
                </div>
        </div>
    </div>
</div>
@endsection

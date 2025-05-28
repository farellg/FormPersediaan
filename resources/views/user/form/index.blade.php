@extends('layout.template_user')

@section('konten')

<div class="container">
    <div class="navbar mb-5">
        <h1>Form Kebutuhan Alat Tulis Kantor (ATK)</h1>
    </div>

    {{-- @if($forms->isEmpty())
        <p>Belum ada data form.</p>
    @endif --}}

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="my-3 p-3 bg-body rounded shadow-sm table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ $item->satuan }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>
                            <a href="{{ route('form.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            {{-- <form action="{{ route('form.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Del</button>
                            </form> --}}
                            {{-- Modal Delete --}}
                            <form id="delete-form-{{ $item->id }}" action="{{ route('form.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" 
                                    onclick="setDeleteFormId('delete-form-{{ $item->id }}')">
                                    Del
                                </button>
                            </form>
                                                        
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada barang dalam form.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="text-center">
            <a href="{{ route('user.index') }}"><button class="btn btn-success btn-md w-100">Lanjut Pilih</button></a>
        </div>
    </div>
        
<!-- Form Checkout -->
    <div class="d-flex justify-content-center">
        <form action="{{ route('checkout') }}" method="POST" class="w-50">
            @csrf
            <div class="my-3 p-4 bg-body rounded shadow-sm">
                <div class="font-bold text-center mb-2">Masukkan Unit dan Tanggal sebelum Check Out</div>
                <!-- Input untuk Unit dan Tanggal -->
                <div class="mb-3">
                    <label for="unit" class="form-label">Unit</label>
                    <input type="text" class="form-control" id="unit" name="unit" value="{{ old('unit') }}" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    {{-- <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required> --}}
                    <input type="text" class="form-control" id="tanggal" name="tanggal" placeholder="dd/mm/yyyy"" required>
                </div>
                
                <!-- Simpan data barang yang dipilih -->
                <input type="hidden" name="items" value="{{ json_encode($items) }}">

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-md w-100" {{ empty($items) ? 'disabled' : '' }}>Check Out</button>
                </div>
            </div>
        </form>
    </div>
@endsection

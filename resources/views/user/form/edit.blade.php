@extends('layout.template_user')
@section('konten')

<div class="container-edit">
    <h1>Edit Kebutuhan ATK</h1>
    <form action="{{ route('form.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" 
                   value="{{ $item->nama_barang }}" disabled>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" 
                   class="form-control" 
                   id="jumlah" 
                   name="jumlah" 
                   value="{{ old('jumlah', $item->jumlah) }}" 
                   required 
                   min="1"
                   max="{{ $item->saldo_disistem }}" 
            oninput="validateInput(this)">
        </div>

        <div class="mb-3">
            <label for="satuan" class="form-label">Satuan</label>
            <input type="text" class="form-control" id="satuan" name="satuan" 
                   value="{{ $item->satuan }}" disabled>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <input type="text" class="form-control" id="keterangan" name="keterangan" 
                   value="{{ $item->keterangan }}">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('form.index') }}" class="btn btn-secondary">Batal</a>
    </form>
    </div>
</div>

@endsection

@extends('layout.template')
@section('konten')


<!-- FORM -->
<form action='{{ url('admin/databarang') }}' method='post' enctype="multipart/form-data">
@csrf
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <a href='{{ url('admin/databarang') }}' class="btn btn-secondary mb-5"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
    <div class="mb-3">
        <label for="kode_barang" class="form-label">Kode Barang</label>
        <input type="number" class="form-control" name='kode_barang' value="{{ Session::get('kode_barang') }}" kode_barang">
    </div>
    <div class="mb-3">
        <label for="image_barang" class="form-label">Image Barang</label>
        <div class="image-upload-wrapper">
            <img id="imagePreview" src="{{ asset ('/image/150.png')}}" alt="Image Preview" class="img-thumbnail mb-2 m-auto" style="width: 100%; max-width: 150px; cursor: pointer;" />
            <input type="file" class="form-control" name="image_barang" value="{{ Session::get('image_barang') }}" id="image_barang" accept="image/*" style="display: none;" onchange="previewImage(event)">
            <p class="text-muted text-center mt-2">Klik gambar untuk memilih foto barang</p>
        </div>
    </div>
    <div class="mb-3">
        <label for="nama_barang" class="form-label">Nama Barang</label>
        <input type="text" class="form-control" name='nama_barang' value="{{ Session::get('nama_barang') }}" id="nama_barang">
    </div>
    <div class="mb-3">
        <label for="satuan" class="form-label">Satuan</label>
        <input type="text" class="form-control" name='satuan' value="{{ Session::get('satuan') }}" id="satuan">
    </div>
    <div class="mb-3">
        <label for="saldo_disistem" class="form-label">Saldo Di Sistem</label>
        <input type="text" class="form-control" name='saldo_disistem' value="{{ Session::get('saldo_disistem') }}" id="saldo_disistem">
    </div>
    <div class="button-simpan right-0">
        <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
    </div>
</div>
</form>
<!-- AKHIR MODAL TAMBAH DATA -->
@endsection


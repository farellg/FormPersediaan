@extends('layout.template_user')
@section('konten')

@if($databarang->isEmpty())
<div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
    <h2 class="text-muted text-center"><i class="fa-solid fa-circle-exclamation"></i> Belum ada barang yang tersedia.</h2>
</div>
@else
    <div class="container card-container">
        @foreach ($databarang as $item)
            <div class="card">
                @if($item->image_barang && file_exists(public_path('storage/uploads/databarang/' . $item->image_barang)))
                    <img src="{{ asset('storage/uploads/databarang/' . $item->image_barang) }}" alt="Uploaded Image">
                @else
                    <img src="{{ asset('image/150.png') }}" alt="Default Image">
                @endif
                <h3>{{ $item->nama_barang }}</h3>
                <div class="stok-satuan">
                    @if($item->saldo_disistem > 0)
                        <p class="stock">Stok: {{ $item->saldo_disistem }} {{ $item->satuan }}</p>
                    @else
                        <p class="stock text-danger">Stok: Habis</p>
                    @endif
                </div>                

                <!-- Form untuk menambahkan barang ke form kebutuhan -->
                <form action="{{ route('form.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="nama_barang" value="{{ $item->nama_barang }}">
                    <input type="hidden" name="satuan" value="{{ $item->satuan }}">
                    
                    <div class="quantity-input">
                        <button type="button" class="btn btn-outline-secondary" onclick="this.nextElementSibling.stepDown()" {{ $item->saldo_disistem <= 0 ? 'disabled' : '' }}>-</button>
                        <input type="number" 
                            name="jumlah" 
                            min="1" 
                            max="{{ $item->saldo_disistem }}" 
                            value="1" 
                            class="form-control text-center"
                            oninput="validateInput(this)"
                            {{ $item->saldo_disistem <= 0 ? 'disabled' : '' }}>
                        <button type="button" class="btn btn-outline-secondary" onclick="this.previousElementSibling.stepUp()" {{ $item->saldo_disistem <= 0 ? 'disabled' : '' }}>+</button>
                    </div>
                    <button type="input" class="btn btn-primary" {{ $item->saldo_disistem <= 0 ? 'disabled' : '' }}><i class="fas fa-shopping-cart fa-lg"></i></button>
                </form>
            </div>
        @endforeach
    </div>
    @endif

    {{ $databarang->withQueryString()->links() }}
@endsection

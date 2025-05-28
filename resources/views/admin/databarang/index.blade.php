@extends('layout.template')
@section('konten')
            <div class="container-head d-flex justify-between">
                <!-- Tombol Tambah Data -->
                <div class="left-side d-flex">
                    <div class="pb-3">
                        <a href='{{ url('admin/databarang/create') }}' class="btn btn-primary mr-2">+ Tambah Barang</a>
                    </div>
                    {{-- <div class="max-h-1 mr-2">
                        <button onclick="printTableBarang()" class="btn btn-info">
                            <i class="fas fa-print"></i>
                        </button>
                    </div> --}}
                    <div class="max-h-1 mr-2">
                        <a href="{{ url('admin/exportpdf') }}" class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    </div>
                    <div class="max-h-1">
                        <a href="{{ url('admin/exportexcel') }}" class="btn btn-success">
                            <i class="fas fa-file-excel"></i>
                        </a>
                    </div>                    
                </div>
                <!-- FORM PENCARIAN -->
                <div class="items-right pb-3">
                    <form class="d-flex" action="{{ url('admin/databarang') }}" method="get">
                        <input class="form-control ml-2" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Cari barang" aria-label="Search">
                        <button class="btn btn-secondary" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
            
        <div class="table-container">
            <div class="my-3 p-3 bg-body rounded shadow-sm table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th class="d-print-none">Image Barang</th>
                            <th>Nama Barang</th>
                            <th>Satuan</th>
                            <th>Saldo di Sistem</th>
                            <th class="d-print-none">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $data->firstItem() ?>
                        @forelse ($data as $item)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $item->kode_barang }}</td>
                            <td class="d-print-none">
                                @if($item->image_barang && file_exists(public_path('storage/uploads/databarang/' . $item->image_barang)))
                                    <img src="{{ asset('storage/uploads/databarang/' . $item->image_barang) }}" alt="Uploaded Image" width="100">
                                @else
                                    <img src="{{ asset('image/150.png') }}" alt="Default Image" width="100">
                                @endif
                            </td>                                                        
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->satuan }}</td>
                            <td>{{ $item->saldo_disistem }}</td>
                            <td class="d-print-none">
                                <a href="{{ url('admin/databarang/'.$item->kode_barang.'/edit') }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                {{-- <form onsubmit="return confirm('Yakin akan menghapus data?')" class='d-inline' action="{{ url('admin/databarang/'.$item->kode_barang) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form> --}}

                                {{-- Modal Delete --}}
                                <form id="delete-form-{{ $item->kode_barang }}" action="{{ route('databarang.destroy', $item->kode_barang) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" 
                                        onclick="setDeleteFormId('delete-form-{{ $item->kode_barang }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>                                
                            </td>
                        </tr>
                        <?php $i++ ?>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada Barang.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-print-none">{{ $data->withQueryString()->links() }}</div>
            </div>
        </div>
@endsection
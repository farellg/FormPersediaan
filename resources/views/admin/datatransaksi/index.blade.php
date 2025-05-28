@extends('layout.template')
@section('konten')

            <div class="container-head d-flex justify-between">
                <!-- Tombol Tambah Data -->
                <div class="left-side d-flex">
                    {{-- <div class="max-h-1 mr-2">
                        <button onclick="printTable()" class="btn btn-info">
                            <i class="fas fa-print"></i>
                        </button>
                    </div> --}}
                    <div class="max-h-1 mr-2">
                        <a href="{{ route('tran.export.pdf', ['tahun' => request('tahun'), 'bulan' => request('bulan'), 'katakunci' => request('katakunci')]) }}" class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    </div>
                    <div class="max-h-1">
                        <a href="{{ route('tran.export.excel', ['tahun' => request('tahun'), 'bulan' => request('bulan'), 'katakunci' => request('katakunci')]) }}" class="btn btn-success">
                            <i class="fas fa-file-excel"></i>
                        </a>
                    </div>                    
                </div>
                <!-- FORM PENCARIAN -->
                <div class="items-right pb-3">
                    <form id="filterForm" action="{{ url('admin/datatransaksi') }}" method="get" class="d-flex">
                        <select class="form-select me-2" name="tahun" onchange="document.getElementById('filterForm').submit();">
                            <option value="">Pilih Tahun</option>
                            @foreach ($tahunList as $thn)
                                <option value="{{ $thn }}" {{ request('tahun') == $thn ? 'selected' : '' }}>{{ $thn }}</option>
                            @endforeach
                        </select>
                    
                        <select class="form-select me-2" name="bulan" onchange="document.getElementById('filterForm').submit();">
                            <option value="">Pilih Bulan</option>
                            @foreach (range(1,12) as $bln)
                                <option value="{{ $bln }}" {{ request('bulan') == $bln ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($bln)->isoFormat('MMMM') }}
                                </option>
                            @endforeach
                        <input class="form-control ml-2" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Cari" aria-label="Search">
                        <button class="btn btn-secondary" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>

            <div class="my-3 p-3 bg-body rounded shadow-sm table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Unit</th>
                            <th>Tanggal</th>
                            <th>Items</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $data->firstItem() ?>
                        @forelse ($data as $item)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $item->unit }}</td>                                                      
                            <td>{{ $item->tanggal}}</td>
                            <td>
                                @if(is_array($item->items)) 
                                    @foreach ($item->items as $singleItem)
                                        <p>{{ $singleItem['nama_barang'] }} - {{ $singleItem['jumlah'] }} {{ $singleItem['satuan'] }}</p>
                                    @endforeach
                                @else
                                    <p>No items available</p>
                                @endif
                            </td>                                                                
                            <td>
                                <a href="{{ route('datatransaksi.show', $item->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-search"></i></a>
                                {{-- <form onsubmit="return confirm('Yakin akan menghapus data?')" class='d-inline' action="{{ url('admin/datatransaksi/'.$item->unit) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form> --}}

                                <form id="delete-form-{{ $item->id }}" action="{{ route('datatransaksi.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletetranModal" 
                                        onclick="setDeletetranFormId('delete-form-{{ $item->id }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                
                                
                            </td>
                        </tr>
                        <?php $i++ ?>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada Transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $data->withQueryString()->links() }}
            </div>

        <!-- Include Modal -->
@endsection
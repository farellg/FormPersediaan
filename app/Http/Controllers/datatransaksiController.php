<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\checkout;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\datatransaksiExport;
use App\Exports\detailtransaksiExport;
use Carbon\Carbon;

class datatransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $jumlahbaris = 10;
    
        $query = Checkout::query();
    
        if ($katakunci) {
            $katakunci = str_replace('/', '-', $katakunci);
            $tanggalFormatted = null;
            if (preg_match('/\d{2}-\d{2}-\d{4}/', $katakunci)) {
                try {
                    $tanggalFormatted = \Carbon\Carbon::createFromFormat('d-m-Y', $katakunci)->format('Y-m-d');
                } catch (\Exception $e) {
                    $tanggalFormatted = null;
                }
            }
    
            $query->where(function($q) use ($katakunci, $tanggalFormatted) {
                $q->where('unit', 'like', "%$katakunci%")
                  ->orWhere('items', 'like', "%$katakunci%");
                if ($tanggalFormatted) {
                    $q->orWhere('tanggal', 'like', "%$tanggalFormatted%");
                }
            });
        }
    
        if ($tahun) {
            $query->whereYear('tanggal', $tahun);
        }
    
        if ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        }
    
        $data = $query->orderBy('tanggal', 'asc')->paginate($jumlahbaris);
    
        foreach ($data as $item) {
            if (is_string($item->items)) {
                $item->items = json_decode($item->items, true);
            }
            $item->tanggal = \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y');
        }
    
        // Ambil semua tahun unik untuk dropdown
        $tahunList = Checkout::selectRaw('YEAR(tanggal) as tahun')->distinct()->pluck('tahun');
    
        return view('admin.datatransaksi.index', compact('data', 'tahunList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Cari data transaksi berdasarkan ID
        $transaksi = checkout::findOrFail($id);

        // Decode items jika data disimpan sebagai JSON
        $items = is_string($transaksi->items) ? json_decode($transaksi->items, true) : $transaksi->items;

        $transaksi->tanggal = Carbon::parse($transaksi->tanggal)->format('d-m-Y');

        // Kembalikan view dengan data transaksi
        return view('admin.datatransaksi.show', [
            'unit' => $transaksi->unit,
            'tanggal' => $transaksi->tanggal,
            'items' => $items,
            'id' => $id,
        ]);

        /*$transaksi = checkout::find($id);

        // Jika transaksi tidak ditemukan, kembalikan error
        if (!$transaksi) {
            return redirect()->route('datatransaksi.index')->with('error', 'Transaksi tidak ditemukan.');
        }

        // Decode items jika data disimpan dalam format JSON
        $items = is_string($transaksi->items) ? json_decode($transaksi->items, true) : $transaksi->items;

        // Tampilkan view detail transaksi
        return view('admin.datatransaksi.show', [
            'unit' => $transaksi->unit,
            'tanggal' => $transaksi->tanggal,
            'items' => $items,
        ]);*/
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        checkout::findOrFail($id)->delete();
        return redirect()->route('datatransaksi.index')->with('success', 'Berhasil melakukan delete data transaksi.');
    }

    // public function tranexportPDF()
    // {
    // $data = checkout::all(); // Ambil data transaki
    // $pdf = PDF::loadView('admin.tran_exportpdf', ['data' => $data]);
    // foreach ($data as $item) {
    //     if (is_string($item->items)) {
    //         $item->items = json_decode($item->items, true); // Decode JSON menjadi array
    //     }
    //     $item->tanggal = Carbon::parse($item->tanggal)->format('d-m-Y');
    // }
    // return $pdf->download('DataTransaksi.pdf');
    // }

    public function tranexportPDF(Request $request)
    {
        $query = checkout::query();
        $tanggalCetak = now()->format('d/m/Y');

        // Filter
        if ($request->tahun) {
            $query->whereYear('tanggal', $request->tahun);
        }

        if ($request->bulan) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        if ($request->katakunci) {
            $katakunci = str_replace('/', '-', $request->katakunci);
            $tanggalFormatted = null;
            if (preg_match('/\d{2}-\d{2}-\d{4}/', $katakunci)) {
                try {
                    $tanggalFormatted = \Carbon\Carbon::createFromFormat('d-m-Y', $katakunci)->format('Y-m-d');
                } catch (\Exception $e) {
                    $tanggalFormatted = null;
                }
            }

            $query->where(function($q) use ($katakunci, $tanggalFormatted) {
                $q->where('unit', 'like', "%$katakunci%")
                ->orWhere('items', 'like', "%$katakunci%");
                if ($tanggalFormatted) {
                    $q->orWhere('tanggal', 'like', "%$tanggalFormatted%");
                }
            });
        }

        $data = $query->orderBy('tanggal', 'asc')->get();

        foreach ($data as $item) {
            if (is_string($item->items)) {
                $item->items = json_decode($item->items, true);
            }
            $item->tanggal = Carbon::parse($item->tanggal)->format('d-m-Y');
        }

        $pdf = PDF::loadView('admin.tran_exportpdf', ['data' => $data, 'tanggalCetak' => $tanggalCetak]);

        return $pdf->download('Laporan_DataTransaksi.pdf');
    }

    public function tranexportExcel(Request $request)
    {
        $query = checkout::query();
        $tanggalCetak = Carbon::now()->format('d/m/Y'); 

        // Filter sama seperti PDF
        if ($request->tahun) {
            $query->whereYear('tanggal', $request->tahun);
        }

        if ($request->bulan) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        if ($request->katakunci) {
            $katakunci = str_replace('/', '-', $request->katakunci);
            $tanggalFormatted = null;
            if (preg_match('/\d{2}-\d{2}-\d{4}/', $katakunci)) {
                try {
                    $tanggalFormatted = \Carbon\Carbon::createFromFormat('d-m-Y', $katakunci)->format('Y-m-d');
                } catch (\Exception $e) {
                    $tanggalFormatted = null;
                }
            }

            $query->where(function($q) use ($katakunci, $tanggalFormatted) {
                $q->where('unit', 'like', "%$katakunci%")
                ->orWhere('items', 'like', "%$katakunci%");
                if ($tanggalFormatted) {
                    $q->orWhere('tanggal', 'like', "%$tanggalFormatted%");
                }
            });
        }

        $data = $query->orderBy('tanggal', 'asc')->get();

        return Excel::download(new datatransaksiExport($tanggalCetak,$data), 'Laporan_DataTransaksi.xlsx');
    }



    // public function tranexportExcel()
    // {      
    // return Excel::download(new datatransaksiExport, 'DataTransaksi.xlsx');
    // }

    public function detailtranexportPDF($id)
    {
        $transaksi = Checkout::findOrFail($id); // Cari transaksi berdasarkan ID
        $transaksi->items = is_string($transaksi->items)
            ? json_decode($transaksi->items, true) // Pastikan `items` adalah array
            : $transaksi->items;

        $transaksi->tanggal = Carbon::parse($transaksi->tanggal)->format('d-m-Y');
        
        $pdf = PDF::loadView('admin.detailtran_exportpdf', [
            'unit' => $transaksi->unit,
            'tanggal' => $transaksi->tanggal,
            'items' => $transaksi->items,
        ]);

        return $pdf->download('DetailDataTransaksi.pdf');
    }

    public function detailTranExportExcel($id)
    {
    $transaksi = Checkout::findOrFail($id); // Cari transaksi berdasarkan ID
    $transaksi->items = is_string($transaksi->items)
        ? json_decode($transaksi->items, true)
        : $transaksi->items;

    $transaksi->tanggal = Carbon::parse($transaksi->tanggal)->format('d-m-Y');

    $data = [
        'unit' => $transaksi->unit,
        'tanggal' => $transaksi->tanggal,
        'items' => $transaksi->items,
    ];

    return Excel::download(new detailtransaksiExport($data), 'DetailTransaksi.xlsx');
    }

}

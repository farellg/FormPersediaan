<?php

namespace App\Http\Controllers;

use App\Models\databarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\databarangExport;

class databarangController extends Controller
{
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 5;
        $data = databarang::query()
            ->when($katakunci, function ($query) use ($katakunci) {
                $query->where('kode_barang', 'like', "%$katakunci%")
                      ->orWhere('nama_barang', 'like', "%$katakunci%")
                      ->orWhere('satuan', 'like', "%$katakunci%")
                      ->orWhere('saldo_disistem', 'like', "%$katakunci%");
            })
            ->orderBy('kode_barang', 'asc')
            ->paginate($jumlahbaris);

        return view('admin.databarang.index', compact('data'));
    }

    public function create()
    {
        return view('admin.databarang.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|numeric|unique:databarang,kode_barang',
            'nama_barang' => 'required',
            'satuan' => 'required',
            'saldo_disistem' => 'required|numeric',
            'image_barang' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
        ],[
            'kode_barang.required' => 'Kode barang wajib diisi.',
            'kode_barang.numeric' => 'Kode barang harus berupa angka.',
            'kode_barang.unique' => 'Kode barang sudah terdaftar.',  
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'satuan.required' => 'Satuan wajib diisi.',
            'saldo_disistem.required' => 'Saldo di sistem wajib diisi.',
            'saldo_disistem.numeric' => 'Saldo di sistem harus berupa angka.',
            'image_barang.image' => 'File harus berupa gambar.',
            'image_barang.mimes' => 'Gambar harus berformat jpeg, png, atau jpg.',
            'image_barang.max' => 'Ukuran gambar maksimal 5MB.',
        ]);

        // Proses upload gambar
        if ($request->hasFile('image_barang')) {
            $file = $request->file('image_barang');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads/databarang', $fileName, 'public');
            $validated['image_barang'] = $fileName;
        }

        databarang::create($validated);

        return redirect()->route('databarang.index')->with('success', 'Berhasil menambahkan barang');
    }

    public function edit(string $id)
    {
        $data = databarang::where('kode_barang', $id)->firstOrFail();
        return view('admin.databarang.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'kode_barang' => "required|numeric|unique:databarang,kode_barang,$id,kode_barang",
            'nama_barang' => 'required',
            'satuan' => 'required',
            'saldo_disistem' => 'required|numeric',
            'image_barang' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
        ],[
            'kode_barang.required' => 'Kode barang wajib diisi.',
            'kode_barang.numeric' => 'Kode barang harus berupa angka.',
            'kode_barang.unique' => 'Kode barang sudah terdaftar.',  
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'satuan.required' => 'Satuan wajib diisi.',
            'saldo_disistem.required' => 'Saldo di sistem wajib diisi.',
            'saldo_disistem.numeric' => 'Saldo di sistem harus berupa angka.',
            'image_barang.image' => 'File harus berupa gambar.',
            'image_barang.mimes' => 'Gambar harus berformat jpeg, png, atau jpg.',
            'image_barang.max' => 'Ukuran gambar maksimal 5MB.',
        ]);

        if ($request->hasFile('image_barang')) {
            $file = $request->file('image_barang');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads/databarang', $fileName, 'public');
            $validated['image_barang'] = $fileName;
        }

        databarang::where('kode_barang', $id)->update($validated);

        return redirect()->route('databarang.index')->with('success', 'Berhasil melakukan update barang');
    }

    public function destroy(string $id)
    {
        $data = databarang::where('kode_barang', $id)->first();
        if ($data) {
            $data->delete();
        }

        return redirect()->route('databarang.index')->with('success', 'Berhasil melakukan delete barang');
    }

    public function exportPDF()
    {
        $data = databarang::all();
        $tanggalCetak = now()->format('d/m/Y');

        $pdf = PDF::loadView('admin.exportpdf', compact('data','tanggalCetak'));
        return $pdf->download('Laporan_DataBarang.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new databarangExport, 'Laporan_DataBarang.xlsx');
    }
}

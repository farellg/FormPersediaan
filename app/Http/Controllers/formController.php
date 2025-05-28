<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\databarang;
use App\Models\form;
use Illuminate\Support\Facades\Auth;


class formController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data dari session
        /*$items = DB::table('form')->get();

        return view('user.form.index', compact('items'));*/

        $forms = Auth::user()->forms; 
        $items = Form::where('user_id', Auth::id())->get();
        return view('user.form.index', compact('items'));
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
        $request->validate([
            'nama_barang' => 'required',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required',
            'keterangan' => 'nullable|string',
            /*'unit' => 'required|string|max:255',
            'tanggal' => 'required|date'*/
        ]);

        $databarang = Databarang::where('nama_barang', $request->nama_barang)->first();
        if (!$databarang || $databarang->saldo_disistem < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok barang tidak mencukupi.');
        }

        Form::create([
            'user_id' => Auth::id(),
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'keterangan' => $request->keterangan,
            /*'unit' => $request->unit,
            'tanggal' => $request->tanggal,*/
        ]);

        // Kurangi stok di databarang
        $databarang->decrement('saldo_disistem', $request->jumlah);

        return redirect()->route('form.index')->with('success', 'Barang berhasil ditambahkan ke form.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Form::findOrFail($id); // Menggunakan primary key id

        // Ambil data barang terkait untuk mendapatkan saldo_disistem
        $databarang = Databarang::where('nama_barang', $item->nama_barang)->first();

        // Pastikan saldo_disistem tersedia
        if (!$databarang) {
            return redirect()->route('form.index')->with('error', 'Data barang tidak ditemukan.');
        }

        // Tambahkan saldo_disistem ke item agar bisa digunakan di view
        $item->saldo_disistem = $databarang->saldo_disistem;

        return view('user.form.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $form = Form::findOrFail($id);

        // Ambil data barang dari tabel databarang berdasarkan nama_barang di form
        $databarang = Databarang::where('nama_barang', $form->nama_barang)->first();

        // Validasi data input
        $request->validate([
            'jumlah' => 'required|integer|min:1|max:' . $databarang->saldo_disistem,
            'keterangan' => 'nullable|string|max:255',
            /*'unit' => 'required|string|max:255',
            'tanggal' => 'required|date',*/
        ]);

        // Hitung selisih jumlah baru dan lama
        $difference = $request->jumlah - $form->jumlah;

        // Periksa apakah stok mencukupi
        if ($difference > 0 && $databarang->saldo_disistem < $difference) {
            return redirect()->back()->with('error', 'Stok barang tidak mencukupi.');
        }

        // Update data form
        $form->update([
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            /*'unit' => $request->unit,
            'tanggal' => $request->tanggal,*/
        ]);

        // Update saldo barang
        $databarang->decrement('saldo_disistem', $difference);

        return redirect()->route('form.index')->with('success', 'Form berhasil diperbarui.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $form = Form::findOrFail($id);
        $databarang = Databarang::where('nama_barang', $form->nama_barang)->first();

        // Kembalikan stok barang
        $databarang->increment('saldo_disistem', $form->jumlah);

        $form->delete();
        return redirect()->route('form.index')->with('success', 'Barang berhasil dihapus dari form.');
       
    }
}

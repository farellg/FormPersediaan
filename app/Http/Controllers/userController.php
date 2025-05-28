<?php

namespace App\Http\Controllers;

use App\Models\databarang;
use Illuminate\Http\Request;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $databarang = databarang::all();
        // $databarang = databarang::orderBy('nama_barang', 'asc')->paginate(5); // Menampilkan 10 item per halaman
        // return view('user.index', compact('databarang'));

        $katakunci = $request->katakunci; // Ambil parameter pencarian
        $jumlahbaris = 10;

        // Query data dengan filter pencarian
        $databarang = databarang::when($katakunci, function ($query, $katakunci) {
            return $query->where('nama_barang', 'like', "%$katakunci%");
        })->orderBy('nama_barang', 'asc')->paginate($jumlahbaris);

        return view('user.index', compact('databarang', 'katakunci'));
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
    public function show(string $id)
    {
        //
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
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\databarang;
use App\Models\checkout;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index()
    {
    $databarang = databarang::all();
    $databarang = Databarang::count();
    $checkout = checkout::all();
    $checkout = Checkout::count(); // Mengambil jumlah checkout yang sudah ada
    return view('admin.index', compact('databarang','checkout'));
    }

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


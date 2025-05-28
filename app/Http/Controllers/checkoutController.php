<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\form;
use App\Models\checkout;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\coExport;


class checkoutController extends Controller
{
    public function showCheckout(Request $request)
    {
        // Ambil data yang dikirim dari form
        $checkout = Checkout::latest()->first(); // Ambil data terakhir checkout

        if (!$checkout) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $unit = $checkout->unit;
        // $tanggal = $checkout->tanggal;
        $tanggal = \Carbon\Carbon::parse($checkout->tanggal)->format('d-m-Y');
        $items = $checkout->items; // Sudah dalam format array karena cast
        
        return view('user.checkout', compact('unit', 'tanggal', 'items'));
    }

    public function checkout(Request $request)
    {
        // Validasi dan simpan data checkout
        $validated = $request->validate([
            'unit' => 'required|string|max:255',
            // 'tanggal' => 'required|date',
            'tanggal' => 'required|date_format:d/m/Y',
            'items' => 'required|json', // Pastikan items adalah array
        ]);
        
        $items = json_decode($request->items, true); // This will be an array

        // ❗Cek apakah items kosong
        if (empty($items)) {
            return redirect()->route('form.index')->with('error', 'Form harus terisi sebelum melakukan checkout.');
        }

        $tanggal = \Carbon\Carbon::createFromFormat('d/m/Y', $request->tanggal)->format('Y-m-d');

        // Simpan data checkout, misalnya ke model Checkout
        Checkout::create([
             'unit' => $validated['unit'],
            //  'tanggal' => $validated['tanggal'],
             'tanggal' => $tanggal,
             'items' => $items,
         ]);

        Form::whereIn('id', array_column($items, 'id'))->delete(); // Hapus berdasarkan ID barang yang dipilih

        return redirect()->route('checkout.show')->with('success', 'Checkout berhasil!');
    }

    public function coexportPDF()
    {
    $checkout = Checkout::latest()->first(); // Ambil data terakhir checkout

    if (!$checkout) {
        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }

    $unit = $checkout->unit;
    // $tanggal = $checkout->tanggal;
    $tanggal = \Carbon\Carbon::parse($checkout->tanggal)->format('d-m-Y');
    $items = $checkout->items; // Sudah dalam format array karena cast

    $pdf = Pdf::loadView('user.co_exportpdf', compact('unit', 'tanggal', 'items'));

    // Nama file download PDF
    $fileName = 'Bukti_Checkout_' . date('Y-m-d') . '.pdf';

    return $pdf->download($fileName); // Mengunduh file PDF
    }

    public function coexportExcel()
    {
    $fileName = 'Bukti_Checkout_' . date('Y-m-d') . '.xlsx';
    return Excel::download(new coExport, $fileName);
    }

    
}

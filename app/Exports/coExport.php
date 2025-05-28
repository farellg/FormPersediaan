<?php

namespace App\Exports;

use App\Models\Checkout;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


class coExport implements FromArray, WithEvents
{
    protected $checkout;

    public function __construct()
    {
        $this->checkout = Checkout::latest()->first(); // Ambil data terakhir checkout
    }

    public function array(): array
    {
        if (!$this->checkout) {
            return []; // Jika tidak ada data, return array kosong
        }

        // Format data tabel
        return collect($this->checkout->items)->map(function ($item, $index) {
            return [
                'No' => $index + 1,
                'Nama Barang' => $item['nama_barang'],
                'Jumlah' => $item['jumlah'],
                'Satuan' => $item['satuan'],
                'Keterangan' => $item['keterangan'],
            ];
        })->toArray();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $checkout = $this->checkout;

                if (!$checkout) {
                    return;
                }

                // Tambahkan header dan informasi tambahan
                $sheet->setCellValue('A1', 'PERMOHONAN KEBUTUHAN ALAT TULIS KANTOR (ATK)');
                $sheet->setCellValue('A2', 'Unit: ' . $checkout->unit);
                $sheet->setCellValue('A3', 'Tanggal: ' . \Carbon\Carbon::createFromFormat('Y-m-d', $checkout->tanggal)->format('d/m/Y'));

                $sheet->getStyle('A1')->applyFromArray([
                    'alignment' => [
                        'horizontal' => 'center',
                    ],
                ]);

                // Gabungkan sel untuk header
                $sheet->mergeCells('A1:F1');
                $sheet->mergeCells('A2:E2');
                $sheet->mergeCells('A3:E3');

                // Style untuk header
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('A2:A3')->getFont()->setBold(true);

                // Tambahkan heading tabel
                $sheet->setCellValue('A5', 'No');
                $sheet->setCellValue('B5', 'Kebutuhan');
                $sheet->setCellValue('E5', 'Keterangan');

                // Gabungkan sel untuk header tabel
                $sheet->mergeCells('A5:A6'); // Header "No" dengan rowspan
                $sheet->mergeCells('B5:D5'); // Header "Kebutuhan" dengan colspan
                $sheet->mergeCells('E5:E6'); // Header "Keterangan" dengan rowspan

                // Header tabel baris kedua
                $sheet->setCellValue('B6', 'Nama Barang');
                $sheet->setCellValue('C6', 'Jumlah');
                $sheet->setCellValue('D6', 'Satuan');

                // Style header tabel
                $sheet->getStyle('A5:E6')->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => [
                        'horizontal' => 'center',
                        'vertical' => 'center',
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Tambahkan data tabel mulai dari baris 7
                $row = 7;
                $data = $this->array();

                foreach ($data as $item) {
                    $sheet->setCellValue('A' . $row, $item['No']);
                    $sheet->setCellValue('B' . $row, $item['Nama Barang']);
                    $sheet->setCellValue('C' . $row, $item['Jumlah']);
                    $sheet->setCellValue('D' . $row, $item['Satuan']);
                    $sheet->setCellValue('E' . $row, $item['Keterangan']);
                    $row++;
                }

                // Tambahkan baris kosong untuk mencapai 20 baris
                while ($row <= 26) { // Baris 7-26 (20 baris data)
                    $sheet->setCellValue('A' . $row, '');
                    $sheet->setCellValue('B' . $row, '');
                    $sheet->setCellValue('C' . $row, '');
                    $sheet->setCellValue('D' . $row, '');
                    $sheet->setCellValue('E' . $row, '');
                    $row++;
                }

                // Tambahkan border untuk semua data tabel
                $sheet->getStyle('A5:E26')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Tambahkan area tanda tangan
                $row += 2; // Tambahkan jarak sebelum tanda tangan
                $sheet->setCellValue('B' . $row, 'Pemohon');
                $sheet->setCellValue('C' . $row, 'Petugas Gudang');
                $sheet->setCellValue('D' . $row, 'Operator Persediaan');

                $row += 4; // Tambahkan spasi untuk tanda tangan
                $sheet->setCellValue('B' . $row, '(........................................)');
                $sheet->setCellValue('C' . $row, '(Reffi)');
                $sheet->setCellValue('D' . $row, '(Aji Prastia)');

                $row += 3;
                $sheet->setCellValue('C' . $row, 'Mengetahui');
                // $sheet->getStyle('C' . $row)->getFont()->setBold(true);
    
                $row += 1;
                $sheet->setCellValue('C' . $row, 'Kepala Sub Bagian Tata Usaha');
    
                $row += 4;
                $sheet->setCellValue('C' . $row, '(M. Arief Setyadi)');
    
                $sheet->getStyle('B' . ($row - 15) . ':D' . $row)->applyFromArray([
                    'alignment' => [
                        'horizontal' => 'center',
                    ],
                ]);

                // Atur lebar kolom agar data terlihat rapi
                foreach (range('A', 'E') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}

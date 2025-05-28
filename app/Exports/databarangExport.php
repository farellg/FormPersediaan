<?php

namespace App\Exports;

use App\Models\databarang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Carbon\Carbon;

class databarangExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithEvents
{
    public function collection()
    {
        return databarang::all()->map(function ($item) {
            return [
                'kode_barang' => $item->kode_barang,
                'nama_barang' => $item->nama_barang,
                'satuan' => $item->satuan,
                'saldo_disistem' => $item->saldo_disistem,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Kode Barang',
            'Nama Barang',
            'Satuan',
            'Saldo di Sistem',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            'A1:D1' => [
                'font' => [
                    'bold' => true,
                    'size' => 16,
                ],
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center',
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 30,
            'C' => 15,
            'D' => 20,
        ];
    }

    public function registerEvents(): array
    {
        return [
            \Maatwebsite\Excel\Events\AfterSheet::class => function (\Maatwebsite\Excel\Events\AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Judul
                $sheet->setCellValue('A1', 'Laporan Data Barang ATK');
                $sheet->mergeCells('A1:D1');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                    ],
                    'alignment' => [
                        'horizontal' => 'center',
                        'vertical' => 'center',
                    ],
                ]);

                // Tanggal Cetak
                $tanggalCetak = Carbon::now()->format('d/m/Y');
                $sheet->setCellValue('A2', 'Tanggal Cetak: ' . $tanggalCetak);
                $sheet->mergeCells('A2:D2');
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => [
                        'italic' => true,
                        'size' => 10,
                    ],
                    'alignment' => [
                        'horizontal' => 'right',
                    ],
                ]);

                // Headings
                $sheet->fromArray($this->headings(), null, 'A3', true);

                // Data mulai dari A4
                $startRow = 4;
                $data = $this->collection();
                foreach ($data as $index => $item) {
                    $sheet->setCellValue('A' . ($startRow + $index), $item['kode_barang']);
                    $sheet->setCellValue('B' . ($startRow + $index), $item['nama_barang']);
                    $sheet->setCellValue('C' . ($startRow + $index), $item['satuan']);
                    $sheet->setCellValue('D' . ($startRow + $index), $item['saldo_disistem']);
                }

                // Border semua kolom dari heading sampai data
                $highestRow = $startRow + count($data) - 1;
                $sheet->getStyle('A3:D' . $highestRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ]);
            },
        ];
    }
}

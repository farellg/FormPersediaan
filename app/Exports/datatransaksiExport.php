<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;

class datatransaksiExport implements FromArray, WithHeadings, WithStyles, WithColumnWidths, WithEvents
{
    protected $tanggalCetak;
    protected $data;

    public function __construct($tanggalCetak, $data)
    {
        $this->tanggalCetak = $tanggalCetak;
        $this->data = $data;
    }

    public function array(): array
    {
        $result = [];

        foreach ($this->data as $index => $item) {
            $no = $index + 1;

            $items = is_string($item->items) ? json_decode($item->items, true) : $item->items;
            $itemList = [];

            if (is_array($items)) {
                foreach ($items as $i) {
                    $itemList[] = "{$i['nama_barang']} - {$i['jumlah']} {$i['satuan']}";
                }
            } else {
                $itemList[] = 'No items available';
            }

            $result[] = [
                $no,
                $item->unit,
                $item->tanggal,
                implode("\n", $itemList),
            ];
        }

        return $result;
    }

    public function headings(): array
    {
        return ['No', 'Unit', 'Tanggal', 'Items'];
    }

    public function styles(Worksheet $sheet)
    {
        return []; // styling akan ditangani di AfterSheet
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 20,
            'C' => 15,
            'D' => 60,
        ];
    }

    public function registerEvents(): array
    {
        return [
            \Maatwebsite\Excel\Events\AfterSheet::class => function (\Maatwebsite\Excel\Events\AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Sisipkan 2 baris di awal
                $sheet->insertNewRowBefore(1, 2);

                // Judul laporan
                $sheet->setCellValue('A1', 'Laporan Data Transaksi');
                $sheet->mergeCells('A1:D1');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 14],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                // Tanggal cetak
                $sheet->setCellValue('A2', 'Tanggal Cetak: ' . $this->tanggalCetak);
                $sheet->mergeCells('A2:D2');
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => ['horizontal' => 'left', 'vertical' => 'center'],
                ]);

                // Ambil baris terakhir setelah data lengkap
                $highestRow = $sheet->getHighestRow();

                // Styling header
                $sheet->getStyle("A3:D3")->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                ]);

                // Styling seluruh data (dari header ke bawah)
                $sheet->getStyle("A3:D{$highestRow}")->applyFromArray([
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                    'alignment' => ['vertical' => 'top'],
                ]);

                // Wrap text untuk kolom items
                $sheet->getStyle("D4:D{$highestRow}")->getAlignment()->setWrapText(true);

                // Center untuk kolom No
                $sheet->getStyle("A4:A{$highestRow}")->getAlignment()->setHorizontal('center');
            },
        ];
    }
}

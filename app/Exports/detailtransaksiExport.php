<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class detailtransaksiExport implements FromArray, WithEvents
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        // Format data tabel
        return collect($this->data['items'])->map(function ($item, $index) {
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

                // Tambahkan judul di atas tabel
                $sheet->setCellValue('A1', 'PERMOHONAN KEBUTUHAN ALAT TULIS KANTOR (ATK)');
                $sheet->setCellValue('A2', 'Unit: ' . $this->data['unit']);
                $sheet->setCellValue('A3', 'Tanggal: ' . $this->data['tanggal']);

                $sheet->getStyle('A1')->applyFromArray([
                    'alignment' => [
                        'horizontal' => 'center',
                    ],
                ]);

                // Gabungkan sel untuk judul
                $sheet->mergeCells('A1:E1');
                $sheet->mergeCells('A2:E2');
                $sheet->mergeCells('A3:E3');

                // Style untuk judul
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('A2:A3')->getFont()->setBold(true);

                // Bersihkan sel di baris 4
                $sheet->setCellValue('A4', '');
                $sheet->setCellValue('B4', '');
                $sheet->setCellValue('C4', '');
                $sheet->setCellValue('D4', '');
                $sheet->setCellValue('E4', '');


                // Header tabel baris pertama
                $sheet->setCellValue('A5', 'No');
                $sheet->setCellValue('B5', 'Kebutuhan');
                $sheet->setCellValue('E5', 'Keterangan');

                // Gabungkan sel untuk header tabel baris pertama
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
                foreach ($this->data['items'] as $index => $item) {
                    $sheet->setCellValue('A' . $row, $index + 1);
                    $sheet->setCellValue('B' . $row, $item['nama_barang']);
                    $sheet->setCellValue('C' . $row, $item['jumlah']);
                    $sheet->setCellValue('D' . $row, $item['satuan']);
                    $sheet->setCellValue('E' . $row, $item['keterangan']);
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
                $sheet->setCellValue('C' . $row, '(Reffi Ichsan)');
                $sheet->setCellValue('D' . $row, '(Aji Prastia)');

                $row += 3;
                $sheet->setCellValue('C' . $row, 'Mengetahui');
                // $sheet->getStyle('C' . $row)->getFont()->setBold(true);
    
                $row += 1;
                $sheet->setCellValue('C' . $row, 'Kepala Sub Bagian Tata Usaha');
    
                $row += 4;
                $sheet->setCellValue('C' . $row, '(M. Arief Setyadi)');

                // Style untuk area tanda tangan
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

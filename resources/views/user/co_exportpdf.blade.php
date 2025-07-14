<!DOCTYPE html>
<html>
<head>
    <title>Bukti Check Out</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h3 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 2em;
        }

        table th, table td {
            border: 1px solid #000000;
            padding: 8px;
            text-align: center;
        }
        .footer-signature {
            width: 100%;
            text-align: center;
            margin-top: 2em;
        }

        .signature-block {
            display: inline-block; /* Menjadikan elemen sejajar horizontal */
            width: 30%; /* Membagi ruang secara proporsional */
            vertical-align: top; /* Menjaga elemen tetap sejajar di atas */
            text-align: center; 
        }

        .signature-space {
            margin-top: 4em;
        }
    </style>
</head>
<body>
    <h3>PERMOHONAN KEBUTUHAN ALAT TULIS KANTOR (ATK)</h3>
    <h5>Unit: {{ $unit }}</h5>
    <h5>Tanggal: {{ $tanggal }}</h5>

    <table>
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th colspan="3">Kebutuhan</th>
                <th rowspan="2">Keterangan</th>
            </tr>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['nama_barang'] }}</td>
                    <td>{{ $item['jumlah'] }}</td>
                    <td>{{ $item['satuan'] }}</td>
                    <td>{{ $item['keterangan'] }}</td>
                </tr>
            @endforeach
            <!-- Tambahkan baris kosong jika data kurang dari 10 -->
            @for ($i = count($items) + 1; $i <= 10; $i++)
                <tr>
                    <td>{{ $i }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endfor
        </tbody>
    </table>
    <!-- Footer Section -->
    <div class="footer-signature">
        <div class="signature-block">
            <div>Pemohon</div>
            <div class="signature-space">(..........................................)</div>
        </div>
        <div class="signature-block">
            <div>Petugas Gudang</div>
            <div class="signature-space">(Reffi Ichsan)</div>
        </div>
        <div class="signature-block">
            <div>Operator Persediaan</div>
            <div class="signature-space">(Aji Prastia)</div>
        </div>
        <div class="signature-block" style="width: 100%; margin-top: 3em;">
            <div>Mengetahui</div>
            <div>Kepala Sub Bagian Tata Usaha</div>
            <div class="signature-space" style="margin-top: 5em;">(M. Arief Setyadi)</div>
        </div>
    </div>

</body>
</html>

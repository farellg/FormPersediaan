<!DOCTYPE html>
<html>
<head>
    <title>Laboran Data Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table th, table td {
            border: 1px solid #000000;
            padding: 8px;
            text-align: left;
        }
        h3 {
            text-align: center;
            margin-bottom: 0.5em;
        }
        .tanggal-cetak {
            text-align: right;
            margin-bottom: 1.5em;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <h3>Laporan Data Barang ATK</h3>
    <div class="tanggal-cetak">
        Tanggal Cetak: {{ $tanggalCetak }}
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Saldo di Sistem</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->kode_barang }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->satuan }}</td>
                <td>{{ $item->saldo_disistem }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Data Transaksi</title>
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
            margin-bottom: 2em;
        }
    </style>
</head>
<body>
    <h3>Laporan Data Transaksi</h3>
    <div class="tanggal-cetak">
        Tanggal Cetak: {{ $tanggalCetak }}
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Unit</th>
                <th>Tanggal</th>
                <th>Items</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach ($data as $item)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $item->unit }}</td>                                                      
                <td>{{ $item->tanggal}}</td>
                <td>
                    @if(is_array($item->items)) 
                        @foreach ($item->items as $singleItem)
                            <p>{{ $singleItem['nama_barang'] }} - {{ $singleItem['jumlah'] }} {{ $singleItem['satuan'] }}</p>
                        @endforeach
                    @else
                        <p>No items available</p>
                    @endif
                </td>
            </tr>
            <?php $i++ ?>
            @endforeach
        </tbody>
    </table>
</body>
</html>

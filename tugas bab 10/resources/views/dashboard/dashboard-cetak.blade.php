<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Categories & Transactions</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }
        table, th, td {
            border: 1px solid black;
        }
        img {
            width: 100px;
        }
        h3 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h3>Laporan Data Categories</h3>
    <hr>
    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>Kategori</th>
                <th>Total Harga</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td><img src="{{ public_path('img_categories/' . $category->gambar) }}" alt="Foto"></td>
                <td>{{ $category->nama }}</td>
                <td>Rp. {{ number_format($category->harga, 0, ',', '.') }}</td>
                <td>{{ $category->deskripsi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br><br>
    <h3>Laporan Data Transactions</h3>
    <hr>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->tanggal_transaksi }}</td>
                <td>{{ $transaction->nama_pemilik }}</td>
                <td>{{ $transaction->jenis_detail }}</td>
                <td>Rp. {{ number_format($transaction->harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

<?php
include 'koneksi.php';
require_once("dompdf/autoload.inc.php");

use Dompdf\Dompdf;

// Inisialisasi DOMPDF
$dompdf = new Dompdf();

// Query data categories
$sql_categories = "SELECT * FROM tb_categories";
$result_categories = mysqli_query($koneksi, $sql_categories);

// Query data transactions
$sql_transactions = "SELECT * FROM tb_transaction";
$result_transactions = mysqli_query($koneksi, $sql_transactions);

// Menyusun HTML untuk laporan
$html = '<center><h3>Laporan Data Categories</h3></center><hr/><br>';
$html .= '<table border="1" width="100%" style="border-collapse: collapse; text-align: center;">
            <tr>
                <th>Foto</th>
                <th>Kategori</th>
                <th>Total Harga</th>
                <th>Keterangan</th>
            </tr>';

if (mysqli_num_rows($result_categories) > 0) {
    while ($row = mysqli_fetch_assoc($result_categories)) {
        $html .= "<tr>
                    <td><img src='img_categories/{$row['photo']}' width='100'></td>
                    <td>{$row['categories']}</td>
                    <td>Rp " . number_format($row['price'], 0, ',', '.') . "</td>
                    <td>{$row['keterangan']}</td>
                  </tr>";
    }
} else {
    $html .= "<tr><td colspan='4'>Data Categories Kosong</td></tr>";
}

$html .= '</table><br><br>';


$html .= '<center><h3>Laporan Data Transactions</h3></center><hr/><br>';
$html .= '<table border="1" width="100%" style="border-collapse: collapse; text-align: center;">
            <tr>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
            </tr>';

if (mysqli_num_rows($result_transactions) > 0) {
    while ($row = mysqli_fetch_assoc($result_transactions)) {
        $html .= "<tr>
                    <td>{$row['tanggal_transaksi']}</td>
                    <td>{$row['nama_pemilik']}</td>
                    <td>{$row['jenis_detail']}</td>
                    <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                  </tr>";
    }
} else {
    $html .= "<tr><td colspan='5'>Data Transactions Kosong</td></tr>";
}

$html .= '</table>';

// Konversi HTML ke PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('laporan-categories-transactions.pdf');
?>

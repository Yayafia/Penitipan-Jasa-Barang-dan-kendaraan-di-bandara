<?php
include 'koneksi.php'; // Koneksi database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $metode_pembayaran = $_POST['metode-pembayaran'];
    $nama_pemilik = $_POST['nama-pemilik'];
    $nomor_pembayaran = $_POST['nomor-pembayaran'];
    $harga = str_replace('Rp ', '', $_POST['harga']);
    $nama_detail = $_POST['nama-detail'];
    $jenis_detail = json_encode([
        'barangData' => json_decode($_POST['barangData'], true),
        'kendaraanData' => json_decode($_POST['kendaraanData'], true),
    ]);
    $lama_penitipan = $_POST['lama-penitipan'];

    $sql = "INSERT INTO tb_transaction (metode_pembayaran, nama_pemilik, nomor_pembayaran, harga, nama_detail, jenis_detail, lama_penitipan)
            VALUES ('$metode_pembayaran', '$nama_pemilik', '$nomor_pembayaran', '$harga', '$nama_detail', '$jenis_detail', '$lama_penitipan')";

    if (mysqli_query($koneksi, $sql)) {
        header('Location: transaction.php'); // Redirect ke halaman transaksi
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}
?>
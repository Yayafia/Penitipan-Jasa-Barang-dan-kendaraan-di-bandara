<?php
include 'koneksi.php';

if (isset($_POST['simpan_categories'])) {
    // Proses simpan data categories
    $categories = $_POST['categories'];
    $price = $_POST['price'];
    $keterangan = $_POST['keterangan'];
    $photo = $_FILES['photo']['name'];
    $target_dir = "img_categories/";
    $target_file = $target_dir . basename($photo);

    if (empty($categories) || empty($price) || empty($keterangan) || empty($photo)) {
        echo "
            <script>
                alert('Pastikan Anda Mengisi Semua Data di Categories');
                window.location = 'categories.php';
            </script>
        ";
    } elseif (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO tb_categories (categories, price, keterangan, photo) 
                VALUES ('$categories', '$price', '$keterangan', '$photo')";
        if (mysqli_query($koneksi, $sql)) {
            echo "
                <script>
                    alert('Data Categories Berhasil Disimpan');
                    window.location = 'categories.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Terjadi Kesalahan Saat Menyimpan Data Categories');
                    window.location = 'categories.php';
                </script>
            ";
        }
    }
} elseif (isset($_POST['simpan_transactions'])) {
    // Proses simpan data transactions
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $status = $_POST['status'];
    $tanggal = date('Y-m-d');

    if (empty($nama) || empty($kategori) || empty($harga) || empty($status)) {
        echo "
            <script>
                alert('Pastikan Anda Mengisi Semua Data di Transactions');
                window.location = 'transaction.php';
            </script>
        ";
    } else {
        $sql = "INSERT INTO tb_transaction (nama, jenis, harga, status, tanggal) 
                VALUES ('$nama', '$kategori', '$harga', '$status', '$tanggal')";
        if (mysqli_query($koneksi, $sql)) {
            echo "
                <script>
                    alert('Data Transaction Berhasil Disimpan');
                    window.location = 'transaction.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Terjadi Kesalahan Saat Menyimpan Data Transactions');
                    window.location = 'transaction.php';
                </script>
            ";
        }
    }
} else {
    header('location: dashboard.php');
}
?>

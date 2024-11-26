<?php
include 'koneksi.php'; 

function upload() {
    $namaFile = $_FILES['photo']['name'];
    $error = $_FILES['photo']['error'];
    $tmpName = $_FILES['photo']['tmp_name'];

    
    if ($error === 4) {
        return false; 
    }

    
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "
            <script>
                alert('File Harus Berupa Gambar (jpg, jpeg, png)');
                window.location = 'categories-entry.php';
            </script>
        ";
        return false;
    }

    
    $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
    move_uploaded_file($tmpName, 'img_categories' . $namaFileBaru);
    return $namaFileBaru;
}

// Proses tambah data
if (isset($_POST['simpan'])) {
    $categories = $_POST['categories'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $photo = upload();

    if (!$photo) {
        return false;
    }

    
    if (empty($categories) || empty($price) || empty($description)) {
        echo "
            <script>
                alert('Pastikan Anda Mengisi Semua Data');
                window.location = 'categories-entry.php';
            </script>
        ";
        return false;
    }

    
    $sql = "INSERT INTO tb_categories (photo, categories, price, keterangan) 
            VALUES ('$photo', '$categories', '$price', '$description')";

    if (mysqli_query($koneksi, $sql)) {
        echo "
            <script>
                alert('Data Categories Berhasil Ditambahkan');
                window.location = 'categories.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Terjadi Kesalahan saat Menyimpan Data');
                window.location = 'categories-entry.php';
            </script>
        ";
    }
}

// Proses edit data
elseif (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $categories = $_POST['categories'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $photoLama = $_POST['photoLama'];

    // Cek apakah ada foto baru yang diupload
    if ($_FILES['photo']['error'] === 4) {
        $photo = $photoLama;
    } else {
        // Hapus foto lama dan upload foto baru
        unlink('img_categories/' . $photoLama);
        $photo = upload();
    }

    
    $sql = "UPDATE tb_categories SET 
                photo = '$photo', 
                categories = '$categories', 
                price = '$price', 
                keterangan = '$description' 
            WHERE id = $id";

    if (mysqli_query($koneksi, $sql)) {
        echo "
            <script>
                alert('Data Categories Berhasil Diubah');
                window.location = 'categories.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Terjadi Kesalahan saat Mengedit Data');
                window.location = 'categories-edit.php';
            </script>
        ";
    }
}

// Proses hapus data
elseif (isset($_POST['hapus'])) {
    $id = $_POST['id'];

    // Ambil data gambar dari database untuk dihapus
    $sql = "SELECT photo FROM tb_categories WHERE id = $id";
    $result = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_assoc($result);
    $photo = $row['photo'];

    // Hapus gambar dari folder
    unlink('img_categories/' . $photo);

    
    $sql = "DELETE FROM tb_categories WHERE id = $id";
    if (mysqli_query($koneksi, $sql)) {
        echo "
            <script>
                alert('Data Categories Berhasil Dihapus');
                window.location = 'categories.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data Categories Gagal Dihapus');
                window.location = 'categories.php';
            </script>
        ";
    }
}

// Jika tidak ada aksi yang sesuai, redirect ke categories.php
else {
    header("Location: categories.php");
}
?>

<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: login.php");
    exit;
}

// Cek apakah pengguna adalah admin
$role = $_SESSION['role'];
if ($role !== 'admin') {
    header("Location: dashboard.php");
    exit;
}


include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $penitip = $_POST['penitip'];
    $price = $_POST['totalHarga']; 
    $keterangan = $_POST['keterangan'];
    
    
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photo = $_FILES['photo']['name'];
        $photoTmp = $_FILES['photo']['tmp_name'];
		$categories = $_POST['categories'];  
        $photoPath = "img_categories" . $photo;  
        
        move_uploaded_file($photoTmp, $photoPath);
    } else {
        $photo = '';  
    }

    
    $sql = "INSERT INTO tb_categories (nama_penitip, price, keterangan, photo, categories) 
        VALUES ('$penitip', '$price', '$keterangan', '$photo', '$categories')";
    
    if (mysqli_query($koneksi, $sql)) {
        echo "
        <script>
            alert('Data berhasil ditambahkan');
            window.location = 'categories.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Gagal menambahkan data');
            window.location = 'categories-entry.php';
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="../assets/icon.png" />
    <link rel="stylesheet" href="dashboard.css" />
    
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | Deskripsi Entry</title>
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class="bx bx-category"></i>
            <span class="logo_name">LOGO</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="dashboard.php" class="active">
                    <i class="bx bx-grid-alt"></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="categories.php">
                    <i class="bx bx-box"></i>
                    <span class="links_name">Deskripsi</span>
                </a>
            </li>
            <li>
                <a href="transaction.php">
                    <i class="bx bx-list-ul"></i>
                    <span class="links_name">Transaction</span>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <i class="bx bx-log-out"></i>
                    <span class="links_name">Log out</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class="bx bx-menu sidebarBtn"></i>
            </div>
            <div class="profile-details">
                <span class="admin_name">Admin</span>
            </div>
        </nav>
        <div class="home-content">
            <h3>Input Deskripsi</h3>
            <div class="form-login">
                <form method="POST" enctype="multipart/form-data">
                    <label for="penitip">Nama Penitip</label>
                    <input class="input" type="text" name="penitip" id="penitip" placeholder="Nama Penitip" required />
                    
                    <label for="totalHarga">Total Harga</label>
                    <input class="input" type="text" name="totalHarga" id="totalHarga" placeholder="Total Harga" required />
                    
					<label for="categories">Kategori</label>
					<input class="input" type="text" name="categories" id="categories" placeholder="Kategori" required />

                    <label for="keterangan">Keterangan</label>
                    <input class="input" type="text" name="keterangan" id="keterangan" placeholder="Keterangan" required />

					<label for="photo">Foto</label>
                    <input type="file" name="photo" id="photo" style="margin-bottom: 20px" />
                    
                    <button type="submit" class="btn btn-simpan" name="simpan">Simpan</button>
                </form>
            </div>
        </div>
    </section>
    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function () {
            sidebar.classList.toggle("active");
            if (sidebar.classList.contains("active")) {
                sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        };
    </script>
</body>

</html>

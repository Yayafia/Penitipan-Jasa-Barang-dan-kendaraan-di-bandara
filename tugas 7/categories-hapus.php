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


$id = $_GET['id'] ?? null;

if (!$id) {
    echo "
      <script>
        alert('Tidak ada ID yang Terdeteksi');
        window.location = 'categories.php';
      </script>
    ";
    exit;
}


$sql = "SELECT * FROM tb_categories WHERE id = '$id'";
$result = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($result);

// Proses hapus kategori
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['hapus'])) {
        // Hapus foto terkait dari server
        if (file_exists('img_categories' . $data['photo'])) {
            unlink('img_categories' . $data['photo']);
        }

        // Hapus data kategori dari database
        $deleteSql = "DELETE FROM tb_categories WHERE id = '$id'";
        if (mysqli_query($koneksi, $deleteSql)) {
            echo "
              <script>
                alert('Data berhasil dihapus');
                window.location = 'categories.php';
              </script>
            ";
        } else {
            echo "
              <script>
                alert('Gagal menghapus data');
                window.location = 'categories.php';
              </script>
            ";
        }
    } else {
        // Jika user memilih 'No', kembali ke halaman categories
        header("Location: categories.php");
        exit;
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
    <title>Admin | Hapus Deskripsi</title>
</head>
<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class="bx bx-category"></i>
            <span class="logo_name">LOGO</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="dashboard.php">
                    <i class="bx bx-grid-alt"></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="categories.php" class="active">
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
                <a href="tugasbab2prak.php">
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
            <h3>Hapus Deskripsi</h3>
            <div class="form-login">
                <h4>Ingin Menghapus Data?</h4>
                <form action="categories-hapus.php?id=<?= $id ?>" method="post">
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <button type="submit" class="btn" name="hapus" style="margin-top: 50px;">Yes</button>
                    <button type="submit" class="btn" name="tidak">No</button>
                </form>
            </div>
        </div>
    </section>
    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function() {
            sidebar.classList.toggle("active");
            if (sidebar.classList.contains("active")) {
                sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        };
    </script>
</body>
</html>

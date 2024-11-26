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


if (!isset($_GET['id'])) {
    echo "
      <script>
        alert('Tidak ada ID yang terdeteksi');
        window.location = 'categories.php';
      </script>
    ";
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM tb_categories WHERE id = '$id'";
$result = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "
      <script>
        alert('Data tidak ditemukan');
        window.location = 'categories.php';
      </script>
    ";
    exit;
}

$data = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="../assets/icon.png" />
    <link rel="stylesheet" href="dashboard.css" />
    
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | Edit Categories</title>
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
            <h3>Edit Deskripsi</h3>
            <div class="form-login">
                <form action="categories-proses.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <input type="hidden" name="photoLama" value="<?= $data['photo'] ?>">
                    <label for="categories">Deskripsi</label>
                    <input
                        class="input"
                        type="text"
                        name="categories"
                        id="categories"
                        placeholder="Categories"
                        value="<?= $data['categories'] ?>"
                        required
                    />
                    <label for="price">Total Harga</label>
                    <input
                        class="input"
                        type="text"
                        name="price"
                        id="price"
                        placeholder="Price"
                        value="<?= $data['price'] ?>"
                        required
                    />
                    <label for="keterangan">Keterangan</label>
                    <textarea
                        class="input"
                        name="description"
                        id="description"
                        placeholder="Keterangan"
                        required
                    ><?= $data['keterangan'] ?></textarea>
                    <label for="photo">Foto</label>
                    <img src="img_categories/<?= $data['photo'] ?>" alt="Photo" width="150px">
                    <input
                        type="file"
                        name="photo"
                        id="photo"
                        style="margin-bottom: 20px"
                    />
                    <button type="submit" class="btn btn-simpan" name="edit">
                        Simpan Perubahan
                    </button>
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
            }
    </script>
</body>

</html>

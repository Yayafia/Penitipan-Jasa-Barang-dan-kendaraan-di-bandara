<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: login.php");
    exit;
}

// Ambil email dan role dari session
$email = $_SESSION['email'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="assets/icon.png" />
    <link rel="stylesheet" href="dashboard.css" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
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

            <!-- Menampilkan menu Categories hanya untuk admin -->
            <?php if ($role === 'admin'): ?>
            <li>
                <a href="categories.php">
                    <i class="bx bx-box"></i>
                    <span class="links_name">Deskripsi</span>
                </a>
            </li>
            <?php endif; ?>

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
                <span class="admin_name"><?php echo htmlspecialchars($email); ?></span>
            </div>
        </nav>
        <div class="home-content">
            <h1>Selamat Datang, <?php echo htmlspecialchars($_SESSION['first_name']); ?>!</h1>
            <h2 id="text"></h2>
            <h3 id="date"></h3>
            <div id="transaction-list"></div>
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

        function myFunction() {
            const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
            let date = new Date();
            let jam = date.getHours();
            let tanggal = date.getDate();
            let hari = days[date.getDay()];
            let bulan = months[date.getMonth()];
            let tahun = date.getFullYear();

            let m = date.getMinutes();
            let s = date.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById("date").innerHTML = `${hari}, ${tanggal} ${bulan} ${tahun}, ${jam}:${m}:${s}`;
            requestAnimationFrame(myFunction);
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }

        window.onload = function () {
            let jam = new Date().getHours();
            if (jam >= 4 && jam <= 10) {
                document.getElementById("text").innerHTML = "Selamat Pagi!";
            } else if (jam >= 11 && jam <= 14) {
                document.getElementById("text").innerHTML = "Selamat Siang!";
            } else if (jam >= 15 && jam <= 18) {
                document.getElementById("text").innerHTML = "Selamat Sore!";
            } else {
                document.getElementById("text").innerHTML = "Selamat Malam!";
            }
            myFunction();
        };
    </script>
</body>

</html>

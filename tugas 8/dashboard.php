<?php 
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: login.php");
    exit;
}

// Ambil data email, role, dan nama dari session
$email = isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'Guest';
$role = isset($_SESSION['role']) ? htmlspecialchars($_SESSION['role']) : 'User';
$firstName = isset($_SESSION['first_name']) ? htmlspecialchars($_SESSION['first_name']) : 'Pengguna';

// Koneksi database
include 'koneksi.php';

// Menghitung jumlah data di tabel categories
$queryCategories = "SELECT COUNT(*) AS total_categories FROM tb_categories";
$resultCategories = mysqli_query($koneksi, $queryCategories);
$totalCategories = ($resultCategories && mysqli_num_rows($resultCategories) > 0) ? 
    mysqli_fetch_assoc($resultCategories)['total_categories'] : 0;

// Menghitung jumlah data di tabel transaction
$queryTransactions = "SELECT COUNT(*) AS total_transactions FROM tb_transaction";
$resultTransactions = mysqli_query($koneksi, $queryTransactions);
$totalTransactions = ($resultTransactions && mysqli_num_rows($resultTransactions) > 0) ? 
    mysqli_fetch_assoc($resultTransactions)['total_transactions'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="assets/icon.png" />
    <link rel="stylesheet" href="css/dashboard.css" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
</head>
<body>
    <!-- Sidebar -->
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

    <!-- Home Section -->
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class="bx bx-menu sidebarBtn"></i>
            </div>
            <div class="profile-details">
                <span class="admin_name"><?php echo $email; ?></span>
            </div>
        </nav>

        <div class="home-content">
            <h1>Selamat Datang, <?php echo $firstName; ?>!</h1>
            <h2 id="text"></h2>
            <h3 id="date"></h3>
			<button type="button" class="btn btn-tambah">
			<a href="dashboard-cetak.php">Cetak</a>
			</button>


            <!-- Menampilkan data categories dan transactions -->
            <div class="widget-container">
                <div class="widget">
                    <div class="widget-icon">
                        <i class="bx bx-category"></i>
                    </div>
                    <div class="widget-info">
                        <h4>Total Categories</h4>
                        <p><?php echo $totalCategories; ?></p>
                    </div>
                </div>
                <div class="widget">
                    <div class="widget-icon">
                        <i class="bx bx-list-ul"></i>
                    </div>
                    <div class="widget-info">
                        <h4>Total Transactions</h4>
                        <p><?php echo $totalTransactions; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript -->
    <script>
        // Sidebar toggle functionality
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function () {
            sidebar.classList.toggle("active");
            sidebarBtn.classList.toggle("bx-menu-alt-right");
            sidebarBtn.classList.toggle("bx-menu");
        };

        // Function to display date and time
        function displayDateTime() {
            const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
            let now = new Date();
            let day = days[now.getDay()];
            let date = now.getDate();
            let month = months[now.getMonth()];
            let year = now.getFullYear();
            let hours = now.getHours();
            let minutes = now.getMinutes();
            let seconds = now.getSeconds();

            // Format time
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            document.getElementById("date").innerHTML = `${day}, ${date} ${month} ${year}, ${hours}:${minutes}:${seconds}`;
            requestAnimationFrame(displayDateTime);
        }

        // Greeting function
        function displayGreeting() {
            let now = new Date().getHours();
            let greeting = "Selamat Malam!";
            if (now >= 4 && now <= 10) greeting = "Selamat Pagi!";
            else if (now >= 11 && now <= 14) greeting = "Selamat Siang!";
            else if (now >= 15 && now <= 18) greeting = "Selamat Sore!";

            document.getElementById("text").innerHTML = greeting;
        }

        // Initialize functions on page load
        window.onload = function () {
            displayGreeting();
            displayDateTime();
        };
    </script>
</body>
</html>

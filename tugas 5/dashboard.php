<?php
session_start(); // Memulai session

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: login.php"); // Arahkan ke halaman login jika belum login
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="assets/icon.png" />
    <link rel="stylesheet" href="dashboard.css" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
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
                    <span class="links_name">Categories</span>
                </a>
            </li>
            <li>
                <a href="transaction.php">
                    <i class="bx bx-list-ul"></i>
                    <span class="links_name">Transaction</span>
                </a>
            </li>
            <li>
                <a href="logout.php"> <!-- Mengarahkan ke logout.php -->
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
                <span class="admin_name"><?php echo $_SESSION['username']; ?></span> <!-- Tampilkan username -->
            </div>
        </nav>
        <div class="home-content">
            <h1>Selamat Datang Admin</h1>
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

        // Penerapan fetch dengan Promise
        function fetchPaymentData() {
            // Ganti dengan URL API yang sesuai
            return fetch('https://api.example.com/payments') // Contoh URL API
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json(); // Mengembalikan data dalam format JSON
                })
                .then(paymentData => {
                    // Menampilkan data pembayaran
                    const transactionList = document.getElementById('transaction-list');
                    const transactionHtml = paymentData.map(payment => `
                        <ul>
                            <li>Metode: ${payment.metodePembayaran}, Nama: ${payment.namaPemilik}, Jumlah: ${payment.jumlahPembayaran}</li>
                        </ul>
                    `).join('');
                    transactionList.innerHTML = transactionHtml;
                })
                .catch(error => {
                    console.error('Error fetching payment data:', error);
                });
        }

        window.onload = function () {
            let nama = prompt("Masukkan Nama Anda : ", "Admin");
            let jam = new Date().getHours();
            if (nama != null) {
                if (jam >= 4 && jam <= 10) {
                    document.getElementById("text").innerHTML = `Selamat Pagi ${nama}`;
                } else if (jam >= 11 && jam <= 14) {
                    document.getElementById("text").innerHTML = `Selamat Siang ${nama}`;
                } else if (jam >= 15 && jam <= 18) {
                    document.getElementById("text").innerHTML = `Selamat Sore ${nama}`;
                } else {
                    document.getElementById("text").innerHTML = `Selamat Malam ${nama}`;
                }
            }
            myFunction();
            fetchPaymentData(); // Memanggil fungsi fetchPaymentData untuk mengambil data
        };
    </script>
</body>

</html>

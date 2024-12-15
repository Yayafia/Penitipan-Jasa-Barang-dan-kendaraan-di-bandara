<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="css/dashboard.css" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | Transaction</title>
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
            <h3>Transaction</h3>
            <table class="table-data">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM tb_transaction ORDER BY tanggal_transaksi DESC";
                    $result = mysqli_query($koneksi, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $jenis_detail = !empty($row['jenis_detail']) ? json_decode($row['jenis_detail'], true) : [];
                            $kategori = isset($jenis_detail['barangData']) ? 'Penitipan Barang' : 'Penitipan Kendaraan';
                            echo "
                                <tr>
                                    <td>{$row['tanggal_transaksi']}</td>
                                    <td>{$row['nama_pemilik']}</td>
                                    <td>{$kategori}</td>
                                    <td>Rp " . number_format($row['harga'], 2, ',', '.') . "</td>
                                    <td><p class='success'>Sukses</p></td>
                                    <td>
                                        <button class='btn_detail' onclick=\"showDetails('{$row['nama_pemilik']}', '{$row['harga']}', '{$kategori}', '{$row['tanggal_transaksi']}')\">Detail</button>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Tidak ada data transaksi yang tersedia.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    
    <script>
        function tampilkanDataTransaksi() {
            const transactionBody = document.getElementById('transaction-body');
            const paymentDataArray = JSON.parse(localStorage.getItem('paymentDataArray')) || [];
            transactionBody.innerHTML = "";

            if (paymentDataArray.length > 0) {
                paymentDataArray.forEach((data) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${data.tanggal}</td>
                        <td>${data.namaPemilik}</td>
                        <td>${data.kategori}</td>
                        <td>${data.jumlahPembayaran}</td>
                        <td><p class="success">Sukses</p></td>
                        <td>
                            <button class="btn_detail" onclick="showDetails('${data.namaPemilik}', '${data.jumlahPembayaran}', '${data.kategori}', '${data.tanggal}')">Detail</button>
                        </td>
                    `;
                    transactionBody.appendChild(row);
                });
            } else {
                const row = document.createElement('tr');
                row.innerHTML = `<td colspan="6">Tidak ada data transaksi yang tersedia.</td>`;
                transactionBody.appendChild(row);
            }
        }

        function showDetails(nama, jumlahPembayaran, kategori, tanggal) {
            alert(`Nama: ${nama}\nJumlah Pembayaran: ${jumlahPembayaran}\nKategori: ${kategori}\nTanggal: ${tanggal}`);
        }

        window.onload = tampilkanDataTransaksi;
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link rel="stylesheet" href="css/tampilan2.css">
</head>
<body>
    <nav>
        <div>
            <img src="assets/logo.jpg" alt="Logo">
        </div>
        <ul>
            <li><a href="tugasbab2prak.php">Home</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="tampilan.php">Tampilan</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
        </ul>
    </nav>

    <main>
        <div class="form-container">
            <h2>Pembayaran</h2>
            <form id="payment-form" action="process_payment.php" method="POST">
                <label for="metode-pembayaran">Metode Pembayaran:</label>
                <select id="metode-pembayaran" name="metode-pembayaran" required>
                    <option value="transfer">Transfer Bank</option>
                    <option value="ewallet">E-Wallet (OVO, GoPay, DANA)</option>
                    <option value="kartu-kredit">Kartu Kredit</option>
                </select>

                <label for="nama-pemilik">Nama Pemilik Rekening / Kartu:</label>
                <input type="text" id="nama-pemilik" name="nama-pemilik" placeholder="Masukkan nama pemilik" required>

                <label for="nomor-pembayaran">Nomor Rekening / Kartu / E-Wallet:</label>
                <input type="text" id="nomor-pembayaran" name="nomor-pembayaran" placeholder="Masukkan nomor" required>

                <label for="harga">Jumlah Pembayaran:</label>
                <input type="text" id="harga" name="harga" readonly>

                <!-- Detail Penitipan -->
                <h3>Detail Penitipan:</h3>

                <label for="nama-detail">Nama:</label>
                <input type="text" id="nama-detail" name="nama-detail" readonly>

                <label for="jenis-detail">Jenis:</label>
                <input type="text" id="jenis-detail" name="jenis-detail" readonly>

                <label for="lama-penitipan">Lama Penitipan (Hari):</label>
                <input type="text" id="lama-penitipan" name="lama-penitipan" readonly>

                <label for="total-harga">Total Harga:</label>
                <input type="text" id="total-harga" name="total-harga" readonly>

                <!-- Hidden input untuk data penitipan -->
                <input type="hidden" id="hidden-barang-data" name="barangData">
                <input type="hidden" id="hidden-kendaraan-data" name="kendaraanData">

                <button type="submit">Bayar Sekarang</button>
            </form>
        </div>
    </main>

    <script>
        // Mengambil data dari localStorage
        const barangData = JSON.parse(localStorage.getItem('penitipanBarangData'));
        const kendaraanData = JSON.parse(localStorage.getItem('penitipanKendaraanData'));
        let totalHarga = 0;

        if (barangData) {
            totalHarga = parseInt(barangData.harga.replace('Rb', '')) * 1000 * barangData.lamaPenitipan;
            document.getElementById('harga').value = `Rp ${totalHarga}`;
            document.getElementById('nama-detail').value = barangData.nama;
            document.getElementById('jenis-detail').value = "Penitipan Barang";
            document.getElementById('lama-penitipan').value = barangData.lamaPenitipan;
            document.getElementById('total-harga').value = `Rp ${totalHarga}`;
        } else if (kendaraanData) {
            totalHarga = parseInt(kendaraanData.harga.replace('Rb', '')) * 1000 * kendaraanData.lamaPenitipan;
            document.getElementById('harga').value = `Rp ${totalHarga}`;
            document.getElementById('nama-detail').value = kendaraanData.nama;
            document.getElementById('jenis-detail').value = "Penitipan Kendaraan";
            document.getElementById('lama-penitipan').value = kendaraanData.lamaPenitipan;
            document.getElementById('total-harga').value = `Rp ${totalHarga}`;
        } else {
            document.getElementById('nama-detail').value = "Tidak ada data";
            document.getElementById('jenis-detail').value = "Tidak ada data";
            document.getElementById('lama-penitipan').value = "Tidak ada data";
            document.getElementById('total-harga').value = "Tidak ada data";
        }

        // Mengisi hidden input dengan data penitipan
        document.getElementById('hidden-barang-data').value = JSON.stringify(barangData || {});
        document.getElementById('hidden-kendaraan-data').value = JSON.stringify(kendaraanData || {});
    </script>
</body>
</html>
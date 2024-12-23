<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengisian Data Diri - Penitipan Barang</title>
    <link rel="stylesheet" href="tampilan2.css">
    <script>
        function updateHarga() {
            var tipeBarang = document.getElementById("tipe-barang").value;
            var hargaInput = document.getElementById("harga");

            if (tipeBarang === "koper") {
                hargaInput.value = "30Rb";
            } else if (tipeBarang === "tas-ransel") {
                hargaInput.value = "15Rb";
            } else if (tipeBarang === "kardus") {
                hargaInput.value = "5Rb";
            }
        }

        function addTotalHarga() {
            const hargaPerHari = parseInt(document.getElementById('harga').value.replace('Rb', '')) * 1000;
            const lamaPenitipan = parseInt(document.getElementById('lama-penitipan').value);
            const totalHarga = hargaPerHari * lamaPenitipan;
            document.getElementById('total-harga').value = totalHarga; // Menyimpan total harga di field tersembunyi
        }

        async function saveData(event) {
            event.preventDefault(); 

            
            const formData = {
                nama: document.getElementById("nama").value,
                tipeBarang: document.getElementById("tipe-barang").value,
                beratBarang: document.getElementById("berat-barang").value,
                lamaPenitipan: document.getElementById("lama-penitipan").value,
                harga: document.getElementById("harga").value,
                totalHarga: document.getElementById("total-harga").value
            };

            // Simpan data ke localStorage
            localStorage.setItem('penitipanBarangData', JSON.stringify(formData));
            
            localStorage.removeItem('penitipanKendaraanData');

            // Alihkan ke halaman pembayaran
            window.location.href = 'pembayaran.php';
        }
    </script>
</head>
<body>
    <nav>
        <div class="">
            <img src="logo.jpg" alt="Logo">
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
            <div class="icon-barang"></div>
            <h2>Data Diri Penitipan Jasa Barang</h2>
            <form onsubmit="saveData(event)">
                <label for="nama">Nama Penitip:</label>
                <input type="text" id="nama" name="nama" required>
                
                <label for="tipe-barang">Tipe Barang:</label>
                <select id="tipe-barang" name="tipe-barang" onchange="updateHarga()" required>
                    <option value="koper">Koper</option>
                    <option value="tas-ransel">Tas Ransel</option>
                    <option value="kardus">Kardus</option>
                </select>
                
                <label for="berat-barang">Berat Barang (kg):</label>
                <input type="number" id="berat-barang" name="berat-barang" placeholder="Masukkan berat barang" required>
                
                <label for="lama-penitipan">Lama Penitipan Per hari:</label>
                <input type="number" id="lama-penitipan" name="lama-penitipan" placeholder="Lama Per hari" required>
                
                <label for="harga">Harga :</label>
                <input type="text" id="harga" name="harga" value="30Rb" readonly>
                <input type="hidden" name="jenis" value="barang">
                <input type="hidden" id="total-harga" name="total-harga" value="">

                <button type="submit">Lanjut ke Pembayaran</button>
            </form>
        </div>
    </main>
</body>
</html>

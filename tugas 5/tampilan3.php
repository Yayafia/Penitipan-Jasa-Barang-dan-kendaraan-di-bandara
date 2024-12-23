<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengisian Data Diri - Penitipan Kendaraan</title>
    <link rel="stylesheet" href="tampilan3.css">
    <script>
        function updateHarga() {
            var tipeKendaraan = document.getElementById("tipe-kendaraan").value;
            var hargaInput = document.getElementById("harga");

            if (tipeKendaraan === "mobil") {
                hargaInput.value = "100Rb"; 
            } else if (tipeKendaraan === "motor") {
                hargaInput.value = "45Rb"; 
            } else if (tipeKendaraan === "sepeda") {
                hargaInput.value = "15Rb"; 
            } else if (tipeKendaraan === "bus") {
                hargaInput.value = "85Rb"; 
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

            // Kumpulkan data dari formulir
            const formData = {
                nama: document.getElementById("nama").value,
                tipeKendaraan: document.getElementById("tipe-kendaraan").value,
                lamaPenitipan: document.getElementById("lama-penitipan").value,
                harga: document.getElementById("harga").value,
                totalHarga: document.getElementById("total-harga").value
            };

            // Simpan data ke localStorage
            localStorage.setItem('penitipanKendaraanData', JSON.stringify(formData));

            localStorage.removeItem('penitipanBarangData');

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
            <div class="icon-kendaraan"></div>
            <h2>Data Diri Penitipan Jasa Kendaraan</h2>
            <form onsubmit="saveData(event)">
                <label for="nama">Nama Penitip:</label>
                <input type="text" id="nama" name="nama" required>
                
                <label for="tipe-kendaraan">Tipe Kendaraan:</label>
                <select id="tipe-kendaraan" name="tipe-kendaraan" onchange="updateHarga()" required>
                    <option value="mobil">Mobil</option>
                    <option value="motor">Motor</option>
                    <option value="sepeda">Sepeda</option>
                    <option value="bus">Bus</option>
                </select>
                
                <label for="lama-penitipan">Lama Penitipan (hari):</label>
                <input type="number" id="lama-penitipan" name="lama-penitipan" placeholder="Lama Penitipan" required>
                
                <label for="harga">Harga :</label>
                <input type="text" id="harga" name="harga" value="100Rb" readonly>
                <input type="hidden" name="jenis" value="kendaraan">
                <input type="hidden" id="total-harga" name="total-harga" value="">

                <button type="submit">Lanjut ke Pembayaran</button>
            </form>
        </div>
    </main>
</body>
</html>

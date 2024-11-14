<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <nav>
        <div class="">
            <img src="logo.jpg" alt="Logo">
        </div>
        <ul>
            <li><a href="tugasbab2prak.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="tampilan.php">Tampilan</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
        </ul>
    </nav>

    <div class="row">
        <div class="col text-col">
            <h1>WELCOME</h1>
            <p>WELCOME TO WEBSITE JASA PENITIPAN BARANG DAN KENDARAAN</p>
            <button type="button">Get Started</button>
        </div>
        <div class="col image-col">
            <img src="imge1.png" alt="Gambar" />
        </div>
    </div>


    <br><br><br><br><br><br>
    <div class="gambar">
        <div class="gambar-text">
            <h2 id="second-heading">Layanan Kami</h2>
        </div>
        <div class="gambar-image">
            <img id="second-image" src="/imgsaran.jpg" alt="Service Image" />
        </div>
    </div>


    <div class="contact-form">
        <h3>Hubungi Kami</h3>
        <form id="contactForm">
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" placeholder="Masukkan nama Anda" />
            <br/>
            <label for="message">Saran:</label>
            <textarea id="message" name="message" placeholder="Tuliskan saran dan komentar Anda"></textarea>
            <br/>
            <button type="submit">Kirim Pesan</button>
        </form>
    </div>

    <script src="javascript/indexprakbab2.js"></script>
</body>
</html>
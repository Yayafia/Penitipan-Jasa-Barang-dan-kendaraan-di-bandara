<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="UTF-8" />
	<link rel="icon" href="../assets/icon.png" />
	<link rel="stylesheet" href="dashboard.css" />
	<!-- Boxicons CDN Link -->
	<link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Admin | Categories Entry</title>
</head>

<body>
	<div class="sidebar">
		<div class="logo-details">
			<i class="bx bx-category"></i>
			<span class="logo_name">LOGO</span>
		</div>
		<ul class="nav-links">
			<li>
				<a href="dashboard.css" class="active">
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
			<h3>Input Categories</h3>
			<div class="form-login">
				<form id="categoryForm">
					<label for="penitip">Nama Penitip</label>
					<input class="input" type="text" name="penitip" id="penitip" placeholder="Nama Penitip" required />
					
					<label for="totalHarga">Total Harga</label>
					<input class="input" type="text" name="totalHarga" id="totalHarga" placeholder="Total Harga" required />
					
					<label for="keterangan">Keterangan</label>
					<input class="input" type="text" name="keterangan" id="keterangan" placeholder="Keterangan" required />
					
					<label for="photo">Photo</label>
					<input type="file" name="photo" id="photo" style="margin-bottom: 20px" />
					
					<button type="submit" class="btn btn-simpan" name="simpan">Simpan</button>
				</form>
			</div>
		</div>
	</section>
	<script>
		document.getElementById("categoryForm").addEventListener("submit", function(event) {
			event.preventDefault(); // Mencegah form dari reload

			// Mengambil data dari form
			const penitip = document.getElementById("penitip").value;
			const totalHarga = document.getElementById("totalHarga").value;
			const keterangan = document.getElementById("keterangan").value;

			// Mengambil data yang sudah ada dari Local Storage
			let categories = JSON.parse(localStorage.getItem("categories")) || [];
			
			// Menambahkan kategori baru
			categories.push({ penitip, totalHarga, keterangan });

			// Menyimpan kembali ke Local Storage
			localStorage.setItem("categories", JSON.stringify(categories));

			// Mengarahkan kembali ke halaman categories
			window.location.href = "categories.php";
		});
	</script>
	<script>
		let sidebar = document.querySelector(".sidebar");
		let sidebarBtn = document.querySelector(".sidebarBtn");
		sidebarBtn.onclick = function () {
			sidebar.classList.toggle("active");
			if (sidebar.classList.contains("active")) {
				sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
			} else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
		};
	</script>
</body>

</html>
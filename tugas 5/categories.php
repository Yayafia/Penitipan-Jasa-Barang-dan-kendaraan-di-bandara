<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="UTF-8" />
	<link rel="icon" href="../assets/icon.png" />
	<link rel="stylesheet" href="dashboard.css" />
	<!-- Boxicons CDN Link -->
	<link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Admin | Categories</title>
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
			<h3>Categories</h3>
			<button type="button" class="btn btn-tambah">
				<a href="categories-entry.php">Tambah Data</a>
			</button>
			<table class="table-data">
				<thead>
					<tr>
						<th scope="col" style="width: 20%">Nama Penitip</th>
						<th>Keterangan</th>
						<th scope="col" style="width: 20%">Total Harga</th>
						<th scope="col" style="width: 30%">Action</th>
					</tr>
				</thead>
				<tbody id="categoriesTableBody">
					<!-- Data kategori akan dimasukkan di sini -->
				</tbody>
			</table>
		</div>
	</section>
	<script>
		// Fungsi untuk menampilkan kategori dari Local Storage
		function displayCategories() {
			const categories = JSON.parse(localStorage.getItem("categories")) || [];
			const tableBody = document.getElementById("categoriesTableBody");
			tableBody.innerHTML = ""; // Kosongkan isi tabel

			categories.forEach((category, index) => {
				const row = document.createElement("tr");
				row.innerHTML = `
					<td>${category.penitip}</td>
					<td>${category.keterangan}</td>
					<td>${category.totalHarga}</td>
					<td>
						<button class="btn-edit" onclick="editCategory(${index})">Edit</button>
						<button class="btn-delete" onclick="deleteCategory(${index})">Hapus</button>
					</td>
				`;
				tableBody.appendChild(row);
			});
		}

		// Fungsi untuk menghapus kategori
		function deleteCategory(index) {
			let categories = JSON.parse(localStorage.getItem("categories")) || [];
			categories.splice(index, 1); // Hapus kategori berdasarkan index
			localStorage.setItem("categories", JSON.stringify(categories)); // Simpan kembali ke Local Storage
			displayCategories(); // Tampilkan kembali kategori
		}

		// Fungsi untuk mengedit kategori (belum diimplementasikan)
		function editCategory(index) {
			// Logika untuk mengedit kategori bisa ditambahkan di sini
			alert("Edit kategori dengan index: " + index);
		}

		// Menampilkan kategori saat halaman dimuat
		window.onload = displayCategories;
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

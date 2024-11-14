<?php
session_start(); // Memulai session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == 'admin@gmail.com' && $password == '1234') { // Login sukses
        $_SESSION['isLoggedIn'] = true; // Tandai pengguna sebagai login
        $_SESSION['username'] = $username; // Simpan username

        // Cek apakah checkbox "Ingat Saya" dicentang
        if (isset($_POST['remember'])) {
            setcookie('username', $username, time() + (86400 * 30), "/"); // Cookie berlaku 30 hari
        } else {
            // Jika tidak dicentang, hapus cookie jika ada
            if (isset($_COOKIE['username'])) {
                setcookie('username', '', time() - 3600, "/");
            }
            if (isset($_COOKIE['password'])) {
                setcookie('password', '', time() - 3600, "/");
            }
        }

        header("Location: dashboard.php"); // Arahkan ke halaman dashboard
        exit;
    } else {
        $error_message = "Username atau password salah."; // Pesan error jika login gagal
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
    <img class="wave" src="imge1.png"/>
    <div class="wrapper">
        <form action="" method="POST"> <!-- Menggunakan method POST -->
            <h1>LOGIN</h1>
            <div class="input-box">
                <input type="text" name="username" placeholder="Username/email" value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : ''; ?>" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" value="<?php echo isset($_COOKIE['password']) ? $_COOKIE['password'] : ''; ?>" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remember-forget">
                <input type="checkbox" name="remember" id="remember" />
                <label for="remember">Ingat Saya</label>
                <a href="#">Forget Password</a>
            </div>
            <button type="submit" class="btn">LOGIN</button>
            <div class="register-link">
                <p>Don't have an account yet? <a href="register.php">Create New Account</a></p>
            </div>
        </form>
    </div>

    <?php if (isset($error_message)): ?>
        <div id="snackbar-login"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <script>
        function showSnackbarLogin() {
            var snackbar = document.getElementById("snackbar-login");
            snackbar.className = "show";
            setTimeout(function(){ 
                snackbar.className = snackbar.className.replace("show", ""); 
            }, 3000);
        }

        // Menampilkan snackbar jika ada pesan error
        <?php if (isset($error_message)): ?>
            showSnackbarLogin();
        <?php endif; ?>
    </script>
</body>
</html>

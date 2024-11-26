<?php
session_start(); 

if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message']; 
    unset($_SESSION['error_message']); 
} else {
    $error_message = ""; 
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // koneksi ke database
    $conn = new mysqli('localhost', 'root', '', 'db_tgsprakpemweb'); 

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    
    if ($email === 'admin@gmail.com' && $password === '1234') {
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['role'] = 'admin'; // menyimpan role admin
        $_SESSION['first_name'] = 'Admin'; 
        header("Location: dashboard.php"); 
        exit;
    }

    // Cek login pengguna dari tabel register
    $stmt = $conn->prepare("SELECT password, first_name FROM tb_register WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password, $first_name);
        $stmt->fetch();

        // Verifikasi password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['email'] = $email; // menyimpan email pengguna di session
            $_SESSION['first_name'] = $first_name; 
            $_SESSION['role'] = 'user'; // menyimpan role pengguna
            header("Location: dashboard.php");
            exit;
        } else {
            
            $_SESSION['error_message'] = "Password salah.";
            header("Location: login.php"); 
            exit;
        }
    } else {
        
        $_SESSION['error_message'] = "Email tidak ditemukan.";
        header("Location: login.php"); 
        exit;
    }

    $stmt->close();
    $conn->close();
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
        <form action="" method="post"> 
            <h1>LOGIN</h1>
            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required>
                <i class='bx bx-mail-send'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
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

    <?php if (!empty($error_message)): ?>
        <div id="snackbar-login"><?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>

    <script>
        function showSnackbarLogin() {
            var snackbar = document.getElementById("snackbar-login");
            snackbar.className = "show";
            setTimeout(function(){ 
                snackbar.className = snackbar.className.replace("show", ""); 
            }, 3000);
        }

        // menampilkan snackbar jika ada pesan error
        <?php if (!empty($error_message)): ?>
            showSnackbarLogin();
        <?php endif; ?>
    </script>
</body>
</html>

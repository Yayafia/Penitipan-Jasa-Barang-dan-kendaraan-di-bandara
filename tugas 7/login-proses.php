<?php
include 'koneksi.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $requestPassword = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Query untuk mengambil data pengguna berdasarkan email
    $sql = "SELECT * FROM tb_register WHERE email = ?";
    $stmt = mysqli_prepare($koneksi, $sql);

    if ($stmt === false) {
        die("Error preparing statement: " . mysqli_error($koneksi));
    }

    mysqli_stmt_bind_param($stmt, 's', $email); 
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // mengecek apakah email ditemukan
    if ($result && mysqli_num_rows($result) > 0) {
        // mengambil data pengguna
        $row = mysqli_fetch_assoc($result);

        // verifikasi password
        if (password_verify($requestPassword, $row['password'])) {
            
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['email'] = $row['email']; // menyimpan email pengguna di session
            $_SESSION['first_name'] = $row['first_name']; // menyimpan first_name di session

            // set cookie jika "Ingat Saya" dicentang
            if (isset($_POST['remember'])) {
                setcookie('email', $row['email'], time() + (86400 * 30), "/", "", true, true); 
            }

            
            header("Location: dashboard.php");
            exit;
        } else {
            
            $_SESSION['error_message'] = "Password Anda salah.";
            header("Location: login.php");
            exit;
        }
    } else {

        $_SESSION['error_message'] = "Email tidak ditemukan.";
        header("Location: login.php");
        exit;
    }


    mysqli_stmt_close($stmt);
    mysqli_close($koneksi);
}
?>

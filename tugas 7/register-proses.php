<?php
include 'koneksi.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    
    if ($password !== $confirm_password) {
        echo "<script>alert('Password dan Confirm Password tidak cocok!'); window.location='register.php';</script>";
        exit;
    }

    // mengecek apakah email sudah terdaftar
    $query = "SELECT * FROM tb_register WHERE email = '$email'";
    $result = mysqli_query($koneksi, $query);
    
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email sudah terdaftar!'); window.location='register.php';</script>";
    } else {
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        
        $insertQuery = "INSERT INTO tb_register (email, password, first_name, last_name) 
                        VALUES ('$email', '$hashed_password', '$first_name', '$last_name')";

        if (mysqli_query($koneksi, $insertQuery)) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan. Silakan coba lagi!'); window.location='register.php';</script>";
        }
    }
}
?>

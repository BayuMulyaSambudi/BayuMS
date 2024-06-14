<?php 
require 'koneksi.php';
session_start();

if(isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Query untuk mencari pengguna berdasarkan email dan password
    $query_sql = "SELECT * FROM tbl_users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query_sql);

    // Jika data ditemukan, mulai sesi dan arahkan ke halaman index
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        header("Location: CRUD_INVENTORY/index.php");
        exit;
    } else {
        // Jika tidak, tampilkan pesan kesalahan dan arahkan kembali ke halaman login
        echo "<script>alert('Email atau Password salah!');window.location='index.html';</script>";
        exit;
    }
}
?>

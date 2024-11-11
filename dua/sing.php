<?php
// Menghubungkan file ke koneksi database
include "koneksi.php";

// Verifikasi apakah pengguna telah login, jika ya, arahkan ke halaman indeks
session_start();
if (isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Verifikasi apakah pengguna mengklik tombol "Sign Up"
if (isset($_POST['submit'])) {
    // Ambil data dari form pendaftaran
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Simpan data ke dalam database
    mysqli_query($koneksi, "INSERT INTO login (Username, Password) VALUES ('$username', '$password')");

    // Arahkan pengguna ke halaman login setelah berhasil mendaftar
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="style3.css">
</head>
<body>
    <div class="container">
        <h1>SIGN UP</h1>
        <form action="sing.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" maxlength="8" required>
            <button type="submit" name="submit">Sign Up</button>
        </form>
        <div class="login-option">
            Sudah punya akun? <a href="login.php">Login</a>
        </div>
    </div>
</body>
</html>
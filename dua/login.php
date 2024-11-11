<?php
session_start(); // Memulai session

include "koneksi.php";

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa apakah pengguna terdaftar dalam database
    $query = mysqli_query($koneksi, "SELECT * FROM login WHERE Username = '$username' AND Password = '$password'");
    $result = mysqli_fetch_assoc($query);

    if ($result) {
        // Pengguna ditemukan, set session dan arahkan ke halaman indeks
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        // Pengguna tidak ditemukan, arahkan ke halaman pendaftaran
        header("Location: sing.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
    <link rel="stylesheet" type="text/css" href="style3.css">
</head>
<body>
    <div class="container">
        <h1>SIGN IN</h1>
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" maxlength="8" required>
            <button type="submit" name="submit">Login</button>
        </form>
        <div class="signup-option">
            Belum punya akun? <a href="sing.php">Sign Up</a>
        </div>
    </div>
</body>
</html>

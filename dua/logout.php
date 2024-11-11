<?php
session_start(); // Memulai session

// Hapus semua data session
session_unset();

// Hancurkan session
session_destroy();

// Redirect ke halaman login atau halaman lainnya jika diperlukan
header('Location: login.php');
exit();
?>

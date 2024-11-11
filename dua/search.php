<?php
// Membuat koneksi ke database
include "koneksi.php";

// Mengecek apakah form pencarian telah disubmit
if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];

    // Mengambil data resep dari database berdasarkan kata kunci
    $query = "SELECT * FROM unggah WHERE Nama LIKE '%$keyword%'";
    $result = mysqli_query($koneksi, $query);
} else {
    // Mengambil semua data resep jika tidak ada pencarian
    $result = mysqli_query($koneksi, "SELECT * FROM unggah");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cari Resep</title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="search.php">Cari Resep</a></li>
                <li><a href="upload.php">Upload Resep</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h1>Resep Makanan Nusantara</h1>
        <div class="search-container">
            <form action="search.php" method="POST">
                <input type="text" name="keyword" placeholder="Cari Resep" required>
                <button type="submit" name="search">Cari</button>
            </form>
        </div>
        <div class="recipes">
            <?php
            // Menampilkan resep-resep yang diunggah
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="recipe">';
                echo '<img src="' . $row['foto'] . '" alt="' . $row['Nama'] . '">';
                echo '<h3>' . $row['Nama'] . '</h3>';
                echo '<p>' . $row['deskripsi'] . '</p>';
                if (isset($row['id'])) {
                    echo '<a href="recipe.php?id=' . $row['id'] . '">Lihat Resep</a>';
                }
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>

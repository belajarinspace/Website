<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_POST['hapus'])) {
        // Proses penghapusan data resep dan data terkait dari tabel di database
        $query_delete_resep = "DELETE FROM unggah WHERE id = $id";
        $query_delete_bahan = "DELETE FROM bahan WHERE id_resep = $id";
        $query_delete_langkah = "DELETE FROM langkah_memasak WHERE id_resep = $id";

        // Jalankan query penghapusan
        if (mysqli_query($koneksi, $query_delete_langkah) && mysqli_query($koneksi, $query_delete_bahan) && mysqli_query($koneksi, $query_delete_resep)) {
            // Penghapusan berhasil, redirect ke halaman utama
            header('Location: index.php');
            exit();
        } else {
            // Penghapusan gagal
            echo "Gagal menghapus resep.";
        }
    }

    // Mengambil data resep dari database berdasarkan id
    $query = "SELECT * FROM unggah WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
} else {
    // Jika parameter id tidak diberikan, redirect ke halaman utama
    header('Location: index.php');
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Lihat Resep - Resep Makanan Nusantara</title>
    <link rel="stylesheet" type="text/css" href="resep.css">
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
        <h1><?php echo $row['Nama']; ?></h1>
        <img src="<?php echo $row['foto']; ?>" alt="<?php echo $row['Nama']; ?>">
        <p><?php echo $row['deskripsi']; ?></p>

        <h2>Bahan:</h2>
        <ul>
            <?php
            $query_bahan = "SELECT * FROM bahan WHERE id_resep = $id";
            $result_bahan = mysqli_query($koneksi, $query_bahan);

            while ($row_bahan = mysqli_fetch_assoc($result_bahan)) {
                echo '<li>' . $row_bahan['nama_bahan'] . ' - ' . $row_bahan['jumlah'] . '</li>';
            }
            ?>
        </ul>

        <h2>Cara Memasak:</h2>
        <ol>
            <?php
            $query_langkah = "SELECT * FROM langkah_memasak WHERE id_resep = $id";
            $result_langkah = mysqli_query($koneksi, $query_langkah);

            while ($row_langkah = mysqli_fetch_assoc($result_langkah)) {
                echo '<li>' . $row_langkah['langkah'] . '</li>';
            }
            ?>
        </ol>


        <form action="" method="POST" onsubmit="return confirm('Apakah Anda yakin untuk menghapus resep?')">
            <button type="submit" name="hapus">Hapus Resep</button>
        </form>
    </div>
</body>
</html>

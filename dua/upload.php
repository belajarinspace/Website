<?php
include "koneksi.php";

if(isset($_POST['submit'])) {
    $judul = $_POST['Nama'];
    $deskripsi = $_POST['deskripsi'];
    $file = $_FILES["gambar"];
    $gambar_tmp = $file['tmp_name'];
    $gambar_path = "submit" . $file['name'];
    move_uploaded_file($gambar_tmp, $gambar_path);

    // Memasukkan data resep ke dalam database
    $query = "INSERT INTO unggah (Nama, deskripsi, foto) VALUES ('$judul', '$deskripsi', '$gambar_path')";
    if (mysqli_query($koneksi, $query)) {
        // Upload dan penyimpanan data berhasil
        $id_resep = mysqli_insert_id($koneksi); // Mendapatkan ID resep yang baru diunggah

        // Memasukkan data bahan ke dalam database
        if(isset($_POST['bahan'])) {
            $bahan = $_POST['bahan'];

            foreach($bahan['nama_bahan'] as $key => $nama_bahan) {
                $jumlah = $bahan['jumlah'][$key];
                $query_bahan = "INSERT INTO bahan (id_resep, nama_bahan, jumlah) VALUES ('$id_resep', '$nama_bahan', '$jumlah')";
                mysqli_query($koneksi, $query_bahan);
            }
        }

        // Memasukkan data langkah memasak ke dalam database
        if(isset($_POST['langkah'])) {
            $langkah = $_POST['langkah'];

            foreach($langkah as $langkah_memasak) {
                $query_langkah = "INSERT INTO langkah_memasak (id_resep, langkah) VALUES ('$id_resep', '$langkah_memasak')";
                mysqli_query($koneksi, $query_langkah);
            }
        }

        header('Location: index.php');
        exit();
    } 
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Resep</title>
    <link rel="stylesheet" type="text/css" href="upload3.css">
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
        <h1>Upload Resep Makanan</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="Nama" placeholder="Nama resep" required>
            <textarea name="deskripsi" placeholder="Deskripsi" required></textarea>
            <h2>Bahan:</h2>
            <div id="bahan-container">
                <div>
                    <input type="text" name="bahan[nama_bahan][]" placeholder="Nama bahan" required>
                    <input type="text" name="bahan[jumlah][]" placeholder="Jumlah" required>
                </div>
            </div>
            <button type="button" id="tambah-bahan">Tambah Bahan</button>
            <h2>Cara Memasak:</h2>
            <ol>
                <li><input type="text" name="langkah[]" placeholder="Langkah" required></li>
            </ol>
            <button type="button" id="tambah-langkah">Tambah Langkah</button>
            <input type="file" name="gambar" required>
            <button type="submit" name="submit">Upload</button>
        </form>
        <script src="tambah.js"></script>
    </div>
</body>
</html>

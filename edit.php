<?php
   require 'functions.php';

    // Pastikan ada parameter 'id' dan 'table' di URL
    if (isset($_GET['id']) && isset($_GET['table'])) {
        $id = $_GET['id'];
        $table = $_GET['table'];

        // Ambil data dari tabel sesuai dengan id
        if ($table == 'menu') {
            $item = query("SELECT * FROM menu WHERE id = $id")[0];
        } elseif ($table == 'products') {
            $item = query("SELECT * FROM products WHERE id = $id")[0];
        } else {
            echo "Tabel tidak ditemukan!";
            exit;
        }
    } else {
        echo "ID atau tabel tidak ditemukan!";
        exit;
    }

    // Proses jika form disubmit
    if (isset($_POST['submit'])) {
        // Cek jika ada gambar baru yang diupload
        if ($_FILES['img']['error'] === UPLOAD_ERR_OK) {
            // Tentukan nama file gambar baru
            $img = $_FILES['img']['name'];
            $tmp_name = $_FILES['img']['tmp_name'];
            $upload_dir = 'img/' . $table . '/';
            $target_file = $upload_dir . basename($img);

            // Jika gambar lama ada, hapus gambar lama terlebih dahulu
            $old_img_path = $upload_dir . $item['img'];  // Path gambar lama
            if (file_exists($old_img_path)) {
                unlink($old_img_path);  // Hapus gambar lama
            }

            // Pindahkan file gambar baru ke direktori yang sesuai
            if (move_uploaded_file($tmp_name, $target_file)) {
                // File berhasil diupload, simpan nama file ke database
                $img = basename($img); // Simpan hanya nama file
            } else {
                echo "Gambar gagal diupload.";
                exit;
            }
        } else {
            // Jika tidak ada gambar baru, gunakan gambar lama
            $img = $item['img'];
        }

        // Update data termasuk nama gambar
        if (update($table, $id, $_POST, $img) > 0) {
            echo "
                <script>
                    alert('Data berhasil diupdate!');
                    document.location.href = 'admin.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Data gagal diupdate!');
                    document.location.href = 'admin.php';
                </script>
            ";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit - Golden Bites</title>
    <link rel="stylesheet" href="css/edit.css">
</head>
<body>
        <a href="admin.php" class="back-button">Back to Admin</a>

    <h1>Edit <?= ucfirst($table); ?></h1>

    <!-- Form Edit Data -->
    <form action="" method="post" enctype="multipart/form-data">
        <h3>Current Image Preview:</h3>
        <img src="img/<?= $table; ?>/<?= $item['img']; ?>" alt="Current Image" style="max-width: 200px; height: auto; margin-bottom: 20px;">
        <label for="name">Nama:</label>
        <input type="text" name="name" id="name" value="<?= $item['name']; ?>" required><br><br>

        <label for="price">Harga:</label>
        <input type="number" name="price" id="price" value="<?= $item['price']; ?>" required><br><br>

        <label for="img">Image URL:</label>
        <input type="file" name="img" id="img" value="<?= $item['img']; ?>"><br><br>

        <div class="button-group">
            <button type="submit" name="submit">Update</button>
        </div>
    </form>
    <!-- Back Button -->
    
</body>
</html>

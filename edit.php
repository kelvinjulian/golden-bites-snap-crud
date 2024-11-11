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
    // Periksa apakah data berhasil diupdate
    if (update($table, $id, $_POST) > 0) {
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
    <form action="" method="post">
        <h3>Current Image Preview:</h3>
        <img src="img/<?= $table; ?>/<?= $item['img']; ?>" alt="Current Image" style="max-width: 200px; height: auto; margin-bottom: 20px;">
        <label for="name">Nama:</label>
        <input type="text" name="name" id="name" value="<?= $item['name']; ?>" required><br><br>

        <label for="price">Harga:</label>
        <input type="number" name="price" id="price" value="<?= $item['price']; ?>" required><br><br>

        <label for="img">Image URL:</label>
        <input type="text" name="img" id="img" value="<?= $item['img']; ?>"><br><br>

        <div class="button-group">
            <button type="submit" name="submit">Update</button>
        </div>
    </form>
    <!-- Back Button -->
    
</body>
</html>

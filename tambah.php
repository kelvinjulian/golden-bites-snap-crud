<?php 
    require 'functions.php';

    //! Cek apakah tombol submit untuk menu ditekan
    if (isset($_POST["submit_menu"])) {
    
        // cek apakah data berhasil ditambahkan atau tidak
        if (tambah('menu', $_POST) > 0) {
            echo "
                <script>
                    alert('data berhasil ditambahkan!');
                    document.location.href = 'admin.php';
                </script>
            ";
        } else{
            echo "
                <script>
                    alert('data gagal ditambahkan!');
                    document.location.href = 'admin.php';
                </script>
            ";
        }

    }

    //! Cek apakah tombol submit untuk produk ditekan
    if (isset($_POST["submit_product"])) {
    
        // cek apakah data berhasil ditambahkan atau tidak
        if (tambah('products', $_POST) > 0) {
            echo "
                <script>
                    alert('data berhasil ditambahkan!');
                    document.location.href = 'admin.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('data gagal ditambahkan!');
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Toko</title>
    <link rel="stylesheet" href="css/tambah.css">
</head>
<body>
        <!-- "Back to Admin" Button -->
        <div class="back-btn">
            <a href="admin.php" class="back-button">Back to Admin</a>
        </div>

        <!-- Menu Form -->
        <h1>Tambah Data Menu</h1>
        <form action="" method="post" class="form-container" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name : </label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="price">Price : </label>
                <input type="number" name="price" id="price" required>
            </div>
            <div class="form-group">
                <label for="img">Image : </label>
                <input type="file" name="img" id="img" required oninput="previewImage()">
            </div>
            <div class="form-group">
                <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 200px; margin-top: 10px;">
            </div>
            <div class="form-actions">
                <button type="submit" name="submit_menu" class="submit-btn">Tambah Menu</button>
            </div>
        </form>

        <!-- Product Form -->
        <h1>Tambah Data Produk</h1>
        <form action="" method="post" class="form-container" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name : </label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="price">Price : </label>
                <input type="number" name="price" id="price" required>
            </div>
            <div class="form-group">
                <label for="img">Image : </label>
                <input type="file" name="img" id="img" required oninput="previewImage()">
            </div>
            <div class="form-group">
                <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 200px; margin-top: 10px;">
            </div>
            <div class="form-actions">
                <button type="submit" name="submit_product" class="submit-btn">Tambah Produk</button>
            </div>
        </form>

</body>
</html>

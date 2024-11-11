<?php 
// koneksi ke database 
require 'functions.php';

// ambil data menu dan produk
$menu = query("SELECT * FROM menu");
$products = query("SELECT * FROM products");

// tampilkan halaman admin
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Golden Bites</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="container">
        

        <h1>Admin Panel - Golden Bites</h1>

        <!-- Tabel Menu -->
        <section>
            <h2>Menu</h2>
            <table border="1">
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
                <?php $i = 1; foreach ($menu as $item): ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><img src="img/menu/<?= $item['img']; ?>" alt="<?= $item['name']; ?>" style="max-width: 100px;"></td>
                    <td><?= $item['name']; ?></td>
                    <td>IDR <?= number_format($item['price'], 0, ',', '.'); ?></td>
                    <td>
                        <a href="edit.php?id=<?= $item['id']; ?>&table=menu">Edit</a> |
                        <a href="hapus.php?id=<?= $item['id']; ?>&table=menu" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </section>

        <!-- Tabel Produk -->
        <section>
            <h2>Products</h2>
            <table border="1">
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
                <?php $i = 1; foreach ($products as $product): ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><img src="img/products/<?= $product['img']; ?>" alt="<?= $product['name']; ?>" style="max-width: 100px;"></td>
                    <td><?= $product['name']; ?></td>
                    <td>IDR <?= number_format($product['price'], 0, ',', '.'); ?></td>
                    <td>
                        <a href="edit.php?id=<?= $product['id']; ?>&table=products">Edit</a> |
                        <a href="hapus.php?id=<?= $product['id']; ?>&table=products" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </section>
            <a href="tambah.php" class="button">Tambah Menu/Produk</a>
    </div>
</body>
</html>

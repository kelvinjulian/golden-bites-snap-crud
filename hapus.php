<?php 
require 'functions.php';  // Pastikan fungsi.php sudah terhubung dengan database

// Cek apakah ada ID yang diterima melalui URL
if (isset($_GET['id']) && isset($_GET['table'])) {
    $id = $_GET['id'];        // ID data yang akan dihapus
    $table = $_GET['table'];  // Nama tabel (menu atau products)
    
    // Memanggil fungsi hapus untuk menghapus data dari tabel yang sesuai
    if (hapus($table, $id) > 0) {
        echo "
            <script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';  // Redirect ke halaman utama
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal dihapus!');
                document.location.href = 'index.php';  // Redirect ke halaman utama
            </script>
        ";
    }
} else {
    // Jika tidak ada ID atau tabel yang diberikan, redirect ke halaman utama
    echo "
        <script>
            alert('ID atau tabel tidak ditemukan!');
            document.location.href = 'index.php';
        </script>
    ";
}
?>

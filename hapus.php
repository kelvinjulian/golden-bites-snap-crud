<?php
    require 'functions.php';  // Pastikan fungsi.php sudah terhubung dengan database

    // Cek apakah ada ID dan tabel yang diterima melalui URL
    if (isset($_GET['id']) && isset($_GET['table'])) {
        // Ambil ID dan tabel dari URL
        $id = $_GET['id'];
        $table = $_GET['table'];

        // Validasi tabel yang diterima, hanya "menu" dan "products" yang diperbolehkan
        if ($table === 'menu' || $table === 'products') {
            // Panggil fungsi hapus untuk menghapus data
            if (hapus($table, $id) > 0) {
                echo "
                    <script>
                        alert('Data berhasil dihapus!');
                        document.location.href = 'admin.php';  // Redirect ke halaman utama
                    </script>
                ";
            } else {
                echo "
                    <script>
                        alert('Data gagal dihapus!');
                        document.location.href = 'admin.php';  // Redirect ke halaman utama
                    </script>
                ";
            }
        } else {
            // Jika tabel yang diterima tidak valid, redirect ke halaman utama
            echo "
                <script>
                    alert('Tabel tidak valid!');
                    document.location.href = 'admin.php';
                </script>
            ";
        }
    } else {
        // Jika tidak ada ID atau tabel yang diberikan, redirect ke halaman utama
        echo "
            <script>
                alert('ID atau tabel tidak ditemukan!');
                document.location.href = 'admin.php';
            </script>
        ";
    }
?>

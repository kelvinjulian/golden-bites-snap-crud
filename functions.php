<?php 
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "golden_bites");

// ambil data menu
function query($query) {
    global $conn;
    $menu = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($menu)) {
        $rows[] = $row;
    }
    return $rows;
}

//! Fungsi tambah untuk menambahkan data ke tabel yang ditentukan
function tambah($table, $data) {
    global $conn;

    // Ambil data dari array $data
    $name = htmlspecialchars($data["name"]);
    $price = htmlspecialchars($data["price"]);

    // Tentukan folder tujuan berdasarkan tabel
    $folderType = ($table === 'menu') ? 'menu' : 'products';

    // Upload gambar
    $img = upload($folderType);
    if (!$img) {
        return false;
    }

    // kegunaan htmlspecialchars adalah untuk mencegah serangan sql injection

    // Query untuk menambahkan data ke tabel yang ditentukan
    $query = "INSERT INTO $table (name, price, img) VALUES ('$name', '$price', '$img')";

    // Eksekusi query
    mysqli_query($conn, $query);
    
    // Mengembalikan jumlah baris yang terpengaruh (untuk pengecekan keberhasilan)
    return mysqli_affected_rows($conn);
}

//! Fungsi upload untuk mengupload gambar
function upload($type) {
    $fileName = $_FILES['img']['name'];
    $fileSize = $_FILES['img']['size'];
    $error = $_FILES['img']['error'];
    $tmpName = $_FILES['img']['tmp_name'];

    // Cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>alert('Pilih gambar terlebih dahulu!');</script>";
        return false;
    }

    // Cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>alert('Yang Anda upload bukan gambar!');</script>";
        return false;
    }

    // Cek jika ukurannya terlalu besar
    if ($fileSize > 1000000) {
        echo "<script>alert('Ukuran gambar terlalu besar! Maksimal 1MB.');</script>";
        return false;
    }

    // Membuat nama unik untuk file
    $namaFileBaru = uniqid() . '.' . $ekstensiGambar;

    // Tentukan path folder tujuan berdasarkan $type
    $targetDir = $type === 'menu' ? 'img/menu/' : 'img/products/';
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true); // Buat folder jika belum ada
    }

    // Lolos pengecekan, gambar siap diupload
    if (move_uploaded_file($tmpName, $targetDir . $namaFileBaru)) {
        return $namaFileBaru;
    } else {
        echo "<script>alert('Gagal mengupload gambar!');</script>";
        return false;
    }
}


//! Fungsi hapus untuk menghapus data dan gambar
function hapus($table, $id) {
    global $conn;

    // Ambil nama gambar dari database berdasarkan ID
    $query = "SELECT img FROM $table WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    if ($data) {
        $img = $data['img'];
        // Tentukan folder berdasarkan tabel
        $folder = ($table === 'menu') ? 'img/menu/' : 'img/products/';
        $filePath = $folder . $img;

        // Hapus gambar dari folder jika file ada
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Query untuk menghapus data dari tabel
        $query = "DELETE FROM $table WHERE id = $id";
        mysqli_query($conn, $query);

        // Mengecek apakah penghapusan berhasil
        return mysqli_affected_rows($conn);
    } else {
        return false; // Data tidak ditemukan
    }
}
 

//! Fungsi update untuk mengupdate data
function update($table, $id, $data, $img) {
    global $conn;

    // Ambil data dari array $data
    $name = htmlspecialchars($data["name"]);
    $price = htmlspecialchars($data["price"]);

    // Query untuk mengupdate data berdasarkan id
    $query = "UPDATE $table SET name = '$name', price = '$price', img = '$img' WHERE id = $id";

    // Eksekusi query
    mysqli_query($conn, $query);

    // Mengembalikan jumlah baris yang terpengaruh (untuk pengecekan keberhasilan)
    return mysqli_affected_rows($conn);
}



?>



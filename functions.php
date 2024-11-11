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
    $img = htmlspecialchars($data["img"]);
    // kegunaan htmlspecialchars adalah untuk mencegah serangan sql injection

    // Query untuk menambahkan data ke tabel yang ditentukan
    $query = "INSERT INTO $table (name, price, img) VALUES ('$name', '$price', '$img')";

    // Eksekusi query
    mysqli_query($conn, $query);
    
    // Mengembalikan jumlah baris yang terpengaruh (untuk pengecekan keberhasilan)
    return mysqli_affected_rows($conn);
}

//! Fungsi hapus untuk menghapus data dari tabel yang ditentukan
function hapus($table, $id) {
    global $conn;

    // Query untuk menghapus data berdasarkan ID dari tabel yang ditentukan
    $query = "DELETE FROM $table WHERE id = $id";

    // Eksekusi query
    mysqli_query($conn, $query);
    
    // Mengembalikan jumlah baris yang terpengaruh (untuk pengecekan keberhasilan)
    return mysqli_affected_rows($conn);
}

//! Fungsi update untuk mengupdate data di tabel yang ditentukan
function update($table, $id, $data) {
    global $conn;

    // Ambil data dari array $data
    $name = htmlspecialchars($data["name"]);
    $price = htmlspecialchars($data["price"]);
    $img = htmlspecialchars($data["img"]);

    // Query untuk mengupdate data berdasarkan id
    $query = "UPDATE $table SET name = '$name', price = '$price', img = '$img' WHERE id = $id";

    // Eksekusi query
    mysqli_query($conn, $query);

    // Mengembalikan jumlah baris yang terpengaruh (untuk pengecekan keberhasilan)
    return mysqli_affected_rows($conn);
}


?>



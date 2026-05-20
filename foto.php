<?php
include 'koneksi.php';

$id = $_GET['id'] ?? 0;

// Ambil data siswa
$stmt = $conn->prepare("SELECT foto FROM siswa WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if ($data && file_exists("laki-laki" . $data['foto'])) {
    $file = "laki-laki" . $data['foto'];
    

    // Ambil tipe file (jpg/png)
    $ext = pathinfo($file, PATHINFO_EXTENSION);

    if ($ext == "jpg" || $ext == "jpeg") {
        header("Content-Type: img/jpeg");
    } elseif ($ext == "png") {
        header("Content-Type: image/png");
    }

    readfile($file);
} else {
    // Kalau foto tidak ada
    header("Content-Type: image/png");
    readfile("img/default.png");
}
?>
<?php
include 'koneksi.php';
   
 
    if(isset($_POST['simpan'])){
    $stmt = $conn->prepare("INSERT INTO siswa 
        (id_siswa, nama, jk, tgl_daftar, kelas, foto)
        VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->execute([
        $_POST['id_siswa'],
        $_POST['nama'],
        $_POST['jk'],
        $_POST['tgl'],
        $_POST['kelas'],
        $_FILES['foto']['name']
    ]);

    move_uploaded_file($_FILES['foto']['tmp_name'], "img/".$_FILES['foto']['name']);
// Ambil data dari database (misalnya variabel $jk berasal dari kolom 'jk')
$jk = $row['jk']; 

if ($jk == "laki-laki") {
    // Menampilkan gambar khusus untuk laki-laki
    echo '<img src="img/laki-laki.jpeg" alt="Laki-laki" width="50">';
} else {
    // Menampilkan gambar lain (misal perempuan)
    echo '<img src="img/icon-cewek.png" alt="Perempuan" width="50">';
}
    
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>FORM SISWA</title>

    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', sans-serif;
    }

    body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #ff9a9e, #fad0c4, #a18cd1, #fbc2eb);
        background-size: 400% 400%;
        animation: gradientBG 10s ease infinite;
    }
body::before {
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    background: url('img/bg.png');
    background-repeat: repeat;
    background-size: 200px;
    opacity: 0.08; /* atur transparansi di sini */
    z-index: 0;
    }
.card {
    position: relative;
    z-index: 1;
}


    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .container {
        background: rgba(255, 255, 255, 0.95);
        padding: 30px 40px;
        border-radius: 15px;
        width: 350px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        backdrop-filter: blur(10px);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #6a11cb;
    }

    input {
        width: 100%;
        padding: 10px;
        margin: 8px 0 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        outline: none;
        transition: 0.3s;
    }

    input:focus {
        border-color: #a18cd1;
        box-shadow: 0 0 8px rgba(161, 140, 209, 0.5);
    }

    button {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 10px;
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
    }

    button:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }

    input[type="file"] {
        border: none;
    }
    </style>
</head>

<body>

<div class="container">
    <h2>FORM SISWA</h2>

<form method="POST" enctype="multipart/form-data">
    ID SISWA: <input type="text" name="id_siswa"><br>
    NAMA: <input type="text" name="nama"><br>
    JENIS KELAMIN: <input type="text" name="jk"><br>
    TANGGAL: <input type="date" name="tgl"><br>
    KELAS: <input type="text" name="kelas"><br>
    FOTO: <input type="file" name="foto"><br>

    <button name="simpan">SAVE</button>
</form>
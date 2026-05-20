<?php
include 'koneksi.php';

$id = $_GET['id'];

if(isset($_POST['update'])){
    $stmt = $conn->prepare("UPDATE siswa SET 
        id_siswa=?, nama=?, jk=?, tgl_daftar=?, kelas=? 
        WHERE id=?");

    $stmt->execute([
        $_POST['id_siswa'],
        $_POST['nama'],
        $_POST['jk'],
        $_POST['tgl'],
        $_POST['kelas'],
        $id
    ]);

    header("Location: index.php");
}

$data = $conn->query("SELECT * FROM siswa WHERE id=$id")->fetch();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Siswa</title>

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
        width: 380px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        backdrop-filter: blur(10px);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #6a11cb;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        font-size: 14px;
        margin-bottom: 5px;
        color: #333;
    }

    input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
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
    </style>
</head>

<body>

<div class="container">
    <h2>EDIT DATA SISWA</h2>

<form method="POST">
    ID SISWA: <input type="text" name="id_siswa" value="<?= $data['id_siswa']; ?>"><br>
    NAMA: <input type="text" name="nama" value="<?= $data['nama']; ?>"><br>
    JENIS KELAMIN: <input type="text" name="jk" value="<?= $data['jk']; ?>"><br>
    TANGGAL: <input type="date" name="tgl" value="<?= $data['tgl_daftar']; ?>"><br>
    KELAS: <input type="text" name="kelas" value="<?= $data['kelas']; ?>"><br>

    <button name="update">Update</button>
</form>
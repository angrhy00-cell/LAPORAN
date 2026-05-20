<?php
include 'koneksi.php';

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM siswa WHERE id=?");
$stmt->execute([$id]);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hapus Data</title>

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

    .box {
        background: rgba(255, 255, 255, 0.95);
        padding: 30px;
        border-radius: 15px;
        text-align: center;
        width: 320px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        backdrop-filter: blur(10px);
    }

    h2 {
        color: #ea4335;
        margin-bottom: 10px;
    }

    p {
        color: #333;
        margin-bottom: 15px;
    }

    .loading {
        width: 40px;
        height: 40px;
        border: 5px solid #ddd;
        border-top: 5px solid #ea4335;
        border-radius: 50%;
        margin: 0 auto;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        100% { transform: rotate(360deg); }
    }
    </style>

    <!-- Auto redirect -->
    <meta http-equiv="refresh" content="2;url=index.php">
</head>

<body>

<div class="box">
    <h2>Data Dihapus</h2>
    <p>Data siswa berhasil dihapus...</p>
    <div class="loading"></div>
</div>

</body>
</html>
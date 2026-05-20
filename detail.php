<?php
include 'koneksi.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM siswa WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Siswa</title>

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
        position: relative;
        overflow: hidden;
    }

    /* background gambar transparan */
    body::before {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        background: url('img/bg.png');
        background-repeat: repeat;
        background-size: 200px;
        opacity: 0.08;
        z-index: 0;
    }

    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* CARD LANDSCAPE */
    .card {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 25px;

        background: rgba(255, 255, 255, 0.95);
        padding: 30px;
        border-radius: 15px;
        width: 650px;

        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        backdrop-filter: blur(10px);
    }

    /* kiri (gambar) */
    .left {
        text-align: center;
    }

    .left img {
        border-radius: 50%;
        width: 120px;
        box-shadow: 0 5px 10px rgba(0,0,0,0.2);
    }

    .left h2 {
        margin-top: 10px;
        color: #6a11cb;
        font-size: 18px;
    }

    /* kanan (data) */
    .right {
        flex: 1;
    }

   table {
    width: 100%;
    border-collapse: collapse;
    background: rgba(255, 255, 255, 0.15); /* transparan */
    backdrop-filter: blur(8px); /* efek kaca */
    border-radius: 10px;
    overflow: hidden;
}

td {
    padding: 8px;
    font-size: 14px;
    color: #222;
}

td.label {
    font-weight: bold;
    color: #6a11cb;
}

/* garis halus */
tr {
    border-bottom: 1px solid rgba(255,255,255,0.2);
}

/* selang-seling transparan */
tr:nth-child(even) {
    background: rgba(255,255,255,0.08);
}

/* hover */
tr:hover {
    background: rgba(255,255,255,0.2);
    transition: 0.3s;
}
    a {
        display: inline-block;
        margin-top: 15px;
        padding: 10px 15px;
        border-radius: 10px;
        text-decoration: none;
        color: white;
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        transition: 0.3s;
    }

    a:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 10px rgba(0,0,0,0.3);
    }

    </style>
</head>

<body>

<div class="card">

    <!-- KIRI -->
    <div class="left">
        <img src="img/<?= $data['jk'] == 'perempuan' ? 'perempuan.png' : 'laki-laki.png'; ?>">
        <h2>DETAIL SISWA</h2>
    </div>

    <!-- KANAN -->
    <div class="right">
        <table>
            <tr>
                <td class="label">ID</td>
                <td><?= $data['id_siswa']; ?></td>
            </tr>
            <tr>
                <td class="label">Nama</td>
                <td><?= $data['nama']; ?></td>
            </tr>
            <tr>
                <td class="label">Jenis Kelamin</td>
                <td><?= $data['jk']; ?></td>
            </tr>
            <tr>
                <td class="label">Tanggal</td>
                <td><?= $data['tgl_daftar']; ?></td>
            </tr>
            <tr>
                <td class="label">Kelas</td>
                <td><?= $data['kelas']; ?></td>
            </tr>
        </table>

        <a href="index.php">Kembali</a>
    </div>

</div>

</body>
</html>
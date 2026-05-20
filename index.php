<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>DATA SISWA</title>

    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', sans-serif;
    }

    body {
        min-height: 100vh;
        padding: 30px;
        display: flex;
        justify-content: center;
        background: linear-gradient(135deg, #ff9a9e, #fad0c4, #a18cd1, #fbc2eb);
        background-size: 400% 400%;
        animation: gradientBG 10s ease infinite;
        position: relative;
        overflow: hidden;
    }

    body::before {
        content: "";
        position: absolute;
        width: 100%;
        height: 200%;
        background: url('img/bg.png');
        background-repeat: repeat;
        background-size: 200px;
        opacity: 0.08;
        z-index: 0;
    }

    .container {
        width: 100%;
        max-width: 1100px;
        background: rgba(255, 255, 255, 0.95);
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        backdrop-filter: blur(10px);
        position: relative;
        z-index: 1;
    }
   
       h2 {
        margin-bottom: 15px;
        color: #6a11cb;
    }

    .btn-tambah {
        display: inline-block;
        margin-bottom: 15px;
        padding: 10px 15px;
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        color: white;
        border-radius: 8px;
        font-size: 14px;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-tambah:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }

    /* SEARCH */
    .search-box {
        margin-bottom: 15px;
        display: flex;
        gap: 10px;
    }

    .search-box input {
        padding: 8px;
        width: 250px;
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    .search-box input:focus {
        outline: none;
        border: 1px solid #6a11cb;
        box-shadow: 0 0 5px rgba(106,17,203,0.3);
    }

    .search-box button {
        padding: 8px 12px;
        border: none;
        border-radius: 8px;
        background: #6a11cb;
        color: white;
        cursor: pointer;
        transition: 0.3s;
    }

    .search-box button:hover {
        transform: scale(1.05);
    }

    table {
    width: 100%;
    border-collapse: collapse;
    background: #FFDDEC;
    border-radius: 10px;
    overflow: hidden;
}

th {
    background: #f1f3f9;
    padding: 12px;
    text-align: left;
    font-size: 14px;
    color: #555;
}

td {
    padding: 12px;
    border-top: 1px solid #eee;
    font-size: 14px;
}

tr:hover {
    background: #f9f9ff;

}

table {
    width: 100%;
    border-collapse: collapse;
    background: rgba(255, 255, 255, 0.15); /* transparan */
    backdrop-filter: blur(10px); /* efek kaca */
    border-radius: 10px;
    overflow: hidden;
}

th {
    background: rgba(255, 255, 255, 0.25);
    padding: 12px;
    text-align: left;
    font-size: 14px;
    color: #333;
}

td {
    padding: 12px;
    border-top: 1px solid rgba(255,255,255,0.2);
    font-size: 14px;
    color: #222;
}

tr:hover {
    background: rgba(255, 255, 255, 0.2);
}

/* baris selang-seling */
tr:nth-child(even) {
    background: rgba(255,255,255,0.08);
}

    td img {
        border-radius: 8px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.2);
    }

    .aksi a {
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 12px;
        margin-right: 5px;
        color: white;
        text-decoration: none;
        transition: 0.3s;
    }

    .detail { background: #f4b400; }
    .ubah { background: #4285f4; }
    .hapus { background: #ea4335; }

    .aksi a:hover {
        opacity: 0.8;
        transform: scale(1.05);
    }

    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    </style>
</head>

<body>

<div class="container">
    <h2>Data Siswa</h2>

    <a href="tambah.php" class="btn-tambah">+ Tambah Siswa</a>

    <!-- SEARCH -->
    <form method="GET" class="search-box">
        <input type="text" name="cari" placeholder="Cari nama / ID siswa..."
            value="<?= isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
        <button type="submit">Cari</button>
    </form>

    <table>
        <tr>
            <th>NO</th>
            <th>FOTO</th>
            <th>ID SISWA</th>
            <th>NAMA</th>
            <th>JENIS KELAMIN</th>
            <th>TANGGAL</th>
            <th>KELAS</th>
            <th>KETERANGAN</th>
        </tr>

        <?php
        $no = 1;
        $cari = isset($_GET['cari']) ? $_GET['cari'] : '';

        if($cari != ''){
            $stmt = $conn->prepare("SELECT * FROM siswa WHERE nama LIKE ? OR id_siswa LIKE ?");
            $keyword = "%$cari%";
            $stmt->execute([$keyword, $keyword]);
        } else {
            $stmt = $conn->prepare("SELECT * FROM siswa");
            $stmt->execute();
        }

        while($data = $stmt->fetch(PDO::FETCH_ASSOC)){
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><img src="img/<?= $data['foto']; ?>" width="50"></td>
            <td><?= $data['id_siswa']; ?></td>
            <td><?= $data['nama']; ?></td>
            <td><?= $data['jk']; ?></td>
            <td><?= $data['tgl_daftar']; ?></td>
            <td><?= $data['kelas']; ?></td>
            <td class="aksi">
                <a href="detail.php?id=<?= $data['id']; ?>" class="detail">Detail</a>
                <a href="ubah.php?id=<?= $data['id']; ?>" class="ubah">Ubah</a>
                <a href="hapus.php?id=<?= $data['id']; ?>" class="hapus" onclick="return confirm('Yakin?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
<?php
session_start();

if (!isset($_SESSION['level']) || $_SESSION['level'] != 'guru') {
    header("Location:index.php");
    exit;
}

include 'koneksi.php';

if (!isset($_GET['id'])) {
    header("Location:nilai.php");
    exit;
}

$id = (int)$_GET['id'];

$data = mysqli_query(
    $conn,
    "SELECT * FROM nilai WHERE id_nilai='$id'"
);

$nilai = mysqli_fetch_assoc($data);

if (!$nilai) {
    die("Data nilai tidak ditemukan!");
}

if (isset($_POST['hapus'])) {

    $hapus = mysqli_query(
        $conn,
        "DELETE FROM nilai WHERE id_nilai='$id'"
    );

    if ($hapus) {

        echo "
        <script>
            alert('Data nilai berhasil dihapus');
            window.location='nilai.php';
        </script>
        ";

        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Hapus Nilai</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;

    background:linear-gradient(
        135deg,
        #4facfe,
        #00f2fe,
        #43e97b
    );
}

.card{

    width:500px;

    background:rgba(255,255,255,0.15);

    backdrop-filter:blur(15px);

    border-radius:25px;

    padding:35px;

    border:1px solid rgba(255,255,255,0.3);

    text-align:center;

    color:white;

}

h1{
    margin-bottom:15px;
}

.info{
    margin:20px 0;
    line-height:2;
}

.btn-group{

    display:flex;
    gap:10px;

}

.btn{

    flex:1;

    padding:14px;

    border:none;

    border-radius:12px;

    cursor:pointer;

    font-weight:600;

    text-decoration:none;

    text-align:center;
}

.btn-hapus{

    background:#ff3b3b;
    color:white;
}

.btn-hapus:hover{

    background:#d60000;
}

.btn-batal{

    background:white;
    color:#0099ff;
}

.btn-batal:hover{

    background:#0099ff;
    color:white;
}

</style>
</head>
<body>

<div class="card">

    <h1>Hapus Nilai</h1>

    <p>Apakah Anda yakin ingin menghapus data berikut?</p>

    <div class="info">

        <strong>Nama Siswa :</strong><br>
        <?= htmlspecialchars($nilai['nama_siswa']); ?>
        <br><br>

        <strong>Mata Pelajaran :</strong><br>
        <?= htmlspecialchars($nilai['mapel']); ?>
        <br><br>

        <strong>Nilai :</strong><br>
        <?= htmlspecialchars($nilai['nilai']); ?>

    </div>

    <form method="POST">

        <div class="btn-group">

            <button
                type="submit"
                name="hapus"
                class="btn btn-hapus">

                Ya, Hapus

            </button>

            <a href="nilai.php"
               class="btn btn-batal">

               Batal

            </a>

        </div>

    </form>

</div>

</body>
</html>
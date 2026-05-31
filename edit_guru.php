<?php
session_start();

/* =========================
   CEK LOGIN
========================= */

if(!isset($_SESSION['level'])){

    header("Location:index.php");
    exit;

}

if($_SESSION['level'] != "kepsek"){

    header("Location:index.php");
    exit;

}

/* =========================
   KONEKSI DATABASE
========================= */

include 'koneksi.php';

/* =========================
   AMBIL ID GURU
========================= */

if(!isset($_GET['id'])){

    header("Location:data_guru.php");
    exit;

}

$id = (int)$_GET['id'];

$data = mysqli_query(
    $conn,
    "SELECT * FROM guru WHERE id_guru='$id'"
);

$guru = mysqli_fetch_assoc($data);

if(!$guru){

    die("Data guru tidak ditemukan!");

}

/* =========================
   UPDATE DATA
========================= */

if(isset($_POST['update'])){

    $nama_guru = mysqli_real_escape_string(
        $conn,
        $_POST['nama_guru']
    );

    $mapel = mysqli_real_escape_string(
        $conn,
        $_POST['mapel']
    );

    $alamat = mysqli_real_escape_string(
        $conn,
        $_POST['alamat']
    );

    $no_hp = mysqli_real_escape_string(
        $conn,
        $_POST['no_hp']
    );

    $update = mysqli_query(

        $conn,

        "UPDATE guru SET

        nama_guru = '$nama_guru',
        mapel     = '$mapel',
        alamat    = '$alamat',
        no_hp     = '$no_hp'

        WHERE id_guru = '$id'"

    );

    if($update){

        echo "

        <script>

            alert('Data guru berhasil diperbarui');

            window.location='data_guru.php';

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

<title>Edit Guru</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

    background:
    linear-gradient(
    135deg,
    #4facfe,
    #00f2fe,
    #43e97b
    );

    padding:20px;

}

.card{

    width:100%;
    max-width:700px;

    background:rgba(255,255,255,0.15);

    backdrop-filter:blur(15px);

    border:1px solid rgba(255,255,255,0.3);

    border-radius:25px;

    padding:35px;

    box-shadow:0 8px 32px rgba(0,0,0,0.2);

}

.title{

    text-align:center;
    color:white;
    margin-bottom:25px;

}

.title h1{

    font-size:30px;

}

.form-group{

    margin-bottom:18px;

}

label{

    display:block;
    color:white;
    margin-bottom:8px;
    font-weight:500;

}

input,
textarea{

    width:100%;

    padding:14px;

    border:none;

    border-radius:12px;

    outline:none;

}

textarea{

    height:120px;
    resize:none;

}

.button-group{

    display:flex;
    gap:10px;
    margin-top:20px;

}

.btn{

    flex:1;

    padding:14px;

    border:none;

    border-radius:12px;

    text-decoration:none;

    text-align:center;

    font-weight:600;

    cursor:pointer;

    transition:.3s;

}

.btn-update{

    background:#ff9800;
    color:white;

}

.btn-update:hover{

    background:#e68900;

}

.btn-back{

    background:white;
    color:#0099ff;

}

.btn-back:hover{

    background:#0099ff;
    color:white;

}

</style>

</head>
<body>

<div class="card">

    <div class="title">

        <h1>

            <i class="bi bi-pencil-square"></i>
            Edit Data Guru

        </h1>

        <p style="color:white;">
            Dashboard Kepala Sekolah
        </p>

    </div>

    <form method="POST">

        <div class="form-group">

            <label>Nama Guru</label>

            <input
                type="text"
                name="nama_guru"
                value="<?= htmlspecialchars($guru['nama_guru']); ?>"
                required>

        </div>

        <div class="form-group">

            <label>Mata Pelajaran</label>

            <input
                type="text"
                name="mapel"
                value="<?= htmlspecialchars($guru['mapel']); ?>"
                required>

        </div>

        <div class="form-group">

            <label>Alamat</label>

            <textarea
                name="alamat"
                required><?= htmlspecialchars($guru['alamat']); ?></textarea>

        </div>

        <div class="form-group">

            <label>No HP</label>

            <input
                type="text"
                name="no_hp"
                value="<?= htmlspecialchars($guru['no_hp']); ?>"
                required>

        </div>

        <div class="button-group">

            <button
                type="submit"
                name="update"
                class="btn btn-update">

                <i class="bi bi-save"></i>
                Update Data

            </button>

            <a href="data_guru.php"
               class="btn btn-back">

                <i class="bi bi-arrow-left"></i>
                Kembali

            </a>

        </div>

    </form>

</div>

</body>
</html>
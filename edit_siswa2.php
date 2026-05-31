<?php
session_start();

if(!isset($_SESSION['level']) || $_SESSION['level'] != "kepsek"){
    header("Location:index.php");
    exit;
}

include "koneksi.php";

/* =========================
   AMBIL ID SISWA
========================= */

$id = (int)$_GET['id'];

$data = mysqli_query(
    $conn,
    "SELECT * FROM siswa WHERE id_siswa='$id'"
);

$siswa = mysqli_fetch_assoc($data);

if(!$siswa){

    echo "
    <script>
        alert('Data siswa tidak ditemukan');
        window.location='data_siswa.php';
    </script>
    ";
    exit;
}

/* =========================
   UPDATE DATA
========================= */

if(isset($_POST['update'])){

    $nama_siswa = mysqli_real_escape_string(
        $conn,
        $_POST['nama_siswa']
    );

    $nis = mysqli_real_escape_string(
        $conn,
        $_POST['nis']
    );

    $kelas = mysqli_real_escape_string(
        $conn,
        $_POST['kelas']
    );

    $jenis_kelamin = mysqli_real_escape_string(
        $conn,
        $_POST['jenis_kelamin']
    );

    $alamat = mysqli_real_escape_string(
        $conn,
        $_POST['alamat']
    );

    $update = mysqli_query(

        $conn,

        "UPDATE siswa SET

        nama_siswa='$nama_siswa',
        nis='$nis',
        kelas='$kelas',
        jenis_kelamin='$jenis_kelamin',
        alamat='$alamat'

        WHERE id_siswa='$id'"

    );

    if($update){

        echo "
        <script>
            alert('Data siswa berhasil diupdate');
            window.location='data_siswa.php';
        </script>
        ";
        exit;

    }else{

        echo "
        <script>
            alert('Gagal mengupdate data');
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Siswa</title>

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
    background:linear-gradient(135deg,#4facfe,#00f2fe,#43e97b);
    padding:20px;
}

.card{
    width:100%;
    max-width:750px;
    background:rgba(255,255,255,0.15);
    backdrop-filter:blur(15px);
    border-radius:25px;
    padding:35px;
    border:1px solid rgba(255,255,255,0.3);
    box-shadow:0 8px 32px rgba(0,0,0,0.2);
}

h1{
    text-align:center;
    color:white;
    margin-bottom:25px;
}

.form-group{
    margin-bottom:18px;
}

label{
    display:block;
    color:white;
    margin-bottom:8px;
}

input,
select,
textarea{
    width:100%;
    padding:14px;
    border:none;
    border-radius:12px;
    outline:none;
}

textarea{
    resize:none;
    height:100px;
}

.btn-group{
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

    <h1>Edit Data Siswa</h1>

    <form method="POST">

        <div class="form-group">
            <label>Nama Siswa</label>
            <input
                type="text"
                name="nama_siswa"
                value="<?= htmlspecialchars($siswa['nama_siswa']); ?>"
                required>
        </div>

        <div class="form-group">
            <label>NIS</label>
            <input
                type="text"
                name="nis"
                value="<?= htmlspecialchars($siswa['nis']); ?>"
                required>
        </div>

        <div class="form-group">
            <label>Kelas</label>
            <input
                type="text"
                name="kelas"
                value="<?= htmlspecialchars($siswa['kelas']); ?>"
                required>
        </div>

        <div class="form-group">
            <label>Jenis Kelamin</label>

            <select name="jenis_kelamin" required>

                <option value="Laki-laki"
                <?= ($siswa['jenis_kelamin']=="Laki-laki") ? "selected" : ""; ?>>
                Laki-laki
                </option>

                <option value="Perempuan"
                <?= ($siswa['jenis_kelamin']=="Perempuan") ? "selected" : ""; ?>>
                Perempuan
                </option>

            </select>

        </div>

        <div class="form-group">
            <label>Alamat</label>

            <textarea
                name="alamat"
                required><?= htmlspecialchars($siswa['alamat']); ?></textarea>

        </div>

        <div class="btn-group">

            <button
                type="submit"
                name="update"
                class="btn btn-update">

                Update Data

            </button>

            <a
                href="data_siswa.php"
                class="btn btn-back">

                Kembali

            </a>

        </div>

    </form>

</div>

</body>
</html>
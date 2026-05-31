<?php
session_start();

if(!isset($_SESSION['level']) || $_SESSION['level'] != "kepsek"){
    header("Location:index.php");
    exit;
}

include "koneksi.php";

if(isset($_POST['simpan'])){

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

    $simpan = mysqli_query(

        $conn,

        "INSERT INTO siswa
        (
            nama_siswa,
            nis,
            kelas,
            jenis_kelamin,
            alamat
        )

        VALUES
        (
            '$nama_siswa',
            '$nis',
            '$kelas',
            '$jenis_kelamin',
            '$alamat'
        )"

    );

    if($simpan){

        echo "
        <script>
            alert('Data siswa berhasil ditambahkan');
            window.location='data_siswa_kepsek.php';
        </script>
        ";

        exit;

    }else{

        echo "
        <script>
            alert('Gagal menambahkan data siswa');
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

<title>Tambah Siswa</title>

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
    max-width:700px;
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
    height:100px;
    resize:none;
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

.btn-save{
    background:#00c853;
    color:white;
}

.btn-save:hover{
    background:#00a844;
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

    <h1>Tambah Data Siswa</h1>

    <form method="POST">

        <div class="form-group">
            <label>Nama Siswa</label>
            <input type="text" name="nama_siswa" required>
        </div>

        <div class="form-group">
            <label>NIS</label>
            <input type="text" name="nis" required>
        </div>

        <div class="form-group">
            <label>Kelas</label>
            <input type="text" name="kelas" required>
        </div>

        <div class="form-group">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" required></textarea>
        </div>

        <div class="btn-group">

            <button
                type="submit"
                name="simpan"
                class="btn btn-save">

                Simpan

            </button>

            <a
                href="dashboard_kepsek.php"
                class="btn btn-back">

                Kembali

            </a>

        </div>

    </form>

</div>

</body>
</html>
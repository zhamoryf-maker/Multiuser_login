<?php
session_start();

if(!isset($_SESSION['level']) || $_SESSION['level'] != "siswa"){
    header("Location:index.php");
    exit;
}

include "koneksi.php";

if(isset($_POST['simpan'])){

    $nama_siswa = mysqli_real_escape_string($conn, $_POST['nama_siswa']);
    $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
    $mata_pelajaran = mysqli_real_escape_string($conn, $_POST['mata_pelajaran']);
    $nilai = mysqli_real_escape_string($conn, $_POST['nilai']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);

    $simpan = mysqli_query($conn,
        "INSERT INTO nilai
        (
            nama_siswa,
            kelas,
            mata_pelajaran,
            nilai,
            keterangan
        )
        VALUES
        (
            '$nama_siswa',
            '$kelas',
            '$mata_pelajaran',
            '$nilai',
            '$keterangan'
        )"
    );

    if($simpan){
        echo "
        <script>
            alert('Nilai berhasil ditambahkan');
            window.location='nilai_siswa.php';
        </script>
        ";
        exit;
    }else{
        echo "
        <script>
            alert('Gagal menambahkan nilai');
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
<title>Tambah Nilai</title>

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
    max-width:650px;
    background:rgba(255,255,255,0.15);
    backdrop-filter:blur(15px);
    border-radius:25px;
    padding:35px;
    border:1px solid rgba(255,255,255,0.3);
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

input, select{
    width:100%;
    padding:14px;
    border:none;
    border-radius:12px;
    outline:none;
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
    font-weight:600;
    cursor:pointer;
    text-decoration:none;
    text-align:center;
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

    <h1>Tambah Nilai Siswa</h1>

    <form method="POST">

        <div class="form-group">
            <label>Nama Siswa</label>
            <input type="text" name="nama_siswa" required>
        </div>

        <div class="form-group">
            <label>Kelas</label>
            <input type="text" name="kelas" required>
        </div>

        <div class="form-group">
            <label>Mata Pelajaran</label>
            <input type="text" name="mata_pelajaran" required>
        </div>

        <div class="form-group">
            <label>Nilai</label>
            <input type="number" name="nilai" required>
        </div>

        <div class="form-group">
            <label>Keterangan</label>
            <select name="keterangan" required>
                <option value="">-- Pilih --</option>
                <option value="Baik">Baik</option>
                <option value="Cukup">Cukup</option>
                <option value="Kurang">Kurang</option>
            </select>
        </div>

        <div class="btn-group">

            <button type="submit" name="simpan" class="btn btn-save">
                Simpan
            </button>

            <a href="dashboard_siswa.php" class="btn btn-back">
                Kembali
            </a>

        </div>

    </form>

</div>

</body>
</html>
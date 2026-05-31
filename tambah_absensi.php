<?php
session_start();

if (!isset($_SESSION['level']) || $_SESSION['level'] != "guru") {
    header("Location:index.php");
    exit;
}

include 'koneksi.php';

if(isset($_POST['simpan'])){

    $nama_siswa = mysqli_real_escape_string(
        $conn,
        $_POST['nama_siswa']
    );

    $kelas = mysqli_real_escape_string(
        $conn,
        $_POST['kelas']
    );

    $tanggal = $_POST['tanggal'];

    $status_kehadiran = mysqli_real_escape_string(
    $conn,
    $_POST['status']
);

$query = mysqli_query(

    $conn,

    "INSERT INTO absensi
    (
        nama_siswa,
        kelas,
        tanggal,
        status_kehadiran
    )

    VALUES
    (
        '$nama_siswa',
        '$kelas',
        '$tanggal',
        '$status_kehadiran'
    )"

);

    if($query){

        echo "
        <script>
            alert('Data absensi berhasil ditambahkan');
            window.location='absensi.php';
        </script>
        ";

        exit;

    } else {

        echo "
        <script>
            alert('Gagal menyimpan data');
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

<title>Tambah Absensi</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

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

    padding:20px;

}

.card{

    width:100%;
    max-width:650px;

    background:rgba(255,255,255,0.15);

    backdrop-filter:blur(15px);

    border-radius:25px;

    border:1px solid rgba(255,255,255,0.3);

    padding:35px;

    box-shadow:0 8px 32px rgba(0,0,0,0.2);

}

h1{

    color:white;
    text-align:center;
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
select{

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

    <h1>Tambah Absensi Siswa</h1>

    <form method="POST">

        <div class="form-group">

            <label>Nama Siswa</label>

            <input
                type="text"
                name="nama_siswa"
                required>

        </div>

        <div class="form-group">

            <label>Kelas</label>

            <input
                type="text"
                name="kelas"
                required>

        </div>

        <div class="form-group">

            <label>Tanggal</label>

            <input
                type="date"
                name="tanggal"
                value="<?= date('Y-m-d'); ?>"
                required>

        </div>

        <div class="form-group">

            <label>Status Kehadiran</label>

            <select name="status" required>

                <option value="">-- Pilih Status --</option>

                <option value="Hadir">Hadir</option>
                <option value="Izin">Izin</option>
                <option value="Sakit">Sakit</option>
                <option value="Alpa">Alpa</option>

            </select>

        </div>

        <div class="btn-group">

            <button
                type="submit"
                name="simpan"
                class="btn btn-save">

                Simpan

            </button>

            <a href="absensi.php"
               class="btn btn-back">

               Kembali

            </a>

        </div>

    </form>

</div>

</body>
</html>
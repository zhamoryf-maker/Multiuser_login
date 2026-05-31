<?php
session_start();

if(!isset($_SESSION['level']) || $_SESSION['level'] != "guru"){
    header("Location:index.php");
    exit;
}

include 'koneksi.php';

if(!isset($_GET['id'])){
    header("Location:absensi.php");
    exit;
}

$id = (int)$_GET['id'];

$data = mysqli_query(
    $conn,
    "SELECT * FROM absensi WHERE id_absensi='$id'"
);

$absensi = mysqli_fetch_assoc($data);

if(!$absensi){
    echo "
    <script>
        alert('Data tidak ditemukan');
        window.location='absensi.php';
    </script>
    ";
    exit;
}

if(isset($_POST['update'])){

    $nama_siswa = mysqli_real_escape_string(
        $conn,
        $_POST['nama_siswa']
    );

    $kelas = mysqli_real_escape_string(
        $conn,
        $_POST['kelas']
    );

    $tanggal = mysqli_real_escape_string(
        $conn,
        $_POST['tanggal']
    );

    $status_kehadiran = mysqli_real_escape_string(
        $conn,
        $_POST['status_kehadiran']
    );

    $update = mysqli_query(

        $conn,

        "UPDATE absensi SET

        nama_siswa='$nama_siswa',
        kelas='$kelas',
        tanggal='$tanggal',
        status_kehadiran='$status_kehadiran'

        WHERE id_absensi='$id'"

    );

    if($update){

        echo "
        <script>
            alert('Data absensi berhasil diperbarui');
            window.location='absensi.php';
        </script>
        ";
        exit;

    }else{

        echo "
        <script>
            alert('Gagal memperbarui data');
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
<title>Edit Absensi</title>

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

.btn-update{
    background:#00c853;
    color:white;
}

.btn-update:hover{
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

    <h1>Edit Absensi Siswa</h1>

    <form method="POST">

        <div class="form-group">
            <label>Nama Siswa</label>
            <input
                type="text"
                name="nama_siswa"
                value="<?= htmlspecialchars($absensi['nama_siswa']); ?>"
                required>
        </div>

        <div class="form-group">
            <label>Kelas</label>
            <input
                type="text"
                name="kelas"
                value="<?= htmlspecialchars($absensi['kelas']); ?>"
                required>
        </div>

        <div class="form-group">
            <label>Tanggal</label>
            <input
                type="date"
                name="tanggal"
                value="<?= $absensi['tanggal']; ?>"
                required>
        </div>

        <div class="form-group">
            <label>Status Kehadiran</label>

            <select name="status_kehadiran" required>

                <option value="Hadir"
                <?= ($absensi['status_kehadiran']=="Hadir") ? "selected" : ""; ?>>
                Hadir
                </option>

                <option value="Izin"
                <?= ($absensi['status_kehadiran']=="Izin") ? "selected" : ""; ?>>
                Izin
                </option>

                <option value="Sakit"
                <?= ($absensi['status_kehadiran']=="Sakit") ? "selected" : ""; ?>>
                Sakit
                </option>

                <option value="Alpa"
                <?= ($absensi['status_kehadiran']=="Alpa") ? "selected" : ""; ?>>
                Alpa
                </option>

            </select>

        </div>

        <div class="btn-group">

            <button
                type="submit"
                name="update"
                class="btn btn-update">

                Update Data

            </button>

            <a
                href="absensi.php"
                class="btn btn-back">

                Kembali

            </a>

        </div>

    </form>

</div>

</body>
</html>
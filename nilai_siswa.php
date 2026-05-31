<?php
session_start();

if(!isset($_SESSION['level'])){
    header("Location:index.php");
    exit;
}

if($_SESSION['level'] != "siswa"){
    header("Location:index.php");
    exit;
}

include 'koneksi.php';

$query = mysqli_query(
    $conn,
    "SELECT * FROM nilai ORDER BY id_nilai DESC"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Nilai Siswa</title>

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
    background:linear-gradient(
        135deg,
        #4facfe,
        #00f2fe,
        #43e97b
    );
    padding:30px;
}

.container{
    max-width:1200px;
    margin:auto;
}

.card{

    background:rgba(255,255,255,0.15);

    backdrop-filter:blur(15px);

    border:1px solid rgba(255,255,255,0.3);

    border-radius:25px;

    padding:30px;

    box-shadow:0 8px 32px rgba(0,0,0,0.2);

}

.header{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:25px;

    flex-wrap:wrap;

    gap:15px;

}

.header h1{

    color:white;

    font-size:32px;

}

.btn{

    text-decoration:none;

    background:white;

    color:#0099ff;

    padding:12px 18px;

    border-radius:12px;

    font-weight:600;

}

.btn:hover{

    background:#0099ff;

    color:white;

}

.table-box{

    overflow-x:auto;

}

table{

    width:100%;

    border-collapse:collapse;

}

th{

    background:rgba(255,255,255,0.25);

    color:white;

    padding:15px;

    text-align:left;

}

td{

    background:rgba(255,255,255,0.12);

    color:white;

    padding:15px;

    border-bottom:1px solid rgba(255,255,255,0.08);

}

tr:hover td{

    background:rgba(255,255,255,0.20);

}

.badge{

    padding:8px 12px;

    border-radius:10px;

    font-weight:600;

}

.sangat-baik{
    background:#00c853;
}

.baik{
    background:#03a9f4;
}

.cukup{
    background:#ff9800;
}

.kurang{
    background:#ff3b3b;
}

.kosong{

    text-align:center;

    color:white;

    padding:20px;

}

</style>

</head>
<body>

<div class="container">

    <div class="card">

        <div class="header">

            <h1>

                <i class="bi bi-award-fill"></i>
                Nilai Siswa

            </h1>

            <a href="dashboard_siswa.php"
               class="btn">

                <i class="bi bi-arrow-left"></i>
                Dashboard

            </a>

        </div>

        <div class="table-box">

            <table>

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Mata Pelajaran</th>
                        <th>Nilai</th>
                        <th>Keterangan</th>

                    </tr>

                </thead>

                <tbody>

                <?php

                if($query && mysqli_num_rows($query) > 0){

                    $no = 1;

                    while($d = mysqli_fetch_assoc($query)){

                        $nilai = $d['nilai'];

                        if($nilai >= 90){

                            $badge = "sangat-baik";
                            $ket   = "Sangat Baik";

                        }elseif($nilai >= 80){

                            $badge = "baik";
                            $ket   = "Baik";

                        }elseif($nilai >= 70){

                            $badge = "cukup";
                            $ket   = "Cukup";

                        }else{

                            $badge = "kurang";
                            $ket   = "Perlu Perbaikan";

                        }

                ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td><?= htmlspecialchars($d['nama_siswa']); ?></td>

                    <td><?= htmlspecialchars($d['kelas']); ?></td>

                    <td><?= htmlspecialchars($d['mapel']); ?></td>

                    <td><?= $nilai; ?></td>

                    <td>

                        <span class="badge <?= $badge; ?>">

                            <?= $ket; ?>

                        </span>

                    </td>

                </tr>

                <?php

                    }

                }else{

                ?>

                <tr>

                    <td colspan="6"
                        class="kosong">

                        <i class="bi bi-database-fill-exclamation"></i>
                        Data nilai belum tersedia

                    </td>

                </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>
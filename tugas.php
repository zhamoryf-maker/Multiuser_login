<?php
session_start();

/* =========================
   CEK LOGIN
========================= */

if(!isset($_SESSION['level'])){

    header("Location:index.php");
    exit;

}

if($_SESSION['level'] != "siswa"){

    header("Location:index.php");
    exit;

}

/* =========================
   KONEKSI DATABASE
========================= */

include 'koneksi.php';

if(!$conn){

    die("Koneksi database gagal!");

}

/*
========================================
TABEL DATABASE
========================================

CREATE TABLE tugas (

    id_tugas INT AUTO_INCREMENT PRIMARY KEY,
    nama_tugas VARCHAR(100),
    mapel VARCHAR(100),
    guru VARCHAR(100),
    deadline DATE,
    status_tugas VARCHAR(50)

);

*/

/* =========================
   AMBIL DATA TUGAS
========================= */

$query = mysqli_query(
    $conn,
    "SELECT * FROM tugas ORDER BY deadline ASC"
);

?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Data Tugas</title>

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"
          rel="stylesheet">

    <!-- BOOTSTRAP ICON -->
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins', sans-serif;
        }

        body{

            min-height:100vh;

            background:
            linear-gradient(
            135deg,
            #4facfe,
            #00f2fe,
            #43e97b
            );

            padding:30px;

        }

        /* CONTAINER */

        .container{

            max-width:1200px;

            margin:auto;

        }

        /* CARD */

        .card{

            background:rgba(255,255,255,0.15);

            backdrop-filter:blur(15px);

            border:1px solid rgba(255,255,255,0.3);

            border-radius:25px;

            padding:30px;

            box-shadow:0 8px 32px rgba(0,0,0,0.2);

        }

        /* HEADER */

        .header{

            display:flex;

            justify-content:space-between;

            align-items:center;

            flex-wrap:wrap;

            gap:15px;

            margin-bottom:25px;

        }

        .title h1{

            color:white;

            font-size:32px;

            margin-bottom:5px;

        }

        .title p{

            color:#f1f1f1;

            font-size:14px;

        }

        /* BUTTON */

        .btn{

            padding:12px 18px;

            border-radius:12px;

            text-decoration:none;

            font-weight:600;

            transition:0.3s;

            background:white;

            color:#0099ff;

            display:inline-block;

        }

        .btn:hover{

            background:#0099ff;

            color:white;

        }

        /* TABLE */

        .table-container{

            overflow-x:auto;

        }

        table{

            width:100%;

            border-collapse:collapse;

            overflow:hidden;

            border-radius:15px;

        }

        table th{

            background:rgba(255,255,255,0.25);

            color:white;

            padding:15px;

            text-align:left;

            font-size:15px;

        }

        table td{

            background:rgba(255,255,255,0.12);

            color:white;

            padding:15px;

            border-bottom:1px solid rgba(255,255,255,0.08);

            font-size:14px;

        }

        table tr:hover td{

            background:rgba(255,255,255,0.2);

        }

        /* BADGE */

        .badge{

            padding:8px 12px;

            border-radius:10px;

            font-weight:600;

            display:inline-block;

        }

        .selesai{

            background:#00c853;

        }

        .proses{

            background:#ff9800;

        }

        .terlambat{

            background:#ff3b3b;

        }

        /* KOSONG */

        .kosong{

            text-align:center;

            color:white;

            padding:25px;

            background:rgba(255,255,255,0.12);

        }

        /* RESPONSIVE */

        @media(max-width:768px){

            body{

                padding:15px;

            }

            .header{

                flex-direction:column;

                align-items:flex-start;

            }

            .title h1{

                font-size:25px;

            }

        }

    </style>

</head>
<body>

<div class="container">

    <div class="card">

        <!-- HEADER -->
        <div class="header">

            <div class="title">

                <h1>

                    <i class="bi bi-journal-text"></i>
                    Data Tugas

                </h1>

                <p>
                    Dashboard Siswa
                </p>

            </div>

            <a href="dashboard_siswa.php"
               class="btn">

                <i class="bi bi-arrow-left"></i>
                Dashboard

            </a>

        </div>

        <!-- TABLE -->
        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Nama Tugas</th>
                        <th>Mata Pelajaran</th>
                        <th>Guru</th>
                        <th>Deadline</th>
                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                <?php

                if($query && mysqli_num_rows($query) > 0){

                    $no = 1;

                    while($d = mysqli_fetch_assoc($query)){

                ?>

                    <tr>

                        <td><?= $no++; ?></td>

                        <td>
                            <?= htmlspecialchars($d['nama_tugas']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($d['mapel']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($d['guru']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($d['deadline']); ?>
                        </td>

                        <td>

                            <?php

                            $status = strtolower($d['status_tugas']);

                            if($status == "selesai"){

                                echo "<span class='badge selesai'>Selesai</span>";

                            }elseif($status == "proses"){

                                echo "<span class='badge proses'>Proses</span>";

                            }else{

                                echo "<span class='badge terlambat'>Terlambat</span>";

                            }

                            ?>

                        </td>

                    </tr>

                <?php

                    }

                }else{

                ?>

                    <tr>

                        <td colspan="6" class="kosong">

                            <i class="bi bi-database-fill-exclamation"></i>
                            Data tugas belum tersedia

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
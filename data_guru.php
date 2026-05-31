<?php
session_start();

if(!isset($_SESSION['level'])){

    header("Location:index.php");
    exit;

}

if($_SESSION['level'] != "kepsek"){

    header("Location:index.php");
    exit;

}

include 'koneksi.php';

/*
========================================
TABEL DATABASE
========================================

CREATE TABLE guru (

    id_guru INT AUTO_INCREMENT PRIMARY KEY,
    nama_guru VARCHAR(100),
    mapel VARCHAR(100),
    alamat TEXT,
    no_hp VARCHAR(20)

);

*/

/* CEK KONEKSI */

if(!$conn){

    die("Koneksi database gagal!");

}

/* AMBIL DATA GURU */

$query = "SELECT * FROM guru ORDER BY id_guru DESC";

$data  = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Data Guru</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"
          rel="stylesheet">

    <!-- Bootstrap Icons -->
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

            padding:40px;

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

            margin-bottom:30px;

        }

        .title h1{

            color:white;

            font-size:32px;

            margin-bottom:5px;

        }

        .title p{

            color:#f1f1f1;

        }

        /* BUTTON */

        .btn{

            display:inline-block;

            padding:12px 18px;

            border-radius:12px;

            text-decoration:none;

            font-weight:600;

            transition:0.3s;

            margin-left:8px;

        }

        .btn-back{

            background:white;

            color:#0099ff;

        }

        .btn-back:hover{

            background:#0099ff;

            color:white;

        }

        .btn-add{

            background:#00c853;

            color:white;

        }

        .btn-add:hover{

            background:#00a844;

        }

        /* TABLE */

        .table-box{

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

            padding:16px;

            text-align:left;

            font-size:15px;

        }

        table td{

            background:rgba(255,255,255,0.12);

            color:white;

            padding:16px;

            border-bottom:1px solid rgba(255,255,255,0.1);

            font-size:14px;

        }

        table tr:hover td{

            background:rgba(255,255,255,0.18);

        }

        /* AKSI */

        .aksi{

            display:flex;

            gap:10px;

        }

        .edit,
        .hapus{

            padding:8px 12px;

            border-radius:8px;

            color:white;

            text-decoration:none;

            transition:0.3s;

            font-size:14px;

        }

        .edit{

            background:#ff9800;

        }

        .edit:hover{

            background:#e68900;

        }

        .hapus{

            background:#ff3b3b;

        }

        .hapus:hover{

            background:#d90000;

        }

        /* KOSONG */

        .kosong{

            text-align:center;

            padding:25px;

            color:white;

            background:rgba(255,255,255,0.12);

        }

        /* RESPONSIVE */

        @media(max-width:768px){

            body{

                padding:20px;

            }

            .header{

                flex-direction:column;

                align-items:flex-start;

            }

            .btn{

                margin-top:10px;

                margin-left:0;

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

                    <i class="bi bi-people-fill"></i>
                    Data Guru

                </h1>

                <p>

                    Dashboard Kepala Sekolah

                </p>

            </div>

            <div>

                <a href="dashboard_kepsek.php"
                   class="btn btn-back">

                    <i class="bi bi-arrow-left"></i>
                    Dashboard

                </a>

                <a href="tambah_guru.php"
                   class="btn btn-add">

                    <i class="bi bi-plus-circle"></i>
                    Tambah Guru

                </a>

            </div>

        </div>

        <!-- TABLE -->
        <div class="table-box">

            <table>

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Nama Guru</th>
                        <th>Mata Pelajaran</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                <?php

                if(mysqli_num_rows($data) > 0){

                    $no = 1;

                    while($d = mysqli_fetch_assoc($data)){

                ?>

                    <tr>

                        <td><?= $no++; ?></td>

                        <td>
                            <?= htmlspecialchars($d['nama_guru']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($d['mapel']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($d['alamat']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($d['no_hp']); ?>
                        </td>

                        <td>

                            <div class="aksi">

                                <a href="edit_guru.php?id=<?= $d['id_guru']; ?>"
                                   class="edit">

                                    <i class="bi bi-pencil-square"></i>

                                </a>

                                <a href="hapus_guru.php?id=<?= $d['id_guru']; ?>"
                                   class="hapus"
                                   onclick="return confirm('Yakin ingin menghapus data ini?')">

                                    <i class="bi bi-trash-fill"></i>

                                </a>

                            </div>

                        </td>

                    </tr>

                <?php

                    }

                }else{

                ?>

                    <tr>

                        <td colspan="6" class="kosong">

                            Data guru belum tersedia

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
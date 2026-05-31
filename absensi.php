<?php
session_start();

/* =========================
   CEK LOGIN
========================= */

if(!isset($_SESSION['level'])){

    header("Location:index.php");
    exit;

}

if($_SESSION['level'] != "guru"){

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

CREATE TABLE absensi (

    id_absensi INT AUTO_INCREMENT PRIMARY KEY,
    nama_siswa VARCHAR(100),
    kelas VARCHAR(50),
    tanggal DATE,
    status_kehadiran VARCHAR(20)

);

*/

/* =========================
   AMBIL DATA ABSENSI
========================= */

$query = mysqli_query(
    $conn,
    "SELECT * FROM absensi ORDER BY id_absensi DESC"
);

?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Data Absensi</title>

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

        .button-group{

            display:flex;

            gap:10px;

            flex-wrap:wrap;

        }

        .btn{

            padding:12px 18px;

            border-radius:12px;

            text-decoration:none;

            font-weight:600;

            transition:0.3s;

            color:white;

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

        }

        .btn-add:hover{

            background:#00a844;

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

        .hadir{

            background:#00c853;

        }

        .izin{

            background:#ff9800;

        }

        .sakit{

            background:#03a9f4;

        }

        .alpha{

            background:#ff3b3b;

        }

        /* AKSI */

        .aksi{

            display:flex;

            gap:8px;

        }

        .edit,
        .hapus{

            padding:8px 12px;

            border-radius:8px;

            text-decoration:none;

            color:white;

            transition:0.3s;

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

                    <i class="bi bi-clipboard-check-fill"></i>
                    Data Absensi

                </h1>

                <p>
                    Dashboard Guru
                </p>

            </div>

            <div class="button-group">

                <a href="dashboard_guru.php"
                   class="btn btn-back">

                    <i class="bi bi-arrow-left"></i>
                    Dashboard

                </a>

                <a href="tambah_absensi.php"
                   class="btn btn-add">

                    <i class="bi bi-plus-circle"></i>
                    Tambah Absensi

                </a>

            </div>

        </div>

        <!-- TABLE -->
        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>

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
                            <?= htmlspecialchars($d['nama_siswa']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($d['kelas']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($d['tanggal']); ?>
                        </td>

                        <td>

                            <?php

                            $status = trim(strtolower($d['status_kehadiran'] ?? ''));

                             switch($status){

                            case 'hadir':
                              echo "<span class='badge hadir'>Hadir</span>";
                              break;

                              case 'izin':
                              echo "<span class='badge izin'>Izin</span>";
                              break;
 
                             case 'sakit':
                              echo "<span class='badge sakit'>Sakit</span>";
                               break;

                                case 'alpha':
                                case 'alpa':
                              echo "<span class='badge alpha'>Alpha</span>";
                              break;
 
                             default:
                               echo "<span class='badge alpha'>Belum Diisi</span>";
                             break;
                                          }

                            ?>

                        </td>

                        <td>

                            <div class="aksi">

                                <a href="edit_absensi.php?id=<?= $d['id_absensi']; ?>"
                                   class="edit">

                                    <i class="bi bi-pencil-square"></i>

                                </a>

                                <a href="hapus_absensi.php?id=<?= $d['id_absensi']; ?>"
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

                            <i class="bi bi-database-fill-exclamation"></i>
                            Data absensi belum tersedia

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
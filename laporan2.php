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

/* =========================
   TOTAL DATA
========================= */

$total_siswa = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM siswa")
);

$total_nilai = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM nilai")
);

$total_absensi = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM absensi")
);

?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Laporan Guru</title>

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

            max-width:1100px;

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

            font-size:35px;

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

        }

        .btn-back{

            background:white;

            color:#0099ff;

        }

        .btn-back:hover{

            background:#0099ff;

            color:white;

        }

        .btn-print{

            background:#00c853;

            color:white;

        }

        .btn-print:hover{

            background:#00a844;

        }

        /* TABLE */

        .table-box{

            overflow-x:auto;

        }

        table{

            width:100%;

            border-collapse:collapse;

            margin-top:20px;

            overflow:hidden;

            border-radius:15px;

        }

        table th{

            background:rgba(255,255,255,0.25);

            color:white;

            padding:15px;

            text-align:left;

        }

        table td{

            background:rgba(255,255,255,0.12);

            color:white;

            padding:15px;

            border-bottom:1px solid rgba(255,255,255,0.1);

        }

        table tr:hover td{

            background:rgba(255,255,255,0.18);

        }

        /* INFO CARD */

        .info{

            margin-top:30px;

            display:grid;

            grid-template-columns:
            repeat(auto-fit,minmax(220px,1fr));

            gap:20px;

        }

        .info-card{

            background:rgba(255,255,255,0.12);

            border-radius:20px;

            padding:25px;

            text-align:center;

        }

        .info-card i{

            font-size:45px;

            color:white;

            margin-bottom:10px;

        }

        .info-card h2{

            color:white;

            font-size:35px;

            margin-bottom:5px;

        }

        .info-card p{

            color:#f1f1f1;

        }

        /* FOOTER */

        .footer{

            text-align:center;

            margin-top:30px;

            color:white;

            font-size:14px;

        }

        /* PRINT */

        @media print{

            .btn,
            .footer{

                display:none;

            }

            body{

                background:white;

            }

            .card{

                box-shadow:none;

                border:none;

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

                    <i class="bi bi-file-earmark-text-fill"></i>
                    Laporan Guru

                </h1>

                <p>
                    Dashboard Guru
                </p>

            </div>

            <div>

                <a href="dashboard_guru.php"
                   class="btn btn-back">

                    <i class="bi bi-arrow-left"></i>
                    Dashboard

                </a>

                <button onclick="window.print()"
                        class="btn btn-print">

                    <i class="bi bi-printer-fill"></i>
                    Print

                </button>

            </div>

        </div>

        <!-- TABLE -->
        <div class="table-box">

            <table>

                <tr>

                    <th>No</th>
                    <th>Jenis Data</th>
                    <th>Total</th>

                </tr>

                <tr>

                    <td>1</td>

                    <td>Total Siswa</td>

                    <td>
                        <?= $total_siswa; ?>
                    </td>

                </tr>

                <tr>

                    <td>2</td>

                    <td>Total Nilai</td>

                    <td>
                        <?= $total_nilai; ?>
                    </td>

                </tr>

                <tr>

                    <td>3</td>

                    <td>Total Absensi</td>

                    <td>
                        <?= $total_absensi; ?>
                    </td>

                </tr>

            </table>

        </div>

        <!-- INFO CARD -->
        <div class="info">

            <div class="info-card">

                <i class="bi bi-mortarboard-fill"></i>

                <h2>

                    <?= $total_siswa; ?>

                </h2>

                <p>Total Siswa</p>

            </div>

            <div class="info-card">

                <i class="bi bi-journal-check"></i>

                <h2>

                    <?= $total_nilai; ?>

                </h2>

                <p>Total Nilai</p>

            </div>

            <div class="info-card">

                <i class="bi bi-clipboard-check-fill"></i>

                <h2>

                    <?= $total_absensi; ?>

                </h2>

                <p>Total Absensi</p>

            </div>

        </div>

    </div>

    <!-- FOOTER -->
    <div class="footer">

        © 2026 Laporan Guru

    </div>

</div>

</body>
</html>
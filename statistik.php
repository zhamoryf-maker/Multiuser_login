<?php
session_start();

/* =========================
   CEK LOGIN
========================= */

if(!isset($_SESSION['level'])){

    header("Location:index.php");
    exit;

}

if($_SESSION['level'] != "kepsek"){

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

/* TOTAL SISWA */

$siswa = mysqli_query(
    $conn,
    "SELECT * FROM siswa"
);

$total_siswa = mysqli_num_rows($siswa);

/* TOTAL GURU */

$guru = mysqli_query(
    $conn,
    "SELECT * FROM guru"
);

$total_guru = mysqli_num_rows($guru);

/* TOTAL USER */

$user = mysqli_query(
    $conn,
    "SELECT * FROM users"
);

$total_user = mysqli_num_rows($user);

?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Statistik Sekolah</title>

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

        /* GRID */

        .grid{

            display:grid;

            grid-template-columns:
            repeat(auto-fit,minmax(250px,1fr));

            gap:20px;

        }

        /* CARD */

        .card{

            background:rgba(255,255,255,0.15);

            backdrop-filter:blur(15px);

            border:1px solid rgba(255,255,255,0.3);

            border-radius:25px;

            padding:30px;

            text-align:center;

            box-shadow:0 8px 32px rgba(0,0,0,0.2);

            transition:0.3s;

        }

        .card:hover{

            transform:translateY(-8px);

        }

        .card i{

            font-size:60px;

            color:white;

            margin-bottom:15px;

        }

        .card h2{

            color:white;

            font-size:40px;

            margin-bottom:10px;

        }

        .card p{

            color:#f1f1f1;

            font-size:16px;

        }

        /* COLORS */

        .siswa{

            border-left:6px solid #00e676;

        }

        .guru{

            border-left:6px solid #ff9800;

        }

        .user{

            border-left:6px solid #ff3b3b;

        }

        /* FOOTER */

        .footer{

            text-align:center;

            margin-top:30px;

            color:white;

            font-size:14px;

        }

        /* RESPONSIVE */

        @media(max-width:768px){

            .header{

                flex-direction:column;

                align-items:flex-start;

            }

            .title h1{

                font-size:28px;

            }

        }

    </style>

</head>
<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">

        <div class="title">

            <h1>

                <i class="bi bi-bar-chart-fill"></i>
                Statistik Sekolah

            </h1>

            <p>
                Dashboard Kepala Sekolah
            </p>

        </div>

        <a href="dashboard_kepsek.php"
           class="btn btn-back">

            <i class="bi bi-arrow-left"></i>
            Dashboard

        </a>

    </div>

    <!-- GRID -->
    <div class="grid">

        <!-- SISWA -->
        <div class="card siswa">

            <i class="bi bi-mortarboard-fill"></i>

            <h2>

                <?= $total_siswa; ?>

            </h2>

            <p>
                Total Siswa
            </p>

        </div>

        <!-- GURU -->
        <div class="card guru">

            <i class="bi bi-person-workspace"></i>

            <h2>

                <?= $total_guru; ?>

            </h2>

            <p>
                Total Guru
            </p>

        </div>

        <!-- USER -->
        <div class="card user">

            <i class="bi bi-people-fill"></i>

            <h2>

                <?= $total_user; ?>

            </h2>

            <p>
                Total User Login
            </p>

        </div>

    </div>

    <!-- FOOTER -->
    <div class="footer">

        © 2026 Statistik Sekolah

    </div>

</div>

</body>
</html>
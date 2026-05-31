<?php
session_start();

if($_SESSION['level'] != "guru"){
    header("Location:index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Dashboard Guru</title>

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

            height:100vh;

            display:flex;
            justify-content:center;
            align-items:center;

            background:
            linear-gradient(
            135deg,
            #4facfe,
            #00f2fe,
            #43e97b
            );

            overflow:hidden;

        }

        /* Background Animation */

        .circle{

            position:absolute;
            border-radius:50%;
            background:rgba(255,255,255,0.2);

            animation:float 6s infinite ease-in-out;

        }

        .circle1{

            width:220px;
            height:220px;

            top:-50px;
            left:-50px;

        }

        .circle2{

            width:300px;
            height:300px;

            bottom:-100px;
            right:-100px;

            animation-delay:2s;

        }

        @keyframes float{

            0%{
                transform:translateY(0px);
            }

            50%{
                transform:translateY(20px);
            }

            100%{
                transform:translateY(0px);
            }

        }

        /* Dashboard */

        .dashboard-box{

            width:420px;

            padding:40px;

            border-radius:25px;

            background:rgba(255,255,255,0.15);

            backdrop-filter:blur(15px);

            border:1px solid rgba(255,255,255,0.3);

            box-shadow:0 8px 32px rgba(0,0,0,0.2);

            text-align:center;

            position:relative;
            z-index:2;

        }

        .dashboard-box .icon{

            font-size:70px;
            color:white;

            margin-bottom:15px;

        }

        .dashboard-box h1{

            color:white;
            margin-bottom:10px;

            font-size:32px;

        }

        .dashboard-box h3{

            color:#f1f1f1;

            font-weight:400;

            margin-bottom:30px;

            line-height:1.6;

        }

        .dashboard-box span{

            font-weight:600;
            color:#fff;

        }

        /* Menu */

        .menu{

            display:grid;

            grid-template-columns:1fr 1fr;

            gap:15px;

            margin-bottom:25px;

        }

        .card{

            background:rgba(255,255,255,0.2);

            padding:20px;

            border-radius:15px;

            color:white;

            text-decoration:none;

            transition:0.3s;

        }

        .card:hover{

            transform:translateY(-5px);

            background:rgba(255,255,255,0.3);

        }

        .card i{

            font-size:30px;

            margin-bottom:10px;

            display:block;

        }

        /* Logout Button */

        .logout{

            display:inline-block;

            width:100%;

            padding:14px;

            border-radius:12px;

            background:white;

            color:#ff3b3b;

            text-decoration:none;

            font-weight:600;

            transition:0.3s;

        }

        .logout:hover{

            background:#ff3b3b;

            color:white;

            transform:translateY(-3px);

            box-shadow:0 10px 20px rgba(0,0,0,0.2);

        }

        /* Footer */

        .footer{

            margin-top:20px;

            color:white;

            font-size:13px;

        }

    </style>

</head>
<body>

    <!-- Background -->
    <div class="circle circle1"></div>
    <div class="circle circle2"></div>

    <!-- Dashboard -->
    <div class="dashboard-box">

        <div class="icon">
            <i class="bi bi-mortarboard-fill"></i>
        </div>

        <h1>Dashboard Guru</h1>

        <h3>

            Selamat datang,
            <br>

            <span>
                <?= $_SESSION['username']; ?>
            </span>

        </h3>

        <!-- Menu -->
        <div class="menu">

            <a href="data_siswa2.php" class="card">

                <i class="bi bi-person-lines-fill"></i>

                Data Siswa

            </a>

            <a href="nilai.php" class="card">

                <i class="bi bi-book-fill"></i>

                Nilai

            </a>

            <a href="absensi.php" class="card">

                <i class="bi bi-calendar-check-fill"></i>

                Absensi

            </a>

            <a href="laporan2.php" class="card">

                <i class="bi bi-file-earmark-text-fill"></i>

                Laporan

            </a>

        </div>

        <!-- Logout -->
        <a href="logout.php" class="logout">

            <i class="bi bi-box-arrow-right"></i>

            Logout

        </a>

        <div class="footer">

            © 2026 Dashboard Guru

        </div>

    </div>

</body>
</html>
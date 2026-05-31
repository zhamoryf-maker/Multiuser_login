<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn,
"SELECT * FROM users
WHERE username='$username'
AND password='$password'");

$data = mysqli_fetch_assoc($query);

if(mysqli_num_rows($query) > 0){

    $_SESSION['username'] = $data['username'];
    $_SESSION['level'] = $data['level'];

    if($data['level'] == "siswa"){

        header("Location: dashboard_siswa.php");

    }elseif($data['level'] == "guru"){

        header("Location: dashboard_guru.php");

    }elseif($data['level'] == "kepsek"){

        header("Location: dashboard_kepsek.php");

    }

}else{

    echo "
    <script>
    alert('Login gagal');
    window.location='index.php';
    </script>
    ";

}
?>
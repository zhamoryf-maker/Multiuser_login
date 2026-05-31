<?php
session_start();

/* =========================
   CEK LOGIN GURU
========================= */

if(!isset($_SESSION['level']) || $_SESSION['level'] != "guru"){

    header("Location:index.php");
    exit;

}

/* =========================
   KONEKSI DATABASE
========================= */

include "koneksi.php";

/* =========================
   CEK ID SISWA
========================= */

if(!isset($_GET['id'])){

    header("Location:data_siswa.php");
    exit;

}

$id = (int)$_GET['id'];

/* =========================
   HAPUS DATA
========================= */

$hapus = mysqli_query(

    $conn,

    "DELETE FROM siswa
     WHERE id_siswa = '$id'"

);

if($hapus){

    echo "

    <script>

        alert('Data siswa berhasil dihapus');

        window.location='data_siswa.php';

    </script>

    ";

}else{

    echo "

    <script>

        alert('Gagal menghapus data siswa');

        window.location='data_siswa.php';

    </script>

    ";

}
?>
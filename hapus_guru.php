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
   CEK ID GURU
========================= */

if(!isset($_GET['id'])){

    header("Location:data_guru.php");
    exit;

}

$id = (int)$_GET['id'];

/* =========================
   HAPUS DATA
========================= */

$hapus = mysqli_query(
    $conn,
    "DELETE FROM guru WHERE id_guru='$id'"
);

if($hapus){

    echo "

    <script>

        alert('Data guru berhasil dihapus');

        window.location='data_guru.php';

    </script>

    ";

}else{

    echo "

    <script>

        alert('Data guru gagal dihapus');

        window.location='data_guru.php';

    </script>

    ";

}
?>
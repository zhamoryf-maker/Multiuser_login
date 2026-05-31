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
   CEK ID
========================= */

if(!isset($_GET['id'])){

    header("Location:nilai_siswa.php");
    exit;

}

$id = (int) $_GET['id'];

/* =========================
   HAPUS DATA
========================= */

$hapus = mysqli_query(
    $conn,
    "DELETE FROM nilai WHERE id_nilai = '$id'"
);

if($hapus){

    echo "

    <script>

        alert('Data nilai berhasil dihapus');

        window.location='nilai_siswa.php';

    </script>

    ";

}else{

    echo "

    <script>

        alert('Data gagal dihapus');

        window.location='nilai_siswa.php';

    </script>

    ";

}
?>
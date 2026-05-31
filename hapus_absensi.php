<?php
session_start();

/* =========================
   CEK LOGIN GURU
========================= */

if (!isset($_SESSION['level'])) {

    header("Location:index.php");
    exit;

}

if ($_SESSION['level'] != "guru") {

    header("Location:index.php");
    exit;

}

/* =========================
   KONEKSI DATABASE
========================= */

include 'koneksi.php';

/* =========================
   CEK ID
========================= */

if (!isset($_GET['id'])) {

    echo "
    <script>
        alert('ID absensi tidak ditemukan!');
        window.location='absensi.php';
    </script>
    ";

    exit;

}

$id = (int) $_GET['id'];

/* =========================
   HAPUS DATA
========================= */

$hapus = mysqli_query(

    $conn,

    "DELETE FROM absensi
     WHERE id_absensi = '$id'"

);

/* =========================
   HASIL
========================= */

if ($hapus) {

    echo "
    <script>
        alert('Data absensi berhasil dihapus');
        window.location='absensi.php';
    </script>
    ";

} else {

    echo "
    <script>
        alert('Data absensi gagal dihapus');
        window.location='absensi.php';
    </script>
    ";

}
?>
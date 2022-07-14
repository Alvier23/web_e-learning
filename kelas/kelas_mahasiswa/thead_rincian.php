<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: ../../logineror.php");
}
include 'konek.php';
$idmhs = $_SESSION['id_mahasiswa'];
$idkel = $_GET['id_kelas'];
$kueriKelas = mysqli_query($konek, "SELECT nama_kelas FROM kelas_mahasiswa a JOIN kelas b  
                                ON a.id_kelas=b.id_kelas
                                WHERE id_mhs=$idmhs");
while ($kls = mysqli_fetch_assoc($kueriKelas)) {
    $title = $kls['nama_kelas'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <title><?= $title; ?></title>
</head>
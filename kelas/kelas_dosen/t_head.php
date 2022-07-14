<?php

session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: ../../logineror.php");
}
include 'konek.php';
$idkelas = $_GET["id_kelas"];
$judul = mysqli_query($konek, "SELECT nama_kelas FROM kelas WHERE id_kelas=$idkelas");
$anu = mysqli_fetch_assoc($judul);
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title><?= $anu['nama_kelas']; ?></title>
</head>
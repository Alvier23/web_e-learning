<?php
session_start();
include 'konek.php';
$idKump = $_POST['idKumpul'];
$nilaiKump = $_POST['nilaiKumpul'];

$sql = mysqli_query($konek, "UPDATE kumpulkan SET nilai=$nilaiKump WHERE id=$idKump");

$idTug = $_SESSION['idtgs'];
header("location:cektugas.php?idtugas=$idTug");

<?php
//koneksi database
include 'konek.php';

//menangkap dta yang di kirim form
$judul= $_POST['judul'];
$teks = $_POST['isi'];
$file= $_POST['file'];
$kelas =$_POST['id_kelas'];

//input data ke database
$cek=mysqli_query($konek,"insert into materi values(NULL,'$judul','$teks','$file','$kelas')");
$row = $data->fetch_assoc();
	$_SESSION['id_dosen'] = $row["id_dosen"];

// mengalihkan halaman ke login
header("location:materi.php");

?>
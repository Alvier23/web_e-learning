<?php
//koneksi database
include 'konek.php';

//menangkap dta yang di kirim form
$id = $_POST['id_dosen'];
$nama = $_POST['nama_dosen'];
$mail= $_POST['email'];
$hp =$_POST['notelp'];

//input data ke database
$cek=mysqli_query($konek,"insert into dosen values('$id','$nama','$mail','$hp')");


// mengalihkan halaman ke login
header("location:regisdosen2.php");

?>
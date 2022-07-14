<?php
//koneksi database
include 'konek.php';

//menangkap dta yang di kirim form
$id = $_POST['id_mhs'];
$nama = $_POST['nm_mhs'];
$mail= $_POST['email'];
$hp =$_POST['notelp'];

//input data ke database
$cek=mysqli_query($konek,"insert into mhs values('$id','$nama','$mail','$hp')");


// mengalihkan halaman ke login
header("location:regismhs2.php");

?>
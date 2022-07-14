<?php
//koneksi database
include 'konek.php';

//menangkap dta yang di kirim form
$username = $_POST['user_name'];
$password = $_POST['password'];
$id = $_POST['id_mhs'];
//input data ke database
mysqli_query($konek, "insert into login VALUES('$username','$password',NULL,'$id','mahasiswa')");


// mengalihkan halaman ke login
header("location:../../login/login.php");

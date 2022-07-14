<?php
//koneksi database
include 'konek.php';

//menangkap dta yang di kirim form
$username = $_POST['user_name'];
$password = $_POST['password'];
$id = $_POST['id_dosen'];
//input data ke database
$reg=mysqli_query($konek,"insert into login VALUES('$username','$password','$id',NULL,'dosen')");


// mengalihkan halaman ke login
header("location:../../login/login.php");

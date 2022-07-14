<?php
// Login dosen
session_start();

include '../konek.php';
$user = $_POST['user_name'];
$sandi = $_POST['password'];

$data = mysqli_query($konek,"select * from login where user_name='$user' and password='$sandi'");

//menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

// jika data ketemu lebih dari 0
if ($cek > 0) {
    $row = $data->fetch_assoc();
    if($row['level']=="dosen"){
        $_SESSION['id_dosen'] = $row["id_dosen"];
        $_SESSION['user_name'] = $row['user_name'];
        $_SESSION['level'] = $row['dosen'];
        header("location:../kelas/kelas_dosen/ruangdosen.php");
        
    }elseif($row['level']=="mahasiswa"){
        $_SESSION['id_mahasiswa'] = $row["id_mahasiswa"];
        $_SESSION['user_name'] = $row['user_name'];
        header("location:../kelas/kelas_mahasiswa/ruang_mhs.php");
    }else{
        header("location:../logineror.php");
    }
}else{
	header("location:../logineror.php");
}



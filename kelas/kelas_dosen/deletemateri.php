<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: ../../logineror.php");
}
$balik = $_SESSION['idkelas'];
include 'konek.php';
$id = $_GET['idmateri'];
mysqli_query($konek, "DELETE FROM materi WHERE idmateri='$id'");

if (mysqli_affected_rows($konek) > 0) {
    echo "<script>
          alert('data berhasil di hapus');
          document.location.href = 'rincian_kelas.php?id_kelas=$balik';
          </script>";
} else {
    echo "<script>
        alert('data gagal di hapus');
        document.location.href = 'rincian_kelas.php?id_kelas=$balik';
        </script>";
}

<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: ../../logineror.php");
}
// ['file'] yang dikirimkan dari homepage diterima dalam method GET, ['file'] adalah nama file. Apabila nama file tersedia di dalam database, dan file nya tersimpan di dalam direktori folder, maka keduanya terdapat kecocokan. Jika kecocokan ini terjadi, maka proses download file akan dieksekusi.
$lokasi = "../../upload/"; //inisiasi lokasi terlebih dahulu
$fileName = $lokasi . $_GET['file']; //mendapatkan file dari folder upload
if (file_exists($fileName)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($fileName));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: private');
    header('Pragma: private');
    header('Content-Length: ' . filesize($fileName));
    ob_clean();
    flush();
    readfile($fileName);

    exit;
} else {
    echo "<script>
        alert('File tidak ada');
        </script>";
}

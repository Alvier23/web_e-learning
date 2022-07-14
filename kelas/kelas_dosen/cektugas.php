<?php
include 'konek.php';
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: ../../logineror.php");
}
$idTugas = $_GET['idtugas'];
$_SESSION['idtgs'] = $idTugas;
$query = mysqli_query($konek, "SELECT * FROM tugas WHERE idtugas=$idTugas");
$dataTugas = mysqli_fetch_assoc($query);

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <title><?= $dataTugas['uraian_tugas']; ?></title>
</head>

<body>
    <div class="container mt-3 mb-3">
        <a href="penugasan.php?id_kelas=<?= $dataTugas['id_kelas'] ?>"><button class="btn btn-primary">Kembali</button></a>
    </div>
    <!-- fungsi update nilai -->
    <?php
    if (isset($_POST['updateNilai'])) {
        $idKump = ($_GET['id']);
        $nilaiKump = $_POST['nilaiKumpul'];
        $idTug = $_GET['idtugas'];

        mysqli_query($konek, "UPDATE kumpulkan SET nilai=$nilaiKump WHERE id=$idKump");
        header("location:cektugas.php?idtugas=$idTug");
    }

    ?>
    <div class="container">
        <p>Nama Tugas : <?= $dataTugas['uraian_tugas']; ?></p>
        <!-- buat form -->
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>File Pengumpulan Tugas</th>
                    <th>Nilai</th>
                    <th></th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php
            $kumpulkan = mysqli_query($konek, "SELECT * FROM kumpulkan a 
                                    JOIN mhs b ON a.idmhs=b.id_mhs WHERE idtugas=$idTugas");
            while ($dataKumpul = mysqli_fetch_assoc($kumpulkan)) {
                $NIM = $dataKumpul['idmhs'];
                $idKumpulkan = $dataKumpul['id'];
            ?>
                <tbody>
                    <tr>
                        <td><?= $NIM; ?></td>
                        <td><?= $dataKumpul['nm_mhs']; ?></td>
                        <td><a href="download.php?file=<?= $dataKumpul['file1']; ?>"><?= $dataKumpul['file1']; ?></a></td>
                        <form action="updateNilai.php" method="post">
                            <td width="80px">
                                <input type="hidden" name="idKumpul" value="<?= $idKumpulkan ?>">
                                <input class="form-control" name="nilaiKumpul" type="text" value="<?= $dataKumpul['nilai']; ?>">
                            </td>
                            <td>/100</td>
                            <td><button class="btn btn-primary btn-sm" type="submit" name="updateNilai">Update Nilai</button></td>
                        </form>
                    </tr>
                </tbody>
            <?php } ?>
        </table>
    </div>
    <br><br>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>
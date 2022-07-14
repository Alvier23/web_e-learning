<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: ../../logineror.php");
}
include 'konek.php';
$idmhs = $_SESSION['id_mahasiswa'];
$idkel = $_GET['id_kelas'];
$kueriKelas = mysqli_query($konek, "SELECT nama_kelas FROM kelas_mahasiswa a JOIN kelas b  
                                ON a.id_kelas=b.id_kelas
                                WHERE id_mhs=$idmhs");
while ($kls = mysqli_fetch_assoc($kueriKelas)) {
    $title = $kls['nama_kelas'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title><?= $title; ?></title>
</head>

<body class="container">
    <!-- navbar -->
    <?php
    include 'tnav_rincian.php';
    ?>

    <div class="mt-5">
        <table id="tabelanu" class="table table-striped table-bordered" style="width:100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Tugas</th>
                    <th>File Tugas</th>
                    <th>Deadline</th>
                    <th>Assigment</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $queryTugas = mysqli_query($konek, "SELECT * FROM tugas a JOIN kelas_mahasiswa b
                                                    ON a.id_kelas=b.id_kelas
                                                    WHERE b.id_mhs=$idmhs AND a.id_kelas=$idkel");
                while ($dataTugas = mysqli_fetch_assoc($queryTugas)) {
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $dataTugas['uraian_tugas']; ?></td>
                        <td><a href="download.php?file=<?= $dataTugas['file_tugas']; ?>"><?= $dataTugas['file_tugas']; ?></a></td>
                        <!-- buat fungsi telat -->
                        <?php
                        $tgl_now = date("Y-m-d");
                        $tgl_exp = $dataTugas['batas_akhir'];
                        ?>
                        <td><?= $dataTugas['batas_akhir']; ?>
                            <?php
                            if ($tgl_now >= $tgl_exp) {
                                echo '<span class="badge badge-danger ml-2">LATE</span>';
                            ?>
                        </td>
                        <td align="center">
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#kumpulModal" disabled>Kumpulkan</button>
                        <?php } else { ?>
                        <td align="center"><a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#kumpulModal<?= $dataTugas['idtugas']; ?>">Kumpulkan</a>
                        <?php   } ?>
                        </td>
                        <td align="center"><button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ceknilaiModal<?= $dataTugas['idtugas']; ?>">Cek Nilai</button></td>
                    </tr>

                    <!-- masih di dalam while untuk mendapatkan idtugas -->
                    <!-- modal kumpulkan -->
                    <div class="modal fade" id="kumpulModal<?= $dataTugas['idtugas']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Kumpulkan Tugas</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="idmhs" value="<?= $idmhs; ?>">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="a">ID Tugas</label>
                                            <input type="text" class="form-control" name="idtugas" id="a" value="<?= $dataTugas['idtugas']; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Masukan Tugas</label>
                                            <input type="file" name="kumpulTugas" class="form-control-file" required>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-subtitle mb-2 text-muted">Tugas Anda</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="btnKumpulkan" class="btn btn-primary">Kumpulkan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- tutup modal-->

                    <!-- modal cek nilai -->
                    <div class="modal fade bd-example-modal-sm" id="ceknilaiModal<?= $dataTugas['idtugas']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Cek Nilai Kamu</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    $idtgs = $dataTugas['idtugas'];
                                    $idmhs = $_SESSION['id_mahasiswa'];
                                    $anu = mysqli_query($konek, "SELECT nilai FROM kumpulkan WHERE idtugas=$idtgs AND idmhs=$idmhs");
                                    while ($dataku = mysqli_fetch_assoc($anu)) {
                                        echo $dataku["nilai"];
                                    }
                                    ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- tutup -->

                <?php } ?>
                <!-- tutup while -->
            </tbody>
        </table>
    </div>
    <!-- fungsi masukan tugas oleh mahasiswa -->
    <?php
    if (isset($_POST['btnKumpulkan'])) {
        $idTugas = $_POST['idtugas'];
        $idMhs = $_POST['idmhs'];
        if ($_FILES['kumpulTugas']['name'] === "") {
            echo "<script> alert('File Tidak Boleh Kosong'); </script>";
        } else {
            // fungsi upload tugas
            $random = rand();
            $namaFile = $_FILES['kumpulTugas']['name'];   //nama file nya
            $ukuranFile = $_FILES['kumpulTugas']['size'];  //ukuran file nya
            $tmpFile = $_FILES['kumpulTugas']['tmp_name']; //tempat penyimpanan sementara, nanti di pindah ke folder upload
            // cek ekstensi file yang harus berupa jpg, png, jpeg, doc, docx, excel, pptx, pdf
            $cekJenis = ['jpg', 'jpeg', 'png', 'doc', 'docx', 'xlsx', 'pptx', 'pdf'];
            $tempatUp = "../../upload/";
            // pecah string
            $jenisFile = explode('.', $namaFile);
            // rubah ektensi file ke huruf kecil dan mengambil hasil pecahan string terakhir
            $jenisFileboleh = strtolower(end($jenisFile));
            if (!in_array($jenisFileboleh, $cekJenis)) {
                echo "<script>
                    alert('Jenis file yang anda upload salah/belum mendukung, silahkan upload lagi');
                    </script>";
            } else {
                if ($ukuranFile < 10000000) {
                    $namaFilebaru = $random . '_' . $namaFile;
                    move_uploaded_file($tmpFile,  $tempatUp . $random . '_' . $namaFile);
                    mysqli_query($konek, "INSERT INTO kumpulkan VALUES(NULL,$idTugas,$idMhs,NULL,'$namaFilebaru',NULL,NULL,NULL)");
                    echo "<script>
                        alert('Tugas berhasil di upload');
                        document.location.href = 'cekTugas.php?id_kelas=$idkel';
                        </script>";
                } else {
                    echo "<script>
                        alert('File yang anda upload Terlalu besar, silahkan upload lagi');
                        </script>";
                }
            }
        }
    }
    ?>




    <!-- Library javacscript datatable -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <!-- Menambahkan modal bootstrap -->
    <!-- mengaktifkan datatable alias mengesekusi tabelnya -->
    <script>
        $(document).ready(function() {
            $('#tabelanu').DataTable({
                "lengthMenu": [
                    [5, 10, 20, -1],
                    [5, 10, 20, "All"]
                ]
            });
        });
    </script>
</body>

</html>
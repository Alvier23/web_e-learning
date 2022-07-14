<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $idkel = $_GET['id_kelas'];
    $_SESSION['idkelas'] = $idkel;
    include 't_head.php';
    include 't_nav.php';
    ?>


    <!-- container -->
    <div class="container mt-5 md-5">
        <br><br><br>
        <!-- table data -->
        <table id="tabelanu" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>URAIAN TUGAS</th>
                    <th>ID KELAS</th>
                    <th>BATAS AKHIR</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php include 'konek.php';
                // menambahkan no urutan
                $no = 1;
                // session id dosen
                $id = $_SESSION['id_dosen'];
                // ambil data dari url
                $idkelas = $_GET["id_kelas"];
                // sintaks query menampilkan tugas kelas berdasarkan id dosennya dan kelas nya
                $sql = mysqli_query($konek, "SELECT * FROM tugas a JOIN kelas b ON a.id_kelas = b.id_kelas 
                                  where id_dosen ='$id'AND a.id_kelas ='$idkelas' ");
                while ($data = mysqli_fetch_assoc($sql)) {
                ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?php echo $data['uraian_tugas']; ?></td>
                        <td><?php echo $data['nama_kelas']; ?></td>
                        <td><?php echo $data['batas_akhir']; ?></td>
                        <td><a href="cektugas.php?idtugas=<?= $data['idtugas'] ?>" class="badge badge-warning">Cek Pengumpulan</a></td>
                    </tr>
                    <?php $no++ ?>
                <?php } ?>
            </tbody>
        </table>
    </div>



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
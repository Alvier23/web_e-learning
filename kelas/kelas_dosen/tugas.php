<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include 'konek.php';
  include 't_head.php';
  $idkel = $_GET['id_kelas'];
  $_SESSION['idkelas'] = $idkel;
  include 't_nav.php';
  ?>

  <!-- tutup class nav -->
  <!-- container -->
  <div class="container mt-5 md-5">
    <!-- Menambahkan button tambah kelas untuk memunculkan modal form tambah kelas -->
    <br><br>
    <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#modalKu">Tambah Tugas +</button>
    <?php
    $idkel = $_GET['id_kelas'];
    // membuat fungsi updload tugas
    if (isset($_POST['submit'])) {
      $idkelas = $_POST['id_kelas'];
      $uraian = $_POST['uraian_tugas'];
      $batas = $_POST['batas_akhir'];
      if ($_FILES['file_tugas']['name'] === "") {
        mysqli_query($konek, "INSERT INTO tugas VALUE(NULL, '$idkelas','$uraian',NULL,NULL,'$batas')");
        echo "<script>
              alert('data berhasil di tambahkan');
              document.location.href = 'tugas.php?id_kelas=$idkel';
              </script>";
      } else {
        // fungsi upload tugas
        $random = rand();
        $namaFile = $_FILES['file_tugas']['name'];   //nama file nya
        $ukuranFile = $_FILES['file_tugas']['size'];  //ukuran file nya
        $tmpFile = $_FILES['file_tugas']['tmp_name']; //tempat penyimpanan sementara, nanti di pindah ke folder upload
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
            mysqli_query($konek, "INSERT INTO tugas VALUE(NULL, '$idkelas','$uraian','$namaFilebaru',NULL,'$batas')");
            echo "<script>
            alert('data berhasil di tambahkan');
            document.location.href = 'tugas.php?id_kelas=$idkel';
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
    <!-- Modal Tambah -->
    <div class="modal fade" id="modalKu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Tugas Baru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!-- modal body nya -->
          <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data">
              <div class='row'>
                <div class='col'>
                  <p>Masukan KODE KELAS:</p>
                  <input class='form-control' type="text" name="id_kelas" id="id_kelas" value="<?php echo $_GET['id_kelas']; ?>" readonly>
                </div>
              </div>
              <div class='row'>
                <div class='col'>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Uraian:</label>
                    <textarea class="form-control" id="uraian_tugas" name='uraian_tugas' rows="3"></textarea>
                  </div>
                </div>
              </div>
              <div class='row'>
                <div class='col'>
                  <div class="custom-file">
                    <input type="file" id="file_tugas" name="file_tugas">
                  </div>
                </div>
              </div>
              <div class='row'>
                <div class="col">
                  <p>Tanggal Batas Akhir Pengumpulan:</p>
                  <input class='form-control' type="date" name="batas_akhir" id="batas_akhir" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- table data -->
    <table id="tabelanu" class="table table-striped table-bordered" style="width:100%">
      <thead>
        <tr>
          <th>NO.</th>
          <th>URAIAN TUGAS</th>
          <th>ID KELAS</th>
          <th>FILE TUGAS</th>
          <th>WAKTU UPLOAD</th>
          <th>BATAS AKHIR</th>
          <th>ACTION</th>
        </tr>
      </thead>
      <tbody>
        <?php
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
            <td><?php echo $data['file_tugas']; ?></td>
            <td><?php echo $data['waktu_upload']; ?></td>
            <td><?php echo $data['batas_akhir']; ?></td>
            <td><a href="#" class="badge badge-warning">Edit</a> | <a href="deletetugas.php?idtugas=<?= $data['idtugas']; ?>" onclick="return confirm('Data akan di hapus ?');" class="badge badge-danger">Delete</a></td>
          </tr>
          <?php $no++ ?>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <!-- hapus data -->

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
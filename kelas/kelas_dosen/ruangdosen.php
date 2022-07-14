<!doctype html>
<html lang="en">
<?php

session_start();
if (!isset($_SESSION['user_name'])) {
  header("Location: ../../logineror.php");
}

include '../../template/header.php'
?>

<body>
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="../../img/topi.png" width="30" height="30"></a>
      <a class="navbar-brand" href="#">KELASKU</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
          <a class="btn btn-dark" href="../../logout.php">logout <span class="sr-only">(current)</span></a>
        </div>
      </div>
    </div>
  </nav>
  <br><br><br><br>

  <div class='container text-center'>
    <h3 style="text-transform:uppercase;"> SELAMAT DATANG DI RUANG DOSEN <b><?php echo $_SESSION['user_name']; ?></b></h3>
  </div>
  <br>
  <div class='container'>
    <?php
    include 'konek.php';

    //menangkap dta yang di kirim form
    if (isset($_POST['submit'])) {
      $namakelas = $_POST['namakelas'];
      $tahun = $_POST['tahun'];
      $semester = $_POST['semester'];
      $id_dosen = $_SESSION['id_dosen'];

      //input data ke database
      mysqli_query($konek, "INSERT INTO kelas VALUES(NULL,'$namakelas','$id_dosen','$tahun','$semester')");
      if (mysqli_affected_rows($konek) > 0) {
        echo "<script>
            alert('data berhasil di tambahkan');
            document.location.href = 'ruangdosen.php';
            </script>";
      } else {
        echo "<script>
            alert('data gagal di tambahkan');
            document.location.href = 'ruangdosen.php';
            </script>";
      }
    }
    ?>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kelasModal">
      Tambah Kelas
    </button>
    <!-- Modal -->
    <div class="modal fade " id="kelasModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">TAMBAH KELAS</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="" method="post">
            <div class="modal-body">
              <div class="form-group">
                <label for="namakelas">Nama Kelas :</label>
                <input type="text" class="form-control" id="namakelas" name="namakelas" required>
              </div>
              <div class="form-group">
                <label for="tahun">Tahun Ajaran</label>
                <input type="text" class="form-control" id="tahun" name="tahun" required>
              </div>
              <div class="form-group">
                <label for="semester">Semester</label>
                <select class="form-control" id="semester" name="semester" required>
                  <option>Ganjil</option>
                  <option>Genap</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" name="submit" class="btn btn-primary">Buat Kelas</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <br>
    <h3>Kelas Anda</h3>
    <table class="table table-bordered mb-2">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode Kelas</th>
          <th>Nama Kelas</th>
          <th>Tahun Ajaran</th>
          <th>Semester</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        // inisiasi id dosen dengan $idos
        $idos = $_SESSION['id_dosen'];
        // manggil koneksi
        include 'konek.php';
        // query tabel kelas berdasarkan id dosen
        $query = mysqli_query($konek, "SELECT * FROM kelas WHERE id_dosen='$idos'");
        // Melakukan perulangan untuk memanggil semua isi data yang ada di tabel
        while ($data = mysqli_fetch_assoc($query)) {
        ?>
          <tr>
            <td><?= $no ?></td>
            <td><?= $data['id_kelas']; ?></td>
            <td><?= $data['nama_kelas']; ?></td>
            <td><?= $data['tahun_ajaran']; ?></td>
            <td><?= $data['semester']; ?></td>
            <td><a href="rincian_kelas.php?id_kelas=<?= $data["id_kelas"]; ?>">Cek</a></td>
          </tr>
          <?php $no++ ?>
        <?php } ?>
      </tbody>
    </table>

    <div class='row'>
      <div class='col-sm-6'>
      </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
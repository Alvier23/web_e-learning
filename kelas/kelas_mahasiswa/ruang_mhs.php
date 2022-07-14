<?php
session_start();
if (!isset($_SESSION['user_name'])) {
  header("Location: ../../logineror.php");
}
include 'konek.php';

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <title>Kelasku</title>
</head>

<body>
  <!-- navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary mb-5">
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
  <!-- tutup navbar -->]
  <!-- container utama -->
  <div class="container mt-5">
    <h3 style="text-transform:uppercase; text-align:center;">Selamat Datang di Ruang Kelas Mahasiswa "<?= $_SESSION['user_name'] ?>" </h2>
      <!-- tabel -->
      <?php
      if (isset($_GET['pesan'])) {
        $pesan = $_GET['pesan'];
        if ($pesan === 'gagal') {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> anda sudah bergabung kelas tersebut
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
               </div>';
        } elseif ($pesan === 'sukses') {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Yeay!</strong> anda berhasil bergabung kelas
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
        }
      }
      ?>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#gabungModal">Gabung Kelas</button>
      <h5 class="mt-2">Daftar Kelas Yang Anda Ikuti</h5>
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Kelas</th>
            <th scope="col">Nama Pengajar</th>
            <th scope="col">Tahun Ajaran</th>
            <th scope="col">Semester</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <!-- menampilkan kelas mahasiswa berdasarkan nim mahasiswa -->
        <?php
        $no = 1;
        $idmhs = $_SESSION['id_mahasiswa'];
        $kelasmhs = mysqli_query($konek, "SELECT * FROM kelas_mahasiswa a JOIN kelas b  
                                        ON a.id_kelas=b.id_kelas JOIN dosen c
                                        ON b.id_dosen=c.id_dosen
                                        WHERE id_mhs=$idmhs");
        while ($datakelas = mysqli_fetch_assoc($kelasmhs)) {
          $idkelas = $datakelas['id_kelas'];
        ?>
          <tbody>
            <tr>
              <th scope="row"><?= $no; ?></th>
              <td><?= $datakelas['nama_kelas']; ?></td>
              <td><?= $datakelas['nama_dosen']; ?></td>
              <td><?= $datakelas['tahun_ajaran']; ?></td>
              <td><?= $datakelas['semester']; ?></td>
              <td><a href="rincian_kelasmhs.php?id_kelas=<?= $idkelas ?>">Cek Kelas</a></td>
            </tr>
          </tbody>
          <?php $no++ ?>
        <?php } ?>
      </table>
  </div>
  <br><br>

  <!-- Fungsi masuk/join kelas  -->
  <?php
  include 'konek.php';
  if (isset($_POST['masukan'])) {
    $idkelas = $_POST['idkelas'];
    $nim = $_POST['nim'];
    $query = mysqli_query($konek, "SELECT id_kelas, id_mhs FROM kelas_mahasiswa WHERE id_kelas=$idkelas AND id_mhs=$nim");
    // cek apakah sudah bergabung atau belum
    if ($query->num_rows > 0) {
      header("location:ruang_mhs.php?pesan=gagal");
    } else {
      mysqli_query($konek, "INSERT INTO kelas_mahasiswa VALUES(NULL,$idkelas,$nim)");
      header("location:ruang_mhs.php?pesan=sukses");
    }
  }
  ?>
  <!-- modal boostrap gabung kelas -->
  <div class="modal fade" id="gabungModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Gabung Kelas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST">
          <div class="modal-body">
            <input type="hidden" name="nim" value="<?= $idmhs; ?>">
            <div class="form-group">
              <label for="kls">Kode Kelas</label>
              <input type="text" class="form-control" name="idkelas" id="kls" aria-describedby="emailHelp" placeholder="Masukan Kode Kelas" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="masukan" class="btn btn-primary">GABUNG</button>
          </div>
        </form>
      </div>
    </div>
  </div>


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
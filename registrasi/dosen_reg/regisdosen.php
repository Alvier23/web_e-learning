<!doctype html>
<html lang="en">
<?php
include 'header.php'
?>

<body>
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="../../img/topi.png" width="30" height="30"></a>
      <a class="navbar-brand" href="index.php">KELASKU</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link active" href="../../index.php">kembali <span class="sr-only">(current)</span></a>
        </div>
      </div>
    </div>
  </nav><br><br><br>

  <div class='container'>
    <div class='row'>
      <div class='col text-center'>
        <h3 class="mb-5">SELAMAT DATANG DI REGISTRASI DOSEN DI KELASKU</h3>
      </div>
    </div>
    <div class='row'>
      <div class='col text-center'>
        <?php
        include 'cover.php'
        ?>
      </div>
      <div class='col'>
        <form action="cekrdosen.php" method="post">
          <div class="row">
            <label for="validationDefault01">NIK DOSEN</label>
            <input type="text" class="form-control" name="id_dosen" required>
          </div>
          <div class="row">
            <label for="validationDefault02">NAMA DOSEN</label>
            <input type="text" class="form-control" name="nama_dosen" required>
          </div>
          <div class="row">
            <label for="validationDefaultUsername">EMAIL</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupPrepend2">@</span>
              </div>
              <input type="text" class="form-control" name="email" aria-describedby="inputGroupPrepend2" required>
            </div>
          </div>
          <div class="row">
            <label>NO HP</label>
            <input type="text" class="form-control" name="notelp" required>
          </div>
          <div class='row'>
            <button class="btn btn-primary mt-2" type="submit">Selanjutnya</button>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <p> Anda sudah regristasi sebelumnya ? </p><a href="regisdosen2.php"> klik disini</a>
          </div>
        </form>
      </div>
    </div>









    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
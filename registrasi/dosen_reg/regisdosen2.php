<!DOCTYPE html>
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
          <a class="nav-item nav-link active" href="regisdosen.php">kembali <span class="sr-only">(current)</span></a>
        </div>
      </div>
    </div>
  </nav> <br><br><br><br>

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
        <form action="cekrdosen2.php" method="post">
          <div class="row">
            <label for="validationDefault01">USERNAME</label>
            <input type="text" class="form-control" name="user_name" required>
          </div>
          <div class="row">
            <label for="validationDefault02">PASSWORD</label>
            <input type="password" class="form-control" name="password" required>
          </div>
          <div class="row">
            <label>NIK dosen</label>
            <input type="text" class="form-control" name="id_dosen" required>
          </div>
          <div class='row'> <button class="btn btn-primary" type="submit">sign-up</button></div>
      </div>
      </form>
    </div>
  </div>
</body>

</html>
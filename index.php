<!doctype html>
<html lang="en">

<?php
include 'template/header.php'
?>

<body class='bg-dark'>
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="img/topi.png" width="30" height="30"></a>
      <a class="navbar-brand" href="index.php">KELASKU</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
          <a class="nav-item nav-link" href="login/login.php">Login</a>
        </div>
        <div class="btn-group">
          <button type="button" class="btn btn-secondary dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            sign-up
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="registrasi/dosen_reg/regisdosen.php">Dosen</a>
            <a class="dropdown-item" href="registrasi/mahasiswa_reg/regismhs.php">Mahasiswa</a>
          </div>
        </div>
      </div>
      <!-- Example single button -->
    </div>
  </nav>


  <?php
  include 'template/cover.php'
  ?>

  <?php
  include 'template/content.php';
  include 'template/footer.php';
  ?>
</body>

</html>
<!doctype html>
<html lang="en">
<?php
include '../template/header.php'
?>
  <body >
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
    <a class="navbar-brand" href="#">
    <img src="../img/topi.png" width="30" height="30"></a>
  <a class="navbar-brand" href="../index.php">KELASKU</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="../index.php">Home <span class="sr-only">(current)</span></a>
    </div>
  </div>
  </div>
</nav>

<div class="jumbotron jumbotron-fluid mt-5 pb-3">
  <div class="container text-center" >
   <H3>LOGIN DENGAN AKUNMU UNTUK TETAP TERUS MENGGUNAKAN E-LEARNING KELASKU</H3>
  </div>
  </div>
    <div class="container">
    <div class="row">
      <div class="col"></div>
      <div class="col">
        <div class="card" style="width: 18rem;">
          <div class="card-body">
            <h5>Sign in to Kelasku</h5>
            <p>All fields are required</p>
            <form action="ceklogin.php" method="post">
              <div class="form-group">
                <input type="text" class="form-control" name="user_name" id="username" placeholder="Username">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
              </div>
              <button type="submit" name="submit" class="btn btn-primary">Log In</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col"></div>
    </div>
      
    <!-- action ceklogin.php di cek apakah login dosens atau mahasiswa -->
    </div>
</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
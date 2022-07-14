<!doctype html>
<html lang="en">
<?php


$idkel = $_GET['id_kelas'];
include 't_head.php';
include 't_nav.php';

?>

<br><br><br><br>
<div class="container text-center pt-3 md-5">
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th>NIM MAHASISWA</th>
        <th>NAMA MAHASISWA</th>
      </tr>
    </thead>
    <tbody>
      <?php include 'konek.php';
      $idkelas = $_GET['id_kelas'];
      $sql = mysqli_query($konek, "SELECT * FROM kelas_mahasiswa a JOIN mhs b ON a.id_mhs=b.id_mhs 
                                    WHERE id_kelas=$idkelas");
      while ($data = mysqli_fetch_assoc($sql)) {
      ?>
        <tr>
          <td><?php echo $data['id_mhs']; ?></td>
          <td><?php echo $data['nm_mhs']; ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
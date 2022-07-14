<?php
include 't_head.php';
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
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="mahasiswa.php?id_kelas=<?= $_GET["id_kelas"]; ?>">mahasiswa <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link active" href="ruangdosen.php">kembali <span class="sr-only">(current)</span></a>
                </div>
            </div>
        </div>
    </nav>
    <br><br><br>
    <section class="container mt-5">
        <div class="row">
            <!-- mendaptkan id dari url -->
            <?php

            ?>
            <div class="col">
                <div class="card mb-4">
                    <div class="card-body text-white bg-primary">
                        <h5 class="card-title text-center">BUAT TUGAS</h5>
                        <p class="card-text">buat Tugas mu lebih mudah dengan upload file</p>
                        <a href="tugas.php?id_kelas=<?= $_GET["id_kelas"]; ?>" class="btn btn-warning">+ TUGAS</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4">
                    <div class="card-body text-white bg-primary">
                        <h5 class="card-title text-center">CEK PENUGASAN</h5>
                        <p class="card-text">Pantau penugasan yang telah di upload</p>
                        <a href="penugasan.php?id_kelas=<?= $_GET["id_kelas"]; ?>" class="btn btn-warning">PENUGASAN</a>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col">
                <div class="card bg-light">
                    <div class="card-body">
                        <?php
                        date_default_timezone_set('Asia/Jakarta');
                        if (isset($_POST['submit'])) {
                            $judulm = $_POST['judul'];
                            $isi = $_POST['isi'];
                            $idk = $_GET['id_kelas'];
                            $tgl = date("Y-m-d");
                            // cek apakah $file ada isinya apa enggak
                            if ($_FILES['file_materi']['name'] === "") {
                                // jika tidak ada isi file, langsung esekusi query dg isi file null tanpa melakukan pengecekan
                                mysqli_query($konek, "INSERT INTO materi VALUES(NULL, '$judulm','$isi',NULL,'$idk','$tgl')");
                                header("Location:rincian_kelas.php?id_kelas=$idk");
                                // jika ada isinya, melakukan fungsi cek upload materi
                            } else {
                                // membuat fungsi upload materi
                                $random = rand();
                                // menginisiasi dan mengambil data assosiatif array dari fungsi $_files
                                $namaFile = $_FILES['file_materi']['name'];   //nama file nya
                                $ukuranFile = $_FILES['file_materi']['size'];  //ukuran file nya
                                $tmpFile = $_FILES['file_materi']['tmp_name']; //tempat penyimpanan sementara, nanti di pindah ke folder upload
                                // cek ekstensi file yang harus berupa jpg, png, jpeg, doc, docx, excel, pptx, pdf
                                $cekJenis = ['jpg', 'jpeg', 'png', 'doc', 'docx', 'xlsx', 'pptx', 'pdf'];
                                $tempatUp = "../../upload/";
                                // pecah string
                                $jenisFile = explode('.', $namaFile);
                                // rubah ektensi file ke huruf kecil dan mengambil hasil pecahan string terakhir
                                $jenisFileboleh = strtolower(end($jenisFile));

                                // mengecek apakah ada string di array lalu mengecek apakah sesuai jenis file yang di tentukan
                                if (!in_array($jenisFileboleh, $cekJenis)) {
                                    echo "<script>
                                        alert('Jenis file yang anda upload salah/belum mendukung, silahkan upload lagi');
                                        </script>";
                                } else {
                                    // cek ukuran file < 10 mb
                                    if ($ukuranFile < 10000000) {
                                        $namafileBaru = $random . '_' . $namaFile;   //merubah nama file nya ke nomer acak
                                        //fungsi php untuk memindahkan file yang di upload ke derictory yg sudah di tentukan 
                                        move_uploaded_file($tmpFile,  $tempatUp . $random . '_' . $namaFile);
                                        // jalankan querynya
                                        mysqli_query($konek, "INSERT INTO materi VALUES(NULL, '$judulm','$isi','$namafileBaru','$idk','$tgl')");
                                        header("Location:rincian_kelas.php?id_kelas=$idk");
                                    } else {
                                        echo "<script>
                                            alert('File yang anda upload Terlalu besar, silahkan upload lagi');
                                            </script>";
                                    }
                                }
                            }
                        }
                        ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <h2 style="text-align: center;">Materi</h2>
                                <h5>Buat pengunguman</h5>
                                <input type="text" class="form-control mb-1" name="judul" placeholder="Isi Judul" required>
                                <textarea class="form-control" id="isi" name='isi' rows="3" placeholder="Umumkan sesuatu atau tambah materi di kelas anda" required></textarea>
                                <div class="form-group">
                                    <label for="file1">Tambahkan File</label>
                                    <input type="file" class="form-control-file" id="file1" name="file_materi">
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $iddsn = $_SESSION['id_dosen'];
        $idkls =  $_GET["id_kelas"];
        $_SESSION['idkelas'] = $idkls;
        $result = mysqli_query($konek, "SELECT * FROM materi a JOIN kelas b ON a.id_kelas = b.id_kelas WHERE id_dosen='$iddsn' AND a.id_kelas=$idkls ORDER BY a.idmateri DESC");
        while ($data = mysqli_fetch_assoc($result)) {
        ?>
            <br>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div href="" class="card-title" style="text-transform:uppercase;">
                                <img src="../../img/topi.png" width="30" height="30"> <?= $_SESSION['user_name']; ?>
                            </div>
                            <h5 class="card-title"><?= $data['judul']; ?></h5>
                            <p class="card-title"><?= $data['tgl_diupload']; ?></p>
                            <p class="card-text"><?= $data['isi']; ?></p>
                        </div>
                        <div>
                            <a style="float: right; margin-right:10px" href="deletemateri.php?idmateri=<?= $data['idmateri']; ?>" class="badge badge-danger">Hapus</a>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"></li>
                            <li class="list-group-item">Download Materi : <a href="download.php?file=<?= $data['file'] ?>"><?= $data['file'] ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
    <br><br>

</body>

</html>
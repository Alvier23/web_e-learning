<?php
include 'thead_rincian.php';
include 'tnav_rincian.php';
?>


<!-- nav pane boostrap -->
<div class="mt-5">
    <?php
    $queryMateri = mysqli_query($konek, "SELECT * FROM materi a JOIN kelas_mahasiswa b 
                                                    ON a.id_kelas=b.id_kelas JOIN kelas c
                                                    ON a.id_kelas=c.id_kelas JOIN dosen d
                                                    ON c.id_dosen=d.id_dosen
                                                    WHERE a.id_kelas=$idkel AND b.id_mhs=$idmhs ORDER BY a.idmateri DESC");
    while ($dataMateri = mysqli_fetch_assoc($queryMateri)) {
    ?>
        <div class="row">
            <div class="col">
                <div class="card mt-3 mb-3">
                    <div class="card-body">
                        <div href="" class="card-title" style="text-transform:uppercase;">
                            <img src="../../img/topi.png" width="30" height="30"> <?= $dataMateri['nama_dosen']; ?>
                        </div>
                        <h5 class="card-title"><?= $dataMateri['judul']; ?></h5>
                        <p class="card-title"><?= $dataMateri['tgl_diupload']; ?></p>
                        <p class="card-text"><?= $dataMateri['isi']; ?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Download Materi : <a href="download.php?file=<?= $dataMateri['file'] ?>"><?= $dataMateri['file']; ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php
include 'tfoot_rincian.php';
?>
</body>

</html>
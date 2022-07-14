<body class="container">
    <!-- navbar -->
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
                    <li class="nav-item active">
                        <a class="nav-link" href="rincian_kelasmhs.php?id_kelas=<?= $_GET['id_kelas']; ?>">Forum Materi <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="cekTugas.php?id_kelas=<?= $_GET['id_kelas']; ?>">Cek Penugasan</a>
                    </li>
                    <a class="nav-item nav-link active" href="ruang_mhs.php">Kembali <span class="sr-only">(current)</span></a>
                </div>
            </div>
        </div>
    </nav>
    <br><br>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/datatable/datatables.css'); ?>">
    <script type="text/javascript" src="<?= base_url('assets/js/jquery.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/bootstrap.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/datatable/jquery.datatables.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/datatable/datatables.js'); ?>"></script>
    <script>
        function reloadpage() {
            location.reload()
        }
    </script>
</head>

<body>
    <div class="modal-body">
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row no-gutters">
                <?php foreach ($buku as $b) { ?>
                    <div class="col-md-4">
                        <img src="<?= base_url('assets/upload/') . $b->gambar; ?>" width="180" class="card-img">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Judul = <?= $b->judul_buku; ?></li>
                                <li class="list-group-item">Kategori = <?= $b->nama_kategori; ?></li>
                                <li class="list-group-item">Pengarang = <?= $b->pengarang; ?></li>
                                <li class="list-group-item">Tahun Terbit = <?= $b->thn_terbit; ?></li>
                                <li class="list-group-item">ISBN = <?= $b->isbn; ?></li>
                                <li class="list-group-item">Lokasi = <?= $b->lokasi; ?></li>
                                <li class="list-group-item">Status = <?php
                                                                        if ($b->status_buku == "1") {
                                                                            echo "<p style='border-radius: 50px;' class=\"btn btn-success btn-xs\">Tersedia</p>";
                                                                        } else if ($b->status_buku == "0") {
                                                                            echo "<p style='border-radius: 50px;' class=\"btn btn-warning btn-xs\">Sedang Dipinjam</p>";
                                                                        }
                                                                        ?></li>
                            </ul>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="document.location.reload(true)">Tutup</button>
    </div>
</body>

<?php } ?>
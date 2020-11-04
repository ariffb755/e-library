<div class="page-header">
    <h3>Data Buku</h3>
    <?= $this->session->flashdata('message'); ?>
</div>
<a href="<?= base_url('admin/tambah_buku'); ?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span>Buku Baru</a>
<br><br>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover" id="table-datatable">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Gambar</th>
                <th scope="col">Judul Buku</th>
                <th scope="col">Status</th>
                <th scope="col">Pilihan</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($buku as $b) {
            ?>
                <tr>
                    <td scope="row"><?= $no++; ?></td>
                    <td><img src="<?= base_url('assets/upload/') . $b->gambar; ?>" width="80" alt="Cover Buku"></td>
                    <td><?= $b->judul_buku; ?></td>
                    <td><?= $b->lokasi; ?></td>
                    <td>
                        <?php
                        if ($b->status_buku == "1") {
                            echo "<span style='border-radius: 50px;' class='btn btn-success btn-xs'>Tersedia</span>";
                        } else if ($b->status_buku == "0") {
                            echo "<span style='border-radius: 50px;' class='btn btn-warning btn-xs'>Sedang Dipinjam</span>";
                        }
                        ?>
                    </td>
                    <td nowrap="nowrap">
                        <a class="btn btn-success btn-xs" href="<?= base_url('admin/detail_buku/') . $b->id_buku; ?>" data-toggle="modal" data-target="#newMenuModal"><span class="glyphicon glyphicon-zoom-in"></span></a>
                        <a class="btn btn-primary btn-xs" href="<?= base_url('admin/edit_buku/') . $b->id_buku; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a class="btn btn-danger btn-xs" href="<?= base_url('admin/hapus_buku/') . $b->id_buku; ?>"><span class="glyphicon glyphicon-remove"></span></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModal">Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>



        </div>
    </div>
</div>
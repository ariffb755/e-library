<div class="page-header">
    <h3>Data Anggota</h3>
    <?= $this->session->flashdata('message'); ?>
</div>
<a href="<?= base_url('admin/tambah_anggota'); ?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span>Anggota Baru</a>
<br><br>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover" id="table-datatable">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Kelamin</th>
                <th scope="col">No Telp</th>
                <th scope="col">Alamat</th>
                <th scope="col">Email</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($anggota as $a) {
            ?>
                <tr>
                    <td scope="row"><?= $no++; ?></td>
                    <td><?= $a->nama_anggota; ?></td>
                    <td><?= $a->gender; ?></td>
                    <td><?= $a->no_telp; ?></td>
                    <td><?= $a->alamat; ?></td>
                    <td><?= $a->email; ?></td>

                    <td nowrap="nowrap">
                        <a class="btn btn-primary btn-xs" href="<?= base_url('admin/edit_anggota/') . $a->id_anggota; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a class="btn btn-danger btn-xs" href="<?= base_url('admin/hapus_anggota/') . $a->id_anggota; ?>"><span class="glyphicon glyphicon-remove"></span></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- modal -->
<!-- <div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModal" aria-hidden="true">
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
</div> -->
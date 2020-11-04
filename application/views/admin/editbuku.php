<div class="page-header">
    <h3>Edit Buku</h3>
</div>
<?php foreach ($buku as $b) { ?>
    <form action="<?= base_url('admin/update_buku') ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Kategori</label>
            <select name="id_kategori" class="form-control">
                <option value="<?= $b->id_kategori; ?>"><?= $b->nama_kategori; ?></option>
                <?php foreach ($kategori as $k) { ?>
                    <option value="<?= $k->id_kategori; ?>"><?= $k->nama_kategori; ?></option>
                <?php } ?>
            </select>
            <?= form_error('id_kategori', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>

        <div class="form-group">
            <label>Judul Buku</label>
            <input type="hidden" name="id" value="<?= $b->id_buku; ?>">
            <input type="hidden" name="tgl_input" value="<?= $b->tgl_input; ?>">
            <input type="text" name="judul_buku" class="form-control" value="<?= $b->judul_buku; ?>">
            <?= form_error('judul_buku', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>

        <div class="form-group">
            <label>Pengarang</label>
            <input type="text" name="pengarang" class="form-control" value="<?= $b->pengarang; ?>">
            <?= form_error('pengarang', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>

        <div class="form-group">
            <label>Penerbit</label>
            <input type="text" name="penerbit" class="form-control" value="<?= $b->penerbit; ?>">
            <?= form_error('penerbit', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>

        <div class="form-group">
            <label>Tahun Terbit</label>
            <input type="date" name="thn_terbit" class="form-control" value="<?= $b->thn_terbit; ?>">
            <?= form_error('thn_terbit', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>

        <div class="form-group">
            <label>ISBN</label>
            <input type="text" name="isbn" class="form-control" value="<?= $b->isbn; ?>">
            <?= form_error('isbn', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>

        <div class="form-group">
            <label>Jumlah Buku</label>
            <input type="text" name="jumlah_buku" class="form-control" value="<?= $b->jumlah_buku; ?>">
            <?= form_error('jumlah_buku', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>

        <div class="form-group">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control" value="<?= $b->lokasi; ?>">
            <?= form_error('lokasi', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>

        <div class="form-group">
            <label>Status Buku</label>
            <select name="status" class="form-control">
                <option <?php if ($b->status_buku == "1") {
                            echo "selected='selected'";
                        }
                        echo $b->status_buku; ?> value="1">Tersedia</option>
                <option <?php if ($b->status_buku == "0") {
                            echo "selected='selected'";
                        }
                        echo $b->status_buku; ?> value="0">Sedang dipinjam</option>
            </select>
            <?= form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>

        <div class="form-group">
            <label>Gambar</label>
            <?php
            if (isset($b->gambar)) {
                echo '<input type="hidden" name="old_pict" value="' . $b->gambar . '">';
                echo '<img src="' . base_url('assets/upload/') . $b->gambar . '" width="30%">';
            }
            ?>
            <input name="foto" type="file" class="form-control">
        </div>

        <div class="form-group">
            <input type="submit" value="Update" class="btn btn-default">
            <input type="button" value="Kembali" class="btn btn-primary" onclick="window.history.go(-1)">
        </div>
    </form>
<?php } ?>
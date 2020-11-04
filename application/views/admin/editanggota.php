<div class="page-header">
    <h3>Edit Anggota</h3>
</div>
<?php foreach ($anggota as $a) { ?>
    <form action="<?= base_url('admin/update_anggota') ?>" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label>Nama Anggota</label>
            <input type="hidden" name="id_anggota" value="<?= $a->id_anggota; ?>">
            <input type="text" name="nama_anggota" class="form-control" value="<?= $a->nama_anggota; ?>">
            <?= form_error('nama_anggota', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>

        <div class="form-group">
            <label>Gender</label>
            <select name="gender" id="gender" class="form-control">
                <option value="<?= $a->gender; ?>">Saat ini : <?= $a->gender; ?></option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
            <?= form_error('gender', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>

        <div class="form-group">
            <label>No Telp</label>
            <input type="number" name="no_telp" class="form-control" value="<?= $a->no_telp; ?>">
            <?= form_error('no_telp', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" value="<?= $a->alamat; ?>">
            <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control" value="<?= $a->email; ?>">
            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>

        <div class="form-group">
            <input type="submit" value="Update" class="btn btn-primary">
            <input type="button" value="Kembali" class="btn btn-danger" onclick="window.history.go(-1)">
        </div>
    </form>
<?php } ?>
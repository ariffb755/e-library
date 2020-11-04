<br>
<div class="constraint">
    <div class="page-header">
        <h3>Anggota Baru</h3>
    </div>
    <?= validation_errors('<p style="color:red;">', '</p>'); ?>
    <?php
    if ($this->session->flashdata()) {
        echo "<div class='alert alert-danger alert-message'>";
        echo $this->session->flashdata('alert');
        echo "</div>";
    } ?>
    <form action="<?= base_url('admin/tambah_anggota_act'); ?>" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label>Nama Anggota</label>
            <input type="text" name="nama_anggota" id="nama_anggota" class="form-control">
            <?= form_error('nama_anggota'); ?>
        </div>

        <div class="form-group">
            <label>Gender</label>
            <select name="gender" id="gender" class="form-control">
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
                <?= form_error('gender'); ?>
            </select>
        </div>

        <div class="form-group">
            <label>No Telp</label>
            <input type="text" name="no_telp" id="no_telp" class="form-control">
            <?= form_error('no_telp'); ?>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" id="alamat" class="form-control">
            <?= form_error('alamat'); ?>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" id="email" class="form-control">
            <?= form_error('email'); ?>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" id="password" class="form-control">
            <?= form_error('password'); ?>
        </div>

        <div class="form-group">
            <input type="submit" value="Simpan" class="btn btn-primary">
            <input type="reset" value="Reset" class="btn btn-danger">
        </div>
</div>
</form>
</div>
<br>
<br>
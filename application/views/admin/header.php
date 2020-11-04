<!DOCTYPE html>
<html>

<head>
  <title>Halaman <?= $title; ?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/datatable/datatables.css'); ?>">
  <script type="text/javascript" src="<?= base_url('assets/js/jquery.js'); ?>"></script>
  <script type="text/javascript" src="<?= base_url('assets/js/bootstrap.js'); ?>"></script>
  <script type="text/javascript" src="<?= base_url('assets/datatable/jquery.datatables.js'); ?>"></script>
  <script type="text/javascript" src="<?= base_url('assets/datatable/datatables.js'); ?>"></script>
  <style>
    body {
      background-color: #f4faff;
    }
  </style>
  <script>
    function reloadpage() {
      location.reload()
    }
  </script>
</head>

<body>
  <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="<?= base_url('admin'); ?>">E-Library</a>
      </div>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="nav navbar-nav">
          <li class="nav-item">
            <a href="<?= base_url('admin'); ?>"><span class="glyphicon glyphicon-home"></span>Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/buku'); ?>"><span class="glyphicon glyphicon-folder-open"></span>Data Buku</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/anggota'); ?>"><span class="glyphicon glyphicon-user"></span>Data Anggota</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/peminjaman'); ?>"><span class="glyphicon glyphicon-sort"></span>Transaksi Peminjaman</a>
          </li>
          <li class="dropdown"><a href="<?= base_url('#'); ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" ariaexpanded="false">
              <span class="glyphicon glyphicon-list-alt"></span>Laporan<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li>
                <a href="<?= base_url('admin/cetak_laporan_buku'); ?>">
                  <i class="glyphicon glyphicon-lock"></i>Laporan Data Buku</a>
              </li>
              <li>
                <a href="<?= base_url('admin/cetak_laporan_anggota'); ?>">
                  <i class="glyphicon glyphicon-lock"></i>Laporan Data Anggota</a>
              </li>
              <li>
                <a href="<?= base_url('admin/laporan_transaksi'); ?>">
                  <i class="glyphicon glyphicon-lock"></i>Laporan Data Transaksi</a>
              </li>
            </ul>
          </li>
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="<?= base_url('admin/logout'); ?>">
                <span class="glyphicon glyphicon-log-out"></span>
                Logout
              </a>
            </li>
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" ariaexpanded="false"><?= "Halo, <b>" . $this->session->userdata('nama'); ?></b><span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?= base_url('admin/ganti_password'); ?>"><i class="glyphicon glyphicon-lock"></i>Ganti Password</a></li>
              </ul>
            </li>
          </ul>
      </div>
    </div>
  </nav>
  <div class="container border border-primary">
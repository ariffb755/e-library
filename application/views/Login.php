<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOGIN - Aplikasi E-library</title>
  <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/css/bootstrap.css'; ?>">
  <style>
    body {
      background-color: #00597f;
    }

    h2,
    h3 {
      color: #00597f;
    }
  </style>
</head>

<body>

  <div class="col-md-4 col-md-offset-4 panel panel-default" style="margin-top: 50px;">
    <center>
      <h2>PERPUSTAKAAN UNIVERSITAS BINA SARA INFORMATIKA</h2>

    </center>
    <br>
    <?php
    if (isset($_GET['pesan'])) {
      if ($_GET['pesan'] == "gagal") {
        echo "<div class='alert alert-danger alert-danger'>";
        echo $this->session->flashdata();
        echo "<div>";
      } else if ($_GET['pesan'] == "Belum login") {
        if ($this->session->flashdata()) {
          echo "<div class='alert alert-danger alert-primary'>";
          echo $this->session->flashdata();
          echo "<div>";
        }
      }
    } else {
      if ($this->session->flashdata()) {
        echo "<div class='alert alert-danger alert-message'>";
        echo $this->session->flashdata();
        echo "<div>";
      }
    }

    ?>
    <br>
    <div class="panel panel-default">
      <div class="panel-body">
        <h3 style="text-align: center;text-decoration: underline;">LOGIN</h3>
        <br><br>
        <form action="<?= base_url() . 'welcome/login'; ?>" method="POST" style="text-align: center;">
          <div class="form-group">
            <label>
              <input type="text" name="admin_username" placeholder="username" class="form-control">
              <?= form_error('username'); ?>
            </label>
          </div>
          <div class="form-group">
            <label>
              <input type="password" name="admin_password" placeholder="password" class="form-control">
              <?= form_error('password'); ?>
            </label>
          </div>
          <div class="form-group">
            <label>
              <input type="submit" value="login" class="btn btn-primary">
            </label>
          </div>
        </form>
        <br><br>

      </div>
    </div>

  </div>
<?php
defined('BASEPATH') or exit('No direct Script access allowed');

class Admin extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    //cek login
    if ($this->session->userdata('status') != "login") {
      $this->session->set_flashdata('pesan', 'Anda belum login!');
      redirect('welcome?pesan=belumlogin');
    }
  }

  function index()
  {
    $data['title'] = 'Utama';
    $data['transaksi'] = $this->db->query("SELECT * FROM transaksi ORDER BY id_pinjam DESC LIMIT 10")->result();
    $data['anggota']   = $this->db->query("SELECT * FROM anggota ORDER BY id_anggota DESC LIMIT 10")->result();
    $data['buku']      = $this->db->query("SELECT * FROM buku ORDER BY id_buku DESC LIMIT 10")->result();

    $this->load->view('admin/header', $data);
    $this->load->view('admin/index', $data);
    $this->load->view('admin/footer');
  }

  function logout()
  {
    $this->load->view('admin/header');
    $this->load->view('admin/footer');
    $this->session->sess_destroy();
    $this->session->set_flashdata('pesan', 'Anda berhasil logout!');
    redirect('welcome?pesan=logout');
  }

  function ganti_password()
  {
    $this->load->view('admin/header');
    $this->load->view('admin/ganti_password');
    $this->load->view('admin/footer');
  }

  function ganti_password_act()
  {
    $pass_baru = $this->input->post('pass_baru');
    $ulang_pass = $this->input->post('ulang_pass');

    $this->form_validation->set_rules('pass_baru', 'Password Baru', 'required|trim|matches[ulang_pass]');
    $this->form_validation->set_rules('ulang_pass', 'Ulangi Password Baru', 'required|trim');
    if ($this->form_validation->run() != false) {
      $data = array('password' => md5($pass_baru));
      $w = array('id_admin' => $this->session->userdata('id'));
      $this->M_perpus->update_data($w, $data, 'admin');
      redirect('admin/ganti_password?pesan=berhasil');
    } else {
      $this->load->view('admin/header');
      $this->load->view('admin/ganti_password');
      $this->load->view('admin/footer');
    }
  }
  function buku()
  {
    $data['title'] = 'Data Buku';
    $data['buku']  = $this->M_perpus->get_data('buku')->result();
    $this->load->view('admin/header', $data);
    $this->load->view('admin/buku', $data);
    $this->load->view('admin/footer');
  }

  function tambah_buku()
  {
    $data['title']    = 'Tambah Data Buku';
    $data['kategori'] = $this->M_perpus->get_data('kategori')->result();
    $this->load->view('admin/header', $data);
    $this->load->view('admin/tambahbuku', $data);
    $this->load->view('admin/footer');
  }

  function tambah_buku_act()
  {
    $data['title'] = 'Proses..';
    $id_kategori  = $this->input->post('id_kategori', true);
    $judul        = $this->input->post('judul_buku', true);
    $pengarang    = $this->input->post('pengarang', true);
    $thn_terbit   = $this->input->post('thn_terbit', true);
    $penerbit     = $this->input->post('penerbit', true);
    $isbn         = $this->input->post('isbn', true);
    $jumlah_buku  = $this->input->post('jumlah_buku', true);
    $lokasi       = $this->input->post('lokasi', true);
    $tgl_input    = date('Y-m-d');
    $status_buku  = $this->input->post('status_buku', true);

    $this->form_validation->set_rules('id_kategori', 'Kategori', 'required');
    $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required');
    $this->form_validation->set_rules('status', 'Status Buku', 'required');

    if ($this->form_validation->run() != false) {
      $this->load->view('admin/header', $data);
      $this->load->view('admin/tambahbuku');
      $this->load->view('admin/footer');
    } else {
      //configurasi upload Gambar
      $config['upload_path'] = './assets/upload/';
      $config['allowed_types'] = 'jpg|png|jpeg';
      $config['max_size'] = '2048';
      $config['file_name'] = 'cover' . time();

      $this->load->library('upload', $config);

      if ($this->upload->do_upload('foto')) {
        $image = $this->upload->data();

        $data = array(
          'id_kategori' => $id_kategori,
          'judul_buku'  => $judul,
          'pengarang'   => $pengarang,
          'thn_terbit'  => $thn_terbit,
          'penerbit'    => $penerbit,
          'isbn'        => $isbn,
          'jumlah_buku' => $jumlah_buku,
          'lokasi'      => $lokasi,
          'gambar'      => $image['file_name'],
          'tgl_input'   => $tgl_input,
          'status_buku' => $status_buku
        );

        $this->M_perpus->insert_data('buku', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Buku ' . $judul . ' berhasil ditambahkan!</div>');
        redirect('admin/buku');
      }
    }
  }

  function hapus_buku($id)
  {
    $where = array('id_buku' => $id);
    $this->M_perpus->delete_data($where, 'buku');
    // menghapus file cover di assets, males sy pak
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Buku berhasil dihapus!</div>');
    redirect('admin/buku');
  }

  function edit_buku($id)
  {
    $data['title'] = 'Edit Buku';
    $where = array('id_buku' => $id);
    $data['buku'] = $this->db->query("SELECT * FROM buku B, kategori K where B.id_kategori=K.id_kategori and B.id_buku='$id'")->result();
    $data['kategori'] = $this->M_perpus->get_data('kategori')->result();

    $this->load->view('admin/header', $data);
    $this->load->view('admin/editbuku', $data);
    $this->load->view('admin/footer');
  }

  function update_buku()
  {
    $data['title'] = 'Proses..';
    $id            = $this->input->post('id');
    $id_kategori   = $this->input->post('id_kategori');
    $judul         = $this->input->post('judul_buku');
    $pengarang     = $this->input->post('pengarang');
    $penerbit      = $this->input->post('penerbit');
    $thn_terbit    = $this->input->post('thn_terbit');
    $isbn          = $this->input->post('isbn');
    $jumlah_buku   = $this->input->post('jumlah_buku');
    $lokasi        = $this->input->post('lokasi');
    $status        = $this->input->post('status');
    $imageOld      = $this->input->post('old_pict');

    $this->form_validation->set_rules('id_kategori', 'ID Kategori', 'required');
    $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required|min_length[2]');
    $this->form_validation->set_rules('pengarang', 'Pengarang', 'required|min_length[2]');
    $this->form_validation->set_rules('penerbit', 'Penerbit', 'required|min_length[2]');
    $this->form_validation->set_rules('thn_terbit', 'Tahun Terbit', 'required|min_length[2]');
    $this->form_validation->set_rules('isbn', 'Nomor ISBN', 'required|numeric');
    $this->form_validation->set_rules('jumlah_buku', 'Jumlah Buku', 'required|numeric');
    $this->form_validation->set_rules('lokasi', 'Lokasi', 'required|min_length[2]');
    $this->form_validation->set_rules('status', 'Status Buku', 'required');

    if ($this->form_validation->run() != false) {
      $config['upload_path'] = './assets/upload/';
      $config['allowed_types'] = 'jpg|png|jpeg';
      $config['max_size'] = '2048';
      $config['file_name'] = 'gambar' . time();

      $this->load->library('upload', $config);

      if ($this->upload->do_upload('foto')) {
        $image = $this->upload->data();
        unlink('assets/upload/' . $this->input->post('old_pict', TRUE));
        $data['gambar'] = $image['file_name'];

        $where = array('id_buku' => $id);
        $data = array(
          'id_kategori'   => $id_kategori,
          'judul_buku'    => $judul,
          'pengarang'     => $pengarang,
          'penerbit'      => $penerbit,
          'thn_terbit'    => $thn_terbit,
          'isbn'          => $isbn,
          'jumlah_buku'   => $jumlah_buku,
          'lokasi'        => $lokasi,
          'gambar'        => $image['file_name'],
          'status_buku'   => $status
        );

        $this->M_perpus->update_data('buku', $data, $where);
      } else {

        $where = array('id_buku' => $id);
        $data = array(
          'id_kategori'   => $id_kategori,
          'judul_buku'    => $judul,
          'pengarang'     => $pengarang,
          'penerbit'      => $penerbit,
          'thn_terbit'    => $thn_terbit,
          'isbn'          => $isbn,
          'jumlah_buku'   => $jumlah_buku,
          'lokasi'        => $lokasi,
          'gambar'        => $imageOld,
          'status_buku'   => $status
        );

        $this->M_perpus->update_data('buku', $data, $where);
      }

      $this->M_perpus->update_data('buku', $data, $where);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Buku ' . $judul . ' berhasil diperbaharui!</div>');
      redirect('admin/buku');
    } else {
      $where = array('id_buku' => $id);
      $data['buku'] = $this->db->query("select * from buku b, kategori k where b.id_kategori=k.id_kategori and b.id_buku='$id'")->result();
      $data['kategori'] = $this->M_perpus->get_data('kategori')->result();
      $this->load->view('admin/header', $data);
      $this->load->view('admin/editbuku', $data);
      $this->load->view('admin/footer');
    }
  }

  public function detail_buku($id)
  {
    $where = array('id_buku' => $id);
    $data['buku'] = $this->db->query("SELECT * from buku b, kategori k where b.id_kategori=k.id_kategori and b.id_buku='$id'")->result();
    $data['kategori'] = $this->M_perpus->get_data('kategori')->result();

    $this->load->view('admin/detailbuku', $data);
  }

  function anggota()
  {
    $data['title'] = 'Data Anggota';
    $data['anggota']  = $this->M_perpus->get_data('anggota')->result();
    $this->load->view('admin/header', $data);
    $this->load->view('admin/anggota', $data);
    $this->load->view('admin/footer');
  }

  function tambah_anggota()
  {
    $data['title']    = 'Tambah Data Anggota';
    $data['kategori'] = $this->M_perpus->get_data('anggota')->result();
    $this->load->view('admin/header', $data);
    $this->load->view('admin/tambahanggota', $data);
    $this->load->view('admin/footer');
  }

  function tambah_anggota_act()
  {
    $data['title']  = 'Proses..';
    $nama_anggota   = $this->input->post('nama_anggota', true);
    $gender         = $this->input->post('gender', true);
    $no_telp        = $this->input->post('no_telp', true);
    $alamat         = $this->input->post('alamat', true);
    $email          = $this->input->post('email', true);
    $password       = $this->input->post('password', true);
    var_dump($nama_anggota);

    $this->form_validation->set_rules('nama_anggota', 'Nama Anggota', 'required|min_length[3]|trim');
    $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
    $this->form_validation->set_rules('no_telp', 'No Telp', 'required|trim');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
    $this->form_validation->set_rules('password', 'Password', 'required|trim');

    if ($this->form_validation->run() == false) {
      $this->load->view('admin/header', $data);
      $this->load->view('admin/tambahanggota');
      $this->load->view('admin/footer');
    } else {
      $data = array(
        'nama_anggota'  => htmlspecialchars($nama_anggota),
        'gender'        => $gender,
        'no_telp'       => $no_telp,
        'alamat'        => $alamat,
        'email'         => $email,
        'password'      => password_hash($password, PASSWORD_DEFAULT)
      );

      $this->M_perpus->insert_data('anggota', $data);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anggota baru berhasil ditambahkan!</div>');
      redirect('admin/anggota');
    }
  }

  function hapus_anggota($id)
  {
    $where = array('id_anggota' => $id);
    $this->M_perpus->delete_data($where, 'anggota');
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anggota berhasil dihapus!</div>');
    redirect('admin/anggota');
  }

  function edit_anggota($id)
  {
    $data['title'] = 'Edit Anggota';
    $where = array('id_anggota' => $id);
    $data['anggota'] = $this->db->query("SELECT * FROM anggota where id_anggota='$id'")->result();
    // $data['anggota'] = $this->M_perpus->get_data('anggota')->result();

    $this->load->view('admin/header', $data);
    $this->load->view('admin/editanggota', $data);
    $this->load->view('admin/footer');
  }

  function update_anggota()
  {
    $data['title'] = 'Proses..';
    $id            = $this->input->post('id');
    $id_kategori   = $this->input->post('id_kategori');
    $judul         = $this->input->post('judul_buku');
    $pengarang     = $this->input->post('pengarang');
    $penerbit      = $this->input->post('penerbit');
    $thn_terbit    = $this->input->post('thn_terbit');
    $isbn          = $this->input->post('isbn');
    $jumlah_buku   = $this->input->post('jumlah_buku');
    $lokasi        = $this->input->post('lokasi');
    $status        = $this->input->post('status');
    $imageOld      = $this->input->post('old_pict');

    $this->form_validation->set_rules('id_kategori', 'ID Kategori', 'required');
    $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required|min_length[2]');
    $this->form_validation->set_rules('pengarang', 'Pengarang', 'required|min_length[2]');
    $this->form_validation->set_rules('penerbit', 'Penerbit', 'required|min_length[2]');
    $this->form_validation->set_rules('thn_terbit', 'Tahun Terbit', 'required|min_length[2]');
    $this->form_validation->set_rules('isbn', 'Nomor ISBN', 'required|numeric');
    $this->form_validation->set_rules('jumlah_buku', 'Jumlah Buku', 'required|numeric');
    $this->form_validation->set_rules('lokasi', 'Lokasi', 'required|min_length[2]');
    $this->form_validation->set_rules('status', 'Status Buku', 'required');

    if ($this->form_validation->run() != false) {
      $config['upload_path'] = './assets/upload/';
      $config['allowed_types'] = 'jpg|png|jpeg';
      $config['max_size'] = '2048';
      $config['file_name'] = 'gambar' . time();

      $this->load->library('upload', $config);

      if ($this->upload->do_upload('foto')) {
        $image = $this->upload->data();
        unlink('assets/upload/' . $this->input->post('old_pict', TRUE));
        $data['gambar'] = $image['file_name'];

        $where = array('id_buku' => $id);
        $data = array(
          'id_kategori'   => $id_kategori,
          'judul_buku'    => $judul,
          'pengarang'     => $pengarang,
          'penerbit'      => $penerbit,
          'thn_terbit'    => $thn_terbit,
          'isbn'          => $isbn,
          'jumlah_buku'   => $jumlah_buku,
          'lokasi'        => $lokasi,
          'gambar'        => $image['file_name'],
          'status_buku'   => $status
        );

        $this->M_perpus->update_data('buku', $data, $where);
      } else {

        $where = array('id_buku' => $id);
        $data = array(
          'id_kategori'   => $id_kategori,
          'judul_buku'    => $judul,
          'pengarang'     => $pengarang,
          'penerbit'      => $penerbit,
          'thn_terbit'    => $thn_terbit,
          'isbn'          => $isbn,
          'jumlah_buku'   => $jumlah_buku,
          'lokasi'        => $lokasi,
          'gambar'        => $imageOld,
          'status_buku'   => $status
        );

        $this->M_perpus->update_data('buku', $data, $where);
      }

      $this->M_perpus->update_data('buku', $data, $where);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Buku ' . $judul . ' berhasil diperbaharui!</div>');
      redirect('admin/buku');
    } else {
      $where = array('id_buku' => $id);
      $data['buku'] = $this->db->query("select * from buku b, kategori k where b.id_kategori=k.id_kategori and b.id_buku='$id'")->result();
      $data['kategori'] = $this->M_perpus->get_data('kategori')->result();
      $this->load->view('admin/header', $data);
      $this->load->view('admin/editbuku', $data);
      $this->load->view('admin/footer');
    }
  }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
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
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Teknisi extends CI_Controller
{


    public function index()
    {
        /*if ($this->session->userdata('status') == 'login' && $this->session->userdata('role') == 1) {
            $data['avatar'] = $this->M_pimpinan->get_data_gambar(' tb_upload_gambar_user', $this->session->userdata('name'));
            $data['title'] = 'Home';
            $this->load->view('pimpinan/index', $data);
        } else {
            $this->load->view('login/login');
        }*/
        if ($this->session->userdata('status') == 'login' && $this->session->userdata('role') == 2) {


            echo "<h1>Halaman Teknisi Coming Soon</h1>";
        } else {
            $this->load->view('login/login');
        }
    }
}

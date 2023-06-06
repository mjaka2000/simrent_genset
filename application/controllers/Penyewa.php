<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyewa extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_penyewa');
        if ($this->session->userdata('status') != 'login') {
            redirect(site_url("login"));
        }
    }

    public function index()
    {
        $data['avatar'] = $this->M_penyewa->get_avatar('tb_avatar', $this->session->userdata('name'));
        $data['title'] = 'Home';
        $this->load->view('penyewa/index', $data);
    }

    public function logout()
    {
        session_destroy();
        redirect('login');
    }
}

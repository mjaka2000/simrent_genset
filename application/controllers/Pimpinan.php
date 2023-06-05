<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pimpinan extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_pimpinan');
        if ($this->session->userdata('status') != 'login') {
            redirect(site_url("login"));
        }
    }

    public function index()
    {
        $data['avatar'] = $this->M_pimpinan->get_avatar('tb_avatar', $this->session->userdata('name'));
        $data['title'] = 'Home';
        $this->load->view('pimpinan/index', $data);
    }

    public function logout()
    {
        session_destroy();
        redirect('login');
    }

    public function token_generate()
    {
        return $tokens = md5(uniqid(rand(), true));
    }

    private function hash_password($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    ####################################
    //* Profile
    ####################################

    public function profile()
    {
        $data['avatar'] = $this->M_pimpinan->get_avatar('tb_avatar', $this->session->userdata('name'));
        $data['title'] = 'Profile';
        $this->load->view('pimpinan/profile/profile', $data);
    }

    ####################################
    //* End Profile
    ####################################
    ####################################
    //* Data Genset
    ####################################



    ####################################
    //* End Data Genset 
    ####################################
    ####################################
    //* Data Perbaikan Genset 
    ####################################



    ####################################
    //* End Data Perbaikan Genset 
    ####################################
    ####################################
    //* Data Mobil 
    ####################################



    ####################################
    //* End Data Mobil 
    ####################################
    ####################################
    //* Data Operator 
    ####################################



    ####################################
    //* End Data Operator 
    ####################################
    ####################################
    //* Data Pelanggan 
    ####################################



    ####################################
    //* End Data Pelanggan 
    ####################################
    ####################################
    //* Data Barang Keluar 
    ####################################



    ####################################
    //* End Data Barang Keluar
    ####################################
    ####################################
    //* Data Barang Masuk
    ####################################



    ####################################
    //* End Data Barang Masuk
    ####################################
    ####################################
    //* Laporan
    ####################################



    ####################################
    //* End Laporan
    ####################################
    ####################################
    //* Pengajuan Baru
    ####################################



    ####################################
    //* End Pengajuan Baru
    ####################################
}

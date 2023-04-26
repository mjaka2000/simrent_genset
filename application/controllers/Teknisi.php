<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Teknisi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_teknisi');
        if ($this->session->userdata('status') != 'login' && $this->session->userdata('role') != 2) {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        if ($this->session->userdata('status') == 'login' && $this->session->userdata('role') == 2) {
            $data['avatar'] = $this->M_teknisi->get_avatar(' tb_avatar', $this->session->userdata('name'));
            $data['title'] = 'Home';
            $this->load->view('teknisi/index', $data);
        } else {
            $this->load->view('login/login');
        }
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
}

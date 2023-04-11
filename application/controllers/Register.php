<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_login');
    }
    public function index()
    {
        $data['title'] = 'Register';
        $this->load->view('login/register', $data);
    }

    private function hash_password($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function proses_register()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == true) {
            $nama = $this->input->post('nama', true);
            $username = $this->input->post('username', true);
            $password = $this->input->post('password', true);

            if ($this->M_login->cek_username('tb_user', $username)) {
                $this->session->set_flashdata('msg', 'Username Telah Digunakan!');
                redirect(base_url('login/register'));
            } else {
                $data = array(
                    'nama' => $nama,
                    'username' => $username,
                    'password' => $this->hash_password($password)
                );

                $dataUpload = array(
                    'id' => '',
                    'username_user' => $username,
                    'nama_file' => 'nopic.png'
                );

                $this->M_login->insert('tb_user', $data);
                $this->M_login->insert('tb_upload_gambar_user', $dataUpload);

                $this->session->set_flashdata('msg_daftar', 'Anda Berhasil Register');
                redirect(base_url('login/register'));
            }
        } else {
            $header['title'] = 'Register';
            $this->load->view('login/register', $header);
        }
    }
}

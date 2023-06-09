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
        $data['token_generate'] = $this->token_generate();
        $this->session->set_userdata($data);
        $data['title'] = 'Register';
        $this->load->view('login/register', $data);
    }

    public function token_generate()
    {
        return $tokens = md5(uniqid(rand(), true));
    }

    private function hash_password($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function proses_register()
    {
        $this->db->trans_start();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == true) {
            $nama = $this->input->post('nama', true);
            $username = $this->input->post('username', true);
            $password = $this->input->post('password', true);
            $role = 3;
            $tglupdate_plg = date("Y-m-d");

            if ($this->M_login->cek_username('tb_user', $username)) {
                $this->session->set_flashdata('msg', 'Username Telah Digunakan!');
                redirect(site_url('register'));
            } else {
                $data = array(
                    'id_user' => '',
                    'nama' => $nama,
                    'username' => $username,
                    'password' => $this->hash_password($password),
                    'role' => $role,
                    'nama_file' => 'nopic.png'
                );
                $this->M_login->insert('tb_user', $data);

                $last_id = $this->db->insert_id();

                $dataPlg = array(
                    'nama_plg' => $nama,
                    'tglupdate_plg' => $tglupdate_plg,
                    'id_user' => $last_id
                );

                $this->M_login->insert('tb_pelanggan', $dataPlg);

                $this->db->trans_complete();
                $this->session->set_flashdata('msg_daftar', 'Anda Berhasil Register');
                redirect(site_url('register'));
            }
        } else {
            $header['title'] = 'Register';
            $this->load->view('login/register', $header);
        }
    }
}

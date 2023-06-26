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
        // $data['edit_data'] = $this->M_penyewa->get_data('tb_pelanggan');
        $data['avatar'] = $this->M_penyewa->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Home';
        $this->load->view('penyewa/index', $data);
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
        $data['avatar'] = $this->M_penyewa->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Profile';
        $this->load->view('penyewa/profile/profile', $data);
    }

    public function proses_newpassword()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('new_password', 'Password Baru', 'required');
        $this->form_validation->set_rules('confirm_new_password', 'Konfirmasi Password Baru', 'required|matches[new_password]');

        if ($this->form_validation->run() == true) {

            $username = $this->input->post('username');
            $nama = $this->input->post('nama');
            $new_password = $this->input->post('new_password');

            $data = array(
                'nama' => $nama,
                'password' => $this->hash_password($new_password)
            );
            $where = array(
                'id_user' => $this->session->userdata('id_user')
            );
            $this->M_penyewa->update_password('tb_user', $where, $data);
            $this->session->set_flashdata('msg_sukses', 'Password Berhasil Diganti, Silahkan Logout dan Login Kembali');
            redirect(site_url('penyewa/profile'));
        } else {
            $data['avatar'] = $this->M_penyewa->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Profile';
            $this->load->view('penyewa/profile/profile', $data);
        }
    }

    public function proses_gambarupload()
    {
        $config = array(
            'upload_path' => "./assets/upload/user/",
            'allowed_types' => "jpg|png|jpeg",
            'ecrypt_name'    => false,
            'overwrite'    => true,
            // 'file_name'	=> uniqid(),
            'max_size' => "1024",
            'max_height' => "1024",
            'max_width' => "1024"
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('userpicture')) {
            $this->session->set_flashdata('msg_gambar_error', $this->upload->display_errors());
            $data['avatar'] = $this->M_penyewa->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Profile';
            $this->load->view('penyewa/profile/profile', $data);
        } else {
            $data_upload = array('upload_data' => $this->upload->data());
            $nama_file = $data_upload['upload_data']['file_name'];

            $where = array(
                'username' => $this->session->userdata('name')
            );
            $data = array(
                'nama_file' => $nama_file
            );

            $this->M_penyewa->update_avatar($where, $data);
            $this->session->set_flashdata('msg_gambar_sukses', 'Gambar Berhasil Di Upload');
            redirect(site_url('penyewa/profile'));
        }
    }

    ####################################
    //* End Profile
    ####################################
    ####################################
    //* Data Genset
    ####################################

    public function tabel_genset()
    {
        $data['list_data'] = $this->M_penyewa->select('tb_genset');
        $data['avatar'] = $this->M_penyewa->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Genset';
        $this->load->view('penyewa/tabel/tabel_genset', $data);
    }

    ####################################
    //* End Data Genset 
    ####################################
    ####################################
    //* Data Pelanggan 
    ####################################

    public function tabel_pelanggan()
    {
        $data['list_pelanggan'] = $this->M_penyewa->get_data_plg('tb_pelanggan');
        $data['avatar'] = $this->M_penyewa->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Pelanggan';
        $this->load->view('penyewa/tabel/tabel_pelanggan', $data);
    }

    public function update_data_pelanggan()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_pelanggan' => $uri);
        $data['list_data'] = $this->M_penyewa->get_data('tb_pelanggan', $where);
        $data['avatar'] = $this->M_penyewa->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Ubah Data Pelanggan';
        $this->load->view('penyewa/form/update_pelanggan', $data);
    }

    public function proses_update_pelanggan()
    {
        $this->form_validation->set_rules('nama_plg', 'Nama', 'trim|required');
        $this->form_validation->set_rules('alamat_plg', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('nohp_plg', 'No Hp', 'trim|required');
        $this->form_validation->set_rules('jk_plg', 'Jenis Kelamin', 'trim|required');
        $this->form_validation->set_rules('namaperusahaan_plg', 'Nama Perusahaan', 'trim|required');
        $this->form_validation->set_rules('tglupdate_plg', 'Tanggal Update', 'trim|required');

        if ($this->form_validation->run() === TRUE) {
            // $id_user = $this->input->post('id_user', TRUE);
            $id = $this->input->post('id_pelanggan', TRUE);
            $nama = $this->input->post('nama_plg', TRUE);
            $alamat = $this->input->post('alamat_plg', TRUE);
            $no_hp = $this->input->post('nohp_plg', TRUE);
            $jenis_kelamin = $this->input->post('jk_plg', TRUE);
            $nama_perusahaan = $this->input->post('namaperusahaan_plg', TRUE);
            $tgl_update = $this->input->post('tglupdate_plg', TRUE);

            $where = array('id_pelanggan' => $id);
            $data = array(
                'nama_plg' => $nama,
                'alamat_plg' => $alamat,
                'nohp_plg' => $no_hp,
                'jk_plg' => $jenis_kelamin,
                'namaperusahaan_plg' => $nama_perusahaan,
                'tglupdate_plg' => $tgl_update,
                // 'id_user' => $id_user
            );
            $this->M_penyewa->update('tb_pelanggan', $data, $where);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Diubah');
            redirect(site_url('penyewa/tabel_pelanggan'));
        } else {
            $data['avatar'] = $this->M_penyewa->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Ubah Data Pelanggan';
            $this->load->view('penyewa/form/update_pelanggan');
        }
    }

    ####################################
    //* Data Unit Keluar 
    ####################################

    public function tabel_unit_keluar()
    {
        $data['list_data'] = $this->M_penyewa->sel_data_u_keluar('tb_unit_keluar');
        $data['avatar'] = $this->M_penyewa->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Unit Sewa';
        $this->load->view('penyewa/tabel/tabel_unit_keluar', $data);
    }

    public function detail_unit_keluar($id_transaksi)
    {
        $uri = $this->uri->segment(3);
        $where = array('id_u_keluar' => $uri);
        $data['list_data'] = $this->M_penyewa->get_data_u_keluar('tb_unit_keluar', $where);
        $data['avatar'] = $this->M_penyewa->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Detail Data Unit Sewa';
        $this->load->view('penyewa/tabel/detail_keluar', $data);
    }

    public function tambah_unit_keluar()
    {
        $kode_id = $this->M_penyewa->get_auto_id('tb_unit_keluar');
        foreach ($kode_id as $kd) {
            if ($kd) {
                $nilai     = substr($kd->id_transaksi, 6);
                $kode     = (int) $nilai;
                //tambahkan sebanyak + 1
                $kode     = $kode + 1;
                $auto_kode = "GE-" . date('M') . str_pad($kode, 4, "0",  STR_PAD_LEFT);
            }
        }
        $data['kode_auto'] = $auto_kode;

        $data['list_mobil'] = $this->M_penyewa->select('tb_mobil');
        $data['list_genset'] = $this->M_penyewa->select('tb_genset');
        $data['list_pelanggan'] = $this->M_penyewa->get_data_plg('tb_pelanggan');
        $data['list_operator'] = $this->M_penyewa->select('tb_operator');
        $data['avatar'] = $this->M_penyewa->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Tambah Unit Sewa';
        $this->load->view('penyewa/form/tambah_unit_keluar', $data);
    }

    public function proses_tambah_unit_keluar()
    {
        $this->form_validation->set_rules('id_transaksi', 'ID Data', 'required');
        $this->form_validation->set_rules('tanggal_keluar', 'Tanggal Keluar', 'required');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
        // $this->form_validation->set_rules('id_operator', 'Nama Operator', 'required');
        $this->form_validation->set_rules('id_pelanggan', 'Nama Pelanggan', 'required');
        $this->form_validation->set_rules('id_genset', 'Kode Genset', 'required');

        if ($this->form_validation->run() == TRUE) {
            // $stok_gd           = $this->input->post('stok_gd', TRUE);
            // $stok_pj           = $this->input->post('stok_pj', TRUE);

            $id_transaksi     = $this->input->post('id_transaksi', TRUE);
            $tanggal_keluar          = $this->input->post('tanggal_keluar', TRUE);
            $lokasi           = $this->input->post('lokasi', TRUE);
            $id_operator    = $this->input->post('id_operator', TRUE);
            $id_pelanggan   = $this->input->post('id_pelanggan', TRUE);
            $id_genset      = $this->input->post('id_genset', TRUE);
            $id_mobil            = $this->input->post('id_mobil', TRUE);
            $tambahan         = $this->input->post('tambahan', TRUE);
            $jumlah_hari      = $this->input->post('jumlah_hari', TRUE);
            $total            = $this->input->post('total', TRUE);
            $status           = 1;

            $tanggal_masuk    = date('Y-m-d', strtotime($tanggal_keluar . "+" . $jumlah_hari . " days"));

            $data = array(
                'id_transaksi'     => $id_transaksi,
                'tanggal_keluar'          => $tanggal_keluar,
                'lokasi'           => $lokasi,
                'tanggal_masuk'    => $tanggal_masuk,
                'id_operator'    => $id_operator,
                'id_pelanggan'   => $id_pelanggan,
                'id_genset'      => $id_genset,
                'id_mobil'            => $id_mobil,
                'tambahan'         => $tambahan,
                'jumlah_hari'      => $jumlah_hari,
                'total'            => $total,
                'status'           => $status
            );
            $status_gst = 1;
            $status_op = 1;
            $status_plg = 1;
            // $stok_gd_new = ++$stok_gd;
            // $stok_pj_new = --$stok_pj;

            // $this->M_penyewa->mengurangi('tb_genset', $id_genset, $stok_gd_new);
            // $this->M_penyewa->menambah('tb_genset', $id_genset, $stok_pj_new);
            $this->M_penyewa->update_status_gst('tb_genset', $id_genset, $status_gst);
            $this->M_penyewa->update_status_op('tb_operator', $id_operator, $status_op);
            $this->M_penyewa->update_status_plg('tb_pelanggan', $id_pelanggan, $status_plg);
            $this->M_penyewa->insert('tb_unit_keluar', $data);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Disimpan');

            redirect(site_url('penyewa/tabel_unit_keluar'));
        } else {
            $data['list_mobil'] = $this->M_penyewa->select('tb_mobil');
            $data['list_genset'] = $this->M_penyewa->select('tb_genset');
            $data['list_pelanggan'] = $this->M_penyewa->get_data_plg('tb_pelanggan');
            $data['list_operator'] = $this->M_penyewa->select('tb_operator');
            $data['avatar'] = $this->M_penyewa->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Tambah Unit Sewa';
            $this->load->view('penyewa/form/tambah_unit_keluar', $data);
        }
    }
    ####################################
    //* End Data Unit Keluar 
    ####################################
    ####################################
    //* Laporan
    ####################################

    public function laporan()
    {
        $data['avatar'] = $this->M_penyewa->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Laporan';
        $this->load->view('penyewa/report/laporan', $data);
    }

    ####################################
    //* End Laporan
    ####################################

}

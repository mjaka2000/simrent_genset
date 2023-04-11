<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pimpinan extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_pimpinan');
        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }
    public function index()
    {
        /*if ($this->session->userdata('status') == 'login' && $this->session->userdata('role') == 1) {
            $data['avatar'] = $this->M_pimpinan->get_data_gambar(' tb_upload_gambar_user', $this->session->userdata('name'));
            $data['title'] = 'Home';
            $this->load->view('pimpinan/index', $data);
        } else {
            $this->load->view('login/login');
        }*/
        if ($this->session->userdata('status') == 'login' && $this->session->userdata('role') == 1) {


            echo "<h1>Halaman Pimpinan Coming Soon</h1>";
        } else {
            $this->load->view('login/login');
        }
    }

    public function signout()
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
    // Profile
    ####################################

    public function profile()
    {
        $data['avatar'] = $this->M_pimpinan->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
        $data['title'] = 'Profile';
        $this->load->view('pimpinan/profile/profile', $data);
        // $this->load->view('pimpinan/profile', $data);
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
                'id' => $this->session->userdata('id')
            );
            $this->M_pimpinan->update_password('tb_user', $where, $data);
            $this->session->set_flashdata('msg_sukses', 'Password Berhasil Diganti, Silahkan Sign Out dan Login Kembali');
            redirect(base_url('pimpinan/profile'));
        } else {
            $data['avatar'] = $this->M_pimpinan->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
            $data['title'] = 'Profile';
            $this->load->view('pimpinan/profile/profile', $data);
        }
    }

    public function proses_gambarupload()
    {
        $config = array(
            'upload_path' => "./assets/upload/user/img/",
            'allowed_types' => "jpg|png|jpeg",
            'ecrypt_name'    => false,
            'file_name'    => uniqid(),
            'max_size' => "5000",
            'max_height' => "1024",
            'max_width' => "1024"
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('userpicture')) {
            $this->session->set_flashdata('msg_gambar_error', $this->upload->display_errors());
            $data['avatar'] = $this->M_pimpinan->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
            $data['title'] = 'Profile';
            $this->load->view('pimpinan/profile/profile', $data);
        } else {
            $data_upload = array('upload_data' => $this->upload->data());
            $nama_file = $data_upload['upload_data']['file_name'];

            $where = array(
                'username_user' => $this->session->userdata('name')
            );
            $data = array(
                'nama_file' => $nama_file
            );

            $this->M_pimpinan->update_gambar($where, $data);
            $this->session->set_flashdata('msg_gambar_sukses', 'Gambar Berhasil Di Upload');
            redirect(base_url('pimpinan/profile'));
        }
    }

    ####################################
    // Data Genset
    ####################################

    public function tabel_genset()
    {
        $data['list_data'] = $this->M_pimpinan->select('tb_genset');
        $data['avatar'] = $this->M_pimpinan->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
        $data['title'] = 'Data Genset';
        $this->load->view('pimpinan/tabel/tabel_genset', $data);
    }

    ####################################
    // End Data Genset 
    ####################################

    ####################################
    // Data Perbaikan Genset 
    ####################################

    public function tabel_service_genset()
    {
        $data['list_data'] = $this->M_pimpinan->select('tb_serv_genset');
        $data['avatar'] = $this->M_pimpinan->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
        $data['title'] = 'Data Perbaikan Genset';
        $this->load->view('pimpinan/tabel/tabel_service_genset', $data);
    }

    ####################################
    // End Data Perbaikan Genset 
    ####################################

    ####################################
    // Data Mobil 
    ####################################

    public function tabel_mobil()
    {
        $data['list_data'] = $this->M_pimpinan->select('tb_mobil');
        $data['avatar'] = $this->M_pimpinan->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
        $data['title'] = 'Data Mobil';
        $this->load->view('pimpinan/tabel/tabel_mobil', $data);
    }

    ####################################
    // End Data Mobil 
    ####################################

    ####################################
    // Data Operator 
    ####################################

    public function tabel_operator()
    {
        $data['list_operator'] = $this->M_pimpinan->select('tb_operator');
        $data['avatar'] = $this->M_pimpinan->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
        $data['title'] = 'Data Operator';
        $this->load->view('pimpinan/tabel/tabel_operator', $data);
    }

    ####################################
    // End Data Operator 
    ####################################

    ####################################
    // Data Pelanggan 
    ####################################

    public function tabel_pelanggan()
    {
        $data['list_pelanggan'] = $this->M_pimpinan->select('tb_pelanggan');
        $data['avatar'] = $this->M_pimpinan->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
        $data['title'] = 'Data Pelanggan';
        $this->load->view('pimpinan/tabel/tabel_pelanggan', $data);
    }

    public function tambah_data_pelanggan()
    {
        $data['avatar'] = $this->M_pimpinan->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
        $data['title'] = 'Tambah Data Pelanggan';
        $this->load->view('pimpinan/form/tambah_pelanggan', $data);
    }

    public function proses_tambah_pelanggan()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('no_hp', 'No Hp', 'trim|required');
        $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'trim|required');

        if ($this->form_validation->run() === TRUE) {
            $nama = $this->input->post('nama', TRUE);
            $alamat = $this->input->post('alamat', TRUE);
            $no_hp = $this->input->post('no_hp', TRUE);
            $jenis_kelamin = $this->input->post('jenis_kelamin', TRUE);
            $nama_perusahaan = $this->input->post('nama_perusahaan', TRUE);
            $data = array(
                'nama' => $nama,
                'alamat' => $alamat,
                'no_hp' => $no_hp,
                'jenis_kelamin' => $jenis_kelamin,
                'nama_perusahaan' => $nama_perusahaan
            );
            $this->M_pimpinan->insert('tb_pelanggan', $data);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Tambahkan');
            redirect(base_url('pimpinan/tambah_data_pelanggan'));
        } else {
            $this->load->view('pimpinan/form_pelanggan/tambah_pelanggan');
        }
    }

    ####################################
    // End Data Pelanggan 
    ####################################

    ####################################
    // Data Barang Keluar 
    ####################################

    public function tabel_barang_keluar()
    {
        $data['list_data'] = $this->M_pimpinan->select('tb_barang_keluar');
        $data['avatar'] = $this->M_pimpinan->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
        $data['title'] = 'Data Genset Keluar';
        $this->load->view('pimpinan/tabel/tabel_barang_keluar', $data);
    }

    public function detail_barang_keluar($id_transaksi)
    {
        $where = array('id_transaksi' => $id_transaksi);
        $data['list_data'] = $this->M_pimpinan->get_data_tb('tb_barang_keluar', $where);
        $data['avatar'] = $this->M_pimpinan->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
        $data['title'] = 'Detail Genset Keluar';
        $this->load->view('pimpinan/form/detail_keluar', $data);
    }

    ####################################
    // End Data Barang Keluar
    ####################################

    ####################################
    // Data Barang Masuk
    ####################################

    public function tabel_barang_masuk()
    {
        $data = array(
            // 'list_mobil' => $this->M_pimpinan->select('tb_mobil'),
            'list_data' => $this->M_pimpinan->select('tb_barang_masuk'),
            'avatar'    => $this->M_pimpinan->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'))
        );
        $data['title'] = 'Tabel Genset Masuk';
        $this->load->view('pimpinan/tabel/tabel_barang_masuk', $data);
    }

    public function detail_barang_masuk($id_transaksi)
    {
        $where = array('id_transaksi' => $id_transaksi);
        $data['list_data'] = $this->M_pimpinan->get_data_tb('tb_barang_masuk', $where);
        $data['avatar'] = $this->M_pimpinan->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
        $data['title'] = 'Detail Genset Masuk';
        $this->load->view('pimpinan/form/detail_masuk', $data);
    }

    ####################################
    // End Data Barang Masuk
    ####################################

    ####################################
    // Laporan
    ####################################

    public function laporan()
    {
        $data['avatar'] = $this->M_pimpinan->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
        $data['title'] = 'Laporan';
        $this->load->view('pimpinan/laporan/laporan', $data);
    }

    ####################################
    // End Laporan
    ####################################

    ####################################
    // Pengajuan Baru
    ####################################

    public function pengajuan_baru()
    {
        $data['list_mobil'] = $this->M_pimpinan->select('tb_mobil');
        $data['list_operator'] = $this->M_pimpinan->select('tb_operator');
        $data['list_pelanggan'] = $this->M_pimpinan->select('tb_pelanggan');
        $data['list_genset'] = $this->M_pimpinan->select('tb_genset');
        $data['avatar'] = $this->M_pimpinan->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
        $data['title'] = 'Tambah Genset Keluar';
        $this->load->view('pimpinan/form/pengajuan_pimpinan', $data);
    }

    public function proses_pengajuan_genset()
    {
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required');
        $this->form_validation->set_rules('kode_genset', 'Kode Genset', 'required');

        if ($this->form_validation->run() == TRUE) {
            $stok_gd           = $this->input->post('stok_gd', TRUE);
            $stok_pj           = $this->input->post('stok_pj', TRUE);

            $id_transaksi     = $this->input->post('id_transaksi', TRUE);
            $tanggal_keluar          = $this->input->post('tanggal_keluar', TRUE);
            $lokasi           = $this->input->post('lokasi', TRUE);
            $nama_operator    = $this->input->post('nama_operator', TRUE);
            $nama_pelanggan   = $this->input->post('nama_pelanggan', TRUE);
            $kode_genset      = $this->input->post('kode_genset', TRUE);
            $nama_genset      = $this->input->post('nama_genset', TRUE);
            $daya             = $this->input->post('daya', TRUE);
            $harga            = $this->input->post('harga', TRUE);
            $nopol            = $this->input->post('nopol', TRUE);
            $mobil            = $this->input->post('tipe', TRUE);
            $tambahan         = $this->input->post('tambahan', TRUE);
            $jumlah_hari      = $this->input->post('jumlah_hari', TRUE);
            $total            = $this->input->post('total', TRUE);
            $status_ajuan           = 1;
            $status           = 1;

            $tanggal_masuk    = date('d-m-Y', strtotime($tanggal_keluar . "+" . $jumlah_hari . " days"));

            $data = array(
                'id_transaksi'     => $id_transaksi,
                'tanggal_keluar'          => $tanggal_keluar,
                'lokasi'           => $lokasi,
                'tanggal_masuk'    => $tanggal_masuk,
                'nama_operator'    => $nama_operator,
                'nama_pelanggan'   => $nama_pelanggan,
                'kode_genset'      => $kode_genset,
                'nama_genset'      => $nama_genset,
                'daya'             => $daya,
                'harga'            => $harga,
                'nopol'            => $nopol,
                'mobil'            => $mobil,
                'tambahan'         => $tambahan,
                'jumlah_hari'      => $jumlah_hari,
                'total'            => $total,
                'status_ajuan'           => $status_ajuan,
                'status'           => $status
            );
            $stok_gd_new = (int)$stok_gd - 1;
            $stok_pj_new = (int)$stok_pj + 1;

            $this->M_pimpinan->mengurangi('tb_genset', $kode_genset, $stok_gd_new);
            $this->M_pimpinan->menambah('tb_genset', $kode_genset, $stok_pj_new);
            $this->M_pimpinan->insert('tb_barang_keluar', $data);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Ditambahkan');

            redirect(base_url('pimpinan/tabel_barang_keluar'));
        } else {
            $data['list_genset'] = $this->M_pimpinan->select('tb_genset');
            $data['avatar'] = $this->M_pimpinan->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
            $this->load->view('pimpinan/form/pengajuan_pimpinan', $data);
        }
    }

    ####################################
    // End Pengajuan Baru
    ####################################
}

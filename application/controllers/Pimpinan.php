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
        $data['avatar'] = $this->M_pimpinan->get_avatar('tb_user', $this->session->userdata('name'));
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
        $data['avatar'] = $this->M_pimpinan->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Profile';
        $this->load->view('pimpinan/profile/profile', $data);
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
            $this->M_pimpinan->update_password('tb_user', $where, $data);
            $this->session->set_flashdata('msg_sukses', 'Password Berhasil Diganti, Silahkan Logout dan Login Kembali');
            redirect(site_url('pimpinan/profile'));
        } else {
            $data['avatar'] = $this->M_pimpinan->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Profile';
            $this->load->view('pimpinan/profile/profile', $data);
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
            $data['avatar'] = $this->M_pimpinan->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Profile';
            $this->load->view('pimpinan/profile/profile', $data);
        } else {
            $data_upload = array('upload_data' => $this->upload->data());
            $nama_file = $data_upload['upload_data']['file_name'];

            $where = array(
                'username' => $this->session->userdata('name')
            );
            $data = array(
                'nama_file' => $nama_file
            );

            $this->M_pimpinan->update_avatar($where, $data);
            $this->session->set_flashdata('msg_gambar_sukses', 'Gambar Berhasil Di Upload');
            redirect(site_url('pimpinan/profile'));
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
        $data['list_data'] = $this->M_pimpinan->select('tb_genset');
        $data['avatar'] = $this->M_pimpinan->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Genset';
        $this->load->view('pimpinan/tabel/tabel_genset', $data);
    }

    ####################################
    //* End Data Genset 
    ####################################
    ####################################
    //* Data Perbaikan Genset 
    ####################################

    public function tabel_service_genset()
    {
        $data['list_data'] = $this->M_pimpinan->get_data_service('tb_serv_genset');
        $data['avatar'] = $this->M_pimpinan->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Perbaikan Genset';
        $this->load->view('pimpinan/tabel/tabel_service_genset', $data);
    }

    public function detail_service_genset()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_perbaikan_gst' => $uri);
        $data['list_data'] = $this->M_pimpinan->get_detail_perbaikan('tb_serv_genset', $where);
        $data['detail_perbaikan'] = $this->M_pimpinan->detail_perbaikan('tb_detail_serv', $where);
        $data['avatar'] = $this->M_pimpinan->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Update Perbaikan Genset';
        $this->load->view('pimpinan/tabel/detail_service_genset', $data);
    }

    public function proses_update_ket_service()
    {
        // $this->form_validation->set_rules('id_genset', 'Kode Genset', 'trim|required');
        // $this->form_validation->set_rules('nama_genset', 'Nama Genset', 'trim|required');
        // $this->form_validation->set_rules('jenis_perbaikan', 'Jenis Perbaikan', 'trim|required');
        // $this->form_validation->set_rules('tgl_perbaikan', 'Tanggal Perbaikan', 'trim|required');
        $this->form_validation->set_rules('ket_perbaikan', 'Keterangan Perbaikan', 'trim|required');
        // $this->form_validation->set_rules('biaya_perbaikan', 'Biaya Perbaikan', 'trim|required');

        if ($this->form_validation->run() === TRUE) {
            // $stok = $this->input->post('stok', true);

            $id = $this->input->post('id_perbaikan_gst', TRUE);
            // $kode_genset = $this->input->post('id_genset', TRUE);
            // $nama_genset = $this->input->post('nama_genset', TRUE);
            // $jenis_perbaikan = $this->input->post('jenis_perbaikan', TRUE);
            // $spare_part = $this->input->post('id_sparepart', TRUE);
            // $tgl_perbaikan = $this->input->post('tgl_perbaikan', TRUE);
            $ket_perbaikan = $this->input->post('ket_perbaikan', TRUE);
            // $biaya_perbaikan = $this->input->post('biaya_perbaikan', TRUE);

            $where = array('id_perbaikan_gst' => $id);
            $data = array(
                // 'id_genset' => $kode_genset,
                // 'nama_genset' => $nama_genset,
                // 'jenis_perbaikan' => $jenis_perbaikan,
                // 'id_sparepart' => $spare_part,
                // 'tgl_perbaikan' => $tgl_perbaikan,
                'ket_perbaikan' => $ket_perbaikan,
                // 'biaya_perbaikan' => $biaya_perbaikan,
            );
            // $stok_new = --$stok;

            // $this->M_pimpinan->mengurangi_stok('tb_sparepart', $spare_part, $stok_new);
            $this->M_pimpinan->update('tb_serv_genset', $data, $where);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Diubah');
            redirect(site_url('pimpinan/tabel_service_genset'));
        } else {
            $data['avatar'] = $this->M_pimpinan->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Update Perbaikan Genset';
            $this->load->view('pimpinan/form_service_genset/update_service_genset', $data);
        }
    }

    public function hapus_detail()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_detail_serv' => $uri);
        $this->M_pimpinan->delete('tb_detail_serv', $where);
        $this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
        redirect(site_url('pimpinan/detail_service_genset'));
    }
    ####################################
    //* End Data Perbaikan Genset 
    ####################################
    ####################################
    //* Data Sparepart 
    ####################################

    public function tabel_sparepart()
    {
        // $where = array('stok');
        // $data['count'] = $this->M_pimpinan->notif_stok('tb_sparepart');
        // $data['num'] = $this->M_pimpinan->notif_stok_jml('tb_sparepart');

        $data['list_sparepart'] = $this->M_pimpinan->select('tb_sparepart');
        $data['avatar'] = $this->M_pimpinan->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Sparepart';
        $this->load->view('pimpinan/tabel/tabel_sparepart', $data);
    }

    ####################################
    //* End Data Sparepart 
    ####################################
    ####################################
    //* Data Mobil 
    ####################################

    public function tabel_mobil()
    {
        $data['list_data'] = $this->M_pimpinan->select('tb_mobil');
        $data['avatar'] = $this->M_pimpinan->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Mobil';
        $this->load->view('pimpinan/tabel/tabel_mobil', $data);
    }

    ####################################
    //* End Data Mobil 
    ####################################
    ####################################
    //* Data Operator 
    ####################################

    public function tabel_operator()
    {
        $data['list_operator'] = $this->M_pimpinan->select('tb_operator');
        $data['avatar'] = $this->M_pimpinan->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Operator';
        $this->load->view('pimpinan/tabel/tabel_operator', $data);
    }

    ####################################
    //* End Data Operator 
    ####################################
    ####################################
    //* Data Pelanggan 
    ####################################

    public function tabel_pelanggan()
    {
        $data['list_pelanggan'] = $this->M_pimpinan->select('tb_pelanggan');
        $data['avatar'] = $this->M_pimpinan->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Pelanggan';
        $this->load->view('pimpinan/tabel/tabel_pelanggan', $data);
    }

    public function tabel_pelanggan_blacklist()
    {
        $data['list_pelanggan_blacklist'] = $this->M_pimpinan->select('tb_pelanggan_blacklist');
        $data['avatar'] = $this->M_pimpinan->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Pelanggan Blacklist';
        $this->load->view('pimpinan/tabel/tabel_pelanggan_blacklist', $data);
    }

    public function pindah_data_pelanggan()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_pelanggan' => $uri);
        $data['list_plg'] = $this->M_pimpinan->get_data('tb_pelanggan', $where);
        $data['avatar'] = $this->M_pimpinan->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Pindah Data Pelanggan';
        $this->load->view('pimpinan/form/pindah_pelanggan_blacklist', $data);
    }

    public function proses_blacklist_pelanggan()
    {
        $id = $this->input->post('id_pelanggan', TRUE);
        $this->form_validation->set_rules('nama_plg_blk', 'Nama', 'trim|required');
        $this->form_validation->set_rules('alamat_plg_blk', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('nohp_plg_blk', 'No Hp', 'trim|required');
        $this->form_validation->set_rules('jk_plg_blk', 'Jenis Kelamin', 'trim|required');
        $this->form_validation->set_rules('namaperusahaan_plg_blk', 'Nama Perusahaan', 'trim|required');
        $this->form_validation->set_rules('tglupdate_plg_blk', 'Tanggal Update', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $nama = $this->input->post('nama_plg_blk', TRUE);
            $alamat = $this->input->post('alamat_plg_blk', TRUE);
            $no_hp = $this->input->post('nohp_plg_blk', TRUE);
            $jenis_kelamin = $this->input->post('jk_plg_blk', TRUE);
            $nama_perusahaan = $this->input->post('namaperusahaan_plg_blk', TRUE);
            $tgl_update = $this->input->post('tglupdate_plg_blk', TRUE);

            $where = array('id_pelanggan' => $id);
            $data = array(
                'nama_plg_blk' => $nama,
                'alamat_plg_blk' => $alamat,
                'nohp_plg_blk' => $no_hp,
                'jk_plg_blk' => $jenis_kelamin,
                'namaperusahaan_plg_blk' => $nama_perusahaan,
                'tglupdate_plg_blk' => $tgl_update
            );
            $this->M_pimpinan->insert('tb_pelanggan_blacklist', $data);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Dipindah');
            $this->M_pimpinan->delete('tb_pelanggan', $where);
            redirect(site_url('pimpinan/tabel_pelanggan_blacklist'));
        } else {
            $data['avatar'] = $this->M_pimpinan->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Pindah Data Pelanggan';
            $this->load->view('pimpinan/form/pindah_pelanggan_blacklist');
        }
    }
    ####################################
    //* End Data Pelanggan 
    ####################################
    ####################################
    //* Data Unit Keluar 
    ####################################

    public function tabel_unit_keluar()
    {
        $data['list_data'] = $this->M_pimpinan->get_data_u_keluar('tb_unit_keluar');
        $data['total_data'] = $this->M_pimpinan->sum_pendapatan('tb_unit_keluar');
        $data['avatar'] = $this->M_pimpinan->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Unit Sewa';
        $this->load->view('pimpinan/tabel/tabel_unit_keluar', $data);
    }

    public function detail_unit_keluar($id_transaksi)
    {
        $uri = $this->uri->segment(3);
        $where = array('id_u_keluar' => $uri);
        $data['list_data'] = $this->M_pimpinan->select_data_u_keluar('tb_unit_keluar', $where);
        $data['avatar'] = $this->M_pimpinan->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Detail Data Unit Sewa';
        $this->load->view('pimpinan/tabel/detail_keluar', $data);
    }


    ####################################
    //* End Data Unit Keluar
    ####################################
    ####################################
    //* Data Barang Masuk
    ####################################



    ####################################
    //* End Data Barang Masuk
    ####################################
    ####################################
    //* Data Jadwal Penyewaan Genset
    ####################################

    public function tabel_jdw_genset()
    {
        $data['list_data'] = $this->M_pimpinan->get_data_u_keluar('tb_unit_keluar');
        $data['avatar'] = $this->M_pimpinan->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Jadwal Penyewaan Genset';
        $this->load->view('pimpinan/tabel/tabel_jdw_genset', $data);
    }

    ####################################
    //* End Data Jadwal Penyewaan Genset
    ####################################
    ####################################
    //* Data Pengeluaran
    ####################################

    public function tabel_pengeluaran()
    {
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        if (empty($bulan) or empty($tahun)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['list_data'] = $this->M_pimpinan->select('tb_pengeluaran');
            $data['total_data'] = $this->M_pimpinan->sum_pengeluaran('tb_pengeluaran');
            $label = 'Bulan ke ...' . ' Tahun ...';
        } else {
            $data['list_data'] = $this->M_pimpinan->pengeluaran_periode('tb_pengeluaran', $bulan, $tahun);
            $data['total_data'] = $this->M_pimpinan->sum_penngeluaranPeriode('tb_pengeluaran', $bulan, $tahun);
            $label = 'Bulan ke ' . $bulan . ' Tahun ' .  $tahun;
        }
        $data['label'] = $label;

        // $data['list_data'] = $this->M_pimpinan->select('tb_pengeluaran');
        $data['avatar'] = $this->M_pimpinan->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Pengeluaran';
        $this->load->view('pimpinan/tabel/tabel_pengeluaran', $data);
    }
    ####################################
    //* End Data Pengeluaran
    ####################################
    ####################################
    //* Pemasukan
    ####################################
    public function tabel_pemasukan()
    {
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        // $bulan = date('m');
        // $tahun = date('Y');
        if (empty($bulan) or empty($tahun)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['list_data'] = $this->M_pimpinan->get_data_pemasukan('tb_pendapatan');
            $data['total_data'] = $this->M_pimpinan->sum_pemasukan('tb_pendapatan');
            $label = 'Bulan ke ...' . ' Tahun ...';
        } else {
            $data['list_data'] = $this->M_pimpinan->pemasukan_periode('tb_pendapatan', $bulan, $tahun);
            $data['total_data'] = $this->M_pimpinan->sum_pendapatanMasuk('tb_pendapatan', $bulan, $tahun);
            $label = 'Bulan ke ' . $bulan . ' Tahun ' .  $tahun;
        }
        // $data['list_data'] = $this->M_pimpinan->get_data_u_keluar('tb_unit_keluar');
        // $data['list_data'] = $this->M_pimpinan->pemasukan_periode('tb_unit_keluar', $bulan, $tahun);

        // $data['total_data'] = $this->M_pimpinan->sum_pendapatan('tb_unit_keluar');
        $data['label'] = $label;
        $data['avatar'] = $this->M_pimpinan->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Pendapatan';
        $this->load->view('pimpinan/tabel/tabel_pemasukan', $data);
    }
    ####################################
    //* End Pemasukan
    ####################################
    ####################################
    //* Laporan
    ####################################

    public function laporan()
    {
        $data['avatar'] = $this->M_pimpinan->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Laporan';
        $this->load->view('pimpinan/report/laporan', $data);
    }

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

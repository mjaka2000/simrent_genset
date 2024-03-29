<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Teknisi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_data');
        if ($this->session->userdata('role') != '2') {
            redirect(site_url("login"));
        }
    }

    public function index()
    {
        $tgl = date('Y-m-d');

        $data['notifServGenset'] = $this->M_data->notif_ServGenset('tb_serv_genset', $tgl);
        $data['numServGenset'] = $this->M_data->notif_ServGenset_Jml('tb_serv_genset', $tgl);
        $data['dataServGenset'] = $this->M_data->numrows('tb_serv_genset');
        $data['dataServGensetAcc'] = $this->M_data->numrows('tb_serv_gst_acc');
        $data['dataStokSparepart'] = $this->M_data->numrows('tb_sparepart');
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Home';
        $this->load->view('teknisi/index', $data);
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
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Profile';
        $this->load->view('teknisi/users/profile', $data);
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
            $this->M_data->update_password('tb_user', $where, $data);
            $this->session->set_flashdata('msg_sukses', 'Password Berhasil Diganti, Silahkan Logout dan Login Kembali');
            redirect(site_url('teknisi/profile'));
        } else {
            $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Profile';
            $this->load->view('teknisi/users/profile', $data);
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
            $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Profile';
            $this->load->view('teknisi/users/profile', $data);
        } else {
            $data_upload = array('upload_data' => $this->upload->data());
            $nama_file = $data_upload['upload_data']['file_name'];

            $where = array(
                'username' => $this->session->userdata('name')
            );
            $data = array(
                'nama_file' => $nama_file
            );

            $this->M_data->update_avatar($where, $data);
            $this->session->set_flashdata('msg_gambar_sukses', 'Gambar Berhasil Di Upload');
            redirect(site_url('teknisi/profile'));
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
        $data['list_data'] = $this->M_data->select('tb_genset');
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Genset';
        $this->load->view('teknisi/genset/tabel_genset', $data);
    }

    public function detail_genset($where)
    {
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        // $uri = $this->uri->segment(3);
        // $where = array('id_genset' => $uri);
        if (empty($bulan) or empty($tahun)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['list_data'] = $this->M_data->get_data_det_genset('tb_unit_penyewaan', $where);
            $label = 'Bulan ke ...' . ' Tahun ...';
            // $data['get_data'] = $this->M_data->get_jumlah_hari_genset('tb_unit_penyewaan', $where);
        } else {
            $data['list_data'] = $this->M_data->det_genset_periode('tb_unit_penyewaan', $where, $bulan, $tahun);
            $label = 'Bulan ke ' . $bulan . ' Tahun ' .  $tahun;
        }
        $data['label'] = $label;
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Detail Data Genset';
        $this->load->view('teknisi/genset/det_pakai_genset', $data);
    }

    ####################################
    //* End Data Genset 
    ####################################
    ####################################
    //* Data Perbaikan Genset 
    ####################################

    public function tabel_service_genset()
    {
        $data['list_genset'] = $this->M_data->select('tb_genset');
        $data['list_sparepart'] = $this->M_data->select('tb_sparepart');
        $data['list_data'] = $this->M_data->get_data_service('tb_serv_genset');
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Perbaikan Genset';
        $this->load->view('teknisi/service_genset/tabel_service_genset', $data);
    }

    public function tambah_service_genset()
    {
        $data['list_genset'] = $this->M_data->select('tb_genset');
        $data['list_sparepart'] = $this->M_data->select('tb_sparepart');
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Tambah Perbaikan Genset';
        $this->load->view('teknisi/service_genset/tambah_service_genset', $data);
    }

    public function proses_tambah_service_genset()
    {
        $this->form_validation->set_rules('id_genset', 'Kode Genset', 'trim|required');
        // $this->form_validation->set_rules('nama_genset', 'Nama Genset', 'trim|required');
        $this->form_validation->set_rules('jenis_perbaikan', 'Jenis Perbaikan', 'trim|required');
        // $this->form_validation->set_rules('id_sparepart', 'Nama Sparepart', 'trim|required');
        $this->form_validation->set_rules('tgl_perbaikan', 'Tanggal Perbaikan', 'trim|required');
        $this->form_validation->set_rules('tgl_perbaikan_kembali', 'Tanggal Perbaikan Kembali', 'trim|required');
        $this->form_validation->set_rules('jam_pakai', 'Hours Meter Genset', 'trim|required');
        $this->form_validation->set_rules('ket_perbaikan', 'Keterangan Perbaikan', 'trim|required');
        $this->form_validation->set_rules('biaya_perbaikan', 'Biaya Perbaikan', 'trim|required');

        if ($this->form_validation->run() == true) {
            $stok = $this->input->post('stok', true);

            $kode_genset = $this->input->post('id_genset', true);
            // $nama_genset = $this->input->post('nama_genset', true);
            $jenis_perbaikan = $this->input->post('jenis_perbaikan', true);
            $spare_part = $this->input->post('id_sparepart', true);
            $tgl_perbaikan = $this->input->post('tgl_perbaikan', true);
            $tgl_perbaikan_kembali = $this->input->post('tgl_perbaikan_kembali', true);
            $jam_pakai = $this->input->post('jam_pakai', true);
            $ket_perbaikan = $this->input->post('ket_perbaikan', true);
            $biaya_perbaikan = $this->input->post('biaya_perbaikan', true);

            $data = array(
                'id_genset' => $kode_genset,
                // 'nama_genset' => $nama_genset,
                'jenis_perbaikan' => $jenis_perbaikan,
                'id_sparepart' => $spare_part,
                'tgl_perbaikan' => $tgl_perbaikan,
                'tgl_perbaikan_kembali' => $tgl_perbaikan_kembali,
                'jam_pakai' => $jam_pakai,
                'ket_perbaikan' => $ket_perbaikan,
                'biaya_perbaikan' => $biaya_perbaikan
            );
            $stok_new = --$stok;

            $this->M_data->mengurangi_stok('tb_sparepart', $spare_part, $stok_new);
            $this->M_data->insert('tb_serv_genset', $data);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Disimpan');
            redirect(site_url('teknisi/tabel_service_genset'));
        } else {
            $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Tambah Perbaikan Genset';
            // $this->load->view('teknisi/service_genset/tambah_service_genset', $data);
            $this->load->view('teknisi/service_genset/tabel_service_genset', $data);
        }
    }

    public function update_data_service_genset()
    {
        $data['list_genset'] = $this->M_data->select('tb_genset');
        $data['list_sparepart'] = $this->M_data->select('tb_sparepart');
        $uri = $this->uri->segment(3);
        $where = array('id_perbaikan_gst' => $uri);
        $data['list_data'] = $this->M_data->get_data('tb_serv_genset', $where);
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Update Perbaikan Genset';
        $this->load->view('teknisi/service_genset/update_service_genset', $data);
    }

    public function proses_update_service_genset()
    {
        // $this->form_validation->set_rules('id_genset', 'Kode Genset', 'trim|required');
        // $this->form_validation->set_rules('nama_genset', 'Nama Genset', 'trim|required');
        $this->form_validation->set_rules('jenis_perbaikan', 'Jenis Perbaikan', 'trim|required');
        $this->form_validation->set_rules('tgl_perbaikan', 'Tanggal Perbaikan', 'trim|required');
        $this->form_validation->set_rules('tgl_perbaikan_kembali', 'Tanggal Perbaikan Kembali', 'trim|required');
        $this->form_validation->set_rules('jam_pakai', 'Hours Meter Genset', 'trim|required');
        $this->form_validation->set_rules('ket_perbaikan', 'Keterangan Perbaikan', 'trim|required');
        $this->form_validation->set_rules('biaya_perbaikan', 'Biaya Perbaikan', 'trim|required');

        if ($this->form_validation->run() === TRUE) {
            $stok = $this->input->post('stok', true);

            $id = $this->input->post('id_perbaikan_gst', TRUE);
            $kode_genset = $this->input->post('id_genset', TRUE);
            // $nama_genset = $this->input->post('nama_genset', TRUE);
            $jenis_perbaikan = $this->input->post('jenis_perbaikan', TRUE);
            $spare_part = $this->input->post('id_sparepart', TRUE);
            $tgl_perbaikan = $this->input->post('tgl_perbaikan', TRUE);
            $tgl_perbaikan_kembali = $this->input->post('tgl_perbaikan_kembali', true);
            $jam_pakai = $this->input->post('jam_pakai', true);
            $ket_perbaikan = $this->input->post('ket_perbaikan', TRUE);
            $biaya_perbaikan = $this->input->post('biaya_perbaikan', TRUE);

            $where = array('id_perbaikan_gst' => $id);
            $data = array(
                'id_genset' => $kode_genset,
                // 'nama_genset' => $nama_genset,
                'jenis_perbaikan' => $jenis_perbaikan,
                'id_sparepart' => $spare_part,
                'tgl_perbaikan' => $tgl_perbaikan,
                'tgl_perbaikan_kembali' => $tgl_perbaikan_kembali,
                'jam_pakai' => $jam_pakai,
                'ket_perbaikan' => $ket_perbaikan,
                'biaya_perbaikan' => $biaya_perbaikan,
            );
            // $stok_new = --$stok;

            // $this->M_data->mengurangi_stok('tb_sparepart', $spare_part, $stok_new);
            $this->M_data->update('tb_serv_genset', $data, $where);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Diubah');
            redirect(site_url('teknisi/tabel_service_genset'));
        } else {
            $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Update Perbaikan Genset';
            // $this->load->view('teknisi/service_genset/update_service_genset', $data);
            $data['list_data'] = $this->M_data->get_data_service('tb_serv_genset');
            $this->load->view('teknisi/service_genset/tabel_service_genset', $data);
        }
    }

    public function hapus_service_genset()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_perbaikan_gst' => $uri);
        $this->M_data->delete('tb_serv_genset', $where);
        $this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
        redirect(site_url('teknisi/tabel_service_genset'));
    }

    public function detail_service_genset($where)
    {
        // $uri = $this->uri->segment(3);
        // $where = array('id_perbaikan_gst' => $uri);
        $data['list_data'] = $this->M_data->get_detail_perbaikan('tb_serv_genset', $where);
        $data['detail_perbaikan'] = $this->M_data->detail_perbaikan('tb_detail_serv', $where);
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Update Perbaikan Genset';
        $this->load->view('teknisi/service_genset/detail_service_genset', $data);
    }

    public function tambah_service_detail($where)
    {
        // $uri = $this->uri->segment(3);
        // $where = array('id_perbaikan_gst' => $uri);
        $data['list_data'] = $this->M_data->get_detail_perbaikan('tb_serv_genset', $where);
        $data['detail_perbaikan'] = $this->M_data->detail_perbaikan('tb_detail_serv', $where);
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Tambah Detail Perbaikan';
        $this->load->view('teknisi/service_genset/tambah_detailservice_genset', $data);
    }

    public function proses_tambah_service_detail()
    {
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('kendala', 'Kendala', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        if ($this->form_validation->run() === true) {

            $id_perbaikan_gst = $this->input->post('id_perbaikan_gst', true);
            $pekerjaan = $this->input->post('pekerjaan', true);
            $tanggal = $this->input->post('tanggal', true);
            $kendala = $this->input->post('kendala', true);
            $status = $this->input->post('status', true);

            // $tanggal_beli = date('Y-m-d', strtotime($tanggal_beli));
            $data = array(
                'id_perbaikan_gst' => $id_perbaikan_gst,
                'pekerjaan' => $pekerjaan,
                'tanggal' => $tanggal,
                'kendala' => $kendala,
                'status' => $status
            );
            $this->M_data->insert('tb_detail_serv', $data);
            $this->session->set_flashdata('msg_sukses', 'Data Detail Berhasil Disimpan');
            redirect(site_url('teknisi/tabel_service_genset'));
        } else {
            $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Tambah Detail Perbaikan';
            $this->load->view('teknisi/service_genset/tabel_service_genset', $data);
        }
    }

    public function hapus_detail()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_detail_serv' => $uri);
        $this->M_data->delete('tb_detail_serv', $where);
        $this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
        redirect(site_url('teknisi/detail_service_genset'));
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

            // $this->M_data->mengurangi_stok('tb_sparepart', $spare_part, $stok_new);
            $this->M_data->update('tb_serv_genset', $data, $where);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Diubah');
            redirect(site_url('teknisi/tabel_service_genset'));
        } else {
            $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Update Perbaikan Genset';
            $this->load->view('teknisi/service_genset/detail_service_genset', $data);
        }
    }
    ####################################
    //* End Data Perbaikan Genset 
    ####################################
    ####################################
    //* Data Perbaikan Genset Acc
    ####################################
    public function service_genset_acc()
    {
        $data['list_perbaikan'] = $this->M_data->get_Serv('tb_serv_genset');
        $data['list_data'] = $this->M_data->select_ServGstAcc('tb_serv_gst_acc');
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Perbaikan Genset Disetujui';
        $this->load->view('teknisi/service_gensetAcc/tabel_service_gensetAcc', $data);
    }

    public function tambah_service_genset_acc()
    {
        $data['list_perbaikan'] = $this->M_data->get_Serv('tb_serv_genset');
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Tambah Perbaikan Genset Disetujui';
        $this->load->view('teknisi/service_gensetAcc/tambah_service_gensetAcc', $data);
    }

    public function proses_tambah_ServGstAcc()
    {
        $this->form_validation->set_rules('id_perbaikan_gst', 'Perbaikan Genset Selesai', 'trim|required|is_unique[tb_serv_gst_acc.id_perbaikan_gst]');
        $this->form_validation->set_rules('tgl_setujui', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        // $this->form_validation->set_rules('status_ajuan', 'Status', 'trim|required');

        if ($this->form_validation->run() === true) {

            $id_perbaikan_gst = $this->input->post('id_perbaikan_gst', true);
            $tgl_setujui = $this->input->post('tgl_setujui', true);
            $keterangan = $this->input->post('keterangan', true);
            $status_ajuan = 0;

            $data = array(
                'id_perbaikan_gst' => $id_perbaikan_gst,
                'tgl_setujui' => $tgl_setujui,
                'keterangan' => $keterangan,
                'status_ajuan' => $status_ajuan,
            );
            $this->M_data->insert('tb_serv_gst_acc', $data);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Disimpan');
            redirect(site_url('teknisi/service_genset_acc'));
        } else {
            $data['list_perbaikan'] = $this->M_data->get_Serv('tb_serv_genset');
            $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Tambah Perbaikan Genset Disetujui';
            $this->load->view('teknisi/service_gensetAcc/tambah_service_gensetAcc', $data);
            // $this->load->view('teknisi/service_gensetAcc/tabel_service_gensetAcc', $data);
        }
    }

    public function update_service_genset_acc()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_serv_gst_acc' => $uri);
        $data['list_data'] = $this->M_data->get_ServGstAcc('tb_serv_gst_acc', $where);
        $data['list_perbaikan'] = $this->M_data->get_Serv('tb_serv_genset');
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Ubah Perbaikan Genset Disetujui';
        $this->load->view('teknisi/service_gensetAcc/ubah_service_gensetAcc', $data);
    }

    public function proses_ubah_ServGstAcc()
    {
        $this->form_validation->set_rules('id_perbaikan_gst', 'Perbaikan Genset Selesai', 'trim|required');
        $this->form_validation->set_rules('tgl_setujui', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        // $this->form_validation->set_rules('status_ajuan', 'Status', 'trim|required');

        if ($this->form_validation->run() === true) {

            $id_serv_gst_acc = $this->input->post('id_serv_gst_acc', true);
            $id_perbaikan_gst = $this->input->post('id_perbaikan_gst', true);
            $tgl_setujui = $this->input->post('tgl_setujui', true);
            $keterangan = $this->input->post('keterangan', true);
            // $status_ajuan = $this->input->post('status_ajuan', true);

            $where = array('id_serv_gst_acc' => $id_serv_gst_acc);
            $data = array(
                'id_perbaikan_gst' => $id_perbaikan_gst,
                'tgl_setujui' => $tgl_setujui,
                'keterangan' => $keterangan
                // 'status_ajuan' => $status_ajuan,
            );
            $this->M_data->update('tb_serv_gst_acc', $data, $where);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Diubah');
            redirect(site_url('teknisi/service_genset_acc'));
        } else {
            $data['list_perbaikan'] = $this->M_data->get_Serv('tb_serv_genset');
            $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Ubah Perbaikan Genset Disetujui';
            $this->load->view('teknisi/service_gensetAcc/ubah_service_gensetAcc', $data);
            // $this->load->view('teknisi/service_gensetAcc/tabel_service_gensetAcc', $data);
        }
    }

    public function hapus_service_genset_acc()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_serv_gst_acc' => $uri);
        $this->M_data->delete('tb_serv_gst_acc', $where);
        $this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
        redirect(site_url('teknisi/service_genset_acc'));
    }
    ####################################
    //* End Data Perbaikan Genset Acc
    ####################################
    ####################################
    //* Data Sparepart 
    ####################################

    public function tabel_sparepart()
    {
        // $where = array('stok');
        $data['count'] = $this->M_data->notif_stok('tb_sparepart');
        $data['num'] = $this->M_data->notif_stok_jml('tb_sparepart');

        $data['list_sparepart'] = $this->M_data->select('tb_sparepart');
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Sparepart';
        $this->load->view('teknisi/sparepart/tabel_sparepart', $data);
    }

    public function tambah_data_sparepart()
    {
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Tambah Stok Sparepart';
        $this->load->view('teknisi/sparepart/tambah_sparepart', $data);
    }

    public function proses_tambah_sparepart()
    {
        $this->form_validation->set_rules('nama_sparepart', 'Nama Sparepart', 'trim|required');
        $this->form_validation->set_rules('tanggal_beli', 'Tanggal Beli', 'trim|required');
        $this->form_validation->set_rules('tempat_beli', 'Tempat Beli', 'trim|required');
        $this->form_validation->set_rules('stok', 'Stok', 'trim|required');
        $this->form_validation->set_rules('harga_sparepart', 'Harga Sparepart', 'trim|required');

        if ($this->form_validation->run() === true) {

            $nama_sparepart = $this->input->post('nama_sparepart', true);
            $tanggal_beli = $this->input->post('tanggal_beli', true);
            $tempat_beli = $this->input->post('tempat_beli', true);
            $stok = $this->input->post('stok', true);
            $harga_sparepart = $this->input->post('harga_sparepart', true);

            // $tanggal_beli = date('Y-m-d', strtotime($tanggal_beli));
            $data = array(
                'nama_sparepart' => $nama_sparepart,
                'tanggal_beli' => $tanggal_beli,
                'tempat_beli' => $tempat_beli,
                'stok' => $stok,
                'harga_sparepart' => $harga_sparepart
            );
            $this->M_data->insert('tb_sparepart', $data);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Disimpan');
            redirect(site_url('teknisi/tabel_sparepart'));
        } else {
            $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Tambah Stok Sparepart';
            // $this->load->view('teknisi/sparepart/tambah_sparepart', $data);
            $this->load->view('teknisi/sparepart/tabel_sparepart', $data);
        }
    }

    public function update_sparepart()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_sparepart' => $uri);
        $data['list_sparepart'] = $this->M_data->get_data('tb_sparepart', $where);
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Edit Stok Sparepart';
        $this->load->view('teknisi/sparepart/update_sparepart', $data);
    }

    public function proses_update_sparepart()
    {
        $this->form_validation->set_rules('nama_sparepart', 'Nama Sparepart', 'trim|required');
        $this->form_validation->set_rules('tanggal_beli', 'Tanggal Beli', 'trim|required');
        $this->form_validation->set_rules('tempat_beli', 'Tempat Beli', 'trim|required');
        $this->form_validation->set_rules('stok', 'Stok', 'trim|required');
        $this->form_validation->set_rules('harga_sparepart', 'Harga Sparepart', 'trim|required');
        if ($this->form_validation->run() === true) {

            $id = $this->input->post('id', true);
            $nama_sparepart = $this->input->post('nama_sparepart', true);
            $tanggal_beli = $this->input->post('tanggal_beli', true);
            $tempat_beli = $this->input->post('tempat_beli', true);
            $stok = $this->input->post('stok', true);
            $harga_sparepart = $this->input->post('harga_sparepart', true);

            // $tanggal_beli = date('Y-m-d', strtotime($tanggal_beli));
            $where = array('id_sparepart' => $id);
            $data = array(
                'nama_sparepart' => $nama_sparepart,
                'tanggal_beli' => $tanggal_beli,
                'tempat_beli' => $tempat_beli,
                'stok' => $stok,
                'harga_sparepart' => $harga_sparepart

            );
            $this->M_data->update('tb_sparepart', $data, $where);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Diubah');
            redirect(site_url('teknisi/tabel_sparepart'));
        } else {
            $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Edit Stok Sparepart';
            // $this->load->view('teknisi/sparepart/update_sparepart', $data);
            $this->load->view('teknisi/sparepart/tabel_sparepart', $data);
        }
    }

    public function hapus_sparepart()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_sparepart' => $uri);
        $this->M_data->delete('tb_sparepart', $where);
        $this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
        redirect(site_url('teknisi/tabel_sparepart'));
    }

    ####################################
    //* End Data Sparepart 
    ####################################
    ####################################
    //* Laporan
    ####################################

    public function laporan()
    {
        $data['list_perbaikan'] = $this->M_data->get_data_service('tb_serv_genset');
        $data['list_genset'] = $this->M_data->select('tb_genset');

        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Laporan';
        $this->load->view('teknisi/report/laporan', $data);
    }

    ####################################
    //* End Laporan
    ####################################
}

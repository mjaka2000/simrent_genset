<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pimpinan extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_data');
        if ($this->session->userdata('role') != '1') {
            redirect(site_url("login"));
        }
        // $tgl = date('Y-m-d');
        // $nav['num'] = $this->M_data->notif_u_keluarJml('tb_unit_penyewaan', $tgl);
        // $nav['notifOut'] = $this->M_data->notif_u_keluar('tb_unit_penyewaan', $tgl);
        // $this->load->view('pimpinan/template/nav', $nav);
    }

    public function index()
    {
        $tgl = date('Y-m-d');
        $bulan = date('m');
        $tahun = date('Y');
        $label = 'Bulan ' . $bulan . ' Tahun ' .  $tahun;
        $data['pendapatan'] = $this->M_data->sum_pendapatanMasuk('tb_pendapatan', $bulan, $tahun);
        $data['pendapatanChart'] = $this->M_data->chart_pendapatanMasuk('tb_pendapatan', $bulan, $tahun);
        $data['numOut'] = $this->M_data->notif_u_keluarJml('tb_unit_penyewaan', $tgl);
        $data['notifOut'] = $this->M_data->notif_u_keluar('tb_unit_penyewaan', $tgl);
        $data['UnitKeluar'] = $this->M_data->numrows_where_uKeluar('tb_unit_penyewaan');
        $data['stokBarangKeluar'] = $this->M_data->numrows_where_uMasuk('tb_unit_penyewaan');
        $data['dataUser'] = $this->M_data->numrows('tb_user');
        $data['dataPelanggan'] = $this->M_data->numrows('tb_pelanggan');
        $data['dataOperator'] = $this->M_data->numrows('tb_operator');
        $data['dataServGenset'] = $this->M_data->numrows('tb_serv_genset');
        $data['dataStokSparepart'] = $this->M_data->numrows('tb_sparepart');
        $data['dataPengeluaran'] = $this->M_data->numrows('tb_pengeluaran');
        $data['notifJdw'] = $this->M_data->notif_jdwGst('tb_jadwal_genset', $tgl);
        $data['numJdw'] = $this->M_data->notif_jdwGst_Jml('tb_jadwal_genset', $tgl);
        $data['jdwGst'] = $this->M_data->numrows('tb_jadwal_genset');

        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Home';
        $data['label'] = $label;
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
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Profile';
        $this->load->view('pimpinan/users/profile', $data);
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
            redirect(site_url('pimpinan/profile'));
        } else {
            $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Profile';
            $this->load->view('pimpinan/users/profile', $data);
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
            $this->load->view('pimpinan/users/profile', $data);
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
        $data['list_data'] = $this->M_data->select('tb_genset');
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Genset';
        $this->load->view('pimpinan/genset/tabel_genset', $data);
    }

    ####################################
    //* End Data Genset 
    ####################################
    ####################################
    //* Data Perbaikan Genset 
    ####################################

    public function tabel_service_genset()
    {
        $data['list_data'] = $this->M_data->get_data_service('tb_serv_genset');
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Perbaikan Genset';
        $this->load->view('pimpinan/service_genset/tabel_service_genset', $data);
    }

    public function detail_service_genset()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_perbaikan_gst' => $uri);
        $data['list_data'] = $this->M_data->get_detail_perbaikan('tb_serv_genset', $where);
        $data['detail_perbaikan'] = $this->M_data->detail_perbaikan('tb_detail_serv', $where);
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Update Perbaikan Genset';
        $this->load->view('pimpinan/service_genset/detail_service_genset', $data);
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
            redirect(site_url('pimpinan/tabel_service_genset'));
        } else {
            $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Update Perbaikan Genset';
            $this->load->view('pimpinan/service_genset/detail_service_genset', $data);
        }
    }

    public function hapus_detail()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_detail_serv' => $uri);
        $this->M_data->delete('tb_detail_serv', $where);
        $this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
        redirect(site_url('pimpinan/detail_service_genset'));
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
        $this->load->view('pimpinan/service_gensetAcc/tabel_service_gensetAcc', $data);
    }

    // public function update_service_genset_acc()
    // {
    //     $uri = $this->uri->segment(3);
    //     $where = array('id_serv_gst_acc' => $uri);
    //     $data['list_data'] = $this->M_data->get_ServGstAcc('tb_serv_gst_acc', $where);
    //     $data['list_perbaikan'] = $this->M_data->get_Serv('tb_serv_genset');
    //     $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
    //     $data['title'] = 'Ubah Perbaikan Genset Disetujui';
    //     $this->load->view('pimpinan/service_gensetAcc/ubah_service_gensetAcc', $data);
    // }

    public function proses_ubah_ServGstAcc()
    {
        $this->form_validation->set_rules('id_perbaikan_gst', 'Perbaikan Genset Selesai', 'trim|required');
        $this->form_validation->set_rules('tgl_setujui', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_rules('status_ajuan', 'Status', 'trim|required');

        if ($this->form_validation->run() === true) {

            $id_serv_gst_acc = $this->input->post('id_serv_gst_acc', true);
            $id_perbaikan_gst = $this->input->post('id_perbaikan_gst', true);
            $tgl_setujui = $this->input->post('tgl_setujui', true);
            $keterangan = $this->input->post('keterangan', true);
            $status_ajuan = $this->input->post('status_ajuan', true);

            $where = array('id_serv_gst_acc' => $id_serv_gst_acc);
            $data = array(
                'id_perbaikan_gst' => $id_perbaikan_gst,
                'tgl_setujui' => $tgl_setujui,
                'keterangan' => $keterangan,
                'status_ajuan' => $status_ajuan,
            );
            $this->M_data->update('tb_serv_gst_acc', $data, $where);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Diubah');
            redirect(site_url('pimpinan/service_genset_acc'));
        } else {
            $data['list_perbaikan'] = $this->M_data->get_Serv('tb_serv_genset');
            $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Ubah Perbaikan Genset Disetujui';
            // $this->load->view('pimpinan/service_gensetAcc/ubah_service_gensetAcc', $data);
            $this->load->view('pimpinan/service_gensetAcc/tabel_service_gensetAcc', $data);
        }
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
        // $data['count'] = $this->M_data->notif_stok('tb_sparepart');
        // $data['num'] = $this->M_data->notif_stok_jml('tb_sparepart');

        $data['list_sparepart'] = $this->M_data->select('tb_sparepart');
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Sparepart';
        $this->load->view('pimpinan/sparepart/tabel_sparepart', $data);
    }

    ####################################
    //* End Data Sparepart 
    ####################################
    ####################################
    //* Data Mobil 
    ####################################

    public function tabel_mobil()
    {
        $data['list_data'] = $this->M_data->select('tb_mobil');
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Mobil';
        $this->load->view('pimpinan/mobil/tabel_mobil', $data);
    }

    ####################################
    //* End Data Mobil 
    ####################################
    ####################################
    //* Data Operator 
    ####################################

    public function tabel_operator()
    {
        $data['list_operator'] = $this->M_data->select('tb_operator');
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Operator';
        $this->load->view('pimpinan/operator/tabel_operator', $data);
    }

    ####################################
    //* End Data Operator 
    ####################################
    ####################################
    //* Data Pelanggan 
    ####################################

    public function tabel_pelanggan()
    {
        $data['list_pelanggan'] = $this->M_data->get_Plg('tb_pelanggan');
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Pelanggan';
        $this->load->view('pimpinan/pelanggan/tabel_pelanggan', $data);
    }

    public function tabel_pelanggan_blacklist()
    {
        $data['list_pelanggan_blacklist'] = $this->M_data->get_Plg_Blc('tb_pelanggan');
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Pelanggan Blacklist';
        $this->load->view('pimpinan/pelanggan/tabel_pelanggan_blacklist', $data);
    }

    public function pindah_data_pelanggan()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_pelanggan' => $uri);
        // $data['list_plg'] = $this->M_data->get_data('tb_pelanggan', $where);
        $ket_plg = 0;
        $data = array(
            'ket_plg' => $ket_plg
        );
        $this->M_data->update('tb_pelanggan', $data, $where);
        $this->session->set_flashdata('msg_sukses', 'Data Berhasil Dipindah');

        // $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        redirect(site_url('pimpinan/tabel_pelanggan_blacklist'));
    }

    public function kembalikan_pelanggan()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_pelanggan' => $uri);
        // $data['list_plg'] = $this->M_data->get_data('tb_pelanggan', $where);
        $ket_plg = 1;
        $data = array(
            'ket_plg' => $ket_plg
        );
        $this->M_data->update('tb_pelanggan', $data, $where);
        $this->session->set_flashdata('msg_sukses', 'Data Berhasil Dipindah');

        // $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        redirect(site_url('pimpinan/tabel_pelanggan'));
    }

    ####################################
    //* End Data Pelanggan 
    ####################################
    ####################################
    //* Data Unit Keluar 
    ####################################

    public function tabel_unit_keluar()
    {
        $data['list_data'] = $this->M_data->get_data_valid_penyewaan('tb_valid_penyewaan');
        // $data['total_data'] = $this->M_data->sum_pendapatan('tb_unit_penyewaan');
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Unit Sewa';
        $this->load->view('pimpinan/unit_keluar/tabel_unit_keluar', $data);
    }

    public function detail_unit_keluar($id_transaksi)
    {
        $uri = $this->uri->segment(3);
        $where = array('id_u_sewa' => $uri);
        $data['list_data'] = $this->M_data->select_data_u_keluar('tb_unit_penyewaan', $where);
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Detail Data Unit Sewa';
        $this->load->view('pimpinan/unit_keluar/detail_keluar', $data);
    }

    ####################################
    //* End Data Unit Keluar
    ####################################
    ####################################
    //* Data Unit Masuk
    ####################################
    public function tabel_unit_masuk()
    {
        $bulan = date('m');
        $tahun = date('Y');
        $label = 'Bulan ' . $bulan . ' Tahun ' .  $tahun;
        $data['pendapatan'] = $this->M_data->sum_pendapatan('tb_unit_penyewaan', $bulan, $tahun);
        $data['list_data'] = $this->M_data->get_data_valid_penyewaanMasuk('tb_valid_penyewaan');
        $data['label'] = $label;
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        // $data['total_data'] = $this->M_data->sum_pendapatan('tb_unit_penyewaan');
        $data['title'] = 'Data Unit Masuk/Kembali';
        $this->load->view('pimpinan/unit_masuk/tabel_unit_masuk', $data);
    }

    public function detail_unit_masuk($id_transaksi)
    {
        $uri = $this->uri->segment(3);
        $where = array('id_u_sewa' => $uri);
        $data['list_data'] = $this->M_data->select_data_u_masuk('tb_unit_penyewaan', $where);
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Detail Data Unit Kembali';
        $this->load->view('pimpinan/unit_masuk/detail_masuk', $data);
    }


    ####################################
    //* End Data Unit Masuk
    ####################################
    ####################################
    //* Data Jadwal Penyewaan Genset
    ####################################

    public function tabel_jdw_genset()
    {
        $data['list_data'] = $this->M_data->select_jdw_gst('tb_jadwal_genset');
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Jadwal Penyewaan Genset';
        $this->load->view('pimpinan/jdw_genset/tabel_jdw_genset', $data);
    }

    public function detail_jdw_genset()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_jadwal_genset' => $uri);
        $data['list_data'] = $this->M_data->get_jdw_gst('tb_jadwal_genset', $where);

        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Ubah Data Jadwal Penyewaan Genset';
        $this->load->view('pimpinan/jdw_genset/detail_jdw_genset', $data);
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
            $data['list_data'] = $this->M_data->select('tb_pengeluaran');
            $data['total_data'] = $this->M_data->sum_pengeluaran('tb_pengeluaran');
            $label = 'Bulan ke ...' . ' Tahun ...';
        } else {
            $data['list_data'] = $this->M_data->pengeluaran_periode('tb_pengeluaran', $bulan, $tahun);
            $data['total_data'] = $this->M_data->sum_penngeluaranPeriode('tb_pengeluaran', $bulan, $tahun);
            $label = 'Bulan ke ' . $bulan . ' Tahun ' .  $tahun;
        }
        $data['label'] = $label;

        // $data['list_data'] = $this->M_data->select('tb_pengeluaran');
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Pengeluaran';
        $this->load->view('pimpinan/pengeluaran/tabel_pengeluaran', $data);
    }

    // public function tambah_data_pengeluaran()
    // {
    //     $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
    //     $data['title'] = 'Tambah Data Pengeluaran';
    //     $this->load->view('pimpinan/pengeluaran/tambah_pengeluaran', $data);
    // }

    public function proses_tambah_pengeluaran()
    {
        $this->form_validation->set_rules('tgl_pengeluaran', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('pengeluaran', 'Keterangan Pengeluaran', 'trim|required');
        $this->form_validation->set_rules('biaya_pengeluaran', 'Biaya Pengeluaran', 'trim|required');

        if ($this->form_validation->run() === TRUE) {
            $tgl_pengeluaran = $this->input->post('tgl_pengeluaran', TRUE);
            $pengeluaran = $this->input->post('pengeluaran', TRUE);
            $biaya_pengeluaran = $this->input->post('biaya_pengeluaran', TRUE);

            $data = array(
                'tgl_pengeluaran' => $tgl_pengeluaran,
                'pengeluaran' => $pengeluaran,
                'biaya_pengeluaran' => $biaya_pengeluaran
            );
            $this->M_data->insert('tb_pengeluaran', $data);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Disimpan');
            redirect(site_url('pimpinan/tabel_pengeluaran'));
        } else {
            $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Tambah Data Pengeluaran';
            $this->load->view('pimpinan/pengeluaran/tabel_pengeluaran', $data);
        }
    }

    // public function update_data_pengeluaran()
    // {
    //     $uri = $this->uri->segment(3);
    //     $where = array('id_pengeluaran' => $uri);
    //     $data['list_data'] = $this->M_data->get_data('tb_pengeluaran', $where);
    //     $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
    //     $data['title'] = 'Ubah Data Pengeluaran';
    //     $this->load->view('pimpinan/pengeluaran/update_pengeluaran', $data);
    // }

    public function proses_edit_pengeluaran()
    {
        $this->form_validation->set_rules('tgl_pengeluaran', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('pengeluaran', 'Keterangan Pengeluaran', 'trim|required');
        $this->form_validation->set_rules('biaya_pengeluaran', 'Biaya Pengeluaran', 'trim|required');

        if ($this->form_validation->run() === TRUE) {

            $id_pengeluaran = $this->input->post('id_pengeluaran', TRUE);
            $tgl_pengeluaran = $this->input->post('tgl_pengeluaran', TRUE);
            $pengeluaran = $this->input->post('pengeluaran', TRUE);
            $biaya_pengeluaran = $this->input->post('biaya_pengeluaran', TRUE);

            $where = array('id_pengeluaran' => $id_pengeluaran);
            $data = array(
                'tgl_pengeluaran' => $tgl_pengeluaran,
                'pengeluaran' => $pengeluaran,
                'biaya_pengeluaran' => $biaya_pengeluaran
            );
            $this->M_data->update('tb_pengeluaran', $data, $where);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Diubah');
            redirect(site_url('pimpinan/tabel_pengeluaran'));
        } else {
            $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Ubah Data Pengeluaran';
            $this->load->view('pimpinan/pengeluaran/tabel_pengeluaran', $data);
        }
    }

    public function hapus_pengeluaran()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_pengeluaran' => $uri);
        $this->M_data->delete('tb_pengeluaran', $where);
        $this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
        redirect(site_url('pimpinan/tabel_pengeluaran'));
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
            $data['get_data'] = $this->M_data->get_data_valid_penyewaanMasuk('tb_valid_penyewaan');
            $data['list_data'] = $this->M_data->get_data_pemasukan('tb_pendapatan');
            $data['total_data'] = $this->M_data->sum_pemasukan('tb_pendapatan');
            $label = 'Bulan ke ...' . ' Tahun ...';
        } else {
            $data['get_data'] = $this->M_data->get_data_valid_penyewaanMasuk('tb_valid_penyewaan');
            $data['list_data'] = $this->M_data->pemasukan_periode('tb_pendapatan', $bulan, $tahun);
            $data['total_data'] = $this->M_data->sum_pendapatanMasuk('tb_pendapatan', $bulan, $tahun);
            $label = 'Bulan ke ' . $bulan . ' Tahun ' .  $tahun;
        }
        // $data['list_data'] = $this->M_data->get_data_u_keluar('tb_unit_penyewaan');
        // $data['list_data'] = $this->M_data->pemasukan_periode('tb_unit_penyewaan', $bulan, $tahun);

        // $data['total_data'] = $this->M_data->sum_pendapatan('tb_unit_penyewaan');
        $data['label'] = $label;
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Pendapatan';
        $this->load->view('pimpinan/pemasukan/tabel_pemasukan', $data);
    }

    // public function tambah_pemasukan()
    // {
    //     $data['list_data'] = $this->M_data->get_data_u_masuk('tb_unit_penyewaan');
    //     $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
    //     $data['title'] = 'Tambah Data Pendapatan';
    //     $this->load->view('pimpinan/pemasukan/tambah_pemasukan', $data);
    // }

    public function proses_tambah_pemasukan()
    {

        $this->form_validation->set_rules('id_u_sewa', 'ID Transaksi', 'trim|required|is_unique[tb_pendapatan.id_u_sewa]');
        $this->form_validation->set_rules('tgl_update', 'Tanggal Update', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

        if ($this->form_validation->run() === TRUE) {
            $id_u_sewa = $this->input->post('id_u_sewa', TRUE);
            $tgl_update = $this->input->post('tgl_update', TRUE);
            $keterangan = $this->input->post('keterangan', TRUE);

            $data = array(
                'id_u_sewa' => $id_u_sewa,
                'tgl_update' => $tgl_update,
                'keterangan' => $keterangan
            );
            $this->M_data->insert('tb_pendapatan', $data);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Disimpan');
            redirect(site_url('pimpinan/tabel_pemasukan'));
        } else {
            $data['list_data'] = $this->M_data->get_data_u_masuk('tb_unit_penyewaan');
            $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Tambah Data Pendapatan';
            // $this->load->view('pimpinan/pemasukan/tambah_pemasukan', $data);
            $this->load->view('pimpinan/pemasukan/tabel_pemasukan', $data);
        }
    }

    // public function edit_pemasukan()
    // {
    //     $uri = $this->uri->segment(3);
    //     $where = array('id_pendapatan' => $uri);
    //     $data['edit_data'] = $this->M_data->get_data('tb_pendapatan', $where);
    //     $data['list_data'] = $this->M_data->get_data_u_masuk('tb_unit_penyewaan');
    //     $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
    //     $data['title'] = 'Ubah Data Pendapatan';
    //     $this->load->view('pimpinan/pemasukan/edit_pemasukan', $data);
    // }

    public function proses_edit_pemasukan()
    {

        $this->form_validation->set_rules('id_u_sewa', 'ID Transaksi', 'trim|required');
        $this->form_validation->set_rules('tgl_update', 'Tanggal Update', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

        if ($this->form_validation->run() === TRUE) {
            $id_pendapatan = $this->input->post('id_pendapatan', TRUE);
            $id_u_sewa = $this->input->post('id_u_sewa', TRUE);
            $tgl_update = $this->input->post('tgl_update', TRUE);
            $keterangan = $this->input->post('keterangan', TRUE);

            $where = array('id_pendapatan' => $id_pendapatan);
            $data = array(
                'id_u_sewa' => $id_u_sewa,
                'tgl_update' => $tgl_update,
                'keterangan' => $keterangan
            );
            $this->M_data->update('tb_pendapatan', $data, $where);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Diubah');
            redirect(site_url('pimpinan/tabel_pemasukan'));
        } else {
            $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Ubah Data Pendapatan';
            // $this->load->view('pimpinan/pemasukan/edit_pemasukan', $data);
            $this->load->view('pimpinan/pemasukan/tabel_pemasukan', $data);
        }
    }

    public function hapus_pemasukan()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_pendapatan' => $uri);
        $this->M_data->delete('tb_pendapatan', $where);
        $this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
        redirect(site_url('pimpinan/tabel_pemasukan'));
    }
    ####################################
    //* End Pemasukan
    ####################################
    ####################################
    //* Laporan
    ####################################

    public function laporan()
    {
        $data['list_sewa'] = $this->M_data->get_data_valid_penyewaanMasuk('tb_valid_penyewaan');
        $data['list_perbaikan'] = $this->M_data->get_data_service('tb_serv_genset');
        $data['list_genset'] = $this->M_data->select('tb_genset');
        $data['list_operator'] = $this->M_data->select('tb_operator');
        $data['list_pelanggan'] = $this->M_data->get_Plg('tb_pelanggan');
        $data['list_pelanggan_blacklist'] = $this->M_data->get_Plg_Blc('tb_pelanggan');

        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
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

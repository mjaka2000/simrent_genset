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
        $data['numOut'] = $this->M_data->notif_u_keluarJml('tb_unit_penyewaan', $tgl);
        $data['notifOut'] = $this->M_data->notif_u_keluar('tb_unit_penyewaan', $tgl);
        $data['stokBarangKeluar'] = $this->M_data->numrows_where_uMasuk('tb_unit_penyewaan');
        $data['dataUser'] = $this->M_data->numrows('tb_user');
        $data['dataPelanggan'] = $this->M_data->numrows('tb_pelanggan');
        $data['dataOperator'] = $this->M_data->numrows('tb_operator');
        $data['dataServGenset'] = $this->M_data->numrows('tb_serv_genset');
        $data['dataStokSparepart'] = $this->M_data->numrows('tb_sparepart');
        $data['dataPengeluaran'] = $this->M_data->numrows('tb_pengeluaran');
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
        $data['list_data'] = $this->M_data->select_ServGstAcc('tb_serv_gst_acc');
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Perbaikan Genset Disetujui';
        $this->load->view('pimpinan/service_gensetAcc/tabel_service_gensetAcc', $data);
    }

    public function update_service_genset_acc()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_serv_gst_acc' => $uri);
        $data['list_data'] = $this->M_data->get_ServGstAcc('tb_serv_gst_acc', $where);
        $data['list_perbaikan'] = $this->M_data->get_Serv('tb_serv_genset');
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Ubah Perbaikan Genset Disetujui';
        $this->load->view('pimpinan/service_gensetAcc/ubah_service_gensetAcc', $data);
    }

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
            $this->load->view('pimpinan/service_gensetAcc/ubah_service_gensetAcc', $data);
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
    // public function pindah_data_pelanggan()
    // {
    //     $uri = $this->uri->segment(3);
    //     $where = array('id_pelanggan' => $uri);
    //     $data['list_plg'] = $this->M_data->get_data('tb_pelanggan', $where);
    //     $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
    //     $data['title'] = 'Pindah Data Pelanggan';
    //     $this->load->view('pimpinan/pelanggan/pindah_pelanggan_blacklist', $data);
    // }

    // public function proses_blacklist_pelanggan()
    // {
    //     $id = $this->input->post('id_pelanggan', TRUE);
    //     $this->form_validation->set_rules('nama_plg_blk', 'Nama', 'trim|required');
    //     $this->form_validation->set_rules('alamat_plg_blk', 'Alamat', 'trim|required');
    //     $this->form_validation->set_rules('nohp_plg_blk', 'No Hp', 'trim|required');
    //     $this->form_validation->set_rules('jk_plg_blk', 'Jenis Kelamin', 'trim|required');
    //     $this->form_validation->set_rules('namaperusahaan_plg_blk', 'Nama Perusahaan', 'trim|required');
    //     $this->form_validation->set_rules('tglupdate_plg_blk', 'Tanggal Update', 'trim|required');
    //     if ($this->form_validation->run() === TRUE) {
    //         $nama = $this->input->post('nama_plg_blk', TRUE);
    //         $alamat = $this->input->post('alamat_plg_blk', TRUE);
    //         $no_hp = $this->input->post('nohp_plg_blk', TRUE);
    //         $jenis_kelamin = $this->input->post('jk_plg_blk', TRUE);
    //         $nama_perusahaan = $this->input->post('namaperusahaan_plg_blk', TRUE);
    //         $tgl_update = $this->input->post('tglupdate_plg_blk', TRUE);

    //         $where = array('id_pelanggan' => $id);
    //         $data = array(
    //             'nama_plg_blk' => $nama,
    //             'alamat_plg_blk' => $alamat,
    //             'nohp_plg_blk' => $no_hp,
    //             'jk_plg_blk' => $jenis_kelamin,
    //             'namaperusahaan_plg_blk' => $nama_perusahaan,
    //             'tglupdate_plg_blk' => $tgl_update
    //         );
    //         $this->M_data->insert('tb_pelanggan_blacklist', $data);
    //         $this->session->set_flashdata('msg_sukses', 'Data Berhasil Dipindah');
    //         $this->M_data->delete('tb_pelanggan', $where);
    //         redirect(site_url('pimpinan/tabel_pelanggan_blacklist'));
    //     } else {
    //         $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
    //         $data['title'] = 'Pindah Data Pelanggan';
    //         $this->load->view('pimpinan/pelanggan/pindah_pelanggan_blacklist');
    //     }
    // }
    ####################################
    //* End Data Pelanggan 
    ####################################
    ####################################
    //* Data Unit Keluar 
    ####################################

    public function tabel_unit_keluar()
    {
        $data['list_data'] = $this->M_data->get_data_u_keluar('tb_unit_penyewaan');
        $data['total_data'] = $this->M_data->sum_pendapatan('tb_unit_penyewaan');
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

    public function unit_keluar_update()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_u_sewa' => $uri);
        $data['data_unit_update'] = $this->M_data->get_data('tb_unit_penyewaan', $where);
        $data['list_mobil'] = $this->M_data->select('tb_mobil');
        $data['list_genset'] = $this->M_data->select('tb_genset');
        $data['list_pelanggan'] = $this->M_data->select('tb_pelanggan');
        $data['list_operator'] = $this->M_data->select('tb_operator');
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Perpanjang Pemakaian Genset';
        $this->load->view('pimpinan/unit_keluar/perpanjang_unit', $data);
    }

    public function proses_perpanjangan()
    {
        $this->form_validation->set_rules('jumlah_hari', 'Jumlah Hari', 'trim|required');
        $id_u_sewa       = $this->input->post('id_u_sewa', TRUE);

        if ($this->form_validation->run() === TRUE) {
            $stok_gd           = $this->input->post('stok_gd', TRUE);
            $stok_pj           = $this->input->post('stok_pj', TRUE);

            $tanggal_keluar          = $this->input->post('tanggal_keluar', TRUE);
            $tanggal_masuk    = $this->input->post('tanggal_masuk', TRUE);
            $lokasi           = $this->input->post('lokasi', TRUE);
            $id_operator    = $this->input->post('id_operator', TRUE);
            $id_pelanggan   = $this->input->post('id_pelanggan', TRUE);
            $id_genset      = $this->input->post('id_genset', TRUE);
            $id_mobil            = $this->input->post('id_mobil', TRUE);
            $tambahan         = $this->input->post('tambahan', TRUE);
            $jumlah_hari      = $this->input->post('jumlah_hari', TRUE);
            $jumlah_hari_lama = $this->input->post('jumlah_hari_lama', TRUE);
            $total            = $this->input->post('total', TRUE);

            $status = 1;

            $tanggal_masuk_new    = date('Y-m-d', strtotime($tanggal_keluar . "+" . $jumlah_hari . " days"));
            // $total = $harga  * $jumlah_hari;
            if ($tanggal_masuk == $tanggal_masuk_new) {
                $tanggal_masuk_up = $tanggal_masuk;
            } else {
                $tanggal_masuk_up = $tanggal_masuk_new;
            }

            // if($jumlah_hari_lama == $jumlah_hari){
            //   $status = 1;
            // }else{
            //   $status = 0;
            // }

            $where = array('id_u_sewa' => $id_u_sewa);
            $data = array(
                'id_u_sewa'    => $id_u_sewa,
                'tanggal_keluar'          => $tanggal_keluar,
                'tanggal_masuk'   => $tanggal_masuk_up,
                'lokasi'           => $lokasi,
                'id_operator'    => $id_operator,
                'id_pelanggan'   => $id_pelanggan,
                'id_genset'      => $id_genset,
                'id_mobil'            => $id_mobil,
                'tambahan'         => $tambahan,
                'jumlah_hari'      => $jumlah_hari,
                'total'            => $total,
                'status'           => $status
            );

            $this->M_data->update('tb_unit_penyewaan', $data, $where);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Diubah');
            // $this->M_data->delete('tb_barang_masuk',$where);
            redirect(site_url('pimpinan/tabel_unit_keluar'));
        } else {
            $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Perpanjang Pemakaian Genset';
            $this->load->view('pimpinan/unit_keluar/perpanjang_unit', $data);
        }
    }

    public function unit_masuk()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_u_sewa' => $uri);
        $data['data_unit_update'] = $this->M_data->get_data('tb_unit_penyewaan', $where);
        $data['list_mobil'] = $this->M_data->select('tb_mobil');
        $data['list_genset'] = $this->M_data->select('tb_genset');
        $data['list_pelanggan'] = $this->M_data->select('tb_pelanggan');
        $data['list_operator'] = $this->M_data->select('tb_operator');
        $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Konfirmasi Genset Masuk';
        $this->load->view('pimpinan/unit_keluar/update_unit_masuk', $data);
    }

    public function proses_data_masuk()
    {
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'trim|required');

        $id_u_sewa       = $this->input->post('id_u_sewa', TRUE);

        if ($this->form_validation->run() === TRUE) {
            $stok_gd           = $this->input->post('stok_gd', TRUE);
            $stok_pj           = $this->input->post('stok_pj', TRUE);
            $id_transaksi     = $this->input->post('id_transaksi', TRUE);

            $tanggal_keluar          = $this->input->post('tanggal_keluar', TRUE);
            $tanggal_masuk    = $this->input->post('tanggal_masuk', TRUE);
            $lokasi           = $this->input->post('lokasi', TRUE);
            $id_operator    = $this->input->post('id_operator', TRUE);
            $id_pelanggan   = $this->input->post('id_pelanggan', TRUE);
            $id_genset      = $this->input->post('id_genset', TRUE);
            $id_mobil            = $this->input->post('id_mobil', TRUE);
            $tambahan         = $this->input->post('tambahan', TRUE);
            $jumlah_hari      = $this->input->post('jumlah_hari', TRUE);
            $jumlah_hari_lama = $this->input->post('jumlah_hari_lama', TRUE);
            $total            = $this->input->post('total', TRUE);

            $status_b = 0;

            // if($jumlah_hari_lama == $jumlah_hari){
            //   $status = 1;
            // }else{
            //   $status = 0;
            // }

            $where = array('id_u_sewa' => $id_u_sewa);
            $data = array(
                'id_transaksi'    => $id_transaksi,
                'tanggal_keluar'          => $tanggal_keluar,
                'tanggal_masuk'   => $tanggal_masuk,
                'lokasi'           => $lokasi,
                'id_operator'    => $id_operator,
                'id_pelanggan'   => $id_pelanggan,
                'id_genset'      => $id_genset,
                'id_mobil'            => $id_mobil,
                'tambahan'         => $tambahan,
                'jumlah_hari'      => $jumlah_hari,
                'total'            => $total,
                'status'           => $status_b
            );
            // $stok_gd_new = ++$stok_gd;
            // $stok_pj_new = --$stok_pj;
            $status_gst = 0;
            $status_op = 0;
            $status_plg = 0;
            $status = 0;

            $this->M_data->update_status('tb_unit_penyewaan', $id_u_sewa, $status);
            $this->M_data->update_status_gst('tb_genset', $id_genset, $status_gst);
            $this->M_data->update_status_op('tb_operator', $id_operator, $status_op);
            $this->M_data->update_status_plg('tb_pelanggan', $id_pelanggan, $status_plg);
            // $this->M_data->menambah_kembali('tb_genset', $id_genset, $stok_gd_new);
            // $this->M_data->mengurangi_kembali('tb_genset', $id_genset, $stok_pj_new);
            // $this->M_data->insert('tb_unit_masuk', $data);
            $this->session->set_flashdata('msg_sukses', 'Data Status diubah menjadi Masuk (Kembali)');
            // $this->M_data->delete('tb_barang_masuk',$where);
            redirect(site_url('pimpinan/tabel_unit_masuk'));
        } else {
            // $data['title'] = 'Update Genset Masuk';
            $data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Konfirmasi Genset Masuk';
            $this->load->view('pimpinan/unit_keluar/update_unit_masuk', $data);
        }
    }
    ####################################
    //* End Data Unit Keluar
    ####################################
    ####################################
    //* Data Unit Masuk
    ####################################
    public function tabel_unit_masuk()
    {
        $data = array(
            'list_mobil' => $this->M_data->select('tb_mobil'),
            'list_data' => $this->M_data->get_data_u_masuk('tb_unit_penyewaan'),
            'avatar'    => $this->M_data->get_avatar('tb_user', $this->session->userdata('name'))
        );
        $data['total_data'] = $this->M_data->sum_pendapatan('tb_unit_penyewaan');
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
            $data['list_data'] = $this->M_data->get_data_pemasukan('tb_pendapatan');
            $data['total_data'] = $this->M_data->sum_pemasukan('tb_pendapatan');
            $label = 'Bulan ke ...' . ' Tahun ...';
        } else {
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
    ####################################
    //* End Pemasukan
    ####################################
    ####################################
    //* Laporan
    ####################################

    public function laporan()
    {
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

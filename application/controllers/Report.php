<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin');
    }

    public function cetak_jdw_genset()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_u_keluar' => $uri);
        $data['list_data'] = $this->M_admin->select_data_u_keluar('tb_unit_keluar', $where);
        $data['title'] = 'Laporan Jadwal Penyewaan Genset';
        $this->load->view('admin/report/jdw_genset/rep_jdw_genset', $data);
    }

    public function cetak_jdw_gensetAll()
    {
        $data['list_data'] = $this->M_admin->get_data_u_keluar('tb_unit_keluar');
        $data['title'] = 'Laporan Jadwal Penyewaan Genset';
        $this->load->view('admin/report/jdw_genset/rep_jdw_gensetAll', $data);
    }

    public function cetak_pengeluaran_periode()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        if (empty($bulan) or empty($tahun)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['list_data'] = $this->M_admin->select('tb_pengeluaran');
            $data['total_data'] = $this->M_admin->sum_pengeluaran('tb_pengeluaran');
            $label = 'Bulan ...' . ' Tahun ...';
        } else {
            $data['list_data'] = $this->M_admin->pengeluaran_periode('tb_pengeluaran', $bulan, $tahun);
            $data['total_data'] = $this->M_admin->sum_penngeluaranPeriode('tb_pengeluaran', $bulan, $tahun);
            $label = 'Bulan ' . $bulan . ' Tahun ' .  $tahun;
        }
        $data['label'] = $label;
        $data['title'] = 'Laporan Pengeluaran';
        $this->load->view('admin/report/pengeluaran/rep_pengeluaran', $data);
    }

    public function cetak_pemasukan_periode()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        if (empty($bulan) or empty($tahun)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['list_data'] = $this->M_admin->get_data_pemasukan('tb_pendapatan');
            $data['total_data'] = $this->M_admin->sum_pemasukan('tb_pendapatan');
            $label = 'Bulan ...' . ' Tahun ...';
        } else {
            $data['list_data'] = $this->M_admin->pemasukan_periode('tb_pendapatan', $bulan, $tahun);
            $data['total_data'] = $this->M_admin->sum_pendapatanMasuk('tb_pendapatan', $bulan, $tahun);
            $label = 'Bulan ' . $bulan . ' Tahun ' .  $tahun;
        }
        $data['label'] = $label;
        $data['title'] = 'Laporan Pendapatan';
        $this->load->view('admin/report/pemasukan/rep_pendapatan', $data);
    }

    public function cetak_penyewaan()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        if (empty($bulan) or empty($tahun)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['list_data'] = $this->M_admin->gsel_data_u_keluar('tb_unit_keluar');
            $label = 'Bulan ...' . ' Tahun ...';
        } else {
            $data['list_data'] = $this->M_admin->grep_data_u_keluar('tb_unit_keluar', $bulan, $tahun);
            $label = 'Bulan ' . $bulan . ' Tahun ' .  $tahun;
        }
        $data['label'] = $label;
        $data['title'] = 'Laporan Penyewaan ';
        $this->load->view('admin/report/unit_keluar/rep_unit_keluar', $data);
    }

    public function cetak_serv_gensetAll()
    {
        $data['list_data'] = $this->M_admin->get_data_service('tb_serv_genset');
        $data['title'] = 'Laporan Perbaikan Genset';
        $this->load->view('admin/report/service_genset/rep_service_genset', $data);
    }

    public function cetak_Pelanggan()
    {
        $data['list_data'] = $this->M_admin->select('tb_pelanggan');
        $data['title'] = 'Laporan Data Pelanggan';
        $this->load->view('admin/report/pelanggan/rep_pelanggan', $data);
    }

    public function cetak_Pelanggan_blacklist()
    {
        $data['list_pelanggan_blacklist'] = $this->M_admin->select('tb_pelanggan_blacklist');
        $data['title'] = 'Laporan Data Pelanggan Blacklist';
        $this->load->view('admin/report/pelanggan/rep_pelanggan_blacklist', $data);
    }

    public function cetak_sparepart()
    {
        $data['list_sparepart'] = $this->M_admin->select('tb_sparepart');
        $data['title'] = 'Laporan Data Sparepart';
        $this->load->view('admin/report/sparepart/rep_sparepart', $data);
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Pdf');
        $this->load->model('M_data');
    }

    public function cetak_jdw_genset()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_u_keluar' => $uri);
        $data['list_data'] = $this->M_data->select_data_u_keluar('tb_unit_keluar', $where);
        $data['title'] = 'Laporan Jadwal Penyewaan Genset';
        $this->load->view('report/jdw_genset/rep_jdw_genset', $data);
    }

    public function cetak_jdw_gensetAll()
    {
        $data['list_data'] = $this->M_data->get_data_u_keluar('tb_unit_keluar');
        $data['title'] = 'Laporan Jadwal Penyewaan Genset';
        $this->load->view('report/jdw_genset/rep_jdw_gensetAll', $data);
    }

    public function cetak_pengeluaran_periode()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        if (empty($bulan) or empty($tahun)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['list_data'] = $this->M_data->select('tb_pengeluaran');
            $data['total_data'] = $this->M_data->sum_pengeluaran('tb_pengeluaran');
            $label = 'Bulan ...' . ' Tahun ...';
        } else {
            $data['list_data'] = $this->M_data->pengeluaran_periode('tb_pengeluaran', $bulan, $tahun);
            $data['total_data'] = $this->M_data->sum_penngeluaranPeriode('tb_pengeluaran', $bulan, $tahun);
            $label = 'Bulan ' . $bulan . ' Tahun ' .  $tahun;
        }
        $data['label'] = $label;
        $data['title'] = 'Laporan Pengeluaran';
        $this->load->view('report/pengeluaran/rep_pengeluaran', $data);
    }

    public function cetak_pemasukan_periode()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        if (empty($bulan) or empty($tahun)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['list_data'] = $this->M_data->get_data_pemasukan('tb_pendapatan');
            $data['total_data'] = $this->M_data->sum_pemasukan('tb_pendapatan');
            $label = 'Bulan ...' . ' Tahun ...';
        } else {
            $data['list_data'] = $this->M_data->pemasukan_periode('tb_pendapatan', $bulan, $tahun);
            $data['total_data'] = $this->M_data->sum_pendapatanMasuk('tb_pendapatan', $bulan, $tahun);
            $label = 'Bulan ' . $bulan . ' Tahun ' .  $tahun;
        }
        $data['label'] = $label;
        $data['title'] = 'Laporan Pendapatan';
        $this->load->view('report/pemasukan/rep_pendapatan', $data);
    }

    public function cetak_penyewaan()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        if (empty($bulan) or empty($tahun)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['list_data'] = $this->M_data->gsel_data_u_keluar('tb_unit_masuk');
            $label = 'Bulan ...' . ' Tahun ...';
        } else {
            $data['list_data'] = $this->M_data->grep_data_u_keluar('tb_unit_masuk', $bulan, $tahun);
            $label = 'Bulan ' . $bulan . ' Tahun ' .  $tahun;
        }
        $data['label'] = $label;
        $data['title'] = 'Laporan Penyewaan ';
        $this->load->view('report/unit_keluar/rep_unit_keluar', $data);
    }

    public function cetak_serv_gensetAll()
    {
        $data['list_data'] = $this->M_data->get_data_service('tb_serv_genset');
        $data['title'] = 'Laporan Perbaikan Genset';
        $this->load->view('report/service_genset/rep_service_genset', $data);
    }

    public function cetak_Pelanggan()
    {
        $data['list_data'] = $this->M_data->get_Plg('tb_pelanggan');
        $data['title'] = 'Laporan Data Pelanggan';
        $this->load->view('report/pelanggan/rep_pelanggan', $data);
    }

    public function cetak_Pelanggan_blacklist()
    {
        $data['list_pelanggan_blacklist'] = $this->M_data->get_Plg_Blc('tb_pelanggan');
        $data['title'] = 'Laporan Data Pelanggan Blacklist';
        $this->load->view('report/pelanggan/rep_pelanggan_blacklist', $data);
    }

    public function cetak_sparepart()
    {
        $data['list_sparepart'] = $this->M_data->select_sparepart('tb_sparepart');
        $data['title'] = 'Laporan Data Sparepart';
        $this->load->view('report/sparepart/rep_sparepart', $data);
    }

    public function cetak_penyewaan_detail()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_u_masuk' => $uri);
        $data['list_data'] = $this->M_data->select_data_u_masuk('tb_unit_masuk', $where);
        $data['title'] = 'Laporan Detail Data Penyewaan Genset';
        $this->load->view('report/unit_keluar/rep_unit_keluar_detail', $data);
    }

    public function cetak_penyewaan_detailOut()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_u_keluar' => $uri);
        $data['list_data'] = $this->M_data->select_data_u_keluar('tb_unit_keluar', $where);
        $data['title'] = 'Laporan Detail Data Penyewaan Genset';
        $this->load->view('penyewa/report/rep_unit_keluar_detail', $data);
    }

    public function cetak_penyewaan_detailPlg()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_u_masuk' => $uri);
        $data['list_data'] = $this->M_data->select_data_u_masuk('tb_unit_masuk', $where);
        $data['title'] = 'Laporan Detail Data Penyewaan Genset';
        $this->load->view('penyewa/report/rep_unit_keluar_detail', $data);
    }

    public function cetak_service_detail()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_perbaikan_gst' => $uri);
        $data['list_data'] = $this->M_data->get_detail_perbaikan('tb_serv_genset', $where);
        $data['detail_perbaikan'] = $this->M_data->detail_perbaikan('tb_detail_serv', $where);
        $data['title'] = 'Laporan Detail Perbaikan Genset';
        $this->load->view('report/service_genset/rep_service_genset_detail', $data);
    }

    public function cetak_cetak_penyewaan_usr()
    {
        $this->load->model('M_penyewa');
        $data['list_data'] = $this->M_penyewa->sel_data_u_keluar('tb_unit_keluar');
        $data['title'] = 'Laporan Data Penyewaan';
        $this->load->view('penyewa/report/rep_unit_keluar', $data);
    }
}

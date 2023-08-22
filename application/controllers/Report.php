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
        $where = array('id_jadwal_genset' => $uri);
        $data['list_data'] = $this->M_data->get_jdw_gst('tb_jadwal_genset', $where);
        $data['title'] = 'Laporan Jadwal Penyewaan Genset';
        $this->load->view('report/jdw_genset/rep_jdw_genset', $data);
    }

    public function cetak_jdw_gensetAll()
    {
        $data['list_data'] = $this->M_data->select_jdw_gst('tb_jadwal_genset');
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

    public function cetak_grafik_pemasukan_periode()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        if (empty($bulan) or empty($tahun)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['pendapatanChart'] = $this->M_data->chart_pendapatanMasukAll('tb_pendapatan');
            $data['total_data'] = $this->M_data->sum_pemasukan('tb_pendapatan');
            $label = 'Bulan ...' . ' Tahun ...';
        } else {
            $data['pendapatanChart'] = $this->M_data->chart_pendapatanMasuk('tb_pendapatan', $bulan, $tahun);
            $data['total_data'] = $this->M_data->sum_pendapatanMasuk('tb_pendapatan', $bulan, $tahun);
            $label = 'Bulan ' . $bulan . ' Tahun ' .  $tahun;
        }
        $data['label'] = $label;
        $data['title'] = 'Laporan Grafik Pendapatan';
        $this->load->view('report/pemasukan/rep_grafik_pendapatan', $data);
    }

    public function cetak_penyewaan()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        if (empty($bulan) or empty($tahun)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['list_data'] = $this->M_data->gsel_data_u_keluar('tb_valid_penyewaan');
            $label = 'Bulan ...' . ' Tahun ...';
        } else {
            $data['list_data'] = $this->M_data->grep_data_u_keluar('tb_valid_penyewaan', $bulan, $tahun);
            $label = 'Bulan ' . $bulan . ' Tahun ' .  $tahun;
        }
        $data['label'] = $label;
        $data['title'] = 'Laporan Penyewaan ';
        $this->load->view('report/unit_keluar/rep_unit_keluar', $data);
    }

    public function cetak_PerbaikanFilter()
    {
        $genset = $this->input->get('genset');
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        if (empty($bulan) or empty($tahun) or empty($genset)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['list_data'] = $this->M_data->get_data_service('tb_serv_genset');
            $label = 'Genset Bulan ...' . ' Tahun ...';
        } else {
            $data['list_data'] = $this->M_data->filter_data_service('tb_serv_genset', $genset, $bulan, $tahun);
            $label = 'Genset ' . $genset . ' Bulan ' . $bulan . ' Tahun ' .  $tahun;
        }
        $data['label'] = $label;
        $data['title'] = 'Laporan Perbaikan Genset';
        $this->load->view('report/service_genset/rep_service_genset', $data);
    }

    public function cetak_serviceGensetAccFilterUnit()
    {
        $genset = $this->input->get('genset');
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        if (empty($bulan) or empty($tahun) or empty($genset)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['list_data'] = $this->M_data->select_ServGstAcc('tb_serv_gst_acc');

            $label = 'Genset Bulan ...' . ' Tahun ...';
        } else {
            $data['list_data'] = $this->M_data->filter_data_serviceAccUnit('tb_serv_gst_acc', $genset, $bulan, $tahun);
            $label = 'Genset ' . $genset . ' Bulan ' . $bulan . ' Tahun ' .  $tahun;
        }
        $data['label'] = $label;
        $data['title'] = 'Laporan Perbaikan Genset Disetujui';
        $this->load->view('report/service_gensetAcc/rep_service_gensetAcc', $data);
    }

    public function cetak_JadwalGensetFilter()
    {
        $genset = $this->input->get('genset');
        $operator = $this->input->get('operator');
        // $tahun = $this->input->get('tahun');
        // if (empty($operator) or empty($genset)) {             
        //     $data['list_data'] = $this->M_data->select_jdw_gst('tb_jadwal_genset');
        if (empty($operator)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['list_data'] = $this->M_data->filter_JadwalGenset('tb_jadwal_genset', $genset, $operator);

            // $label = 'Genset Bulan ...' . ' Tahun ...';
            // } elseif (empty($operator)) {
            // $data['list_data'] = $this->M_data->filter_JadwalGenset('tb_jadwal_genset', $genset, $operator);
            // $label = 'Genset ' . $genset . ' Bulan ' . $bulan . ' Tahun ' .  $tahun;
        } else {
            $data['list_data'] = $this->M_data->filter_JadwalGenset('tb_jadwal_genset', $genset, $operator);
        }
        // $data['label'] = $label;
        $data['title'] = 'Laporan Jadwal Penyewaan Genset';
        $this->load->view('report/jdw_genset/rep_jdw_gensetAll', $data);
    }

    public function cetak_PelangganFilter()
    {
        $pelanggan = $this->input->get('pelanggan');

        if (empty($pelanggan)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['list_data'] = $this->M_data->get_Plg('tb_pelanggan');

            // $label = 'Genset Bulan ...' . ' Tahun ...';

        } else {
            $data['list_data'] = $this->M_data->filter_Pelanggan('tb_pelanggan', $pelanggan);
        }
        // $data['label'] = $label;
        $data['title'] = 'Laporan Data Pelanggan';
        $this->load->view('report/pelanggan/rep_pelanggan', $data);
    }

    public function cetak_PelangganBlacklistFilter()
    {
        $pelangganBlacklist = $this->input->get('pelangganBlacklist');

        if (empty($pelangganBlacklist)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['list_pelanggan_blacklist'] = $this->M_data->get_Plg_Blc('tb_pelanggan');

            // $label = 'Genset Bulan ...' . ' Tahun ...';

        } else {
            $data['list_pelanggan_blacklist'] = $this->M_data->cetak_PelangganBlacklistFilter('tb_pelanggan', $pelangganBlacklist);
        }
        // $data['label'] = $label;
        $data['title'] = 'Laporan Data Pelanggan Blacklist';
        $this->load->view('report/pelanggan/rep_pelanggan_blacklist', $data);
    }

    public function cetak_sparepartFilter()
    {
        // $this->form_validation->set_rules('stok', 'Stok', 'less_than[5]');
        // if ($this->form_validation->run() === TRUE) {

        $stok = $this->input->get('stok');

        if (empty($stok)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['list_sparepart'] = $this->M_data->select_sparepart('tb_sparepart');

            // $label = 'Genset Bulan ...' . ' Tahun ...';

        } else {
            $data['list_sparepart'] = $this->M_data->select_sparepartFilter('tb_sparepart', $stok);
        }
        // $data['label'] = $label;
        $data['title'] = 'Laporan Data Sparepart';
        $this->load->view('report/sparepart/rep_sparepart', $data);
        // }
    }

    public function cetak_serv_gensetAll()
    {
        $label = 'Genset Bulan ...' . ' Tahun ...';
        $data['label'] = $label;
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

    public function cetak_penyewaan_detail($where)
    {
        // $uri = $this->uri->segment(3);
        // $where = array('id_u_sewa' => $uri);
        $data['list_data'] = $this->M_data->det_data_valid_penyewaanMasuk('tb_valid_penyewaan', $where);
        $data['title'] = 'Laporan Detail Data Penyewaan Genset';
        $this->load->view('report/unit_keluar/rep_unit_keluar_detail', $data);
    }

    public function cetak_penyewaan_detailOut()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_u_sewa' => $uri);
        $data['list_data'] = $this->M_data->select_data_u_keluar('tb_unit_penyewaan', $where);
        $data['title'] = 'Laporan Detail Data Penyewaan Genset';
        $this->load->view('penyewa/report/rep_unit_keluar_detail', $data);
    }

    public function cetak_penyewaan_detailPlg()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_u_sewa' => $uri);
        $data['list_data'] = $this->M_data->select_data_u_masuk('tb_unit_penyewaan', $where);
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

    public function cetak_service_genset_acc()
    {
        $data['list_data'] = $this->M_data->select_ServGstAcc('tb_serv_gst_acc');
        $data['title'] = 'Laporan Perbaikan Genset Disetujui';
        $this->load->view('report/service_gensetAcc/rep_service_gensetAcc', $data);
    }
}

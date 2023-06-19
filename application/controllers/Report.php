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
}

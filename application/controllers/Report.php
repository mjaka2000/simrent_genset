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

    // public function cetak_jdw_gensetAll()
    // {
    //     $data['list_data'] = $this->M_data->get_data_u_keluar('tb_unit_keluar');
    //     $data['title'] = 'Laporan Jadwal Penyewaan Genset';
    //     $this->load->view('report/jdw_genset/rep_jdw_gensetAll', $data);
    // }

    public function cetak_jdw_gensetAll()
    {

        $data = $this->M_data->get_data_u_keluar('tb_unit_keluar');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // document informasi
        $pdf->SetCreator('SIMRENT Genset Web');
        $pdf->SetTitle('Laporan Jadwal Penyewaan Genset');
        $pdf->SetSubject('Operator');

        $PDF_HEADER_STRING = "";

        $pdf->SetHeaderData('KOP_SURAT_WARDAH_SOLUTION.png', 170, '', $PDF_HEADER_STRING, array(0, 0, 0), array(0, 0, 0));

        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, 'I', 9));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        //set margin
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP - 5, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER, 5);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM - 5);
        $pdf->SetDisplayMode('fullpage', 'Fit');

        //SET Scaling ImagickPixel
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        //FONT Subsetting
        $pdf->setFontSubsetting(true);

        $pdf->SetFont('helvetica', '', 10, '', true);

        $pdf->AddPage('p');

        $tanggal = format_indo(date('Y-m-d'));

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $html =
            '<div>
              <h1 align="center">Laporan Jadwal Penyewaan Genset</h1>
              
              <table border="1" align="center">
                <tr>
                <th width="50px" align="center">No.</th>
                <th align="center">Pemakai</th>
                <th align="center">Nama Genset</th>
                <th align="center">Dipakai Tanggal</th>
                <th align="center">Sampai Tanggal</th>
                <th align="center">Lokasi Sewa</th>
                </tr>';

        $no = 1;

        foreach ($data as $d) :
            $html .= '<tr>';
            $html .= '<td align="center">' . $no . '</td>';
            $html .= '<td align="center">' . $d->nama_plg . '</td>';
            $html .= '<td align="center">' . $d->nama_genset . '</td>';
            $html .= '<td align="center">' . date('d-m-Y', strtotime($d->tanggal_keluar)) . '</td>';
            $html .= '<td align="center">' . date('d-m-Y', strtotime($d->tanggal_masuk)) . '</td>';
            $html .= '<td align="center">' . $d->lokasi . '</td>';
            $html .= '</tr>';
            $no++;
        endforeach;


        $html .= '
                </table><br><br><br><br>
                <table>
                <tr>
                    <td><br><br><br><br><br></td>
                    <td align="right">Banjarmasin, ' . format_indo(date('Y-m-d')) . '</td>
                </tr>
                <tr>
                    <td colspan="2" align="right">' .
            $this->session->userdata('nama') . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                </tr>

            </table>
              </div>';

        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);

        $pdf->Output('laporan_operator.pdf', 'I');
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

        $data = $this->M_data->get_data_service('tb_serv_genset');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // document informasi
        $pdf->SetCreator('SIMRENT Genset Web');
        $pdf->SetTitle('Laporan Perbaikan Genset');
        $pdf->SetSubject('Operator');

        $PDF_HEADER_STRING = "";

        $pdf->SetHeaderData('KOP_SURAT_WARDAH_SOLUTION.png', 170, '', $PDF_HEADER_STRING, array(0, 0, 0), array(0, 0, 0));

        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, 'I', 9));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        //set margin
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP - 5, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER, 5);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM - 5);
        $pdf->SetDisplayMode('fullpage', 'Fit');

        //SET Scaling ImagickPixel
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        //FONT Subsetting
        $pdf->setFontSubsetting(true);

        $pdf->SetFont('helvetica', '', 10, '', true);

        $pdf->AddPage('p');

        $tanggal = format_indo(date('Y-m-d'));

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $html =
            '<div>
              <h1 align="center">Laporan Perbaikan Genset</h1>
              
              <table border="1" align="center">
                <tr>
                <th width="50px" align="center">No.</th>
                        <th>Nomor Genset</th>
                        <th>Nama Genset</th>
                        <th>Jenis Perbaikan</th>
                        <th>Spare Part (Diganti)</th>
                        <th>Tgl. Perbaikan</th>
                        <th>Ket. Perbaikan</th>
                        <th>Biaya Perbaikan</th>
                </tr>';

        $no = 1;

        foreach ($data as $d) :
            $html .= '<tr>';
            $html .= '<td align="center">' . $no . '</td>';
            $html .= '<td align="center">' . $d->kode_genset . '</td>';
            $html .= '<td align="center">' . $d->nama_genset . '</td>';
            $html .= '<td align="center">' . $d->jenis_perbaikan . '</td>';
            $html .= '<td align="center">' . $d->nama_sparepart . '</td>';
            $html .= '<td align="center">' . date('d-m-Y', strtotime($d->tgl_perbaikan)) . '</td>';
            if ($d->ket_perbaikan == "1") {
                $html .=   '<td align="center">Selesai Diperbaiki</td>';
            } else {
                $html .=    '<td>Masih Proses</td>';
            }
            $html .= '<td align="center">Rp ' . number_format($d->biaya_perbaikan) . '</td>';
            $html .= '</tr>';
            $no++;
        endforeach;


        $html .= '
                </table><br><br><br><br>
                <table>
                <tr>
                    <td><br><br><br><br><br></td>
                    <td align="right">Banjarmasin, ' . format_indo(date('Y-m-d')) . '</td>
                </tr>
                <tr>
                    <td colspan="2" align="right">' .
            $this->session->userdata('nama') . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                </tr>

            </table>
              </div>';

        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);

        $pdf->Output('laporan_operator.pdf', 'I');
    }
    // public function cetak_serv_gensetAll()
    // {
    //     $data['list_data'] = $this->M_data->get_data_service('tb_serv_genset');
    //     $data['title'] = 'Laporan Perbaikan Genset';
    //     $this->load->view('report/service_genset/rep_service_genset', $data);
    // }

    public function cetak_Pelanggan()
    {

        $data = $this->M_data->get_Plg('tb_pelanggan');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // document informasi
        $pdf->SetCreator('SIMRENT Genset Web');
        $pdf->SetTitle('Laporan Data Pelanggan');
        $pdf->SetSubject('Operator');

        $PDF_HEADER_STRING = "";

        $pdf->SetHeaderData('KOP_SURAT_WARDAH_SOLUTION.png', 170, '', $PDF_HEADER_STRING, array(0, 0, 0), array(0, 0, 0));

        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, 'I', 9));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        //set margin
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP - 5, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER, 5);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM - 5);
        $pdf->SetDisplayMode('fullpage', 'Fit');

        //SET Scaling ImagickPixel
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        //FONT Subsetting
        $pdf->setFontSubsetting(true);

        $pdf->SetFont('helvetica', '', 10, '', true);

        $pdf->AddPage('p');

        $tanggal = format_indo(date('Y-m-d'));

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $html =
            '<div>
              <h1 align="center">Laporan Data Pelanggan</h1>
              
              <table border="1" align="center">
                <tr>
                <th width="50px" align="center">No.</th>
                <th align="center">Nama</th>
                        <th  width="110px" align="center">Alamat</th>
                        <th width="110px" align="center">No. HP</th>
                        <th align="center">Jenis Kelamin</th>
                        <th align="center">Nama Perusahaan</th>
                        <th align="center">Tanggal Update</th>
                </tr>';

        $no = 1;

        foreach ($data as $d) :
            $html .= '<tr>';
            $html .= '<td align="center">' . $no . '</td>';
            $html .= '<td align="center">' . $d->nama_plg . '</td>';
            $html .= '<td align="center">' . $d->alamat_plg . '</td>';
            $html .= '<td align="center">' . $d->nohp_plg . '</td>';
            if ($d->jk_plg == 'L') {
                $html .= '<td align="center">Laki - Laki</td>';
            } else {
                '<td>Perempuan</td>';
            }
            $html .= '<td align="center">' . $d->namaperusahaan_plg . '</td>';
            $html .= '<td align="center">' . date('d-m-Y', strtotime($d->tglupdate_plg)) . '</td>';
            $html .= '</tr>';
            $no++;
        endforeach;


        $html .= '
                </table><br><br><br><br>
                <table>
                <tr>
                    <td><br><br><br><br><br></td>
                    <td align="right">Banjarmasin, ' . format_indo(date('Y-m-d')) . '</td>
                </tr>
                <tr>
                    <td colspan="2" align="right">' .
            $this->session->userdata('nama') . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                </tr>

            </table>
              </div>';

        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);

        $pdf->Output('laporan_operator.pdf', 'I');
    }

    // public function cetak_Pelanggan()
    // {
    //     $data['list_data'] = $this->M_data->get_Plg('tb_pelanggan');
    //     $data['title'] = 'Laporan Data Pelanggan';
    //     $this->load->view('report/pelanggan/rep_pelanggan', $data);
    // }

    public function cetak_Pelanggan_blacklist()
    {

        $data = $this->M_data->get_Plg_Blc('tb_pelanggan');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // document informasi
        $pdf->SetCreator('SIMRENT Genset Web');
        $pdf->SetTitle('Laporan Data Pelanggan Di Blacklist');
        $pdf->SetSubject('Operator');

        $PDF_HEADER_STRING = "";

        $pdf->SetHeaderData('KOP_SURAT_WARDAH_SOLUTION.png', 170, '', $PDF_HEADER_STRING, array(0, 0, 0), array(0, 0, 0));

        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, 'I', 9));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        //set margin
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP - 5, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER, 5);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM - 5);
        $pdf->SetDisplayMode('fullpage', 'Fit');

        //SET Scaling ImagickPixel
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        //FONT Subsetting
        $pdf->setFontSubsetting(true);

        $pdf->SetFont('helvetica', '', 10, '', true);

        $pdf->AddPage('p');

        $tanggal = format_indo(date('Y-m-d'));

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $html =
            '<div>
              <h1 align="center">Laporan Data Pelanggan Di Blacklist</h1>
              
              <table border="1" align="center">
                <tr>
                <th width="50px" align="center">No.</th>
                <th align="center">Nama</th>
                        <th  width="110px" align="center">Alamat</th>
                        <th width="110px" align="center">No. HP</th>
                        <th align="center">Jenis Kelamin</th>
                        <th align="center">Nama Perusahaan</th>
                </tr>';

        $no = 1;

        foreach ($data as $d) :
            $html .= '<tr>';
            $html .= '<td align="center">' . $no . '</td>';
            $html .= '<td align="center">' . $d->nama_plg . '</td>';
            $html .= '<td align="center">' . $d->alamat_plg . '</td>';
            $html .= '<td align="center">' . $d->nohp_plg . '</td>';
            if ($d->jk_plg == 'L') {
                $html .= '<td align="center">Laki - Laki</td>';
            } else {
                '<td>Perempuan</td>';
            }
            $html .= '<td align="center">' . $d->namaperusahaan_plg . '</td>';
            $html .= '</tr>';
            $no++;
        endforeach;


        $html .= '
                </table><br><br><br><br>
                <table>
                <tr>
                    <td><br><br><br><br><br></td>
                    <td align="right">Banjarmasin, ' . format_indo(date('Y-m-d')) . '</td>
                </tr>
                <tr>
                    <td colspan="2" align="right">' .
            $this->session->userdata('nama') . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                </tr>

            </table>
              </div>';

        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);

        $pdf->Output('laporan_operator.pdf', 'I');
    }
    // public function cetak_Pelanggan_blacklist()
    // {
    //     $data['list_pelanggan_blacklist'] = $this->M_data->get_Plg_Blc('tb_pelanggan');
    //     $data['title'] = 'Laporan Data Pelanggan Blacklist';
    //     $this->load->view('report/pelanggan/rep_pelanggan_blacklist', $data);
    // }

    public function cetak_sparepart()
    {

        $data = $this->M_data->select_sparepart('tb_sparepart');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // document informasi
        $pdf->SetCreator('SIMRENT Genset Web');
        $pdf->SetTitle('Laporan Data Sparepart');
        $pdf->SetSubject('Operator');

        $PDF_HEADER_STRING = "";

        $pdf->SetHeaderData('KOP_SURAT_WARDAH_SOLUTION.png', 170, '', $PDF_HEADER_STRING, array(0, 0, 0), array(0, 0, 0));

        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, 'I', 9));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        //set margin
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP - 5, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER, 5);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM - 5);
        $pdf->SetDisplayMode('fullpage', 'Fit');

        //SET Scaling ImagickPixel
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        //FONT Subsetting
        $pdf->setFontSubsetting(true);

        $pdf->SetFont('helvetica', '', 10, '', true);

        $pdf->AddPage('p');

        $tanggal = format_indo(date('Y-m-d'));

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $html =
            '<div>
              <h1 align="center">Laporan Data Sparepart</h1>
              
              <table border="1" align="center">
                <tr>
                <th width="50px" align="center">No.</th>
                <th align="center">Nama Sparepart</th>
                <th  width="110px" align="center">Tanggal Beli</th>
                <th width="110px" align="center">Tempat Beli</th>
                <th align="center">Stok</th>
                </tr>';

        $no = 1;

        foreach ($data as $d) :
            $html .= '<tr>
           <td align="center">' . $no . '</td>
           <td align="center">' . $d->nama_sparepart . '</td>
           <td align="center">' . date('d-m-Y', strtotime($d->tanggal_beli)) . '</td>
           <td align="center">' . $d->tempat_beli . '</td>
           <td align="center">' . $d->stok . '</td>';
            $html .= '</tr>';
            $no++;
        endforeach;


        $html .= '
                </table><br><br><br><br>
                <table>
                <tr>
                    <td><br><br><br><br><br></td>
                    <td align="right">Banjarmasin, ' . format_indo(date('Y-m-d')) . '</td>
                </tr>
                <tr>
                    <td colspan="2" align="right">' .
            $this->session->userdata('nama') . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                </tr>

            </table>
              </div>';

        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);

        $pdf->Output('laporan_operator.pdf', 'I');
    }
    // public function cetak_sparepart()
    // {
    //     $data['list_sparepart'] = $this->M_data->select_sparepart('tb_sparepart');
    //     $data['title'] = 'Laporan Data Sparepart';
    //     $this->load->view('report/sparepart/rep_sparepart', $data);
    // }

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

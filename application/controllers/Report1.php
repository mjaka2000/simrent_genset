<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('Pdf');
    $this->load->model('M_admin');
  }

  public function dataKeluar()
  {
    $data = $this->M_admin->select('tb_barang_keluar');

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // document informasi
    $pdf->SetCreator('Web Aplikasi Gudang');
    $pdf->SetTitle('Laporan Data Genset Keluar');
    $pdf->SetSubject('Barang Keluar');


    $PDF_HEADER_STRING = "Jl. Jahri Saleh Komp. Pandan Arum No. 96 Rt. 15 Banjarmasin Utara 70122 Banjarmasin \nTelp. (0511) 4315143";

    $pdf->SetHeaderData('logo_wardah.jpg', 15, 'WARDAH SOLUTION', $PDF_HEADER_STRING, array(0, 0, 0), array(0, 0, 0));
    $pdf->SetFooterData(array(255, 255, 255), array(255, 255, 255));


    $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

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

    $pdf->AddPage();

    $tanggal = date('d M Y');

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    $html =
      '<div>
        <h1 align="center">Laporan Genset Keluar</h1>
        <!--<p align="right">Tanggal Cetak : ' . $tanggal . '</p>-->
        <table border="1">
          <tr>
            <th style="width:25px" align="center">No.</th>
            <th align="center">ID Transaksi</th>
            
            <th style="width:70px" align="center">Tanggal Keluar</th>
            <th  align="center">Lokasi</th>
            <th  align="center">Nama Pelanggan</th>
            <th  align="center">Nama Genset</th>
            <th  align="center">Daya</th>
            <th  align="center">Mobil</th>
            <th  align="center">Jumlah Hari</th>
            <th style="width:90px" align="center">Total</th>
          </tr>';


    $no = 1;
    foreach ($data as $d) :
      $html .= '<tr>';
      $html .= '<td align="center">' . $no . '</td>';
      $html .= '<td align="center">' . $d->id_transaksi . '</td>';
      $html .= '<td align="center">' . $d->tanggal_keluar . '</td>';
      // $html .= '<td align="center">'.$d->tanggal_masuk.'</td>';
      $html .= '<td align="center">' . $d->lokasi . '</td>';
      $html .= '<td align="center">' . $d->nama_pelanggan . '</td>';
      $html .= '<td align="center">' . $d->nama_genset . '</td>';
      $html .= '<td align="center">' . $d->daya . '</td>';
      $html .= '<td align="center">' . $d->mobil . '</td>';
      $html .= '<td align="center">' . $d->jumlah_hari . '</td>';
      $html .= '<td align="center">Rp&nbsp;' . number_format($d->total) . '</td>';
      $html .= '</tr>';

      // $html .= '<tr>';
      // $html .= '<td align="center" colspan="8"><b>Jumlah</b></td>';
      // $html .= '<td align="center">'.$d->total.'</td>';
      // $html .= '</tr>';
      $no++;
    endforeach;


    $html .= '
          </table><br>
          <p align="right">Mengetahui,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
          <p align="right">Banjarmasin,&nbsp;' . $tanggal . '&nbsp;&nbsp;&nbsp;</p><br><br><br>
          <p align="right">Pimpinan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        </div>';

    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);

    $pdf->Output('laporan_genset_keluar.pdf', 'I');
  }

  public function dataMasuk()
  {
    $data = $this->M_admin->select('tb_barang_masuk');

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // document informasi
    $pdf->SetCreator('Web Aplikasi Gudang');
    $pdf->SetTitle('Laporan Data Genset Masuk');
    $pdf->SetSubject('Barang Masuk');

    $PDF_HEADER_STRING = "Jl. Jahri Saleh Komp. Pandan Arum No. 96 Rt. 15 Banjarmasin Utara 70122 Banjarmasin \nTelp. (0511) 4315143";

    $pdf->SetHeaderData('logo_wardah.jpg', 15, 'WARDAH SOLUTION', $PDF_HEADER_STRING, array(0, 0, 0), array(0, 0, 0));
    $pdf->SetFooterData(array(255, 255, 255), array(255, 255, 255));

    $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

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

    $pdf->AddPage('P');

    $tanggal = date('d M Y');

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    $html =
      '<div>
            <h1 align="center">Laporan Genset Masuk</h1>
            <table border="1">
              <tr>
                <th style="width:25px" align="center">No.</th>
                <th  align="center">ID Transaksi</th>
                <th style="width:70" align="center">Tanggal Masuk</th>
                
                <th align="center">Lokasi</th>
                <th align="center">Nama Pelanggan</th>
                <th align="center">Nama Genset</th>
                <th  align="center">Daya</th>
                <th  align="center">Mobil</th>
                <th  align="center">Jumlah Hari</th>
                <th style="width:90px" align="center">Total</th>
              </tr>';

    $no = 1;

    foreach ($data as $d) :
      $html .= '<tr>';
      $html .= '<td align="center">' . $no . '</td>';
      $html .= '<td align="center">' . $d->id_transaksi . '</td>';
      // $html .= '<td align="center">'.$d->tanggal.'</td>';
      $html .= '<td align="center">' . $d->tanggal_masuk . '</td>';
      $html .= '<td align="center">' . $d->lokasi . '</td>';
      $html .= '<td align="center">' . $d->nama_pelanggan . '</td>';
      $html .= '<td align="center">' . $d->nama_genset . '</td>';
      $html .= '<td align="center">' . $d->daya . '</td>';
      $html .= '<td align="center">' . $d->mobil . '</td>';
      $html .= '<td align="center">' . $d->jumlah_hari . '</td>';
      $html .= '<td align="center">Rp&nbsp;' . number_format($d->total) . '</td>';
      $html .= '</tr>';

      // $html .= '<tr>';
      // $html .= '<td align="center" colspan="8"><b>Jumlah</b></td>';
      // $html .= '<td align="center">'.$d->total.'</td>';
      // $html .= '</tr>';
      $no++;
    endforeach;


    $html .= '
              </table><br>
              <p align="right">Mengetahui,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
          <p align="right">Banjarmasin,&nbsp;' . $tanggal . '&nbsp;&nbsp;&nbsp;</p><br><br><br>
          <p align="right">Pimpinan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            </div>';

    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);

    $pdf->Output('laporan_genset_masuk.pdf', 'I');
  }

  public function serviceGenset()
  {
    $data = $this->M_admin->select('tb_serv_genset');

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // document informasi
    $pdf->SetCreator('Web Aplikasi Gudang');
    $pdf->SetTitle('Laporan Data Service Genset');
    $pdf->SetSubject('Service Genset');

    $PDF_HEADER_STRING = "Jl. Jahri Saleh Komp. Pandan Arum No. 96 Rt. 15 Banjarmasin Utara 70122 Banjarmasin \nTelp. (0511) 4315143";

    $pdf->SetHeaderData('logo_wardah.jpg', 15, 'WARDAH SOLUTION', $PDF_HEADER_STRING, array(0, 0, 0), array(0, 0, 0));
    $pdf->SetFooterData(array(255, 255, 255), array(255, 255, 255));

    $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, 'I', 9));
    $pdf->setFooterFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

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

    $pdf->AddPage('P');

    $tanggal = date('d M Y');

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    $html =
      '<div>
            <h1 align="center">Laporan Perbaikan Genset</h1>
            <table border="1">
              <tr>
                <th style="width:25px" align="center">No.</th>
                <th  align="center">Nomor Genset</th>
                <th  align="center">Nama Genset</th>
                <th  align="center">Jenis Perbaikan</th>
                <th  align="center">Spare Part (Change)</th>
                <th  align="center">Tgl. Perbaikan</th>
                <th  align="center">Ket. Perbaikan</th>
                <th style="width:90px" align="center">Biaya Perbaikan</th>
              </tr>';

    $no = 1;

    foreach ($data as $d) :
      $html .= '<tr>';
      $html .= '<td align="center">' . $no . '</td>';
      $html .= '<td align="center">' . $d->kode_genset . '</td>';
      $html .= '<td align="center">' . $d->nama_genset . '</td>';
      $html .= '<td align="center">' . $d->jenis_perbaikan . '</td>';
      $html .= '<td align="center">' . $d->spare_part . '</td>';
      $html .= '<td align="center">' . $d->tgl_perbaikan . '</td>';
      $html .= '<td align="center">' . $d->ket_perbaikan . '</td>';
      $html .= '<td align="center">Rp&nbsp;' . number_format($d->biaya_perbaikan) . '</td>';
      $html .= '</tr>';

      // $html .= '<tr>';
      // $html .= '<td align="center" colspan="8"><b>Jumlah</b></td>';
      // $html .= '<td align="center">'.$d->total.'</td>';
      // $html .= '</tr>';
      $no++;
    endforeach;


    $html .= '
              </table><br>
              <p align="right">Mengetahui,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
          <p align="right">Banjarmasin,&nbsp;' . $tanggal . '&nbsp;&nbsp;&nbsp;</p><br><br><br>
          <p align="right">Pimpinan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            </div>';

    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);

    $pdf->Output('laporan_service_genset.pdf', 'I');
  }

  public function mobil()
  {
    $data = $this->M_admin->select('tb_mobil');

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // document informasi
    $pdf->SetCreator('Web Aplikasi Gudang');
    $pdf->SetTitle('Laporan Data Mobil');
    $pdf->SetSubject('Mobil');

    $PDF_HEADER_STRING = "Jl. Jahri Saleh Komp. Pandan Arum No. 96 Rt. 15 Banjarmasin Utara 70122 Banjarmasin \nTelp. (0511) 4315143";

    $pdf->SetHeaderData('logo_wardah.jpg', 15, 'WARDAH SOLUTION', $PDF_HEADER_STRING, array(0, 0, 0), array(0, 0, 0));
    $pdf->SetFooterData(array(255, 255, 255), array(255, 255, 255));

    $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, 'I', 9));
    $pdf->setFooterFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

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

    $tanggal = date('d M Y');

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    $html =
      '<div>
            <h1 align="center">Laporan Data Mobil</h1>
            
            <table border="1">
              <tr>
                <th style="width:25px" align="center">No.</th>
                <th style="width:60px" align="center">Merek</th>
                <th style="width:70px" align="center">Tipe</th>
                <th style="width:50px" align="center">Tahun</th>
                <th style="width:80px" align="center">Nopol</th>
                <th style="width:65px" align="center">Jenis BBM</th>
                <th style="width:73px" align="center">Pajak</th>
                <th style="width:73px" align="center">STNK</th>
                <th style="width:150px" align="center">Gambar</th>
              </tr>';

    $no = 1;

    foreach ($data as $d) :
      $html .= '<tr>';
      $html .= '<td align="center">' . $no . '</td>';
      $html .= '<td align="center">' . $d->merek . '</td>';
      $html .= '<td align="center">' . $d->tipe . '</td>';
      $html .= '<td align="center">' . $d->tahun . '</td>';
      $html .= '<td align="center">' . $d->nopol . '</td>';
      $html .= '<td align="center">' . $d->jenis_bbm . '</td>';
      $html .= '<td align="center">' . $d->pajak . '</td>';
      $html .= '<td align="center">' . $d->stnk . '</td>';
      $html .= '<td align="center"><img src="' . base_url('assets/upload/mobil/' . $d->gambar_mobil) . '" class="img-box" width="100" height="100"></td>';
      $html .= '</tr>';

      // $html .= '<tr>';
      // $html .= '<td align="center" colspan="8"><b>Jumlah</b></td>';
      // $html .= '<td align="center">'.$d->total.'</td>';
      // $html .= '</tr>';
      $no++;
    endforeach;


    $html .= '
              </table><br>
              <p align="right">Mengetahui,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
          <p align="right">Banjarmasin,&nbsp;' . $tanggal . '&nbsp;&nbsp;&nbsp;</p><br><br><br>
          <p align="right">Pimpinan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            </div>';

    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);

    $pdf->Output('laporan_mobil.pdf', 'I');
  }

  public function genset()
  {

    $data = $this->M_admin->select('tb_genset');

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // document informasi
    $pdf->SetCreator('Web Aplikasi Gudang');
    $pdf->SetTitle('Laporan Data Genset');
    $pdf->SetSubject('Mobil');

    $PDF_HEADER_STRING = "Jl. Jahri Saleh Komp. Pandan Arum No. 96 Rt. 15 Banjarmasin Utara 70122 Banjarmasin \nTelp. (0511) 4315143";

    $pdf->SetHeaderData('logo_wardah.jpg', 15, 'WARDAH SOLUTION', $PDF_HEADER_STRING, array(0, 0, 0), array(0, 0, 0));

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

    $tanggal = date('d M Y');

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    $html =
      '<div>
            <h1 align="center">Laporan Data Genset</h1>
            
            <table border="1">
              <tr>
                <th style="width:25px" align="center">No.</th>
                <th style="width:60px" align="center">Nomor Genset</th>
                <th style="width:80px" align="center">Nama Genset</th>
                <th style="width:50px" align="center">Daya</th>
                <th style="width:100px" align="center">Harga Perhari</th>
                <th style="width:70px" align="center">Unit Digudang</th>
                <th style="width:70px" align="center">Unit Disewakan</th>
                <th style="width:150px" align="center">Gambar</th>
              </tr>';

    $no = 1;

    foreach ($data as $d) :
      $html .= '<tr>';
      $html .= '<td align="center">' . $no . '</td>';
      $html .= '<td align="center">' . $d->kode_genset . '</td>';
      $html .= '<td align="center">' . $d->nama_genset . '</td>';
      $html .= '<td align="center">' . $d->daya . '</td>';
      $html .= '<td align="center">Rp&nbsp;' . number_format($d->harga) . '</td>';
      $html .= '<td align="center">' . $d->stok_gd . '</td>';
      $html .= '<td align="center">' . $d->stok_pj . '</td>';
      $html .= '<td align="center"><img src="' . base_url('assets/upload/genset/' . $d->gambar_genset) . '" class="img-box" width="100" height="100"></td>';
      $html .= '</tr>';
      $no++;
    endforeach;


    $html .= '
              </table><br>
              <p align="right">Mengetahui,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
          <p align="right">Banjarmasin,&nbsp;' . $tanggal . '&nbsp;&nbsp;&nbsp;</p><br><br><br>
          <p align="right">Pimpinan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            </div>';

    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);

    $pdf->Output('laporan_genset.pdf', 'I');
  }

  public function operator()
  {

    $data = $this->M_admin->select('tb_operator');

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // document informasi
    $pdf->SetCreator('Web Aplikasi Gudang');
    $pdf->SetTitle('Laporan Data Operator');
    $pdf->SetSubject('Operator');

    $PDF_HEADER_STRING = "Jl. Jahri Saleh Komp. Pandan Arum No. 96 Rt. 15 Banjarmasin Utara 70122 Banjarmasin \nTelp. (0511) 4315143";

    $pdf->SetHeaderData('logo_wardah.jpg', 15, 'WARDAH SOLUTION', $PDF_HEADER_STRING, array(0, 0, 0), array(0, 0, 0));

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

    $tanggal = date('d-M-Y');

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    $html =
      '<div>
              <h1 align="center">Laporan Data Operator</h1>
              
              <table border="1" >
                <tr>
                  <th style="width:25px" align="center">No.</th>
                  <th style="width:150px" align="center">Nama</th>
                  <th style="width:150px" align="center">Alamat</th>
                  <th style="width:150px" align="center">No. Hp</th>
    
                </tr>';

    $no = 1;

    foreach ($data as $d) :
      $html .= '<tr>';
      $html .= '<td align="center">' . $no . '</td>';
      $html .= '<td align="center">' . $d->nama . '</td>';
      $html .= '<td align="center">' . $d->alamat . '</td>';
      $html .= '<td align="center">' . $d->no_hp . '</td>';
      $html .= '</tr>';
      $no++;
    endforeach;


    $html .= '
                </table><br>
                <p align="right">Mengetahui,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
          <p align="right">Banjarmasin,&nbsp;' . $tanggal . '&nbsp;&nbsp;&nbsp;</p><br><br><br>
          <p align="right">Pimpinan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
              </div>';

    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);

    $pdf->Output('laporan_operator.pdf', 'I');
  }

  public function pelanggan()
  {

    $data = $this->M_admin->select('tb_pelanggan');

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // document informasi
    $pdf->SetCreator('Web Aplikasi Gudang');
    $pdf->SetTitle('Laporan Data Pelanggan');
    $pdf->SetSubject('Pelanggan');

    $PDF_HEADER_STRING = "Jl. Jahri Saleh Komp. Pandan Arum No. 96 Rt. 15 Banjarmasin Utara 70122 Banjarmasin \nTelp. (0511) 4315143";

    $pdf->SetHeaderData('logo_wardah.jpg', 15, 'WARDAH SOLUTION', $PDF_HEADER_STRING, array(0, 0, 0), array(0, 0, 0));

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

    $tanggal = date('d M Y');

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    $html =
      '<div>
              <h1 align="center">Laporan Data Pelanggan</h1>
             
              <table border="1" >
                <tr>
                  <th style="width:25px" align="center">No.</th>
                  <th style="width:100px" align="center">Nama</th>
                  <th style="width:150px" align="center">Alamat</th>
                  <th style="width:100px" align="center">No. Hp</th>
                  <th style="width:100px" align="center">Jenis Kelamin</th>
                  <th style="width:150px" align="center">Nama Perusahaan</th>
    
                </tr>';

    $no = 1;

    foreach ($data as $d) :
      $html .= '<tr>';
      $html .= '<td align="center">' . $no . '</td>';
      $html .= '<td align="center">' . $d->nama . '</td>';
      $html .= '<td align="center">' . $d->alamat . '</td>';
      $html .= '<td align="center">' . $d->no_hp . '</td>';
      $html .= '<td align="center">' . $d->jenis_kelamin . '</td>';
      $html .= '<td align="center">' . $d->nama_perusahaan . '</td>';
      $html .= '</tr>';
      $no++;
    endforeach;


    $html .= '
                </table><br>
                <p align="right">Mengetahui,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
          <p align="right">Banjarmasin,&nbsp;' . $tanggal . '&nbsp;&nbsp;&nbsp;</p><br><br><br>
          <p align="right">Pimpinan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
              </div>';

    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);

    $pdf->Output('laporan_pelanggan.pdf', 'I');
  }
}

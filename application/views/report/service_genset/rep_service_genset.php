<?php
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
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER, 5);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);
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
       <br><br><br><br>
       <table border="1" cellspacing="1" cellpadding="2">
         <tr bgcolor=" #d1d1d1 ">
         <th width="50px" align="center">No.</th>
                 <th align="center">Nomor Genset</th>
                 <th align="center">Nama Genset</th>
                 <th align="center">Jenis Perbaikan</th>
                 <th align="center">Spare Part (Diganti)</th>
                 <th align="center">Tgl. Perbaikan</th>
                 <th align="center">Ket. Perbaikan</th>
                 <th align="center">Biaya Perbaikan</th>
         </tr>';

$no = 1;

foreach ($list_data as $d) :
    $html .= '<tr>
     <td align="center">' . $no . '</td>
     <td>' . $d->kode_genset . '</td>
     <td>' . $d->nama_genset . '</td>
     <td>' . $d->jenis_perbaikan . '</td>
     <td>' . $d->nama_sparepart . '</td>
     <td>' . date('d-m-Y', strtotime($d->tgl_perbaikan)) . '</td>';
    if ($d->ket_perbaikan == "1") {
        $html .=   '<td>Selesai Diperbaiki</td>';
    } else {
        $html .=    '<td>Masih Proses</td>';
    }
    $html .= '<td>Rp ' . number_format($d->biaya_perbaikan) . '</td>
     </tr>';
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

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, 'C', true);

$pdf->Output('Laporan Jadwal Penyewaan Genset.pdf', 'I');

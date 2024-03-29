<?php
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// document informasi
$pdf->SetCreator('SIMRENT Genset Web');
$pdf->SetTitle('Laporan Lama Pemakaian Sewa Genset yang akan di service');
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

$pdf->SetFont('times', '', 10, '', true);

$pdf->AddPage('p');

$tanggal = format_indo(date('Y-m-d'));

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$html =
    '<div>
       <h1 align="center">Laporan Lama Pemakaian Sewa Genset yang akan di service</h1>
       <b align="center">' . $label . '</b>
       <br><br>
       <table border="1" cellspacing="1" cellpadding="2">
         <tr bgcolor=" #d1d1d1 ">
         <th width="50px" align="center"><b>No.</b></th>
                 <th width="50px" align="center"><b>Nomor Genset</b></th>
                 <th align="center"><b>Nama Genset</b></th>
                 <th width="100px" align="center"><b>Daya</b></th>
                 <th align="center"><b>Lama Pakai</b></th>
                 <th align="center"><b>Tanggal Pemakaian</b></th>
                 <th width="100px" align="center"><b>Keterangan</b></th>
         </tr>';

$no = 1;

foreach ($list_data as $d) :
    $html .= '<tr>
     <td align="center">' . $no . '</td>
     <td align="center">' . $d->kode_genset . '</td>
     <td>' . $d->nama_genset . '</td>
     <td>' . $d->daya . ' KVA</td>
     <td>' . $d->jumlah_hari . ' Hari</td>
     <td>' . date('d-m-Y', strtotime($d->tanggal_masuk)) . '</td>
     <td>' . $d->ket_det_pakai_genset . '</td>
     
     </tr>';

    $no++;
endforeach;


$html .= '
</table><br><br><br><br>
<table> 
<tr>
    <td ><br><br><br><br><br></td>
    <td ></td>
    <td align="center">Banjarmasin, ' . format_indo(date('Y-m-d')) . '<br>Mengetahui,<br>Pimpinan</td>
</tr>
<tr>
    <td colspan="2"></td>
    <td align="center">......................................</td>
</tr>

     </table>
       </div>';

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);

$pdf->Output('Laporan Lama Pemakaian Sewa Genset yang akan di service.pdf', 'I');

<?php

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// document informasi
$pdf->SetCreator('SIMRENT Genset Web');
$pdf->SetTitle('Laporan Pendapatan');
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
              <h1 align="center">Laporan Pendapatan</h1>
              <br><br><br><br>
              <table border="1" cellspacing="1" cellpadding="2">
                <tr bgcolor=" #d1d1d1 ">
                <th width="50px" align="center">No.</th>
                <th align="center">Tanggal Penyewaan</th>
                <th align="center">ID Transaksi</th>
                <th  align="center">Tanggal Di Update</th>
                <th align="center">Pendapatan</th>
                <th width="150px" align="center">Keterangan</th>
                </tr>';

$no = 1;

foreach ($list_data as $d) :
    $html .= '<tr>
            <td align="center">' . $no . '</td>
            <td >' . date('d-m-Y', strtotime($d->tanggal_masuk)) . '</td>
            <td >' . $d->id_transaksi . '</td>
            <td >' . date('d-m-Y', strtotime($d->tgl_update)) . '</td>
            <td align="center">Rp ' . number_format($d->total) . '</td>
            <td >' . $d->keterangan . '</td>
            </tr>';
    $no++;
endforeach;
foreach ($total_data as $td) :
    $html .=
        '<tr>
                            <th colspan="6" style="text-align: center;">Total Pendapatan ' . $label . ': <span style="color: red;">Rp&nbsp;' . number_format($td->total) . '</span></th>
                            </tr>';
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

$pdf->Output('Laporan Pendapatan.pdf', 'I');

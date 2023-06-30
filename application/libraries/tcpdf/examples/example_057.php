<?php
//============================================================+
// File name   : example_057.php
// Begin       : 2010-04-03
// Last Update : 2013-05-14
//
// Description : Example 057 for TCPDF class
//               Cell vertical alignments
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Cell vertical alignments
 * @author Nicola Asuni
 * @since 2008-03-04
 * @group cell
 * @group pdf
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('TCPDF Example 057');
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 057', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage();

$pdf->Write(0, 'Example of alignment options for Cell()', '', 0, 'L', true, 0, false, false, 0);

$pdf->setFont('helvetica', '', 11);

// set border width
$pdf->setLineWidth(0.7);

// set color for cell border
$pdf->setDrawColor(0,128,255);

$pdf->setCellHeightRatio(3);

$pdf->setXY(15, 60);

// text on center
$pdf->Cell(30, 0, 'Top-Center', 1, $ln=0, 'C', 0, '', 0, false, 'T', 'C');
$pdf->Cell(30, 0, 'Center-Center', 1, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(30, 0, 'Bottom-Center', 1, $ln=0, 'C', 0, '', 0, false, 'B', 'C');
$pdf->Cell(30, 0, 'Ascent-Center', 1, $ln=0, 'C', 0, '', 0, false, 'A', 'C');
$pdf->Cell(30, 0, 'Baseline-Center', 1, $ln=0, 'C', 0, '', 0, false, 'L', 'C');
$pdf->Cell(30, 0, 'Descent-Center', 1, $ln=0, 'C', 0, '', 0, false, 'D', 'C');


$pdf->setXY(15, 90);

// text on top
$pdf->Cell(30, 0, 'Top-Top', 1, $ln=0, 'C', 0, '', 0, false, 'T', 'T');
$pdf->Cell(30, 0, 'Center-Top', 1, $ln=0, 'C', 0, '', 0, false, 'C', 'T');
$pdf->Cell(30, 0, 'Bottom-Top', 1, $ln=0, 'C', 0, '', 0, false, 'B', 'T');
$pdf->Cell(30, 0, 'Ascent-Top', 1, $ln=0, 'C', 0, '', 0, false, 'A', 'T');
$pdf->Cell(30, 0, 'Baseline-Top', 1, $ln=0, 'C', 0, '', 0, false, 'L', 'T');
$pdf->Cell(30, 0, 'Descent-Top', 1, $ln=0, 'C', 0, '', 0, false, 'D', 'T');


$pdf->setXY(15, 120);

// text on bottom
$pdf->Cell(30, 0, 'Top-Bottom', 1, $ln=0, 'C', 0, '', 0, false, 'T', 'B');
$pdf->Cell(30, 0, 'Center-Bottom', 1, $ln=0, 'C', 0, '', 0, false, 'C', 'B');
$pdf->Cell(30, 0, 'Bottom-Bottom', 1, $ln=0, 'C', 0, '', 0, false, 'B', 'B');
$pdf->Cell(30, 0, 'Ascent-Bottom', 1, $ln=0, 'C', 0, '', 0, false, 'A', 'B');
$pdf->Cell(30, 0, 'Baseline-Bottom', 1, $ln=0, 'C', 0, '', 0, false, 'L', 'B');
$pdf->Cell(30, 0, 'Descent-Bottom', 1, $ln=0, 'C', 0, '', 0, false, 'D', 'B');


// draw some reference lines
$linestyle = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => '', 'phase' => 0, 'color' => array(255, 0, 0));
$pdf->Line(15, 60, 195, 60, $linestyle);
$pdf->Line(15, 90, 195, 90, $linestyle);
$pdf->Line(15, 120, 195, 120, $linestyle);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Print an image to explain cell measures

$pdf->Image('images/tcpdf_cell.png', 15, 160, 100, 100, 'PNG', '', '', false, 300, '', false, false, 0, false, false, false);
$legend = 'LEGEND:

X: cell x top-left origin (top-right for RTL)
Y: cell y top-left origin (top-right for RTL)
CW: cell width
CH: cell height
LW: line width
NRL: normal line position
EXT: external line position
INT: internal line position
ML: margin left
MR: margin right
MT: margin top
MB: margin bottom
PL: padding left
PR: padding right
PT: padding top
PB: padding bottom
TW: text width
FA: font ascent
FB: font baseline
FD: font descent';
$pdf->setFont('helvetica', '', 10);
$pdf->setCellHeightRatio(1.25);
$pdf->MultiCell(0, 0, $legend, 0, 'L', false, 1, 125, 160, true, 0, false, true, 0, 'T', false);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// CELL BORDERS

// add a page
$pdf->AddPage();

$pdf->setFont('helvetica', 'B', 20);

$pdf->Write(0, 'Example of borders for Cell()', '', 0, 'L', true, 0, false, false, 0);

$pdf->setFont('helvetica', '', 11);

// set border width
$pdf->setLineWidth(0.508);

// set color for cell border
$pdf->setDrawColor(0,128,255);

// set filling color
$pdf->setFillColor(255,255,128);

// set cell height ratio
$pdf->setCellHeightRatio(3);

$pdf->Cell(30, 0, '1', 1, 1, 'C', 1, '', 0, false, 'T', 'C');
$pdf->Ln(2);
$pdf->Cell(30, 0, 'LTRB', 'LTRB', 1, 'C', 1, '', 0, false, 'T', 'C');
$pdf->Ln(2);
$pdf->Cell(30, 0, 'LTR', 'LTR', 1, 'C', 1, '', 0, false, 'T', 'C');
$pdf->Ln(2);
$pdf->Cell(30, 0, 'TRB', 'TRB', 1, 'C', 1, '', 0, false, 'T', 'C');
$pdf->Ln(2);
$pdf->Cell(30, 0, 'LRB', 'LRB', 1, 'C', 1, '', 0, false, 'T', 'C');
$pdf->Ln(2);
$pdf->Cell(30, 0, 'LTB', 'LTB', 1, 'C', 1, '', 0, false, 'T', 'C');
$pdf->Ln(2);
$pdf->Cell(30, 0, 'LT', 'LT', 1, 'C', 1, '', 0, false, 'T', 'C');
$pdf->Ln(2);
$pdf->Cell(30, 0, 'TR', 'TR', 1, 'C', 1, '', 0, false, 'T', 'C');
$pdf->Ln(2);
$pdf->Cell(30, 0, 'RB', 'RB', 1, 'C', 1, '', 0, false, 'T', 'C');
$pdf->Ln(2);
$pdf->Cell(30, 0, 'LB', 'LB', 1, 'C', 1, '', 0, false, 'T', 'C');
$pdf->Ln(2);
$pdf->Cell(30, 0, 'LR', 'LR', 1, 'C', 1, '', 0, false, 'T', 'C');
$pdf->Ln(2);
$pdf->Cell(30, 0, 'TB', 'TB', 1, 'C', 1, '', 0, false, 'T', 'C');
$pdf->Ln(2);
$pdf->Cell(30, 0, 'L', 'L', 1, 'C', 1, '', 0, false, 'T', 'C');
$pdf->Ln(2);
$pdf->Cell(30, 0, 'T', 'T', 1, 'C', 1, '', 0, false, 'T', 'C');
$pdf->Ln(2);
$pdf->Cell(30, 0, 'R', 'R', 1, 'C', 1, '', 0, false, 'T', 'C');
$pdf->Ln(2);
$pdf->Cell(30, 0, 'B', 'B', 1, 'C', 1, '', 0, false, 'T', 'C');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// ADVANCED SETTINGS FOR CELL BORDERS

// add a page
$pdf->AddPage();

$pdf->setFont('helvetica', 'B', 20);

$pdf->Write(0, 'Example of advanced border settings for Cell()', '', 0, 'L', true, 0, false, false, 0);

$pdf->setFont('helvetica', '', 11);

// set border width
$pdf->setLineWidth(1);

// set color for cell border
$pdf->setDrawColor(0,128,255);

// set filling color
$pdf->setFillColor(255,255,128);

$border = array('LTRB' => array('width' => 2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0)));
$pdf->Cell(30, 0, 'LTRB', $border, 1, 'C', 1, '', 0, false, 'T', 'C');
$pdf->Ln(5);

$border = array(
'L' => array('width' => 2, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0)),
'R' => array('width' => 2, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 255)),
'T' => array('width' => 2, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 255, 0)),
'B' => array('width' => 2, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 255)));
$pdf->Cell(30, 0, 'LTRB', $border, 1, 'C', 1, '', 0, false, 'T', 'C');
$pdf->Ln(5);

$border = array('mode' => 'ext', 'LTRB' => array('width' => 2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0)));
$pdf->Cell(30, 0, 'LTRB EXT', $border, 1, 'C', 1, '', 0, false, 'T', 'C');
$pdf->Ln(5);

$border = array('mode' => 'int', 'LTRB' => array('width' => 2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0)));
$pdf->Cell(30, 0, 'LTRB INT', $border, 1, 'C', 1, '', 0, false, 'T', 'C');
$pdf->Ln(5);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_057.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
   var plotOffset = plot.getPlotOffset(),
                i, hi;

            octx.save();
            octx.translate(plotOffset.left, plotOffset.top);
            for (i = 0; i < highlights.length; ++i) {
                hi = highlights[i];

                if (hi.series.bars.show) drawBarHighlight(hi.series, hi.point, octx);
                else drawPointHighlight(hi.series, hi.point, octx, plot);
            }
            octx.restore();
        }

        function drawPointHighlight(series, point, octx, plot) {
            var x = point[0],
                y = point[1],
                axisx = series.xaxis,
                axisy = series.yaxis,
                highlightColor = (typeof series.highlightColor === "string") ? series.highlightColor : $.color.parse(series.color).scale('a', 0.5).toString();

            if (x < axisx.min || x > axisx.max || y < axisy.min || y > axisy.max) {
                return;
            }

            var pointRadius = series.points.radius + series.points.lineWidth / 2;
            octx.lineWidth = pointRadius;
            octx.strokeStyle = highlightColor;
            var radius = 1.5 * pointRadius;
            x = axisx.p2c(x);
            y = axisy.p2c(y);

            octx.beginPath();
            var symbol = series.points.symbol;
            if (symbol === 'circle') {
                octx.arc(x, y, radius, 0, 2 * Math.PI, false);
            } else if (typeof symbol === 'string' && plot.drawSymbol && plot.drawSymbol[symbol]) {
                plot.drawSymbol[symbol](octx, x, y, radius, false);
            }

            octx.closePath();
            octx.stroke();
        }

        function drawBarHighlight(series, point, octx) {
            var highlightColor = (typeof series.highlightColor === "string") ? series.highlightColor : $.color.parse(series.color).scale('a', 0.5).toString(),
                fillStyle = highlightColor,
                barLeft;

            var barWidth = series.bars.barWidth[0] || series.bars.barWidth;
            switch (series.bars.align) {
                case "left":
                    barLeft = 0;
                    break;
                case "right":
                    barLeft = -barWidth;
                    break;
                default:
                    barLeft = -barWidth / 2;
            }

            octx.lineWidth = series.bars.lineWidth;
            octx.strokeStyle = highlightColor;

            var fillTowards = series.bars.fillTowards || 0,
                bottom = fillTowards > series.yaxis.min ? Math.min(series.yaxis.max, fillTowards) : series.yaxis.min;

            $.plot.drawSeries.drawBar(point[0], point[1], point[2] || bottom, barLeft, barLeft + barWidth,
                function() {
                    return fillStyle;
                }, series.xaxis, series.yaxis, octx, series.bars.horizontal, series.bars.lineWidth);
        }

        function initHover(plot, options) {
            plot.highlight = highlight;
            plot.unhighlight = unhighlight;
            if (options.grid.hoverable || options.grid.clickable) {
                plot.hooks.drawOverlay.push(drawOverlay);
                plot.hooks.processDatapoints.push(processDatapoints);
                plot.hooks.setupGrid.push(setupGrid);
            }

            lastMouseMoveEvent = plot.getPlaceholder()[0].lastMouseMoveEvent;
        }

        plot.hooks.bindEvents.push(bindEvents);
        plot.hooks.shutdown.push(shutdown);
        plot.hooks.processOptions.push(initHover);
    }

    $.plot.plugins.push({
        init: init,
        options: options,
        name: 'hover',
        version: '0.1'
    });
})(jQuery);

<?php
//============================================================+
// File name   : example_060.php
// Begin       : 2010-05-17
// Last Update : 2013-05-14
//
// Description : Example 060 for TCPDF class
//               Advanced page settings.
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
 * @abstract TCPDF - Example: Advanced page settings.
 * @author Nicola Asuni
 * @since 2010-05-17
 * @group page
 * @group pdf
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('TCPDF Example 060');
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 060', PDF_HEADER_STRING);

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

// set font
$pdf->setFont('helvetica', '', 20);

// ---------------------------------------------------------

// set page format (read source code documentation for further information)
$page_format = array(
	'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 297),
	'CropBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 297),
	'BleedBox' => array ('llx' => 5, 'lly' => 5, 'urx' => 205, 'ury' => 292),
	'TrimBox' => array ('llx' => 10, 'lly' => 10, 'urx' => 200, 'ury' => 287),
	'ArtBox' => array ('llx' => 15, 'lly' => 15, 'urx' => 195, 'ury' => 282),
	'Dur' => 3,
	'trans' => array(
		'D' => 1.5,
		'S' => 'Split',
		'Dm' => 'V',
		'M' => 'O'
	),
	'Rotate' => 90,
	'PZ' => 1,
);

// Check the example n. 29 for viewer preferences

// add first page ---
$pdf->AddPage('P', $page_format, false, false);
$pdf->Cell(0, 12, 'First Page', 1, 1, 'C');

// add second page ---
$page_format['Rotate'] = 270;
$pdf->AddPage('P', $page_format, false, false);
$pdf->Cell(0, 12, 'Second Page', 1, 1, 'C');

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_060.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
therpoints = other.datapoints.points,
                newpoints = [],
                px, py, intery, qx, qy, bottom,
                withlines = s.lines.show,
                horizontal = s.bars.horizontal,
                withsteps = withlines && s.lines.steps,
                fromgap = true,
                keyOffset = horizontal ? 1 : 0,
                accumulateOffset = horizontal ? 0 : 1,
                i = 0, j = 0, l, m;

            while (true) {
                if (i >= points.length) break;

                l = newpoints.length;

                if (points[i] == null) {
                    // copy gaps
                    for (m = 0; m < ps; ++m) {
                        newpoints.push(points[i + m]);
                    }

                    i += ps;
                } else if (j >= otherpoints.length) {
                    // for lines, we can't use the rest of the points
                    if (!withlines) {
                        for (m = 0; m < ps; ++m) {
                            newpoints.push(points[i + m]);
                        }
                    }

                    i += ps;
                } else if (otherpoints[j] == null) {
                    // oops, got a gap
                    for (m = 0; m < ps; ++m) {
                        newpoints.push(null);
                    }

                    fromgap = true;
                    j += otherps;
                } else {
                    // cases where we actually got two points
                    px = points[i + keyOffset];
                    py = points[i + accumulateOffset];
                    qx = otherpoints[j + keyOffset];
                    qy = otherpoints[j + accumulateOffset];
                    bottom = 0;

                    if (px === qx) {
                        for (m = 0; m < ps; ++m) {
                            newpoints.push(points[i + m]);
                        }

                        newpoints[l + accumulateOffset] += qy;
                        bottom = qy;

                        i += ps;
                        j += otherps;
                    } else if (px > qx) {
                        // we got past point below, might need to
                        // insert interpolated extra point
                        if (withlines && i > 0 && points[i - ps] != null) {
                            intery = py + (points[i - ps + accumulateOffset] - py) * (qx - px) / (points[i - ps + keyOffset] - px);
                            newpoints.push(qx);
                            newpoints.push(intery + qy);
                            for (m = 2; m < ps; ++m) {
                                newpoints.push(points[i + m]);
                            }

                            bottom = qy;
                        }

                        j += otherps;
                    } else { // px < qx
                        if (fromgap && withlines) {
                            // if we come from a gap, we just skip this point
                            i += ps;
                            continue;
                        }

                        for (m = 0; m < ps; ++m) {
                            newpoints.push(points[i + m]);
                        }

                        // we might be able to interpolate a point below,
                        // this can give us a better y
                        if (withlines && j > 0 && otherpoints[j - otherps] != null) {
                            bottom = qy + (otherpoints[j - otherps + accumulateOffset] - qy) * (px - qx) / (otherpoints[j - otherps + keyOffset] - qx);
                        }

                        newpoints[l + accumulateOffset] += bottom;

                        i += ps;
                    }

                    fromgap = false;

                    if (l !== newpoints.length && needsBottom) {
                        newpoints[l + 2] += bottom;
                    }
                }

                // maintain the line steps invariant
                if (withsteps && l !== newpoints.length && l > 0 &&
                    newpoints[l] !== null &&
                    newpoints[l] !== newpoints[l - ps] &&
                    newpoints[l + 1] !== newpoints[l - ps + 1]) {
                    for (m = 0; m < ps; ++m) {
                        newpoints[l + ps + m] = newpoints[l + m];
                    }

                    newpoints[l + 1] = newpoints[l - ps + 1];
                }
            }

            datapoints.points = newpoints;
        }

        plot.hooks.processDatapoints.push(stackData);
    }

    $.plot.plugins.push({
        init: init,
        options: options,
        name: 'stack',
        version: '1.2'
    });
})(jQuery);

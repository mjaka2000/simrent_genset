<?php

/**
 * Example 066 for TCPDF library
 *
 * @description Creates an example PDF/A-1b document using TCPDF
 * @author Nicola Asuni - Tecnick.com LTD <info@tecnick.com>
 * @license LGPL-3.0
 */

/**
 * Creates an example PDF/A-1b document using TCPDF
 *
 * @abstract TCPDF - Example: PDF/A-1b mode
 * @author Nicola Asuni
 * @since 2021-03-26
 * @group A-1b
 * @group pdf
 */

// Load the autoloader, move one folder back from examples
require_once __DIR__ . '/../vendor/autoload.php';

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false, true);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('TCPDF Example 066');
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 066', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(true, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(__DIR__ . '/lang/eng.php')) {
    require_once __DIR__ . '/lang/eng.php';

    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
$pdf->setFont('helvetica', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// Set some content to print
$html = <<<HTML
<h1>Example of <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a> document in <span style="background-color:#99ccff;color:black;"> PDF/A-1b </span> mode.</h1>
<i>This document conforms to the standard <b>PDF/A-1b (ISO 19005-1:2005)</b>.</i>
<p>Please check the source code documentation and other examples for further information (<a href="http://www.tcpdf.org">http://www.tcpdf.org</a>).</p>
HTML;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_066.pdf', 'I');
Source === undefined)) {
            isValidFromContent = false;
        } else {
            if (canvasOrSvgSource.tagName === 'CANVAS') {
                if ((canvasOrSvgSource.getBoundingClientRect().right === canvasOrSvgSource.getBoundingClientRect().left) ||
                    (canvasOrSvgSource.getBoundingClientRect().bottom === canvasOrSvgSource.getBoundingClientRect().top)) {
                    isValidFromCanvas = false;
                }
            }
        }
        return isValidFromContent && isValidFromCanvas && (window.getComputedStyle(canvasOrSvgSource).visibility === 'visible');
    }

    function getGenerateTempImg(tempImg, canvasOrSvgSource) {
        tempImg.sourceDescription = '<info className="' + canvasOrSvgSource.className + '" tagName="' + canvasOrSvgSource.tagName + '" id="' + canvasOrSvgSource.id + '">';
        tempImg.sourceComponent = canvasOrSvgSource;

        return function doGenerateTempImg(successCallbackFunc, failureCallbackFunc) {
            tempImg.onload = function(evt) {
                tempImg.successfullyLoaded = true;
                successCallbackFunc(tempImg);
            };

            tempImg.onabort = function(evt) {
                tempImg.successfullyLoaded = false;
                console.log('Can\'t generate temp image from ' + tempImg.sourceDescription + '. It is possible that it is missing some properties or its content is not supported by this browser. Source component:', tempImg.sourceComponent);
                successCallbackFunc(tempImg); //call successCallback, to allow snapshot of all working images
            };

            tempImg.onerror = function(evt) {
                tempImg.successfullyLoaded = false;
                console.log('Can\'t generate temp image from ' + tempImg.sourceDescription + '. It is possible that it is missing some properties or its content is not supported by this browser. Source component:', tempImg.sourceComponent);
                successCallbackFunc(tempImg); //call successCallback, to allow snapshot of all working images
            };

            generateTempImageFromCanvasOrSvg(canvasOrSvgSource, tempImg);
        };
    }

    function getExecuteImgComposition(destinationCanvas) {
        return function executeImgComposition(tempImgs) {
            var compositionResult = copyImgsToCanvas(tempImgs, destinationCanvas);
            return compositionResult;
        };
    }

    function copyCanvasToImg(canvas, img) {
        img.src = canvas.toDataURL('image/png');
    }

    function getCSSRules(document) {
        var styleSheets = document.styleSheets,
            rulesList = [];
        for (var i = 0; i < styleSheets.length; i++) {
            // CORS requests for style sheets throw and an exception on Chrome > 64
            try {
                // in Chrome, the external CSS files are empty when the page is directly loaded from disk
                var rules = styleSheets[i].cssRules || [];
                for (var j = 0; j < rules.length; j++) {
                    var rule = rules[j];
                    rulesList.push(rule.cssText);
                }
            } catch (e) {
                console.log('Failed to get some css rules');
            }
        }
        return rulesList;
    }

    function embedCSSRulesInSVG(rules, svg) {
        var text = [
            '<svg class="snapshot ' + svg.classList + '" width="' + svg.width.baseVal.value * pixelRatio + '" height="' + svg.height.baseVal.value * pixelRatio + '" viewBox="0 0 ' + svg.width.baseVal.value + ' ' + svg.height.baseVal.value + '" xmlns="http://www.w3.org/2000/svg">',
            '<style>',
            '/* <![CDATA[ */',
            rules.join('\n'),
            '/* ]]> */',
            '</style>',
            svg.innerHTML,
            '</svg>'
        ].join('\n');
        return text;
    }

    function copySVGToImgMostBrowsers(svg, img) {
        var rules = getCSSRules(document),
            source = embedCSSRulesInSVG(rules, svg);

        source = patchSVGSource(source);

        var blob = new Blob([source], {type: "image/svg+xml;charset=utf-8"}),
            domURL = self.URL || self.webkitURL || self,
            url = domURL.createObjectURL(blob);
        img.src = url;
    }

    function copySVGToImgSafari(svg, img) {
        // Use this method to convert a string buffer array to a binary string.
        // Do so by breaking up large strings into smaller substrings; this is necessary to avoid the
        // "maximum call stack size exceeded" exception that can happen when calling 'String.fromCharCode.apply'
        // with a very long array.
        function buildBinaryString (arrayBuffer) {
            var binaryString = "";
            const utf8Array = new Uint8Array(arrayBuffer);
            const blockSize = 16384;
            for (var i = 0; i < utf8Array.length; i = i + blockSize) {
                const binarySubString = String.fromCharCode.apply(null, utf8Array.subarray(i, i + blockSize));
                binaryString = binaryString + binarySubString;
            }
            return binaryString;
        };

        var rules = getCSSRules(document),
            source = embedCSSRulesInSVG(rules, svg),
            data,
            utf8BinaryString;

        source = patchSVGSource(source);

        // Encode the string as UTF-8 and convert it to a binary string. The UTF-8 encoding is required to
        // capture unicode characters correctly.
        utf8BinaryString = buildBinaryString(new (TextEncoder || TextEncoderLite)('utf-8').encode(source));

        data = "data:image/svg+xml;base64," + btoa(utf8BinaryString);
        img.src = data;
    }

    function patchSVGSource(svgSource) {
        var source = '';
        //add name spaces.
        if (!svgSource.match(/^<svg[^>]+xmlns="http:\/\/www\.w3\.org\/2000\/svg"/)) {
            source = svgSource.replace(/^<svg/, '<svg xmlns="http://www.w3.org/2000/svg"');
        }
        if (!svgSource.match(/^<svg[^>]+"http:\/\/www\.w3\.org\/1999\/xlink"/)) {
            source = svgSource.replace(/^<svg/, '<svg xmlns:xlink="http://www.w3.org/1999/xlink"');
        }

        //add xml declaration
        return '<?xml version="1.0" standalone="no"?>\r\n' + source;
    }

    function copySVGToImg(svg, img) {
        if (browser.isSafari() || browser.isMobileSafari()) {
            copySVGToImgSafari(svg, img);
        } else {
            copySVGToImgMostBrowsers(svg, img);
        }
    }

    function adaptDestSizeToZoom(destinationCanvas, sources) {
        function containsSVGs(source) {
            return source.srcImgTagName === 'svg';
        }

        if (sources.find(containsSVGs) !== undefined) {
            if (pixelRatio < 1) {
                destinationCanvas.width = destinationCanvas.width * pixelRatio;
                destinationCanvas.height = destinationCanvas.height * pixelRatio;
            }
        }
    }

    function prepareImagesToBeComposed(sources, destination) {
        var result = SUCCESSFULIMAGEPREPARATION;
        if (sources.length === 0) {
            result = EMPTYARRAYOFIMAGESOURCES; //nothing to do if called without sources
        } else {
            var minX = sources[0].genLeft;
            var minY = sources[0].genTop;
            var maxX = sources[0].genRight;
            var maxY = sources[0].genBottom;
            var i = 0;

            for (i = 1; i < sources.length; i++) {
                if (minX > sources[i].genLeft) {
                    minX = sources[i].genLeft;
                }

                if (minY > sources[i].genTop) {
                    minY = sources[i].genTop;
                }
            }

            for (i = 1; i < sources.length; i++) {
                if (maxX < sources[i].genRight) {
                    maxX = sources[i].genRight;
                }

                if (maxY < sources[i].genBottom) {
                    maxY = sources[i].genBottom;
                }
            }

            if ((maxX - minX <= 0) || (maxY - minY <= 0)) {
                result = NEGATIVEIMAGESIZE; //this might occur on hidden images
            } else {
                destination.width = Math.round(maxX - minX);
                destination.height = Math.round(maxY - minY);

                for (i = 0; i < sources.length; i++) {
                    sources[i].xCompOffset = sources[i].genLeft - minX;
                    sources[i].yCompOffset = sources[i].genTop - minY;
                }

                adaptDestSizeToZoom(destination, sources);
            }
        }
        return result;
    }

    function copyImgsToCanvas(sources, destination) {
        var prepareImagesResult = prepareImagesToBeComposed(sources, destination);
        if (prepareImagesResult === SUCCESSFULIMAGEPREPARATION) {
            var destinationCtx = destination.getContext('2d');

            for (var i = 0; i < sources.length; i++) {
                if (sources[i].successfullyLoaded === true) {
                    destinationCtx.drawImage(sources[i], sources[i].xCompOffset * pixelRatio, sources[i].yCompOffset * pixelRatio);
                }
            }
        }
        return prepareImagesResult;
    }

    function adnotateDestImgWithBoundingClientRect(srcCanvasOrSvg, destImg) {
        destImg.genLeft = srcCanvasOrSvg.getBoundingClientRect().left;
        destImg.genTop = srcCanvasOrSvg.getBoundingClientRect().top;

        if (srcCanvasOrSvg.tagName === 'CANVAS') {
            destImg.genRight = destImg.genLeft + srcCanvasOrSvg.width;
            destImg.genBottom = destImg.genTop + srcCanvasOrSvg.height;
        }

        if (srcCanvasOrSvg.tagName === 'svg') {
            destImg.genRight = srcCanvasOrSvg.getBoundingClientRect().right;
            destImg.genBottom = srcCanvasOrSvg.getBoundingClientRect().bottom;
        }
    }

    function generateTempImageFromCanvasOrSvg(srcCanvasOrSvg, destImg) {
        if (srcCanvasOrSvg.tagName === 'CANVAS') {
            copyCanvasToImg(srcCanvasOrSvg, destImg);
        }

        if (srcCanvasOrSvg.tagName === 'svg') {
            copySVGToImg(srcCanvasOrSvg, destImg);
        }

        destImg.srcImgTagName = srcCanvasOrSvg.tagName;
        adnotateDestImgWithBoundingClientRect(srcCanvasOrSvg, destImg);
    }

    function failureCallback() {
        return GENERALFAILURECALLBACKERROR;
    }

    // used for testing
    $.plot.composeImages = composeImages;

    function init(plot) {
        // used to extend the public API of the plot
        plot.composeImages = composeImages;
    }

    $.plot.plugins.push({
        init: init,
        name: 'composeImages',
        version: '1.0'
    });
})(jQuery);

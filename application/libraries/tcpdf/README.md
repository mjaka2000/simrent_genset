# TCPDF
*PHP PDF Library*

[![Donate via PayPal](https://img.shields.io/badge/donate-paypal-87ceeb.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&currency_code=GBP&business=paypal@tecnick.com&item_name=donation%20for%20TCPDF%20project)
*Please consider supporting this project by making a donation via [PayPal](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&currency_code=GBP&business=paypal@tecnick.com&item_name=donation%20for%20TCPDF%20project)*

* **category**    Library
* **author**      Nicola Asuni <info@tecnick.com>
* **copyright**   2002-2022 Nicola Asuni - Tecnick.com LTD
* **license**     http://www.gnu.org/copyleft/lesser.html GNU-LGPL v3 (see LICENSE.TXT)
* **link**        http://www.tcpdf.org
* **source**      https://github.com/tecnickcom/TCPDF


## IMPORTANT
A new version of this library is under development at https://github.com/tecnickcom/tc-lib-pdf and as a consequence this version will not receive any additional development or support.
This version should be considered obsolete, new projects should use the new version as soon it will become stable.



## Description

PHP library for generating PDF documents on-the-fly.

### Main Features:
* no external libraries are required for the basic functions;
* all standard page formats, custom page formats, custom margins and units of measure;
* UTF-8 Unicode and Right-To-Left languages;
* TrueTypeUnicode, OpenTypeUnicode v1, TrueType, OpenType v1, Type1 and CID-0 fonts;
* font subsetting;
* methods to publish some XHTML + CSS code, Javascript and Forms;
* images, graphic (geometric figures) and transformation methods;
* supports JPEG, PNG and SVG images natively, all images supported by GD (GD, GD2, GD2PART, GIF, JPEG, PNG, BMP, XBM, XPM) and all images supported via ImagMagick (http://www.imagemagick.org/script/formats.php)
* 1D and 2D barcodes: CODE 39, ANSI MH10.8M-1983, USD-3, 3 of 9, CODE 93, USS-93, Standard 2 of 5, Interleaved 2 of 5, CODE 128 A/B/C, 2 and 5 Digits UPC-Based Extension, EAN 8, EAN 13, UPC-A, UPC-E, MSI, POSTNET, PLANET, RMS4CC (Royal Mail 4-state Customer Code), CBC (Customer Bar Code), KIX (Klant index - Customer index), Intelligent Mail Barcode, Onecode, USPS-B-3200, CODABAR, CODE 11, PHARMACODE, PHARMACODE TWO-TRACKS, Datamatrix, QR-Code, PDF417;
* JPEG and PNG ICC profiles, Grayscale, RGB, CMYK, Spot Colors and Transparencies;
* automatic page header and footer management;
* document encryption up to 256 bit and digital signature certifications;
* transactions to UNDO commands;
* PDF annotations, including links, text and file attachments;
* text rendering modes (fill, stroke and clipping);
* multiple columns mode;
* no-write page regions;
* bookmarks, named destinations and table of content;
* text hyphenation;
* text stretching and spacing (tracking);
* automatic page break, line break and text alignments including justification;
* automatic page numbering and page groups;
* move and delete pages;
* page compression (requires php-zlib extension);
* XOBject Templates;
* Layers and object visibility.
* PDF/A-1b support.

### Third party fonts:

This library may include third party font files released with different licenses.

All the PHP files on the fonts directory are subject to the general TCPDF license (GNU-LGPLv3),
they do not contain any binary data but just a description of the general properties of a particular font.
These files can be also generated on the fly using the font utilities and TCPDF methods.

All the original binary TTF font files have been renamed for compatibility with TCPDF and compressed using the gzcompress PHP function that uses the ZLIB data format (.z files).

The binary files (.z) that begins with the prefix "free" have been extracted from the GNU FreeFont collection (GNU-GPLv3).
The binary files (.z) that begins with the prefix "pdfa" have been derived from the GNU FreeFont, so they are subject to the same license.
For the details of Copyright, License and other information, please check the files inside the directory fonts/freefont-20120503
Link : http://www.gnu.org/software/freefont/

The binary files (.z) that begins with the prefix "dejavu" have been extracted from the DejaVu fonts 2.33 (Bitstream) collection.
For the details of Copyright, License and other information, please check the files inside the directory fonts/dejavu-fonts-ttf-2.33
Link : http://dejavu-fonts.org

The binary files (.z) that begins with the prefix "ae" have been extracted from the Arabeyes.org collection (GNU-GPLv2).
Link : http://projects.arabeyes.org/

### ICC profile:

TCPDF includes the sRGB.icc profile from the icc-profiles-free Debian package:
https://packages.debian.org/source/stable/icc-profiles-free


## Developer(s) Contact

* Nicola Asuni <info@tecnick.com>
rent"}).nodes().toArray()),j={},i=[],k=[],p=this.s.getDataFn,o=this.s.setDataFn;a=0;for(f=n.length;a<f;a++)if(n[a]!==l[a]){var q=b.row(l[a]).id(),u=b.row(l[a]).data(),r=b.row(n[a]).data();q&&(j[q]=p(r));i.push({node:l[a],oldData:p(u),newData:p(r),newPosition:a,oldPosition:e.inArray(l[a],n)});k.push(l[a])}var s=[i,{dataSrc:h,nodes:k,values:j,triggerRow:b.row(this.dom.target),originalEvent:d}];this._emitEvent("row-reorder",
s);var t=function(){if(c.c.update){a=0;for(f=i.length;a<f;a++){var d=b.row(i[a].node).data();o(d,i[a].newData);b.columns().every(function(){this.dataSrc()===h&&b.cell(i[a].node,this.index()).invalidate("data")})}c._emitEvent("row-reordered",s);b.draw(!1)}};this.c.editor?(this.c.enable=!1,this.c.editor.edit(k,!1,e.extend({submit:"changed"},this.c.formOptions)).multiSet(h,j).one("preSubmitCancelled.rowReorder",function(){c.c.enable=!0;c.c.editor.off(".rowReorder");b.draw(!1)}).one("submitUnsuccessful.rowReorder",
function(){b.draw(!1)}).one("submitSuccess.rowReorder",function(){t()}).one("submitComplete",function(){c.c.enable=!0;c.c.editor.off(".rowReorder")}).submit()):t()},_shiftScroll:function(d){var c=this,b=this.s.scroll,a=!1,i=d.pageY-g.body.scrollTop,h,j;i<e(f).scrollTop()+65?h=-5:i>b.windowHeight+e(f).scrollTop()-65&&(h=5);null!==b.dtTop&&d.pageY<b.dtTop+65?j=-5:null!==b.dtTop&&d.pageY>b.dtTop+b.dtHeight-65&&(j=5);h||j?(b.windowVert=h,b.dtVert=j,a=!0):this.s.scrollInterval&&(clearInterval(this.s.scrollInterval),
this.s.scrollInterval=null);!this.s.scrollInterval&&a&&(this.s.scrollInterval=setInterval(function(){if(b.windowVert){var a=e(g).scrollTop();e(g).scrollTop(a+b.windowVert);if(a!==e(g).scrollTop()){a=parseFloat(c.dom.clone.css("top"));c.dom.clone.css("top",a+b.windowVert)}}if(b.dtVert){a=c.dom.dtScroll[0];if(b.dtVert)a.scrollTop=a.scrollTop+b.dtVert}},20))}});j.defaults={dataSrc:0,editor:null,enable:!0,formOptions:{},selector:"td:first-child",snapX:!1,update:!0,excludedChildren:"a"};var k=e.fn.dataTable.Api;
k.register("rowReorder()",function(){return this});k.register("rowReorder.enable()",function(d){d===o&&(d=!0);return this.iterator("table",function(c){c.rowreorder&&(c.rowreorder.c.enable=d)})});k.register("rowReorder.disable()",function(){return this.iterator("table",function(d){d.rowreorder&&(d.rowreorder.c.enable=!1)})});j.version="1.2.6";e.fn.dataTable.RowReorder=j;e.fn.DataTable.RowReorder=j;e(g).on("init.dt.dtr",function(d,c){if("dt"===d.namespace){var b=c.oInit.rowReorder,a=i.defaults.rowReorder;
if(b||a)a=e.extend({},b,a),!1!==b&&new j(c,a)}});return j});

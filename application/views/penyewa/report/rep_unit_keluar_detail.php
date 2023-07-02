<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/style/paper.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/style/style.css">
    <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/style/style-rep.css"> -->

    <style>
        @page {
            size: A4
        }

        /* h4 {
            font-weight: bold;
            font-size: 13pt;
            text-align: center;
        } */

        table {
            border-collapse: collapse;
            /* width: 100%; */
        }

        .table th {
            padding: 8px 8px;
            /* border: 1px solid #000000; */
            text-align: left;

        }

        .table td {
            padding: 3px 3px;
            /* border: 1px solid #000000; */
        }

        .text-center {
            text-align: center;
        }

        .horizontal_center {
            border-top: 3px solid black;
            height: 2px;
            line-height: 30px;
        }

        .kanan {
            float: right;
        }
    </style>
</head>

<body class="A4">
    <section class="sheet padding-10mm">
        <table border="0">
            <tr>
                <th align="left">
                    <img src="<?= base_url() ?>assets/style/logo/KOP_SURAT_WARDAH_SOLUTION.png" alt="" width="100%">
                </th>
                <!-- <th>
                    <p align="center" style="font-family:Arial; font-size:15pt"> PT. RAHMAT TAUFIK RAMADAN </p>
                </th> -->
            </tr>
            <tr>
                <td align="right">
                    <hr>
                    <!-- <small>Tanggal Dicetak: <?= format_indo(date('Y-m-d')); ?></small> -->
                </td>
            </tr>
        </table>
        <h2 align="center">Laporan Penyewaan </h2><span>
            <!-- <p align="right" style="font-size:10pt">Tanggal Dicetak: <?= format_indo(date('Y-m-d')); ?></p> -->
        </span>
        <!-- <?php echo $label ?> -->
        <div class="row tengah">
            <?php foreach ($list_data as $d) { ?>
                <table class="table" rules="rows" style="width:75%">
                    <tr>
                        <th style="vertical-align: middle">ID Transaksi</th>
                        <td style="vertical-align: middle;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        :&nbsp;<?= $d->id_transaksi; ?>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle">Tanggal</th>
                        <td style="vertical-align: middle;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        :&nbsp;<?= date('d-m-Y', strtotime($d->tanggal_keluar)); ?> s/d <?= date('d-m-Y', strtotime($d->tanggal_masuk)); ?></div>

                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <th style="vertical-align: middle">Lokasi</th>
                        <td style="vertical-align: middle;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        :&nbsp;<?= $d->lokasi; ?>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle">Nama Operator</th>
                        <td style="vertical-align: middle;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        :&nbsp;<?= $d->nama_op; ?>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle">Nama Pelanggan</th>
                        <td style="vertical-align: middle;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        :&nbsp;<?= $d->nama_plg; ?>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle">Nomor Genset</th>
                        <td style="vertical-align: middle;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        :&nbsp;<?= $d->kode_genset; ?> </div>

                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle">Nama Genset</th>
                        <td style="vertical-align: middle;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        :&nbsp;<?= $d->nama_genset; ?> </div>

                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle">Daya</th>
                        <td style="vertical-align: middle;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        :&nbsp;<?= $d->daya; ?> </div>

                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle">Harga (Perhari)</th>
                        <td style="vertical-align: middle;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        :&nbsp;Rp&nbsp;<?= number_format($d->harga); ?> </div>

                                </div>
                            </div>
                        </td>
                    </tr>
                    <!-- <tr>
                        <th style="vertical-align: middle">Nopol Mobil</th>
                        <td style="vertical-align: middle;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        :&nbsp;<?= $d->nopol; ?> </div>

                                </div>
                            </div>
                        </td>
                    </tr> -->
                    <!-- <tr>
                        <th style="vertical-align: middle">Merek</th>
                        <td style="vertical-align: middle;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        :&nbsp;<?= $d->merek; ?> </div>

                                </div>
                            </div>
                        </td>
                    </tr> -->
                    <tr>
                        <th style="vertical-align: middle">Tambahan</th>
                        <td style="vertical-align: middle;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        :&nbsp;<?= $d->tambahan; ?> </div>

                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle">Jumlah Hari</th>
                        <td style="vertical-align: middle;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        :&nbsp;<?= $d->jumlah_hari; ?> </div>

                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle">Total Harga (Rp)</th>
                        <td style="vertical-align: middle;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        :&nbsp;Rp&nbsp;<?= number_format($d->total); ?> </div>

                                </div>
                            </div>
                        </td>
                    </tr>

                </table>
            <?php } ?>
        </div>
        <tr>
            <td><br><br><br><br><br><br><br></td>
            <td align="center">Banjarmasin, <?= format_indo(date('Y-m-d')); ?><br>Mengetahui,<br>Pimpinan</td>
        </tr>
        <tr>
            <td colspan="2" align="center">......................................</td>
        </tr>
    </section>

</body>

</html>
<script type="text/javascript">
    window.print();
</script>
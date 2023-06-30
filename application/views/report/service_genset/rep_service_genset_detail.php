<?php $this->load->view('template/head_rep'); ?>


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
                    <small>Tanggal Dicetak: <?= format_indo(date('Y-m-d')); ?></small>
                </td>
            </tr>
        </table>
        <h2 align="center">Laporan Perbaikan Genset</h2><span>
            <!-- <p align="right" style="font-size:10pt">Tanggal Dicetak: <?= format_indo(date('Y-m-d')); ?></p> -->
        </span>
        <div class="row tengah">
            <table class="table" style="width:50%">
                <?php foreach ($list_data as $d) : ?>
                    <tr>
                        <th style="vertical-align: middle">Nomor Genset</th>
                        <td style="vertical-align: middle;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        :&nbsp;<?= $d->kode_genset; ?>

                                    </div>
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
                        <th style="vertical-align: middle">Jenis Perbaikan</th>
                        <td style="vertical-align: middle;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        :&nbsp;<?= $d->jenis_perbaikan; ?> </div>

                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle">Spare Part</th>
                        <td style="vertical-align: middle;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        :&nbsp;<?= $d->nama_sparepart; ?> </div>

                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle">Tgl. Perbaikan</th>
                        <td style="vertical-align: middle;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        :&nbsp;<?= date('d-m-Y', strtotime($d->tgl_perbaikan)); ?>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle">Ket. Perbaikan</th>
                        <form action="<?= site_url('admin/proses_update_ket_service'); ?>" method="post" role="form">
                            <td style="vertical-align: middle;">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row">
                                            :&nbsp;<?php if ($d->ket_perbaikan == "1") { ?>
                                            Selesai Diperbaiki
                                        <?php } else { ?>
                                            Masih Terkendala
                                        <?php } ?>
                                        </div>

                                    </div>
                                </div>
                            </td>
                        </form>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle">Biaya Perbaikan</th>
                        <td style="vertical-align: middle;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        :&nbsp;Rp&nbsp;<?= number_format($d->biaya_perbaikan); ?> </div>

                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <br>
        <br>

        <table align="center" class="table" style="width:100%">
            <thead>
                <tr>
                    <th colspan="6" style="text-align: center;">Tracking Aktivitas Perbaikan Genset</th>
                </tr>
                <tr>
                    <th style="width :10px">No.</th>
                    <th>Pekerjaan</th>
                    <th>Tanggal</th>
                    <th>Kendala</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                ?>
                <?php foreach ($detail_perbaikan as $dt) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $dt->pekerjaan; ?></td>
                        <td><?= date('d-m-Y', strtotime($dt->tanggal)); ?></td>
                        <td><?= $dt->kendala; ?></td>
                        <td><?= $dt->status; ?></td>

                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
        <table>
            <tr>
                <td><br><br><br><br><br><br><br></td>
                <td align="right">Banjarmasin, <?= format_indo(date('Y-m-d')); ?></td>
            </tr>
            <tr>
                <td colspan="2" align="right">
                    <?= $this->session->userdata('nama') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
            </tr>

        </table>
    </section>

</body>

</html>
<script type="text/javascript">
    window.print();
</script>
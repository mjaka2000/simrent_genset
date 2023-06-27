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
        <!-- <?php echo $label ?> -->
        <div class="row tengah">
            <table id="examplejk" class="table table-bordered table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th style="width :10px">No.</th>
                        <th>Nomor Genset</th>
                        <th>Nama Genset</th>
                        <th>Jenis Perbaikan</th>
                        <th>Spare Part (Diganti)</th>
                        <th>Tgl. Perbaikan</th>
                        <th>Ket. Perbaikan</th>
                        <th>Biaya Perbaikan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    ?>
                    <?php foreach ($list_data as $dt) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $dt->kode_genset; ?></td>
                            <td><?= $dt->nama_genset; ?></td>
                            <td><?= $dt->jenis_perbaikan; ?></td>
                            <td><?= $dt->nama_sparepart; ?></td>
                            <td><?= date('d-m-Y', strtotime($dt->tgl_perbaikan)); ?></td>
                            <?php if ($dt->ket_perbaikan == "1") { ?>
                                <td>Selesai Diperbaiki</td>
                            <?php } else { ?>
                                <td>Masih Terkendala</td>
                            <?php } ?>
                            <td>Rp <?= number_format($dt->biaya_perbaikan); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <table>
                <tr>

                    <td><br><br><br><br><br><br><br><br><br><br><br><br></td>
                    <td align="right">Banjarmasin, <?= format_indo(date('Y-m-d')); ?></td>
                </tr>
                <tr>
                    <td colspan="2" align="right">
                        <?= $this->session->userdata('nama') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                </tr>

            </table>
        </div>
    </section>

</body>

</html>
<script type="text/javascript">
    window.print();
</script>
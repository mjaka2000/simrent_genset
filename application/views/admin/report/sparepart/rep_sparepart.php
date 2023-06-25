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
        <h2 align="center">Laporan Data Stok Sparepart</h2><span>
            <!-- <p align="right" style="font-size:10pt">Tanggal Dicetak: <?= format_indo(date('Y-m-d')); ?></p> -->
        </span>
        <!-- <?php echo $label ?> -->
        <div class="row tengah">
            <table id="examplejk" class="table table-bordered table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th style="width :10px">No.</th>
                        <th>Nama Sparepart</th>
                        <th>Tanggal Beli</th>
                        <th>Tempat Beli</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    // $list_data = isset($_POST['list_data']) ? $_POST['list_data'] : '';
                    if (is_array($list_sparepart)) { ?>
                        <?php foreach ($list_sparepart as $dt) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $dt->nama_sparepart; ?></td>
                                <td><?= date('d-m-Y', strtotime($dt->tanggal_beli)); ?></td>
                                <td><?= $dt->tempat_beli; ?></td>
                                <td><?= $dt->stok; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php } else { ?>
                        <td colspan="9" align="center"><strong>Data Kosong</strong></td>
                    <?php } ?>
                </tbody>
            </table>
            <table>
                <tr>

                    <td><br><br><br><br><br><br><br><br><br><br><br><br></td>
                    <td align="right">Banjarmasin, <?= format_indo(date('Y-m-d')); ?></td>
                </tr>
                <tr>
                    <td colspan="2" align="right">
                        <?= $this->session->userdata('name') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
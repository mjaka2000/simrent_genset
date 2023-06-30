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
        <h2 align="center">Laporan Penyewaan </h2><span>
            <!-- <p align="right" style="font-size:10pt">Tanggal Dicetak: <?= format_indo(date('Y-m-d')); ?></p> -->
        </span>

        <div class="row tengah">
            <table id="examplejk" class="table table-bordered table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th style="width :10px">No.</th>
                        <th>ID</th>
                        <th>Tanggal Keluar</th>
                        <th>Tanggal Masuk (Kembali)</th>
                        <th>Lokasi</th>
                        <th>Nama Pelanggan</th>
                        <th>Nama Genset</th>
                        <th>Daya</th>
                        <th>Mobil</th>
                        <th>Jml. Hari</th>
                        <th>Total</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    // $list_data = isset($_POST['list_data']) ? $_POST['list_data'] : '';
                    ?>
                    <?php foreach ($list_data as $dt) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $dt->id_transaksi; ?></td>
                            <td><?= date('d-m-Y', strtotime($dt->tanggal_keluar)); ?></td>
                            <td><?= date('d-m-Y', strtotime($dt->tanggal_masuk)); ?></td>
                            <td><?= $dt->lokasi; ?></td>
                            <td><?= $dt->nama_plg; ?></td>
                            <td><?= $dt->nama_genset; ?></td>
                            <td><?= $dt->daya; ?></td>
                            <td><?= $dt->nopol; ?></td>
                            <td><?= $dt->jumlah_hari; ?></td>
                            <td>Rp&nbsp;<?= number_format($dt->total); ?></td>

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
        </div>
    </section>

</body>

</html>
<script type="text/javascript">
    window.print();
</script>
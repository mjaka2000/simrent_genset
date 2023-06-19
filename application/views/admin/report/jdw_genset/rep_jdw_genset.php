<?php $this->load->view('template/head_rep'); ?>


<body class="A4">
    <section class="sheet padding-10mm">

        <h4 style="margin-bottom: 5px;">Laporan Jadwal Penyewaan Genset</h4>
        <!-- <?php echo $label ?> -->
        <?php foreach ($list_data as $dt) { ?>
            <div class="row tengah">
                <table class="table">
                    <tr>
                        <th style="vertical-align: middle">Tanggal Keluar</th>
                        <td style="vertical-align: middle;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        :&nbsp;<?= date('d-m-Y', strtotime($dt->tanggal_keluar)); ?>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle">Tanggal Masuk</th>
                        <td style="vertical-align: middle;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        :&nbsp;<?= date('d-m-Y', strtotime($dt->tanggal_masuk)); ?> </div>

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
                                        :&nbsp;<?= $dt->lokasi; ?> </div>

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
                                        :&nbsp;<?= $dt->kode_genset; ?> </div>

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
                                        :&nbsp;<?= $dt->nama_genset; ?>

                                    </div>
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
                                        :&nbsp;<?= $dt->daya; ?>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle">Harga Perhari</th>
                        <td style="vertical-align: middle;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        :&nbsp;Rp&nbsp;<?= number_format($dt->harga); ?>

                                    </div>
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
                                        :&nbsp;<?= $dt->jumlah_hari; ?>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                </table>
            <?php } ?>
            </div>
    </section>

</body>

</html>
<script type="text/javascript">
    window.print();
</script>
<?php $this->load->view('template/head'); ?>
<?php $this->load->view('guest/template/nav'); ?>
<?php $this->load->view('guest/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Data Perbaikan Genset</h1>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('guest') ?>">Home</a></li>
            <li class="breadcrumb-item active">Data Perbaikan Genset</li>
        </ol>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div id="loading">
            <img src="<?= base_url(); ?>assets/style/loading.gif" alt="loading" width="50%">
        </div>
        <div class="row">
            <div class="col-xs-12">
                <!-- Default box -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Perbaikan Genset</h3>
                    </div>
                    <div class="box-body">
                        <?php if ($this->session->flashdata('msg_sukses')) { ?>
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                            </div>
                        <?php } ?>

                        <table id="mytable" class="table table-bordered table-hover" style="width:100%">
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
                                // $list_data = isset($_POST['list_data']) ? $_POST['list_data'] : '';
                                if (is_array($list_data)) {
                                ?>
                                    <?php foreach ($list_data as $dt) :
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $dt->kode_genset; ?></td>
                                            <td><?= $dt->nama_genset; ?></td>
                                            <td><?= $dt->jenis_perbaikan; ?></td>
                                            <td><?= $dt->spare_part; ?></td>
                                            <td><?= $dt->tgl_perbaikan; ?></td>
                                            <td><?= $dt->ket_perbaikan; ?></td>
                                            <td>Rp&nbsp;<?= $dt->biaya_perbaikan; ?></td>

                                        </tr>
                                    <?php endforeach;
                                    ?>
                                <?php } else {
                                ?>
                                    <td colspan="9" align="center"><strong>Data Kosong</strong></td>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('guest/template/script') ?>
</body>

</html>
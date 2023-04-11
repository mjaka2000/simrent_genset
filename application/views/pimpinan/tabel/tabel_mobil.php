<?php $this->load->view('template/head'); ?>
<?php $this->load->view('guest/template/nav'); ?>
<?php $this->load->view('guest/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Data Mobil</h1>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('guest') ?>">Home</a></li>
            <li class="breadcrumb-item active">Data Mobil</li>
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
                        <h3 class="box-title">Data Mobil</h3>
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
                                    <th>Merek</th>
                                    <th>Tipe</th>
                                    <th>Tahun</th>
                                    <th>Nopol</th>
                                    <th>Jenis BBM</th>
                                    <th>Pajak</th>
                                    <th>STNK</th>
                                    <th>Gambar</th>
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
                                            <td><?= $dt->merek; ?></td>
                                            <td><?= $dt->tipe; ?></td>
                                            <td><?= $dt->tahun; ?></td>
                                            <td><?= $dt->nopol; ?></td>
                                            <td><?= $dt->jenis_bbm; ?></td>
                                            <td><?= $dt->pajak; ?></td>
                                            <td><?= $dt->stnk; ?></td>
                                            <td><img src="<?= base_url('assets/upload/mobil/' . $dt->gambar_mobil); ?>" class="img-box" width="100" height="100" alt="<?= $dt->nopol; ?>"></td>
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
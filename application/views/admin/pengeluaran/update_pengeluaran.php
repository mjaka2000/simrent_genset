<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pengeluaran</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/tabel_pengeluaran'); ?>">Pengeluaran</a></li>
                        <li class="breadcrumb-item active">Ubah Data </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row tengah">
                <div class="col-md-5 ">
                    <div class="card">
                        <div class="card-header">
                            Ubah Data Pengeluaran
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissable">
                                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>
                            <?php if (validation_errors()) { ?>
                                <div class="alert alert-warning alert-dismissable">
                                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                    <strong>Peringatan!</strong><br> <?php echo validation_errors(); ?>
                                </div>
                            <?php } ?>

                            <form action="<?= site_url('admin/proses_edit_pengeluaran'); ?>" method="post" role="form">
                                <?php foreach ($list_data as $dt) { ?>
                                    <input type="hidden" name="id_pengeluaran" value="<?= $dt->id_pengeluaran; ?>">
                                    <div class="form-group">
                                        <label for="nama" class="form-label">Tanggal</label>

                                        <input type="date" name="tgl_pengeluaran" class="form-control" id="tgl_pengeluaran" placeholder="Masukkan Tanggal" required value="<?= $dt->tgl_pengeluaran; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat" class="form-label">Keterangan Pengeluaran</label>

                                        <input type="text" name="pengeluaran" class="form-control" id="pengeluaran" placeholder="Masukkan Keterangan Pengeluaran" required value="<?= $dt->pengeluaran; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="no_hp" class="form-label">Biaya Pengeluaran</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon">Rp</span>
                                            </div>
                                            <input type="text" name="biaya_pengeluaran" class="form-control" id="biaya_pengeluaran" placeholder="Masukkan Biaya Pengeluaran" required value="<?= $dt->biaya_pengeluaran; ?>">
                                        </div>
                                    </div>
                                <?php } ?>
                                <hr>
                                <div class="form-group" align="center">
                                    <button onclick="history.back(-1)" type="button" class="btn btn-sm btn-default" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Kembali</button>
                                    <!-- <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-eraser mr-2"></i>Reset</button> -->
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check mr-2"></i>Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
<?php $this->load->view('template/footer'); ?>

<?php $this->load->view('admin/template/script') ?>

</body>

</html>
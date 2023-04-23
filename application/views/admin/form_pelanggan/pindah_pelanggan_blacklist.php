<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Blacklist Pelanggan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/tabel_pelanggan'); ?>">Pelanggan</a></li>
                        <li class="breadcrumb-item active">Blacklist Pelanggan</li>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="width: 30%; margin-left: 35%;">
                        <div class="card-header"><i class="fas fa-edit"></i>
                            Blacklist Pelanggan
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
                                    <strong>Perhatian!</strong><br> <?php echo validation_errors(); ?>
                                </div>
                            <?php } ?>

                            <form action="<?= base_url('admin/proses_blacklist_pelanggan'); ?>" method="post" role="form">
                                <?php if (is_array($list_plg)) { ?>
                                    <?php foreach ($list_plg as $d) { ?>
                                        <div class="form-group">
                                            <input type="hidden" name="id_pelanggan" value="<?= $d->id_pelanggan; ?>">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" name="nama_plg_blk" class="form-control" id="nama_plg_blk" placeholder="Masukkan Nama" readonly required value="<?= $d->nama_plg; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <input type="text" name="alamat_plg_blk" class="form-control" id="alamat_plg_blk" placeholder="Masukkan Alamat" readonly required value="<?= $d->alamat_plg; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="no_hp" class="form-label">No. HP</label>
                                            <input type="text" maxlength="13" name="nohp_plg_blk" class="form-control" id="nohp_plg_blk" placeholder="Masukkan No. HP" readonly required onkeypress='return (event.charCode > 47 && event.charCode < 58)' value="<?= $d->nohp_plg; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                            <input type="text" name="jk_plg_blk" class="form-control" id="jk_plg_blk" placeholder="Jenis Kelamin" readonly required value="<?= $d->jk_plg; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                                            <input type="text" name="namaperusahaan_plg_blk" class="form-control" id="namaperusahaan_plg_blk" placeholder="Nama Perusahaan" readonly required value="<?= $d->namaperusahaan_plg; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_update" class="form-label">Tanggal Update</label>
                                            <input type="date" name="tglupdate_plg_blk" class="form-control" id="tglupdate_plg_blk" readonly placeholder="Tanggal Update" required value="<?= $d->tglupdate_plg; ?>">
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                                <hr>
                                <div class="form-group" align="center">
                                    <button onclick="window.location.href='<?= base_url('admin/tabel_pelanggan'); ?>'" type="button" class="btn btn-sm btn-default" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Kembali</button>
                                    <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-eraser mr-2"></i>Reset</button>
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
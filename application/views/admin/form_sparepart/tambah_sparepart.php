<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Stok Sparepart</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/tabel_sparepart'); ?>">Stok Sparepart</a></li>
                        <li class="breadcrumb-item active">Tambah Data </li>
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
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            Tambah Data Stok Sparepart
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

                            <form action="<?= site_url('admin/proses_tambah_sparepart'); ?>" method="post" role="form">

                                <div class="form-group row">
                                    <label for="nama_sparepart" class="col-sm-3 col-form-label">Nama Sparepart</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nama_sparepart" class="form-control" id="nama_sparepart" placeholder="Masukkan Nama Sparepart" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal_beli" class="col-sm-3 col-form-label">Tanggal Beli</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="tanggal_beli" class="form-control" id="tanggal_beli" placeholder="Masukkan Tanggal Beli" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tempat_beli" class="col-sm-3 col-form-label">Tempat Beli</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="tempat_beli" class="form-control" id="tempat_beli" placeholder="Masukkan Tempat Beli" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="stok" class="col-sm-3 col-form-label">Stok</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="stok" class="form-control" id="stok" placeholder="Masukkan Stok yang Dibeli" required onkeypress='return (event.charCode > 47 && event.charCode < 58)'>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group" align="center">
                                    <button onclick="history.back(-1)" type="button" class="btn btn-sm btn-default" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Kembali</button>
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
<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Genset</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/tabel_genset'); ?>">Genset</a></li>
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
                            Tambah Data Genset
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

                            <form action="<?= site_url('admin/proses_tambahgenset'); ?>" method="post" role="form" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="kode_genset" class="form-label">Nomor Genset</label>

                                    <input type="text" name="kode_genset" class="form-control" id="kode_genset" placeholder="Masukkan Nomor Genset" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama_genset" class="form-label">Nama Genset</label>

                                    <input type="text" name="nama_genset" class="form-control" id="nama_genset" placeholder="Masukkan Nama Genset" required>
                                </div>
                                <div class="form-group">
                                    <label for="daya" class="form-label">Daya (KVA)</label>

                                    <input type="text" name="daya" class="form-control" id="daya" placeholder="Daya" required onkeypress='return (event.charCode > 47 && event.charCode < 58)'>
                                </div>
                                <div class="form-group">
                                    <label for="harga" class="form-label">Harga</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon">Rp</span>
                                        </div>
                                        <input type="text" name="harga" class="form-control" id="harga" placeholder="Harga Unit Perhari" required onkeypress='return (event.charCode > 47 && event.charCode < 58)'>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="gambar_genset" class="form-label">Gambar Genset</label>

                                    <input type="file" name="gambar_genset" class="form-control" id="gambar_genset">
                                    <small style="color: red;">
                                        <p>*File yang diijinkan "jpg|png|jpeg", max size 2MB.</p>
                                    </small>
                                </div>
                                <hr>
                                <div class="form-group" align="center">
                                    <button onclick="history.back(-1)" type="button" class="btn btn-sm btn-default" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Kembali</button>
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
<?php $this->load->view('template/script') ?>



</body>

</html>
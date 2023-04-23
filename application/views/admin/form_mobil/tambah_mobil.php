<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Mobil</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/tabel_mobil'); ?>">Mobil</a></li>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="width: 30%; margin-left: 35%;">
                        <div class="card-header"><i class="fas fa-plus"></i>
                            Tambah Data Mobil
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

                            <form action="<?= base_url('admin/proses_tambah_mobil'); ?>" method="post" role="form" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="merek" class="form-label">Merek</label>
                                    <input type="text" name="merek" class="form-control" id="merek" placeholder="Merek" required>
                                </div>
                                <div class="form-group">
                                    <label for="tipe" class="form-label">Tipe</label>
                                    <input type="text" name="tipe" class="form-control" id="tipe" placeholder="Tipe" required>
                                </div>
                                <div class="form-group">
                                    <label for="tahun" class="form-label">Tahun</label>
                                    <input type="text" name="tahun" maxlength="4" class="form-control" id="tahun" placeholder="Tahun" required>
                                </div>
                                <div class="form-group">
                                    <label for="nopol" class="form-label">Nopol</label>
                                    <input type="nopol" name="nopol" class="form-control" id="nopol" placeholder="Nopol" required>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_bbm" class="form-label">Jenis BBM</label>
                                    <select name="jenis_bbm" id="jenis_bbm" class="form-control">
                                        <option value="">-- Pilih Jenis BBM --</option>
                                        <option value="Bensin">Bensin</option>
                                        <option value="Solar">Solar</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pajak" class="form-label">Pajak</label>&nbsp;<span style="color: red;"><small>*1 Th</small></span>
                                    <input type="date" name="pajak" class="form-control form_datetime" id="pajak" placeholder="Pajak" required>
                                </div>
                                <div class="form-group">
                                    <label for="stnk" class="form-label">STNK</label>&nbsp;<span style="color: red;"><small>*5 Th</small></span>
                                    <input type="date" name="stnk" class="form-control form_datetime" id="stnk" placeholder="STNK" required>
                                </div>
                                <div class="form-group">
                                    <label for="gambar_mobil" class="form-label">Gambar Mobil</label>
                                    <input type="file" name="gambar_mobil" class="form-control" id="gambar_mobil">
                                </div>

                                <hr>
                                <div class="form-group" align="center">
                                    <button onclick="window.location.href='<?= base_url('admin/tabel_mobil'); ?>'" type="button" class="btn btn-sm btn-default" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Kembali</button>
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
<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pelanggan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/tabel_pelanggan'); ?>">Pelanggan</a></li>
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
                            Ubah Data Pelanggan
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

                            <form action="<?= site_url('admin/proses_update_pelanggan'); ?>" method="post" role="form">
                                <?php foreach ($list_data as $d) { ?>
                                    <div class="form-group">
                                        <input type="hidden" name="id_pelanggan" value="<?= $d->id_pelanggan; ?>">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" name="nama_plg" class="form-control" id="nama_plg" placeholder="Masukkan Nama" required value="<?= $d->nama_plg; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="text" name="alamat_plg" class="form-control" id="alamat_plg" placeholder="Masukkan Alamat" required value="<?= $d->alamat_plg; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="no_hp" class="form-label">No. HP</label>
                                        <input type="text" maxlength="13" name="nohp_plg" class="form-control" id="nohp_plg" placeholder="Masukkan No. HP" required onkeypress='return (event.charCode > 47 && event.charCode < 58)' value="<?= $d->nohp_plg; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                        <select name="jk_plg" id="jk_plg" class="form-control">
                                            <option value="">-- Pilih --</option>
                                            <?php if ($d->jk_plg == "Laki-Laki") { ?>
                                                <option value="Laki-Laki" selected>Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            <?php } else { ?>
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan" selected>Perempuan</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                                        <input type="text" name="namaperusahaan_plg" class="form-control" id="nama_perusahaan" placeholder="Nama Perusahaan" required value="<?= $d->namaperusahaan_plg; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_update" class="form-label">Tanggal Update</label>
                                        <input type="date" name="tglupdate_plg" class="form-control" id="tanggal_update" placeholder="Tanggal Update" required value="<?= $d->tglupdate_plg; ?>">
                                    </div>
                                <?php } ?>
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
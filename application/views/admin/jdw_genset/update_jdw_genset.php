<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Jadwal Penyewaan Genset</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/tabel_jdw_genset'); ?>">Jadwal Penyewaan Genset</a></li>
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
                            Ubah Data Jadwal Penyewaan Genset
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

                            <form action="<?= site_url('admin/proses_ubah_jdw_genset'); ?>" method="post" role="form">
                                <?php foreach ($list_data as $ed) { ?>
                                    <input type="hidden" name="id_jadwal_genset" value="<?= $ed->id_jadwal_genset; ?>">

                                    <div class="form-group row">
                                        <label for="nama_operator" class="col-sm-3 col-form-label">Nama Operator</label>
                                        <div class="col-sm-9">
                                            <select name="id_operator" class="form-control" id="nama_operator" required>
                                                <option value="">-- Pilih Operator --</option>
                                                <?php foreach ($list_operator as $op) { ?>
                                                    <?php if ($ed->id_operator == $op->id_operator) { ?>
                                                        <option value="<?= $ed->id_operator ?>" selected><?= $op->nama_op ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $op->id_operator ?>"><?= $op->nama_op ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kode_genset" class="col-sm-3 col-form-label">Genset</label>
                                        <div class="col-sm-9">
                                            <select name="id_genset" class="form-control" id="kode_genset" required>
                                                <option value="">-- Pilih Genset--</option>
                                                <?php foreach ($list_genset as $g) { ?>
                                                    <?php if ($ed->id_genset == $g->id_genset) { ?>
                                                        <option value="<?= $ed->id_genset ?>" selected><?= $g->kode_genset ?> - <?= $g->nama_genset; ?> - <?= $g->daya; ?> KVA</option>
                                                    <?php } else { ?>
                                                        <option value="<?= $g->id_genset ?>"><?= $g->kode_genset ?> - <?= $g->nama_genset; ?> - <?= $g->daya; ?> KVA</option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nopol_mobil" class="col-sm-3 col-form-label">Mobil</label>
                                        <div class="col-sm-9">
                                            <select name="id_mobil" id="nopol" class="form-control" required>
                                                <option value="">-- Pilih Mobil--</option>
                                                <?php foreach ($list_mobil as $m) { ?>
                                                    <?php if ($ed->id_mobil == $m->id_mobil) { ?>
                                                        <option value="<?= $ed->id_mobil ?>" selected><?= $m->nopol ?> - <?= $m->merek; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $m->id_mobil ?>"><?= $m->nopol ?> - <?= $m->merek; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="genset" class="col-sm-3 col-form-label">Tanggal Digunakan</label>
                                        <div class="col-sm-9">
                                            <input type="date" name="tgl_keluar" class="form-control" id="tgl_keluar" value="<?= $ed->tgl_keluar; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="genset" class="col-sm-3 col-form-label">Sampai Tanggal</label>
                                        <div class="col-sm-9">
                                            <input type="date" readonly name="tgl_masuk" class="form-control" id="tgl_masuk" value="<?= $ed->tgl_masuk; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="genset" class="col-sm-3 col-form-label">Jumlah Hari</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="jumlah_hari" class="form-control" id="jumlah_hari" placeholder="Masukkan Jumlah Hari" value="<?= $ed->jumlah_hari; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lokasi" class="col-sm-3 col-form-label">Lokasi</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="lokasi" class="form-control" id="lokasi" placeholder="Masukkan Lokasi Tujuan" required value="<?= $ed->lokasi; ?>">

                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
    <label for="genset" class="form-label">Nama Pelanggan</label>
    <input type="text" readonly name="nama_plg" class="form-control" id="nama_plg">
</div> -->
                                    <div class="form-group row">
                                        <label for="tahun" class="col-sm-3 col-form-label">Keterangan</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Masukkan Keterangan" required value="<?= $ed->keterangan; ?>">
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
<?php $this->load->view('template/head'); ?>
<?php $this->load->view('guest/template/nav'); ?>
<?php $this->load->view('guest/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Permohonan Pemakaian Genset</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('guest') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('guest/tabel_barang_keluar'); ?>"> Data Genset Keluar</a></li>
            <li class="breadcrumb-item active">Permohonan Pemakaian Genset</li>
        </ol>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div id="loading">
            <img src="<?= base_url(); ?>assets/style/loading.gif" alt="loading" width="50%">
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <div class="box box-primary" style="width:50%;margin:auto">
                        <div class="box-header">
                            <h3 class="box-title"><i class="nav-icon fa fa-plus-circle mr-2"></i>Permohonan Pemakaian Genset</h3>
                        </div>
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>
                            <?php if (validation_errors()) { ?>
                                <div class="alert alert-warning alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Perhatian!</strong><br> <?php echo validation_errors(); ?>
                                </div>
                            <?php } ?>

                            <form action="<?= base_url('guest/proses_pengajuan_genset'); ?>" method="post" role="form">

                                <div class="form-group row">
                                    <label for="id_transaksi" class="col-sm-3 col-form-label">ID Transaksi</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="id_transaksi" class="form-control" readonly value="GE-<?= date("M"); ?><?= random_string('numeric', 4); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal_keluar" class="col-sm-3 col-form-label">Tanggal Keluar</label>
                                    <div class="col-sm-6">

                                        <input type="text" name="tanggal_keluar" class="form-control form_datetime" id="tanggal_keluar" required placeholder="Tanggal Keluar">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lokasi" class="col-sm-3 col-form-label">Lokasi</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="lokasi" class="form-control" id="lokasi" placeholder="Masukkan Lokasi" required>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_operator" class="col-sm-3 col-form-label">Nama Operator<p><small><span style="color: red;">*Admin yang input</small></span></p></label>
                                    <div class="col-sm-6">

                                        <select name="nama_operator" class="form-control" id="nama_operator" disabled>
                                            <option value="">-- Pilih --</option>
                                            <?php foreach ($list_operator as $op) { ?>
                                                <option value="<?= $op->nama ?>"><?= $op->nama ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_pelanggan" class="col-sm-3 col-form-label">Nama Pelanggan</label>
                                    <div class="col-sm-6">

                                        <select name="nama_pelanggan" class="form-control" id="nama_pelanggan" required>
                                            <option value="">-- Pilih --</option>
                                            <?php foreach ($list_pelanggan as $p) { ?>
                                                <option value="<?= $p->nama ?>"><?= $p->nama ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label for="kode_genset" class="col-sm-3 col-form-label">Kode Genset<p><small>*Stok digudang&nbsp;<span style="color: red;" id="stok_gd"></small></span></p></label>

                                    <input type="hidden" name="stok_gd" id="stok_gd_input" value="">
                                    <input type="hidden" name="stok_pj" id="stok_pj_input" value="">
                                    <div class="col-sm-6">

                                        <select name="kode_genset" class="form-control" id="kode_genset" required>
                                            <option value="">-- Pilih --</option>
                                            <?php foreach ($list_genset as $g) { ?>
                                                <option value="<?= $g->kode_genset ?>"><?= $g->kode_genset ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="genset" class="col-sm-3 col-form-label">Nama Genset</label>
                                    <div class="col-sm-6">

                                        <input type="text" readonly name="nama_genset" class="form-control" id="nama_genset">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="daya" class="col-sm-3 col-form-label">Daya</label>
                                    <div class="col-sm-6">

                                        <input type="text" readonly name="daya" class="form-control" id="daya">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="harga" class="col-sm-3 col-form-label">Harga (Perhari)</label>
                                    <div class="col-sm-6">

                                        <input type="text" readonly name="harga" class="form-control" id="harga_perhari">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label for="nopol_mobil" class="col-sm-3 col-form-label">Nopol Mobil <p><small><span style="color: red;">*Admin yang input</small></span></p></label>
                                    <div class="col-sm-6">

                                        <select name="nopol" id="nopol" class="form-control" disabled>
                                            <option value="">-- Pilih --</option>
                                            <?php foreach ($list_mobil as $m) { ?>
                                                <option value="<?= $m->nopol ?>"><?= $m->nopol ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tipe" class="col-sm-3 col-form-label">Tipe</label>
                                    <div class="col-sm-6">

                                        <input type="text" readonly name="tipe" class="form-control" id="tipe">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tambahan" class="col-sm-3 col-form-label">Tambahan</label>
                                    <div class="col-sm-6">

                                        <input type="text" name="tambahan" class="form-control" id="tambahan" placeholder="Box Panel, Kabel Roll, dll">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jumlah_hari" class="col-sm-3 col-form-label">Jumlah Hari</label>
                                    <div class="col-sm-6">

                                        <input type="number" name="jumlah_hari" class="form-control" id="jumlah_hari" placeholder="Masukkan Hari Pemakaian">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="total" class="col-sm-3 col-form-label">Tota Harga (Rp)</label>
                                    <div class="col-sm-6">

                                        <input type="text" readonly name="total" class="form-control" id="total_harga" placeholder="Total Harga">
                                    </div>
                                </div>
                                <div class="box-footer" align="center">
                                    <a href="<?= base_url('guest/tabel_barang_keluar'); ?>" type="button" class="btn btn-sm btn-default" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Kembali</a>
                                    <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-eraser mr-2"></i>Reset</button>
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check mr-2"></i>Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('admin/template/script') ?>
</body>

</html>
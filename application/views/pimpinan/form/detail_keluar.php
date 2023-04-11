<?php $this->load->view('template/head'); ?>
<?php $this->load->view('guest/template/nav'); ?>
<?php $this->load->view('guest/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Detail Data Genset Keluar</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('guest') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('guest/tabel_barang_keluar'); ?>"> Data Genset Keluar</a></li>
            <li class="breadcrumb-item active">Detail Data Genset Keluar</li>
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
                            <h3 class="box-title"><i class="nav-icon fa fa-info-circle mr-2"></i>Detail Data Genset Keluar</h3>
                        </div>
                        <div class="box-body">
                            <?php foreach ($list_data as $d) { ?>
                                <div class="form-group row">
                                    <label for="id_transaksi" class="col-sm-3 col-form-label">ID Transaksi</label>
                                    <div class="col-sm-6">
                                        <span><?= $d->id_transaksi; ?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal_keluar" class="col-sm-3 col-form-label">Tanggal Keluar</label>
                                    <div class="col-sm-6">
                                        <span><?= $d->tanggal_keluar; ?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lokasi" class="col-sm-3 col-form-label">Lokasi</label>
                                    <div class="col-sm-6">
                                        <span> <?= $d->lokasi; ?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_operator" class="col-sm-3 col-form-label">Nama Operator</label>
                                    <div class="col-sm-6">
                                        <span> <?= $d->nama_operator; ?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_pelanggan" class="col-sm-3 col-form-label">Nama Pelanggan</label>
                                    <div class="col-sm-6">
                                        <span> <?= $d->nama_pelanggan; ?></span>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label for="kode_genset" class="col-sm-3 col-form-label">Nomor Genset</label>
                                    <div class="col-sm-6">
                                        <span> <?= $d->kode_genset; ?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="genset" class="col-sm-3 col-form-label">Nama Genset</label>
                                    <div class="col-sm-6">
                                        <span><?= $d->nama_genset; ?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="daya" class="col-sm-3 col-form-label">Daya</label>
                                    <div class="col-sm-6">
                                        <span><?= $d->daya; ?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="harga" class="col-sm-3 col-form-label">Harga (Perhari)</label>
                                    <div class="col-sm-6">
                                        <span>Rp&nbsp;<?= number_format($d->harga); ?></span>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label for="nopol_mobil" class="col-sm-3 col-form-label">Nopol Mobil</label>
                                    <div class="col-sm-6">
                                        <span><?= $d->nopol; ?></span>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tipe" class="col-sm-3 col-form-label">Tipe</label>
                                    <div class="col-sm-6">
                                        <span><?= $d->mobil; ?></span>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tambahan" class="col-sm-3 col-form-label">Tambahan</label>
                                    <div class="col-sm-6">
                                        <span><?= $d->tambahan; ?></span>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jumlah_hari" class="col-sm-3 col-form-label">Jumlah Hari</label>
                                    <div class="col-sm-6">
                                        <span><?= $d->jumlah_hari; ?></span>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="total" class="col-sm-3 col-form-label">Total Harga (Rp)</label>
                                    <div class="col-sm-6">
                                        <span>Rp&nbsp;<?= number_format($d->total); ?></span>

                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="box-footer" align="center">
                            <a href="<?= base_url('guest/tabel_barang_keluar'); ?>" type="button" class="btn btn-sm btn-default" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('guest/template/script') ?>
</body>

</html>
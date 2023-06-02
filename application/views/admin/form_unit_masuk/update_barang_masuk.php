<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Konfirmasi Data Genset Masuk</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/tabel_barang_keluar'); ?>"> Data Genset Masuk</a></li>
            <li class="breadcrumb-item active">Konfirmasi Data Genset Masuk</li>
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
                            <h3 class="box-title"><i class="nav-icon fa fa-edit mr-2"></i>Konfirmasi Data Genset Masuk</h3>
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

                            <form action="<?= base_url('admin/proses_data_masuk'); ?>" method="post" role="form">

                                <?php foreach ($data_barang_update as $du) { ?>
                                    <div class="form-group row">
                                        <label for="id_transaksi" class="col-sm-3 col-form-label">ID Transaksi</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="id_transaksi" class="form-control" readonly value="<?= $du->id_transaksi; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tanggal_keluar" class="col-sm-3 col-form-label">Tanggal Keluar</label>
                                        <div class="col-sm-6">

                                            <input type="text" name="tanggal_keluar" class="form-control form_datetime" id="tanggal_keluar" value="<?= $du->tanggal_keluar; ?>" required placeholder="Tanggal Keluar" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tanggal_masuk" class="col-sm-3 col-form-label">Tanggal Masuk</label>
                                        <div class="col-sm-6">

                                            <input type="text" name="tanggal_masuk" class="form-control form_datetime" id="tanggal_masuk" value="<?= $du->tanggal_masuk; ?>" required placeholder="Tanggal Keluar">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lokasi" class="col-sm-3 col-form-label">Lokasi</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="lokasi" class="form-control" id="lokasi" placeholder="Masukkan Lokasi" readonly required value="<?= $du->lokasi; ?>">

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama_operator" class="col-sm-3 col-form-label">Nama Operator</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="nama_operator" class="form-control" id="nama_operator" placeholder="Masukkan Nama" readonly required value="<?= $du->nama_operator; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama_pelanggan" class="col-sm-3 col-form-label">Nama Pelanggan</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="nama_pelanggan" readonly class="form-control" id="nama_pelanggan" placeholder="Masukkan Nama" required value="<?= $du->nama_pelanggan; ?>">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="kode_genset" class="col-sm-3 col-form-label">Kode Genset<!--<p><small>*Stok digudang&nbsp;<span style="color: red;" id="stok_gd"></small></span></p>--></label>
                                        <div class="col-sm-6">
                                            <input type="text" name="kode_genset" class="form-control" id="kode_genset" readonly required value="<?= $du->kode_genset; ?>">
                                        </div>

                                    </div>
                                    <?php foreach ($list_genset as $a) { ?>
                                        <?php if ($du->kode_genset == $a->kode_genset) { ?>
                                            <input type="hidden" name="stok_gd" id="stok_gd_input" value="<?= $a->stok_gd; ?>">
                                            <input type="hidden" name="stok_pj" id="stok_pj_input" value="<?= $a->stok_pj; ?>">
                                        <?php } ?>
                                    <?php } ?>
                                    <div class="form-group row">
                                        <label for="genset" class="col-sm-3 col-form-label">Nama Genset</label>
                                        <div class="col-sm-6">

                                            <input type="text" readonly name="nama_genset" class="form-control" id="nama_genset" value="<?= $du->nama_genset; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="daya" class="col-sm-3 col-form-label">Daya</label>
                                        <div class="col-sm-6">

                                            <input type="text" readonly name="daya" class="form-control" id="daya" value="<?= $du->daya; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="harga" class="col-sm-3 col-form-label">Harga (Perhari)</label>
                                        <div class="col-sm-6">

                                            <input type="text" readonly name="harga" class="form-control" id="harga_perhari" value="<?= $du->harga; ?>">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="nopol_mobil" class="col-sm-3 col-form-label">Nopol Mobil</label>
                                        <div class="col-sm-6">
                                            <input type="text" readonly name="nopol" class="form-control" id="nopol" value="<?= $du->nopol; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tipe" class="col-sm-3 col-form-label">Tipe</label>
                                        <div class="col-sm-6">

                                            <input type="text" readonly name="tipe" class="form-control" id="tipe" value="<?= $du->mobil; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tambahan" class="col-sm-3 col-form-label">Tambahan</label>
                                        <div class="col-sm-6">

                                            <input type="text" readonly name="tambahan" class="form-control" id="tambahan" placeholder="Tambahan Jika Ada" value="<?= $du->tambahan; ?>">
                                        </div>
                                    </div>
                                    <input type="hidden" name="jumlah_hari_lama" value="<?= $du->jumlah_hari; ?>">
                                    <div class="form-group row">
                                        <label for="jumlah_hari" class="col-sm-3 col-form-label">Jumlah Hari</label>
                                        <div class="col-sm-6">

                                            <input type="number" readonly name="jumlah_hari" class="form-control" id="jumlah_hari" placeholder="Masukkan Hari Pemakaian" value="<?= $du->jumlah_hari; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="total" class="col-sm-3 col-form-label">Tota Harga (Rp)</label>
                                        <div class="col-sm-6">

                                            <input type="text" readonly name="total" class="form-control" id="total_harga" placeholder="Total Harga" value="<?= $du->total; ?>">
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="box-footer" align="center">
                                    <a href="<?= base_url('admin/tabel_barang_keluar'); ?>" type="button" class="btn btn-sm btn-default" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Kembali</a>

                                    <button type="reset" class="btn btn-sm btn-info"><i class="fa fa-eraser mr-2"></i>Reset</button>

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
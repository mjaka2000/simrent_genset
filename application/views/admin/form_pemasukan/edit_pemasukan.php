<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pendapatan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/tabel_pemasukan'); ?>">Data Pendapatan</a></li>
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
                            Ubah Data Pendapatan
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

                            <form action="<?= site_url('admin/proses_edit_pemasukan'); ?>" method="post" role="form">
                                <?php foreach ($edit_data as $ed) { ?>
                                    <input type="hidden" name="id_pendapatan" value="<?= $ed->id_pendapatan; ?>">

                                    <div class="form-group row">
                                        <label for="bulan" class="col-sm-3 col-form-label">ID Transaksi</label>
                                        <div class="col-sm-6">
                                            <select name="id_u_keluar" class="form-control" id="id_transaksi" required>
                                                <option value="">-- Pilih ID Transaksi --</option>
                                                <?php foreach ($list_data as $d) { ?>
                                                    <?php if ($ed->id_u_keluar == $d->id_u_keluar) { ?>
                                                        <option value="<?= $ed->id_u_keluar ?>" selected><?= $d->id_transaksi ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $d->id_u_keluar ?>"><?= $d->id_transaksi ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="genset" class="col-sm-3 col-form-label">Tanggal Penyewaan</label>
                                        <div class="col-sm-6">

                                            <input type="text" readonly name="tanggal_masuk" class="form-control" id="tanggal_masuk">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="genset" class="col-sm-3 col-form-label">Nama Pelanggan</label>
                                        <div class="col-sm-6">

                                            <input type="text" readonly name="nama_plg" class="form-control" id="nama_plg">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tahun" class="col-sm-3 col-form-label">Tanggal Update</label>
                                        <div class="col-sm-6">
                                            <input type="date" name="tgl_update" class="form-control" id="tgl_update" required value="<?= $ed->tgl_update; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tahun" class="col-sm-3 col-form-label">Keterangan</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="keterangan" class="form-control" id="keterangan" required value="<?= $ed->keterangan; ?>">
                                        </div>
                                    </div>
                                    <div class="box-footer" align="center">
                                        <button onclick="history.back(-1)" type="button" class="btn btn-sm btn-default" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Kembali</button>
                                        <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-eraser mr-2"></i>Reset</button>
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check mr-2"></i>Submit</button>
                                    </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div><!-- /.container-fluid -->
</section>
</div>
<?php $this->load->view('template/footer'); ?>

<?php $this->load->view('admin/template/script') ?>
<script>
    $("#id_transaksi").change(function() {
        let id_transaksi = $(this).val();
        // let stok_gd = document.getElementById("stok_gd");

        <?php foreach ($list_data as $s) { ?>
            if (id_transaksi == "<?php echo $s->id_u_keluar ?>") {

                $("#tanggal_masuk").val("<?php echo date('d-m-Y', strtotime($s->tanggal_masuk)) ?>");
                $("#nama_plg").val("<?php echo $s->nama_plg ?>");

            }
        <?php } ?>
    })

    $("#id_transaksi").show(function() {
        let id_transaksi = $(this).val();
        // let stok_gd = document.getElementById("stok_gd");

        <?php foreach ($list_data as $s) { ?>
            if (id_transaksi == "<?php echo $s->id_u_keluar ?>") {

                $("#tanggal_masuk").val("<?php echo date('d-m-Y', strtotime($s->tanggal_masuk)) ?>");
                $("#nama_plg").val("<?php echo $s->nama_plg ?>");

            }
        <?php } ?>
    })
</script>
</body>

</html>
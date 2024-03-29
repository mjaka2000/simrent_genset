<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Lama Pemakaian Genset yang di service</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/tabel_service_genset_masuk'); ?>">Lama Pemakaian Genset yang di service</a></li>
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

                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            Ubah Data Lama Pemakaian Genset yang akan di service
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

                            <?php foreach ($list_data as $ed) { ?>
                                <form action="<?= site_url('admin/proses_editServ_genset_masuk'); ?>" method="post" role="form">
                                    <input type="hidden" name="id_det_pakai_genset" value="<?= $ed->id_det_pakai_genset; ?>">
                                    <div class="form-group">
                                        <label for="bulan" class="form-label">ID Transaksi</label>

                                        <select name="id_u_sewa" class="form-control" id="id_transaksi" required>
                                            <option value="">-- Pilih ID Transaksi --</option>
                                            <?php foreach ($get_data as $d) { ?>
                                                <?php if ($ed->id_u_sewa == $d->id_u_sewa) { ?>
                                                    <option value="<?= $d->id_u_sewa ?>" selected><?= $d->id_transaksi ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $d->id_u_sewa ?>"><?= $d->id_transaksi ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="genset" class="form-label">Tanggal Pemakaian</label>

                                        <input type="text" readonly name="tanggal_masuk" class="form-control" id="tanggal_masuk">
                                    </div>

                                    <div class="form-group">
                                        <label for="kode_genset" class="form-label">Genset</label>

                                        <input type="text" readonly name="kode_genset" class="form-control" id="kode_genset" placeholder="Genset yang digunakan" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="kode_genset" class="form-label">Lama Pemakaian</label>

                                        <input type="text" readonly name="lama_pakai" class="form-control" id="lama_pakai" placeholder="Lama Genset yang digunakan" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tahun" class="form-label">Keterangan</label>

                                        <input type="text" name="ket_det_pakai_genset" class="form-control" id="keterangan" required value="<?= $ed->ket_det_pakai_genset; ?>" </div>

                                        <hr>
                                        <div class="form-group" align="center">
                                            <button onclick="history.back(-1)" type="button" class="btn btn-sm btn-default" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Kembali</button>
                                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check mr-2"></i>Submit</button>
                                        </div>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script') ?>
<script>
    $("#id_transaksi").change(function() {
        let id_transaksi = $(this).val();
        // let stok_gd = document.getElementById("stok_gd");

        <?php foreach ($get_data as $s) { ?>
            if (id_transaksi == "<?php echo $s->id_u_sewa ?>") {

                $("#tanggal_masuk").val("<?php echo date('d-m-Y', strtotime($s->tanggal_masuk)) ?>");
                $("#kode_genset").val("<?php echo $s->kode_genset ?> - <?= $s->nama_genset; ?> - <?= $s->daya; ?> KVA");
                $("#lama_pakai").val("<?php echo $s->jumlah_hari ?> Hari (<?= $s->jumlah_hari * 24; ?> Jam)");

            }
        <?php } ?>
    })
</script>
<script>
    $("#id_transaksi").show(function() {
        let id_transaksi = $(this).val();
        // let stok_gd = document.getElementById("stok_gd");

        <?php foreach ($get_data as $s) { ?>
            if (id_transaksi == "<?php echo $s->id_u_sewa ?>") {

                $("#tanggal_masuk").val("<?php echo date('d-m-Y', strtotime($s->tanggal_masuk)) ?>");
                $("#kode_genset").val("<?php echo $s->kode_genset ?> - <?= $s->nama_genset; ?> - <?= $s->daya; ?> KVA");
                $("#lama_pakai").val("<?php echo $s->jumlah_hari ?> Hari (<?= $s->jumlah_hari * 24; ?> Jam)");

            }
        <?php } ?>
    })
</script>


</body>

</html>
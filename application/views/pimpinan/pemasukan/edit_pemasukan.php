<?php $this->load->view('template/head'); ?>
<?php $this->load->view('pimpinan/template/nav'); ?>
<?php $this->load->view('pimpinan/template/sidebar'); ?>

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
                        <li class="breadcrumb-item"><a href="<?= site_url('pimpinan'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('pimpinan/tabel_jdw_genset'); ?>">Pendapatan</a></li>
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

                            <?php foreach ($edit_data as $ed) { ?>
                                <form action="<?= site_url('pimpinan/proses_edit_pemasukan'); ?>" method="post" role="form">
                                    <input type="hidden" name="id_pendapatan" value="<?= $ed->id_pendapatan; ?>">

                                    <div class="form-group">
                                        <label for="bulan" class="form-label">ID Transaksi<span><small style="color: red;">*Arahkan untuk menampilkan isi field</small></span></label>

                                        <select name="id_u_sewa" class="form-control id_transaksi_ed" id="" required>
                                            <option value="">-- Pilih ID Transaksi --</option>
                                            <?php foreach ($get_data as $d) { ?>
                                                <?php if ($ed->id_u_sewa == $d->id_u_sewa) { ?>
                                                    <option value="<?= $ed->id_u_sewa ?>" selected><?= $d->id_transaksi ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $d->id_u_sewa ?>"><?= $d->id_transaksi ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="genset" class="form-label">Tanggal Penyewaan</label>


                                        <input type="text" readonly name="tanggal_masuk" class="form-control tanggal_masuk_ed" id="">
                                    </div>
                                    <div class="form-group">
                                        <label for="genset" class="form-label">Nama Pelanggan</label>


                                        <input type="text" readonly name="nama_plg" class="form-control nama_plg_ed" id="">
                                    </div>
                                    <div class="form-group">
                                        <label for="tahun" class="form-label">Tanggal Update</label>

                                        <input type="date" name="tgl_update" class="form-control" id="tgl_update" required value="<?= $ed->tgl_update; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="tahun" class="form-label">Keterangan</label>

                                        <input type="text" name="keterangan" class="form-control" id="keterangan" required value="<?= $ed->keterangan; ?>">
                                    </div>
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
    $(".id_transaksi_ed").click(function() {
        let id_transaksi = $(this).val();
        // let stok_gd = document.getElementById("stok_gd");

        <?php foreach ($get_data as $s) { ?>
            if (id_transaksi == "<?php echo $s->id_u_sewa ?>") {

                $(".tanggal_masuk_ed").val("<?php echo date('d-m-Y', strtotime($s->tanggal_masuk)) ?>");
                $(".nama_plg_ed").val("<?php echo $s->nama_plg ?>");

            }
        <?php } ?>
    })

    $(".id_transaksi_ed").show(function() {
        let id_transaksi = $(this).val();
        // let stok_gd = document.getElementById("stok_gd");

        <?php foreach ($get_data as $s) { ?>
            if (id_transaksi == "<?php echo $s->id_u_sewa ?>") {

                $(".tanggal_masuk_ed").val("<?php echo date('d-m-Y', strtotime($s->tanggal_masuk)) ?>");
                $(".nama_plg_ed").val("<?php echo $s->nama_plg ?>");

            }
        <?php } ?>
    })
</script>

</body>

</html>
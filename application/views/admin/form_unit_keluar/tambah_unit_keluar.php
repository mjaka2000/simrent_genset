<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Penyewaan Genset</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/tabel_unit_keluar'); ?>">Penyewaan Genset</a></li>
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
                        <div class="card-header"><i class="fas fa-plus"></i>
                            Tambah Data Genset Disewa
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

                            <form action="<?= site_url('admin/proses_tambah_unit_keluar'); ?>" method="post" role="form">

                                <div class="form-group row">
                                    <label for="id_transaksi" class="col-sm-3 col-form-label">ID</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="id_transaksi" class="form-control" readonly value="GE-<?= date("M"); ?><?= random_string('numeric', 4); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal_keluar" class="col-sm-3 col-form-label">Tanggal Keluar</label>
                                    <div class="col-sm-6">
                                        <input type="date" name="tanggal_keluar" class="form-control form_datetime" id="tanggal_keluar" required placeholder="Tanggal Keluar">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lokasi" class="col-sm-3 col-form-label">Lokasi</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="lokasi" class="form-control" id="lokasi" placeholder="Masukkan Lokasi" required>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_operator" class="col-sm-3 col-form-label">Nama Operator</label>
                                    <div class="col-sm-6">
                                        <select name="id_operator" class="form-control" id="nama_operator" required>
                                            <option value="">-- Pilih Operator --</option>
                                            <?php foreach ($list_operator as $op) { ?>
                                                <option value="<?= $op->id_operator ?>"><?= $op->nama_op ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_pelanggan" class="col-sm-3 col-form-label">Nama Pelanggan</label>
                                    <div class="col-sm-6">

                                        <select name="id_pelanggan" class="form-control" id="nama_operator" required>
                                            <option value="">-- Pilih Nama Pelanggan--</option>
                                            <?php foreach ($list_pelanggan as $p) { ?>
                                                <option value="<?= $p->id_pelanggan ?>"><?= $p->nama_plg ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label for="kode_genset" class="col-sm-3 col-form-label">Nomor Genset</label>
                                    <!-- <p><small>*Stok digudang&nbsp;<span style="color: red;" id="stok_gd"></small></span></p> -->

                                    <!-- <input type="hidden" name="stok_gd" id="stok_gd_input" value=""> -->
                                    <!-- <input type="hidden" name="stok_pj" id="stok_pj_input" value=""> -->
                                    <div class="col-sm-6">

                                        <select name="id_genset" class="form-control" id="kode_genset" required>
                                            <option value="">-- Pilih Genset--</option>
                                            <?php foreach ($list_genset as $g) { ?>
                                                <option value="<?= $g->id_genset ?>"><?= $g->kode_genset ?></option>
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
                                    <div class="input-group col-sm-6">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" readonly name="harga" class="form-control" id="harga_perhari">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label for="nopol_mobil" class="col-sm-3 col-form-label">Nopol Mobil</label>
                                    <div class="col-sm-6">

                                        <select name="id_mobil" id="nopol" class="form-control" required>
                                            <option value="">-- Pilih Mobil--</option>
                                            <?php foreach ($list_mobil as $m) { ?>
                                                <option value="<?= $m->id_mobil ?>"><?= $m->nopol ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tipe" class="col-sm-3 col-form-label">Merk</label>
                                    <div class="col-sm-6">

                                        <input type="text" readonly name="merk" class="form-control" id="merek">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tambahan" class="col-sm-3 col-form-label">Tambahan Alat</label>
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
                                    <div class="input-group col-sm-6">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" readonly name="total" class="form-control" id="total_harga" placeholder="Total Harga">
                                    </div>
                                </div>
                                <hr>
                                <div class="box-footer" align="center">
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

<script type="text/javascript">
    //* Script untuk memuat data genset
    $("#kode_genset").change(function() {
        let kode_genset = $(this).val();
        // let stok_gd = document.getElementById("stok_gd");

        <?php foreach ($list_genset as $s) { ?>
            if (kode_genset == "<?php echo $s->id_genset ?>") {

                $("#daya").val("<?php echo $s->daya ?>");
                $("#nama_genset").val("<?php echo $s->nama_genset ?>");

                $("#harga_perhari").val("<?php echo $s->harga ?>")
            }
        <?php } ?>
    })

    $("#jumlah_hari, #harga_perhari").keyup(function() {
        var harga = parseInt($("#harga_perhari").val()) || 0;
        var hari = parseInt($("#jumlah_hari").val()) || 0;

        $("#total_harga").val(harga * hari);
    })

    $("#nopol").change(function() {
        let nopol = $(this).val();
        <?php foreach ($list_mobil as $mb) { ?>
            if (nopol == "<?php echo $mb->id_mobil ?>") {
                $("#merek").val("<?php echo $mb->merek ?>");
            }
        <?php } ?>
    })
</script>

</body>

</html>
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
                        <li class="breadcrumb-item active">Konfirmasi Data Genset Masuk</li>
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
            <div class="row ">
                <div class="col-md-4">
                    <div class="card">

                        <div class="card-body card-primary card-outline" align="center">
                            <div class="info">
                                <?php //foreach ($data_valid as $dv) { 
                                ?>
                                <form action="<?= site_url('admin/proses_update_valid'); ?>" method="post" role="form">
                                    <?php foreach ($data_unit_update as $du) { ?>
                                        <input type="hidden" name="id_u_sewa" value="<?= $du->id_u_sewa; ?>">
                                        <div class="form-group row">
                                            <label for="id_transaksi" class="col-sm-3 col-form-label">ID Transaksi</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="id_transaksi" class="form-control" readonly value="<?= $du->id_transaksi; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nama_operator" class="col-sm-3 col-form-label">Nama Operator</label>
                                            <div class="col-sm-9">
                                                <select name="id_operator" class="form-control" id="nama_operator" required>
                                                    <option value="">-- Pilih Operator --</option>
                                                    <?php foreach ($list_operator as $op) { ?>
                                                        <?php if ($du->id_operator == $op->id_operator) { ?>
                                                            <option value="<?= $du->id_operator ?>" selected><?= $op->nama_op ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?= $op->id_operator ?>"><?= $op->nama_op ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nopol_mobil" class="col-sm-3 col-form-label">Nopol Mobil</label>
                                            <div class="col-sm-9">
                                                <select name="id_mobil" id="nopol" class="form-control" required>
                                                    <option value="">-- Pilih Mobil--</option>
                                                    <?php foreach ($list_mobil as $m) { ?>
                                                        <?php if ($du->id_mobil == $m->id_mobil) { ?>
                                                            <option value="<?= $du->id_mobil ?>" selected><?= $m->nopol ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?= $m->id_mobil ?>"><?= $m->nopol ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tipe" class="col-sm-3 col-form-label">Merek</label>
                                            <div class="col-sm-9">

                                                <input type="text" readonly name="tipe" class="form-control" id="merek" value="">
                                            </div>
                                        </div>

                                    <?php } ?>
                            </div>
                            <div class="card-footer" align="center">
                                <!-- <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-arrow-left mr-2"></i>Kembali</button> -->
                                <button type="submit" class="btn btn-sm btn-success" disabled><i class="fa fa-check mr-2"></i>Submit</button>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            Konfirmasi Data Genset Masuk
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

                            <form action="<?= site_url('admin/proses_data_masuk'); ?>" method="post" role="form">

                                <?php foreach ($data_unit_list as $dl) { ?>
                                    <input type="hidden" name="id_u_sewa" value="<?= $dl->id_u_sewa; ?>">
                                    <div class="form-group row">
                                        <label for="id_transaksi" class="col-sm-3 col-form-label">ID Transaksi</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="id_transaksi" class="form-control" readonly value="<?= $dl->id_transaksi; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tanggal_keluar" class="col-sm-3 col-form-label">Tanggal Keluar</label>
                                        <div class="col-sm-9">

                                            <input type="date" name="tanggal_keluar" class="form-control " id="tanggal_keluar" value="<?= $dl->tanggal_keluar; ?>" required placeholder="Tanggal Keluar" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tanggal_masuk" class="col-sm-3 col-form-label">Tanggal Masuk</label>
                                        <div class="col-sm-9">

                                            <input type="date" name="tanggal_masuk" class="form-control " id="tanggal_masuk" value="<?= $dl->tanggal_masuk; ?>" required readonly placeholder="Tanggal Masuk">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lokasi" class="col-sm-3 col-form-label">Lokasi</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="lokasi" class="form-control" id="lokasi" placeholder="Masukkan Lokasi" readonly required value="<?= $dl->lokasi; ?>">

                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label for="nama_operator" class="col-sm-3 col-form-label">Nama Operator</label>
                                        <div class="col-sm-9">
                                            <select name="id_operator" class="form-control" id="nama_operator" required>
                                                <option value="">-- Pilih Operator --</option>
                                                <?php foreach ($list_operator as $op) { ?>
                                                    <?php if ($dl->id_operator == $op->id_operator) { ?>
                                                        <option value="<?= $dl->id_operator ?>" selected><?= $op->nama_op ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $op->id_operator ?>"><?= $op->nama_op ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                        <label for="nama_pelanggan" class="col-sm-3 col-form-label">Nama Pelanggan</label>
                                        <div class="col-sm-9">
                                            <select name="id_pelanggan" class="form-control" id="nama_operator" required>
                                                <option value="">-- Pilih Nama Pelanggan--</option>
                                                <?php foreach ($list_pelanggan as $p) { ?>
                                                    <?php if ($dl->id_pelanggan == $p->id_pelanggan) { ?>
                                                        <option value="<?= $dl->id_pelanggan ?>" selected><?= $p->nama_plg ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $p->id_pelanggan ?>"><?= $p->nama_plg ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="kode_genset" class="col-sm-3 col-form-label">Nomor Genset<!--<p><small>*Stok digudang&nbsp;<span style="color: red;" id="stok_gd"></small></span></p>--></label>
                                        <div class="col-sm-9">
                                            <select name="id_genset" class="form-control" id="kode_genset" required>
                                                <option value="">-- Pilih Genset--</option>
                                                <?php foreach ($list_genset as $g) { ?>
                                                    <?php if ($dl->id_genset == $g->id_genset) { ?>
                                                        <option value="<?= $dl->id_genset ?>" selected><?= $g->kode_genset ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $g->id_genset ?>"><?= $g->kode_genset ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <label for="genset" class="col-sm-3 col-form-label">Nama Genset</label>
                                        <div class="col-sm-9">

                                            <input type="text" readonly name="nama_genset" class="form-control" id="nama_genset" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="daya" class="col-sm-3 col-form-label">Daya</label>
                                        <div class="col-sm-9">

                                            <input type="text" readonly name="daya" class="form-control" id="daya" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="harga" class="col-sm-3 col-form-label">Harga (Perhari)</label>
                                        <div class="input-group col-sm-9">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="text" readonly name="harga" class="form-control" id="harga_perhari">
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- <div class="form-group row">
                                        <label for="nopol_mobil" class="col-sm-3 col-form-label">Nopol Mobil</label>
                                        <div class="col-sm-9">
                                            <select name="id_mobil" id="nopol" class="form-control" required>
                                                <option value="">-- Pilih Mobil--</option>
                                                <?php foreach ($list_mobil as $m) { ?>
                                                    <?php if ($dl->id_mobil == $m->id_mobil) { ?>
                                                        <option value="<?= $dl->id_mobil ?>" selected><?= $m->nopol ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $m->id_mobil ?>"><?= $m->nopol ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div> -->
                                    <!-- <div class="form-group row">
                                        <label for="tipe" class="col-sm-3 col-form-label">Merek</label>
                                        <div class="col-sm-9">

                                            <input type="text" readonly name="tipe" class="form-control" id="merek" value="">
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                        <label for="tambahan" class="col-sm-3 col-form-label">Tambahan</label>
                                        <div class="col-sm-9">

                                            <input type="text" readonly name="tambahan" class="form-control" id="tambahan" placeholder="Tambahan Jika Ada" value="<?= $dl->tambahan; ?>">
                                        </div>
                                    </div>
                                    <input type="hidden" name="jumlah_hari_lama" value="<?= $dl->jumlah_hari; ?>">
                                    <div class="form-group row">
                                        <label for="jumlah_hari" class="col-sm-3 col-form-label">Jumlah Hari</label>
                                        <div class="col-sm-9">

                                            <input type="number" readonly name="jumlah_hari" class="form-control" id="jumlah_hari" placeholder="Masukkan Hari Pemakaian" value="<?= $dl->jumlah_hari; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="total" class="col-sm-3 col-form-label">Total Harga (Rp)</label>
                                        <div class="input-group col-sm-9">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="text" readonly name="total" class="form-control" id="total_harga" placeholder="Total Harga" value="<?= $dl->total; ?>">
                                        </div>
                                    </div>
                                <?php } ?>
                                <hr>
                                <div class="card-footer" align="center">
                                    <!-- <div class="form-group row">
                                        <a type="button" onclick="editHari()" class="btn btn-sm btn-danger" name="edit_hari" id="edit_hari"><i class="fa fa-edit mr-2"></i>Edit Jumlah Hari</a>
                                        <small style="color: red;">*Klik Untuk Perpanjang Hari</small>
                                    </div> -->
                                    <button onclick="history.back(-1)" type="button" class="btn btn-sm btn-default" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Kembali</button>
                                    <!-- <button type="reset" class="btn btn-sm btn-info"><i class="fa fa-eraser mr-2"></i>Reset</button> -->

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
<?php $this->load->view('template/script') ?>
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

    $("#kode_genset").show(function() {
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

    // $("#jumlah_hari, #harga_perhari").keyup(function() {
    //     var harga = parseInt($("#harga_perhari").val()) || 0;
    //     var hari = parseInt($("#jumlah_hari").val()) || 0;

    //     $("#total_harga").val(harga * hari);
    // })

    $("#nopol").change(function() {
        let nopol = $(this).val();
        <?php foreach ($list_mobil as $mb) { ?>
            if (nopol == "<?php echo $mb->id_mobil ?>") {
                $("#merek").val("<?php echo $mb->merek ?>");
            }
        <?php } ?>
    })

    $("#nopol").show(function() {
        let nopol = $(this).val();
        <?php foreach ($list_mobil as $mb) { ?>
            if (nopol == "<?php echo $mb->id_mobil ?>") {
                $("#merek").val("<?php echo $mb->merek ?>");
            }
        <?php } ?>
    })
</script>
<script type="text/javascript">
    //* Script untuk mengubah atribut jumlah hari
    // function editHari() {
    //     document.getElementById("jumlah_hari").removeAttribute("readonly");
    // }

    // $("#jumlah_hari, #harga_perhari").keyup(function() {
    //     var harga = parseInt($("#harga_perhari").val()) || 0;
    //     var hari = parseInt($("#jumlah_hari").val()) || 0;

    //     $("#total_harga").val(harga * hari);
    // })
</script>
</body>

</html>
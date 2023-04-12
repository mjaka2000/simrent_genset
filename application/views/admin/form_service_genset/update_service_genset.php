<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Perbaikan Genset</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/tabel_service_genset'); ?>">Perbaikan Genset</a></li>
                        <li class="breadcrumb-item active">Edit Data </li>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="width: 30%; margin-left: 35%;">
                        <div class="card-header"><i class="fas fa-edit"></i>
                            Edit Data Perbaikan Genset
                        </div>
                        <div class="card-body">
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

                            <form action="<?= base_url('admin/proses_update_service_genset'); ?>" method="post" role="form">
                                <?php foreach ($list_data as $ld) { ?>

                                    <input type="hidden" name="id_perbaikan_gst" value="<?= $ld->id_perbaikan_gst; ?>">
                                    <div class="form-group">
                                        <label for="kode_genset" class="form-label">Nomor Genset</label>&nbsp;<span style="color: red;"><small>*Pilih dulu untuk menampilkan nama genset</small></span>

                                        <select name="id_genset" class="form-control" id="id_genset">
                                            <option value="" disabled>-- Pilih Nomor Genset --</option>
                                            <?php foreach ($list_genset as $g) { ?>
                                                <?php if ($ld->id_genset == $g->id_genset) { ?>
                                                    <option value="<?= $ld->id_genset; ?>" selected><?= $g->kode_genset; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $g->id_genset; ?>"><?= $g->kode_genset; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_genset" class="form-label">Nama Genset</label>
                                        <input type="text" name="nama_genset" class="form-control" id="nama_genset" placeholder="Nama Genset" disabled>
                                        <!-- <p><strong><span style="color: red;" id="nama_genset"></span></strong></p> -->
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_perbaikan" class="form-label">Jenis Perbaikan</label>
                                        <input type="text" name="jenis_perbaikan" class="form-control" id="jenis_perbaikan" placeholder="Contoh : Perbaikan Aki dll" required value="<?= $ld->jenis_perbaikan; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="spare_part" class="form-label">Spare Part (Diganti)</label>&nbsp;<span style="color: red;"><small>*Jika tidak ada yang diganti abaikan</small></span>
                                        <input type="hidden" name="stok" id="stok_input" value="">
                                        <p><small>*Sisa Stok&nbsp;<span style="color: red;" id="stk"></span></small></p>
                                        <select name="id_sparepart" class="form-control" id="spare_part">
                                            <option value="">-- Pilih Sparepart --</option>
                                            <?php foreach ($list_sparepart as $s) { ?>
                                                <?php if ($ld->id_sparepart == $s->id_sparepart) { ?>
                                                    <option value="<?= $s->id_sparepart; ?>" selected><?= $s->nama_sparepart; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $s->id_sparepart; ?>"><?= $s->nama_sparepart; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_perbaikan" class="form-label">Tanggal Perbaikan</label>
                                        <input type="text" required name="tgl_perbaikan" class="form_datetime form-control" id="tgl_perbaikan" placeholder="Tanggal Perbaikan" value="<?= $ld->tgl_perbaikan; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="ket_perbaikan" class="form-label">Keterangan Perbaikan</label>
                                        <select name="ket_perbaikan" class="form-control" id="ket_perbaikan" required>
                                            <option value="">-- Status --</option>
                                            <?php foreach ($list_data as $k) { ?>
                                                <?php if ($k->ket_perbaikan == "Selesai Diperbaiki") { ?>
                                                    <option value="Selesai Diperbaiki" selected>Selesai Diperbaiki</option>
                                                    <option value="Masih Terkendala">Masih Terkendala</option>
                                                <?php } else { ?>
                                                    <option value="Selesai Diperbaiki">Selesai Diperbaiki</option>
                                                    <option value="Masih Terkendala" selected>Masih Terkendala</option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="biaya_perbaikan" class="form-label">Biaya Perbaikan</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="text" name="biaya_perbaikan" class="form-control" id="biaya_perbaikan" value="<?= $ld->biaya_perbaikan; ?>">
                                        </div>
                                    </div>
                                <?php } ?>
                                <hr>
                                <div class="form-group" align="center">
                                    <button onclick="window.location.href='<?= base_url('admin/tabel_service_genset'); ?>'" type="button" class="btn btn-sm btn-default" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Kembali</button>
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
    //*Script untuk memuat stok
    $("#spare_part").change(function() {
        let spare_part = $(this).val();
        let stk = document.getElementById("stk");

        <?php foreach ($list_sparepart as $ls) { ?>
            if (spare_part == "<?= $ls->id_sparepart ?>") {
                var text = document.createTextNode("<?= $ls->stok; ?>");

                $("#stok_input").val("<?= $ls->stok; ?>");
                if (stk.innerHTML = "<?= $ls->stok < 1; ?>") {
                    Swal.fire(
                        'Error!',
                        'Maaf, Stok Sparepart Tidak Cukup, lakukan pembelian untuk menambah stok.',
                        'error'
                    ).then(result => {
                        window.location.href = "<?= base_url('admin/tabel_sparepart'); ?>"
                    })
                } else {
                    stk.innerHTML = "<?= $ls->stok; ?>";
                }
            }
        <?php } ?>
    })
</script>
<script type="text/javascript">
    // 
    $("#id_genset").show(function() {
        let kode_genset = $(this).val();
        <?php foreach ($list_genset as $l) { ?>
            if (kode_genset == "<?php echo $l->id_genset ?>") {
                $("#nama_genset").val("<?php echo $l->nama_genset ?>");
            }
        <?php } ?>
    })
    $("#id_genset").click(function() {
        let kode_genset = $(this).val();
        <?php foreach ($list_genset as $l) { ?>
            if (kode_genset == "<?php echo $l->id_genset ?>") {
                $("#nama_genset").val("<?php echo $l->nama_genset ?>");
            }
        <?php } ?>
    })
</script>
</body>

</html>
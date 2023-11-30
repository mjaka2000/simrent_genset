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
                        <li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/tabel_service_genset'); ?>">Perbaikan Genset</a></li>
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
                            Ubah Data Perbaikan Genset
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
                            <?php foreach ($list_data as $ld) : ?>

                                <form action="<?= site_url('admin/proses_update_service_genset'); ?>" method="post" role="form">

                                    <input type="hidden" name="id_perbaikan_gst" value="<?= $ld->id_perbaikan_gst; ?>">
                                    <div class="form-group">
                                        <label for="kode_genset" class="form-label" title="*Pilih untuk menampilkan nama genset">Nomor Genset <span><small style="color: red;">*Pilih untuk menampilkan nama genset</small></span></label>

                                        <select name="id_genset" class="form-control id_genset_ed" id="">
                                            <option value="" disabled>-- Pilih Nomor Genset --</option>
                                            <?php foreach ($list_genset as $g) { ?>
                                                <?php if ($ld->id_genset == $g->id_genset) { ?>
                                                    <option value="<?= $ld->id_genset; ?>" selected><?= $g->kode_genset; ?> - <?= $g->nama_genset; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $g->id_genset; ?>"><?= $g->kode_genset; ?> - <?= $g->nama_genset; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="nama_genset" class="form-label">Nama Genset</label>

                                        <input type="text" name="nama_genset" class="form-control nama_genset_ed" id="" placeholder="Nama Genset" readonly>
                                    </div> -->
                                    <div class="form-group">
                                        <label for="jenis_perbaikan" class="form-label">Ket. Jenis Perbaikan</label>

                                        <input type="text" name="jenis_perbaikan" class="form-control" id="jenis_perbaikan" placeholder="Contoh : Perbaikan Aki dll" required value="<?= $ld->jenis_perbaikan; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="spare_part" class="form-label">Spare Part (Diganti)</label>
                                        <!-- <input type="hidden" name="stok" id="stok_input" value=""> -->
                                        <!-- <p><small>*Sisa Stok&nbsp;<span style="color: red;" id="stk"></span></small></p> -->

                                        <select name="id_sparepart" class="form-control" id="spare_part" readonly>
                                            <option value="">-- Pilih Sparepart --</option>
                                            <?php foreach ($list_sparepart as $s) { ?>
                                                <?php if ($ld->id_sparepart == $s->id_sparepart) { ?>
                                                    <option value="<?= $ld->id_sparepart; ?>" selected><?= $s->nama_sparepart; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $s->id_sparepart; ?>"><?= $s->nama_sparepart; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_perbaikan" class="form-label">Tanggal Perbaikan</label>

                                        <input type="date" required name="tgl_perbaikan" class="form_datetime form-control" id="tgl_perbaikan" placeholder="Tanggal Perbaikan" value="<?= $ld->tgl_perbaikan; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_perbaikan" class="form-label">Hours Meter Genset</label>

                                        <input type="number" name="jam_pakai" class="form-control" id="jam_pakai" placeholder="Lama Pemakaian Genset (dalam Jam)" value="<?= $ld->jam_pakai; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="ket_perbaikan" class="form-label">Keterangan Perbaikan</label>

                                        <select name="ket_perbaikan" class="form-control" id="ket_perbaikan" required>
                                            <option value="">-- Status --</option>
                                            <?php if ($ld->ket_perbaikan == "1") { ?>
                                                <option value="0">Masih Proses</option>
                                                <option value="1" selected>Selesai Diperbaiki</option>
                                            <?php } else { ?>
                                                <option value="0" selected>Masih Proses</option>
                                                <option value="1">Selesai Diperbaiki</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="biaya_perbaikan" class="form-label">Perkiraan Biaya</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="text" name="biaya_perbaikan" class="form-control" id="biaya_perbaikan" value="<?= $ld->biaya_perbaikan; ?>">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group" align="center">
                                        <button onclick="history.back(-1)" type="button" class="btn btn-sm btn-default" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Kembali</button>
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check mr-2"></i>Submit</button>
                                    </div>
                                </form>
                            <?php endforeach; ?>
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
    // 
    $("#id_genset").change(function() {
        let kode_genset = $(this).val();
        <?php foreach ($list_genset as $l) { ?>
            if (kode_genset == "<?php echo $l->id_genset ?>") {
                $("#nama_genset").val("<?php echo $l->nama_genset ?>");
            }
        <?php } ?>
    })
</script>
<script type="text/javascript">
    // $(".id_genset_ed").show(function() {
    //     let kode_genset = $(this).val();
    //     <?php foreach ($list_genset as $g) { ?>
    //         if (kode_genset == "<?php echo $g->id_genset ?>") {
    //             $(".nama_genset_ed").val("<?php echo $g->nama_genset ?>");
    //         }
    //     <?php } ?>
    // })
    // $(".id_genset_ed").click(function() {
    //     let kode_genset = $(this).val();
    //     <?php foreach ($list_genset as $g) { ?>
    //         if (kode_genset == "<?php echo $g->id_genset ?>") {
    //             $(".nama_genset_ed").val("<?php echo $g->nama_genset ?>");
    //         }
    //     <?php } ?>
    // })
</script>

</body>

</html>
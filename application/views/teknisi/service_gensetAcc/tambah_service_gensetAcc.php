<?php $this->load->view('template/head'); ?>
<?php $this->load->view('teknisi/template/nav'); ?>
<?php $this->load->view('teknisi/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Perbaikan Genset Disetujui</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('teknisi'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('teknisi/tabel_sparepart'); ?>">Perbaikan Genset Disetujui</a></li>
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
                        <div class="card-header">
                            Tambah Data Perbaikan Genset Disetujui
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

                            <form action="<?= site_url('teknisi/proses_tambah_ServGstAcc'); ?>" method="post" role="form">

                                <div class="form-group">
                                    <label for="nama" class="form-label">Perbaikan Genset Selesai</label>
                                    <select name="id_perbaikan_gst" class="form-control" id="id_perbaikan_gst" required>
                                        <option value="" selected>-- Pilih Nomor Genset --</option>
                                        <?php foreach ($list_perbaikan as $g) { ?>
                                            <option value="<?= $g->id_perbaikan_gst; ?>">No. <?= $g->kode_genset; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="alamat" class="form-label">Nama Genset</label>

                                    <input type="text" name="nama_genset" class="form-control" id="nama_genset" placeholder="Nama Genset" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="no_hp" class="form-label">Jenis Perbaikan</label>

                                    <input type="text" name="jenis_perbaikan" class="form-control" id="jenis_perbaikan" placeholder="Jenis Perbaikan" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="no_hp" class="form-label">Tanggal</label>

                                    <input type="date" name="tgl_setujui" class="form-control" id="tgl_setujui">
                                </div>
                                <div class="form-group">
                                    <label for="no_hp" class="form-label">Keterangan</label>

                                    <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Isi Keterangan">
                                </div>
                                <hr>
                                <div class="form-group" align="center">
                                    <button onclick="history.back(-1)" type="button" class="btn btn-sm btn-default" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Kembali</button>
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
    // 
    $("#id_perbaikan_gst").change(function() {
        let kode_genset = $(this).val();
        <?php foreach ($list_perbaikan as $l) { ?>
            if (kode_genset == "<?php echo $l->id_perbaikan_gst ?>") {
                $("#nama_genset").val("<?php echo $l->nama_genset ?>");
                $("#jenis_perbaikan").val("<?php echo $l->jenis_perbaikan ?>");
            }
        <?php } ?>
    })
</script>

</body>

</html>
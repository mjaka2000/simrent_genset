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
                            Tambah Detail Perbaikan Genset
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
                            <?php foreach ($list_data as $det) { ?>

                                <form action="<?= site_url('admin/proses_tambah_service_detail'); ?>" method="post" role="form">
                                    <input type="hidden" name="id_perbaikan_gst" value="<?= $det->id_perbaikan_gst; ?>">
                                    <div class="form-group">
                                        <label for="pekerjaan" class="form-label">Pekerjaan</label>

                                        <input type="text" name="pekerjaan" class="form-control" id="pekerjaan" placeholder="Pekerjaan" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Tanggal" class="form-label">Tanggal</label>

                                        <input type="date" name="tanggal" class="form-control" id="tanggal" placeholder="Tanggal" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="kendala" class="form-label">Kendala</label>

                                        <input type="text" name="kendala" class="form-control" id="kendala" placeholder="Kendala" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="status" class="form-label">Status</label>

                                        <select name="status" class="form-control" id="status" required>
                                            <option value="">-- Status --</option>
                                            <option value="0">Pending</option>
                                            <option value="1">Selesai</option>
                                        </select>
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
<script type="text/javascript">
    //*Script untuk memuat stok
    $("#spare_part").change(function() {
        let spare_part = $(this).val();
        let stk = document.getElementById("stk");

        <?php foreach ($list_sparepart as $ls) { ?>
            if (spare_part == "<?= $ls->id_sparepart ?>") {
                var text = document.createTextNode("<?= $ls->stok; ?>");

                $("#stok_input").val("<?= $ls->stok; ?>");
                if (stk.innerHTML = "<?= $ls->stok  < 1; ?>") {
                    Swal.fire(
                        'Error!',
                        'Maaf, Stok Sparepart Tidak Cukup, lakukan pembelian untuk menambah stok.',
                        'error'
                    ).then(result => {
                        window.location.href = "<?= site_url('admin/tabel_sparepart'); ?>"
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
    $("#id_genset").change(function() {
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
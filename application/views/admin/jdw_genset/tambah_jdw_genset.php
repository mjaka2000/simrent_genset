<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Jadwal Penyewaan Genset</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/tabel_jdw_genset'); ?>">Jadwal Penyewaan Genset</a></li>
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
                <div class="col-md-5 ">
                    <div class="card">
                        <div class="card-header">
                            Tambah Data Jadwal Penyewaan Genset
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

                            <form action="<?= site_url('admin/proses_tambah_jdw_genset'); ?>" method="post" role="form">

                                <div class="form-group">
                                    <label for="bulan" class="form-label">ID Transaksi</label>

                                    <select name="id_u_sewa" class="form-control" id="id_transaksi" required>
                                        <option value="">-- Pilih ID Transaksi --</option>
                                        <?php foreach ($list_data as $d) { ?>
                                            <option value="<?= $d->id_u_sewa ?>"><?= $d->id_transaksi ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="genset" class="form-label">Tanggal Digunakan</label>
                                    <input type="text" readonly name="tanggal_keluar" class="form-control" id="tanggal_keluar">
                                </div>
                                <div class="form-group">
                                    <label for="genset" class="form-label">Tanggal Selesai</label>
                                    <input type="text" readonly name="tanggal_masuk" class="form-control" id="tanggal_masuk">
                                </div>
                                <div class="form-group">
                                    <label for="genset" class="form-label">Nama Pelanggan</label>
                                    <input type="text" readonly name="nama_plg" class="form-control" id="nama_plg">
                                </div>
                                <div class="form-group">
                                    <label for="tahun" class="form-label">Keterangan</label>

                                    <input type="text" name="keterangan" class="form-control" id="keterangan" required>
                                </div>
                                <hr>
                                <div class="form-group" align="center">
                                    <button onclick="history.back(-1)" type="button" class="btn btn-sm btn-default" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Kembali</button>
                                    <!-- <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-eraser mr-2"></i>Reset</button> -->
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
<script>
    $("#id_transaksi").change(function() {
        let id_transaksi = $(this).val();
        // let stok_gd = document.getElementById("stok_gd");

        <?php foreach ($list_data as $s) { ?>
            if (id_transaksi == "<?php echo $s->id_u_sewa ?>") {

                $("#tanggal_keluar").val("<?php echo date('d-m-Y', strtotime($s->tanggal_keluar)) ?>");
                $("#tanggal_masuk").val("<?php echo date('d-m-Y', strtotime($s->tanggal_masuk)) ?>");
                $("#nama_plg").val("<?php echo $s->nama_plg ?>");

            }
        <?php } ?>
    })
</script>
</body>

</html>
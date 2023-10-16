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
                            Tambah Data Perbaikan Genset
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

                            <form action="<?= site_url('admin/proses_tambah_service_genset'); ?>" method="post" role="form">

                                <div class="form-group">
                                    <label for="kode_genset" class="form-label" title="*Pilih dulu untuk menampilkan nama genset">Nomor Genset</label>

                                    <select name="id_genset" class="form-control" id="id_genset" required>
                                        <option value="" selected disabled>-- Pilih Nomor Genset --</option>
                                        <?php foreach ($list_genset as $g) { ?>
                                            <option value="<?= $g->id_genset; ?>"><?= $g->kode_genset; ?> - <?= $g->nama_genset; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="nama_genset" class="form-label">Nama Genset</label>

                                    <input type="text" name="nama_genset" class="form-control" id="nama_genset" placeholder="Nama Genset" readonly>
                                </div> -->
                                <div class="form-group">
                                    <label for="jenis_perbaikan" class="form-label">Jenis Perbaikan</label>

                                    <input type="text" name="jenis_perbaikan" class="form-control" id="jenis_perbaikan" placeholder="Contoh : Perbaikan Aki dll" required>
                                </div>
                                <div class="form-group">
                                    <label for="spare_part" class="form-label">Spare Part (Diganti)</label>
                                    <input type="hidden" name="stok" id="stok_input" value="">
                                    <!-- <input type="text" name="spare_part" class="form-control" id="spare_part" placeholder="Filter Oli, Filter Solar dll"> -->

                                    <select name="id_sparepart" class="form-control" id="spare_part">
                                        <option value="" selected>-- Pilih Sparepart --</option>
                                        <?php foreach ($list_sparepart as $s) { ?>
                                            <option value="<?= $s->id_sparepart; ?>"><?= $s->nama_sparepart; ?></option>
                                        <?php } ?>
                                    </select>
                                    <small>*Sisa Stok&nbsp;<span style="color: red;" id="stk"></span></small>
                                </div>
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="tgl_perbaikan" class="form-label">Tanggal Perbaikan</label>
                                        <input type="date" name="tgl_perbaikan" class="form-control" id="tgl_perbaikan" placeholder="Tanggal Perbaikan" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="tgl_perbaikan" class="form-label">Tanggal Perbaikan Kembali</label>
                                        <input type="date" name="tgl_perbaikan_kembali" class="form-control" id="tgl_perbaikan" placeholder="Tanggal Perbaikan" required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_perbaikan" class="form-label">Lama Pemakaian Genset (dalam Jam)</label>

                                    <input type="number" name="jam_pakai" class="form-control" id="jam_pakai" placeholder="Lama Pemakaian Genset (dalam Jam)" required>
                                </div>

                                <div class="form-group">
                                    <label for="ket_perbaikan" class="form-label">Keterangan Perbaikan</label>

                                    <select name="ket_perbaikan" class="form-control" id="ket_perbaikan" required>
                                        <option value="">-- Status --</option>
                                        <option value="0">Masih Proses</option>
                                        <option value="1">Selesai Diperbaiki</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="biaya_perbaikan" class="form-label">Perkiraan Biaya</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="number" name="biaya_perbaikan" class="form-control" id="biaya_perbaikan" placeholder="Masukkan Perkiraan Biaya">
                                    </div>
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
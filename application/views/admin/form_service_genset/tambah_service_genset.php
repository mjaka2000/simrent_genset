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
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/tabel_service_genset'); ?>">Data Perbaikan Genset</a></li>
                        <li class="breadcrumb-item active">Tambah Data Perbaikan Genset</li>
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
                        <div class="card-header">
                            Tambah Data Perbaikan Genset
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

                            <form action="<?= base_url('admin/proses_tambah_service_genset'); ?>" method="post" role="form">

                                <div class="form-group">
                                    <label for="kode_genset" class="form-label">Nomor Genset</label>&nbsp;<span style="color: red;"><small>*Pilih dulu untuk menampilkan nama genset</small></span>
                                    <select name="id_genset" class="form-control" id="id_genset" required>
                                        <option value="" selected disabled>-- Pilih Nomor Genset --</option>
                                        <?php foreach ($list_genset as $g) { ?>
                                            <option value="<?= $g->id_genset; ?>"><?= $g->kode_genset; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama_genset" class="form-label">Nama Genset</label>
                                    <p><strong><span style="color: red;" id="nama_genset"></span></strong></p>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_perbaikan" class="form-label">Jenis Perbaikan</label>
                                    <input type="text" name="jenis_perbaikan" class="form-control" id="jenis_perbaikan" placeholder="Contoh : Perbaikan Aki dll" required>
                                </div>
                                <div class="form-group">
                                    <label for="spare_part" class="form-label">Spare Part (Diganti)</label>&nbsp;<span style="color: red;"><small>*Jika tidak ada yang diganti abaikan</small></span>
                                    <input type="hidden" name="stok" id="stok_input" value="">
                                    <p><small>*Sisa Stok&nbsp;<span style="color: red;" id="stok"></small></span></p>
                                    <!-- <input type="text" name="spare_part" class="form-control" id="spare_part" placeholder="Filter Oli, Filter Solar dll"> -->
                                    <select name="id_sparepart" class="form-control" id="spare_part">
                                        <option value="" selected>-- Pilih Sparepart --</option>
                                        <?php foreach ($list_sparepart as $s) { ?>
                                            <option value="<?= $s->id_sparepart; ?>"><?= $s->nama_sparepart; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_perbaikan" class="form-label">Tanggal Perbaikan</label>
                                    <input type="date" name="tgl_perbaikan" class="form-control" id="tgl_perbaikan" placeholder="Tanggal Perbaikan" required>
                                </div>

                                <div class="form-group">
                                    <label for="ket_perbaikan" class="form-label">Keterangan Perbaikan</label>
                                    <select name="ket_perbaikan" class="form-control" id="ket_perbaikan" required>
                                        <option value="">-- Status --</option>
                                        <option value="Selesai Diperbaiki">Selesai Diperbaiki</option>
                                        <option value="Masih Terkendala">Masih Terkendala</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="biaya_perbaikan" class="form-label">Perkiraan Biaya Perbaikan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" name="biaya_perbaikan" class="form-control" id="biaya_perbaikan" value="0">
                                    </div>
                                </div>

                                <hr>
                                <div class="form-group" align="center">
                                    <a href="<?= base_url('admin/tabel_service_genset'); ?>" type="button" class="btn btn-sm btn-default" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Kembali</a>
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
    //* Script untuk membuat input tanggal
    // $('.form_datetime').datetimepicker({
    //     format: 'dd-mm-yyyy',
    //     autoclose: true,
    //     todayBtn: true,
    //     pickTime: false,
    //     minView: 2,
    //     maxView: 4,
    // });

    //* Script untuk memuat data genset
    $("#id_genset").change(function() {
        let kode_genset = $(this).val();
        let nama_genset = document.getElementById("nama_genset");

        <?php foreach ($list_genset as $l) { ?>
            if (kode_genset == "<?php echo $l->id_genset ?>") {
                var text = document.createTextNode("<?= $l->nama_genset; ?>");
                nama_genset.innerHTML = "<?= $l->nama_genset; ?>";
            }
        <?php } ?>
    })

    //*Script untuk memuat stok
    $("#spare_part").change(function() {
        let spare_part = $(this).val();
        let stok = document.getElementById("stok");

        <?php foreach ($list_sparepart as $ls) { ?>
            if (spare_part == "<?= $ls->id_sparepart ?>") {
                var text = document.createTextNode("<?= $ls->stok; ?>");

                $("#stok_input").val("<?= $ls->stok; ?>");
                if (stok.innerHTML = "<?= $ls->stok  <= 0; ?>") {
                    Swal.fire(
                        'Error!',
                        'Maaf, Stok Sparepart Tidak Cukup, lakukan pembelian untuk menambah stok.',
                        'error'
                    ).then(result => {
                        window.location.href = "<?= base_url('admin/tabel_sparepart'); ?>"
                    })
                } else {
                    stok.innerHTML = "<?= $ls->stok; ?>";
                }
            }
        <?php } ?>
    })
</script>

</body>

</html>
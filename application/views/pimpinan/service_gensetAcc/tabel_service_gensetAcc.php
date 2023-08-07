<?php $this->load->view('template/head'); ?>
<?php $this->load->view('pimpinan/template/nav'); ?>
<?php $this->load->view('pimpinan/template/sidebar'); ?>

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
                        <li class="breadcrumb-item"><a href="<?= site_url('pimpinan'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Perbaikan Genset Disetujui</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div id="loading" class="tengah">
            <img src="<?= base_url(); ?>assets/style/loading.gif" alt="loading" width="50%">
        </div>
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Perbaikan Genset Disetujui
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>
                            <!-- <button onclick="window.location.href='<?= site_url('pimpinan/tambah_service_genset_acc'); ?>'" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-primary" name="tambah_data"><i class="fa fa-plus"></i>&nbsp;Tambah Data</button> -->

                            <table id="examplejk" class="table table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width :10px">No.</th>
                                        <th style="width :150px">Nomor Genset</th>
                                        <th>Nama Genset</th>
                                        <th>Jenis Perbaikan</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th style="width:10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (is_array($list_data)) { ?>
                                        <?php foreach ($list_data as $d) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $d->kode_genset; ?></td>
                                                <td><?= $d->nama_genset; ?></td>
                                                <td><?= $d->jenis_perbaikan; ?></td>
                                                <td><?= date('d-m-Y', strtotime($d->tgl_setujui)); ?></td>
                                                <td><?= $d->keterangan; ?></td>
                                                <?php if ($d->status_ajuan == "0") { ?>
                                                    <td><a href="#" type="button" class="btn btn-xs btn-danger">not verified</a></td>
                                                <?php } else { ?>
                                                    <td><a href="#" type="button" class="btn btn-xs btn-success">verified</a></td>
                                                <?php } ?>
                                                <td>
                                                    <button type="button" data-toggle="modal" data-target="#staticEditServGstAcc<?= $d->id_serv_gst_acc; ?>" title="Edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                                                    <!-- <a href="<?= base_url('pimpinan/update_service_genset_acc/' . $d->id_serv_gst_acc); ?>" type="button" class="btn btn-sm btn-info" name="btn_edit"><i class="fa fa-edit"></i></a> -->
                                                    <!-- <a href="<?= base_url('pimpinan/hapus_service_genset_acc/' . $d->id_serv_gst_acc); ?>" type="button" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash"></i></a> -->
                                                    <!-- <a href="<?= base_url('pimpinan/detail_service_genset/' . $d->id_serv_gst_acc); ?>" type="button" class="btn btn-sm btn-warning" name="btn_detail"><i class="fa fa-info-circle "></i></a> -->
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php foreach ($list_data as $d) { ?>

                        <div class="modal fade" id="staticEditServGstAcc<?= $d->id_serv_gst_acc; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="staticBackdropLabel">Ubah Data Perbaikan Genset Disetujui</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span>&times;</span>
                                        </button>


                                    </div>
                                    <div class="modal-body">
                                        <?php if (validation_errors()) { ?>
                                            <div class="alert alert-warning alert-dismissable">
                                                <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                                <strong>Peringatan!</strong><br> <?php echo validation_errors(); ?>
                                            </div>
                                        <?php } ?>
                                        <form action="<?= site_url('pimpinan/proses_ubah_ServGstAcc'); ?>" method="post" role="form">
                                            <input type="hidden" name="id_serv_gst_acc" value="<?= $d->id_serv_gst_acc; ?>">
                                            <div class="form-group">
                                                <label for="nama" class="form-label">Perbaikan Genset Selesai<span><small style="color: red;">*Arahkan untuk menampilkan isi field</small></span></label>
                                                <select name="id_perbaikan_gst" class="form-control id_perbaikan_gst_ed" id="" required>
                                                    <option value="" selected>-- Pilih Nomor Genset --</option>
                                                    <?php foreach ($list_perbaikan as $g) { ?>
                                                        <?php if ($d->id_perbaikan_gst == $g->id_perbaikan_gst) { ?>
                                                            <option selected value="<?= $d->id_perbaikan_gst; ?>"><?= $g->kode_genset; ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?= $g->id_perbaikan_gst; ?>"><?= $g->kode_genset; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat" class="form-label">Nama Genset</label>

                                                <input type="text" name="nama_genset" class="form-control nama_genset_ed" id="" placeholder="Nama Genset" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="no_hp" class="form-label">Jenis Perbaikan</label>

                                                <input type="text" name="jenis_perbaikan" class="form-control jenis_perbaikan_ed" id="" placeholder="Jenis Perbaikan" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="no_hp" class="form-label">Tanggal</label>

                                                <input type="date" name="tgl_setujui" class="form-control " id="tgl_setujui" value="<?= $d->tgl_setujui; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="no_hp" class="form-label">Keterangan</label>

                                                <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Isi Keterangan" value="<?= $d->keterangan; ?>">
                                            </div>
                                            <div class=" form-group">
                                                <label for="no_hp" class="form-label">Status</label>
                                                <select name="status_ajuan" class="form-control" id="status_ajuan" required>
                                                    <option value="" disabled>-- Status --</option>
                                                    <?php if ($d->status_ajuan == "0") { ?>
                                                        <option value="0" selected>Tunda</option>
                                                        <option value="1">Verifikasi</option>
                                                    <?php } else { ?>
                                                        <option value="0">Tunda</option>
                                                        <option value="1" selected>Verifikasi</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-arrow-left mr-2"></i>Kembali</button>
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check mr-2"></i>Submit</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
<?php $this->load->view('template/footer'); ?>

<?php $this->load->view('pimpinan/template/script') ?>
<script>
    //* Script untuk menampilkan loading
    document.onreadystatechange = function() {
        if (document.readyState !== "complete") {
            document.querySelector(
                "body").style.visibility = "hidden";
            document.querySelector(
                "#loading").style.visibility = "visible";
        } else {
            document.querySelector(
                "#loading").style.display = "none";
            document.querySelector(
                "body").style.visibility = "visible";
        }
    };
</script>
<script type="text/javascript">
    $(function() {
        $('#examplejk').DataTable({
            // 'paging': true,
            // 'lengthChange': false,
            // 'searching': faslse,
            // 'ordering': false,
            // 'info': true,
            'responsive': true,
            'autoWidth': false
        })
    }); //* Script untuk memuat datatable
</script>
<script type="text/javascript">
    // 
    $(".id_perbaikan_gst_ed").click(function() {
        let kode_genset = $(this).val();
        <?php foreach ($list_perbaikan as $l) { ?>
            if (kode_genset == "<?php echo $l->id_perbaikan_gst ?>") {
                $(".nama_genset_ed").val("<?php echo $l->nama_genset ?>");
                $(".jenis_perbaikan_ed").val("<?php echo $l->jenis_perbaikan ?>");
            }
        <?php } ?>
    })

    $(".id_perbaikan_gst_ed").hover(function() {
        let kode_genset = $(this).val();
        <?php foreach ($list_perbaikan as $l) { ?>
            if (kode_genset == "<?php echo $l->id_perbaikan_gst ?>") {
                $(".nama_genset_ed").val("<?php echo $l->nama_genset ?>");
                $(".jenis_perbaikan_ed").val("<?php echo $l->jenis_perbaikan ?>");
            }
        <?php } ?>
    })
</script>
<script type="text/javascript">
    $('.btn-delete').on('click', function() {
        var getLink = $(this).attr('href');
        Swal.fire({
            title: 'Hapus Data',
            text: 'Yakin ingin menghapus data?',
            type: 'warning',
            confirmButtonColor: '#d9534f',
            showCancelButton: true,
        }).then(result => {
            //jika klik ya maka arahkan ke proses.php
            if (result.isConfirmed) {
                window.location.href = getLink
            }
        })
        return false;
    }); //* Script untuk memuat sweetalert hapus data
</script>
</body>

</html>
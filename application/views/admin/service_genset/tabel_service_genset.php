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
                        <li class="breadcrumb-item active">Perbaikan Genset</li>
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
                            Data Perbaikan Genset
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>
                            <!-- <button onclick="window.location.href='<?= site_url('admin/tambah_service_genset'); ?>'" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-primary" name="tambah_data"><i class="fa fa-plus"></i>&nbsp;Tambah Data</button> -->
                            <button data-toggle="modal" data-target="#staticAddServGst" class="btn btn-primary btn-sm" style="margin-bottom:10px;"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Data</button>

                            <table id="examplejk" class="table table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width :10px">No.</th>
                                        <th>Nomor Genset</th>
                                        <th>Nama Genset</th>
                                        <th>Jenis Perbaikan</th>
                                        <th>Spare Part (Diganti)</th>
                                        <th>Tgl. Perbaikan</th>
                                        <th>Ket. Perbaikan</th>
                                        <th>Biaya Perbaikan</th>
                                        <th style="width:10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (is_array($list_data)) { ?>
                                        <?php foreach ($list_data as $dt) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $dt->kode_genset; ?></td>
                                                <td><?= $dt->nama_genset; ?></td>
                                                <td><?= $dt->jenis_perbaikan; ?></td>
                                                <td><?= $dt->nama_sparepart; ?></td>
                                                <td><?= date('d-m-Y', strtotime($dt->tgl_perbaikan)); ?></td>
                                                <?php if ($dt->ket_perbaikan == "1") { ?>
                                                    <td><a href="#" type="button" class="btn btn-xs btn-success">Selesai Diperbaiki</a></td>
                                                <?php } else { ?>
                                                    <td><a href="#" type="button" class="btn btn-xs btn-danger">Masih Proses</a></td>
                                                <?php } ?>
                                                <td>Rp&nbsp;<?= number_format($dt->biaya_perbaikan); ?></td>
                                                <td>
                                                    <button type="button" data-toggle="modal" data-target="#staticEditServGst<?= $dt->id_perbaikan_gst; ?>" title="Edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                                                    <!-- <a href="<?= base_url('admin/update_data_service_genset/' . $dt->id_perbaikan_gst); ?>" type="button" title="Edit" class="btn btn-sm btn-info" name="btn_edit"><i class="fa fa-edit"></i></a> -->
                                                    <a href="<?= base_url('admin/hapus_service_genset/' . $dt->id_perbaikan_gst); ?>" type="button" title="Hapus" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash"></i></a>
                                                    <a href="<?= base_url('admin/detail_service_genset/' . $dt->id_perbaikan_gst); ?>" type="button" title="Lihat Detail" class="btn btn-sm btn-warning" name="btn_detail"><i class="fa fa-info-circle "></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade" id="staticAddServGst" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">Tambah Data Perbaikan Genset</h6>
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

                                    <form action="<?= site_url('admin/proses_tambah_service_genset'); ?>" method="post" role="form">

                                        <div class="form-group">
                                            <label for="kode_genset" class="form-label" title="*Pilih dulu untuk menampilkan nama genset">Nomor Genset</label>

                                            <select name="id_genset" class="form-control" id="id_genset" required>
                                                <option value="" selected disabled>-- Pilih Nomor Genset --</option>
                                                <?php foreach ($list_genset as $g) { ?>
                                                    <option value="<?= $g->id_genset; ?>"><?= $g->kode_genset; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_genset" class="form-label">Nama Genset</label>

                                            <input type="text" name="nama_genset" class="form-control" id="nama_genset" placeholder="Nama Genset" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_perbaikan" class="form-label">Jenis Perbaikan</label>

                                            <input type="text" name="jenis_perbaikan" class="form-control" id="jenis_perbaikan" placeholder="Contoh : Perbaikan Aki dll" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="spare_part" class="form-label">Spare Part (Diganti)</label>
                                            <input type="hidden" name="stok" id="stok_input" value="">
                                            <!-- <input type="text" name="spare_part" class="form-control" id="spare_part" placeholder="Filter Oli, Filter Solar dll"> -->

                                            <select name="id_sparepart" class="form-control" id="spare_part" required>
                                                <option value="" selected>-- Pilih Sparepart --</option>
                                                <?php foreach ($list_sparepart as $s) { ?>
                                                    <option value="<?= $s->id_sparepart; ?>"><?= $s->nama_sparepart; ?></option>
                                                <?php } ?>
                                            </select>
                                            <small>*Sisa Stok&nbsp;<span style="color: red;" id="stk"></span></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_perbaikan" class="form-label">Tanggal Perbaikan</label>

                                            <input type="date" name="tgl_perbaikan" class="form-control" id="tgl_perbaikan" placeholder="Tanggal Perbaikan" required>
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
                                            <label for="biaya_perbaikan" class="form-label">Biaya Perbaikan</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="text" name="biaya_perbaikan" class="form-control" id="biaya_perbaikan" value="0">
                                            </div>
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
                    <?php foreach ($list_data as $ld) { ?>

                        <div class="modal fade" id="staticEditServGst<?= $ld->id_perbaikan_gst; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="staticBackdropLabel">Ubah Data Perbaikan Genset</h6>
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
                                        <form action="<?= site_url('admin/proses_update_service_genset'); ?>" method="post" role="form">

                                            <input type="hidden" name="id_perbaikan_gst" value="<?= $ld->id_perbaikan_gst; ?>">
                                            <div class="form-group">
                                                <label for="kode_genset" class="form-label" title="*Arahkan untuk menampilkan nama genset">Nomor Genset <span><small style="color: red;">*Arahkan untuk menampilkan nama genset</small></span></label>

                                                <select name="id_genset" class="form-control id_genset_ed" id="">
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

                                                <input type="text" name="nama_genset" class="form-control nama_genset_ed" id="" placeholder="Nama Genset" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_perbaikan" class="form-label">Jenis Perbaikan</label>

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
                                                <label for="biaya_perbaikan" class="form-label">Biaya Perbaikan</label>

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp</span>
                                                    </div>
                                                    <input type="text" name="biaya_perbaikan" class="form-control" id="biaya_perbaikan" value="<?= $ld->biaya_perbaikan; ?>">
                                                </div>
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

<?php $this->load->view('admin/template/script') ?>
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
<script type="text/javascript">
    $(".id_genset_ed").hover(function() {
        let kode_genset = $(this).val();
        <?php foreach ($list_genset as $g) { ?>
            if (kode_genset == "<?php echo $g->id_genset ?>") {
                $(".nama_genset_ed").val("<?php echo $g->nama_genset ?>");
            }
        <?php } ?>
    })
    $(".id_genset_ed").click(function() {
        let kode_genset = $(this).val();
        <?php foreach ($list_genset as $g) { ?>
            if (kode_genset == "<?php echo $g->id_genset ?>") {
                $(".nama_genset_ed").val("<?php echo $g->nama_genset ?>");
            }
        <?php } ?>
    })
</script>
<script>
    //setting datatables
    // $('#tableserv').DataTable({
    // "language": {
    //     "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
    // },
    // "autoWidth": false,
    // "responsive": true,
    // "processing": true,
    // "serverSide": true,
    // "order": [],
    // "ajax": {
    //panggil method ajax list dengan ajax
    //         "url": '<?= site_url('admin/ajax_list_serv'); ?>',
    //         "type": "POST"
    //     }
    // });
</script>
<!-- <script type="text/javascript">
    $('#tableserv').on('click', '.btn-delete', function() {
        var getLink = $(this).attr('href');
        // var id = $(this).data('id_pemakai');
        Swal.fire({
            title: 'Hapus Data',
            text: 'Yakin ingin menghapus data?',
            type: 'warning',
            confirmButtonColor: '#d9534f',
            showCancelButton: true,
        }).then(result => {
            if (result.isConfirmed) {
                window.location.href = getLink
            }
        })
        return false;
    });

    //* Script untuk memuat sweetalert hapus data
</script> -->
</body>

</html>
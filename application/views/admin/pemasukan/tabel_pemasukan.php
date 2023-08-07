<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pendapatan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Data Pendapatan</li>
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
                            Data Pendapatan
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>
                            <button data-toggle="modal" data-target="#AddPendapatan" class="btn btn-primary btn-sm" style="margin-bottom:10px;"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Data</button>
                            <!-- <button onclick="window.location.href='<?= site_url('admin/tambah_pemasukan'); ?>'" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-primary" name="tambah_data"><i class="fa fa-plus"></i>&nbsp;Tambah Data</button> -->
                            <button data-toggle="modal" data-target="#staticPendapatanBulanan" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-success" name="tambah_data"><i class="fa fa-table"></i>&nbsp;Pilih Periode</button>

                            <table id="examplejk" class="table table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <?php foreach ($total_data as $td) : ?>
                                            <th colspan="7" style="text-align: center;">Total Pendapatan <?php echo $label ?> adalah: <span style="color: red;">Rp&nbsp;<?= number_format($td->total); ?></span></th>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <th style="width :10px">No.</th>
                                        <th>Tanggal Penyewaan</th>
                                        <th>ID Transaksi</th>
                                        <th>Pelanggan</th>
                                        <th>Tanggal Di Update</th>
                                        <th>Pendapatan</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    ?>
                                    <?php foreach ($list_data as $d) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <!-- <td><?= date('d-m-Y', strtotime($d->tanggal_masuk)); ?></td> -->
                                            <td><?= date('d-m-Y', strtotime($d->tanggal_masuk)); ?></td>
                                            <td><?= $d->id_transaksi; ?></td>
                                            <td><?= $d->nama_plg; ?></td>
                                            <td><?= date('d-m-Y', strtotime($d->tgl_update)); ?></td>
                                            <td>Rp&nbsp;<?= number_format($d->total); ?></td>
                                            <td><?= $d->keterangan; ?></td>
                                            <td>
                                                <button type="button" data-toggle="modal" data-target="#EditPendapatan<?= $d->id_pendapatan; ?>" title="Edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                                                <!-- <a href="<?= site_url('admin/edit_pemasukan/' . $d->id_pendapatan); ?>" type="button" title="Edit" class="btn btn-sm btn-info" name="btn_edit"><i class="fa fa-edit "></i></a> -->
                                                <a href="<?= site_url('admin/hapus_pemasukan/' . $d->id_pendapatan); ?>" type="button" title="Hapus" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash "></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                            <div class="box-footer">

                                <h5>

                                </h5>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="staticPendapatanBulanan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">Tampilkan Pendapatan Bulanan</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= site_url('admin/tabel_pemasukan'); ?>" method="get" role="form">

                                        <div class="form-group row">
                                            <label for="bulan" class="col-sm-3 col-form-label">Bulan</label>
                                            <div class="col-sm-6">
                                                <select name="bulan" id="bulan" class="form-control">
                                                    <option value="" selected="">--Pilih Bulan--</option>
                                                    <option value="01">Januari</option>
                                                    <option value="02">Februari</option>
                                                    <option value="03">Maret</option>
                                                    <option value="04">April</option>
                                                    <option value="05">Mei</option>
                                                    <option value="06">Juni</option>
                                                    <option value="07">Juli</option>
                                                    <option value="08">Agustus</option>
                                                    <option value="09">September</option>
                                                    <option value="10">Oktober</option>
                                                    <option value="11">November</option>
                                                    <option value="12">Desember</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tahun" class="col-sm-3 col-form-label">Tahun</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="tahun" class="form-control" id="tahun" value="<?= date('Y'); ?>">
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success btn-sm">Tampilkan</button>
                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="AddPendapatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">Tambah Data Pendapatan</h6>
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

                                    <form action="<?= site_url('admin/proses_tambah_pemasukan'); ?>" method="post" role="form">
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
                                            <label for="genset" class="form-label">Tanggal Penyewaan</label>


                                            <input type="text" readonly name="tanggal_masuk" class="form-control" id="tanggal_masuk">
                                        </div>
                                        <div class="form-group">
                                            <label for="genset" class="form-label">Nama Pelanggan</label>


                                            <input type="text" readonly name="nama_plg" class="form-control" id="nama_plg">
                                        </div>
                                        <div class="form-group">
                                            <label for="tahun" class="form-label">Tanggal Update</label>

                                            <input type="date" name="tgl_update" class="form-control" id="tgl_update" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tahun" class="form-label">Keterangan</label>

                                            <input type="text" name="keterangan" class="form-control" id="keterangan" required>
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
                    <?php foreach ($list_data as $ed) { ?>

                        <div class="modal fade" id="EditPendapatan<?= $ed->id_pendapatan; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="staticBackdropLabel">Ubah Data Pendapatan</h6>
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
                                        <form action="<?= site_url('admin/proses_edit_pemasukan'); ?>" method="post" role="form">
                                            <input type="hidden" name="id_pendapatan" value="<?= $ed->id_pendapatan; ?>">

                                            <div class="form-group">
                                                <label for="bulan" class="form-label" title="*Arahkan untuk menampilkan isi field">ID Transaksi<span><small style="color: red;">*Arahkan untuk menampilkan isi field</small></span></label>

                                                <select name="id_u_sewa" class="form-control id_transaksi_ed" id="" required>
                                                    <option value="">-- Pilih ID Transaksi --</option>
                                                    <?php foreach ($get_data as $d) { ?>
                                                        <?php if ($ed->id_u_sewa == $d->id_u_sewa) { ?>
                                                            <option value="<?= $ed->id_u_sewa ?>" selected><?= $d->id_transaksi ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?= $d->id_u_sewa ?>"><?= $d->id_transaksi ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="genset" class="form-label">Tanggal Penyewaan</label>


                                                <input type="text" readonly name="tanggal_masuk" class="form-control tanggal_masuk_ed" id="">
                                            </div>
                                            <div class="form-group">
                                                <label for="genset" class="form-label">Nama Pelanggan</label>


                                                <input type="text" readonly name="nama_plg" class="form-control nama_plg_ed" id="">
                                            </div>
                                            <div class="form-group">
                                                <label for="tahun" class="form-label">Tanggal Update</label>

                                                <input type="date" name="tgl_update" class="form-control" id="tgl_update" required value="<?= $ed->tgl_update; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="tahun" class="form-label">Keterangan</label>

                                                <input type="text" name="keterangan" class="form-control" id="keterangan" required value="<?= $ed->keterangan; ?>">
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
<script>
    $("#id_transaksi").change(function() {
        let id_transaksi = $(this).val();
        // let stok_gd = document.getElementById("stok_gd");

        <?php foreach ($get_data as $s) { ?>
            if (id_transaksi == "<?php echo $s->id_u_sewa ?>") {

                $("#tanggal_masuk").val("<?php echo date('d-m-Y', strtotime($s->tanggal_masuk)) ?>");
                $("#nama_plg").val("<?php echo $s->nama_plg ?>");

            }
        <?php } ?>
    })
</script>
<script>
    $(".id_transaksi_ed").click(function() {
        let id_transaksi = $(this).val();
        // let stok_gd = document.getElementById("stok_gd");

        <?php foreach ($get_data as $s) { ?>
            if (id_transaksi == "<?php echo $s->id_u_sewa ?>") {

                $(".tanggal_masuk_ed").val("<?php echo date('d-m-Y', strtotime($s->tanggal_masuk)) ?>");
                $(".nama_plg_ed").val("<?php echo $s->nama_plg ?>");

            }
        <?php } ?>
    })

    $(".id_transaksi_ed").hover(function() {
        let id_transaksi = $(this).val();
        // let stok_gd = document.getElementById("stok_gd");

        <?php foreach ($get_data as $s) { ?>
            if (id_transaksi == "<?php echo $s->id_u_sewa ?>") {

                $(".tanggal_masuk_ed").val("<?php echo date('d-m-Y', strtotime($s->tanggal_masuk)) ?>");
                $(".nama_plg_ed").val("<?php echo $s->nama_plg ?>");

            }
        <?php } ?>
    })
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
</body>

</html>
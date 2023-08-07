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
                        <li class="breadcrumb-item active">Jadwal Penyewaan Genset</li>
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
                            Jadwal Penyewaan Genset
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>
                            <!-- <button onclick="window.location.href='<?= site_url('admin/tambah_jdw_genset'); ?>'" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-primary" name="tambah_data"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Data</button> -->
                            <!-- <button onclick="window.location.href='<?= site_url('admin/email_jdw_genset'); ?>'" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-primary" name="tambah_data"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Data</button> -->
                            <button data-toggle="modal" data-target="#AddJdwGst" class="btn btn-primary btn-sm" style="margin-bottom:10px;"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Data</button>

                            <table id="examplejk" class="table table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width :10px">No.</th>
                                        <th>Operator</th>
                                        <th>Nama Genset</th>
                                        <th>Mobil Angkut</th>
                                        <th>Dipakai Tanggal</th>
                                        <th>Sampai Tanggal</th>
                                        <th>Lokasi</th>
                                        <th>Keterangan</th>
                                        <!-- <th>Status</th> -->
                                        <th style="width:10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    ?>
                                    <?php foreach ($list_data as $d) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $d->nama_op; ?></td>
                                            <td><?= $d->nama_genset; ?></td>
                                            <td><?= $d->merek; ?></td>
                                            <td><?= date('d-m-Y', strtotime($d->tgl_keluar)); ?></td>
                                            <td><?= date('d-m-Y', strtotime($d->tgl_masuk)); ?></td>
                                            <td><?= $d->lokasi; ?></td>
                                            <td><?= $d->keterangan; ?></td>
                                            <?php if ($d->status_jdw == "0") { ?>
                                                <!-- <td><a href="#" type="button" class="btn btn-xs btn-success">Tidak Dijadwalkan</a></td> -->
                                            <?php } else { ?>
                                                <!-- <td><a href="#" type="button" class="btn btn-xs btn-warning">Dijadwalkan</a></td> -->
                                            <?php } ?>
                                            <td>
                                                <button type="button" data-toggle="modal" data-target="#EditJdwGst<?= $d->id_jadwal_genset; ?>" title="Edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                                                <!-- <a href="<?= site_url('admin/update_jdw_genset/' . $d->id_jadwal_genset); ?>" type="button" title="Edit" class="btn btn-sm btn-info" name="btn_edit"><i class="fa fa-edit"></i></a> -->
                                                <a href="<?= site_url('admin/hapus_jdw_genset/' . $d->id_jadwal_genset); ?>" type="button" title="Hapus" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash"></i></a>
                                                <!-- <a href="<?= site_url('admin/detail_jdw_genset/' . $d->id_jadwal_genset); ?>" title="Lihat Detail" type="button" class="btn btn-sm btn-warning" name="btn_detail"><i class="fa fa-info-circle"></i></a> -->
                                                <!-- <a href="<?= site_url('report/cetak_jdw_genset/' . $d->id_jadwal_genset); ?>"  title="Cetak" target="_blank" type="button" class="btn btn-sm btn-info" name="btn_detail"><i class="fa fa-print"></i></a> -->
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade" id="AddJdwGst" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">Tambah Data Jadwal Penyewaan Genset</h6>
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

                                    <form action="<?= site_url('admin/proses_tambah_jdw_genset'); ?>" method="post" role="form">

                                        <div class="form-group row">
                                            <label for="nama_operator" class="col-sm-3 col-form-label">Nama Operator</label>
                                            <div class="col-sm-9">
                                                <select name="id_operator" class="form-control" id="nama_operator" required>
                                                    <option value="">-- Pilih Operator --</option>
                                                    <?php foreach ($list_operator as $op) { ?>
                                                        <option value="<?= $op->id_operator ?>"><?= $op->nama_op ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="kode_genset" class="col-sm-3 col-form-label">Genset</label>
                                            <div class="col-sm-9">
                                                <select name="id_genset" class="form-control" id="kode_genset" required>
                                                    <option value="">-- Pilih Genset--</option>
                                                    <?php foreach ($list_genset as $g) { ?>
                                                        <option value="<?= $g->id_genset ?>"><?= $g->kode_genset ?> - <?= $g->nama_genset; ?> - <?= $g->daya; ?> KVA</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nopol_mobil" class="col-sm-3 col-form-label">Mobil</label>
                                            <div class="col-sm-9">
                                                <select name="id_mobil" id="nopol" class="form-control" required>
                                                    <option value="">-- Pilih Mobil--</option>
                                                    <?php foreach ($list_mobil as $m) { ?>
                                                        <option value="<?= $m->id_mobil ?>"><?= $m->nopol ?> - <?= $m->merek; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="genset" class="col-sm-3 col-form-label">Tanggal Digunakan</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="tgl_keluar" class="form-control" id="tgl_keluar">
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row">
                                    <label for="genset" class="col-sm-3 col-form-label">Tanggal Selesai</label>
                                    <div class="col-sm-9">
                                        <input type="date" readonly name="tgl_masuk" class="form-control" id="tgl_masuk">
                                    </div>
                                </div> -->
                                        <div class="form-group row">
                                            <label for="genset" class="col-sm-3 col-form-label">Jumlah Hari</label>
                                            <div class="col-sm-9">
                                                <input type="number" name="jumlah_hari" class="form-control" id="jumlah_hari" placeholder="Masukkan Jumlah Hari">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="lokasi" class="col-sm-3 col-form-label">Lokasi</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="lokasi" class="form-control" id="lokasi" placeholder="Masukkan Lokasi Tujuan" required>

                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                    <label for="genset" class="form-label">Nama Pelanggan</label>
                                    <input type="text" readonly name="nama_plg" class="form-control" id="nama_plg">
                                </div> -->
                                        <div class="form-group row">
                                            <label for="tahun" class="col-sm-3 col-form-label">Keterangan</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Masukkan Keterangan" required>
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
                    <?php foreach ($list_data as $ed) { ?>

                        <div class="modal fade" id="EditJdwGst<?= $ed->id_jadwal_genset; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="staticBackdropLabel">Ubah Data Jadwal Penyewaan Genset</h6>
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
                                        <form action="<?= site_url('admin/proses_ubah_jdw_genset'); ?>" method="post" role="form">
                                            <input type="hidden" name="id_jadwal_genset" value="<?= $ed->id_jadwal_genset; ?>">

                                            <div class="form-group row">
                                                <label for="nama_operator" class="col-sm-3 col-form-label">Nama Operator</label>
                                                <div class="col-sm-9">
                                                    <select name="id_operator" class="form-control" id="nama_operator" required>
                                                        <option value="">-- Pilih Operator --</option>
                                                        <?php foreach ($list_operator as $op) { ?>
                                                            <?php if ($ed->id_operator == $op->id_operator) { ?>
                                                                <option value="<?= $ed->id_operator ?>" selected><?= $op->nama_op ?></option>
                                                            <?php } else { ?>
                                                                <option value="<?= $op->id_operator ?>"><?= $op->nama_op ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="kode_genset" class="col-sm-3 col-form-label">Genset</label>
                                                <div class="col-sm-9">
                                                    <select name="id_genset" class="form-control" id="kode_genset" required>
                                                        <option value="">-- Pilih Genset--</option>
                                                        <?php foreach ($list_genset as $g) { ?>
                                                            <?php if ($ed->id_genset == $g->id_genset) { ?>
                                                                <option value="<?= $ed->id_genset ?>" selected><?= $g->kode_genset ?> - <?= $g->nama_genset; ?> - <?= $g->daya; ?> KVA</option>
                                                            <?php } else { ?>
                                                                <option value="<?= $g->id_genset ?>"><?= $g->kode_genset ?> - <?= $g->nama_genset; ?> - <?= $g->daya; ?> KVA</option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="nopol_mobil" class="col-sm-3 col-form-label">Mobil</label>
                                                <div class="col-sm-9">
                                                    <select name="id_mobil" id="nopol" class="form-control" required>
                                                        <option value="">-- Pilih Mobil--</option>
                                                        <?php foreach ($list_mobil as $m) { ?>
                                                            <?php if ($ed->id_mobil == $m->id_mobil) { ?>
                                                                <option value="<?= $ed->id_mobil ?>" selected><?= $m->nopol ?> - <?= $m->merek; ?></option>
                                                            <?php } else { ?>
                                                                <option value="<?= $m->id_mobil ?>"><?= $m->nopol ?> - <?= $m->merek; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="genset" class="col-sm-3 col-form-label">Tanggal Digunakan</label>
                                                <div class="col-sm-9">
                                                    <input type="date" name="tgl_keluar" class="form-control" id="tgl_keluar" value="<?= $ed->tgl_keluar; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="genset" class="col-sm-3 col-form-label">Sampai Tanggal</label>
                                                <div class="col-sm-9">
                                                    <input type="date" readonly name="tgl_masuk" class="form-control" id="tgl_masuk" value="<?= $ed->tgl_masuk; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="genset" class="col-sm-3 col-form-label">Jumlah Hari</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="jumlah_hari" class="form-control" id="jumlah_hari" placeholder="Masukkan Jumlah Hari" value="<?= $ed->jumlah_hari; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="lokasi" class="col-sm-3 col-form-label">Lokasi</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="lokasi" class="form-control" id="lokasi" placeholder="Masukkan Lokasi Tujuan" required value="<?= $ed->lokasi; ?>">

                                                </div>
                                            </div>
                                            <!-- <div class="form-group">
    <label for="genset" class="form-label">Nama Pelanggan</label>
    <input type="text" readonly name="nama_plg" class="form-control" id="nama_plg">
</div> -->
                                            <div class="form-group row">
                                                <label for="tahun" class="col-sm-3 col-form-label">Keterangan</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Masukkan Keterangan" required value="<?= $ed->keterangan; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="stok_gd" class="col-sm-3 col-form-label">Status</label>
                                                <div class="col-sm-9">

                                                    <select name="status_jdw" id="status_jdw" class="form-control" required>
                                                        <option value="">-- Status --</option>
                                                        <?php if ($ed->status_jdw == "0") { ?>
                                                            <option value="0" selected>Tidak Dijadwalkan</option>
                                                            <option value="1">Dijadwalkan</option>
                                                        <?php } else { ?>
                                                            <option value="0">Tidak Dijadwalkan</option>
                                                            <option value="1" selected>Dijadwalkan</option>
                                                        <?php } ?>
                                                    </select>
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
</body>

</html>
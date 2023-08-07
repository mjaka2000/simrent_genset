<?php $this->load->view('template/head'); ?>
<?php $this->load->view('teknisi/template/nav'); ?>
<?php $this->load->view('teknisi/template/sidebar'); ?>

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
                        <li class="breadcrumb-item"><a href="<?= site_url('teknisi'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('teknisi/tabel_service_genset'); ?>">Perbaikan Genset</a></li>
                        <li class="breadcrumb-item active">Detail Perbaikan Genset</li>
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
                            Detail Progress Data Perbaikan Genset
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>
                            <?php foreach ($list_data as $d) : ?>
                                <button onclick="history.back(-1)" type="button" class="btn btn-sm btn-default" name="btn_kembali" style="margin-bottom:10px;"><i class="fa fa-arrow-left mr-2"></i>Kembali</button>
                                <button data-toggle="modal" data-target="#staticAddServGstDet" class="btn btn-primary btn-sm" style="margin-bottom:10px;"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Data</button>
                                <!-- <a href="<?= site_url('report/cetak_service_detail/' . $d->id_perbaikan_gst); ?>" target="_blank" type="button" style="margin-bottom:10px;margin-left: 10px;" class="btn btn-sm btn-default" name="btn_edit"><i class="fa fa-print mr-2"></i>Cetak Data</a> -->
                                <table class="table" style="width:35%">
                                    <tr>
                                        <th style="vertical-align: middle">Nomor Genset</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;<?= $d->kode_genset; ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle">Nama Genset</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;<?= $d->nama_genset; ?> </div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle">Jenis Perbaikan</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;<?= $d->jenis_perbaikan; ?> </div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle">Spare Part</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;<?= $d->nama_sparepart; ?> </div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle">Tgl. Perbaikan</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;<?= date('d-m-Y', strtotime($d->tgl_perbaikan)); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle">Ket. Perbaikan</th>
                                        <form action="<?= site_url('teknisi/proses_update_ket_service'); ?>" method="post" role="form">
                                            <td style="vertical-align: middle;">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <div class="row">
                                                            <input type="hidden" name="id_perbaikan_gst" value="<?= $d->id_perbaikan_gst; ?>">
                                                            :&nbsp;<span><select name="ket_perbaikan" class="form-control" id="ket_perbaikan">
                                                                    <option value="">-- Status --</option>
                                                                    <?php if ($d->ket_perbaikan == "1") { ?>
                                                                        <option value="1" selected>Selesai Diperbaiki</option>
                                                                        <option value="0">Masih Proses</option>
                                                                    <?php } else { ?>
                                                                        <option value="1">Selesai Diperbaiki</option>
                                                                        <option value="0" selected>Masih Proses</option>
                                                                    <?php } ?>

                                                                </select>
                                                                <span><button type="submit" class="btn btn-xs btn-success"><i class="fa fa-check mr-2"></i>Update</button></span>
                                                            </span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle">Biaya Perbaikan</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;Rp&nbsp;<?= number_format($d->biaya_perbaikan); ?> </div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </table>
                                <table align="center" id="tableserv" class="table table-bordered table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th colspan="6" style="text-align: center;">Tracking Aktivitas Perbaikan Genset</th>
                                        </tr>
                                        <tr>
                                            <th style="width :10px">No.</th>
                                            <th>Pekerjaan</th>
                                            <th>Tanggal</th>
                                            <th>Kendala</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        ?>
                                        <?php foreach ($detail_perbaikan as $dt) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $dt->pekerjaan; ?></td>
                                                <td><?= date('d-m-Y', strtotime($dt->tanggal)); ?></td>
                                                <td><?= $dt->kendala; ?></td>
                                                <?php if ($dt->status == "1") { ?>
                                                    <td>Selesai</td>
                                                <?php } else { ?>
                                                    <td>Pending</td>
                                                <?php } ?>
                                                <td><a href="<?= site_url('teknisi/hapus_detail/' . $dt->id_detail_serv); ?>" type="button" title="Hapus" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash"></i></a>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <div class="modal fade" id="staticAddServGstDet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">Tambah Detail Perbaikan Genset</h6>
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

                                    <?php foreach ($list_data as $det) { ?>
                                        <form action="<?= site_url('teknisi/proses_tambah_service_detail'); ?>" method="post" role="form">
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
                                        <?php } ?>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-arrow-left mr-2"></i>Kembali</button>
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check mr-2"></i>Submit</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
<?php $this->load->view('template/footer'); ?>

<?php $this->load->view('template/script') ?>
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
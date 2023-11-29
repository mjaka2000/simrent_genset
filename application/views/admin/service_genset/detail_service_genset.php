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
                                <button onclick="window.location.href='<?= site_url('admin/tambah_service_detail/' . $d->id_perbaikan_gst); ?>'" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-primary" name="tambah_data"><i class="fa fa-plus"></i>&nbsp;Tambah Data</button>
                                <!-- <a href="<?= site_url('report/cetak_service_detail/' . $d->id_perbaikan_gst); ?>" target="_blank" type="button" style="margin-bottom:10px;margin-left: 10px;" class="btn btn-sm btn-default" name="btn_edit"><i class="fa fa-print mr-2"></i>Cetak Data</a> -->
                                <table class="table table-sm" style="width:40%">
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
                                        <th style="vertical-align: middle">Ket. Jenis Perbaikan</th>
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
                                    <!-- <tr>
                                        <th style="vertical-align: middle">Tgl. Perbaikan Kembali</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;<?= date('d-m-Y', strtotime($d->tgl_perbaikan_kembali)); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr> -->
                                    <tr>
                                        <th style="vertical-align: middle">Hours Meter Genset</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;<?= $d->jam_pakai; ?> &nbsp;<strong>H</strong></div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle">Ket. Perbaikan</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        <form action="<?= site_url('admin/proses_update_ket_service'); ?>" class="form-inline" method="post" role="form">
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
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle">Perkiraan Biaya</th>
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
                                                <td><a href="<?= site_url('admin/hapus_detail/' . $dt->id_detail_serv); ?>" type="button" title="Hapus" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash"></i></a>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
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
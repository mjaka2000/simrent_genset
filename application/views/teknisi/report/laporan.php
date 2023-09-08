<?php $this->load->view('template/head'); ?>
<?php $this->load->view('teknisi/template/nav'); ?>
<?php $this->load->view('teknisi/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Report</small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('teknisi'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Report</li>
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
            <h2 align="center">Selamat Datang, <strong><?= $this->session->userdata('nama') ?></strong> sebagai Teknisi!</h2>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Laporan Data
                        </div>
                        <div class="card-body">
                            <table id="reporttable" class="table table-bordered" style="width:100%">

                                <tr>
                                    <form action="<?= site_url(); ?>report/cetak_serv_gensetAll" method="post" role="form" target="_blank">
                                        <th style="vertical-align: middle;">Laporan Perbaikan Genset</th>
                                        <td style="vertical-align: middle;">
                                            <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-print mr-2"></i>Cetak</button>
                                    </form>
                                    <button data-toggle="modal" data-target="#RepPerbaikanFilter" class="btn btn-info btn-sm" title="Filter Berdasarkan Unit"><i class="fa fa-filter"></i>&nbsp;Filter</button>
                                    <button data-toggle="modal" data-target="#staticRepPerbaikanDetail" class="btn btn-info btn-sm"><i class="fa fa-list"></i>&nbsp;Pilih Detail</button>
                                    </td>
                                </tr>

                                <tr>
                                    <form action="<?= site_url(); ?>report/cetak_sparepart" method="post" role="form" target="_blank">
                                        <th style="vertical-align: middle;">Laporan Data Stok Sparepart</th>
                                        <td style="vertical-align: middle;">
                                            <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-print mr-2"></i>Cetak</button>
                                    </form>
                                    <button data-toggle="modal" data-target="#RepStokSparepartFilter" class="btn btn-info btn-sm" title="Filter Data"><i class="fa fa-filter"></i>&nbsp;Filter</button>
                                    </td>
                                </tr>
                                <tr>
                                    <form action="<?= site_url(); ?>report/cetak_service_genset_acc" method="post" role="form" target="_blank">
                                        <th style="vertical-align: middle;">Laporan Perbaikan Genset Disetujui</th>
                                        <td style="vertical-align: middle;">
                                            <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-print mr-2"></i>Cetak</button>
                                    </form>
                                    <button data-toggle="modal" data-target="#RepPerbaikanAccFilterUnit" class="btn btn-info btn-sm" title="Filter Berdasarkan Unit"><i class="fa fa-filter"></i>&nbsp;Filter</button>
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <form action="<?= site_url(); ?>teknisi/#" method="post" role="form" target="_blank">
                                        <th style="vertical-align: middle">Laporan #</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="date" name="tgl_awal" class="form-control" id="tgl_update" placeholder="Tanggal Update" required value="<?= date('Y-m-d'); ?>">
                                                        </div><span>&nbsp;s/d&nbsp;</span>
                                                        <div class="col-md-4">
                                                            <input type="date" name="tgl_akhir" class="form-control" id="tgl_update" placeholder="Tanggal Update" required value="<?= date('Y-m-d'); ?>">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="submit" class="btn btn-info"><i class="fas fa-print mr-2"></i> Cetak</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </form>
                                </tr> -->
                            </table>
                            <!-- </div> -->
                        </div>
                    </div>

                    <div class="modal fade" id="RepPerbaikanAccFilterUnit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">Laporan Filter Perbaikan Disetujui</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= site_url('report/cetak_serviceGensetAccFilterUnit'); ?>" method="get" role="form" target="_blank">
                                        <div class="form-group row">
                                            <label for="bulan" class="col-sm-3 col-form-label">Nama Genset</label>
                                            <div class="col-sm-6">
                                                <select name="genset" id="genset" class="form-control" required>
                                                    <option value="" selected="" disabled>--Pilih Genset--</option>
                                                    <?php foreach ($list_genset as $g) { ?>
                                                        <option value="<?= $g->nama_genset ?>"><?= $g->kode_genset ?> - <?= $g->nama_genset; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="bulan" class="col-sm-3 col-form-label">Bulan</label>
                                            <div class="col-sm-6">
                                                <select name="bulan" id="bulan" class="form-control" required>
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
                                    <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-print mr-2"></i>Cetak</button>
                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="RepStokSparepartFilter" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">Laporan Filter Sparepart </h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form action="<?= site_url('report/cetak_sparepartFilter'); ?>" method="get" role="form" target="_blank">
                                        <div class="form-group row">
                                            <label for="tahun" class="col-sm-3 col-form-label">Stok</label>
                                            <div class="col-sm-6">
                                                <input type="number" name="stok" max="5" class="form-control" id="stok">
                                                <small style="color: red;">
                                                    <p>*Cari jumlah stok Sparepart kurang dari 5.</p>
                                                </small>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row">
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
                                        </div> -->
                                        <!-- <div class="form-group row">
                                            <label for="tahun" class="col-sm-3 col-form-label">Tahun</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="tahun" class="form-control" id="tahun" value="<?= date('Y'); ?>">
                                            </div>
                                        </div> -->
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-print mr-2"></i>Cetak</button>
                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="RepPerbaikanFilter" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">Laporan Filter Perbaikan</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= site_url('report/cetak_PerbaikanFilter'); ?>" method="get" role="form" target="_blank">
                                        <div class="form-group row">
                                            <label for="bulan" class="col-sm-3 col-form-label">Nama Genset</label>
                                            <div class="col-sm-6">
                                                <select name="genset" id="genset" class="form-control" required>
                                                    <option value="" selected="" disabled>--Pilih Genset--</option>
                                                    <?php foreach ($list_genset as $g) { ?>
                                                        <option value="<?= $g->nama_genset ?>"><?= $g->kode_genset ?> - <?= $g->nama_genset; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="bulan" class="col-sm-3 col-form-label">Bulan</label>
                                            <div class="col-sm-6">
                                                <select name="bulan" id="bulan" class="form-control" required>
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
                                    <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-print mr-2"></i>Cetak</button>
                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="staticRepPerbaikanDetail" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">Laporan Perbaikan All</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table id="" class="table table-bordered table-hover examplejk" style="width:100%">
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
                                            ?>
                                            <?php foreach ($list_perbaikan as $dt) : ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $dt->kode_genset; ?></td>
                                                    <td><?= $dt->nama_genset; ?></td>
                                                    <td><?= $dt->jenis_perbaikan; ?></td>
                                                    <td><?= $dt->nama_sparepart; ?></td>
                                                    <td><?= date('d-m-Y', strtotime($dt->tgl_perbaikan)); ?></td>
                                                    <?php if ($dt->ket_perbaikan == "1") { ?>
                                                        <td><span class="badge badge-success">Selesai Diperbaiki</span></td>
                                                    <?php } else { ?>
                                                        <td><span class="badge badge-danger">Masih Proses</span></td>
                                                    <?php } ?>
                                                    <td>Rp&nbsp;<?= number_format($dt->biaya_perbaikan); ?></td>
                                                    <td>
                                                        <!-- <a href="<?= base_url('admin/update_data_service_genset/' . $dt->id_perbaikan_gst); ?>" type="button" class="btn btn-sm btn-info" name="btn_edit"><i class="fa fa-edit"></i></a> -->
                                                        <!-- <a href="<?= base_url('admin/hapus_service_genset/' . $dt->id_perbaikan_gst); ?>" type="button" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash"></i></a> -->
                                                        <a href="<?= base_url('report/cetak_service_detail/' . $dt->id_perbaikan_gst); ?>" target="_blank" type="button" class="btn btn-xs btn-info" name="btn_detail"><i class="fa fa-print mr-2"></i>Cetak</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
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
        $('.examplejk').DataTable({
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
</body>

</html>
<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

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
                        <li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
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
            <h2 align="center">Selamat Datang, <strong><?= $this->session->userdata('nama') ?></strong> sebagai Administrator!</h2>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Laporan Data
                        </div>
                        <div class="card-body">
                            <table id="reporttable" class="table table-bordered" style="width:100%">
                                <!-- <tr>
                                    <form action="<?= site_url(); ?>report/cetak_pengeluaran_periode" method="post" role="form" target="_blank">
                                        <th style="vertical-align: middle">Laporan Data Pengeluaran <br><small style="color: red;">*Berdasarkan Periode</small></th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="bulan" class="form-label">Bulan</label>
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
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="tahun" class="form-label">Tahun</label>
                                                                <input type="text" name="tahun" class="form-control" id="tahun" value="<?= date('Y'); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4"><br>
                                                            <button type="submit" class="btn btn-info"><i class="fas fa-print mr-2"></i> Cetak</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </form>
                                </tr>    
                            <tr> -->
                                <th style="vertical-align: middle;width :550px;">Laporan Data Pengeluaran <br><small style="color: red;">*Berdasarkan Periode</small></th>
                                <td style="vertical-align: middle;">
                                    <button data-toggle="modal" data-target="#staticRepKeluarBulanan" class="btn btn-info btn-sm"><i class="fa fa-table"></i>&nbsp;Pilih Periode</button>
                                </td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: middle;">Laporan Data Pemasukan<br><small style="color: red;">*Berdasarkan Periode</small></th>
                                    <td style="vertical-align: middle;">
                                        <button data-toggle="modal" data-target="#staticRepPendapatanBulanan" class="btn btn-info btn-sm"><i class="fa fa-table"></i>&nbsp;Pilih Periode</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: middle;">Laporan Data Penyewaan <br><small style="color: red;">*Berdasarkan Periode</small></th>
                                    <td style="vertical-align: middle;">
                                        <button data-toggle="modal" data-target="#staticRepPenyewaanBulanan" class="btn btn-info btn-sm"><i class="fa fa-table"></i>&nbsp;Pilih Periode</button>
                                        <button data-toggle="modal" data-target="#staticRepPenyewaanDetail" class="btn btn-info btn-sm"><i class="fa fa-list"></i>&nbsp;Pilih Detail</button>
                                    </td>
                                </tr>
                                <tr>
                                    <form action="<?= site_url(); ?>report/cetak_serv_gensetAll" method="post" role="form" target="_blank">
                                        <th style="vertical-align: middle;">Laporan Perbaikan Genset</th>
                                        <td style="vertical-align: middle;">
                                            <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-print mr-2"></i> Rekap Data</button>
                                    </form>
                                    <button data-toggle="modal" data-target="#staticRepPerbaikanDetail" class="btn btn-info btn-sm"><i class="fa fa-list"></i>&nbsp;Pilih Detail</button>
                                    </td>
                                </tr>
                                <tr>
                                    <form action="<?= site_url(); ?>report/cetak_service_genset_acc" method="post" role="form" target="_blank">
                                        <th style="vertical-align: middle;">Laporan Perbaikan Genset Disetujui</th>
                                        <td style="vertical-align: middle;">
                                            <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-print mr-2"></i> Rekap Data</button>
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="<?= site_url(); ?>report/cetak_jdw_gensetAll" method="post" role="form" target="_blank">
                                        <th style="vertical-align: middle;">Laporan Data Jadwal Penyewaan Genset</th>
                                        <td style="vertical-align: middle;">
                                            <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-print mr-2"></i> Rekap Data</button>
                                        </td>
                                    </form>
                                </tr>


                                <tr>
                                    <form action="<?= site_url(); ?>report/cetak_Pelanggan" method="post" role="form" target="_blank">
                                        <th style="vertical-align: middle;">Laporan Data Pelanggan</th>
                                        <td style="vertical-align: middle;">
                                            <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-print mr-2"></i> Rekap Data</button>
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="<?= site_url(); ?>report/cetak_Pelanggan_blacklist" method="post" role="form" target="_blank">
                                        <th style="vertical-align: middle;">Laporan Data Pelanggan Blacklist</th>
                                        <td style="vertical-align: middle;">
                                            <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-print mr-2"></i> Rekap Data</button>
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="<?= site_url(); ?>report/cetak_sparepart" method="post" role="form" target="_blank">
                                        <th style="vertical-align: middle;">Laporan Data Stok Sparepart</th>
                                        <td style="vertical-align: middle;">
                                            <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-print mr-2"></i> Rekap Data</button>
                                        </td>
                                    </form>
                                </tr>

                                <!-- <tr>
                                    <form action="<?= site_url(); ?>admin/#" method="post" role="form" target="_blank">
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
                    <div class="modal fade" id="staticRepKeluarBulanan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">Laporan Pengeluaran Bulanan</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= site_url('report/cetak_pengeluaran_periode'); ?>" method="post" role="form" target="_blank">
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
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-print mr-2"></i> Cetak</button>
                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="staticRepPendapatanBulanan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">Laporan Pendapatan Bulanan</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= site_url('report/cetak_pemasukan_periode'); ?>" method="post" role="form" target="_blank">
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
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-print mr-2"></i> Cetak</button>
                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="staticRepPenyewaanBulanan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">Laporan Penyewaan Bulanan</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= site_url('report/cetak_penyewaan'); ?>" method="post" role="form" target="_blank">
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
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-print mr-2"></i> Cetak</button>
                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="staticRepPenyewaanDetail" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">Laporan Penyewaan All</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table id="" class="table table-bordered table-hover examplejk" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="width :10px">No.</th>
                                                <th>ID</th>
                                                <!-- <th>Tanggal Keluar</th> -->
                                                <th>Tanggal Masuk (Kembali)</th>
                                                <th>Lokasi</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Nama Genset</th>
                                                <th>Daya</th>
                                                <th>Mobil</th>
                                                <th>Jml. Hari</th>
                                                <th>Total</th>
                                                <th>Status Genset</th>
                                                <th style="width:10%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            // $list_data = isset($_POST['list_data']) ? $_POST['list_data'] : '';
                                            ?>
                                            <?php foreach ($list_sewa as $dt) : ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $dt->id_transaksi; ?></td>
                                                    <!-- <td><?= $dt->tanggal_keluar; ?></td> -->
                                                    <td><?= date('d-m-Y', strtotime($dt->tanggal_masuk)); ?></td>
                                                    <td><?= $dt->lokasi; ?></td>
                                                    <td><?= $dt->nama_plg; ?></td>
                                                    <td><?= $dt->nama_genset; ?></td>
                                                    <td><?= $dt->daya; ?></td>
                                                    <td><?= $dt->nopol; ?></td>
                                                    <td><?= $dt->jumlah_hari; ?></td>
                                                    <td>Rp&nbsp;<?= number_format($dt->total); ?></td>
                                                    <?php if ($dt->status == NULL || $dt->status == 0) { ?>
                                                        <td>Genset Masuk (Kembali)
                                                        </td>
                                                    <?php } else { ?>
                                                        <td>Genset Masuk (Kembali)</td>
                                                    <?php } ?>
                                                    <td>
                                                        <!-- <a href="<?= base_url('admin/hapus_unit_masuk/' . $dt->id_u_sewa); ?>" type="button" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash "></i></a> -->
                                                        <a href="<?= base_url('report/cetak_penyewaan_detail/' . $dt->id_u_sewa); ?>" type="button" target="_blank" class="btn btn-xs btn-info" name="btn_detail"><i class="fa fa-print mr-2"></i>Cetak</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
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
                                                        <td><a href="#" type="button" class="btn btn-xs btn-success">Selesai Diperbaiki</a></td>
                                                    <?php } else { ?>
                                                        <td><a href="#" type="button" class="btn btn-xs btn-danger">Masih Proses</a></td>
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
<script type="text/javascript">
    // $(function() {
    //     $('#reporttable').DataTable({
    //         // 'paging': false,
    //         // 'lengthChange': false,
    //         // 'searching': false,
    //         // 'ordering': false,
    //         // 'info': true,
    //         'responsive': true,
    //         'autoWidth': false
    //     })
    // }); //* Script untuk memuat datatable
</script>
</body>

</html>
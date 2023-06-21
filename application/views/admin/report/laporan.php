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
            <h2 align="center">Selamat Datang, <strong><?= $this->session->userdata('name') ?></strong> sebagai Administrator!</h2>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Laporan Data
                        </div>
                        <div class="card-body">
                            <table id="reporttable" class="table table-bordered" style="width:100%">
                                <tr>
                                    <form action="<?= site_url(); ?>admin/#" method="post" role="form" target="_blank">
                                        <th style="vertical-align: middle">Laporan Data Pengeluaran <br><small style="color: red;">*Berdasarkan Periode</small></th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        <!-- <div class="col-md-4"> -->
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
                                                                <!-- </div> -->
                                                            </div>
                                                        </div>
                                                        <!-- <span>&nbsp;,&nbsp;</span> -->
                                                        <!-- <div class="col-md-4"> -->
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="tahun" class="form-label">Tahun</label>
                                                                <input type="text" name="tahun" class="form-control" id="tahun" value="<?= date('Y'); ?>">
                                                            </div>
                                                        </div>
                                                        <!-- </div> -->
                                                        <div class="col-sm-4"><br>
                                                            <button type="submit" class="btn btn-info"><i class="fas fa-print mr-2"></i> Cetak</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="<?= site_url(); ?>admin/#" method="post" role="form" target="_blank">
                                        <th style="vertical-align: middle">Laporan Data Pemasukan<br><small style="color: red;">*Berdasarkan Periode</small></th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        <!-- <div class="col-md-4"> -->
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
                                                                <!-- </div> -->
                                                            </div>
                                                        </div>
                                                        <!-- <span>&nbsp;,&nbsp;</span> -->
                                                        <!-- <div class="col-md-4"> -->
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="tahun" class="form-label">Tahun</label>
                                                                <input type="text" name="tahun" class="form-control" id="tahun" value="<?= date('Y'); ?>">
                                                            </div>
                                                        </div>
                                                        <!-- </div> -->
                                                        <div class="col-sm-4"><br>
                                                            <button type="submit" class="btn btn-info"><i class="fas fa-print mr-2"></i> Cetak</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="<?= site_url(); ?>admin/#" method="post" role="form" target="_blank">
                                        <th style="vertical-align: middle">Laporan Data Penyewaan <br><small style="color: red;">*Berdasarkan Periode</small></th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        <!-- <div class="col-md-4"> -->
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
                                                                <!-- </div> -->
                                                            </div>
                                                        </div>
                                                        <!-- <span>&nbsp;,&nbsp;</span> -->
                                                        <!-- <div class="col-md-4"> -->
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="tahun" class="form-label">Tahun</label>
                                                                <input type="text" name="tahun" class="form-control" id="tahun" value="<?= date('Y'); ?>">
                                                            </div>
                                                        </div>
                                                        <!-- </div> -->
                                                        <div class="col-sm-4"><br>
                                                            <button type="submit" class="btn btn-info"><i class="fas fa-print mr-2"></i> Cetak</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="<?= site_url(); ?>admin/#" method="post" role="form" target="_blank">
                                        <th style="vertical-align: middle">Laporan Data Jadwal Penyewaan Genset</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        <!-- <div class="col-md-4">
                                                            <input type="date" name="tgl_awal" class="form-control" id="tgl_update" placeholder="Tanggal Update" required value="<?= date('Y-m-d'); ?>">
                                                        </div><span>&nbsp;s/d&nbsp;</span>
                                                        <div class="col-md-4">
                                                            <input type="date" name="tgl_akhir" class="form-control" id="tgl_update" placeholder="Tanggal Update" required value="<?= date('Y-m-d'); ?>">
                                                        </div> -->
                                                        <div class="col-md-4">
                                                            <button type="submit" class="btn btn-info"><i class="fas fa-print mr-2"></i> Rekap Data</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="<?= site_url(); ?>admin/#" method="post" role="form" target="_blank">
                                        <th style="vertical-align: middle">Laporan Perbaikan Genset</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        <!-- <div class="col-md-4">
                                                            <input type="date" name="tgl_awal" class="form-control" id="tgl_update" placeholder="Tanggal Update" required value="<?= date('Y-m-d'); ?>">
                                                        </div><span>&nbsp;s/d&nbsp;</span>
                                                        <div class="col-md-4">
                                                            <input type="date" name="tgl_akhir" class="form-control" id="tgl_update" placeholder="Tanggal Update" required value="<?= date('Y-m-d'); ?>">
                                                        </div> -->
                                                        <div class="col-md-4">
                                                            <button type="submit" class="btn btn-info"><i class="fas fa-print mr-2"></i> Rekap Data</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </form>
                                </tr>

                                <tr>
                                    <form action="<?= site_url(); ?>admin/#" method="post" role="form" target="_blank">
                                        <th style="vertical-align: middle">Laporan Data Pelanggan</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        <!-- <div class="col-md-4">
                                                            <input type="date" name="tgl_awal" class="form-control" id="tgl_update" placeholder="Tanggal Update" required value="<?= date('Y-m-d'); ?>">
                                                        </div><span>&nbsp;s/d&nbsp;</span>
                                                        <div class="col-md-4">
                                                            <input type="date" name="tgl_akhir" class="form-control" id="tgl_update" placeholder="Tanggal Update" required value="<?= date('Y-m-d'); ?>">
                                                        </div> -->
                                                        <div class="col-md-4">
                                                            <button type="submit" class="btn btn-info"><i class="fas fa-print mr-2"></i> Rekap Data</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="<?= site_url(); ?>admin/#" method="post" role="form" target="_blank">
                                        <th style="vertical-align: middle">Laporan Data Pelanggan Blacklist</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        <!-- <div class="col-md-4">
                                                            <input type="date" name="tgl_awal" class="form-control" id="tgl_update" placeholder="Tanggal Update" required value="<?= date('Y-m-d'); ?>">
                                                        </div><span>&nbsp;s/d&nbsp;</span>
                                                        <div class="col-md-4">
                                                            <input type="date" name="tgl_akhir" class="form-control" id="tgl_update" placeholder="Tanggal Update" required value="<?= date('Y-m-d'); ?>">
                                                        </div> -->
                                                        <div class="col-md-4">
                                                            <button type="submit" class="btn btn-info"><i class="fas fa-print mr-2"></i> Rekap Data</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="<?= site_url(); ?>admin/#" method="post" role="form" target="_blank">
                                        <th style="vertical-align: middle">Laporan Data Stok Sparepart</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        <!-- <div class="col-md-4">
                                                            <input type="date" name="tgl_awal" class="form-control" id="tgl_update" placeholder="Tanggal Update" required value="<?= date('Y-m-d'); ?>">
                                                        </div><span>&nbsp;s/d&nbsp;</span>
                                                        <div class="col-md-4">
                                                            <input type="date" name="tgl_akhir" class="form-control" id="tgl_update" placeholder="Tanggal Update" required value="<?= date('Y-m-d'); ?>">
                                                        </div> -->
                                                        <div class="col-md-4">
                                                            <button type="submit" class="btn btn-info"><i class="fas fa-print mr-2"></i> Rekap Data</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
</body>

</html>
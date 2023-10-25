<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Genset</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/tabel_genset'); ?>">Genset</a></li>
                        <li class="breadcrumb-item active">Detail Data Genset</li>
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
            <div class="row tengah">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            Detail Data Genset
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>
                            <button onclick="window.location.href='<?= site_url('admin/tabel_genset'); ?>'" type="button" class="btn btn-sm btn-default" name="btn_kembali" style="margin-bottom:10px;"><i class="fa fa-arrow-left mr-2"></i>Kembali</button>
                            <button data-toggle="modal" data-target="#staticPakaiBulanan" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-success" name="PakaiBulanan"><i class="fa fa-table"></i>&nbsp;Pilih Periode</button>
                            <?php echo $label ?>
                            <?php foreach ($list_data as $d) : ?>
                                <!-- <button data-toggle="modal" data-target="#staticAddServGstDet" class="btn btn-primary btn-sm" style="margin-bottom:10px;"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Data</button> -->
                                <!-- <a href="<?= site_url('report/cetak_service_detail/' . $d->id_perbaikan_gst); ?>" target="_blank" type="button" style="margin-bottom:10px;margin-left: 10px;" class="btn btn-sm btn-default" name="btn_edit"><i class="fa fa-print mr-2"></i>Cetak Data</a> -->
                                <table class="table" style="width:100%">
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
                                        <th style="vertical-align: middle">Kapasitas Daya</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;<?= $d->daya; ?> KVA</div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle">Harga Perhari</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;Rp&nbsp;<?= number_format($d->harga); ?> </div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle">Gambar Genset</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;<img src="<?= base_url('assets/upload/genset/' . $d->gambar_genset); ?>" title="Lihat Gambar Genset" data-toggle="modal" data-target="#LihatGst<?= $d->id_genset; ?>" class="img img-box" width="100" height="100" alt="<?= $d->gambar_genset; ?>">

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle">Lama Pemakaian Genset <br><span><small style="color: red;">*Dalam 1 bulan</small></span></th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;<?= $d->jumlah_hari; ?> Hari (<?= $d->jumlah_hari * 24; ?> Jam) Pemakaian</div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            <?php endforeach; ?>

                        </div>
                    </div>
                    <?php foreach ($list_data as $d) : ?>
                        <div class="modal fade" id="LihatGst<?= $d->id_genset; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="staticBackdropLabel">Lihat Gambar Genset</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body tengah">
                                        <a href="<?= base_url('assets/upload/genset/' . $d->gambar_genset); ?>" download>
                                            <img src="<?= base_url('assets/upload/genset/' . $d->gambar_genset); ?>" class="img img-box" width="350" height="350" alt="<?= $d->gambar_genset; ?>">
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="modal fade" id="staticPakaiBulanan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">Tampilkan Pemakaian Bulanan</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php foreach ($list_data as $d) : ?>
                                        <form action="<?= site_url('admin/detail_genset/' . $d->id_genset); ?>" method="get" role="form">

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
                                        <?php endforeach; ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success btn-sm">Tampilkan</button>
                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
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

</body>

</html>
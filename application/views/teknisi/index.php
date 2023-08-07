<?php $this->load->view('template/head'); ?>
<?php $this->load->view('teknisi/template/nav'); ?>
<?php $this->load->view('teknisi/template/sidebar'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard <small>Control Panel</small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div id="loading">
            <img src="<?= base_url(); ?>assets/style/loading.gif" alt="loading" width="50%">
        </div>
        <div class="container-fluid">
            <h2 align="center">Selamat Datang, <strong><?= $this->session->userdata('nama') ?></strong> sebagai Teknisi!</h2>
            <div class="row">
                <!-- <div class="card-body bg-info">
                    <div class="inner">
                        <h3 align="center">This Page Will Coming Soon!!!</h3>
                    </div>
                    <div class="icon">
                    </div>
                </div> -->
                <!-- /.col-md-6 -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <li class="nav nav-item dropdown ">
                                <a class="nav-link" data-toggle="dropdown" href="#">
                                    <i class="far fa-bell fa-2x" style="color: white"></i>
                                    <?php if (empty($numServGenset)) { ?>
                                        <span></span>
                                    <?php } else { ?>
                                        <span class="badge badge-warning"><?= $numServGenset; ?></span>
                                    <?php } ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-lg">
                                    <span class="dropdown-item dropdown-header" style="background-color: #2596be;color: white;"><?= $numServGenset; ?> Pemberitahuan perbaikan genset</span>
                                    <div class="dropdown-divider"></div>
                                    <?php foreach ($notifServGenset as $c) : ?>
                                        <div class="card-footer">
                                            <a href="<?= site_url('teknisi/detail_service_genset/' . $c->id_perbaikan_gst); ?>" style="text-decoration: none; color: black;"><strong><?= $c->nama_genset; ?><br><?= $c->jenis_perbaikan; ?></strong><br>
                                                <small style="color: red;">Deadline pengajuan hasil perbaikan genset <strong><?= date('d/m/Y', strtotime($c->tgl_perbaikan)); ?></strong></small></a>
                                            <!-- <a href="<?= site_url('teknisi/email_jdw_genset/' . $c->id_perbaikan_gst); ?>" type="button" class="btn btn-xs btn-success" name="btn_edit"><i class="fa fa-paper-plane"> Send</i></a> -->

                                        </div>
                                    <?php endforeach ?>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item dropdown-footer"></a>
                                </div>
                            </li>
                            <!-- <?php if (!empty($dataServGenset)) { ?>
                                <h3><?= $dataServGenset ?></h3>
                            <?php } else { ?>
                                <h3>0</h3>
                            <?php } ?> -->
                            <p>Perbaikan Genset</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-wrench"></i>
                        </div>
                        <a href="<?= site_url(); ?>teknisi/tabel_service_genset" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <?php if (!empty($dataServGensetAcc)) { ?>
                                <h3><?= $dataServGensetAcc ?></h3>
                            <?php } else { ?>
                                <h3>0</h3>
                            <?php } ?>
                            <p>Perbaikan Genset Disetujui</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-wrench"></i>
                        </div>
                        <a href="<?= site_url(); ?>teknisi/service_genset_acc" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <?php if (!empty($dataStokSparepart)) { ?>
                                <h3><?= $dataStokSparepart ?></h3>
                            <?php } else { ?>
                                <h3>0</h3>
                            <?php } ?>
                            <p>Stok Sparepart</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <a href="<?= site_url(); ?>teknisi/tabel_sparepart" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

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
</body>

</html>
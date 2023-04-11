<?php $this->load->view('template/head'); ?>
<?php $this->load->view('guest/template/nav'); ?>
<?php $this->load->view('guest/template/sidebar'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Laporan
            <small>Report</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('guest') ?>"><!--<i class="fa fa-home"></i>--> Home</a></li>
            <li class="active">Report</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div id="loading">
            <img src="<?= base_url(); ?>assets/style/loading.gif" alt="loading" width="50%">
        </div>
        <div class="box">
            <div class="box-body">
                <!-- <h2 align="center">Laporan Data</h2> -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>Keluar</h3>
                            <p>Laporan Data Genset Keluar</p><br>
                        </div>

                        <a href="<?= base_url('report/dataKeluar') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>Masuk</h3>
                            <p>Laporan Data Genset Masuk</p><br>
                        </div>

                        <a href="<?= base_url('report/dataMasuk') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>Perbaikan Genset</h3>
                            <p>Laporan Data Perbaikan Genset</p><br>
                        </div>

                        <a href="<?= base_url('report/serviceGenset') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>Mobil</h3>
                            <p>Laporan Data Mobil</p><br>
                        </div>

                        <a href="<?= base_url('report/mobil') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-orange">
                        <div class="inner">
                            <h3>Genset</h3>
                            <p>Laporan Data Genset</p><br>
                        </div>

                        <a href="<?= base_url('report/genset') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <!-- <div class="small-box bg-purple">
                        <div class="inner">
                            <h3>Operator</h3>
                            <p>Laporan Data Operator</p><br>
                        </div>
                        
                        <a href="<?= base_url('report/operator') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div> -->
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <!-- <div class="small-box bg-blue">
                        <div class="inner">
                            <h3>Pelanggan</h3>
                            <p>Laporan Data Pelanggan</p><br>
                        </div>
                        
                        <a href="<?= base_url('report/pelanggan') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div> -->
                </div>
                <!-- ./col -->

            </div>

        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('guest/template/script') ?>
</body>

</html>
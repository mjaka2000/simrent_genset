<?php $this->load->view('template/head'); ?>
<?php $this->load->view('penyewa/template/nav'); ?>
<?php $this->load->view('penyewa/template/sidebar');
?>
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
            <h2 align="center">Selamat Datang, <strong><?= $this->session->userdata('nama') ?></strong> sebagai Penyewa!</h2>
            <div class="row">
                <!-- <div class="card-body bg-info">
                    <div class="inner">
                        <h3 align="center">This Page Will Coming Soon!!!</h3>
                    </div>
                    <div class="icon">
                    </div>
                </div> -->
                <!-- <div class="col-lg-3 col-xs-6">
                    <?php foreach ($edit_data as $ed) { ?>
                        <div class="small-box bg-info">
                            <div class="inner">
                                <p>Profil</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-wrench"></i>
                            </div>
                            <a href="<?= site_url('penyewa/tabel_data_pelanggan/' . $ed->id_pelanggan); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    <?php } ?>
                </div> -->
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
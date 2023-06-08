<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>
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
    <div id="loading" class="tengah">
      <img src="<?= site_url(); ?>assets/style/loading.gif" alt="loading" width="50%">
    </div>
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <h2 align="center">Selamat Datang, <strong><?= $this->session->userdata('name') ?></strong> sebagai Administrator!</h2>
      <div class="row">

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <?php if (!empty($dataServGenset)) { ?>
                <h3><?= $dataServGenset ?></h3>
              <?php } else { ?>
                <h3>0</h3>
              <?php } ?>
              <p>Perbaikan Genset</p>
            </div>
            <div class="icon">
              <i class="fas fa-wrench"></i>
            </div>
            <a href="<?= site_url(); ?>admin/tabel_service_genset" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
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
            <a href="<?= site_url(); ?>admin/tabel_sparepart" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <?php if (!empty($dataPelanggan)) { ?>
                <h3><?= $dataPelanggan ?></h3>
              <?php } else { ?>
                <h3>0</h3>
              <?php } ?>
              <p>Pelanggan</p>
            </div>
            <div class="icon">
              <i class="fas fa-user"></i>
            </div>
            <a href="<?= site_url('admin/tabel_pelanggan') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <?php if (!empty($dataOperator)) { ?>
                <h3><?= $dataOperator ?></h3>
              <?php } else { ?>
                <h3>0</h3>
              <?php } ?>
              <p>Operator</p>
            </div>
            <div class="icon">
              <i class="fas fa-user"></i>
            </div>
            <a href="<?= site_url('admin/tabel_operator') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <?php if (!empty($dataPengeluaran)) { ?>
                <h3><?= $dataPengeluaran ?></h3>
              <?php } else { ?>
                <h3>0</h3>
              <?php } ?>
              <p>Pengeluaran</p>
            </div>
            <div class="icon">
              <i class="fas fa-clipboard"></i>
            </div>
            <a href="<?= site_url('admin/#') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <?php if (!empty($stokBarangKeluar)) { ?>
                <h3><?= $stokBarangKeluar ?></h3>
              <?php } else { ?>
                <h3>0</h3>
              <?php } ?>
              <p>Data Unit Keluar (Pinjam)</p>
            </div>
            <div class="icon">
              <i class="fa fa-upload"></i>
            </div>
            <a href="<?= site_url('admin/tabel_unit_keluar') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <?php if (!empty($stokBarangMasuk)) { ?>
                <h3><?= $stokBarangMasuk ?></h3>
              <?php } else { ?>
                <h3>0</h3>
              <?php } ?>
              <p>Data Unit Masuk (Kembali)</p>
            </div>
            <div class="icon">
              <i class="fa fa-download"></i>
            </div>
            <a href="<?= site_url('admin/tabel_unit_masuk') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>Laporan</h3>
              <p>Cetak Laporan</p>
            </div>
            <div class="icon">
              <i class="fas fa-clipboard"></i>
            </div>
            <a href="<?= site_url('admin/laporan') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="card">
          <!-- <div class="card-body">
            <?php if (is_array($count)) { ?>
              <?php foreach ($count as $c) : ?>
                <div class="alert alert-warning alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <a href="<?= site_url(); ?>admin/tabel_sparepart" style="text-decoration: none; color: black;"><strong> <?= $c->nama_sparepart; ?></strong><span> sisa <strong><?= $c->stok; ?></strong></span><br>
                    <small style="color: red;">Segera lakukan pembelian untuk menambah stok</small></a>
                </div>
              <?php endforeach ?>
            <?php } ?>
          </div> -->
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
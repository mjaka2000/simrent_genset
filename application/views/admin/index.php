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
      <img src="<?= base_url(); ?>assets/style/loading.gif" alt="loading" width="50%">
    </div>
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <h2 align="center">Selamat Datang, <strong><?= $this->session->userdata('nama') ?></strong> sebagai Administrator!</h2>
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
        <!-- <div class="col-lg-3 col-xs-6">
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
        </div> -->

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
            <a href="<?= site_url('admin/tabel_pengeluaran') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <li class="nav nav-item dropdown ">
                <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-bell fa-2x" style="color: white"></i>
                  <?php if (empty($numOut)) { ?>
                    <span></span>
                  <?php } else { ?>
                    <span class="badge badge-warning"><?= $numOut; ?></span>
                  <?php } ?>
                </a>
                <div class="dropdown-menu dropdown-menu-lg">
                  <span class="dropdown-item dropdown-header" style="background-color: #2596be;color: white;"><?= $numOut; ?> Pemberitahuan sewa genset</span>
                  <div class="dropdown-divider"></div>
                  <?php foreach ($notifOut as $c) : ?>
                    <div class="card-footer">
                      <a href="#" style="text-decoration: none; color: black;"><strong><?= $c->id_transaksi; ?><br><?= $c->nama_plg; ?><br><?= $c->nama_genset; ?></strong><br>
                        <small style="color: red;">Pengambilan Genset Tanggal <strong><?= date('d/m/Y', strtotime($c->tanggal_masuk)); ?></strong></small></a>
                      <!-- <a href="<?= site_url('admin/email_unit_keluar/' . $c->id_u_sewa); ?>" type="button" class="btn btn-xs btn-success" name="btn_edit"><i class="fa fa-paper-plane"> Send</i></a> -->

                    </div>
                  <?php endforeach ?>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer"></a>
                </div>
              </li>
              <!-- <?php if (!empty($UnitKeluar)) { ?>
                <h3><?= $UnitKeluar ?></h3>
              <?php } else { ?>
                <h3>0</h3>
              <?php } ?> -->
              <p>Data Unit Keluar</p>

            </div>
            <div class="icon">
              <i class="fa fa-copy"></i>
            </div>
            <a href="<?= site_url('admin/tabel_unit_keluar') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <li class="nav nav-item dropdown ">
                <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-bell fa-2x" style="color: white"></i>
                  <?php if (empty($numJdw)) { ?>
                    <span></span>
                  <?php } else { ?>
                    <span class="badge badge-warning"><?= $numJdw; ?></span>
                  <?php } ?>
                </a>
                <div class="dropdown-menu dropdown-menu-lg">
                  <span class="dropdown-item dropdown-header" style="background-color: #2596be;color: white;"><?= $numJdw; ?> Pemberitahuan jadwal genset</span>
                  <div class="dropdown-divider"></div>
                  <?php foreach ($notifJdw as $c) : ?>
                    <div class="card-footer">
                      <a href="#" style="text-decoration: none; color: black;"><strong><?= $c->nama_op; ?><br><?= $c->nama_genset; ?><br><?= $c->merek; ?></strong><br>
                        <small style="color: red;">Jadwal Berangkat Tanggal <strong><?= date('d/m/Y', strtotime($c->tgl_keluar)); ?></strong></small></a>
                      <!-- <a href="<?= site_url('admin/email_jdw_genset/' . $c->id_jadwal_genset); ?>" type="button" class="btn btn-xs btn-success" name="btn_edit"><i class="fa fa-paper-plane"> Send</i></a> -->

                    </div>
                  <?php endforeach ?>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer"></a>
                </div>
              </li>
              <!-- <?php if (!empty($jdwGst)) { ?>
                <h3><?= $jdwGst ?></h3>
              <?php } else { ?>
                <h3>0</h3>
              <?php } ?> -->
              <p>Jadwal Penyewaan Genset</p>

            </div>
            <div class="icon">
              <i class="fa fa-copy"></i>
            </div>
            <a href="<?= site_url('admin/tabel_jdw_genset') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

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
              <p>Data Penyewaan</p>
            </div>
            <div class="icon">
              <i class="fa fa-copy"></i>
            </div>
            <a href="<?= site_url('admin/tabel_unit_masuk') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <?php foreach ($pendapatan as $pd) { ?>
            <div class="small-box bg-info">
              <div class="inner">
                <?php if (!empty($pd->total)) { ?>
                  <h3>Rp&nbsp;<?= number_format($pd->total) ?></h3>
                <?php } else { ?>
                  <h3>Rp&nbsp;0</h3>
                <?php } ?>
                <p>Total Pendapatan <?= $label ?></p>
              </div>
              <div class="icon">
                <i class="fa fa-download"></i>
              </div>
              <a href="<?= site_url('admin/tabel_pemasukan') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          <?php } ?>
        </div>

        <!-- ./col -->
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

</body>

</html>
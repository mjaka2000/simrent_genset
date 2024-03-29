<?php $this->load->view('template/head'); ?>
<?php $this->load->view('pimpinan/template/nav'); ?>
<?php $this->load->view('pimpinan/template/sidebar'); ?>
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
      <h2 align="center">Selamat Datang, <strong><?= $this->session->userdata('nama') ?></strong> sebagai Pimpinan!</h2>
      <div class="row">
        <!-- <div class="card-body bg-info">
          <div class="inner">
            <h3 align="center">This Page Will Coming Soon!!!</h3>
          </div>

        </div> -->

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
            <a href="<?= site_url('pimpinan/#') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="<?= site_url('pimpinan/#') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
              <a href="<?= site_url('pimpinan/#') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          <?php } ?>
        </div>
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
            <a href="<?= site_url('pimpinan/laporan') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- <?php foreach ($notifOut as $c) : ?>
          <div class="col-lg-3 col-xs-6">
            <div class="small-box ">
              <div class="alert alert-warning alert-dismissible">
                <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                <p align="center"><strong>Pemberitahuan!</strong></p>
                <a href="<?= site_url('pimpinan/detail_unit_keluar/' . $c->id_u_keluar); ?>" style="text-decoration: none; color: black;"><strong><?= $c->id_transaksi; ?><br><?= $c->nama_plg; ?><br><?= $c->nama_genset; ?></strong></span><br>
                  <small style="color: red;">Pengambilan Genset Tanggal <strong><?= date('d/m/Y', strtotime($c->tanggal_masuk)); ?></strong></small></a>
              </div>
            </div>
          </div>
        <?php endforeach ?> -->
        <!-- <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Grafik Pendapatan <?= $label ?></h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="PendapatanChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div> -->
      </div>
      <div class="card">
        <!-- <div class="card-body">
            <?php if (is_array($count)) { ?>
              <?php foreach ($count as $c) : ?>
                <div class="alert alert-warning alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <a href="<?= site_url(); ?>pimpinan/tabel_sparepart" style="text-decoration: none; color: black;"><strong> <?= $c->nama_sparepart; ?></strong><span> sisa <strong><?= $c->stok; ?></strong></span><br>
                    <small style="color: red;">Segera lakukan pembelian untuk menambah stok</small></a>
                </div>
              <?php endforeach ?>
            <?php } ?>
          </div> -->
      </div>

      <!-- /.col-md-6 -->
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
<script>
  $(function() {
    //-------------
    //- LINE CHART -
    //--------------

    var ctx = document.getElementById('PendapatanChart').getContext('2d');
    var chart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [
          <?php
          if (count($pendapatanChart) > 0) {
            foreach ($pendapatanChart as $pd) {
              echo "'" . date('d-m-Y', strtotime($pd->tanggal_masuk)) . "',";
            }
          }
          ?>
        ],
        datasets: [{
          label: 'Jumlah Pendapatan',
          backgroundColor: '#ADD8E6',
          borderColor: '##93C3D2',
          data: [
            <?php
            if (count($pendapatanChart) > 0) {
              foreach ($pendapatanChart as $data) {
                echo $data->total . ", ";
              }
            }
            ?>
          ]
        }]
      },
    });
  })
</script>

</body>

</html>
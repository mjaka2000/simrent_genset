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
          <li class="nav nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell"></i>
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
                  <!-- <a href="#" class="dropdown-item">
                  </a> -->
                </div>
              <?php endforeach ?>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer"></a>
            </div>
          </li>
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
            <a href="<?= site_url('admin/tabel_pengeluaran') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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

        <!-- <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Line Chart</h3>

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
              <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div> -->
      </div>
      <!-- <?php foreach ($notifOut as $c) : ?>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box">
            <div class="alert alert-warning alert-dismissible">
              <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
              <p align="center"><strong>Pemberitahuan!</strong></p>
              <a href="<?= site_url('admin/detail_unit_keluar/' . $c->id_u_keluar); ?>" style="text-decoration: none; color: black;"><strong><?= $c->id_transaksi; ?><br><?= $c->nama_plg; ?><br><?= $c->nama_genset; ?></strong></span><br>
                <small style="color: red;">Pengambilan Genset Tanggal <strong><?= date('d/m/Y', strtotime($c->tanggal_masuk)); ?></strong></small></a>
            </div>
          </div>
        </div>
      <?php endforeach ?> -->
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
<script>
  $(function() {
    //-------------
    //- LINE CHART -
    //--------------
    // var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    // var lineChartOptions = $.extend(true, {}, areaChartOptions)
    // var lineChartData = $.extend(true, {}, areaChartData)
    // lineChartData.datasets[0].fill = false;
    // lineChartData.datasets[1].fill = false;
    // lineChartOptions.datasetFill = false

    // var lineChart = new Chart(lineChartCanvas, {
    //   type: 'line',
    //   data: lineChartData,
    //   options: lineChartOptions
    // })

    //-------------
    //- LINE CHART -
    //--------------
    // var lineChartCanvas = $('#lineChart').getContext('2d')
    // var lineChartOptions = $.extend(true, {}, areaChartOptions)
    // var lineChartData = $.extend(true, {}, areaChartData)
    // lineChartData.datasets[0].fill = true;
    // lineChartData.datasets[1].fill = true;
    // lineChartOptions.datasetFill = true

    // var lineChart = new Chart(lineChartCanvas, {
    //   type: 'line',
    //   data: {
    //     // labels: ["Pendapatan", "Bulan"],
    //     datasets: [{
    //       label: '',

    //       xAxis: {
    //         categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des']
    //       },
    //       yAxis: {
    //         title: {
    //           text: '(Rp)'
    //         },
    //         data: [{
    //           <?php foreach ($pendapatanChart as $pd) { ?>
    //             <?= $pd->total; ?>
    //           <?php } ?>
    //       }]

    //       },

    //     }]
    //   },
    //   options: lineChartOptions
    // })

    //   var ctx = document.getElementById("lineChart").getContext('2d');
    //   var myChart = new Chart(ctx, {
    //     type: 'line',
    //     data: {
    //       labels: ["Pendapatan", "Bulan"],
    //       datasets: [{
    //         label: '',

    //         xAxis: {
    //           categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des']
    //         },
    //         yAxis: {
    //           title: {
    //             text: '(Rp)'
    //           },
    //           data: [
    //             <?php foreach ($pendapatanChart as $pd) { ?>
    //               <?= $pd->total; ?>
    //             <?php } ?>
    //           ],

    //         },
    //         borderColor: [
    //           'rgba(255,99,132,1)',
    //           'rgba(54, 162, 235, 1)'
    //         ],
    //         borderWidth: 1
    //       }]
    //     },
    //     options: {
    //       scales: {
    //         yAxes: [{
    //           ticks: {
    //             beginAtZero: true
    //           }
    //         }]
    //       }
    //     }
    //   });
  })
</script>
</body>

</html>
<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pelanggan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Pelanggan</li>
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Data Pelanggan
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>
                            <!-- <button data-toggle="modal" data-target="#staticAddPlg" class="btn btn-primary btn-sm" style="margin-bottom:10px;"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Data</button> -->
                            <button onclick="window.location.href='<?= site_url('admin/tabel_pelanggan_blacklist'); ?>'" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-default" name="blacklist_data">Data Pelanggan Blacklist</button>

                            <table id="examplejk" class="table table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width :10px">No.</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>No. HP</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Tanggal Update</th>
                                        <th>Status</th>
                                        <th>Ket.</th>
                                        <th style="width:10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    // $list_data = isset($_POST['list_data']) ? $_POST['list_data'] : '';
                                    if (is_array($list_pelanggan)) { ?>
                                        <?php foreach ($list_pelanggan as $dt) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $dt->nama_plg; ?></td>
                                                <td><?= $dt->alamat_plg; ?></td>
                                                <td><?= $dt->nohp_plg; ?></td>
                                                <?php if ($dt->jk_plg == 'L') { ?>
                                                    <td>Laki - Laki</td>
                                                <?php } else { ?>
                                                    <td>Perempuan</td>
                                                <?php } ?>
                                                <td><?= $dt->namaperusahaan_plg; ?></td>
                                                <td><?= date('d-m-Y', strtotime($dt->tglupdate_plg)); ?></td>
                                                <?php if ($dt->status_plg == 0) { ?>
                                                    <td>
                                                        <button type="button" class="btn btn-success btn-xs dropdown-toggle" title="Ubah Status" data-toggle="dropdown">
                                                            Tidak Menyewa
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item disabled" href="#">Tidak Menyewa</a>
                                                            <a class="dropdown-item" href="<?= site_url('admin/ubah_Status_pelangganMenyewa/' . $dt->id_pelanggan); ?>">Sedang Menyewa</a>
                                                        </div>
                                                        <!-- <a href="#" class="btn btn-success btn-xs">Genset Ada </a> -->
                                                    </td>
                                                    <!-- <a href="#" class="btn btn-success btn-xs">Tidak Menyewa</a></td> -->
                                                <?php } else { ?>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-xs dropdown-toggle" title="Ubah Status" data-toggle="dropdown">
                                                            Sedang Menyewa
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item " href="<?= site_url('admin/ubah_Status_pelangganTdkMenyewa/' . $dt->id_pelanggan); ?>">Tidak Menyewa</a>
                                                            <a class="dropdown-item disabled" href="#">Sedang Menyewa</a>
                                                        </div>
                                                    </td>
                                                    <!-- <a href="#" class="btn btn-danger btn-xs">Sedang Menyewa</a></td> -->
                                                <?php } ?>

                                                <?php if ($dt->ket_plg == 0) { ?>
                                                    <td><a href="<?= site_url('admin/pindah_data_pelanggan/' . $dt->id_pelanggan); ?>" type="button" class="btn btn-xs btn-danger btn-plg" name="btn_ket_plg">Blacklist?</a></td>
                                                <?php } else { ?>
                                                    <td><em>Blacklist</em></td>
                                                <?php } ?>
                                                <td>
                                                    <a href="<?= site_url('admin/update_data_pelanggan/' . $dt->id_pelanggan); ?>" type="button" class="btn btn-sm btn-info" name="btn_edit"><i class="fa fa-edit "></i></a>
                                                    <a href="<?= site_url('admin/hapus_pelanggan/' . $dt->id_pelanggan); ?>" type="button" title="Hapus" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash "></i></a>
                                                    <!-- <a href="<?= site_url('admin/'); ?>" type="button" class="btn btn-xs btn-warning" name="btn_detail"><i class="fa fa-info-circle "></i></a> -->
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
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
<script>
    //* Script untuk memuat sweetalert status pelanggan
    $('.btn-plg').on('click', function() {
        var getLink = $(this).attr('href');
        Swal.fire({
            title: 'Ubah Status',
            text: 'Yakin ingin ubah Status Pelanggan menjadi Blacklist?',
            type: 'warning',
            confirmButtonColor: '#d9534f',
            showCancelButton: true,
        }).then(result => {
            //jika klik ya maka arahkan ke proses.php
            if (result.isConfirmed) {
                window.location.href = getLink
            }
        })
        return false;
    });
</script>
<script type="text/javascript">
    $('.btn-delete').on('click', function() {
        var getLink = $(this).attr('href');
        Swal.fire({
            title: 'Hapus Data',
            text: 'Yakin ingin menghapus data?',
            type: 'warning',
            confirmButtonColor: '#d9534f',
            showCancelButton: true,
        }).then(result => {
            //jika klik ya maka arahkan ke proses.php
            if (result.isConfirmed) {
                window.location.href = getLink
            }
        })
        return false;
    }); //* Script untuk memuat sweetalert hapus data
</script>
</body>

</html>
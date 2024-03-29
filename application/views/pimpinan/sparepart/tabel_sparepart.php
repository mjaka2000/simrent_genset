<?php $this->load->view('template/head'); ?>
<?php $this->load->view('pimpinan/template/nav'); ?>
<?php $this->load->view('pimpinan/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Stok Sparepart</h1>
                    <!-- <ul class="nav">
                        <li class=" dropdown">
                            <a href="#" data-toggle="dropdown">
                                <i class="far fa-bell"></i>
                                <?php if (empty($num)) { ?>
                                    <span></span>
                                <?php } else { ?>
                                    <span class="badge badge-warning"><?= $num; ?></span>
                                <?php } ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg">
                                <span class="dropdown-header" style="background-color: #2596be; color: white;">You have <?= $num; ?> notifications</span>
                                <div class="dropdown-divider"></div>
                                <?php if (is_array($count)) { ?>
                                    <?php foreach ($count as $c) : ?>
                                        <a href="#" class="dropdown-item">
                                            <strong> <?= $c->nama_sparepart; ?></strong><span> sisa <strong><?= $c->stok; ?></strong></span><br>
                                            <small style="color: red;">Segera lakukan pembelian untuk menambah stok</small>
                                        </a>
                                    <?php endforeach ?>
                                <?php } ?>


                                <div class="dropdown-divider"></div>
                                <a href="#" style="background-color: #2596be;" class="dropdown-item dropdown-footer"></a>
                            </ul>
                        </li>
                    </ul> -->
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('pimpinan'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Stok Sparepart</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

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
                            Data Stok Sparepart
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>

                            <!-- <button onclick="window.location.href='<?= site_url('pimpinan/tambah_data_sparepart'); ?>'" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-primary" name="tambah_data"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Data</button> -->

                            <table id="examplejk" class="table table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width :10px">No.</th>
                                        <th>Nama Sparepart</th>
                                        <th>Tanggal Beli</th>
                                        <th>Tempat Beli</th>
                                        <th>Stok</th>
                                        <th>Harga Sparepart</th>
                                        <!-- <th style="width:10%">Aksi</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    // $list_data = isset($_POST['list_data']) ? $_POST['list_data'] : '';
                                    if (is_array($list_sparepart)) { ?>
                                        <?php foreach ($list_sparepart as $dt) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $dt->nama_sparepart; ?></td>
                                                <td><?= date('d-m-Y', strtotime($dt->tanggal_beli)); ?></td>
                                                <td><?= $dt->tempat_beli; ?></td>
                                                <td><?= $dt->stok; ?></td>
                                                <td>Rp&nbsp;<?= number_format($dt->harga_sparepart); ?></td>
                                                <!-- <td>
                                                    <a href="<?= site_url('pimpinan/update_sparepart/' . $dt->id_sparepart); ?>" type="button" class="btn btn-sm btn-info" name="btn_edit"><i class="fa fa-edit"></i></a>
                                                    <a href="<?= site_url('pimpinan/hapus_sparepart/' . $dt->id_sparepart); ?>" type="button" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash"></i></a>
                                                </td> -->
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } else { ?>
                                        <td colspan="9" align="center"><strong>Data Kosong</strong></td>
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
<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

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
                        <li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
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
                            <button data-toggle="modal" data-target="#staticAddSparepart" class="btn btn-primary btn-sm" style="margin-bottom:10px;"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Data</button>

                            <table id="examplejk" class="table table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width :10px">No.</th>
                                        <th>Nama Sparepart</th>
                                        <th>Tanggal Beli</th>
                                        <th>Tempat Beli</th>
                                        <th>Stok</th>
                                        <th>Harga Sparepart</th>
                                        <th style="width:10%">Aksi</th>
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
                                                <td>
                                                    <button type="button" data-toggle="modal" data-target="#staticEditSparepart<?= $dt->id_sparepart; ?>" title="Edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                                                    <a href="<?= site_url('admin/hapus_sparepart/' . $dt->id_sparepart); ?>" title="Hapus" type="button" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } else { ?>
                                        <td colspan="9" align="center"><strong>Data Kosong</strong></td>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade" id="staticAddSparepart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">Tambah Data Stok Sparepart</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>


                                </div>
                                <div class="modal-body">
                                    <?php if (validation_errors()) { ?>
                                        <div class="alert alert-warning alert-dismissable">
                                            <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                            <strong>Peringatan!</strong><br> <?php echo validation_errors(); ?>
                                        </div>
                                    <?php } ?>

                                    <form action="<?= site_url('admin/proses_tambah_sparepart'); ?>" method="post" role="form">

                                        <div class="form-group">
                                            <label for="nama_sparepart" class="form-label">Nama Sparepart</label>

                                            <input type="text" name="nama_sparepart" class="form-control" id="nama_sparepart" placeholder="Masukkan Nama Sparepart" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_beli" class="form-label">Tanggal Beli</label>

                                            <input type="date" name="tanggal_beli" class="form-control" id="tanggal_beli" placeholder="Masukkan Tanggal Beli">
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat_beli" class="form-label">Tempat Beli</label>

                                            <input type="text" name="tempat_beli" class="form-control" id="tempat_beli" placeholder="Masukkan Tempat Beli" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="stok" class="form-label">Stok</label>

                                            <input type="number" name="stok" class="form-control" id="stok" placeholder="Masukkan Stok yang Dibeli" required onkeypress='return (event.charCode > 47 && event.charCode < 58)'>
                                        </div>
                                        <div class="form-group">
                                            <label for="stok" class="form-label">Harga Sparepart</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon">Rp</span>
                                                </div>
                                                <input type="number" name="harga_sparepart" class="form-control" id="harga_sparepart" placeholder="Masukkan Harga yang Dibeli" required onkeypress='return (event.charCode > 47 && event.charCode < 58)'>
                                            </div>
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-arrow-left mr-2"></i>Kembali</button>
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check mr-2"></i>Submit</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php foreach ($list_sparepart as $dt) { ?>

                        <div class="modal fade" id="staticEditSparepart<?= $dt->id_sparepart; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="staticBackdropLabel">Ubah Data Stok Sparepart</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span>&times;</span>
                                        </button>


                                    </div>
                                    <div class="modal-body">
                                        <?php if (validation_errors()) { ?>
                                            <div class="alert alert-warning alert-dismissable">
                                                <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                                <strong>Peringatan!</strong><br> <?php echo validation_errors(); ?>
                                            </div>
                                        <?php } ?>
                                        <form action="<?= site_url('admin/proses_update_sparepart'); ?>" method="post" role="form">

                                            <div class="form-group">
                                                <input type="hidden" name="id" value="<?= $dt->id_sparepart; ?>">
                                                <label for="nama_sparepart" class="form-label">Nama Sparepart</label>

                                                <input type="text" name="nama_sparepart" class="form-control" id="nama_sparepart" placeholder="Masukkan Nama Sparepart" required value="<?= $dt->nama_sparepart; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_beli" class="form-label">Tanggal Beli</label>

                                                <input type="date" name="tanggal_beli" class="form-control form_datetime" id="tanggal_beli" placeholder="Masukkan Tanggal Beli" required value="<?= $dt->tanggal_beli; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="tempat_beli" class="form-label">Tempat Beli</label>

                                                <input type="text" name="tempat_beli" class="form-control" id="tempat_beli" placeholder="Masukkan Tempat Beli" required value="<?= $dt->tempat_beli; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="stok" class="form-label">Stok</label>

                                                <input type="number" name="stok" class="form-control" id="stok" placeholder="Masukkan Stok yang Dibeli" required onkeypress='return (event.charCode > 47 && event.charCode < 58)' value="<?= $dt->stok; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="stok" class="form-label">Harga Sparepart</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon">Rp</span>
                                                    </div>
                                                    <input type="number" name="harga_sparepart" class="form-control" id="harga_sparepart" placeholder="Masukkan Harga yang Dibeli" required onkeypress='return (event.charCode > 47 && event.charCode < 58)' value="<?= $dt->harga_sparepart; ?>">
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-arrow-left mr-2"></i>Kembali</button>
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check mr-2"></i>Submit</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
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
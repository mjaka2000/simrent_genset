<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Genset</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Genset</li>
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
                            Data Genset
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>
                            <!-- <button onclick="window.location.href='<?= site_url('admin/tambah_genset'); ?>'" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-primary" name="tambah_data"><i class="fa fa-plus"></i>&nbsp;Tambah Data</button> -->
                            <button data-toggle="modal" data-target="#staticAddGenset" class="btn btn-primary btn-sm" style="margin-bottom:10px;"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Data</button>

                            <table id="examplejk" class="table table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width :10px">No.</th>
                                        <th>Nomor Genset</th>
                                        <th>Nama Genset</th>
                                        <th>Daya (KVA)</th>
                                        <th>Harga Perhari</th>
                                        <th>Ket. Genset</th>
                                        <!-- <th>Unit Disewakan</th> -->
                                        <th>Gambar</th>
                                        <th style="width:10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (is_array($list_data)) { ?>
                                        <?php foreach ($list_data as $d) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $d->kode_genset; ?></td>
                                                <td><?= $d->nama_genset; ?></td>
                                                <td><?= $d->daya; ?></td>
                                                <td>Rp&nbsp;<?= number_format($d->harga); ?></td>
                                                <?php if ($d->ket_genset == 0) { ?>
                                                    <td><a href="#" class="btn btn-success btn-xs">Genset Ada </a></td>
                                                <?php } elseif ($d->ket_genset == 1) { ?>
                                                    <td><a href="#" class="btn btn-danger btn-xs"> Genset Sedang Disewa</a></td>
                                                <?php } else { ?>
                                                    <td><a href="#" class="btn btn-warning btn-xs"> Genset Dijadwalkan</a></td>
                                                <?php } ?>
                                                <td><img src="<?= base_url('assets/upload/genset/' . $d->gambar_genset); ?>" class="img img-box" width="100" height="100" alt="<?= $d->gambar_genset; ?>"></td>
                                                <td>
                                                    <button type="button" data-toggle="modal" data-target="#staticEditGenset<?= $d->id_genset; ?>" title="Edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>

                                                    <!-- <a href="<?= site_url('admin/update_genset/' . $d->id_genset); ?>" type="button" title="Edit" class="btn btn-sm btn-info" name="btn_edit"><i class="fa fa-edit"></i></a> -->
                                                    <a href="<?= site_url('admin/hapus_data_genset/' . $d->id_genset); ?>" title="Hapus" type="button" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade" id="staticAddGenset" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">Tambah Data Genset</h6>
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

                                    <form action="<?= site_url('admin/proses_tambahgenset'); ?>" method="post" role="form" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label for="kode_genset" class="form-label">Nomor Genset</label>

                                            <input type="text" name="kode_genset" class="form-control" id="kode_genset" placeholder="Masukkan Nomor Genset" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_genset" class="form-label">Nama Genset</label>

                                            <input type="text" name="nama_genset" class="form-control" id="nama_genset" placeholder="Masukkan Nama Genset" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="daya" class="form-label">Daya (KVA)</label>

                                            <input type="text" name="daya" class="form-control" id="daya" placeholder="Daya" required onkeypress='return (event.charCode > 47 && event.charCode < 58)'>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga" class="form-label">Harga</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon">Rp</span>
                                                </div>
                                                <input type="text" name="harga" class="form-control" id="harga" placeholder="Harga Unit Perhari" required onkeypress='return (event.charCode > 47 && event.charCode < 58)'>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="gambar_genset" class="form-label">Gambar Genset</label>

                                            <input type="file" name="gambar_genset" class="form-control" id="gambar_genset">
                                            <small style="color: red;">
                                                <p>*File yang diijinkan "jpg|png|jpeg", max size 2MB.</p>
                                            </small>
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
                    <?php foreach ($list_data as $d) { ?>

                        <div class="modal fade" id="staticEditGenset<?= $d->id_genset; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="staticBackdropLabel">Ubah Data Genset</h6>
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
                                        <form action="<?= site_url('admin/proses_updategenset'); ?>" method="post" role="form" enctype="multipart/form-data">

                                            <div class="form-group">
                                                <input type="hidden" name="id_genset" value="<?= $d->id_genset; ?>">
                                                <label for="kode_genset" class="form-label">Nomor Genset</label>

                                                <input type="text" name="kode_genset" class="form-control" id="kode_genset" placeholder="Kode Genset" required value="<?= $d->kode_genset; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_genset" class="form-label">Nama Genset</label>

                                                <input type="text" name="nama_genset" class="form-control" id="nama_genset" placeholder="Nama Genset" required value="<?= $d->nama_genset; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="daya" class="form-label">Daya (KVA)</label>

                                                <input type="text" name="daya" class="form-control" id="daya" placeholder="Daya" required onkeypress='return (event.charCode > 47 && event.charCode < 58)' value="<?= $d->daya; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="harga" class="form-label">Harga</label>

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon">Rp</span>
                                                    </div>
                                                    <input type="text" name="harga" class="form-control" id="harga" placeholder="Harga" required onkeypress='return (event.charCode > 47 && event.charCode < 58)' value="<?= $d->harga; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="stok_gd" class="form-label">Ket. Genset</label>

                                                <select name="ket_genset" id="ket_genset" class="form-control" required>
                                                    <option value="">-- Status --</option>

                                                    <?php if ($d->ket_genset == "0") { ?>
                                                        <option value="0" selected>Genset Ada</option>
                                                        <option value="1">Genset Sedang Disewa</option>
                                                        <option value="2">Genset Dijadwalkan</option>
                                                    <?php } elseif ($d->ket_genset == 1) { ?>
                                                        <option value="0">Genset Ada</option>
                                                        <option value="1" selected>Genset Sedang Disewa</option>
                                                        <option value="2">Genset Dijadwalkan</option>
                                                    <?php } else { ?>
                                                        <option value="0">Genset Ada</option>
                                                        <option value="1">Genset Sedang Disewa</option>
                                                        <option value="2" selected>Genset Dijadwalkan</option>
                                                    <?php } ?>

                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="gambar_genset" class="form-label">Gambar Genset</label>

                                                <input type="file" name="gambar_genset" class="form-control" id="gambar_genset">
                                                <input type="hidden" name="gambar_genset_old" value="<?= $d->gambar_genset; ?>">
                                                <small style="color: red;">
                                                    <p>*File yang diijinkan "jpg|png|jpeg", max size 2MB.</p>
                                                </small>
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
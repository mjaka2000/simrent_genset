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
                            <!-- <button onclick="window.location.href='<?= site_url('admin/tambah_data_pelanggan'); ?>'" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-primary" name="tambah_data"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Data</button>&nbsp; -->
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
                                                    <td><a href="#" class="btn btn-success btn-xs">Tidak Menyewa</a></td>
                                                <?php } else { ?>
                                                    <td><a href="#" class="btn btn-danger btn-xs">Sedang Menyewa</a></td>
                                                <?php } ?>
                                                <?php if ($dt->ket_plg == 0) { ?>
                                                    <td><a href="<?= site_url('admin/pindah_data_pelanggan/' . $dt->id_pelanggan); ?>" type="button" class="btn btn-xs btn-danger btn-plg" name="btn_ket_plg">Blacklist?</a></td>
                                                <?php } else { ?>
                                                    <td><em>Blacklist</em></td>
                                                <?php } ?>
                                                <td>
                                                    <button type="button" data-toggle="modal" data-target="#staticEditPlg<?= $dt->id_pelanggan; ?>" title="Edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                                                    <!-- <a href="<?= site_url('admin/update_data_pelanggan/' . $dt->id_pelanggan); ?>" type="button" title="Edit" class="btn btn-sm btn-info" name="btn_edit"><i class="fa fa-edit "></i></a> -->
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
                    <!-- <div class="modal fade" id="staticAddPlg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">Tambah Data Pelanggan</h6>
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

                                    <form action="<?= site_url('admin/proses_tambah_operator'); ?>" method="post" role="form">

                                        <form action="<?= site_url('admin/proses_tambah_pelanggan'); ?>" method="post" role="form">

                                            <div class="form-group">
                                                <label for="nama" class="form-label">Nama</label>

                                                <input type="text" name="nama_plg" class="form-control" id="nama_plg" placeholder="Masukkan Nama" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat" class="form-label">Alamat</label>

                                                <input type="text" name="alamat_plg" class="form-control" id="alamat_plg" placeholder="Masukkan Alamat" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="no_hp" class="form-label">No. HP</label>

                                                <input type="text" maxlength="13" name="nohp_plg" class="form-control" id="nohp_plg" placeholder="Masukkan No. HP" required onkeypress='return (event.charCode > 47 && event.charCode < 58)'>
                                            </div>
                                            <div class="form-group">
                                                <label for="jk_plg" class="form-label">Jenis Kelamin</label>

                                                <select name="jk_plg" id="jk_plg" class="form-control" required>
                                                    <option value="">-- Pilih --</option>
                                                    <option value="L">Laki-Laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>

                                                <input type="text" name="namaperusahaan_plg" class="form-control" id="namaperusahaan_plg" placeholder="Nama Perusahaan" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="tgl_update" class="form-label">Tanggal Update</label>

                                                <input type="date" name="tglupdate_plg" class="form-control" id="tglupdate_plg" placeholder="Tanggal Update" required>
                                            </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-arrow-left mr-2"></i>Kembali</button>
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check mr-2"></i>Submit</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div> -->
                    <?php foreach ($list_pelanggan as $d) { ?>

                        <div class="modal fade" id="staticEditPlg<?= $d->id_pelanggan; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="staticBackdropLabel">Ubah Data Pelanggan</h6>
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
                                        <form action="<?= site_url('admin/proses_update_pelanggan'); ?>" method="post" role="form">
                                            <div class="form-group">
                                                <input type="hidden" name="id_pelanggan" value="<?= $d->id_pelanggan; ?>">
                                                <label for="nama" class="form-label">Nama</label>

                                                <input type="text" name="nama_plg" class="form-control" id="nama_plg" placeholder="Masukkan Nama" required value="<?= $d->nama_plg; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat" class="form-label">Alamat</label>

                                                <input type="text" name="alamat_plg" class="form-control" id="alamat_plg" placeholder="Masukkan Alamat" required value="<?= $d->alamat_plg; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="no_hp" class="form-label">No. HP</label>

                                                <input type="text" maxlength="13" name="nohp_plg" class="form-control" id="nohp_plg" placeholder="Masukkan No. HP" required onkeypress='return (event.charCode > 47 && event.charCode < 58)' value="<?= $d->nohp_plg; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>

                                                <select name="jk_plg" id="jk_plg" class="form-control">
                                                    <option value="">-- Pilih --</option>
                                                    <?php if ($d->jk_plg == 'L') { ?>
                                                        <option value="L" selected>Laki-Laki</option>
                                                        <option value="P">Perempuan</option>
                                                    <?php } else { ?>
                                                        <option value="L">Laki-Laki</option>
                                                        <option value="P" selected>Perempuan</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>

                                                <input type="text" name="namaperusahaan_plg" class="form-control" id="nama_perusahaan" placeholder="Nama Perusahaan" required value="<?= $d->namaperusahaan_plg; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="tgl_update" class="form-label">Tanggal Update</label>

                                                <input type="date" name="tglupdate_plg" class="form-control" id="tanggal_update" placeholder="Tanggal Update" required value="<?= $d->tglupdate_plg; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="stok_gd" class="form-label">Status</label>
                                                <select name="status_plg" id="status_plg" class="form-control" required>
                                                    <option value="">-- Status --</option>
                                                    <?php if ($d->status_plg == "0") { ?>
                                                        <option value="0" selected>Tidak Menyewa</option>
                                                        <option value="1">Sedang Menyewa</option>
                                                    <?php } else { ?>
                                                        <option value="0">Tidak Menyewa</option>
                                                        <option value="1" selected>Sedang Menyewa</option>
                                                    <?php } ?>
                                                </select>
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
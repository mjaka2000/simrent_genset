<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Operator</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Operator</li>
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
                            Data Operator
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>
                            <button data-toggle="modal" data-target="#staticAddOp" class="btn btn-primary btn-sm" style="margin-bottom:10px;"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Data</button>

                            <table id="examplejk" class="table table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width :10px">No.</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>No. HP</th>
                                        <th>No. KTP</th>
                                        <th>Status</th>
                                        <th style="width:10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    // $list_data = isset($_POST['list_data']) ? $_POST['list_data'] : '';
                                    if (is_array($list_operator)) { ?>
                                        <?php foreach ($list_operator as $dt) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $dt->nama_op; ?></td>
                                                <td><?= $dt->alamat_op; ?></td>
                                                <td><?= $dt->nohp_op; ?></td>
                                                <td><?= $dt->noktp_op; ?></td>
                                                <?php if ($dt->status_op == 0) { ?>
                                                    <td><em>Standby</em></td>
                                                <?php } else { ?>
                                                    <td><a href="<?= site_url('admin/update_status_op_standby/' . $dt->id_operator); ?>" type="button" class="btn btn-xs btn-success status-op" name="btn_status_op">Berangkat</a></td>
                                                <?php } ?>
                                                <td>
                                                    <button type="button" data-toggle="modal" data-target="#staticEditOp<?= $dt->id_operator; ?>" title="Edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                                                    <a href="<?= site_url('admin/hapus_operator/' . $dt->id_operator); ?>" type="button" title="Hapus" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash "></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade" id="staticAddOp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">Tambah Data Operator</h6>
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

                                        <div class="form-group">
                                            <label for="nama" class="form-label">Nama</label>

                                            <input type="text" name="nama_op" class="form-control" id="nama_op" placeholder="Masukkan Nama" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat" class="form-label">Alamat</label>

                                            <input type="text" name="alamat_op" class="form-control" id="alamat_op" placeholder="Masukkan Alamat" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_hp" class="form-label">No. HP</label>

                                            <input type="text" maxlength="13" name="nohp_op" class="form-control" id="nohp_op" placeholder="Masukkan No. HP" required onkeypress='return (event.charCode > 47 && event.charCode < 58)'>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_hp" class="form-label">No. KTP</label>

                                            <input type="text" maxlength="16" name="noktp_op" class="form-control" id="noktp_op" placeholder="Masukkan No. KTP" required onkeypress='return (event.charCode > 47 && event.charCode < 58)'>
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
                    <?php foreach ($list_operator as $op) { ?>

                        <div class="modal fade" id="staticEditOp<?= $op->id_operator; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="staticBackdropLabel">Ubah Data Operator</h6>
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
                                        <form action="<?= site_url('admin/proses_update_operator'); ?>" method="post" role="form">
                                            <div class="form-group">
                                                <input type="hidden" name="id_operator" value="<?= $op->id_operator; ?>">
                                                <label for="nama" class="form-label">Nama</label>

                                                <input type="text" name="nama_op" class="form-control" id="nama_op" placeholder="Masukkan Nama" required value="<?= $op->nama_op; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat" class="form-label">Alamat</label>

                                                <input type="text" name="alamat_op" class="form-control" id="alamat_op" placeholder="Masukkan Alamat" required value="<?= $op->alamat_op; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="no_hp" class="form-label">No. HP</label>

                                                <input type="text" maxlength="13" name="nohp_op" class="form-control" id="nohp_op" placeholder="Masukkan No. HP" required onkeypress='return (event.charCode > 47 && event.charCode < 58)' value="<?= $op->nohp_op; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="no_hp" class="form-label">No. KTP</label>

                                                <input type="text" maxlength="16" name="noktp_op" class="form-control" id="noktp_op" placeholder="Masukkan No. KTP" required onkeypress='return (event.charCode > 47 && event.charCode < 58)' value="<?= $op->noktp_op; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="stok_gd" class="form-label">Status</label>
                                                <select name="status_op" id="status_op" class="form-control" required>
                                                    <option value="" disabled>-- Status --</option>
                                                    <?php if ($op->status_op == "0") { ?>
                                                        <option value="0" selected>Standby</option>
                                                        <option value="1">Berangkat</option>
                                                    <?php } else { ?>
                                                        <option value="0">Standby</option>
                                                        <option value="1" selected>Berangkat</option>
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
<script>
    //* Script untuk memuat sweetalert status genset
    $('.status-op').on('click', function() {
        var getLink = $(this).attr('href');
        Swal.fire({
            title: 'Ubah Status',
            text: 'Yakin ingin ubah Status Operator?',
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
</body>

</html>
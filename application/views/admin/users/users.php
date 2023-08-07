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
                    <h1 class="m-0">Data User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">User</li>
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
                            Data User
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>
                            <!-- <button onclick="window.location.href='<?= site_url('admin/tambah_users'); ?>'" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-primary" name="tambah_data"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Data</button> -->
                            <button data-toggle="modal" data-target="#AddUser" class="btn btn-primary btn-sm" style="margin-bottom:10px;"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Data</button>

                            <table id="example1" class="table table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width :10px">No.</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Last Login</th>
                                        <th style="width:10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (is_array($user)) { ?>
                                        <?php foreach ($user as $u) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $u->nama ?></td>
                                                <td><?= $u->username ?></td>
                                                <?php if ($u->role == 0) { ?>
                                                    <td>User Admin</td>
                                                <?php } elseif ($u->role == 1) { ?>
                                                    <td>User Pimpinan</td>
                                                <?php } elseif ($u->role == 2) { ?>
                                                    <td>User Teknisi</td>
                                                <?php } else { ?>
                                                    <td>User Penyewa</td>
                                                <?php } ?>
                                                <td><?= $u->last_login ?></td>
                                                <td>
                                                    <button type="button" data-toggle="modal" data-target="#EditUser<?= $u->id_user; ?>" title="Edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                                                    <!-- <a href="<?= site_url('admin/edit_user/' . $u->id_user); ?>" type="button" title="Edit" class="btn btn-sm btn-info" name="btn_edit"><i class="fa fa-edit "></i></a> -->
                                                    <a href="<?= site_url('admin/proses_deleteuser/' . $u->id_user); ?>" type="button" title="Hapus" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash "></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade" id="AddUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">Tambah Data User</h6>
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

                                    <form action="<?= site_url('admin/proses_tambahuser'); ?>" method="post" role="form">

                                        <div class="form-group row">
                                            <label for="username" class="col-sm-3 col-form-label">Nama</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="username" class="col-sm-3 col-form-label">Username</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="confirm_password" class="col-sm-3 col-form-label">Konfirmasi Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Konfirmasi Password" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="role" class="col-sm-3 col-form-label">Role</label>
                                            <div class="col-sm-9">
                                                <select name="role" id="" class="form-control" style="width: 50%;" required>
                                                    <option value="" selected="" disabled>--Pilih Role User--</option>
                                                    <option value="0">User Admin</option>
                                                    <option value="1">User Teknisi</option>
                                                    <option value="2">User Pimpinan</option>
                                                    <option value="3" disabled>User Penyewa</option>
                                                </select>
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
                    <?php foreach ($user as $d) { ?>

                        <div class="modal fade" id="EditUser<?= $d->id_user; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="staticBackdropLabel">Ubah Data User</h6>
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
                                        <form action="<?= site_url('admin/proses_edituser'); ?>" method="post" role="form">
                                            <input type="hidden" name="id_user" value="<?= $d->id_user; ?>">
                                            <div class="form-group row">
                                                <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" required="" value="<?= $d->nama; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="username" class="col-sm-3 col-form-label">Username</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="username" class="form-control" id="username" placeholder="Username" required="" value="<?= $d->username; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="role" class="col-sm-3 col-form-label">Role</label>
                                                <div class="col-sm-9">
                                                    <select name="role" id="" style="width: 50%;" class="form-control">
                                                        <option value="" selected="" disabled>--Pilih Role User--</option>
                                                        <?php if ($d->role == 0) { ?>
                                                            <option value="0" selected="">User Admin</option>
                                                            <option value="1">User Pimpinan</option>
                                                            <option value="2">User Teknisi</option>
                                                            <option value="3" disabled>User Penyewa</option>
                                                        <?php } elseif ($d->role == 1) { ?>
                                                            <option value="0">User Admin</option>
                                                            <option value="1" selected="">User Pimpinan</option>
                                                            <option value="2">User Teknisi</option>
                                                            <option value="3" disabled>User Penyewa</option>
                                                        <?php } elseif ($d->role == 2) { ?>
                                                            <option value="0">User Admin</option>
                                                            <option value="1">User Pimpinan</option>
                                                            <option value="2" selected="">User Teknisi</option>
                                                            <option value="3" disabled>User Penyewa</option>
                                                        <?php } else { ?>
                                                            <option value="0" disabled>User Admin</option>
                                                            <option value="1" disabled>User Pimpinan</option>
                                                            <option value="2" disabled>User Teknisi</option>
                                                            <option value="3" selected="">User Penyewa</option>
                                                        <?php } ?> ?>
                                                    </select>
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
<!-- /.content-wrapper -->
<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('admin/template/script') ?>

<script type="text/javascript">
    $(function() {
        $('#example1').DataTable({
            // 'paging': true,
            // 'lengthChange': false,
            // 'searching': false,
            // 'ordering': false,
            // 'info': true,
            'responsive': true,
            'autoWidth': false
        })
    }); //* Script untuk memuat datatable
</script>
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
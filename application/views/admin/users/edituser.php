<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

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
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/users'); ?>">User</a></li>
                        <li class="breadcrumb-item active">Ubah Data </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row tengah">

                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            Ubah Data User
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissable">
                                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>
                            <?php if (validation_errors()) { ?>
                                <div class="alert alert-warning alert-dismissable">
                                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                    <strong>Peringatan!</strong><br> <?php echo validation_errors(); ?>
                                </div>
                            <?php } ?>
                            <?php foreach ($list_data as $d) { ?>
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
                                <?php } ?>
                                <hr>
                                <div class="form-group" align="center">
                                    <button onclick="history.back(-1)" type="button" class="btn btn-sm btn-default" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Kembali</button>
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check mr-2"></i>Submit</button>
                                </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script') ?>



</body>

</html>
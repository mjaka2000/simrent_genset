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
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/users'); ?>">User</a></li>
                        <li class="breadcrumb-item active">Edit Data </li>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="width: 30%; margin-left: 35%;">
                        <div class="card-header"><i class="fas fa-edit"></i>
                            Edit Data User
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('admin/proses_edituser'); ?>" method="post" role="form">
                                <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                    <div class="alert alert-success alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                    </div>
                                <?php } ?>
                                <?php if (validation_errors()) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Perhatian!</strong><br> <?php echo validation_errors(); ?>
                                    </div>
                                <?php } ?>
                                <?php foreach ($list_data as $d) { ?>
                                    <input type="hidden" name="id" value="<?= $d->id; ?>">
                                    <div class="form-group">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" required="" value="<?= $d->nama; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" id="username" placeholder="Username" required="" value="<?= $d->username; ?>">
                                    </div>
                                    <div class="form-group ">
                                        <label for="role" class="form-label">Role</label>
                                        <select name="role" id="" style="width: 50%;" class="form-control">
                                            <?php if ($d->role == 0) { ?>
                                                <option value="0" selected="">User Admin</option>
                                                <option value="1">User Pimpinan</option>
                                                <option value="2">User Teknisi</option>
                                            <?php } elseif ($d->role == 1) { ?>
                                                <option value="1" selected="">User Pimpinan</option>
                                                <option value="0">User Admin</option>
                                                <option value="2">User Teknisi</option>
                                            <?php } else { ?>
                                                <option value="2" selected="">User Teknisi</option>
                                                <option value="0">User Admin</option>
                                                <option value="1">User Pimpinan</option>
                                            <?php } ?> ?>
                                        </select>
                                    </div>
                                <?php } ?>
                                <hr>
                                <div class="form-group" align="center">
                                    <button onclick="window.location.href='<?= base_url('admin/users'); ?>'" type="button" class="btn btn-sm btn-default" onclick="" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Kembali</button>
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

<?php $this->load->view('admin/template/script') ?>

</body>

</html>
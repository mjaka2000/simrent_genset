<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div id="loading">
            <img src="<?= base_url(); ?>assets/style/loading.gif" alt="loading" width="50%">
        </div>
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-3">
                    <div class="card" style="margin-left: 11%;">

                        <div class="card-body card-profile" align="center">
                            <div class="info">
                                <?php foreach ($avatar as $a) { ?>
                                    <div class="image">
                                        <img src="<?= base_url('assets/upload/user/' . $a->nama_file); ?>" class="profile-user-img img-responsive img-circle" alt="User Image">
                                    <?php } ?>
                                    </div>
                                    <strong><?= $this->session->userdata('name') ?></strong> as Administrator
                                    <br><small>Last Login : <?= $this->session->userdata('last_login') ?></small>
                            </div>
                            <?php if ($this->session->flashdata('msg_gambar_sukses')) { ?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_gambar_sukses'); ?>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('msg_gambar_error')) { ?>
                                <div class="alert alert-warning alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Peringatan!</strong><br> <?= $this->session->flashdata('msg_gambar_error'); ?>
                                </div>
                            <?php } ?>
                            <?php if (isset($pesan_error)) { ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Peringatan!</strong><br> <?= $pesan; ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- <div class="card" style="width: 30%; margin-left: 35%;">
                        <div class="card-header">
                            Profile
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

                                <hr>
                                <div class="form-group" align="center">
                                    <a href="<?= base_url('admin/users'); ?>" type="button" class="btn btn-sm btn-default" onclick="" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Kembali</a>
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check mr-2"></i>Submit</button>
                                </div>
                            </form>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="col-md-9" style="width: auto;">
                <div class="container">
                    <div class="card card-primary card-outline card-tabs">
                        <div class="card-header p-0 pt-1 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a href="#settings" class="nav-link active" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Change Password</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#picture" class="nav-link" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Change Picture</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade" id="picture" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                    <form class="form-horizontal" action="<?= base_url('admin/proses_gambarupload'); ?>" method="post" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <label for="userpicture" class="col-sm-2 control-label">Open Picture</label>

                                            <div class="col-sm-10">
                                                <input type="file" name="userpicture" class="form-control" id="username">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group " align="center">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <a href="<?= base_url('admin'); ?>" type="button" class="btn btn-sm btn-default" onclick="" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Kembali</a>
                                                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check mr-2"></i>Submit</button>
                                            </div>
                                            <!-- <a href="<?= base_url('admin/users'); ?>" type="button" class="btn btn-sm btn-secondary" onclick="" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Kembali</a> -->
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade show active" id="settings" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                    <form class="form-horizontal" action="<?= base_url('admin/proses_newpassword'); ?>" method="post" enctype="multipart/form-data">
                                        <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                            <div class="alert alert-success alert-dismissable">
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
                                        <form class="form-horizontal" action="<?= base_url('admin/proses_newpassword'); ?>" method="post">
                                            <div class="form-group row">
                                                <label for="username" class="col-sm-2 control-label">Username</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="username" class="form-control" id="username" disabled value="<?= $this->session->userdata('name'); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="nama" class="col-sm-2 control-label">Nama</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="nama" class="form-control" id="nama" value="<?= $this->session->userdata('nama'); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="new_password" class="col-sm-2 control-label">Password Baru</label>
                                                <div class="col-sm-10">
                                                    <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Password Baru">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="confirm_new_password" class="col-sm-2 control-label">Konfirmasi Password Baru</label>
                                                <div class="col-sm-10">
                                                    <input type="password" name="confirm_new_password" class="form-control" id="confirm_new_password" placeholder="Konfirmasi Password Baru">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group" align="center">
                                                <div class=" col-sm-10">
                                                    <a href="<?= base_url('admin'); ?>" type="button" class="btn btn-sm btn-default" onclick="" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Kembali</a>
                                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check mr-2"></i>Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- <a href="<?= base_url('admin/users'); ?>" type="button" class="btn btn-sm btn-secondary" onclick="" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Kembali</a> -->
                                </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <!-- /.card -->
                </div>
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
</body>

</html>
<?php $this->load->view('template/head'); ?>
<?php $this->load->view('guest/template/nav'); ?>
<?php $this->load->view('guest/template/sidebar'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Profile User</h1>

        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('guest') ?>">Home</a></li>
            <li class="breadcrumb-item active">Profile User</li>
        </ol>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div id="loading">
            <img src="<?= base_url(); ?>assets/style/loading.gif" alt="loading" width="50%">
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <div class="info" align="center">
                            <?php foreach ($avatar as $a) { ?>
                                <div class="image">
                                    <img src="<?= base_url('assets/upload/user/img/' . $a->nama_file); ?>" class="profile-user-img img-responsive img-circle" alt="User Image">
                                <?php } ?>
                                </div>
                                <?= $this->session->userdata('name') ?> as Guest
                                <br><small>Last Login : <?= $this->session->userdata('last_login') ?></small>
                        </div>
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


            <div class="col-md-9">
                <div class="container">
                    <div class="nav-tabs-custom">

                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#settings" data-toggle="tab">Change Password</a></li>
                            <li><a href="#picture" data-toggle="tab">Change Picture</a></li>
                        </ul>


                        <!--  -->
                        <div class="tab-content">
                            <div class="tab-pane" id="picture">
                                <form class="form-horizontal" action="<?= base_url('guest/proses_gambarupload'); ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="userpicture" class="col-sm-2 control-label">Open Picture</label>

                                        <div class="col-sm-10">
                                            <input type="file" name="userpicture" class="form-control" id="username">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check mr-2"></i>Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane active" id="settings">
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
                                    <div class="form-group">
                                        <label for="username" class="col-sm-2 control-label">Username</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="username" class="form-control" id="username" disabled value="<?= $this->session->userdata('name'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama" class="col-sm-2 control-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nama" class="form-control" id="nama" value="<?= $this->session->userdata('nama'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password" class="col-sm-2 control-label">Password Baru</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Password Baru">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_new_password" class="col-sm-2 control-label">Konfirmasi Password Baru</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="confirm_new_password" class="form-control" id="confirm_new_password" placeholder="Konfirmasi Password Baru">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <!-- <a href="<?= base_url('admin/users'); ?>" type="button" class="btn btn-sm btn-secondary" onclick="" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Kembali</a> -->
                                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check mr-2"></i>Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('guest/template/script') ?>
</body>

</html>
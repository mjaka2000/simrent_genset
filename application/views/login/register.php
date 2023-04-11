<?php $this->load->view('login/template/head'); ?>

<body class="hold-transition register-page">
    <div class="wrapper">
        <div class="register-box">
            <div class="box box-outline box-primary">
                <img class="img" src="<?= base_url(); ?>assets/upload/logo/ws.png" alt="Logo" width="100%">
                <div class="box-header text-center">
                    <h4><b>REGISTER</b></h4>
                </div>
                <div class="box-body">
                    <!-- <p class="login-box-msg"><b>*</b>Register sebagai user biasa</p> -->
                    <form action="<?= base_url('register/proses_register'); ?>" method="post">
                        <?php if ($this->session->flashdata('msg')) { ?>
                            <div class="alert alert-warning alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Peringatan!</strong><br> <?php echo $this->session->flashdata('msg'); ?>
                            </div>
                        <?php } ?>

                        <?php if ($this->session->flashdata('msg_daftar')) { ?>
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Berhasil!</strong><br> <?php echo $this->session->flashdata('msg_daftar'); ?>
                            </div>
                        <?php } ?>

                        <?php if (validation_errors()) { ?>
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Peringatan!</strong><br> <?php echo validation_errors(); ?>
                            </div>
                        <?php } ?>

                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" name="nama" placeholder="Nama Anda" autofocus required="" />
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>

                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" name="username" placeholder="Username" required="" />
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>

                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" name="password" placeholder="Password" required="" />
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required="" />
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                        </div>
                        <div class="row">
                            <div class="col-xs-8">
                                <!-- <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                            <label for="agreeTerms">
                                I agree to the <a href="#">terms</a>
                            </label>
                        </div> -->
                                <?php echo anchor(base_url('login'), 'Log In') ?>
                            </div>
                            <!-- /.col -->
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-sm btn-primary btn-block"><i class="fa fa-user-plus"></i>&nbsp;Register</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                </div>
                <!-- /.form-box -->
            </div><!-- /.box -->
        </div>
    </div>

    <?php $this->load->view('login/template/footer'); ?>
</body>

</html>
<?php $this->load->view('login/template/head'); ?>

<body class="hold-transition login-page auth-bg">
    <div class="wrapper">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><strong style="color: white;">LOGIN</strong></a>
            </div>
            <!-- /.login-logo -->
            <div class="card card-primary card-outline">
                <div class="card-body login-card-body">
                    <img class="img" src="<?= base_url(); ?>assets/style/logo/ws.png" alt="Logo" width="80%">
                    <!-- <p class="login-box-msg">Login Untuk Memulai Sesi</p> -->
                    <hr>
                    <form action="<?= base_url('login/proses_login'); ?>" class="login" method="post">
                        <?php if ($this->session->flashdata('msg')) { ?>
                            <div class="alert alert-warning alert-dismissible">
                                <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                <strong>Peringatan!</strong><br> <?php echo $this->session->flashdata('msg'); ?>
                            </div>
                        <?php } ?>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <!-- <?php if (isset($token_generate)) { ?>
                                <input type="hidden" name="token" value="<?php echo $token_generate ?>">
                            <?php } else {
                                    redirect(base_url());
                                } ?> -->
                        <div class="row">
                            <div class="col-6">
                                <!-- <div class="icheck-primary">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div> -->
                            </div>
                        </div>
                        <div class="mt-5">
                            <button type="submit" class="button"><i class="fas fa-sign-in-alt"></i>&nbsp;Log In</button>
                        </div>
                    </form>

                </div>
                <!-- /.login-card-body -->
            </div>
            <div class="footer">
                <center style="color: white;"><small>Copyright &copy; 2022-<script type="text/javascript">
                            document.write(new Date().getFullYear());
                        </script></small>
                </center>
            </div>
        </div>
        <!-- /.login-box -->
    </div>
    <?php $this->load->view('login/template/script'); ?>

</body>

</html>
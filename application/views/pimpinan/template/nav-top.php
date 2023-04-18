<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-dark navbar-primary">
    <div class="container">
        <a href="#" class="navbar-brand">
            <img src="<?= base_url(); ?>assets/style/logo/ws-w.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light"><b>Wardah</b>Solution</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-home mr-1"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><i class="nav-icon fas fa-list-alt mr-1"></i>Menu Data</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <!-- <li><a href="#" class="dropdown-item">Menu Data</a></li> -->
                        <!-- <li><a href="<?= base_url(); ?>pimpinan/tabel_genset" class="dropdown-item">
                                <span>Data Genset</span>
                            </a></li> -->
                        <li><a href="#" class="dropdown-item">
                                <span>Data Genset</span>
                            </a></li>
                        <!-- <li class="dropdown-divider"></li> -->

                        <!-- End Level two -->
                    </ul>
                </li>
            </ul>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php foreach ($avatar as $a) { ?>
                        <img src="<?= base_url('assets/upload/user/' . $a->nama_file); ?>" class="user-image" alt="User Image">
                    <?php } ?>
                    <span class="hidden-xs" style="color: white;"><?= $this->session->userdata('name') ?></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <?php foreach ($avatar as $a) { ?>
                            <img src="<?= base_url('assets/upload/user/' . $a->nama_file); ?>" class="profile-user-img img-responsive img-circle" alt="User Image">
                        <?php } ?>

                        <p>
                            <?= $this->session->userdata('name') ?> as Pimpinan <br>
                            <small>Last Login : <?= $this->session->userdata('last_login') ?></small><br>
                        </p>
                    </li>
                    <!-- Menu Body -->

                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <span class="pull-left">
                            <button class="win7-btn btn-xs" onclick="window.location.href='<?= base_url('pimpinan/profile'); ?>'"><i class="fa fa-cog"></i>&nbsp;Profile</button>
                        </span>
                        <span class="pull-right" style="margin-left: 28%;">
                            <button class="win7-btn btn-xs" onclick="window.location.href='<?= base_url('pimpinan/signout'); ?>'"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</button>
                        </span>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>
<!-- /.navbar -->
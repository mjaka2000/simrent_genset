<nav class="main-header navbar navbar-expand-md navbar-light navbar-dark" style="color: white;">
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
                    <a href="<?= site_url('penyewa') ?>" class="nav-link">Home</a>
                </li>
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">Contact</a>
                </li> -->
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Menu Data</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="<?= site_url(); ?>penyewa/tabel_genset" class="dropdown-item">Data Genset</a></li>
                        <li><a href="<?= site_url(); ?>penyewa/tabel_pelanggan" class="dropdown-item">Data Pelanggan</a></li>
                        <li><a href="<?= site_url(); ?>penyewa/tabel_unit_keluar" class="dropdown-item">Data Penyewaan Genset</a></li>
                        <li><a href="<?= site_url(); ?>penyewa/tabel_unit_masuk" class="dropdown-item">Data Riwayat</a></li>

                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Menu User</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="<?= site_url(); ?>penyewa/profile" class="dropdown-item">Profile</a></li>

                    </ul>
                </li>
            </ul>

        </div>
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

            <!-- <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li> -->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <?php foreach ($avatar as $a) { ?>
                        <img src="<?= base_url('assets/upload/user/' . $a->nama_file); ?>" class="user-image img-circle elevation-2" alt="User Image">
                    <?php } ?>
                    <span class="hidden-xs" style="color: white;"><?= $this->session->userdata('nama') ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header">
                        <?php foreach ($avatar as $a) { ?>
                            <img src="<?= base_url('assets/upload/user/' . $a->nama_file); ?>" class="img-circle elevation-2" alt="User Image">
                        <?php } ?>

                        <p>
                            <strong><?= $this->session->userdata('nama') ?></strong> - Penyewa <br>
                            <small>Last Login : <?= $this->session->userdata('last_login') ?></small><br>
                        </p>
                    </li>
                    <!-- Menu Body -->

                    <!-- Menu Footer-->
                    <li class="card-footer">
                        <span class="fa-pull-left">
                            <a class="btn btn-default btn-sm" type="button" href="<?= site_url('penyewa/profile'); ?>"><i class="fa fa-cog"></i>&nbsp;Profile</a>
                        </span>
                        <span class="fa-pull-right">
                            <a class="btn btn-default btn-sm btn-logout" type="button" href="<?= site_url('penyewa/logout'); ?>"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
                        </span>
                    </li>
                </ul>
            </li>
        </ul>
</nav>
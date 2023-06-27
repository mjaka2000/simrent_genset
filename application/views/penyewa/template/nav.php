<nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

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
                        <button class="btn btn-default btn-sm" type="button" onclick="window.location.href='<?= site_url('penyewa/profile'); ?>'"><i class="fa fa-cog"></i>&nbsp;Profile</button>
                    </span>
                    <span class="fa-pull-right">
                        <button class="btn btn-default btn-sm" type="button" onclick="window.location.href='<?= site_url('penyewa/logout'); ?>'"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</button>
                    </span>
                </li>
            </ul>
        </li>
    </ul>
</nav>
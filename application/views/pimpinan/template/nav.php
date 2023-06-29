<nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

    </ul>
    <!-- <li class="nav nav-item dropdown">
        <a href="#" class="nav-link" data-toggle="dropdown" style=" color: white;">
            <i class="fas fa-bell"></i>
            <?php if (empty($num)) { ?>
                <span></span>
            <?php } else { ?>
                <span class="badge badge-warning"><?= $num; ?></span>
            <?php } ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg">
            <span class="dropdown-header" style="background-color: #2596be; color: white;">You have <?= $num; ?> notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <div class="col-lg">
                    <?php foreach ($notifOut as $c) : ?>
                        <a href="<?= site_url('pimpinan/detail_unit_keluar/' . $c->id_u_keluar); ?>" style="text-decoration: none; color: black;"><span><strong><?= $c->id_transaksi; ?><br><?= $c->nama_plg; ?><br><?= $c->nama_genset; ?></strong></span><br>
                            <small style="color: red;">Pengambilan Genset Tanggal <strong><?= date('d/m/Y', strtotime($c->tanggal_masuk)); ?></strong></small></a>
                    <?php endforeach ?>
                </div>
            </a>


            <div class="dropdown-divider"></div>
            <a href="#" style="background-color: #2596be;" class="dropdown-item dropdown-footer"></a>
        </div>

    </li> -->
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
                        <strong><?= $this->session->userdata('nama') ?></strong> - Pimpinan <br>
                        <small>Last Login : <?= $this->session->userdata('last_login') ?></small><br>
                    </p>
                </li>
                <!-- Menu Body -->

                <!-- Menu Footer-->
                <li class="card-footer">
                    <span class="fa-pull-left">
                        <button class="btn btn-default btn-sm" type="button" onclick="window.location.href='<?= site_url('pimpinan/profile'); ?>'"><i class="fa fa-cog"></i>&nbsp;Profile</button>
                    </span>
                    <span class="fa-pull-right">
                        <button class="btn btn-default btn-sm" type="button" onclick="window.location.href='<?= site_url('pimpinan/logout'); ?>'"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</button>
                    </span>
                </li>
            </ul>
        </li>
    </ul>
</nav>
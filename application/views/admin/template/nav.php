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

    </ul>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->

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
                            <strong><?= $this->session->userdata('name') ?></strong> as Administrator <br>
                            <small>Last Login : <?= $this->session->userdata('last_login') ?></small><br>
                        </p>
                    </li>
                    <!-- Menu Body -->

                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <span class="pull-left">
                            <button class="win7-btn btn-xs" onclick="window.location.href='<?= base_url('admin/profile'); ?>'"><i class="fa fa-cog"></i>&nbsp;Profile</button>
                        </span>
                        <span class="pull-right" style="margin-left: 28%;">
                            <button class="win7-btn btn-xs" onclick="window.location.href='<?= base_url('admin/signout'); ?>'"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</button>
                        </span>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
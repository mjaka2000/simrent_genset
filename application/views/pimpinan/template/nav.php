<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>W</b>S</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Wardah</b>Solution</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php foreach ($avatar as $a) { ?>
                            <img src="<?= base_url('assets/upload/user/img/' . $a->nama_file); ?>" class="user-image" alt="User Image">
                        <?php } ?>
                        <span class="hidden-xs"><?= $this->session->userdata('name') ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?php foreach ($avatar as $a) { ?>
                                <img src="<?= base_url('assets/upload/user/img/' . $a->nama_file); ?>" class="profile-user-img img-responsive img-circle" alt="User Image">
                            <?php } ?>

                            <p>
                                <?= $this->session->userdata('name') ?> as Guest <br>
                                <small>Last Login : <?= $this->session->userdata('last_login') ?></small><br>
                            </p>
                        </li>
                        <!-- Menu Body -->

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?= base_url('guest/profile'); ?>" class="btn btn-sm btn-default btn-flat"><i class="fa fa-cog" aria-hidden=" true"></i>&nbsp;Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?= base_url('guest/signout'); ?>" class="btn btn-sm btn-default btn-flat"><i class="fa fa-sign-out" aria-hidden=" true"></i>&nbsp;Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <!-- <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li> -->
            </ul>
        </div>
    </nav>
</header>
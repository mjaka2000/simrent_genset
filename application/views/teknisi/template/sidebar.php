<!--  -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="position:fixed ;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?= base_url(); ?>assets/style/logo/ws-w.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>Wardah</b>Solution</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php foreach ($avatar as $a) { ?>
                    <img src="<?= base_url('assets/upload/user/' . $a->nama_file); ?>" class=" img-responsive img-circle" alt="User Image">
                <?php } ?>
            </div>
            <div class="info">
                <a href="#" class="d-block"><strong><?= $this->session->userdata('nama') ?></strong></a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2 text-sm">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-header">MAIN NAVIGATION</li>
                <li class="nav-item">
                    <a href="<?= base_url('teknisi') ?>" class="nav-link">
                        <i class="nav-icon fa fa-home"></i>
                        <p>Dashboard</p>
                    </a>

                </li>

                <li class="nav-item">
                    <a href="<?= site_url(); ?>teknisi/tabel_genset" class="nav-link">
                        <i class="fas fa-edit nav-icon"></i>
                        <p>Data Genset</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url(); ?>teknisi/tabel_service_genset" class="nav-link">
                        <i class="fas fa-edit nav-icon"></i>
                        <p>Data Perbaikan Genset</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url(); ?>teknisi/service_genset_acc" class="nav-link">
                        <i class="fas fa-edit nav-icon"></i>
                        <p>Perbaikan Genset Disetujui</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url(); ?>teknisi/tabel_sparepart" class="nav-link">
                        <i class="fas fa-edit nav-icon"></i>
                        <p>Data Stok Sparepart</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= site_url(); ?>teknisi/laporan" class="nav-link">
                        <i class="fas fa-clipboard nav-icon"></i>
                        <p>Laporan Data</p>
                    </a>
                </li>
                <!-- <li class="nav-header">LAPORAN DATA</li> -->
                <li class="nav-header">PENGATURAN</li>
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Menu User
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="<?= site_url(); ?>teknisi/profile" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url(''); ?>teknisi/logout" class="nav-link btn-logout">
                        <i class="fas fa-sign-out-alt nav-icon"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
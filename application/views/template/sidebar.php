<!--  -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 " style="position:fixed ;">
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
                <?php if ($this->session->userdata('role') == '0') : ?>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="<?= site_url('admin') ?>" class="nav-link">
                        <i class="nav-icon fa fa-home"></i>
                        <p>Dashboard</p>
                    </a>

                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-table"></i>
                        <p>
                            Menu Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url(); ?>admin/tabel_genset" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Genset</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url(); ?>admin/tabel_mobil" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Mobil</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url(); ?>admin/tabel_operator" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Operator</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item ">
                    <ul class="nav nav-treeview">
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Menu Data Transaksi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url(); ?>admin/tabel_service_genset" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Perbaikan Genset</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url(); ?>admin/tabel_sparepart" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Stok Sparepart</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url(); ?>admin/tabel_pelanggan" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Pelanggan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url(); ?>admin/service_genset_acc" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Perbaikan Genset Disetujui</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url(); ?>admin/tabel_unit_keluar" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Penyewaan Genset (Keluar)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url(); ?>admin/tabel_unit_masuk" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Unit Masuk (Kembali)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url(); ?>admin/tabel_jdw_genset" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jadwal Penyewaan Genset</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= site_url(); ?>admin/tabel_pengeluaran" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Pengeluaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url(); ?>admin/tabel_pemasukan" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Pemasukan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url(); ?>admin/laporan" class="nav-link">
                        <i class="fas fa-clipboard nav-icon"></i>
                        <p>Laporan Data</p>
                    </a>
                </li>
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
                            <a href="<?= site_url(); ?>admin/profile" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url(); ?>admin/users" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data User</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="<?= site_url(''); ?>admin/logout" class="nav-link btn-logout">
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
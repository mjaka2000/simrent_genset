<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php foreach ($avatar as $a) { ?>
                    <img src="<?= base_url('assets/upload/user/img/' . $a->nama_file); ?>" class="img-circle" alt="User Image">
                <?php  } ?>
            </div>
            <div class="pull-left info">
                <p><?= $this->session->userdata('name') ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="<?= base_url('guest') ?>">
                    <i class="fa fa-home"></i> <span>Dashboard</span>
                </a>

            </li>
            <li class="treeview"><a href="#"><i class="fa fa-table"></i>
                    <span>Data Master</span><span class="pull-right-container"></span><i class="pull-right fa fa-angle-left "></i></span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?= base_url(); ?>guest/tabel_genset">
                            <i class="fa fa-circle-o"></i>
                            <span>Data Genset</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url(); ?>guest/tabel_service_genset">
                            <i class="fa fa-circle-o"></i>
                            <span>Data Perbaikan Genset</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url(); ?>guest/tabel_mobil">
                            <i class="fa fa-circle-o"></i>
                            <span>Data Mobil</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url(); ?>guest/tabel_operator">
                            <i class="fa fa-circle-o"></i>
                            <span>Data Operator</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url(); ?>guest/tabel_pelanggan">
                            <i class="fa fa-circle-o"></i>
                            <span>Data Pelanggan</span>
                        </a>
                    </li>

                </ul>
            </li>
            <!--  -->
            <li class="treeview"><a href="#"><i class="fa fa-copy"></i>
                    <span>Transaksi</span><span class="pull-right-container"></span><i class="pull-right fa fa-angle-left "></i></span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?= base_url(); ?>guest/tabel_barang_keluar">
                            <i class="fa fa-upload nav-icon"></i>
                            <span>Data Genset Keluar</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url(); ?>guest/tabel_barang_masuk">
                            <i class="fa fa-download nav-icon"></i>
                            <span>Data Genset Masuk</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="<?= base_url(); ?>guest/tambah_data_pelanggan">
                    <i class="fa fa-file"></i>
                    <span>Tambah Data Pelanggan</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('guest/pengajuan_baru') ?>">
                    <i class="fa fa-file"></i> <span>Permohonan</span>
                </a>

            </li>
            <li class="header">LAPORAN</li>
            <li>
                <a href="<?= base_url('guest/laporan') ?>">
                    <i class="ion ion-stats-bars"></i> <span>Laporan Data</span>
                </a>

            </li>

            <!-- <li><a href="https://guestlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li> -->
            <li class="header">PENGATURAN</li>
            <li>
                <a href="<?= base_url(); ?>guest/profile">
                    <i class="fa fa-user"></i>
                    <span>Menu Profile</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url(''); ?>admin/signout">
                    <i class="fa fa-sign-out"></i>
                    <span>Logout</span></a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
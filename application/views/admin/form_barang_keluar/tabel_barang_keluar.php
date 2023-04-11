<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Data Genset Keluar</h1>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active">Transaksi</li>
            <li class="breadcrumb-item active">Data Genset Keluar</li>
        </ol>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div id="loading">
            <img src="<?= base_url(); ?>assets/style/loading.gif" alt="loading" width="50%">
        </div>
        <div class="row">
            <div class="col-xs-12">
                <!-- Default box -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-upload"></i>&nbsp;Data Genset Keluar</h3>
                    </div>
                    <div class="box-body">
                        <?php if ($this->session->flashdata('msg_sukses')) { ?>
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                            </div>
                        <?php } ?>
                        <a href="<?= base_url('admin/tambah_genset_keluar'); ?>" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-primary" name="tambah_data"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Data</a>

                        <table id="mytable" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width :10px">No.</th>
                                    <th>ID</th>
                                    <th>Tanggal Keluar</th>
                                    <th>Lokasi</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Nama Genset</th>
                                    <th>Daya</th>
                                    <th>Mobil</th>
                                    <th>Jml. Hari</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Status Genset</th>
                                    <th style="width:10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                // $list_data = isset($_POST['list_data']) ? $_POST['list_data'] : '';
                                if (is_array($list_data)) { ?>
                                    <?php foreach ($list_data as $dt) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $dt->id_transaksi; ?></td>
                                            <td><?= $dt->tanggal_keluar; ?></td>
                                            <td><?= $dt->lokasi; ?></td>
                                            <td><?= $dt->nama_pelanggan; ?></td>
                                            <td><?= $dt->nama_genset; ?></td>
                                            <td><?= $dt->daya; ?></td>
                                            <td><?= $dt->nopol; ?></td>
                                            <td><?= $dt->jumlah_hari; ?></td>
                                            <td>Rp&nbsp;<?= number_format($dt->total); ?></td>
                                            <?php if ($dt->status_ajuan == 1) { ?>
                                                <td><a href="<?= base_url('admin/update_baru/' . $dt->id_transaksi); ?>" type="button" class="btn btn-xs btn-danger btn-barangbaru" name="btn_aju"><i class="fa fa-sign-in mr-2"></i>Belum Disetujui</a></td>
                                            <?php } else { ?>
                                                <td><a href="#" type="button" class="btn btn-xs btn-success btn-barangbaru" name="btn_aju"><i class="fa fa-check mr-2"></i>Disetujui</a></td>
                                            <?php } ?>
                                            <?php if ($dt->status == 1) { ?>
                                                <td><a href="<?= base_url('admin/barang_keluar/' . $dt->id_transaksi); ?>" type="button" class="btn btn-xs btn-warning btn-barangkeluar" name="btn_barangkeluar"><i class="fa fa-sign-in mr-2"></i>Genset Masuk</a></td>
                                            <?php } else { ?>
                                                <td>Genset Masuk (Kembali)</td>
                                            <?php } ?>
                                            <td><a href="<?= base_url('admin/update_keluar/' . $dt->id_transaksi); ?>" type="button" class="btn btn-sm btn-info" name="btn_edit"><i class="fa fa-edit mr-2"></i></a>
                                                <a href="<?= base_url('admin/hapus_data_keluar/' . $dt->id_transaksi); ?>" type="button" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash mr-2"></i></a>
                                                <a href="<?= base_url('admin/detail_barang_keluar/' . $dt->id_transaksi); ?>" type="button" class="btn btn-sm btn-warning" name="btn_detail"><i class="fa fa-info-circle mr-2"></i></a>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php } else { ?>
                                    <td colspan="12" align="center"><strong>Data Kosong</strong></td>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div class="box-footer">
                            <h5><strong>Keterangan :</strong></h5>
                            <a href="#" type="button" class="btn btn-sm btn-info" name="btn_edit"><i class="fa fa-edit mr-2"></i></a>&nbsp;<span>Untuk Mengedit Data</span><br>
                            <a href="#" type="button" class="btn btn-sm btn-danger" name="btn_delete"><i class="fa fa-trash mr-2"></i></a>&nbsp;<span>Untuk Menghapus Data</span><br>
                            <a href="#" type="button" class="btn btn-sm btn-warning" name="btn_detail"><i class="fa fa-info-circle mr-2"></i></a>&nbsp;<span>Untuk Melihat Detail </span>
                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('admin/template/script') ?>
</body>

</html>
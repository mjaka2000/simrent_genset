<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Data Genset Masuk</h1>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active">Transaksi</li>
            <li class="breadcrumb-item active">Data Genset Masuk</li>
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
                        <h3 class="box-title"><i class="fa fa-download mr-2"></i>Data Genset Masuk</h3>
                    </div>
                    <div class="box-body">
                        <?php if ($this->session->flashdata('msg_sukses')) { ?>
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                            </div>
                        <?php } ?>
                        <!-- <a href="<?= base_url('admin/tambah_genset_keluar'); ?>" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-primary" name="tambah_data"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Data</a> -->

                        <table id="mytable" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width :10px">No.</th>
                                    <th>ID</th>
                                    <!-- <th>Tanggal Keluar</th> -->
                                    <th>Tanggal Masuk (Kembali)</th>
                                    <th>Lokasi</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Nama Genset</th>
                                    <th>Daya</th>
                                    <th>Mobil</th>
                                    <th>Jml. Hari</th>
                                    <th>Total</th>
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
                                            <!-- <td><?= $dt->tanggal_keluar; ?></td> -->
                                            <td><?= $dt->tanggal_masuk; ?></td>
                                            <td><?= $dt->lokasi; ?></td>
                                            <td><?= $dt->nama_pelanggan; ?></td>
                                            <td><?= $dt->nama_genset; ?></td>
                                            <td><?= $dt->daya; ?></td>
                                            <td><?= $dt->nopol; ?></td>
                                            <td><?= $dt->jumlah_hari; ?></td>
                                            <td>Rp&nbsp;<?= number_format($dt->total); ?></td>
                                            <?php if ($dt->status == NULL || $dt->status == 1) { ?>
                                                <td><a href="<?= base_url('admin/barang_masuk_update/' . $dt->id_transaksi); ?>" type="button" class="btn btn-xs btn-warning btn-barangmasuk" name="btn_barangmasuk"><i class="fa fa-edit mr-2"></i>Perpanjang</a><br><br>
                                                    <a href="<?= base_url('admin/barang_masuk_kembali/' . $dt->id_transaksi); ?>" type="button" class="btn btn-xs btn-info btn-kembali" name="btn_barangkembali"><i class="fa fa-reply mr-2"></i>Masuk</a>
                                                </td>
                                            <?php } else { ?>
                                                <td>Genset Masuk (Kembali)</td>
                                            <?php } ?>
                                            <td>
                                                <a href="<?= base_url('admin/hapus_data_masuk/' . $dt->id_transaksi); ?>" type="button" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash mr-2"></i></a>
                                                <a href="<?= base_url('admin/detail_barang_masuk/' . $dt->id_transaksi); ?>" type="button" class="btn btn-sm btn-warning" name="btn_detail"><i class="fa fa-info-circle mr-2"></i></a>
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
                            <!-- <a href="#" type="button" class="btn btn-sm btn-info" name="btn_edit"><i class="fa fa-edit mr-2"></i></a>&nbsp;<span>Untuk Mengedit Data</span><br> -->
                            <a href="#" type="button" class="btn btn-sm btn-danger" name="btn_delete"><i class="fa fa-trash mr-2"></i></a>&nbsp;<span>Untuk Menghapus Data</span><br>
                            <a href="#" type="button" class="btn btn-sm btn-warning" name="btn_detail"><i class="fa fa-info-circle mr-2"></i></a>&nbsp;<span>Untuk Melihat Detail </span>
                            <!-- <a href="#" type="button" class="btn btn-xs btn-warning" name="btn_detail"><i class="fa fa-info-circle mr-2"></i></a>&nbsp;<span>Untuk Melihat Detail Perbaikan</span> -->
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

<script>
    //* Script untuk memuat sweetalert status genset
    $('.btn-kembali').on('click', function() {
        var getLink = $(this).attr('href');
        Swal.fire({
            title: 'Ubah Status',
            text: 'Yakin ingin ubah Status Genset menjadi Barang Masuk (Kembali)?',
            type: 'warning',
            confirmButtonColor: '#d9534f',
            showCancelButton: true,
        }).then(result => {
            //jika klik ya maka arahkan ke proses.php
            if (result.isConfirmed) {
                window.location.href = getLink
            }
        })
        return false;
    });
</script>
</body>

</html>
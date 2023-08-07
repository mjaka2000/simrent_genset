<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Unit Masuk (Kembali)</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Unit Masuk (Kembali)</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div id="loading" class="tengah">
            <img src="<?= base_url(); ?>assets/style/loading.gif" alt="loading" width="50%">
        </div>
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Data Unit Masuk (Kembali)
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>

                            <table id="examplejk" class="table table-bordered table-hover" style="width:100%">
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
                                    ?>
                                    <?php foreach ($list_data as $dt) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $dt->id_transaksi; ?></td>
                                            <!-- <td><?= $dt->tanggal_keluar; ?></td> -->
                                            <td><?= date('d-m-Y', strtotime($dt->tanggal_masuk)); ?></td>
                                            <td><?= $dt->lokasi; ?></td>
                                            <td><?= $dt->nama_plg; ?></td>
                                            <td><?= $dt->nama_genset; ?></td>
                                            <td><?= $dt->daya; ?></td>
                                            <td><?= $dt->nopol; ?></td>
                                            <td><?= $dt->jumlah_hari; ?></td>
                                            <td>Rp&nbsp;<?= number_format($dt->total); ?></td>
                                            <?php if ($dt->status == 0) { ?>
                                                <td>Genset Masuk (Kembali)</td>
                                            <?php } ?>
                                            <td>
                                                <a href="<?= base_url('admin/hapus_unit_masuk/' . $dt->id_u_sewa); ?>" type="button" title="Hapus" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash "></i></a>
                                                <!-- <a href="<?= base_url('admin/detail_unit_masuk/' . $dt->id_u_sewa); ?>" type="button" title="Lihat Detail" class="btn btn-sm btn-warning" name="btn_detail"><i class="fa fa-info-circle "></i></a> -->
                                                <button type="button" data-toggle="modal" data-target="#DetailUMasuk<?= $dt->id_u_sewa; ?>" title="Lihat Detail" class="btn btn-warning btn-sm"><i class="fa fa-info-circle"></i></button>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="box-footer">
                                <?php foreach ($pendapatan as $pd) { ?>
                                    <?php if (!empty($pd->total)) { ?>
                                        <h5>Rp&nbsp;<?= number_format($pd->total) ?></h5>
                                    <?php } else { ?>
                                        <h5>Rp&nbsp;0</h5>
                                    <?php } ?>
                                    <p style="color: red;">Total Pendapatan <?= $label ?></p>
                                <?php } ?>

                                <!-- <?php foreach ($total_data as $td) : ?>
                                    <h5>
                                        <p style="color: red;">Total Pendapatan: Rp&nbsp;<?= number_format($td->total); ?></p>
                                    </h5>
                                <?php endforeach; ?> -->
                                <!-- <h5><strong>Keterangan :</strong></h5> -->
                                <!-- <a href="#" type="button" class="btn btn-sm btn-info" name="btn_edit"><i class="fa fa-edit "></i></a>&nbsp;<span>Untuk Mengedit Data</span><br> -->
                                <!-- <a href="#" type="button" class="btn btn-sm btn-danger" name="btn_delete"><i class="fa fa-trash "></i></a>&nbsp;<span>Untuk Menghapus Data</span><br> -->
                                <!-- <a href="#" type="button" class="btn btn-sm btn-warning" name="btn_detail"><i class="fa fa-info-circle "></i></a>&nbsp;<span>Untuk Melihat Detail </span> -->
                            </div>
                        </div>
                    </div>
                    <?php foreach ($list_data as $d) { ?>

                        <div class="modal fade" id="DetailUMasuk<?= $d->id_u_sewa; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="staticBackdropLabel">Detail Data Penyewaan Genset</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span>&times;</span>
                                        </button>


                                    </div>
                                    <div class="modal-body">
                                        <?php if (validation_errors()) { ?>
                                            <div class="alert alert-warning alert-dismissable">
                                                <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                                <strong>Peringatan!</strong><br> <?php echo validation_errors(); ?>
                                            </div>
                                        <?php } ?>
                                        <table class="table" style="width:100%">
                                            <tr>
                                                <th style="vertical-align: middle">ID Transaksi</th>
                                                <td style="vertical-align: middle;">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <div class="row">
                                                                :&nbsp;<?= $d->id_transaksi; ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="vertical-align: middle">Tanggal Keluar</th>
                                                <td style="vertical-align: middle;">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <div class="row">
                                                                :&nbsp;<?= date('d-m-Y', strtotime($d->tanggal_keluar)); ?> </div>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="vertical-align: middle">Tanggal Masuk</th>
                                                <td style="vertical-align: middle;">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <div class="row">
                                                                :&nbsp;<?= date('d-m-Y', strtotime($d->tanggal_masuk)); ?> </div>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th style="vertical-align: middle">Lokasi</th>
                                                <td style="vertical-align: middle;">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <div class="row">
                                                                :&nbsp;<?= $d->lokasi; ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="vertical-align: middle">Nama Operator</th>
                                                <td style="vertical-align: middle;">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <div class="row">
                                                                :&nbsp;<?= $d->nama_op; ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="vertical-align: middle">Nama Pelanggan</th>
                                                <td style="vertical-align: middle;">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <div class="row">
                                                                :&nbsp;<?= $d->nama_plg; ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="vertical-align: middle">Nomor Genset</th>
                                                <td style="vertical-align: middle;">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <div class="row">
                                                                :&nbsp;<?= $d->kode_genset; ?> </div>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="vertical-align: middle">Nama Genset</th>
                                                <td style="vertical-align: middle;">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <div class="row">
                                                                :&nbsp;<?= $d->nama_genset; ?> </div>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="vertical-align: middle">Daya</th>
                                                <td style="vertical-align: middle;">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <div class="row">
                                                                :&nbsp;<?= $d->daya; ?> </div>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="vertical-align: middle">Harga (Perhari)</th>
                                                <td style="vertical-align: middle;">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <div class="row">
                                                                :&nbsp;Rp&nbsp;<?= number_format($d->harga); ?> </div>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="vertical-align: middle">Nopol Mobil</th>
                                                <td style="vertical-align: middle;">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <div class="row">
                                                                :&nbsp;<?= $d->nopol; ?> </div>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="vertical-align: middle">Merek</th>
                                                <td style="vertical-align: middle;">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <div class="row">
                                                                :&nbsp;<?= $d->merek; ?> </div>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="vertical-align: middle">Tambahan</th>
                                                <td style="vertical-align: middle;">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <div class="row">
                                                                :&nbsp;<?= $d->tambahan; ?> </div>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="vertical-align: middle">Jumlah Hari</th>
                                                <td style="vertical-align: middle;">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <div class="row">
                                                                :&nbsp;<?= $d->jumlah_hari; ?> </div>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="vertical-align: middle">Total Harga (Rp)</th>
                                                <td style="vertical-align: middle;">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <div class="row">
                                                                :&nbsp;Rp&nbsp;<?= number_format($d->total); ?> </div>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-arrow-left mr-2"></i>Kembali</button>
                                        <!-- <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check mr-2"></i>Submit</button> -->
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
<?php $this->load->view('template/footer'); ?>

<?php $this->load->view('template/script') ?>
<script>
    //* Script untuk menampilkan loading
    document.onreadystatechange = function() {
        if (document.readyState !== "complete") {
            document.querySelector(
                "body").style.visibility = "hidden";
            document.querySelector(
                "#loading").style.visibility = "visible";
        } else {
            document.querySelector(
                "#loading").style.display = "none";
            document.querySelector(
                "body").style.visibility = "visible";
        }
    };
</script>
<script type="text/javascript">
    $(function() {
        $('#examplejk').DataTable({
            // 'paging': true,
            // 'lengthChange': false,
            // 'searching': faslse,
            // 'ordering': false,
            // 'info': true,
            'responsive': true,
            'autoWidth': false
        })
    }); //* Script untuk memuat datatable
</script>
<script type="text/javascript">
    $('.btn-delete').on('click', function() {
        var getLink = $(this).attr('href');
        Swal.fire({
            title: 'Hapus Data',
            text: 'Yakin ingin menghapus data?',
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
    }); //* Script untuk memuat sweetalert hapus data
</script>
<script>
    //* Script untuk memuat sweetalert status genset
    // $('.btn-kembali').on('click', function() {
    //     var getLink = $(this).attr('href');
    //     Swal.fire({
    //         title: 'Ubah Status',
    //         text: 'Yakin ingin ubah Status Genset menjadi Genset Masuk (Kembali)?',
    //         type: 'warning',
    //         confirmButtonColor: '#d9534f',
    //         showCancelButton: true,
    //     }).then(result => {
    //         //jika klik ya maka arahkan ke proses.php
    //         if (result.isConfirmed) {
    //             window.location.href = getLink
    //         }
    //     })
    //     return false;
    // });
</script>
</body>

</html>
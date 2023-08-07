<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Jadwal Penyewaan Genset</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/tabel_jdw_genset'); ?>">Jadwal Penyewaan Genset</a></li>
                        <li class="breadcrumb-item active">Detail Data </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row tengah">
                <div class="col-md-5 ">
                    <div class="card">
                        <div class="card-header">
                            Kirim Data Jadwal Penyewaan Genset
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissable">
                                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>
                            <?php if (validation_errors()) { ?>
                                <div class="alert alert-warning alert-dismissable">
                                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                    <strong>Peringatan!</strong><br> <?php echo validation_errors(); ?>
                                </div>
                            <?php } ?>
                            <!-- <?php foreach ($list_data as $d) : ?>

                                <table class="table">
                                    <tr>
                                        <th style="vertical-align: middle">Operator</th>
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
                                        <th style="vertical-align: middle">Mobil Angkut</th>
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
                                        <th style="vertical-align: middle">Dipakai Tanggal</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;<?= date('d-m-Y', strtotime($d->tgl_keluar)); ?></div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle">Sampai Tanggal</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;<?= date('d-m-Y', strtotime($d->tgl_masuk)); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle">Lokasi</th>
                                        <form action="<?= site_url('admin/proses_update_ket_service'); ?>" method="post" role="form">
                                            <td style="vertical-align: middle;">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <div class="row">
                                                            :&nbsp;<?= $d->lokasi; ?>
                                                        </div>

                                                    </div>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle">Keterangan</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;<?= $d->keterangan; ?></div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </table> -->
                            <form action="<?= base_url('admin/kirim_jdw_genset'); ?>" method="post" role="form" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="genset" class="form-label">Kepada</label>
                                    <input type="email" name="email_penerima" class="form-control" id="email_penerima">
                                </div>
                                <div class="form-group">
                                    <label for="genset" class="form-label">Subjek</label>
                                    <input type="text" name="subjek" class="form-control" id="subjek" value="Jadwal Penyewaan Genset">
                                </div>
                                <?php foreach ($notifJdw as $ed) : ?>
                                    <!-- <input type="hidden" name="id_jadwal_genset" value="<?= $ed->id_jadwal_genset; ?>"> -->
                                    <div class="form-group">


                                        <label class="form-label">Pesan</label><br />
                                        <textarea name="pesan" placeholder="Pesan" class="form-control" rows="8">Pemberitahuan Jadwal Penyewaan Genset Operator [<?= $ed->nama_op; ?>], Genset [<?= $ed->nama_genset; ?>], Mobil [<?= $ed->merek; ?>], Berangkat Pada Tanggal [<?= date('d-m-Y', strtotime($ed->tgl_keluar)); ?>], Lokasi di [<?= $ed->lokasi; ?>], dengan Keterangan [<?= $ed->keterangan; ?>].</textarea>
                                    </div>
                                <?php endforeach ?>


                                <hr />
                                <button type="submit">KIRIM EMAIL</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
<?php $this->load->view('template/footer'); ?>

<?php $this->load->view('template/script') ?>
<script>
    // $("#id_transaksi").change(function() {
    //     let id_transaksi = $(this).val();
    //     // let stok_gd = document.getElementById("stok_gd");

    //     <?php foreach ($list_data as $s) { ?>
    //         if (id_transaksi == "<?php echo $s->id_u_sewa ?>") {

    //             $("#tanggal_keluar").val("<?php echo date('d-m-Y', strtotime($s->tanggal_keluar)) ?>");
    //             $("#tanggal_masuk").val("<?php echo date('d-m-Y', strtotime($s->tanggal_masuk)) ?>");
    //             $("#nama_plg").val("<?php echo $s->nama_plg ?>");

    //         }
    //     <?php } ?>
    // })
</script>
</body>

</html>
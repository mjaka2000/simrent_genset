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
                            Kirim Data Pengembalian Genset
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

                            <form action="<?= base_url('admin/kirim_unit_keluar'); ?>" method="post" role="form" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="genset" class="form-label">Kepada</label>
                                    <input type="email" name="email_penerima" class="form-control" id="email_penerima">
                                </div>
                                <div class="form-group">
                                    <label for="genset" class="form-label">Subjek</label>
                                    <input type="text" name="subjek" class="form-control" id="subjek" value="Jadwal Pengambilan Genset">
                                </div>
                                <?php foreach ($notifOut as $ed) : ?>
                                    <!-- <input type="hidden" name="id_jadwal_genset" value="<?= $ed->id_jadwal_genset; ?>"> -->
                                    <div class="form-group">


                                        <label class="form-label">Pesan</label><br />
                                        <textarea name="pesan" placeholder="Pesan" class="form-control" rows="8">Pemberitahuan Pengambilan Genset dengan ID Transaksi [<?= $ed->id_transaksi; ?>], Nama Pelanggan [<?= $ed->nama_plg; ?>], Genset [<?= $ed->nama_genset; ?>], Pada Tanggal [<?= date('d-m-Y', strtotime($ed->tanggal_masuk)); ?>], Lokasi di [<?= $ed->lokasi; ?>].</textarea>
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

<?php $this->load->view('admin/template/script') ?>
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
<?php $this->load->view('template/head'); ?>
<?php $this->load->view('teknisi/template/nav'); ?>
<?php $this->load->view('teknisi/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Genset</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('teknisi'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Genset</li>
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
                            Data Genset
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>

                            <!-- <button onclick="window.location.href='<?= site_url('teknisi/tambah_genset'); ?>'" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-primary" name="tambah_data"><i class="fa fa-plus"></i>&nbsp;Tambah Data</button> -->

                            <table id="examplejk" class="table table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width :10px">No.</th>
                                        <th>Nomor Genset</th>
                                        <th>Nama Genset</th>
                                        <th>Daya (KVA)</th>
                                        <th>Harga Perhari</th>
                                        <th>Ket. Genset</th>
                                        <!-- <th>Unit Disewakan</th> -->
                                        <th>Gambar</th>
                                        <th style="width:10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (is_array($list_data)) { ?>
                                        <?php foreach ($list_data as $d) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $d->kode_genset; ?></td>
                                                <td><?= $d->nama_genset; ?></td>
                                                <td><?= $d->daya; ?></td>
                                                <td>Rp&nbsp;<?= number_format($d->harga); ?></td>
                                                <?php if ($d->ket_genset == 0) { ?>
                                                    <td><span class="badge badge-success">Genset Ada </span></td>
                                                <?php } elseif ($d->ket_genset == 1) { ?>
                                                    <td><span class="badge badge-danger"> Genset Sedang Disewa</span></td>
                                                <?php } else { ?>
                                                    <td><span class="badge badge-warning"> Genset Dijadwalkan</span></td>
                                                <?php } ?>
                                                <td><img src="<?= base_url('assets/upload/genset/' . $d->gambar_genset); ?>" title="Lihat Gambar Genset" data-toggle="modal" data-target="#LihatGst<?= $d->id_genset; ?>" class="img img-box" width="100" height="100" alt="<?= $d->gambar_genset; ?>"></td>
                                                <td>
                                                    <a href="<?= site_url('teknisi/detail_genset/' . $d->id_genset); ?>" title="Lihat Detail" type="button" class="btn btn-sm btn-warning" name="btn_edit"><i class="fa fa-eye"></i></a>
                                                    <!-- <a href="<?= site_url('teknisi/update_genset/' . $d->id_genset); ?>" type="button" class="btn btn-sm btn-info" name="btn_edit"><i class="fa fa-edit"></i></a>
                                                    <a href="<?= site_url('teknisi/hapus_data_genset/' . $d->id_genset); ?>" type="button" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash"></i></a> -->
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php foreach ($list_data as $d) : ?>
                        <div class="modal fade" id="LihatGst<?= $d->id_genset; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="staticBackdropLabel">Lihat Gambar Genset</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body tengah">
                                        <a href="<?= base_url('assets/upload/genset/' . $d->gambar_genset); ?>" download>
                                            <img src="<?= base_url('assets/upload/genset/' . $d->gambar_genset); ?>" class="img img-box" width="350" height="350" alt="<?= $d->gambar_genset; ?>">
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
</body>

</html>
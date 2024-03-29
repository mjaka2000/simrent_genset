<?php $this->load->view('template/head'); ?>
<?php $this->load->view('pimpinan/template/nav'); ?>
<?php $this->load->view('pimpinan/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Mobil</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('pimpinan'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Mobil</li>
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
                            Data Mobil
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>

                            <!-- <button onclick="window.location.href='<?= site_url('pimpinan/tambah_data_mobil'); ?>'" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-primary" name="tambah_data"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Data</button> -->

                            <table id="examplejk" class="table table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width :10px">No.</th>
                                        <th>Merek</th>
                                        <th>Tipe</th>
                                        <th>Tahun</th>
                                        <th>Nopol</th>
                                        <th>Jenis BBM</th>
                                        <th>Pajak </th>
                                        <th>STNK </th>
                                        <th>Gambar</th>
                                        <!-- <th style="width:10%">Aksi</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    // $list_data = isset($_POST['list_data']) ? $_POST['list_data'] : '';
                                    if (is_array($list_data)) {
                                    ?>
                                        <?php foreach ($list_data as $dt) :
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $dt->merek; ?></td>
                                                <td><?= $dt->tipe; ?></td>
                                                <td><?= $dt->tahun; ?></td>
                                                <td><?= $dt->nopol; ?></td>
                                                <td><?= $dt->jenis_bbm; ?></td>
                                                <td><?= date('d-m-Y', strtotime($dt->pajak)); ?></td>
                                                <td><?= date('d-m-Y', strtotime($dt->stnk)); ?></td>
                                                <td><img src="<?= site_url('assets/upload/mobil/' . $dt->gambar_mobil); ?>" title="Lihat Gambar Mobil" data-toggle="modal" data-target="#LihatMbl<?= $dt->id_mobil; ?>" class="img-box" width="100" height="100" alt="<?= $dt->gambar_mobil; ?>"></td>
                                                <!-- <td> -->
                                                <!-- <a href="<?= site_url('pimpinan/update_data_mobil/' . $dt->id_mobil); ?>" type="button" class="btn btn-sm btn-info" name="btn_edit"><i class="fa fa-edit "></i></a> -->
                                                <!-- <a href="<?= site_url('pimpinan/hapus_mobil/' . $dt->id_mobil); ?>" type="button" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash "></i></a> -->
                                                <!-- <a href="<?= site_url('pimpinan/'); ?>" type="button" class="btn btn-xs btn-warning" name="btn_detail"><i class="fa fa-info-circle "></i></a> -->
                                                <!-- </td> -->
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php foreach ($list_data as $d) : ?>
                        <div class="modal fade" id="LihatMbl<?= $d->id_mobil; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="staticBackdropLabel">Lihat Gambar Mobil</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body tengah">
                                        <a href="<?= base_url('assets/upload/mobil/' . $d->gambar_mobil); ?>" download>
                                            <img src="<?= base_url('assets/upload/mobil/' . $d->gambar_mobil); ?>" class="img img-box" width="350" height="350" alt="<?= $d->gambar_mobil; ?>">
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
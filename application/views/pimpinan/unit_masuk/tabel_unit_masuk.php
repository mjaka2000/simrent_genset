<?php $this->load->view('template/head'); ?>
<?php $this->load->view('pimpinan/template/nav'); ?>
<?php $this->load->view('pimpinan/template/sidebar'); ?>

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
                        <li class="breadcrumb-item"><a href="<?= site_url('pimpinan'); ?>"><i class="fas fa-home"></i></a></li>
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
                            <!-- <button onclick="window.location.href='<?= site_url('pimpinan/tambah_unit_keluar'); ?>'" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-primary" name="tambah_data"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Data</button> -->

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
                                            <?php if ($dt->status == NULL || $dt->status == 0) { ?>
                                                <td>Genset Masuk (Kembali)
                                                </td>
                                            <?php } else { ?>
                                                <td>Genset Masuk (Kembali)</td>
                                            <?php } ?>
                                            <td>
                                                <a href="<?= base_url('pimpinan/hapus_unit_masuk/' . $dt->id_u_masuk); ?>" type="button" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash "></i></a>
                                                <a href="<?= base_url('pimpinan/detail_unit_masuk/' . $dt->id_u_masuk); ?>" type="button" class="btn btn-sm btn-warning" name="btn_detail"><i class="fa fa-info-circle "></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="box-footer">
                                <?php foreach ($total_data as $td) : ?>
                                    <h5>
                                        <p style="color: red;">Total Pendapatan: Rp&nbsp;<?= number_format($td->total); ?></p>
                                    </h5>
                                <?php endforeach; ?>
                                <!-- <h5><strong>Keterangan :</strong></h5> -->
                                <!-- <a href="#" type="button" class="btn btn-sm btn-info" name="btn_edit"><i class="fa fa-edit "></i></a>&nbsp;<span>Untuk Mengedit Data</span><br> -->
                                <!-- <a href="#" type="button" class="btn btn-sm btn-danger" name="btn_delete"><i class="fa fa-trash "></i></a>&nbsp;<span>Untuk Menghapus Data</span><br> -->
                                <!-- <a href="#" type="button" class="btn btn-sm btn-warning" name="btn_detail"><i class="fa fa-info-circle "></i></a>&nbsp;<span>Untuk Melihat Detail </span> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
<?php $this->load->view('template/footer'); ?>

<?php $this->load->view('pimpinan/template/script') ?>
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
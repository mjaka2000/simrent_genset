<?php $this->load->view('template/head'); ?>
<?php $this->load->view('pimpinan/template/nav'); ?>
<?php $this->load->view('pimpinan/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Perbaikan Genset</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('pimpinan'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Perbaikan Genset</li>
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
                            Data Perbaikan Genset
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>

                            <!-- <button onclick="window.location.href='<?= site_url('pimpinan/tambah_service_genset'); ?>'" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-primary" name="tambah_data"><i class="fa fa-plus"></i>&nbsp;Tambah Data</button> -->

                            <table id="examplejk" class="table table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width :10px">No.</th>
                                        <th>Nomor Genset</th>
                                        <th>Nama Genset</th>
                                        <th>Jenis Perbaikan</th>
                                        <th>Spare Part (Diganti)</th>
                                        <th>Tgl. Perbaikan</th>
                                        <th>Ket. Perbaikan</th>
                                        <th>Biaya Perbaikan</th>
                                        <th style="width:10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (is_array($list_data)) { ?>
                                        <?php foreach ($list_data as $dt) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $dt->kode_genset; ?></td>
                                                <td><?= $dt->nama_genset; ?></td>
                                                <td><?= $dt->jenis_perbaikan; ?></td>
                                                <td><?= $dt->nama_sparepart; ?></td>
                                                <td><?= date('d-m-Y', strtotime($dt->tgl_perbaikan)); ?></td>
                                                <?php if ($dt->ket_perbaikan == "1") { ?>
                                                    <td><a href="#" type="button" class="btn btn-xs btn-success">Selesai Diperbaiki</a></td>
                                                <?php } else { ?>
                                                    <td><a href="#" type="button" class="btn btn-xs btn-danger">Masih Proses</a></td>
                                                <?php } ?>
                                                <td>Rp&nbsp;<?= number_format($dt->biaya_perbaikan); ?></td>
                                                <td>
                                                    <!-- <a href="<?= base_url('pimpinan/update_data_service_genset/' . $dt->id_perbaikan_gst); ?>" type="button" class="btn btn-sm btn-info" name="btn_edit"><i class="fa fa-edit"></i></a> -->
                                                    <!-- <a href="<?= base_url('pimpinan/hapus_service_genset/' . $dt->id_perbaikan_gst); ?>" type="button" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash"></i></a> -->
                                                    <a href="<?= base_url('pimpinan/detail_service_genset/' . $dt->id_perbaikan_gst); ?>" type="button" title="Lihat Detail" class="btn btn-sm btn-warning" name="btn_detail"><i class="fa fa-info-circle "></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
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
<!-- <script type="text/javascript">
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
</script> -->
<script>
    //setting datatables
    // $('#tableserv').DataTable({
    // "language": {
    //     "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
    // },
    // "autoWidth": false,
    // "responsive": true,
    // "processing": true,
    // "serverSide": true,
    // "order": [],
    // "ajax": {
    //panggil method ajax list dengan ajax
    //         "url": '<?= site_url('pimpinan/ajax_list_serv'); ?>',
    //         "type": "POST"
    //     }
    // });
</script>
<script type="text/javascript">
    $('#tableserv').on('click', '.btn-delete', function() {
        var getLink = $(this).attr('href');
        // var id = $(this).data('id_pemakai');
        Swal.fire({
            title: 'Hapus Data',
            text: 'Yakin ingin menghapus data?',
            type: 'warning',
            confirmButtonColor: '#d9534f',
            showCancelButton: true,
        }).then(result => {
            if (result.isConfirmed) {
                window.location.href = getLink
            }
        })
        return false;
    });

    //* Script untuk memuat sweetalert hapus data
</script>
</body>

</html>
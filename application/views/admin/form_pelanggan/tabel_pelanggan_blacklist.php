<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Data Pelanggan Blacklist</h1>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item">Data Pelanggan</li>
            <li class="breadcrumb-item active">Data Pelanggan Blacklist</li>
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
                        <h3 class="box-title">&nbsp;Data Pelanggan Blacklist</h3>
                    </div>
                    <div class="box-body">
                        <?php if ($this->session->flashdata('msg_sukses')) { ?>
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                            </div>
                        <?php } ?>
                        <!-- <a href="<?= base_url('admin/tambah_data_pelanggan'); ?>" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-primary" name="tambah_data"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Data</a>&nbsp; -->
                        <!-- <a style="margin-bottom:10px;" onclick="history.back(-1)" type="button" class="btn btn-sm btn-default" name="blacklist_data"><i class="fa fa-reply"></i>&nbsp;Kembali</a> -->
                        <a style="margin-bottom:10px;" href="<?= base_url('admin/tabel_pelanggan'); ?>" type="button" class="btn btn-sm btn-default" name="blacklist_data"><i class="fa fa-reply"></i>&nbsp;Kembali</a>

                        <table id="mytable" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width :10px">No.</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No. HP</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Nama Perusahaan</th>
                                    <!-- <th>Tanggal Update</th> -->
                                    <th style="width:10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                // $list_data = isset($_POST['list_data']) ? $_POST['list_data'] : '';
                                if (is_array($list_pelanggan_blacklist)) { ?>
                                    <?php foreach ($list_pelanggan_blacklist as $dt) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $dt->nama; ?></td>
                                            <td><?= $dt->alamat; ?></td>
                                            <td><?= $dt->no_hp; ?></td>
                                            <td><?= $dt->jenis_kelamin; ?></td>
                                            <td><?= $dt->nama_perusahaan; ?></td>
                                            <!-- <td><?= $dt->tanggal_update; ?></td> -->
                                            <td>
                                                <!-- <a href="<?= base_url('admin/update_data_pelanggan/' . $dt->id_plg_blacklist); ?>" type="button" class="btn btn-sm btn-info" name="btn_edit"><i class="fa fa-edit mr-2"></i></a> -->
                                                <!-- <a href="<?= base_url('admin/kembalikan_pelanggan/' . $dt->id_plg_blacklist); ?>" type="button" class="btn btn-sm btn-warning" name="btn_delete"><i class="fa fa-history"></i></a> -->
                                                <a href="<?= base_url('admin/hapus_pelanggan_blacklist/' . $dt->id_plg_blacklist); ?>" type="button" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash mr-2"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div class="box-footer">
                            <!-- <h5><strong>Keterangan :</strong></h5> -->
                            <!-- <a href="#" type="button" class="btn btn-sm btn-info" name="btn_edit"><i class="fa fa-edit mr-2"></i></a>&nbsp;<span>Untuk Mengedit Data</span><br> -->
                            <!-- <a href="#" type="button" class="btn btn-sm btn-danger" name="btn_delete"><i class="fa fa-trash mr-2"></i></a>&nbsp;<span>Untuk Menghapus Data</span><br> -->
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
    $('.btn-plg').on('click', function() {
        var getLink = $(this).attr('href');
        Swal.fire({
            title: 'Ubah Status',
            text: 'Yakin ingin ubah Status Pelanggan menjadi Blacklist?',
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
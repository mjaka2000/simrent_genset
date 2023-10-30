<?php $this->load->view('template/head'); ?>
<?php $this->load->view('pimpinan/template/nav'); ?>
<?php $this->load->view('pimpinan/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Lama Pemakaian Genset yang di service</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('pimpinan'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Lama Pemakaian Genset yang di service</li>
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
                            Data Lama Pemakaian Sewa Genset yang akan di service
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>
                            <!-- <button onclick="window.location.href='<?= site_url('pimpinan/email_jdw_genset'); ?>'" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-primary" name="tambah_data"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Data</button> -->
                            <button data-toggle="modal" data-target="#service_genset_masuk" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-success" name="KeluarBulanan"><i class="fa fa-filter"></i>&nbsp;Filter</button>

                            <table id="examplejk" class="table table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <?php foreach ($total_data as $td) : ?>
                                            <th colspan="8" style="text-align: center;"><?php echo $label ?><br> Total Pemakaian : <span style="color: red;"><?= $td->jumlah_hari; ?> Hari (<?= $td->jumlah_hari * 24; ?> Jam) Pemakaian</span></th>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <th style="width :10px">No.</th>
                                        <th>Nomor Genset</th>
                                        <th>Nama Genset</th>
                                        <th>Daya</th>
                                        <th>Lama Pakai</th>
                                        <th>Tanggal Pemakaian</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    ?>
                                    <?php foreach ($list_data as $dt) :
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $dt->kode_genset; ?></td>
                                            <td><?= $dt->nama_genset; ?></td>
                                            <td><?= $dt->daya; ?> KVA</td>
                                            <td><?= $dt->jumlah_hari; ?> Hari</td>
                                            <td><?= date('d-m-Y', strtotime($dt->tanggal_masuk)); ?></td>
                                            <td><?= $dt->ket_det_pakai_genset; ?></td>
                                        </tr>
                                    <?php endforeach;
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade" id="service_genset_masuk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">Filter Pertanggal</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>


                                </div>
                                <div class="modal-body">
                                    <form action="<?= site_url('pimpinan/tabel_service_genset_masuk'); ?>" method="get" role="form">
                                        <div class="form-group row">
                                            <label for="bulan" class="col-sm-3 col-form-label">Genset</label>
                                            <div class="col-sm-6">
                                                <select name="genset" id="bulan" class="form-control">
                                                    <option value="" selected="" disabled>--Pilih Genset--</option>
                                                    <?php foreach ($list_genset as $g) { ?>
                                                        <option value="<?= $g->kode_genset; ?>"><?= $g->kode_genset; ?> - <?= $g->nama_genset; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tahun" class="col-sm-3 col-form-label">Dari Tanggal</label>
                                            <div class="col-sm-6">
                                                <input type="date" name="tgl_awal" class="form-control" id="tgl_awal" value="<?= date('Y-m-d'); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tahun" class="col-sm-3 col-form-label">Ke Tanggal</label>
                                            <div class="col-sm-6">
                                                <input type="date" name="tgl_akhir" class="form-control" id="tgl_akhir" value="<?= date('Y-m-d'); ?>">
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success btn-sm">Tampilkan</button>
                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                </div>
                                </form>
                            </div>
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
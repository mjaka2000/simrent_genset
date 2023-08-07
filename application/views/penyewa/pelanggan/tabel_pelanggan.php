<?php $this->load->view('template/head'); ?>
<?php $this->load->view('penyewa/template/nav'); ?>
<?php $this->load->view('penyewa/template/sidebar');
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pelanggan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('penyewa'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Pelanggan</li>
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
            <div class="row tengah">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            Data Pelanggan
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>
                            <!--<button onclick="window.location.href='<?= site_url('penyewa/tabel_pelanggan_blacklist'); ?>'" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-default" name="blacklist_data">Data Pelanggan Blacklist</button> -->
                            <?php foreach ($list_pelanggan as $d) : ?>
                                <!-- <button onclick="window.location.href='<?= site_url('penyewa/update_data_pelanggan/' . $d->id_pelanggan); ?>'" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-primary" name="tambah_data"><i class="fa fa-edit mr-2" aria-hidden="true"></i>Ubah Data</button>&nbsp; -->
                                <button data-toggle="modal" data-target="#EditPlg<?= $d->id_pelanggan; ?>" class="btn btn-primary btn-sm" style="margin-bottom:10px;"><i class="fa fa-edit mr-2" aria-hidden="true"></i>Ubah Data</button>
                                <span><small style="color: red;">*Lengkapi data Anda dibawah ini!</small></span>
                                <table class="table" style="width:80%">
                                    <tr>
                                        <th style="vertical-align: middle">Nama</th>
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
                                        <th style="vertical-align: middle">Alamat</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;<?= $d->alamat_plg; ?> </div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle">No. HP</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;<?= $d->nohp_plg; ?> </div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle">Jenis Kelamin</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;<?php if ($d->jk_plg == 'L') { ?>
                                                        Laki - Laki
                                                    <?php } else { ?>
                                                        Perempuan
                                                    <?php } ?> </div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle">Nama Perusahaan</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;<?= $d->namaperusahaan_plg; ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle">Tanggal Update</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;<?= date('d-m-Y', strtotime($d->tglupdate_plg)); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                                </table>
                        </div>
                    </div>
                    <?php foreach ($list_pelanggan as $d) { ?>

                        <div class="modal fade" id="EditPlg<?= $d->id_pelanggan; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="staticBackdropLabel">Ubah Data Pelanggan</h6>
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
                                        <form action="<?= site_url('penyewa/proses_update_pelanggan'); ?>" method="post" role="form">
                                            <div class="form-group">
                                                <input type="hidden" name="id_pelanggan" value="<?= $d->id_pelanggan; ?>">
                                                <input type="hidden" name="id_user" value="<?= $d->id_user == $this->session->userdata('id_user'); ?>">
                                                <label for="nama" class="form-label">Nama</label>

                                                <input type="text" name="nama_plg" class="form-control" id="nama_plg" placeholder="Masukkan Nama" required value="<?= $d->nama_plg; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat" class="form-label">Alamat</label>

                                                <input type="text" name="alamat_plg" class="form-control" id="alamat_plg" placeholder="Masukkan Alamat" required value="<?= $d->alamat_plg; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="no_hp" class="form-label">No. HP</label>

                                                <input type="text" maxlength="13" name="nohp_plg" class="form-control" id="nohp_plg" placeholder="Masukkan No. HP" required onkeypress='return (event.charCode > 47 && event.charCode < 58)' value="<?= $d->nohp_plg; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>

                                                <select name="jk_plg" id="jk_plg" class="form-control">
                                                    <option value="" disabled>-- Pilih --</option>
                                                    <?php if ($d->jk_plg == 'L') { ?>
                                                        <option value="L" selected>Laki-Laki</option>
                                                        <option value="P">Perempuan</option>
                                                    <?php } else { ?>
                                                        <option value="L">Laki-Laki</option>
                                                        <option value="P" selected>Perempuan</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>

                                                <input type="text" name="namaperusahaan_plg" class="form-control" id="nama_perusahaan" placeholder="Nama Perusahaan" required value="<?= $d->namaperusahaan_plg; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="tgl_update" class="form-label">Tanggal Update</label>

                                                <input type="date" name="tglupdate_plg" class="form-control" id="tanggal_update" placeholder="Tanggal Update" required value="<?= $d->tglupdate_plg; ?>">
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-arrow-left mr-2"></i>Kembali</button>
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check mr-2"></i>Submit</button>
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

<?php $this->load->view('penyewa/template/script') ?>
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
<script>
    //* Script untuk memuat sweetalert status pelanggan
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
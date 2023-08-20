<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

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
                        <li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
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
                            <?php if ($this->session->flashdata('msg_gagal')) { ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                    <strong>Gagal!</strong><br> <?= $this->session->flashdata('msg_gagal'); ?>
                                </div>
                            <?php } ?>
                            <button data-toggle="modal" data-target="#staticAddMobil" class="btn btn-primary btn-sm" style="margin-bottom:10px;"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Data</button>

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
                                        <th style="width:10%">Aksi</th>
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
                                                <td><img src="<?= site_url('assets/upload/mobil/' . $dt->gambar_mobil); ?>" class="img-box" width="100" height="100" alt="<?= $dt->gambar_mobil; ?>"></td>
                                                <td>
                                                    <button type="button" data-toggle="modal" data-target="#staticEditMobil<?= $dt->id_mobil; ?>" title="Edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                                                    <a href="<?= site_url('admin/hapus_data_mobil/' . $dt->id_mobil); ?>" type="button" title="Hapus" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash "></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade" id="staticAddMobil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">Tambah Data Mobil</h6>
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

                                    <form action="<?= site_url('admin/proses_tambah_mobil'); ?>" method="post" role="form" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label for="merek" class="form-label">Merek</label>

                                            <input type="text" name="merek" class="form-control" id="merek" placeholder="Merek" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tipe" class="form-label">Tipe</label>

                                            <input type="text" name="tipe" class="form-control" id="tipe" placeholder="Tipe" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tahun" class="form-label">Tahun</label>

                                            <input type="text" name="tahun" maxlength="4" class="form-control" id="tahun" placeholder="Tahun" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nopol" class="form-label">Nopol</label>

                                            <input type="nopol" name="nopol" class="form-control" id="nopol" placeholder="Nopol" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_bbm" class="form-label">Jenis BBM</label>

                                            <select name="jenis_bbm" id="jenis_bbm" class="form-control">
                                                <option value="">-- Pilih Jenis BBM --</option>
                                                <option value="Bensin">Bensin</option>
                                                <option value="Solar">Solar</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="pajak" class="form-label">Pajak&nbsp;<span style="color: red;"><small>*1 Th</small></span></label>

                                            <input type="date" name="pajak" class="form-control form_datetime" id="pajak" placeholder="Pajak" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="stnk" class="form-label">STNK&nbsp;<span style="color: red;"><small>*5 Th</small></span></label>

                                            <input type="date" name="stnk" class="form-control form_datetime" id="stnk" placeholder="STNK" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="gambar_mobil" class="form-label">Gambar Mobil</label>

                                            <input type="file" name="gambar_mobil" class="form-control" id="gambar_mobil">
                                            <small style="color: red;">
                                                <p>*File yang diijinkan "jpg|png|jpeg", max size 2MB.</p>
                                            </small>
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
                    <?php foreach ($list_data as $m) { ?>

                        <div class="modal fade" id="staticEditMobil<?= $m->id_mobil; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="staticBackdropLabel">Ubah Data Mobil</h6>
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
                                        <form action="<?= site_url('admin/proses_update_mobil'); ?>" method="post" role="form" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="<?= $m->id_mobil; ?>">
                                                <label for="merek" class="form-label">Merek</label>

                                                <input type="text" name="merek" class="form-control" id="merek" placeholder="Merek" required value="<?= $m->merek; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="tipe" class="form-label">Tipe</label>

                                                <input type="text" name="tipe" class="form-control" id="tipe" placeholder="Tipe" required value="<?= $m->tipe; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="tahun" class="form-label">Tahun</label>

                                                <input type="text" name="tahun" maxlength="4" class="form-control" id="tahun" placeholder="Tahun" required value="<?= $m->tahun; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="nopol" class="form-label">Nopol</label>

                                                <input type="nopol" name="nopol" class="form-control" id="nopol" placeholder="Nopol" required value="<?= $m->nopol; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_bbm" class="form-label">Jenis BBM</label>

                                                <select name="jenis_bbm" id="jenis_bbm" class="form-control">
                                                    <option value="">-- Pilih Jenis BBM --</option>

                                                    <?php if ($m->jenis_bbm == "Bensin") { ?>
                                                        <option value="Bensin" selected>Bensin</option>
                                                        <option value="Solar">Solar</option>
                                                    <?php } else { ?>
                                                        <option value="Bensin">Bensin</option>
                                                        <option value="Solar" selected>Solar</option>
                                                    <?php } ?>

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="pajak" class="form-label">Pajak&nbsp;<span style="color: red;"><small>*1 Th</small></span></label>

                                                <input type="date" name="pajak" class="form-control form_datetime" id="pajak" placeholder="Pajak" required value="<?= $m->pajak; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="stnk" class="form-label">STNK&nbsp;<span style="color: red;"><small>*5 Th</small></span></label>

                                                <input type="date" name="stnk" class="form-control form_datetime" id="stnk" placeholder="STNK" required value="<?= $m->stnk; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="gambar_mobil" class="form-label">Gambar Mobil</label>

                                                <input type="file" name="gambar_mobil" class="form-control" id="gambar_mobil">
                                                <input type="hidden" name="gambar_mobil_old" value="<?= $m->gambar_mobil; ?>">
                                                <small style="color: red;">
                                                    <p>*File yang diijinkan "jpg|png|jpeg", max size 2MB.</p>
                                                </small>
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
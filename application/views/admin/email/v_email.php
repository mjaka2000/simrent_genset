<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Email</h1>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Email</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
        <div id="loading">
            <img src="<?= base_url(); ?>assets/style/loading.gif" alt="loading" width="50%">
        </div>
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row tengah">
                <div class="col-md-5 ">
                    <div class="card">
                        <div class="card-header">
                            Kirim Email dengan Framework Codeigniter
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

                            <form action="<?= base_url('admin/kirim'); ?>" method="post" role="form" enctype="multipart/form-data">

                                <div style="margin-bottom: 10px;">
                                    <label>Kepada</label><br />
                                    <!-- <select name="email_penerima" class="form-control" id="email_penerima" required>
                                        <option value="" selected disabled>-- Pilih Email --</option>
                                        <?php foreach ($list_email as $g) { ?>
                                            <option value="<?= $g->email; ?>"><?= $g->email; ?></option>
                                        <?php } ?>
                                    </select> -->
                                    <input type="email" name="email_penerima" placeholder="Email Penerima" style="margin-top: 5px;width: 400px" />
                                </div>
                                <div style="margin-bottom: 10px;">
                                    <label>Subjek</label><br />
                                    <input type="text" name="subjek" placeholder="Subjek" style="margin-top: 5px;width: 400px" />
                                </div>
                                <div style="margin-bottom: 10px;">
                                    <label>Pesan</label><br />
                                    <textarea name="pesan" placeholder="Pesan" rows="8" style="margin-top: 5px;width: 400px"></textarea>
                                </div>
                                <div style="margin-bottom: 20px;">
                                    <label>Attachment</label><br />
                                    <input type="file" name="attachment" style="margin-top: 5px;width: 400px" />
                                </div>

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
</body>

</html>
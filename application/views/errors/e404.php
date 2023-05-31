<?php $this->load->view('template/head-top-nav'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            404 Error Page
        </h1>
    </section>

    <section class="content">
        <div class="error-page">
            <h2 class="headline text-yellow">404</h2>

            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>
                <p>🙏Maaf, halaman yang anda cari tidak ditemukan. Silahkan <a href="#" onclick="history.back(-1)">kembali</a> ke halaman sebelumnya. 🙏</p>
            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>
</div>

<!-- jQuery 3 -->
<script src="<?= base_url(); ?>assets/admin2/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url(); ?>assets/admin2/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?= base_url(); ?>assets/admin2/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url(); ?>assets/admin2/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>assets/admin2/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
</body>

</html>
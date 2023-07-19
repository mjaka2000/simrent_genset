<html>

<head>
    <title>Kirim Email dengan CodeIgniter</title>
</head>

<body>
    <div style="padding: 5px 30px;">
        <h1>Kirim Email dengan Framework Codeigniter</h1>
        <hr />

        <?php echo form_open('admin/send', ['method' => 'post', 'enctype' => 'multipart/form-data']) ?>
        <div style="margin-bottom: 10px;">
            <label>Kepada</label><br />
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
        <?php echo form_close() ?>
        <button type="button" onclick="window.location.href='<?= site_url('admin') ?>'">back</button>
    </div>
</body>

</html>
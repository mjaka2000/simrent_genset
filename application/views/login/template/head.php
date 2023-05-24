<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIMRENT Genset Web | <?= $title; ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin32/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin32/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin32/dist/css/adminlte.min.css">

  <link rel="stylesheet" href="<?= base_url() ?>assets/style/style.css">
  <link rel="icon" href="<?= base_url(); ?>assets/style/logo/ws-w.png">

  <style>
    body {
      font-family: "Open Sans", sans-serif;
      height: 100vh;
      /* background: url("<?= base_url(''); ?>assets/style/ws-1.jpg") 50% fixed; */
      /* background-size: cover; */
    }

    .wrapper {
      display: flex;
      align-items: center;
      flex-direction: column;
      justify-content: center;
      width: 100%;
      height: 100%;
      padding: 50px;
      background: rgba(4, 40, 68, 0.85);
      text-align: center;
    }

    .auth-bg {
      background-image: url("<?= base_url(''); ?>assets/style/ws-1.jpg");
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      /* height: 100%; */
      /* width: 100%; */
      /* display: table; */
      /* vertical-align: middle; */
    }

    .button {
      width: 100%;
      height: 100%;
      padding: 10px 10px;
      background: #2196F3;
      color: #fff;
      display: block;
      border: none;
      margin-top: 20px;
      position: absolute;
      left: 0;
      bottom: 0;
      max-height: 50px;
      border: 0px solid rgba(0, 0, 0, 0.1);
      border-radius: 0 0 2px 2px;
      transform: rotateZ(0deg);
      transition: all 0.1s ease-out;
      border-bottom-width: 5px;
    }

    .button:hover {
      box-shadow: 0px 1px 3px #fff;
    }
  </style>
</head>
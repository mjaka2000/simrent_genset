<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/style/paper.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/style/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admin32/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admin32/dist/css/adminlte.min.css">
    <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/style/style-rep.css"> -->

    <style>
        @page {
            size: A4
        }

        /* h4 {
            font-weight: bold;
            font-size: 13pt;
            text-align: center;
        } */

        table {
            border-collapse: collapse;
            /* width: 100%; */
        }

        .table th {
            padding: 8px 8px;
            /* border: 1px solid #000000; */
            text-align: left;

        }

        .table td {
            padding: 3px 3px;
            /* border: 1px solid #000000; */
        }

        .text-center {
            text-align: center;
        }

        .horizontal_center {
            border-top: 3px solid black;
            height: 2px;
            line-height: 30px;
        }

        .kanan {
            float: right;
        }
    </style>
</head>

<body class="A4">
    <section class="sheet padding-10mm">
        <table border="0">
            <tr>
                <th align="left">
                    <img src="<?= base_url() ?>assets/style/logo/KOP_SURAT_WARDAH_SOLUTION.png" alt="" width="100%">
                </th>
                <!-- <th>
                    <p align="center" style="font-family:Arial; font-size:15pt"> PT. RAHMAT TAUFIK RAMADAN </p>
                </th> -->
            </tr>
            <tr>
                <td align="right">
                    <hr>
                    <!-- <small>Tanggal Dicetak: <?= format_indo(date('Y-m-d')); ?></small> -->
                </td>
            </tr>
        </table>
        <h2 align="center">Laporan Grafik Pendapatan Bulanan </h2><span>
            <!-- <p align="right" style="font-size:10pt">Tanggal Dicetak: <?= format_indo(date('Y-m-d')); ?></p> -->
        </span>
        <!-- <?php echo $label ?> -->
        <div class="row tengah">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Grafik Pendapatan <?= $label ?></h3>

                    <div class="card-tools">

                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="PendapatanChart" width="600" height="400" style="border:1px solid #000000;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <table class="kanan">
            <tr>
                <td><br><br><br><br><br><br><br></td>
                <td align="center">Banjarmasin, <?= format_indo(date('Y-m-d')); ?><br>Mengetahui,<br>Pimpinan</td>
            </tr>
            <tr>
                <td colspan="2" align="center">......................................</td>
            </tr>

        </table>
    </section>
    <!-- jQuery -->
    <script src="<?= base_url(); ?>assets/admin32/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>assets/admin32/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>assets/admin32/dist/js/adminlte.min.js"></script>
    <script src="<?= base_url(); ?>assets/admin32/plugins/chart.js/Chart.min.js"></script>
    <script>
        $(function() {
            //-------------
            //- LINE CHART -
            //--------------

            var ctx = document.getElementById('PendapatanChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        <?php
                        if (count($pendapatanChart) > 0) {
                            foreach ($pendapatanChart as $pd) {
                                echo "'" . date('d-m-Y', strtotime($pd->tanggal_masuk)) . "',";
                            }
                        }
                        ?>
                    ],
                    datasets: [{
                        label: 'Jumlah Pendapatan',
                        backgroundColor: '#ADD8E6',
                        borderColor: '##93C3D2',
                        data: [
                            <?php
                            if (count($pendapatanChart) > 0) {
                                foreach ($pendapatanChart as $data) {
                                    echo $data->total . ", ";
                                }
                            }
                            ?>
                        ]
                    }]
                },
            });

        })
    </script>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>
<?php
session_start();
require "function/functions.php";

// session dan cookie multilevel user
if (isset($_COOKIE['login'])) {
    if ($_COOKIE['level'] == 'user') {
        $_SESSION['login'] = true;
        $ambilNama = $_COOKIE['login'];
    } elseif ($_COOKIE['level'] == 'admin') {
        $_SESSION['login'] = true;
        header('Location: administrator');
    }
} elseif ($_SESSION['level'] == 'user') {
    $ambilNama = $_SESSION['user'];
} else {
    if ($_SESSION['level'] == 'admin') {
        header('Location: administrator');
        exit;
    }
}

if (empty($_SESSION['login'])) {
    header('Location: login');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="https://i.ibb.co.com/mGks4Ns/Desain-tanpa-judul-40.png">>
    <title>FinansialKu - Laporan</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styler.css?v=1.0">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-softy-pinko.css">
    <style>
        body {
            background-image: url('https://i.ibb.co.com/XsGRMtk/Game-Night-8.gif');
            background-size: cover;
            background-position: center;
        }

        .konten_dalem {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <script>
        $(".klik").click(function () {
            $(this).find('i').toggleClass('fa-caret-up fa-caret-right');
            if ($(".klik").not(this).find("i").hasClass("fa-caret-right")) {
                $(".klik").not(this).find("i").toggleClass('fa-caret-up fa-caret-right');
            }
        });
        $(".klik2").click(function () {
            $(this).find('i').toggleClass('fa-caret-up fa-caret-right');
            if ($(".klik2").not(this).find("i").hasClass("fa-caret-right")) {
                $(".klik2").not(this).find("i").toggleClass('fa-caret-up fa-caret-right');
            }
        });
    </script>
    <!-- change icon -->
    </ul>
    </nav>
    </div>

    <div class="main-content khusus">
        <div class="konten khusus2">
            <div class="konten_dalem khusus3">
                <h2 class="heade" style="color: #4b4f58;">Laporan</h2>
                <input type="hidden" id="username" value="<?= $ambilNama ?>">
                <hr style="margin-top: -2px;">

                <div class="table-responsive">
                    <table class="laporan">
                        <tr>
                            <td>Jenis laporan</td>
                            <td colspan="3">
                                <select id="jenis-laporan" class="form-control">
                                    <option value="pemasukkan">Pemasukkan</option>
                                    <option value="pengeluaran">Pengeluaran</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Pilih tanggal</td>
                            <td><input type="date" id="awal" class="form-control control"></td>
                            <td>sampai</td>
                            <td><input type="date" id="akhir" class="form-control control"></td>
                            <td colspan="2">
                                <div class="d-flex">
                                    <button class="btn btn-primary flex-grow-1 lapor">Tampilkan</button>
                                    <button type="button" class="btn btn-secondary flex-grow-1"
                                        style="margin-left: 10px;" onclick="location.href='dashboard1.php'">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="tampil"></div>

            </div>
        </div>
    </div>

    <script src="ajax/js/laporan.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>
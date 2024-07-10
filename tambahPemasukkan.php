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

if (isset($_POST["submit"])) {
    if (tambahMasuk($_POST) > 0) {
        echo "
                <script>
                    alert('data berhasil ditambahkan!');
                    document.location.href = 'pemasukkan';
                </script>
                ";
    } else {
        echo "
                <script>
                    alert('data gagal ditambahkan!');
                </script>
                ";
    }
}

$month = date('m');
$day = date('d');
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="https://i.ibb.co.com/mGks4Ns/Desain-tanpa-judul-40.png">
    <title>FinansialKu - Tambah Data</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styler.css?v=1.0">
    <link rel="stylesheet" href="css/tambah.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-softy-pinko.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <style>
        body {
            background-image: url('https://i.ibb.co.com/cgkT1pP/Game-Night-5.gif');
            background-size: cover;
            background-position: center;
        }

        .konten_isi {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="main-content">
        <div class="konten">
            <div class="konten_dalem">
                <h2 class="head" style="color: #ffffff;">Tambah Data Pemasukkan</h2>
                <hr style="margin-top: -5px;">
                <div class="container">
                    <div class="konten_isi">
                        <table class="table-sm">
                            <script type="text/javascript" src="js/pisahTitik.js"></script>
                            <form class="form-text" action="" method="post">
                                <tr>
                                    <td>Masukkan Tanggal Pemasukkan</td>
                                    <td>:</td>
                                    <td><input class="form-control" type="date" value="<?= $today ?>" name="tanggal"
                                            required></td>
                                </tr>
                                <tr>
                                    <td>Masukkan Keterangan Pemasukkan</td>
                                    <td>:</td>
                                    <td><input class="form-control" type="text" name="keterangan" autocomplete="off"
                                            required></td>
                                </tr>
                                <tr>
                                    <td>Masukkan Sumber Pemasukkan</td>
                                    <td>:</td>
                                    <td>
                                        <select name="sumber" class="form-control">
                                            <option>ATM</option>
                                            <option>Pemberian</option>
                                            <option>Piutang</option>
                                            <option>Laba penjualan</option>
                                            <option>Pekerjaan</option>
                                            <option>Lain - lain</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Masukkan Jumlah Pemasukkan</td>
                                    <td>:</td>
                                    <td><input class="form-control" type="text" name="jumlah" autocomplete="off"
                                            onkeydown="return numbersonly(this, event);"
                                            onkeyup="javascript:tandaPemisahTitik(this);" required></td>
                                </tr>
                                <tr>
                                    <td><input type="hidden" name="username" value="<?= $ambilNama ?>"></td>
                                    <td></td>
                                    <td>
                                        <center>
                                            <button class="btn btn-primary btn-block" type="submit" name="submit">Tambah
                                                Data</button>
                                            <a href="dashboard1.php" class="btn btn-secondary btn-block">
                                                <i class="fas fa-arrow-left"></i> Kembali
                                            </a>
                                        </center>
                                    </td>
                                </tr>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>
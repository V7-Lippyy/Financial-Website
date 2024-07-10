<?php
session_start();
require "function/functions.php";

// Session dan cookie multilevel user
if (isset($_COOKIE['login'])) {
    $_SESSION['login'] = true;
    $_SESSION['level'] = $_COOKIE['level'];
    $_SESSION['user'] = $_COOKIE['login'];

    if ($_COOKIE['level'] == 'admin') {
        header('Location: administrator');
        exit;
    }
} elseif (!isset($_SESSION['login']) || $_SESSION['level'] == 'admin') {
    header('Location: login');
    exit;
}

$ambilNama = $_SESSION['user'];

// Ambil data no rekening
$no_rek = $_GET['no_rek'] ?? '';
$saldoRekening = $_GET['saldoRek'] ?? 0;
$query = "SELECT * FROM users WHERE no_rek = '$no_rek'";
$ambilQuery = mysqli_query($koneksi, $query);
$dataRekening = mysqli_fetch_assoc($ambilQuery);
$saldoRekFix = number_format($saldoRekening, 0, ',', '.');

// Tanggal hari ini
$today = date('Y-m-d');

// Ambil no rek user
$rek = mysqli_query($koneksi, "SELECT no_rek, email FROM users WHERE username = '$ambilNama'");
$ambilRekeningUser = mysqli_fetch_assoc($rek);

$noRekPengirim = $ambilRekeningUser['no_rek'] ?? '';
$noRekPenerima = $dataRekening['no_rek'] ?? '';
$emailPengirim = $ambilRekeningUser['email'] ?? '';
$emailPenerima = $dataRekening['email'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="https://i.ibb.co.com/mGks4Ns/Desain-tanpa-judul-40.png">
    <title>FinansialKu - Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="css/styler.css?v=1.0">
    <link rel="stylesheet" href="css/dashboard.css?v=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        body {
            background-image: url('https://i.ibb.co.com/R3c2DTt/Game-Night-3.gif');
            background-size: cover;
            background-position: center;
        }

        .content-box {
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 15px;
            padding: 20px;
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

    <div class="main-content khusus">
        <div class="konten khusus2">
            <div class="konten_dalem khusus3">
                <div class="content-box">
                    <h2 class="heade" style="color: #4b4f58;">Transfer uang</h2>
                    <input type="hidden" id="username" value="<?= htmlspecialchars($ambilNama) ?>">
                    <script type="text/javascript" src="js/pisahTitik.js"></script>
                    <hr style="margin-top: -2px; margin-bottom: 25px;">

                    <?php if (mysqli_num_rows($ambilQuery) === 1): ?>
                        <?php if ($no_rek != $noRekPengirim): ?>
                            <div class="row">
                                <div class="col-6" style="border-right: 1.45px solid #ccc;">
                                    <p>Nomor rekening</p>
                                    <input type="text" value="<?= htmlspecialchars($dataRekening['no_rek']) ?>"
                                        class="form-control control" disabled>

                                    <p style="margin-top: 18px;">ID User</p>
                                    <input type="text" value="<?= htmlspecialchars($dataRekening['id_user']) ?>"
                                        class="form-control control" disabled>

                                    <p style="margin-top: 18px;">Username</p>
                                    <input type="text" value="<?= htmlspecialchars($dataRekening['username']) ?>"
                                        class="form-control control" disabled>

                                    <p style="margin-top: 18px;">Email</p>
                                    <input type="text" value="<?= htmlspecialchars($dataRekening['email']) ?>"
                                        class="form-control control" disabled>
                                </div>
                                <div class="col-6">
                                    <form action="" method="post">

                                        <input type="hidden" name="username"
                                            value="<?= htmlspecialchars($dataRekening['username']) ?>">
                                        <input type="hidden" name="username2" value="<?= htmlspecialchars($ambilNama) ?>">
                                        <input type="hidden" name="saldoRekening"
                                            value="<?= htmlspecialchars($saldoRekening) ?>">

                                        <p>Saldo anda</p>
                                        <input type="text" value="<?= $saldoRekFix ?>" class="form-control control" disabled>

                                        <p style="margin-top: 18px;">Tanggal</p>
                                        <input type="date" name="tanggal" value="<?= $today ?>" class="form-control control">

                                        <p style="margin-top: 18px;">Masukkan jumlah nominal</p>
                                        <input type="text" class="form-control" name="jumlah" autocomplete="off"
                                            onkeydown="return numbersonly(this, event);"
                                            onkeyup="javascript:tandaPemisahTitik(this);" required>

                                        <div class="d-flex">
                                            <button type="submit" name="transfer" class="btn btn-primary flex-grow-1"
                                                style="margin-top: 18px;">Transfer</button>
                                            <button type="button" class="btn btn-secondary flex-grow-1"
                                                style="margin-top: 18px; margin-left: 10px;"
                                                onclick="location.href='rekening.php'">
                                                <i class="fas fa-arrow-left"></i> Kembali</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        <?php else: ?>
                            <h2 style="color: #4b4f58;">Maaf anda tidak bisa transfer ke rekening sendiri!</h2>
                        <?php endif; ?>

                    <?php else: ?>
                        <h2 style="color: #4b4f58;">Maaf nomor rekening <?= htmlspecialchars($no_rek) ?> tidak valid / tidak
                            tersedia!</h2>
                    <?php endif; ?>

                    <?php
                    // Transfer
                    if (isset($_POST['transfer'])) {
                        if (transfer($_POST) > 0) {
                            echo "
                                    <script>
                                        alert('Berhasil, Selamat transfer berhasil!');
                                        window.location.href = 'dashboard1'
                                    </script>
                                ";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="ajax/js/laporan.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>
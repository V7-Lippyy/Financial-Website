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

$totalPemasukan = query("SELECT * FROM pemasukkan WHERE username = '$ambilNama'");
$totalPengeluaran = query("SELECT * FROM pengeluaran WHERE username = '$ambilNama'");

foreach ($totalPemasukan as $rowMasuk) {
    $hargaMasuk[] = $rowMasuk["jumlah"];
    $convertHarga = str_replace('.', '', $hargaMasuk);
    $totalMasuk = array_sum($convertHarga);
}

foreach ($totalPengeluaran as $rowKeluar) {
    $hargaKeluar[] = $rowKeluar["jumlah"];
    $convertHarga2 = str_replace('.', '', $hargaKeluar);
    $totalKeluar = array_sum($convertHarga2);
}

global $totalMasuk, $totalKeluar;
$saldo = $totalMasuk - $totalKeluar;
$saldoFix = number_format($saldo, 0, ',', '.');

$month = date('m');
$day = date('d');
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;

// pemasukkan rekening
$rekeningMasuk = query("SELECT * FROM rekening_masuk WHERE username = '$ambilNama'");
foreach ($rekeningMasuk as $rowRekIn) {
    $jumlah[] = $rowRekIn['jumlah'];
    $jumlahConvert = str_replace('.', '', $jumlah);
    $totalRekIn = array_sum($jumlahConvert);
}

// pengeluaran rekening
$rekeningKeluar = query("SELECT * FROM rekening_keluar WHERE username = '$ambilNama'");
foreach ($rekeningKeluar as $rowRekOut) {
    $jumlah2[] = $rowRekOut['jumlah'];
    $jumlahConvert2 = str_replace('.', '', $jumlah2);
    $totalRekOut = array_sum($jumlahConvert2);
}

// saldo rekening
global $totalRekIn, $totalRekOut;
$saldoRek = $totalRekIn - $totalRekOut;
$saldoRekFix = number_format($saldoRek, 0, ',', '.');
$no = 1;

// get no rekening
$query = "SELECT * FROM users WHERE username = '$ambilNama'";
$ambilQuery = mysqli_query($koneksi, $query);
$ambilData = mysqli_fetch_assoc($ambilQuery);

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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styler.css?v=1.0">
    <link rel="stylesheet" href="css/dashboard.css?v=1.0">
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="js/sweetalert.min.js"></script>

    <style>
        body {
            background-image: url('https://i.ibb.co.com/3T71C4z/Game-Night-9.gif');
            background-size: cover;
            background-position: center;
        }

        .rentang {
            padding-bottom: 75px;
        }
    </style>
</head>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .rekening {
            background-color: rgba(255, 255, 255, 0.7);
            /* White with 70% transparency */
            border-radius: 15px;
            /* Rounded corners */
            padding: 20px;
            /* Optional padding */
        }

        .modal-content {
            border-radius: 15px;
            /* Rounded corners for modals */
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

    <div class="rekening">
        <p>Saldo Rekening</p>
        <h3>Rp. <?= $saldoRekFix ?></h3>
        <button class="btn btn-lg add-rekening btn-prev" data-toggle="modal" data-target="#exampleModalCenter"><i
                class="fas fa-dollar-sign"></i>
            Kelola rekening</button>
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <div class="history text-center">
                    <a href="#" id="openBtn3">
                        <i class="fas fa-history"></i>
                        <span>History</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="refresh text-center">
                    <a href="rekening">
                        <i class="fas fa-sync-alt"></i>
                        <span>Refresh</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="username" value="<?= $ambilNama ?>">
    <input type="hidden" id="saldoRekening" value="<?= $saldoRek ?>">

    <!-- Modal Kelola rekening -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Kelola Rekening</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p>No rekening anda : </p>
                    <h5 style="margin-top: -10px; margin-bottom: 13px;"><b><?= $ambilData['no_rek'] ?></b></h5>
                    <p style="margin-bottom: 5px;">Tentukan aksi : </p>
                    <button class="btn btn-info" id="openBtn" data-dismiss="modal">Isi saldo rekening</button>
                    <button class="btn btn-success" id="openBtn4" data-dismiss="modal">Transfer ke akun lain</button>
                    <button class="btn btn-danger" id="openBtn2" data-dismiss="modal" style="margin-top: 4px;">Cairkan
                        ke saldo dompet</button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Kelola rekening -->

    <!-- Modal dana masuk -->
    <div class="modal fade" id="myModal2" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Dana masuk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <script type="text/javascript" src="js/pisahTitik.js"></script>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" value="<?= $today ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlahRek">Jumlah nominal</label>
                        <input type="text" class="form-control" id="jumlahRek"
                            onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <a href="#" class="btn btn-primary tambahRek">Tambah</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal dana masuk -->

    <!-- Modal dana keluar -->
    <div class="modal fade" id="myModal3" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Dana keluar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <script type="text/javascript" src="js/pisahTitik.js"></script>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggalRekOut" value="<?= $today ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlahRekOut">Jumlah nominal</label>
                        <input type="text" class="form-control" id="jumlahRekOut"
                            onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <a href="#" class="btn btn-primary tambahRekOut">Tambah</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal dana keluar -->

    <!-- Modal history -->
    <div class="modal fade" id="myModal4" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Riwayat transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <script type="text/javascript" src="js/pisahTitik.js"></script>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered">
                            <tr>
                                <th>No.</th>
                                <th>Kode transaksi</th>
                                <th>Nominal</th>
                                <th>Aksi</th>
                                <th>Tanggal</th>
                            </tr>
                            <?php foreach ($rekeningMasuk as $row): ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row['kode'] ?></td>
                                    <td><?= $row['jumlah'] ?></td>
                                    <td><?= $row['aksi'] ?></td>
                                    <td><?= $row['tanggal'] ?></td>
                                </tr>
                                <?php $no++ ?>
                            <?php endforeach; ?>

                            <?php foreach ($rekeningKeluar as $row): ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row['kode'] ?></td>
                                    <td><?= $row['jumlah'] ?></td>
                                    <td><?= $row['aksi'] ?></td>
                                    <td><?= $row['tanggal'] ?></td>
                                </tr>
                                <?php $no++ ?>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal history -->

    <!-- Modal transfer -->
    <div class="modal fade" id="myModal5" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Transfer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jumlahRekOut">No rekening</label>
                        <input type="text" class="form-control" id="no_rek" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <a href="#" class="btn btn-primary tambah_norek">Cari</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal transfer -->

    <script>
        $('#openBtn').click(function () {
            $('#myModal2').modal({
                show: true
            });
        })
        $('#openBtn2').click(function () {
            $('#myModal3').modal({
                show: true
            });
        })
        $('#openBtn3').click(function () {
            $('#myModal4').modal({
                show: true
            });
        })
        $('#openBtn4').click(function () {
            $('#myModal5').modal({
                show: true
            });
        })
    </script>

    <script src="js/bootstrap.js"></script>
    <script src="js/kirimNoRek.js"></script>
    <script src="ajax/js/tambahRekeningIn.js"></script>
    <script src="ajax/js/tambahRekeningOut.js"></script>
</body>

</html>
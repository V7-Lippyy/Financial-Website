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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,700,900" rel="stylesheet">
    <title>FinansialKu</title>
    <link rel="shortcut icon" href="https://i.ibb.co.com/mGks4Ns/Desain-tanpa-judul-40.png">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-softy-pinko.css">
    <style>
        .saldo-dompet-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 150px;
            /* Add space between the cards */
        }

        .card.card-stats {
            max-width: 300px;
            /* Adjust the width as needed */
            margin: 0 auto;
        }

        .card.card-stats .icon-big {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card.card-stats img.ikon {
            width: 40pt;
            height: 40pt;
        }
    </style>
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->


    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="#" class="logo">
                            <img src="assets/images/logo.jpg" alt="Softy Pinko" />
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="#welcome" class="active">Home</a></li>
                            <li><a href="logout">Sign Out</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Welcome Area Start ***** -->
    <div class="welcome-area" id="welcome">

        <!-- ***** Header Text Start ***** -->
        <div class="header-text">
            <div class="container">
                <div class="row">
                    <div class="offset-xl-3 col-xl-6 offset-lg-2 col-lg-8 col-md-12 col-sm-12">
                        <h1>Selamat Datang di <strong>FinansialKu</strong><br>
                        </h1>
                        <p>FinansialKu adalah sebuah website yang dapat membantu kamu dalam mencatat baik pemasukan
                            maupun pengeluaranmu, serta membantu kamu dalam menabung</p>
                        <a href="#features" class="main-button-slider">Kelompok 2</a>

                    </div>
                </div>
            </div>
        </div>
        <!-- ***** Header Text End ***** -->
    </div>
    <!-- ***** Welcome Area End ***** -->

    <!-- ***** Features Small Start ***** -->
    <section class="section home-feature">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <!-- First Row -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12"
                            data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s"
                            onclick="window.location.href='tambahPemasukkan';" style="cursor: pointer;">
                            <div class="features-small-item">
                                <div class="icon">
                                    <i><img src="assets/images/featured-item-01.png" alt=""></i>
                                </div>
                                <h5 class="features-title">Input Pemasukan</h5>
                                <p>Masukkan Detail dan Jumlah Pemasukanmu Disini</p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-12"
                            data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s"
                            onclick="window.location.href='tambahPengeluaran';" style="cursor: pointer;">
                            <div class="features-small-item">
                                <div class="icon">
                                    <i><img src="assets/images/featured-item-02.png" alt=""></i>
                                </div>
                                <h5 class="features-title">Input Pengeluaran</h5>
                                <p>Masukkan Detail dan Jumlah Pengeluaranmu Disini</p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-12"
                            data-scroll-reveal="enter bottom move 50px over 0.6s after 0.6s"
                            onclick="window.location.href='laporan';" style="cursor: pointer;">
                            <div class="features-small-item">
                                <div class="icon">
                                    <i><img src="https://i.ibb.co.com/F0NCKpf/featured-item-05.png" alt=""></i>
                                </div>
                                <h5 class="features-title">Lihat Laporan</h5>
                                <p>Lihat Laporan Pemasukan dan Pengeluaranmu Disini</p>
                            </div>
                        </div>
                        <!-- End First Row -->

                        <!-- Second Row -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12"
                            data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s"
                            onclick="window.location.href='pemasukkan';" style="cursor: pointer;">
                            <div class="features-small-item">
                                <div class="icon">
                                    <i><img src="assets/images/featured-item-04.png" alt=""></i>
                                </div>
                                <h5 class="features-title">Lihat Pemasukan</h5>
                                <p>Lihat Berapa Total Pemasukanmu Disini</p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-12"
                            data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s"
                            onclick="window.location.href='pengeluaran';" style="cursor: pointer;">
                            <div class="features-small-item">
                                <div class="icon">
                                    <i><img src="https://i.ibb.co.com/6YyFMvx/Desain-tanpa-judul-31.png" alt=""></i>
                                </div>
                                <h5 class="features-title">Lihat Pengeluaran</h5>
                                <p>Lihat Berapa Total Pengeluaranmu Disini</p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-12"
                            data-scroll-reveal="enter bottom move 50px over 0.6s after 0.6s"
                            onclick="window.location.href='rekening';" style="cursor: pointer;">
                            <div class="features-small-item">
                                <div class="icon">
                                    <i><img src="https://i.ibb.co.com/GHhn5yt/Desain-tanpa-judul-31.png" alt=""></i>
                                </div>
                                <h5 class="features-title">Atur Rekening</h5>
                                <p>Atur Rekeningmu Disini</p>

                            </div>
                        </div>
                        <!-- End Second Row -->


                        <div class="saldo-dompet-container">
                            <div class="card card-stats card-warning" style="background: #347ab8;">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <img src="https://i.ibb.co/ysnJPtz/1.png" alt="Deskripsi_alternatif"
                                                    class="fas fa-wallet ikon">
                                            </div>
                                        </div>
                                        <div class="col-7 d-flex align-items-center tulisan">
                                            <div class="numbers">
                                                <p class="card-category ket head">Saldo dompet</p>
                                                <h4 class="card-title ket total">Rp. <?= $saldoFix; ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-stats card-warning" style="background: #5db85b;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <img src="https://i.ibb.co/bms9XzJ/2.png" alt="Deskripsi_alternatif"
                                                    class="fas fa-wallet ikon" style="width: 50pt; height: 50pt;">
                                            </div>
                                        </div>
                                        <div class="col-7 d-flex align-items-center tulisan">
                                            <div class="numbers">
                                                <p class="card-category ket head">Pemasukkan</p>
                                                <?php foreach ($totalPemasukan as $row): ?>
                                                    <?php
                                                    $hargaPemasukkan[] = $row["jumlah"];
                                                    $hargaConvert = str_replace('.', '', $hargaPemasukkan);
                                                    $totalPem = array_sum($hargaConvert);
                                                    $hasilHarga = number_format($totalPem, 0, ',', '.');
                                                    ?>
                                                <?php endforeach ?>

                                                <?php global $hasilHarga;
                                                if ($hasilHarga != ""): ?>
                                                    <h4 class="card-title ket total">Rp. <?= $hasilHarga ?> </h4>
                                                <?php else: ?>
                                                    <h4 class="card-title ket total">Rp. 0 </h4>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-stats card-warning" style="background: #d95350;">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <img src="https://i.ibb.co/yRH6nzB/3.png" alt="Deskripsi_alternatif"
                                                    class="fas fa-wallet ikon" style="width: 50pt; height: 50pt;">
                                            </div>
                                        </div>
                                        <div class="col-7 d-flex align-items-center tulisan">
                                            <div class="numbers">
                                                <p class="card-category ket head">Pengeluaran</p>
                                                <?php foreach ($totalPengeluaran as $row): ?>
                                                    <?php
                                                    $hargaPengeluaran[] = $row["jumlah"];
                                                    $hargaConvert = str_replace('.', '', $hargaPengeluaran);
                                                    $totalPeng = array_sum($hargaConvert);
                                                    $hasilHargaPengeluaran = number_format($totalPeng, 0, ',', '.');
                                                    ?>
                                                <?php endforeach; ?>

                                                <?php global $hasilHargaPengeluaran;
                                                if ($hasilHargaPengeluaran != ""): ?>
                                                    <h4 class="card-title ket total">Rp. <?= $hasilHargaPengeluaran; ?>
                                                    </h4>
                                                <?php else: ?>
                                                    <h4 class="card-title ket total">Rp. 0</h4>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Small End ***** -->


    <!-- ***** Features Big Item Start ***** -->
    <section class="section padding-top-70 padding-bottom-0" id="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-sm-12 align-self-center"
                    data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                    <img src="assets/images/profil1.png" class="rounded img-fluid d-block mx-auto" alt="App">
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-6 col-md-12 col-sm-12 align-self-center mobile-top-fix">
                    <div class="left-heading">
                        <h2 class="section-title">Muhammad Alif Qadri</h2>
                    </div>
                    <div class="left-text">
                        <p>Bertugas dalam membuat frontend dan juga backend.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="hr"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Big Item End ***** -->

    <!-- ***** Features Big Item Start ***** -->
    <section class="section padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 align-self-center mobile-bottom-fix">
                    <div class="left-heading">
                        <h2 class="section-title">Muhammad Fikri Zaki</h2>
                    </div>
                    <div class="left-text">
                        <p>Bertugas dalam membuat dokumen.</p>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-5 col-md-12 col-sm-12 align-self-center mobile-bottom-fix-big"
                    data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                    <img src="assets/images/profil2.png" class="rounded img-fluid d-block mx-auto" alt="App">
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Big Item End ***** -->

    <!-- ***** Features Big Item Start ***** -->
    <section class="section padding-top-70 padding-bottom-0" id="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-sm-12 align-self-center"
                    data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                    <img src="assets/images/profil3.png" class="rounded img-fluid d-block mx-auto" alt="App">
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-6 col-md-12 col-sm-12 align-self-center mobile-top-fix">
                    <div class="left-heading">
                        <h2 class="section-title">Muhammad Ishlah Prahara</h2>
                    </div>
                    <div class="left-text">
                        <p>Bertugas dalam membuat dokumen.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="hr"></div>
                </div>
            </div>
        </div>
    </section>

    </div>
    </div>
    </section>
    <!-- ***** Contact Us End ***** -->

    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <ul class="social">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-rss"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p class="copyright">Copyright &copy; 2024 Created by Kelompok 2</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>

    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>

</body>

</html>
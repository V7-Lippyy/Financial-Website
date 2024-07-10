<?php
session_start();
require "function/functions.php";

if (isset($_SESSION["login"])) {
    header("Location: dashboard1");
    exit;
} elseif (isset($_COOKIE['login'])) {
    header("Location: dashboard1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="https://i.ibb.co.com/mGks4Ns/Desain-tanpa-judul-40.png">
    <title>FinansialKu</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap1.css" />
    <link href="css/font-awesome1.min.css" rel="stylesheet" />
    <link href="css/style1.css" rel="stylesheet" />
    <link href="css/responsive1.css" rel="stylesheet" />

</head>

<body>

    <div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="index.html">
                        <span>
                            FinansialKu
                        </span>
                    </a>
            </div>
        </header>
        <!-- end header section -->
        <!-- slider section -->
        <section class="slider_section ">
            <div id="customCarousel1" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container ">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="img-box">
                                        <img src="images/slider-img.png" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-box">
                                        <h1>
                                            Manajemen Keuangan Terpadu
                                        </h1>
                                        <p>
                                            Kelola keuangan Anda dengan mudah melalui pencatatan pemasukan dan
                                            pengeluaran, dapatkan laporan keuangan lengkap dan terperinci, serta
                                            manfaatkan fitur rekening untuk transfer dan menerima saldo dengan cepat dan
                                            aman.
                                        </p>
                                        <div class="btn-box">
                                            <a href="register.php" class="btn1">
                                                Mari Bergabung
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </section>
    </div>

    <section class="service_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Layanan Kami
                </h2>
                <p>
                    Berikut beberapa laynanan dari website kami
                </p>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="box">
                        <div class="img-box">
                            <img src="images/s1.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Catat dan Kelola Pemasukan
                            </h5>
                            <p>
                                Kelola keuangan Anda dengan mencatat setiap pemasukan dan pengeluaran secara efisien.
                            </p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="box">
                        <div class="img-box">
                            <img src="images/s2.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Laporan Keuangan Lengkap dan Terperinci
                            </h5>
                            <p>
                                Dapatkan laporan keuangan yang lengkap untuk memantau arus kas Anda.
                            </p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="box">
                        <div class="img-box">
                            <img src="images/s3.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Fitur Rekening
                            </h5>
                            <p>
                                Gunakan fitur rekening untuk melakukan transfer atau menerima saldo dengan cepat, aman,
                                dan juga praktis.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="box">
                        <div class="img-box">
                            <img src="images/s4.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Keamanan Data Terjamin
                            </h5>
                            <p>
                                Nikmati kenyamanan bertransaksi dengan jaminan keamanan data yang tinggi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer_section">
        <div class="container">
            <p>
                &copy; <span id="displayYear"></span> All Rights Reserved By
                <a href="https://html.design/">Kelompok 2 GCS 22</a>
            </p>
        </div>
    </footer>
    </div>

</body>

</html>
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

$month = date('m');
$day = date('d');
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;

$pemasukkan = query("SELECT * FROM pemasukkan WHERE tanggal = '$today' AND username = '$ambilNama'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" href="https://i.ibb.co.com/mGks4Ns/Desain-tanpa-judul-40.png">
	<title>FinansialKu - Pemasukkan</title>
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
	<style>
		body {
			background-image: url('https://i.ibb.co.com/vQX6TtH/Game-Night-7.gif');
			background-size: cover;
			background-position: center;
		}

		.main-content {
			background-color: rgba(255, 255, 255, 0.7);
			border-radius: 15px;
			padding: 20px;
			margin: 20px auto;
			max-width: 1200px;
		}

		.table-responsive {
			background-color: rgba(255, 255, 255, 0.7);
			border-radius: 15px;
			padding: 20px;
		}

		.table {
			background-color: rgba(255, 255, 255, 0.7);
		}
	</style>
</head>

<body>
	<!-- change icon -->
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

	<div class="main-content khusus">
		<h2 class="head" style="color: #4b4f58;">Pemasukkan</h2>
		<hr style="margin-top: -2px;">

		<!-- Filter and search section -->
		<div class="row cari-filter">
			<div class="col-lg-5">
				<table class="tabel-data">
					<tr>
						<td><label>Pilih tanggal</label></td>
						<td style="width: 71%">
							<input type="date" value="<?= $today ?>" class="form-control filter" id="filter">
						</td>
					</tr>
				</table>
			</div>
			<div class="col-lg-4">
				<input type="hidden" id="username" value="<?= $ambilNama ?>">
			</div>
			<div class="col-lg-3">
				<div class="input-group">
					<input type="text" name="cari" class="form-control border-right-0 cari" id="keyword"
						placeholder="Search" autocomplete="off">
					<div class="input-group-append">
						<span class="input-group-text bg-white border-left-0 icone"><i class="fa fa-search"></i></span>
					</div>
				</div>
			</div>
		</div>
		<!-- Filter and search section -->

		<!-- Table content -->
		<div class="headline">
			<h5>Data Pemasukkan</h5>
		</div>
		<div class="container" id="container">
			<div class="row tampil" id="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-sm table-hover table-striped table-bordered">
							<tr>
								<th>No.</th>
								<th>Tanggal</th>
								<th>Keterangan Pemasukkan</th>
								<th>Sumber Pemasukkan</th>
								<th>Jumlah Pemasukkan</th>
								<th>Aksi</th>
							</tr>
							<?php $i = 1; ?>
							<?php foreach ($pemasukkan as $row): ?>
								<tr class="show" id="<?= $row['id'] ?>">
									<td> <?= $i ?> </td>
									<td data-target="tanggal"><?= htmlspecialchars($row['tanggal']) ?></td>
									<td data-target="keterangan"><?= htmlspecialchars($row['keterangan']) ?></td>
									<td data-target="sumber"><?= htmlspecialchars($row['sumber']) ?></td>
									<td data-target="jumlahMasuk"><?= htmlspecialchars($row['jumlah']) ?></td>
									<td>
										<a href="#" id="<?= $row['id']; ?>" class="btn btn-info delete">
											<i class="fas fa-trash-alt"></i>
										</a>
										<a href="#" data-id="<?= $row['id']; ?>" data-role="update"
											class="btn btn-outline-secondary" id="openBtn">
											<i class="fas fa-edit"></i>
										</a>
									</td>
								</tr>
								<?php
								$jumlah2[] = $row["jumlah"];
								$jumlahConvert = str_replace('.', '', $jumlah2);
								$totali = array_sum($jumlahConvert);
								$hasilJumlah = number_format($totali, 0, ',', '.');
								?>
								<?php $i++ ?>
							<?php endforeach; ?>

							<?php if (isset($jumlah2) != null): ?>
								<tr>
									<td colspan="4">Total Pemasukkan</td>
									<td id="total" data-target="total"><?= $hasilJumlah ?></td>
								</tr>
							<?php endif; ?>
						</table>
					</div>
				</div>
			</div>
			<!-- Button trigger modal -->
			<button type="button" class="btn btn-primary btn2" data-toggle="modal" data-target="#exampleModalCenter">
				<i class=" fas fa-hand-holding-usd"></i> Tambah Data
			</button>
			<button type="button" class="btn btn-secondary btn2" onclick="location.href='dashboard1.php'">
				<i class="fas fa-arrow-left"></i> Kembali</button>
		</div>
		<!-- Table content -->
	</div>

	<!-- Modal Tambah Data -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
		aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Pemasukkan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<!-- isi form -->
				<div class="modal-body">
					<script type="text/javascript" src="js/pisahTitik.js"></script>
					<div class="form-group">
						<label>Masukkan Tanggal</label>
						<input type="date" value="<?= $today ?>" name="tanggal" class="form-control" id="tanggalTambah"
							required>
					</div>
					<div class="form-group">
						<label>Masukkan Keterangan Pemasukkan</label>
						<input type="text" name="keterangan" class="form-control" id="keteranganTambah" required>
					</div>
					<div class="form-group">
						<label>Masukkan Sumber Pemasukkan</label>
						<select name="sumber" class="form-control" id="sumberTambah">
							<option>ATM</option>
							<option>Pemberian</option>
							<option>Piutang</option>
							<option>Laba penjualan</option>
							<option>Pekerjaan</option>
							<option>Lain - lain</option>
						</select>
					</div>
					<div class="form-group">
						<label>Masukkan Jumlah Pemasukkan</label>
						<input type="text" id="jumlahTambah" name="jumlah" class="form-control"
							onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"
							required>
					</div>
				</div>

				<!-- footer form -->
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary tambahin">Tambah</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Tambah Data -->

	<!-- Modal edit data -->
	<div class="modal fade" id="myModal2" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">Ubah Data Pemasukkan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<!-- isi form -->
				<div class="modal-body">
					<input type="hidden" id="userId" class="form-control">
					<div class="form-group">
						<label for="tanggal">Tanggal</label>
						<input type="date" class="form-control" id="tanggal" required>
					</div>
					<div class="form-group">
						<label for="keterangan">Keterangan Pemasukkan</label>
						<input type="text" class="form-control" id="keterangan" required>
					</div>
					<div class="form-group">
						<label for="sumber">Sumber Pemasukkan</label>
						<select class="form-control" id="sumber">
							<option>ATM</option>
							<option>Pemberian</option>
							<option>Piutang</option>
							<option>Laba penjualan</option>
							<option>Pekerjaan</option>
							<option>Lain - lain</option>
						</select>
					</div>
					<div class="form-group">
						<label for="jumlahMasuk">Jumlah Pemasukkan</label>
						<input type="text" class="form-control" id="jumlahMasuk"
							onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"
							required>
					</div>
				</div>

				<!-- footer form -->
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<a href="#" id="save" class="btn btn-primary">simpan</a>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal edit data -->

	<!-- double modal -->
	<script>
		$('#openBtn').click(function () {
			$('#myModal2').modal({
				show: true
			});
		})
	</script>

	<script src="js/bootstrap.js"></script>
	<script src="ajax/js/filterPemasukkan.js"></script>
	<script src="ajax/js/tambahPemasukkan.js"></script>
	<script src="ajax/js/deletePemasukkan.js"></script>
	<script src="ajax/js/cariPemasukkan.js"></script>
	<script src="ajax/js/updatePemasukkan.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</body>

</html>
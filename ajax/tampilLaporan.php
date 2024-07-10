<?php
require '../function/functions.php';
$jenis = $_GET['jenis'];
$tanggalAwal = $_GET['awal'];
$tanggalAkhir = $_GET['akhir'];
$username = $_GET['username'];

$query = query("SELECT * FROM $jenis WHERE username = '$username' AND (tanggal BETWEEN '$tanggalAwal' AND '$tanggalAkhir')");
$i = 1;
?>

<?php if ($jenis == 'pemasukkan' && $tanggalAwal != '' && $tanggalAkhir != ''): ?>
    <div class="headline">
        <h5>Data Pemasukkan</h5>
    </div>
    <div class="container" id="container">
        <div class="row" id="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-striped table-bordered">
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Keterangan Pemasukkan</th>
                            <th>Sumber Pemasukkan</th>
                            <th>Jumlah Pemasukkan</th>
                        </tr>

                        <?php foreach ($query as $row): ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $row['tanggal'] ?></td>
                                <td><?= $row['keterangan'] ?></td>
                                <td><?= $row['sumber'] ?></td>
                                <td><?= $row['jumlah'] ?></td>
                            </tr>
                            <?php
                            $jumlah2[] = $row["jumlah"];
                            $jumlahConvert = str_replace('.', '', $jumlah2);
                            $totali = array_sum($jumlahConvert);
                            $hasilJumlah = number_format($totali, 0, ',', '.');
                            ?>
                            <?php $i++; ?>
                        <?php endforeach; ?>

                        <?php if (isset($jumlah2) != null): ?>
                            <tr>
                                <td colspan="4">Total Pemasukkan</td>
                                <td id="total" data-target="total">
                                    <?= $hasilJumlah ?>
                                </td>
                            </tr>
                        <?php endif; ?>

                    </table>
                </div>
            </div>
        </div>
    </div>

<?php elseif ($jenis == 'pengeluaran' && $tanggalAwal != '' && $tanggalAkhir != ''): ?>
    <div class="headline">
        <h5>Data Pengeluaran</h5>
    </div>
    <div class="container" id="container">
        <div class="row" id="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-striped table-bordered">
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Keterangan Pengeluaran</th>
                            <th>Keperluan Pengeluaran</th>
                            <th>Jumlah Pengeluaran</th>
                        </tr>

                        <?php foreach ($query as $row): ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $row['tanggal'] ?></td>
                                <td><?= $row['keterangan'] ?></td>
                                <td><?= $row['keperluan'] ?></td>
                                <td><?= $row['jumlah'] ?></td>
                            </tr>
                            <?php
                            $jumlah2[] = $row["jumlah"];
                            $jumlahConvert = str_replace('.', '', $jumlah2);
                            $totali = array_sum($jumlahConvert);
                            $hasilJumlah = number_format($totali, 0, ',', '.');
                            ?>
                            <?php $i++; ?>
                        <?php endforeach; ?>

                        <?php if (isset($jumlah2) != null): ?>
                            <tr>
                                <td colspan="4">Total Pengeluaran</td>
                                <td id="total" data-target="total">
                                    <?= $hasilJumlah ?>
                                </td>
                            </tr>
                        <?php endif; ?>

                    </table>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>
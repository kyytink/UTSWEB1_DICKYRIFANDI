<?php
session_start();

// Cegah akses tanpa login (opsional)
if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = "admin"; // contoh
    $_SESSION['role'] = "Dosen";     // contoh role
}

// Keranjang belanja (gunakan session)
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

// Tambahkan barang ke keranjang
if (isset($_POST['tambah'])) {
    $kode   = $_POST['kode'];
    $nama   = $_POST['nama'];
    $harga  = $_POST['harga'];
    $jumlah = $_POST['jumlah'];

    $total = $harga * $jumlah;

    $_SESSION['keranjang'][] = [
        "kode"   => $kode,
        "nama"   => $nama,
        "harga"  => $harga,
        "jumlah" => $jumlah,
        "total"  => $total
    ];
}

// Hapus keranjang
if (isset($_POST['hapus'])) {
    $_SESSION['keranjang'] = [];
}

$keranjang = $_SESSION['keranjang'];

// Hitung total
$totalBelanja = 0;
foreach ($keranjang as $b) {
    $totalBelanja += $b["total"];
}

$diskon = $totalBelanja * 0.05;
$totalBayar = $totalBelanja - $diskon;

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Penjualan - POLGAN MART</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
        }
        .card {
            border-radius: 16px;
        }
        .logo {
            width: 48px;
            height: 48px;
            background: #4f7cff;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin-right: 10px;
        }
        .form-control {
            border-radius: 10px;
            height: 45px;
        }
        .btn-primary {
            border-radius: 10px;
        }
        table {
            font-size: 15px;
        }
    </style>
</head>

<body>
<div class="container py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <div class="logo">PM</div>
            <div>
                <h5 class="mb-0 fw-bold">--POLGAN MART--</h5>
                <small>Sistem Penjualan Sederhana</small>
            </div>
        </div>

        <div class="text-end">
            <strong>Selamat datang, <?= $_SESSION['username']; ?>!</strong><br>
            <small>Role: <?= $_SESSION['role']; ?></small><br>
            <a href="logout.php" class="btn btn-outline-secondary btn-sm mt-2">Logout</a>
        </div>
    </div>

    <div class="card p-4">

        <!-- FORM INPUT -->
        <form method="post">
            <label class="fw-semibold">Kode Barang</label>
            <input type="text" class="form-control mb-3" placeholder="Masukkan Kode Barang" name="kode" required>

            <label class="fw-semibold">Nama Barang</label>
            <input type="text" class="form-control mb-3" placeholder="Masukkan Nama Barang" name="nama" required>

            <label class="fw-semibold">Harga</label>
            <input type="number" class="form-control mb-3" placeholder="Masukkan Harga" name="harga" required>

            <label class="fw-semibold">Jumlah</label>
            <input type="number" class="form-control mb-3" placeholder="Masukkan Jumlah" name="jumlah" required>

            <button class="btn btn-primary" name="tambah">Tambahkan</button>
            <button type="reset" class="btn btn-outline-secondary">Batal</button>
        </form>

        <hr class="my-4">

        <h5 class="text-center fw-bold mb-3">Daftar Pembelian</h5>

        <!-- TABEL -->
        <table class="table table-bordered">
            <tr class="table-light">
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>

            <?php if (empty($keranjang)): ?>
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada barang</td>
                </tr>
            <?php endif; ?>

            <?php foreach ($keranjang as $b): ?>
                <tr>
                    <td><?= $b["kode"]; ?></td>
                    <td><?= $b["nama"]; ?></td>
                    <td>Rp <?= number_format($b["harga"], 0, ',', '.'); ?></td>
                    <td><?= $b["jumlah"]; ?></td>
                    <td>Rp <?= number_format($b["total"], 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>

            <tr>
                <td colspan="4" class="text-end fw-bold">Total Belanja</td>
                <td>Rp <?= number_format($totalBelanja, 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td colspan="4" class="text-end fw-bold">Diskon</td>
                <td>Rp <?= number_format($diskon, 0, ',', '.'); ?> (5%)</td>
            </tr>
            <tr>
                <td colspan="4" class="text-end fw-bold">Total Bayar</td>
                <td class="fw-bold">Rp <?= number_format($totalBayar, 0, ',', '.'); ?></td>
            </tr>
        </table>

        <form method="post">
            <button class="btn btn-outline-danger mt-2" name="hapus">Kosongkan Keranjang</button>
        </form>

    </div>

</div>
</body>
</html>
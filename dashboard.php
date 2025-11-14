<?php
session_start();

// Cegah akses langsung tanpa login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// =============================
// DATA PRODUK (Commit 6 - Menu + Jumlah Acak)
// =============================
$barang = [
    ["B001", "Miesop Kampung", 7000],
    ["B002", "Keripik Singkong", 5000],
    ["B003", "Cappucino", 10000],
    ["B004", "Jus Alpukat", 8000],
    ["B005", "Ayam Penyet", 12000],
];

// Acak urutan menu setiap refresh
shuffle($barang);

$grandtotal = 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Penjualan - POLGAN MART</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            background: linear-gradient(135deg, #6fa3ef, #87cefa, #d4e7fe);
            min-height: 100vh;
            padding: 0;
        }
        .container {
            background: white;
            max-width: 900px;
            margin: 60px auto;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            padding: 30px 40px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 25px;
        }
        .judul {
            color: #0066ff;
        }
        .judul h2 {
            margin: 0;
            font-size: 22px;
            letter-spacing: 1px;
        }
        .judul p {
            margin: 2px 0 0;
            font-size: 14px;
            color: #555;
        }
        .user-info {
            text-align: right;
        }
        .user-info p {
            margin: 0;
            font-size: 14px;
            color: #333;
        }
        a.logout {
            display: inline-block;
            margin-top: 6px;
            background: linear-gradient(90deg, #ff4b2b, #ff416c);
            color: white;
            text-decoration: none;
            padding: 6px 16px;
            border-radius: 20px;
            font-weight: bold;
            transition: 0.3s ease;
        }
        a.logout:hover {
            transform: scale(1.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f0f4ff;
            color: #333;
        }
        h3 {
            text-align: center;
            color: #0066ff;
            margin-bottom: 10px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 30px;
        }
        .total-box {
            margin-top: 20px;
            padding: 15px;
            background: #f0f8ff;
            border-radius: 10px;
            font-weight: bold;
            text-align: right;
            font-size: 18px;
            color: #0066ff;
        }
        .btn-cetak {
            display: inline-block;
            margin-top: 15px;
            background: linear-gradient(90deg, #0066ff, #00bfff);
            color: white;
            text-decoration: none;
            padding: 8px 18px;
            border-radius: 25px;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-cetak:hover {
            transform: scale(1.05);
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">

        <!-- Header -->
        <div class="header">
            <div class="judul">
                <h2>-- POLGAN MART --</h2>
                <p>Sistem Penjualan Sederhana</p>
            </div>
            <div class="user-info">
                <p>Selamat datang, <b><?= htmlspecialchars($_SESSION['username']); ?></b></p>
                <a href="logout.php" class="logout">Logout</a>
            </div>
        </div>

        <hr>

        <!-- Tabel produk -->
        <h3>Daftar Pembelian</h3>
        <table>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
            <?php foreach ($barang as $item): 
        $jumlah = rand(1, 5);
        $total = $item[2] * $jumlah;
        $grandtotal += $total;
?>
    <tr>
        <td><?= $item[0]; ?></td>
        <td><?= $item[1]; ?></td>
        <td>Rp <?= number_format($item[2], 0, ',', '.'); ?></td>
        <td><?= $jumlah; ?></td>
        <td>Rp <?= number_format($total, 0, ',', '.'); ?></td>
    </tr>
            <?php endforeach; ?>
            <tr style="background:#f9f9f9; font-weight:bold;">
                <td colspan="4" align="right">Grand Total</td>
                <td>Rp <?= number_format($grandtotal, 0, ',', '.'); ?></td>
            </tr>
        </table>
        
        <div class="total-box">
            Total Belanja: Rp <?= number_format($grandtotal, 0, ',', '.'); ?>
        </div>
        <div style="text-align:center;">
            <a href="#" class="btn-cetak" onclick="window.print()">Cetak Total Belanja</a>
        </div>
        <div class="footer">© 2025 POLGAN MART</div>
    </div>
</body>
</html>

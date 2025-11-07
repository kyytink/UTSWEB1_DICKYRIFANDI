<?php
session_start();

// Cegah akses langsung tanpa login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// =============================
// DATA PRODUK (Commit 5)
// =============================
$kode_barang = ["B001", "B002", "B003", "B004", "B005", "B006"];
$nama_barang = ["Miesop Kampung", "Keripik Singkong", "Cappucino", "Jus Alpukat", "Roti Bakar", "Ayam Penyet"];
$harga_barang = [7000, 5000, 10000, 8000, 6000, 12000];
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

        /* ====== HEADER FLEX ====== */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 25px;
        }
        .judul {
            text-align: left;
            color: #0066ff;
        }
        .judul h2 {
            margin: 0;
            font-size: 22px;
            letter-spacing: 1px;
        }
        .judul p {
            margin: 2px 0 0 0;
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

        /* ====== TABEL PRODUK ====== */
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
    </style>
</head>
<body>
    <div class="container">

        <!-- Header kiri-kanan -->
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
            </tr>
            <?php
            for ($i = 0; $i < count($kode_barang); $i++) {
                echo "<tr>
                        <td>{$kode_barang[$i]}</td>
                        <td>{$nama_barang[$i]}</td>
                        <td>Rp " . number_format($harga_barang[$i], 0, ',', '.') . "</td>
                      </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
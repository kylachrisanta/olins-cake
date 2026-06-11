<?php
session_start();
require_once 'koneksi.php';

if (!isset($_SESSION['id_pelanggan'])) {
    header("Location: auth/masuk.php");
    exit;
}

$id_pelanggan = $_SESSION['id_pelanggan'];

$stmt = $koneksi->prepare("SELECT * FROM pesanan WHERE id_pelanggan = ? ORDER BY id_pesanan DESC");
$stmt->bind_param("i", $id_pelanggan);
$stmt->execute();
$res_pesanan = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - Olin's Cake</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Antonio:wght@100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .pesanan-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.03);
            border-left: 5px solid var(--accent-color);
        }
        .pesanan-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
        .pesanan-id {
            font-weight: 700;
            font-size: 18px;
            color: var(--primary-color);
        }
        .pesanan-date {
            color: #777;
            font-size: 14px;
        }
        .status-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }
        .status-menunggu { background: #fff3cd; color: #856404; }
        .status-diproses { background: #cce5ff; color: #004085; }
        .status-dikirim { background: #d4edda; color: #155724; }
        .status-selesai { background: #d1ecf1; color: #0c5460; }
        .status-batal { background: #f8d7da; color: #721c24; }
        
        .pesanan-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .pesanan-info p {
            margin: 5px 0;
            color: #555;
        }
        .pesanan-total {
            text-align: right;
        }
        .pesanan-total h4 {
            margin: 0;
            font-size: 20px;
            color: var(--accent-color);
        }
        @media (max-width: 768px) {
            .pesanan-body { flex-direction: column; align-items: flex-start; gap: 15px; }
            .pesanan-total { text-align: left; }
        }
    </style>
</head>
<body>

    <?php include 'includes/navbar.php'; ?>

    <header class="page-header" style="padding-top: 100px; padding-bottom: 40px;">
        <div class="container">
            <h1 style="font-size: 32px;">Pesanan Saya</h1>
        </div>
    </header>

    <section style="padding: 60px 0; background-color: #faf9f6; min-height: 60vh;">
        <div class="container" style="max-width: 800px;">
            
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> <?= $_SESSION['success'] ?>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if ($res_pesanan->num_rows > 0): ?>
                <?php while ($row = $res_pesanan->fetch_assoc()): 
                    $status_class = '';
                    switch ($row['status_pesanan']) {
                        case 'Menunggu Verifikasi': $status_class = 'status-menunggu'; break;
                        case 'Diproses': $status_class = 'status-diproses'; break;
                        case 'Dikirim': $status_class = 'status-dikirim'; break;
                        case 'Selesai': $status_class = 'status-selesai'; break;
                        case 'Dibatalkan': $status_class = 'status-batal'; break;
                    }
                ?>
                <div class="pesanan-card">
                    <div class="pesanan-header">
                        <div>
                            <div class="pesanan-id">Order #OLN-<?= str_pad($row['id_pesanan'], 5, '0', STR_PAD_LEFT) ?></div>
                            <div class="pesanan-date"><?= date('d M Y, H:i', strtotime($row['tanggal_pesan'])) ?></div>
                        </div>
                        <div class="status-badge <?= $status_class ?>">
                            <?= htmlspecialchars($row['status_pesanan']) ?>
                        </div>
                    </div>
                    <div class="pesanan-body">
                        <div class="pesanan-info">
                            <p><strong>Pengiriman:</strong> <?= date('d M Y', strtotime($row['tanggal_pengiriman'])) ?> (<?= $row['waktu_pengiriman'] ?>)</p>
                            <p><strong>Penerima:</strong> <?= htmlspecialchars($row['nama_penerima']) ?> (<?= htmlspecialchars($row['nomor_whatsapp']) ?>)</p>
                            <p><strong>Metode:</strong> <?= $row['metode_pengiriman'] ?></p>
                        </div>
                        <div class="pesanan-total">
                            <p style="font-size:14px; color:#777; margin-bottom:5px;">Total Belanja</p>
                            <h4>Rp <?= number_format($row['total_bayar'], 0, ',', '.') ?></h4>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-receipt"></i>
                    <h3>Belum Ada Pesanan</h3>
                    <p>Anda belum pernah melakukan pemesanan.</p>
                    <a href="produk.php" class="btn-primary mt-4" style="display: inline-block;">Mulai Belanja</a>
                </div>
            <?php endif; ?>

        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
</body>
</html>

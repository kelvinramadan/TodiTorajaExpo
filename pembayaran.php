<?php
ob_start();
require_once 'core/core.php';

if (!isLoggedIn()) {
    header("Location: loginregist.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get room bookings
$roomQuery = "SELECT rr.*, r.room_number, r.type, r.photo, r.price 
              FROM room_reserves rr 
              JOIN rooms r ON rr.room_id = r.id 
              WHERE rr.user_id = ? 
              ORDER BY rr.booking_date DESC";

$stmt = $db->prepare($roomQuery);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$roomBookings = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Get tour bookings
$tourQuery = "SELECT tr.*, t.title, t.photo, t.price 
              FROM tour_reserves tr 
              JOIN tourism t ON tr.tour_id = t.id 
              WHERE tr.user_id = ? 
              ORDER BY tr.booking_date DESC";

$stmt = $db->prepare($tourQuery);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$tourBookings = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

include 'includes/header.php';
include 'includes/navigation.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .booking-card {
            transition: transform 0.3s ease;
        }
        .booking-card:hover {
            transform: translateY(-5px);
        }
        .booking-image {
            height: 200px;
            object-fit: cover;
        }
        .status-badge {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h2 class="mb-4">Histori Pemesanan</h2>
        
        <!-- Room Bookings -->
        <div class="mb-5">
            <h3>Pemesanan Hotel</h3>
            <div class="row">
                <?php foreach ($roomBookings as $booking): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card booking-card h-100">
                            <img src="<?= htmlspecialchars($booking['photo']) ?>" class="card-img-top booking-image" alt="Room">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($booking['room_number']) ?></h5>
                                <p class="card-text">
                                    <small class="text-muted">Type: <?= htmlspecialchars($booking['type']) ?></small><br>
                                    <small>Check-in: <?= date('d M Y', strtotime($booking['checkin_date'])) ?></small><br>
                                    <small>Check-out: <?= date('d M Y', strtotime($booking['checkout_date'])) ?></small>
                                </p>
                                <p class="card-text">
                                    <strong>Total: Rp.<?= number_format($booking['total_price'], 0, ',', '.') ?></strong>
                                </p>
                            </div>
                            <div class="card-footer text-muted">
                                Dipesan pada: <?= date('d M Y H:i', strtotime($booking['booking_date'])) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php if (empty($roomBookings)): ?>
                    <div class="col">
                        <p class="text-muted">Tidak ditemukan data pemesanan.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Tour Bookings -->
        <div class="mb-5">
            <h3>Pemesanan Wisata</h3>
            <div class="row">
                <?php foreach ($tourBookings as $booking): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card booking-card h-100">
                            <img src="<?= htmlspecialchars($booking['photo']) ?>" class="card-img-top booking-image" alt="Tour">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($booking['title']) ?></h5>
                                <p class="card-text">
                                    <small>Jumlah Tiket: <?= htmlspecialchars($booking['reservations']) ?></small><br>
                                    <small>Harga per Tiket: Rp.<?= number_format($booking['price'], 0, ',', '.') ?></small>
                                </p>
                                <p class="card-text">
                                    <strong>Total: Rp.<?= number_format($booking['total_price'], 0, ',', '.') ?></strong>
                                </p>
                            </div>
                            <div class="card-footer text-muted">
                                Dipesan pada: <?= date('d M Y H:i', strtotime($booking['booking_date'])) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php if (empty($tourBookings)): ?>
                    <div class="col">
                        <p class="text-muted">Tidak ditemukan data pemesanan.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>
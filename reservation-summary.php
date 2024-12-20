<?php
session_start();

// Cek jika tidak ada data reservasi, redirect ke halaman utama
if (!isset($_SESSION['reservation_data'])) {
    header("Location: index.php");
    exit();
}

// Ambil data reservasi dari session
$reservationData = $_SESSION['reservation_data'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Summary</title>
    <link rel="stylesheet" href="css/summary.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="summary-card">
            <div class="header">
                <h2>NEW QUICK RESERVATION</h2>
                <a href="index.php" class="close-btn">&times;</a>
            </div>

            <div class="reservation-details">
                <div class="detail-row">
                    <div class="detail-group">
                        <label>ADULTS</label>
                        <div class="value">2</div>
                    </div>
                    <div class="detail-group">
                        <label>CHILDREN</label>
                        <div class="value">0</div>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-group">
                        <label>ROOM TYPE</label>
                        <div class="value"><?php echo $reservationData['room_type']; ?></div>
                    </div>
                    <div class="detail-group">
                        <label>ROOM NUMBER</label>
                        <div class="value"><?php echo $reservationData['room_number']; ?></div>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-group">
                        <label>FULL NAME</label>
                        <div class="value"><?php echo $reservationData['name']; ?></div>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-group">
                        <label>CHECK IN</label>
                        <div class="value"><?php echo date('M d - ', strtotime($reservationData['checkin'])); ?></div>
                    </div>
                    <div class="detail-group">
                        <label>CHECK OUT</label>
                        <div class="value"><?php echo date('M d', strtotime($reservationData['checkout'])); ?></div>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-group">
                        <label>PHONE</label>
                        <div class="value"><?php echo $reservationData['phone']; ?></div>
                    </div>
                    <div class="detail-group">
                        <label>EMAIL</label>
                        <div class="value"><?php echo $reservationData['email']; ?></div>
                    </div>
                </div>

                <div class="price-info">
                    <div class="price">
                        Rp. <?php echo number_format($reservationData['total_price'], 0, ',', '.'); ?>
                        <span class="duration">/night</span>
                    </div>
                    <div class="total">
                        Total Rp. <?php echo number_format($reservationData['total_price'], 0, ',', '.'); ?>
                    </div>
                </div>
            </div>

            <div class="action-buttons">
                <button class="btn temp-reserve">Temp Reserve</button>
                <button class="btn reserve">Reserve</button>
                <button class="btn check-in">Check In</button>
            </div>
        </div>
    </div>
</body>
</html>
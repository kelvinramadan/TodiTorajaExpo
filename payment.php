<?php

require_once 'core/core.php';
include 'includes/header.php';
include 'includes/navigation.php';

// Ambil data booking dari tabel reservations
$reservationsQuery = $db->query("SELECT reservations.id, reservations.name, reservations.checkin, reservations.checkout, reservations.phone, reservations.email, reservations.total_price, rooms.room_number, rooms.price FROM reservations JOIN rooms ON reservations.room = rooms.room_number");

// Ambil data booking dari tabel tour_reserves
$tourReservesQuery = $db->query("SELECT tour_reserves.*, tourism.title, tourism.price FROM tour_reserves JOIN tourism ON tour_reserves.tour_id = tourism.id");

// Cek jika terjadi error pada query
if (!$reservationsQuery || !$tourReservesQuery) {
    die("Query error: " . $db->error);
}

// Hitung total harga hotel
$totalHotelPrice = 0;
if (mysqli_num_rows($reservationsQuery) > 0) {
    while ($reservation = mysqli_fetch_assoc($reservationsQuery)) {
        $totalHotelPrice += $reservation['total_price'];
    }
    // Reset pointer result set untuk digunakan kembali
    mysqli_data_seek($reservationsQuery, 0);
}

// Hitung total harga wisata
$totalTourPrice = 0;
if (mysqli_num_rows($tourReservesQuery) > 0) {
    while ($tourReserve = mysqli_fetch_assoc($tourReservesQuery)) {
        $totalTourPrice += $tourReserve['price'] * $tourReserve['reservations'];
    }
    // Reset pointer result set untuk digunakan kembali
    mysqli_data_seek($tourReservesQuery, 0);
}

// Total keseluruhan
$grandTotal = $totalHotelPrice + $totalTourPrice;

?>

<link rel="stylesheet" href="css\payment.css">
<script src="admin\js\payment.js"></script>

<div class="container">
    <div class="page-header">
        <h2 class="text-center">Payment and Booking Details</h2>
    </div>

    <!-- Tabel Hotel -->
    <h3>Hotel Bookings</h3>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Hotel</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($reservationsQuery && mysqli_num_rows($reservationsQuery) > 0): ?>

                <?php $i = 1; ?>
                <?php while ($reservation = mysqli_fetch_assoc($reservationsQuery)): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= htmlspecialchars($reservation['name']); ?></td>
                        <td><?= htmlspecialchars($reservation['room_number']); ?></td>
                        <td><?= htmlspecialchars($reservation['checkin']); ?></td>
                        <td><?= htmlspecialchars($reservation['checkout']); ?></td>
                        <td>Rp <?= number_format($reservation['total_price'], 2, ',', '.'); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">No bookings available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Tabel Wisata -->
    <h3>Tour Bookings</h3>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Destinasi</th>
                <th>Nama</th>
                <th>Jumlah orang</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($tourReservesQuery) > 0): ?>
                <?php $i = 1; ?>
                <?php while ($tourReserve = mysqli_fetch_assoc($tourReservesQuery)): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= htmlspecialchars($tourReserve['title']); ?></td>
                        <td><?= htmlspecialchars($tourReserve['cus_name']); ?></td>
                        <td><?= htmlspecialchars($tourReserve['reservations']); ?></td>
                        <td>Rp <?= number_format($tourReserve['price'] * $tourReserve['reservations'], 2, ',', '.'); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No bookings available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Total Harga -->
    <div class="text-right">
        <h4>Total Harga Hotel: Rp <?= number_format($totalHotelPrice, 2, ',', '.'); ?></h4>
        <h4>Total Harga Wisata: Rp <?= number_format($totalTourPrice, 2, ',', '.'); ?></h4>
        <h3>Total Harga: Rp <?= number_format($grandTotal, 2, ',', '.'); ?></h3>
    </div>
    <div class="text-right" style="margin-top: 20px;">
        <button class="btn btn-success" onclick="simulatePayment()">Bayar Sekarang</button>
    </div>
    
    <script>
    function simulatePayment() {
        alert("Pembayaran berhasil dilakukan!");
    }
    </script>
</div>

<?php include 'includes/footer.php'; ?>
<!-- PAYMENT.PHP -->

<?php
require_once 'core/core.php';
include 'includes/header.php';

if (!isLoggedIn()) {
    header("Location: loginregist.php");
    exit();
}

if (!isset($_GET['booking_id'])) {
    header("Location: tourism.php");
    exit();
}

$booking_id = $_GET['booking_id'];
$user_id = $_SESSION['user_id'];

// Get booking details with tour information
$tourReservesQuery = "SELECT tr.*, t.title, t.photo, t.price, u.fullname, u.email, u.phone 
                      FROM tour_reserves tr 
                      JOIN tourism t ON tr.tour_id = t.id 
                      JOIN users u ON tr.user_id = u.id 
                      WHERE tr.id = ? AND tr.user_id = ?";

$stmt = $db->prepare($tourReservesQuery);
$stmt->bind_param("ii", $booking_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

if (!$booking) {
    header("Location: tourism.php");
    exit();
}

// Calculate total tour price
$totalPrice = $booking['total_price'];
?>

<link rel="stylesheet" href="css/payment.css">
<script src="admin/js/payment.js"></script>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Payment Details</h3>
                </div>
                <div class="card-body">
                    <!-- Tour Information -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Tour Details</h5>
                            <p><strong>Tour:</strong> <?= htmlspecialchars($booking['title']) ?></p>
                            <p><strong>Number of People:</strong> <?= htmlspecialchars($booking['reservations']) ?></p>
                            <p><strong>Price per Person:</strong> Rp.<?= number_format($booking['price'], 0, ',', '.') ?></p>
                            <p><strong>Total Price:</strong> Rp.<?= number_format($booking['total_price'], 0, ',', '.') ?></p>
                            <p><strong>Booking Date:</strong> <?= date('d M Y H:i', strtotime($booking['booking_date'])) ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5>Personal Information</h5>
                            <p><strong>Name:</strong> <?= htmlspecialchars($booking['fullname']) ?></p>
                            <p><strong>Email:</strong> <?= htmlspecialchars($booking['email']) ?></p>
                            <p><strong>Phone:</strong> <?= htmlspecialchars($booking['phone']) ?></p>
                        </div>
                    </div>

                    <!-- Payment Summary -->
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5>Payment Summary</h5>
                            <div class="d-flex justify-content-between">
                                <span>Tour Price (<?= $booking['reservations'] ?> people)</span>
                                <span>Rp.<?= number_format($booking['total_price'], 0, ',', '.') ?></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <strong>Total Amount</strong>
                                <strong>Rp.<?= number_format($totalPrice, 0, ',', '.') ?></strong>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Button -->
                    <div class="text-center mt-4">
                        <button class="btn btn-success btn-lg" onclick="simulatePayment()">
                            <i class="fas fa-credit-card mr-2"></i> Pay Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function simulatePayment() {
    if (confirm('Proceed with payment?')) {
        alert('Payment processed successfully!');
        window.location.href = 'index.php';
    }
}
</script>
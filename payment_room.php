<!-- PAYMENT_ROOM.PHP -->

<?php
require_once 'core/core.php';
include 'includes/header.php';

if (!isLoggedIn()) {
    header("Location: loginregist.php");
    exit();
}

if (!isset($_GET['booking_id'])) {
    header("Location: rooms.php");
    exit();
}

$booking_id = $_GET['booking_id'];
$user_id = $_SESSION['user_id'];

// Get booking details with room information
$roomReservesQuery = "SELECT rr.*, r.room_number, r.type, r.photo, r.price, u.fullname, u.email, u.phone 
                      FROM room_reserves rr 
                      JOIN rooms r ON rr.room_id = r.id 
                      JOIN users u ON rr.user_id = u.id 
                      WHERE rr.id = ? AND rr.user_id = ?";

$stmt = $db->prepare($roomReservesQuery);
$stmt->bind_param("ii", $booking_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

if (!$booking) {
    header("Location: rooms.php");
    exit();
}

// Calculate number of days
$checkin = new DateTime($booking['checkin_date']);
$checkout = new DateTime($booking['checkout_date']);
$days = $checkout->diff($checkin)->days;
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Payment Details</h3>
                </div>
                <div class="card-body">
                    <!-- Room Information -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Room Details</h5>
                            <p><strong>Room Type:</strong> <?= htmlspecialchars($booking['type']) ?></p>
                            <p><strong>Room Number:</strong> <?= htmlspecialchars($booking['room_number']) ?></p>
                            <p><strong>Check-in:</strong> <?= date('d M Y', strtotime($booking['checkin_date'])) ?></p>
                            <p><strong>Check-out:</strong> <?= date('d M Y', strtotime($booking['checkout_date'])) ?></p>
                            <p><strong>Duration:</strong> <?= $days ?> night(s)</p>
                            <p><strong>Price per Night:</strong> Rp.<?= number_format($booking['price'], 0, ',', '.') ?></p>
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
                                <span>Room Rate (<?= $days ?> nights)</span>
                                <span>Rp.<?= number_format($booking['total_price'], 0, ',', '.') ?></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <strong>Total Amount</strong>
                                <strong>Rp.<?= number_format($booking['total_price'], 0, ',', '.') ?></strong>
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
        // Here you would typically integrate with a payment gateway
        alert('Payment processed successfully!');
        // Redirect to confirmation page or update booking status
        window.location.href = 'index.php';
    }
}
</script>

<link rel="stylesheet" href="css/payment.css">
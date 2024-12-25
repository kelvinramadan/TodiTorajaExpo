<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/TodiTorajaExpo/core/core.php';

$sql = "SELECT r.*, rm.room_number, u.fullname, u.phone, u.email 
        FROM room_reserves r 
        LEFT JOIN rooms rm ON r.room_id = rm.id
        LEFT JOIN users u ON r.user_id = u.id";
$result = $db->query($sql);

if (!$result) {
    die("Query failed: " . $db->error);
}

$row_count = 1;

if(isset($_GET['delete'])){
    $toDelete = (int)$_GET['delete'];
    
    // Get room_id before deleting the reservation
    $stmtGet = $db->prepare("SELECT room_id FROM room_reserves WHERE id = ?");
    $stmtGet->bind_param("i", $toDelete);
    $stmtGet->execute();
    $result = $stmtGet->get_result();
    $reservation = $result->fetch_assoc();
    
    if($reservation) {
        // Start transaction
        $db->begin_transaction();
        
        try {
            // Delete the reservation
            $stmtDelete = $db->prepare("DELETE FROM room_reserves WHERE id = ?");
            $stmtDelete->bind_param("i", $toDelete);
            $stmtDelete->execute();
            
            // Increment the room count
            $stmtUpdate = $db->prepare("UPDATE rooms SET rooms = rooms + 1 WHERE id = ?");
            $stmtUpdate->bind_param("i", $reservation['room_id']);
            $stmtUpdate->execute();
            
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
            die("Error: " . $e->getMessage());
        }
    }
    
    header("Location: /TodiTorajaExpo/admin/reservations.php");
    exit();
}

include 'includes/header.php';
include 'includes/navigation.php';
?>

<div class="w3-container w3-main" style="margin-left:260px; padding: 20px;">
    <header class="w3-container w3-purple" style="margin-bottom: 20px;">
        <span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">☰</span>
        <h2 class="text-center">Reservations - Todi Toraja Hotel</h2>
    </header>
    
    <div class="col-md-12">
        <?php if($result->num_rows > 0): ?>
        <table class="table table-striped table-condensed table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Room Number</th>
                    <th>Guest Name</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Booking Date</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row_count++; ?></td>
                    <td><?= htmlspecialchars($row['room_number']); ?></td>
                    <td><?= htmlspecialchars($row['fullname']); ?></td>
                    <td><?= date('d M Y', strtotime($row['checkin_date'])); ?></td>
                    <td><?= date('d M Y', strtotime($row['checkout_date'])); ?></td>
                    <td><?= htmlspecialchars($row['phone']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <td><?= date('d M Y H:i', strtotime($row['booking_date'])); ?></td>
                    <td>Rp <?= number_format($row['total_price'], 2, ',', '.'); ?></td>
                    <td>
                        <a href="reservations.php?delete=<?= $row['id']; ?>" 
                           class="w3-btn w3-small w3-red"
                           onclick="return confirm('Are you sure you want to delete this reservation?');">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
            <div class="alert alert-info">No reservations found.</div>
        <?php endif; ?>
    </div>
</div>

<style>
.w3-container {
    padding: 20px;
}

.table {
    margin-top: 20px;
    background: white;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.table th {
    background-color: #f8f9fa;
    font-weight: 600;
}

.table td, .table th {
    padding: 12px;
    vertical-align: middle;
}

.badge {
    padding: 8px 12px;
    border-radius: 4px;
    font-weight: normal;
    display: inline-block;
    min-width: 80px;
    text-align: center;
}

.bg-warning {
    background-color: #ffc107;
    color: #000;
}

.bg-success {
    background-color: #28a745;
    color: #fff;
}

.w3-btn {
    padding: 8px 16px;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.w3-red {
    background-color: #dc3545;
}

.w3-red:hover {
    background-color: #c82333;
}

.alert {
    padding: 15px;
    border-radius: 4px;
    margin-top: 20px;
}

.alert-info {
    background-color: #d1ecf1;
    border-color: #bee5eb;
    color: #0c5460;
}
</style>

<script src="https://kit.fontawesome.com/your-font-awesome-kit.js"></script>
<script>
function w3_open() {
    document.getElementsByClassName("w3-sidenav")[0].style.display = "block";
}

function w3_close() {
    document.getElementsByClassName("w3-sidenav")[0].style.display = "none";
}
</script>
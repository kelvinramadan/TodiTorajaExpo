<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/TodiTorajaExpo/core/core.php';

// Query for reservations with user data
$sql = "SELECT tr.*, t.title, t.price, u.fullname, u.phone, u.email 
        FROM tour_reserves tr
        JOIN tourism t ON tr.tour_id = t.id
        JOIN users u ON tr.user_id = u.id
        ORDER BY tr.booking_date DESC";
$result = $db->query($sql);
$row_count = 1;

// Query for tours list
$tours = $db->query("SELECT * FROM tourism");

// Delete single reservation
if (isset($_GET['delete'])) {
    $toDelete = $_GET['delete'];
    
    // Get reservation details first
    $getReservation = $db->query("SELECT tour_id, reservations FROM tour_reserves WHERE id = '$toDelete'");
    $reservation = mysqli_fetch_assoc($getReservation);
    
    if ($reservation) {
        // Start transaction
        $db->begin_transaction();
        
        try {
            // Delete the reservation
            $db->query("DELETE FROM tour_reserves WHERE id = '$toDelete'");
            
            // Update available slots in tourism table
            $db->query("UPDATE tourism SET 
                       reservations = reservations + {$reservation['reservations']} 
                       WHERE id = '{$reservation['tour_id']}'");
            
            // Commit transaction
            $db->commit();
            header("Location: tour_reserves.php");
        } catch (Exception $e) {
            // Rollback on error
            $db->rollback();
            echo "Error: " . $e->getMessage();
        }
    }
}

// Clear all reservations for a specific tour
if (isset($_POST['clear'])) {
    $tour_id = $_POST['tour'];
    
    // Start transaction
    $db->begin_transaction();
    
    try {
        // Get total reservations for this tour
        $getTotal = $db->query("SELECT SUM(reservations) as total FROM tour_reserves WHERE tour_id = '$tour_id'");
        $total = mysqli_fetch_assoc($getTotal)['total'];
        
        if ($total > 0) {
            // Update available slots in tourism table
            $db->query("UPDATE tourism SET 
                       reservations = reservations + $total 
                       WHERE id = '$tour_id'");
                       
            // Delete all reservations for this tour
            $db->query("DELETE FROM tour_reserves WHERE tour_id = '$tour_id'");
        }
        
        // Commit transaction
        $db->commit();
        header("Location: tour_reserves.php");
    } catch (Exception $e) {
        // Rollback on error
        $db->rollback();
        echo "Error: " . $e->getMessage();
    }
}

include 'includes/header.php';
include 'includes/navigation.php';
?>

<div class="w3-container w3-main" style="margin-left:260px; padding: 20px;">
    <header class="w3-container w3-purple" style="margin-bottom: 20px;">
        <span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">☰</span>
        <h2 class="text-center">Tour Bookings Management</h2>
    </header>

    <div class="row">
        <div class="col-md-12">
            <!-- Bookings table -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Tgl pemesanan</th>
                            <th>Nama pelanggan</th>
                            <th>Destinasi Wisata</th>
                            <th>No. Telp</th>
                            <th>Email</th>
                            <th>Tiket</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row_count++; ?></td>
                            <td><?= date('d M Y H:i', strtotime($row['booking_date'])); ?></td>
                            <td><?= $row['fullname']; ?></td>
                            <td><?= $row['title']; ?></td>
                            <td><?= $row['phone']; ?></td>
                            <td><?= $row['email']; ?></td>
                            <td><?= $row['reservations']; ?></td>
                            <td>Rp.<?= number_format($row['total_price'], 0, ',', '.'); ?></td>
                            <td>
                                <a href="tour_reserves.php?delete=<?=$row['id'];?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Are you sure you want to delete this booking?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
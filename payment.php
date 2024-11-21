<?php
require_once 'core/core.php'; // Include your core functionalities
include 'includes/header.php'; // Include your header
include 'includes/navigation.php'; // Include your navigation

// Fetch all the reservations
$sql = "SELECT * FROM tour_reserves";
$result = $db->query($sql);

?>
<div class="container">
    <div class="page-header">
        <h2 class="text-center">Booking List</h2>
    </div>

    <?php if(mysqli_num_rows($result) > 0): ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Number of People</th>
                    <th>Tour Title</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <?php
                    // Fetch the tour details using the tour_id
                    $tourID = $row['tour_id'];
                    $tourQuery = $db->query("SELECT * FROM tourism WHERE id = '$tourID'");
                    $tour = mysqli_fetch_assoc($tourQuery);
                    ?>

                    <tr>
                        <td><?= $row['cus_name']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td><?= $row['phone']; ?></td>
                        <td><?= $row['reservations']; ?></td>
                        <td><?= $tour['title']; ?></td>
                        <td>Rp.<?= $tour['price'] * $row['reservations']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">No bookings available.</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; // Include your footer ?>

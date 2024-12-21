<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ht/core/core.php';
$sql = "SELECT * FROM reservations";
$result = $db->query($sql);
$row_count = 1;

if(isset($_GET['delete'])){
  $toDelete = $_GET['delete'];
  $db->query("DELETE FROM reservations WHERE id = '$toDelete'");
  header("Location: reservations.php");
}
include 'includes/header.php';
include 'includes/navigation.php';
?>

<div class="w3-container w3-main" style="margin-left:260px; padding: 20px;>
  <header class="w3-container w3-purple" style="margin-bottom: 20px;">
    <span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</span>
    <h2 class="text-center">Reservasi Penginapan</h2>
  </header>
  <div class="col-md-12">
    <table class="table table-striped table-condensed table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Room Number</th>
          <th>Checkin</th>
          <th>Checkout</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Total Price</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php while($rows = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?= $row_count++; ?></td>
          <td><?= htmlspecialchars($rows['name']); ?></td>
          <td><?= htmlspecialchars($rows['room']); ?></td>
          <td><?= htmlspecialchars($rows['checkin']); ?></td>
          <td><?= htmlspecialchars($rows['checkout']); ?></td>
          <td><?= htmlspecialchars($rows['phone']); ?></td>
          <td><?= htmlspecialchars($rows['email']); ?></td>
          <td>Rp <?= number_format($rows['total_price'], 2, ',', '.'); ?></td>
          <td>
            <a href="reservations.php?delete=<?= $rows['id']; ?>" class="w3-btn w3-small w3-red">
              <span class="glyphicon glyphicon-trash"></span>
            </a>
          </td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

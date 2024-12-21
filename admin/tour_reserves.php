<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ht/core/core.php';
// Query untuk mengambil data reservasi
$sql = "SELECT * FROM tour_reserves";
$result = $db->query($sql);
$row_count = 1;

// Query untuk daftar tour
$tours = $db->query("SELECT * FROM tourism");

// Hapus reservasi berdasarkan ID
if (isset($_GET['delete'])) {
    $toDelete = $_GET['delete'];
    $sql = $db->query("DELETE FROM tour_reserves WHERE id = '$toDelete'");

    if ($sql) {
        header("Location: tour_reserves.php");
    } else {
        echo "Error deleting record: " . $db->error;
    }
}

// Hapus semua reservasi berdasarkan ID tour
if (isset($_POST['clear'])) {
    $id = $_POST['tour'];
    $del = $db->query("DELETE FROM tour_reserves WHERE tour_id = '$id'");
    header("Location: tour_reserves.php");
}

include 'includes/header.php';
include 'includes/navigation.php';

?>
<div class="w3-container w3-main" style="margin-left:260px; padding: 20px;">
  <header class="w3-container w3-purple" style="margin-bottom: 20px;">
    <span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">☰</span>
    <h2 class="text-center">Reservations</h2>
  </header>
  <div class="col-md-12">
    <br>
    <h2 class="text-center">Tour Reservations</h2>
    <br />
  </div>
  <div class="col-md-12">
    <!-- Form untuk memilih dan menghapus reservasi berdasarkan tour -->
    <form class="form col-md-4" method="POST">
      <select class="form-control form-group" name="tour">
        <?php while ($tour = mysqli_fetch_assoc($tours)): ?>
        <option value="<?=$tour['id'];?>">
          <?=$tour['title'];?> ~ <?=($tour['reservations'] == 0) ? '(Fully Booked)' : '('.$tour['reservations'].' reserves remaining)';?>
        </option>
        <?php endwhile; ?>
      </select>
      <button type="submit" name="clear" class="btn btn-danger">Clear Records</button>
    </form>

    <!-- Tabel untuk menampilkan reservasi -->
    <table class="table table-striped table-condensed table-bordered">
      <thead>
        <tr>
          <th> </th>
          <th>Nama</th>
          <th>Destinasi</th>
          <th>Phone</th>
          <th>Jumlah Orang</th>
          <th>Email</th>
          <th>Harga</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($rows = mysqli_fetch_assoc($result)): ?>
        <?php 
            $id = $rows['tour_id'];
            $s = $db->query("SELECT * FROM tourism WHERE id = '{$id}'");
            $data = mysqli_fetch_assoc($s);

            // Kalkulasi harga total
            $total_price = $data['price'] * $rows['reservations'];
        ?>
        <tr>
          <td><?= $row_count++; ?></td>
          <td><?=$rows['cus_name']; ?></td>
          <td><?=$data['title']; ?></td>
          <td><?=$rows['phone']; ?></td>
          <td><?=$rows['reservations']; ?></td>
          <td><?=$rows['email']; ?></td>
          <td>Rp.<?= number_format($total_price, 0, ',', '.'); ?></td>
          <td>
            <a href="tour_reserves.php?delete=<?=$rows['id'];?>" class="w3-btn w3-small w3-red">
              <span class="glyphicon glyphicon-trash"></span>
            </a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

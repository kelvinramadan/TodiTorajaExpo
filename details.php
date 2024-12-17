<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>
    <link rel="stylesheet" href="css\details.css">
</head>
<body>
    <!-- Content here -->
    <?php
    require_once 'core/core.php';
    include 'includes/header.php';
    include 'includes/navigation.php';

    if (isset($_GET['room'])) {
        $roomID = $_GET['room'];
        $select = $db->query("SELECT * FROM rooms WHERE id = '{$roomID}'");
        $s = $db->query("SELECT * FROM rooms WHERE id = '{$roomID}'");
    
        if (isset($_POST['checkin'])) {
            if (!empty($_POST['fullname']) && !empty($_POST['in_date']) && !empty($_POST['out_date']) && !empty($_POST['phone'])) {
                $name = $_POST['fullname'];
                $checkin = $_POST['in_date'];
                $checkout = $_POST['out_date'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $r_number = mysqli_fetch_assoc($s);
                $r = $r_number['room_number'];
                $rooms = $_POST['rooms'];
                $current_date = date("Y-m-d");
    
                if ($checkin >= $current_date) {
                    if ($checkout >= $checkin) {
                        // Hitung jumlah hari menginap
                        $checkinDate = new DateTime($checkin);
                        $checkoutDate = new DateTime($checkout);
                        $interval = $checkinDate->diff($checkoutDate);
                        $days = $interval->days;
    
                        // Hitung total harga
                        $roomPrice = $r_number['price'];
                        $totalPrice = $roomPrice * $days;
    
                        $insert = "INSERT INTO `reservations` (`id`, `name`, `checkin`, `checkout`, `phone`, `email`, `room`, `total_price`) 
                                   VALUES (NULL, '$name', '$checkin', '$checkout', '$phone', '$email', '$r', '$totalPrice')";
                        $_SESSION['room_success'] = 'Reservation successfully made!';
                        $save = $db->query($insert);
                        if ($save) {
                            $rs = $db->query("SELECT * FROM rooms WHERE id = '{$roomID}' ");
                            $rms = mysqli_fetch_assoc($rs);
                            $newRooms = $rms['rooms'] - $rooms;
                            if ($newRooms <= 0) {
                                $newRooms = 0;
                            }
                            $update = $db->query("UPDATE rooms SET `rooms`='$newRooms' WHERE id = '{$roomID}' ");
                            header("Location: details.php?room=$roomID");
                        }
                        echo "<br /> <br />";
                    } else {
                        echo '<p class="text-center alert alert-danger">Invalid Check-out date provided. Please avoid using a past date.</p>';
                    }
                } else {
                    echo '<p class="text-center alert alert-danger">Invalid Check-in date provided. Please avoid using a past date.</p>';
                }
            } else {
                echo '<br /> All fields are required!';
            }
        }
    } elseif (!(isset($_GET['room'])) || $_GET['room'] == '') {
        header("Location: rooms.php");
    }
    ?>
    
    <!-- Room details -->
    <div class="container">
        <?php while ($room = mysqli_fetch_assoc($select)): ?>
            <div class="page-header">
                <h2 class="text-center"><?= $room['room_number']; ?></h2>
            </div>
    
            <div class="row">
                <div class="col-md-6">
                    <img class="" style="width:100%; height:400px" src="<?= $room['photo']; ?>">
                </div>
    
                <!-- Right column for details -->
                <div class="col-md-6">
                    <div class="row mt-3">
                        <!-- Tambahkan foto-foto fasilitas -->
                        <?php if (!empty($room['facility1'])): ?>
                            <div class="col-md-6">
                                <img class="" style="width:100%; height:200px" src="<?= $room['facility1']; ?>">
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($room['facility2'])): ?>
                            <div class="col-md-6">
                                <img class="" style="width:100%; height:200px" src="<?= $room['facility2']; ?>">
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($room['facility3'])): ?>
                            <div class="col-md-6">
                                <img class="" style="width:100%; height:200px" src="<?= $room['facility3']; ?>">
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($room['facility4'])): ?>
                            <div class="col-md-6">
                                <img class="" style="width:100%; height:200px" src="<?= $room['facility4']; ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
    
            </div>
    
            <!-- Row for Booking form -->
            <div class="page-header">
                <h2 class="text-center">Booking details</h2>
            </div>
    
            <form action="details.php?room=<?= $roomID ?>" method="POST">
                <div class="row">
    
                    <div class="col">
                        <label class="form-control-label">Nama Lengkap:</label>
                        <input type="text" class="form-control" name="fullname" placeholder="Full Name" <?= ($room['rooms'] <= 0) ? 'readonly' : ''; ?>>
                    </div>
    
                    <div class="col">
                        <label class="form-control-label">Check-in:</label>
                        <input type="date" class="form-control" name="in_date" <?= ($room['rooms'] <= 0) ? 'readonly' : ''; ?>>
                    </div>
    
                    <div class="col">
                        <label class="form-control-label">Check-out:</label>
                        <input type="date" class="form-control" name="out_date" <?= ($room['rooms'] <= 0) ? 'readonly' : ''; ?>>
                    </div>
    
                    <div class="col">
                        <label class="form-control-label">No Telp:</label>
                        <input type="text" class="form-control" name="phone" placeholder="Phone number..." <?= ($room['rooms'] <= 0) ? 'readonly' : ''; ?>>
                    </div>
    
                    <div class="col">
                        <label class="form-control-label">Email Address:</label>
                        <input type="email" class="form-control" name="email" placeholder="email address" <?= ($room['rooms'] <= 0) ? 'readonly' : ''; ?>>
                    </div>
    
                    <div class="col-md-12">
                        <label></label>
                        <input type="submit" class="form-control btn btn-primary" value="Make Reservation" name="checkin" <?= ($room['rooms'] <= 0) ? 'disabled' : ''; ?>>
                    </div>
    
                </div>
            </form>
        <?php endwhile; ?>
    </div>
    
    <br /><br /><br /><br />
    <script src="admin\js\details.js"></script>
</body>
</html>






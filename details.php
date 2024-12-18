<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk mengambil data dari tabel rooms
$sql = "SELECT type, rooms, price FROM rooms LIMIT 1";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penginapan</title>
    <link rel="stylesheet" href="css/details.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <?php
    require_once 'core/core.php';
    include 'includes/header.php';
    include 'includes/navigation.php';

    if (isset($_GET['room'])) {
        $roomID = $_GET['room'];
        $select = $db->query("SELECT * FROM rooms WHERE id = '{$roomID}'");
        $roomData = mysqli_fetch_assoc($select);
    } else {
        header("Location: rooms.php");
        exit();
    }
    ?>

    <div class="container">
        <?php if ($roomData): ?>
            <div class="page-header">
                <h2 class="text-center"><?= htmlspecialchars($roomData['room_number']); ?></h2>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <img class="photo" src="<?= htmlspecialchars($roomData['photo']); ?>" alt="Room Photo">
                </div>
                <div class="col-md-6">
                    <div class="row mt-3">
                        <?php for ($i = 1; $i <= 4; $i++): ?>
                            <?php if (!empty($roomData["facility$i"])): ?>
                                <div class="col-md-6">
                                    <img class="facility" src="<?= htmlspecialchars($roomData["facility$i"]); ?>" alt="Facility <?= $i ?>">
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>

            <div class="info-container">
                <div class="info-box">
                    <h3>Tipe</h3>
                    <p><?= htmlspecialchars($roomData['type']); ?></p>
                </div>
                <div class="info-box">
                    <h3>Sisa</h3>
                    <p><?= htmlspecialchars($roomData['rooms']); ?> kamar</p>
                </div>
                <div class="info-box">
                    <h3>Harga</h3>
                    <p>Rp. <?= htmlspecialchars($roomData['price']); ?></p>
                </div>
            </div>

            <div class="page-header">
                <h2 class="text-center">Booking details</h2>
            </div>

            <form action="reservationhotel_success.php?room=<?= $roomID ?>" method="POST">
                <div class="row">
                    <div class="col">
                        <label>Nama Lengkap:</label>
                        <input type="text" class="form-control" name="fullname" placeholder="Full Name" required <?= ($roomData['rooms'] <= 0) ? 'readonly' : ''; ?>>
                    </div>
                    <div class="col">
                        <label>Check-in:</label>
                        <input type="date" class="form-control" name="in_date" required <?= ($roomData['rooms'] <= 0) ? 'readonly' : ''; ?>>
                    </div>
                    <div class="col">
                        <label>Check-out:</label>
                        <input type="date" class="form-control" name="out_date" required <?= ($roomData['rooms'] <= 0) ? 'readonly' : ''; ?>>
                    </div>
                    <div class="col">
                        <label>No Telp:</label>
                        <input type="text" class="form-control" name="phone" placeholder="Phone number" required <?= ($roomData['rooms'] <= 0) ? 'readonly' : ''; ?>>
                    </div>
                    <div class="col">
                        <label>Email Address:</label>
                        <input type="email" class="form-control" name="email" placeholder="Email address" required <?= ($roomData['rooms'] <= 0) ? 'readonly' : ''; ?>>
                    </div>
                    <div class="col-md-12">
                        <input type="submit" class="form-control btn btn-primary" value="Make Reservation" <?= ($roomData['rooms'] <= 0) ? 'disabled' : ''; ?>>
                    </div>
                </div>
            </form>
        <?php else: ?>
            <p>Room not found.</p>
        <?php endif; ?>
    </div>

    <script src="admin/js/details.js"></script>
</body>
</html>

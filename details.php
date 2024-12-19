// Di bagian atas file details.php
<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Cek jika room ID dikirim melalui GET
if (isset($_GET['room'])) {
    $roomID = $conn->real_escape_string($_GET['room']);
    $select = $conn->query("SELECT * FROM rooms WHERE id = '$roomID'");
    $roomData = $select->fetch_assoc();
} else {
    header("Location: rooms.php");
    exit();
}

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkin'])) {
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $inDate = $conn->real_escape_string($_POST['in_date']);
    $outDate = $conn->real_escape_string($_POST['out_date']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);

    // Validasi input
    if (empty($fullname) || empty($inDate) || empty($outDate) || empty($phone) || empty($email)) {
        $error = "Harap isi semua bidang!";
    } else {
        // Validasi format email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Format email tidak valid!";
        } else {
            // Ambil informasi kamar
            $roomNumber = $roomData['room_number'];
            $price = $roomData['price'];
            
            // Hitung total harga berdasarkan durasi
            $days = (strtotime($outDate) - strtotime($inDate)) / (60 * 60 * 24);
            if ($days <= 0) {
                $error = "Tanggal check-out harus setelah tanggal check-in.";
            } else {
                $totalPrice = $price * $days;

                // Cek ketersediaan kamar
                if ($roomData['rooms'] <= 0) {
                    $error = "Maaf, kamar tidak tersedia.";
                } else {
                    // Prepared statement untuk insert
                    $stmt = $conn->prepare("INSERT INTO reservations (name, checkin, checkout, phone, email, room, total_price) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssssssd", $fullname, $inDate, $outDate, $phone, $email, $roomNumber, $totalPrice);
                    
                    if ($stmt->execute()) {
                        // Update jumlah kamar yang tersedia
                        $newRoomCount = $roomData['rooms'] - 1;
                        $updateStmt = $conn->prepare("UPDATE rooms SET rooms = ? WHERE id = ?");
                        $updateStmt->bind_param("ii", $newRoomCount, $roomID);
                        $updateStmt->execute();
                        
                        // Redirect ke halaman payment
                        header("Location: payment.php?reservation_id=" . $conn->insert_id);
                        exit();
                    } else {
                        $error = "Error: " . $stmt->error;
                    }
                    
                    $stmt->close();
                }
            }
        }
    }
}
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
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/navigation.php'; ?>

    <div class="container">
        <?php if ($roomData): ?>
            <div class="page-header">
                <h2 class="text-center"><?= htmlspecialchars($roomData['room_number']); ?></h2>
            </div>

            <div class="gallery-container">
                <!-- Gambar utama di sebelah kiri -->
                <div class="main-photo">
                    <img class="photo" src="<?= htmlspecialchars($roomData['photo']); ?>" alt="Room Photo">
                </div>
                
                <!-- Grid 2x2 untuk facility images di sebelah kanan -->
                <div class="facility-photos">
                    <?php for ($i = 1; $i <= 4; $i++): ?>
                        <?php if (!empty($roomData["facility$i"])): ?>
                            <div class="facility-wrapper">
                                <img class="facility" src="<?= htmlspecialchars($roomData["facility$i"]); ?>" alt="Facility <?= $i ?>">
                                <?php if ($i === 4): ?>
                                    <button class="view-all-photos">Lihat semua foto</button>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endfor; ?>
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

            <?php if (isset($error)): ?>
                <p style="color: red;"><?= htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="row">
                    <div class="col">
                        <label class="form-control-label">Nama Lengkap:</label>
                        <input type="text" class="form-control" name="fullname" placeholder="Full Name" <?= ($roomData['rooms'] <= 0) ? 'readonly' : ''; ?>>
                    </div>
                    <div class="col">
                        <label class="form-control-label">Check-in:</label>
                        <input type="date" class="form-control" name="in_date" <?= ($roomData['rooms'] <= 0) ? 'readonly' : ''; ?>>
                    </div>
                    <div class="col">
                        <label class="form-control-label">Check-out:</label>
                        <input type="date" class="form-control" name="out_date" <?= ($roomData['rooms'] <= 0) ? 'readonly' : ''; ?>>
                    </div>
                    <div class="col">
                        <label class="form-control-label">No Telp:</label>
                        <input type="text" class="form-control" name="phone" placeholder="Phone number..." <?= ($roomData['rooms'] <= 0) ? 'readonly' : ''; ?>>
                    </div>
                    <div class="col">
                        <label class="form-control-label">Email Address:</label>
                        <input type="email" class="form-control" name="email" placeholder="Email address" <?= ($roomData['rooms'] <= 0) ? 'readonly' : ''; ?>>
                    </div>
                </div>

                <div class="col-md-12">
                    <input type="submit" class="form-control btn btn-primary" value="Make Reservation" name="checkin" <?= ($roomData['rooms'] <= 0) ? 'disabled' : ''; ?>>
                </div>
            </form>

        <?php else: ?>
            <p>Room not found.</p>
        <?php endif; ?>
    </div>

    <script src="admin/js/details.js"></script>
</body>
</html>

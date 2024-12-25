<!-- DETAILS.PHP -->

<?php
ob_start();
require_once 'core/core.php';

// Database connection 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adorable_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
    header("Location: loginregist.php");
    exit();
}

$roomData = null;
if (isset($_GET['room'])) {
    $roomID = $conn->real_escape_string($_GET['room']);
    $stmt = $conn->prepare("SELECT * FROM rooms WHERE id = ?");
    $stmt->bind_param("i", $roomID);
    $stmt->execute();
    $result = $stmt->get_result();
    $roomData = $result->fetch_assoc();

    if(isset($_POST['checkin']) && isset($_POST['in_date']) && isset($_POST['out_date'])) {
        $inDate = $conn->real_escape_string($_POST['in_date']);
        $outDate = $conn->real_escape_string($_POST['out_date']);
        $user_id = $_SESSION['user_id'];
        $booking_date = date('Y-m-d H:i:s');
        
        // Calculate days and total price
        $days = (strtotime($outDate) - strtotime($inDate)) / (60 * 60 * 24);
        $totalPrice = $roomData['price'] * $days;
        
        // Insert booking using prepared statement
        $stmt = $conn->prepare("INSERT INTO room_reserves (room_id, user_id, checkin_date, checkout_date, booking_date, total_price, status) VALUES (?, ?, ?, ?, ?, ?, 'pending')");
        $stmt->bind_param("iisssd", $roomID, $user_id, $inDate, $outDate, $booking_date, $totalPrice);
        
        if($stmt->execute()) {
            $booking_id = $conn->insert_id;
            $newRoomCount = $roomData['rooms'] - 1;
            
            $updateStmt = $conn->prepare("UPDATE rooms SET rooms = ? WHERE id = ?");
            $updateStmt->bind_param("ii", $newRoomCount, $roomID);
            $updateStmt->execute();
            
            $_SESSION['booking_success'] = true;
            $_SESSION['booking_id'] = $booking_id;
            
            header("Location: payment_room.php?booking_id=" . $booking_id);
            exit();
        }
    }
} else {
    header("Location: rooms.php");
    exit();
}

include 'includes/header.php';
include 'includes/navigation.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penginapan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    /* General container styling */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

/* Gallery section styling */
.gallery-section {
    padding: 2rem 0;
    max-width: 1200px;
    margin: 0 auto;
}

.gallery-container {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.main-photo {
    height: 400px;
    position: relative;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

.main-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease-in-out;
}

.facility-photos {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
    height: 200px;
}

.facility-wrapper {
    position: relative;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

.facility {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease-in-out;
}

/* Hotel title styling */
.hotel-title {
    background-color: #f8f9fa;
    padding: 2rem 0;
    margin: 2rem 0;
}

.title-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.hotel-name {
    font-size: 2.5rem;
    color: #333;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.action-icon {
    background: none;
    border: none;
    font-size: 1.5rem;
    color: #007bff;
    cursor: pointer;
    transition: color 0.3s ease;
}

.action-icon:hover {
    color: #0056b3;
}

/* Content grid styling */
.content-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
    margin: 2rem auto;
    max-width: 1200px;
}

/* Main content styling */
.main-content {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.property-features {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.info-box {
    text-align: center;
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 10px;
    transition: transform 0.3s ease;
}

.info-box:hover {
    transform: translateY(-5px);
}

.info-box i {
    font-size: 2rem;
    color: #007bff;
    margin-bottom: 1rem;
}

.info-box h3 {
    font-size: 1.2rem;
    color: #333;
    margin-bottom: 0.5rem;
}

.info-box p {
    color: #666;
}

.property-description {
    margin-top: 2rem;
    color: #666;
    line-height: 1.6;
}

/* Booking sidebar styling */
.booking-sidebar {
    position: sticky;
    top: 2rem;
}

.booking-form {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.2);
}

.booking-form h3 {
    text-align: center;
    color: #333;
    margin-bottom: 1.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    color: #666;
}

.form-control {
    width: 100%;
    padding: 0.8rem 1.2rem;
    border: 1px solid #ddd;
    border-radius: 25px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    border-color: #007bff;
    outline: none;
}

.btn-request {
    width: 100%;
    padding: 1rem;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 25px;
    font-size: 1rem;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-request:hover {
    background: #0056b3;
}

/* Success alert styling */
.alert-success {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0,0,0,0.2);
    text-align: center;
    z-index: 1000;
    display: none;
}

.alert-success.show {
    display: block;
}

.alert-success h3 {
    color: #28a745;
    margin-bottom: 1rem;
}

.footer {
    background: #333;
    color: white;
    padding: 3rem 0;
    margin-top: 4rem;
}

.social-icons a {
    color: white;
    margin: 0 10px;
    font-size: 1.5rem;
    transition: color 0.3s ease;
}

.social-icons a:hover {
    color: #007bff;
}

.popup-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            display: none;
        }

        .success-popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            z-index: 1000;
            text-align: center;
            display: none;
        }

        .btn-payment {
            display: inline-block;
            padding: 10px 20px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }

        .btn-payment:hover {
            background: #218838;
            color: white;
        }

/* Responsive design */
@media (max-width: 992px) {
    .content-grid {
        grid-template-columns: 1fr;
    }
    
    .booking-sidebar {
        position: static;
    }
    
    .property-features {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .facility-photos {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .hotel-name {
        font-size: 2rem;
    }
    
    .property-features {
        grid-template-columns: 1fr;
    }
    
    .main-photo {
        height: 300px;
    }
}

@media (max-width: 576px) {
    .container {
        padding: 1rem;
    }
    
    .booking-form {
        padding: 1.5rem;
    }
    
    .hotel-name {
        font-size: 1.8rem;
    }
}
</style>
</head>
<body>
    <?php include 'includes/navigation.php'; ?>

    <div class="container">
        <?php if ($roomData): ?>
            <div class="gallery-section">
                <div class="gallery-container">
                    <div class="main-photo">
                        <img class="photo" src="<?= htmlspecialchars($roomData['photo']); ?>" alt="Room Photo">
                    </div>
                    
                    <div class="facility-photos">
                        <?php for ($i = 1; $i <= 4; $i++): ?>
                            <?php if (!empty($roomData["facility$i"])): ?>
                                <div class="facility-wrapper">
                                    <img class="facility" src="<?= htmlspecialchars($roomData["facility$i"]); ?>" alt="Facility <?= $i ?>">
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>

            <div class="hotel-title">
                <div class="title-container">
                    <h1 class="hotel-name">
                        <?= htmlspecialchars($roomData['room_number']); ?>
                        <button class="action-icon cart-btn" title="Add to Cart">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                    </h1>
                </div>
            </div>

            <div class="content-grid">
                <div class="main-content">
                    <div class="info-container">
                        <div class="property-features">
                            <div class="info-box feature">
                                <i class="fas fa-home"></i>
                                <h3>Tipe</h3>
                                <p><?= htmlspecialchars($roomData['type']); ?></p>
                            </div>
                            <div class="info-box feature">
                                <i class="fas fa-door-open"></i>
                                <h3>Sisa</h3>
                                <p><?= htmlspecialchars($roomData['rooms']); ?> kamar</p>
                            </div>
                            <div class="info-box feature">
                                <i class="fas fa-tag"></i>
                                <h3>Harga</h3>
                                <p>Rp. <?= htmlspecialchars(number_format($roomData['price'], 0, ',', '.')); ?></p>
                            </div>
                        </div>

                        <div class="property-description">
                            <?= !empty($roomData['description']) ? nl2br(htmlspecialchars($roomData['description'])) : '
                                <p>Selamat datang di properti bergaya dan luas kami...</p>
                                <p>Saat Anda masuk, Anda akan disambut...</p>
                                <p>Tata ruang terbuka yang menyatu secara sempurna...</p>
                            '; ?>
                        </div>
                    </div>
                </div>

                <div class="booking-sidebar">
                    <div class="booking-form">
                        <h3>Booking Details</h3>
                        <?php if($roomData['rooms'] > 0): ?>
                            <form action="" method="POST" onsubmit="return validateForm()">
                                <div class="form-group">
                                    <label>Check-in:</label>
                                    <input type="date" class="form-control" name="in_date" required 
                                           min="<?= date('Y-m-d') ?>">
                                </div>
                                <div class="form-group">
                                    <label>Check-out:</label>
                                    <input type="date" class="form-control" name="out_date" required
                                           min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                                </div>
                                <button type="submit" class="btn-request" name="checkin">
                                    Make Reservation
                                </button>
                            </form>
                        <?php else: ?>
                            <div class="text-center text-danger">
                                <h4>No rooms available</h4>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Success Popup -->
    <div class="popup-backdrop" id="popupBackdrop"></div>
    <div class="success-popup" id="successPopup">
        <h3><i class="fas fa-check-circle"></i> Booking Success!</h3>
        <p>Thank you for booking, please proceed with payment!</p>
        <a href="payment_room.php?booking_id=<?php echo isset($_SESSION['booking_id']) ? $_SESSION['booking_id'] : ''; ?>" class="btn-payment">Pay Now</a>
    </div>

    <footer style="background-color: #222222; color: white; padding: 60px 0; font-family: system-ui, -apple-system, sans-serif;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px;">
        <div>
            <h4 style="font-size: 24px; margin: 0 0 20px 0; font-weight: 500;">Tentang Kita</h4>
            <p style="line-height: 1.6; margin: 0; opacity: 0.9;">
                Rasakan keindahan dan budaya Toraja dengan tur berpemandu ahli kami. Kami memberikan petualangan yang tak terlupakan dan pengalaman lokal yang otentik.</p>
        </div>
        <div>
            <h4 style="font-size: 24px; margin: 0 0 20px 0; font-weight: 500;">Kontak Kami</h4>
            <p style="margin: 0 0 15px 0; display: flex; align-items: center; gap: 10px;">
                <span style="color: white;">+62 821 3387 1850</span>
            </p>
            <p style="margin: 0 0 15px 0;">
                <span style="color: white;">info@torajatours.com</span>
            </p>
            <p style="margin: 0;">
                <span style="color: white;">Toraja, Sulawesi Selatan, Indonesia</span>
            </p>
        </div>
        <div>
            <h4 style="font-size: 24px; margin: 0 0 20px 0; font-weight: 500;">Follow Us</h4>
            <div style="display: flex; gap: 15px;">
                <a href="#" style="color: white; text-decoration: none;">
                    <i class="fab fa-facebook" style="font-size: 20px;"></i>
                </a>
                <a href="#" style="color: white; text-decoration: none;">
                    <i class="fab fa-instagram" style="font-size: 20px;"></i>
                </a>
                <a href="#" style="color: white; text-decoration: none;">
                    <i class="fab fa-twitter" style="font-size: 20px;"></i>
                </a>
                <a href="#" style="color: white; text-decoration: none;">
                    <i class="fab fa-youtube" style="font-size: 20px;"></i>
                </a>
            </div>
        </div>
    </div>
    <div style="text-align: center; margin-top: 40px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.1);">
        <p style="margin: 0; opacity: 0.7; font-size: 14px;">&copy; Wisata Toraja 2024. Semua hak dilindungi undang-undang.</p>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if(isset($_SESSION['booking_success']) && $_SESSION['booking_success']): ?>
            document.getElementById('popupBackdrop').style.display = 'block';
            document.getElementById('successPopup').style.display = 'block';
            <?php unset($_SESSION['booking_success']); ?>
        <?php endif; ?>

        document.getElementById('popupBackdrop').addEventListener('click', function() {
            this.style.display = 'none';
            document.getElementById('successPopup').style.display = 'none';
        });
    });

    function validateForm() {
        const inDate = document.querySelector('input[name="in_date"]').value;
        const outDate = document.querySelector('input[name="out_date"]').value;
        
        if (new Date(inDate) >= new Date(outDate)) {
            alert('Check-out date must be after check-in date');
            return false;
        }
        return true;
    }
    </script>
</body>
</html>


<?php
session_start();
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_errno) {
    die("Failed to connect to MySQL: " . $conn->connect_error);
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

// Proses penyimpanan data reservasi
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkin'])) {
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $inDate = $conn->real_escape_string($_POST['in_date']);
    $outDate = $conn->real_escape_string($_POST['out_date']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    $room = $roomData['room_number'];
    
    // Hitung total harga
    $days = (strtotime($outDate) - strtotime($inDate)) / (60 * 60 * 24);
    $totalPrice = $roomData['price'] * $days;
    
    // Query untuk menyimpan data
    $sql = "INSERT INTO reservations (name, checkin, checkout, phone, email, room, total_price) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssd", $fullname, $inDate, $outDate, $phone, $email, $room, $totalPrice);
    
    if ($stmt->execute()) {
        // Update jumlah kamar
        $newRoomCount = $roomData['rooms'] - 1;
        $updateStmt = $conn->prepare("UPDATE rooms SET rooms = ? WHERE id = ?");
        $updateStmt->bind_param("ii", $newRoomCount, $roomID);
        $updateStmt->execute();
        
        // Siapkan data untuk halaman summary
        $_SESSION['reservation_data'] = [
            'name' => $fullname,
            'room_type' => $roomData['type'],
            'room_number' => $room,
            'checkin' => $inDate,
            'checkout' => $outDate,
            'phone' => $phone,
            'email' => $email,
            'total_price' => $totalPrice,
            'reservation_id' => $conn->insert_id
        ];
        
        // Redirect ke halaman summary
        header("Location: reservation-summary.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penginapan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Tambahkan setelah link CSS yang ada -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/18.2.0/umd/react.development.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/18.2.0/umd/react-dom.development.js"></script>

</head>
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

<body>
    <?php include 'includes/navigation.php'; ?>

    <div class="container">
        <?php if ($roomData): ?>
            <!-- Area gambar full width -->
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
                                    <?php if ($i === 4): ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>

            <!-- Tambahkan ini setelah gallery-section dan sebelum content-grid -->
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

            <!-- Area konten dengan grid 2 kolom -->
            <div class="content-grid">
                <!-- Kolom kiri - Info dan deskripsi -->
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
                            <?php if (!empty($roomData['description'])): ?>
                                <p><?= nl2br(htmlspecialchars($roomData['description'])); ?></p>
                            <?php else: ?>
                                <p>Selamat datang di properti bergaya dan luas kami. Tempat menawan ini menawarkan kenyamanan modern yang dirancang untuk memberikan pengalaman menginap yang tak terlupakan. Lokasinya yang strategis, dikelilingi oleh pemandangan indah dan suasana tenang, menjadikannya pilihan sempurna untuk bersantai maupun bekerja.</p>
                                <p>Saat Anda masuk, Anda akan disambut dengan ruang tamu yang didesain dengan perabotan berkelas, dilengkapi sofa nyaman, TV besar untuk hiburan Anda, dan area ruang makan yang ideal untuk berkumpul bersama keluarga atau teman. Kombinasi warna yang hangat dan pencahayaan yang lembut menciptakan suasana yang ramah dan menenangkan.</p>
                                <p>Tata ruang terbuka yang menyatu secara sempurna menghubungkan ruang tamu dengan dapur modern yang dirancang untuk memenuhi kebutuhan Anda. Dapur ini dilengkapi dengan peralatan canggih seperti oven, kompor, lemari es, dan perlengkapan memasak lainnya, memungkinkan Anda untuk menyiapkan hidangan lezat tanpa kesulitan. Selain itu, area dapur juga dirancang ergonomis, memastikan kenyamanan selama Anda memasak.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Kolom kanan - Form booking -->
                <div class="booking-sidebar">
                    <div class="booking-form">
                        <h3>Booking details</h3>
                        <?php if (isset($error)): ?>
                            <div class="error-message"><?= htmlspecialchars($error); ?></div>
                        <?php endif; ?>

                        <form action="" method="POST" onsubmit="return validateForm()">
                            <div class="form-group">
                                <label>Nama Lengkap:</label>
                                <input type="text" class="form-control" name="fullname" placeholder="Full Name" required>
                            </div>

                            <div class="form-group">
                                <label>Check-in:</label>
                                <input type="date" class="form-control" name="in_date" required>
                            </div>

                            <div class="form-group">
                                <label>Check-out:</label>
                                <input type="date" class="form-control" name="out_date" required>
                            </div>

                            <div class="form-group">
                                <label>No Telp:</label>
                                <input type="text" class="form-control" name="phone" placeholder="Phone number..." required>
                            </div>

                            <div class="form-group">
                                <label>Email Address:</label>
                                <input type="email" class="form-control" name="email" placeholder="Email address" required>
                            </div>

                            <button type="submit" class="btn-request" name="checkin">
                                Make Reservation
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <p>Room not found.</p>
        <?php endif; ?>

    <?php if (isset($_SESSION['reservation_success']) && $_SESSION['reservation_success']): ?>
        <div class="alert-success show">
            <h3>Reservasi Berhasil!</h3>
            <p>Nomor reservasi Anda adalah #<?php echo $_SESSION['reservation_id']; ?></p>
        </div>
        <?php
        // Hapus session setelah ditampilkan
        unset($_SESSION['reservation_success']);
        unset($_SESSION['reservation_id']);
        ?>
    <?php endif; ?>

<footer class="footer" style="background-color: #333; color: white; padding: 3rem 0; margin-top: 4rem;">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4>Tentang Kita</h4>
                <p>
                Rasakan keindahan dan budaya Toraja dengan tur berpemandu ahli kami. Kami memberikan petualangan yang tak terlupakan dan pengalaman lokal yang otentik.</p>
            </div>
            <div class="col-md-4">
                <h4>Kontak Kami</h4>
                <p><i class="fas fa-phone"></i> +62 821 3387 1850</p>
                <p><i class="fas fa-envelope"></i> info@torajatours.com</p>
                <p><i class="fas fa-map-marker-alt"></i> Toraja, Sulawesi Selatan, Indonesia</p>
            </div>
            <div class="col-md-4">
                <h4>Follow Us</h4>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <p>&copy; Wisata Toraja 2024. Semua hak dilindungi undang-undang.</p>
        </div>
    </div>
</footer>

    <script src="admin/js/details.js"></script>
</body>
</html>
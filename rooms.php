<?php
require_once 'core/core.php';
include 'includes/header.php';
include 'includes/navigation.php';

// Initialize search and filter parameters
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Prepare the SQL query with parameterized query
$sql = "SELECT * FROM rooms WHERE 1=1";
$params = array();

if (!empty($search)) {
    $sql .= " AND (room_number LIKE ? OR details LIKE ?)";
    $searchParam = "%" . $search . "%";
    $params[] = $searchParam;
    $params[] = $searchParam;
}

// Prepare and execute the statement
$stmt = $db->prepare($sql);

if (!empty($params)) {
    $types = str_repeat('s', count($params));
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
.container {
    padding: 40px 15px;
}

.page-title {
    text-align: center;
    margin-bottom: 50px;
}

.page-title h1 {
    color: #2c3e50;
    font-size: 2.5rem;
    margin-bottom: 15px;
}

.page-title p {
    color: #7f8c8d;
    font-size: 1.1rem;
}

.search-filter-container {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.search-box {
    position: relative;
    margin-bottom: 20px;
}

.search-box input {
    width: 100%;
    padding: 12px 40px 12px 20px;
    border: 2px solid #e74c3c;
    border-radius: 6px;
    font-size: 1rem;
}

.search-box .search-icon {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #e74c3c;
}

.filter-options {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.filter-select {
    padding: 10px 20px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 0.9rem;
    flex: 1;
    min-width: 150px;
}

.col-lg-3 {
    margin-bottom: 30px;
}

.room-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
}

.room-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.room-number {
    background: #2c3e50;
    color: white;
    padding: 10px;
    font-size: 1.2rem;
    text-align: center;
    margin: 0;
}

.room-img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.room-details {
    padding: 20px;
}

.room-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 15px;
    color: #7f8c8d;
    font-size: 0.9rem;
}

.room-meta span {
    display: flex;
    align-items: center;
    margin-right: 15px;
}

.room-meta i {
    margin-right: 5px;
    color: #e74c3c;
}

.room-description {
    color: #34495e;
    line-height: 1.6;
    margin-bottom: 20px;
    font-size: 0.95rem;
}

.price {
    color: #e74c3c;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 15px;
}

.btn-primary {
    background-color: #e74c3c;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 6px;
    transition: background-color 0.3s ease;
    text-decoration: none;
    display: block;
    text-align: center;
    font-weight: 500;
}

.btn-primary:hover {
    background-color: #c0392b;
}

.room-status {
    position: absolute;
    top: 20px;
    right: 20px;
    background: #27ae60;
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.8rem;
}

.room-status.booked {
    background: #e74c3c;
}

.social-icons a {
    color: white;
    margin-right: 15px;
    font-size: 1.5rem;
    transition: color 0.3s ease;
}

.social-icons a:hover {
    color: #e74c3c;
}

.no-results {
    text-align: center;
    padding: 40px;
    background: white;
    border-radius: 12px;
    margin: 20px 0;
    width: 100%;
}

.no-results i {
    font-size: 3rem;
    color: #e74c3c;
    margin-bottom: 20px;
}

.no-results h3 {
    color: #2c3e50;
    margin-bottom: 10px;
}

.no-results p {
    color: #7f8c8d;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.room-card {
    animation: fadeIn 0.5s ease-out forwards;
}
</style>

<div class="container">
    <div class="page-title">
        <h1>Kamar Hotel Kami</h1>
        <p>Temukan kenyamanan dan kemewahan dalam setiap kamar kami</p>
    </div>
    
    <div class="search-filter-container">
        <form action="" method="GET" id="searchForm">
            <div class="search-box">
                <input type="text" name="search" placeholder="Cari kamar..." value="<?= htmlspecialchars($search) ?>">
                <i class="fas fa-search search-icon"></i>
            </div>
        </form>
    </div>

    <div class="row">
        <?php 
        if ($result->num_rows > 0):
            while($room = $result->fetch_assoc()): 
        ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="room-card">
                    <h4 class="room-number">Kamar <?= htmlspecialchars($room['room_number']); ?></h4>
                    <img src="<?= htmlspecialchars($room['photo']); ?>" class="room-img" alt="room" onerror="this.src='default-room.jpg'">
                    <div class="room-status"><?= isset($room['status']) && $room['status'] === 'booked' ? 'Dipesan' : 'Tersedia' ?></div>
                    <div class="room-details">
                        <div class="room-meta">
                            <span><i class="fas fa-bed"></i> 2 Tempat Tidur</span>
                            <span><i class="fas fa-users"></i> Max 2 Tamu</span>
                            <span><i class="fas fa-wifi"></i> WiFi Gratis</span>
                            <span><i class="fas fa-snowflake"></i> AC</span>
                        </div>
                        <div class="price">
                            Rp. <?= number_format(floatval($room['price']), 0, ',', '.'); ?>
                        </div>
                        <p class="room-description">
                            <?= htmlspecialchars($room['details']); ?>
                        </p>
                        <a href="details.php?room=<?= htmlspecialchars($room['id']); ?>" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        <?php 
            endwhile;
        else:
        ?>
            <div class="no-results">
                <i class="fas fa-search"></i>
                <h3>Tidak ada kamar ditemukan</h3>
                <p>Mohon coba dengan kata kunci pencarian yang berbeda</p>
            </div>
        <?php 
        endif;
        
        // Close the statement
        $stmt->close();
        ?>
    </div>
</div>

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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate cards on scroll
    const cards = document.querySelectorAll('.room-card');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1
    });

    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.5s ease-out';
        observer.observe(card);
    });

    // Add event listener for search input
    const searchInput = document.querySelector('input[name="search"]');
    let timeoutId;

    searchInput.addEventListener('input', function() {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => {
            document.getElementById('searchForm').submit();
        }, 500); // Submit after 500ms of no typing
    });
});
</script>
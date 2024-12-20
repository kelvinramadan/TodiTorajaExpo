<?php
require_once 'core/core.php';
include 'includes/header.php';
include 'includes/navigation.php';

// Handle filter for rooms
$roomFilter = isset($_GET['room_search']) ? $_GET['room_search'] : '';
$roomQuery = "SELECT * FROM rooms";
if ($roomFilter !== '') {
    $roomQuery .= " WHERE room_number LIKE '%$roomFilter%' OR details LIKE '%$roomFilter%'";
}
$roomQuery .= " LIMIT 4";
$sql = $db->query($roomQuery);

// Handle filter for tourism
$tourFilter = isset($_GET['tour_search']) ? $_GET['tour_search'] : '';
$tourQuery = "SELECT * FROM tourism";
if ($tourFilter !== '') {
    $tourQuery .= " WHERE title LIKE '%$tourFilter%' OR details LIKE '%$tourFilter%'";
}
$tourQuery .= " LIMIT 4";
$tourSQL = $db->query($tourQuery);

$result = $db->query("SELECT * FROM events");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel & Tourism</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="headerindex.css">
    <link rel="stylesheet" href="eventindex.css">
    <link rel="stylesheet" href="tourimscard.css">
    <link rel="stylesheet" href="roomcard.css">

</head>
<body>

<!-- Header Section -->
<header class="dynamic-header">
    <section class="hero">
        <div class="hero-slider">
            <!-- Multiple background images for slider -->
            <div class="slide" style="background-image: url('images/toraja.jpg')"></div>
            <div class="slide" style="background-image: url('images/toraja1.jpg')"></div>
            <div class="slide" style="background-image: url('images/toraja2.jpg')"></div>
        </div>
        <div class="overlay"></div>
        
        <div class="hero-content">
            <h1 class="animate-text" style="color:#FFFFFF">TodiToraja</h1>
            <p class="animate-text-delay">Pengalaman berwisata yang menarik dan alternatif serta berbagi bersama tentang budaya lokal tanah Toraja secara menyeluruh bersama kami TodiToraja</p>
            
            <!-- Animated stats -->
            <div class="stats-container">
                <div class="stat-item">
                    <span class="stat-number" data-target="1000">0</span>
                    <span class="stat-label">Wisatawan</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number" data-target="50">0</span>
                    <span class="stat-label">Destinasi</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number" data-target="100">0</span>
                    <span class="stat-label">Hotel</span>
                </div>
            </div>
        </div>

        <!-- Search bar with enhanced design -->
        <div class="search-container">
            <form method="GET" class="search-form glass-effect">
                <div class="search-grid">
                    <div class="search-item">
                        <i class="fas fa-hotel"></i>
                        <input type="text" name="room_search" placeholder="Cari Penginapan" value="<?= htmlspecialchars($roomFilter); ?>">
                    </div>
                    <div class="search-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <input type="text" name="tour_search" placeholder="Cari Wisata" value="<?= htmlspecialchars($tourFilter); ?>">
                    </div>
                    <button type="submit" class="search-button">
                        <i class="fas fa-search"></i>
                        Cari
                    </button>
                </div>
            </form>
        </div>

        <!-- Scroll indicator -->
        <div class="scroll-indicator">
            <span class="mouse">
                <span class="wheel"></span>
            </span>
            <p>Scroll untuk menjelajahi</p>
        </div>
    </section>
</header>


<!-- EVENT -->
<div class="container mt-5">
    <h1 class="text-center">Events</h1>
    <div class="row">
        <?php while($event = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm accommodation-card" onclick="openModal(this)" data-event='<?= json_encode($event); ?>'>
                    <div class="image-wrapper">
                        <img src="<?= $event['image']; ?>" class="card-img-top" alt="<?= $event['event_topic']; ?>">
                        <button class="favorite-btn" onclick="event.stopPropagation()">
                            <i class="far fa-heart"></i>
                        </button>
                        <?php if(isset($event['is_featured'])): ?>
                            <span class="guest-favorite">Guest favorite</span>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="location-wrapper">
                            <h5 class="location-title"><?= $event['venue']; ?></h5>
                            <?php if(isset($event['rating'])): ?>
                                <span class="rating">★ <?= $event['rating']; ?></span>
                            <?php endif; ?>
                        </div>
                        <p class="distance-text"><?= $event['distance'] ?? ''; ?> kilometers away</p>
                        <p class="date-text"><?= $event['date']; ?> – <?= $event['time']; ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<div class="event-modal" id="eventModal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModal()">&times;</span>
        <div class="modal-body">
            <div class="modal-image">
                <img id="modalImage" src="" alt="Event Image">
            </div>
            <div class="modal-details">
                <div class="modal-header">
                    <h2 id="modalVenue"></h2>
                    <div class="rating-wrapper">
                        <span class="rating" id="modalRating"></span>
                    </div>
                </div>
                <div class="modal-info">
                    <p class="distance" id="modalDistance"></p>
                    <p class="schedule" id="modalSchedule"></p>
                    <p class="topic" id="modalTopic"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TOURISM SECTION -->
<div class="container mt-5">
    <h1 class="text-center">Destinasi Wisata Terpopuler</h1>
    <div class="row">
        <?php while($tour = mysqli_fetch_assoc($tourSQL)): ?>
            <div class="col-md-4">
                <a href="tour.php?tour=<?= $tour['id']; ?>" class="text-decoration-none">
                    <div class="card mb-4 shadow-sm accommodation-card">
                        <div class="image-wrapper">
                            <img src="<?= $tour['photo']; ?>" class="card-img-top" alt="<?= $tour['title']; ?>">
                            <button class="favorite-btn" onclick="event.stopPropagation(); event.preventDefault();">
                                <i class="far fa-heart"></i>
                            </button>
                            <?php if(isset($tour['is_featured'])): ?>
                                <span class="guest-favorite">Guest favorite</span>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <div class="location-wrapper">
                                <h5 class="location-title"><?= $tour['title']; ?></h5>
                                <?php if(isset($tour['rating'])): ?>
                                    <span class="rating">★ <?= $tour['rating']; ?></span>
                                <?php endif; ?>
                            </div>
                            <p class="accommodation-count">
                                <i class="fas fa-building"></i> 
                            </p>
                            <p class="card-text"><?= substr($tour['details'], 0, 100); ?>...</p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- Rooms Section -->
<section class="py-5">
    <div class="container">
        <h1 class="text-center mb-4">PENGINAPAN</h1>
        <div class="row">
            <?php while($room = mysqli_fetch_assoc($sql)): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="details.php?room=<?= $room['id']; ?>" class="text-decoration-none">
                        <div class="card mb-4 shadow-sm accommodation-card">
                            <div class="image-wrapper">
                                <img src="<?= $room['photo']; ?>" class="card-img-top" alt="<?= $room['room_number']; ?>">
                                <button class="favorite-btn" onclick="event.stopPropagation(); event.preventDefault();">
                                    <i class="far fa-heart"></i>
                                </button>
                                <?php if(isset($room['is_featured']) && $room['is_featured']): ?>
                                    <span class="guest-favorite">Guest favorite</span>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <div class="location-wrapper">
                                    <h5 class="location-title">Room <?= $room['room_number']; ?></h5>
                                    <?php if(isset($room['rating'])): ?>
                                        <span class="rating">★ <?= $room['rating']; ?></span>
                                    <?php endif; ?>
                                </div>
                                <p class="accommodation-count">
                                    <i class="fas fa-bed"></i> 
                                    <?php if(isset($room['capacity'])): ?>
                                        <?= $room['capacity']; ?> Orang
                                    <?php endif; ?>
                                </p>
                                <p class="card-text"><?= substr($room['details'], 0, 100); ?>...</p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="py-4">
    <div class="container text-center">
        <p class="m-0">&copy; 2024 Hotel & Tourism</p>
    </div>
</footer>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/popper/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
<script src="tourismcard.js"></script>
<script src="tourismcard2.js"></script>
<script src="eventindex.js"></script>
<script src="headerindex.js"></script>
<script src="roomcard.js"></script>

</body>
</html>

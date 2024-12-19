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
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="tesajah.css">
    <link rel="stylesheet" href="eventindex.css">

</head>
<body>

<!-- Header Section -->
<header>
        <section class="hero">
            <img src="images/toraja.jpg" alt="Toraja" class="hero-bg">
            <div class="hero-content">
                <h1>TodiToraja</h1>
                <p>Pengalaman berwisata yang menarik dan alternatif serta berbagi bersama tentang budaya lokal tanah Toraja secara menyeluruh bersama kami TodiToraja</p>
            </div>
            <!-- Search bar -->
            <div class="search-container">
                <form method="GET" class="search-form">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="room_search" class="form-control" placeholder="Cari Penginapan" value="<?= htmlspecialchars($roomFilter); ?>">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="tour_search" class="form-control" placeholder="Cari Wisata" value="<?= htmlspecialchars($tourFilter); ?>">
                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
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


<!-- Tourism Section -->
<section class="py-5">
    <div class="container">
        <h1 class="text-center mb-4">WISATA</h1>
        
        <!-- Slider main container -->
        <div class="swiper tourSwiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <?php while($tour = mysqli_fetch_assoc($tourSQL)): ?>
                    <div class="swiper-slide">
                        <div class="card">
                            <img src="<?= $tour['photo']; ?>" class="card-img-top" alt="tour image" style="height: 250px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title text-center"><?= $tour['title']; ?></h5>
                                <p class="card-text"><?= $tour['details']; ?></p>
                                <a href="tour.php?tour=<?= $tour['id']; ?>" class="btn btn-primary w-100">More Details</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            
            <!-- Navigation buttons -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            
            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<!-- Rooms Section -->
<section class="py-5">
    <div class="container">
        <h1 class="text-center mb-4">PENGINAPAN</h1>
        <div class="row">
        <?php while($room = mysqli_fetch_assoc($sql)): ?>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <img src="<?= $room['photo']; ?>" class="card-img-top" alt="room image" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?= $room['room_number']; ?></h5>
                        <p class="card-text text-justify"><?= $room['details']; ?></p>
                        <a href="details.php?room=<?= $room['id']; ?>" class="btn btn-primary btn-block">More Details</a>
                    </div>
                </div>
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
<script src="tourismcard.js"></script>
<script src="eventindex.js"></script>

</body>
</html>

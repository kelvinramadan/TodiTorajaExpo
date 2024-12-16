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
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="tesajah.css">
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

<div class="container mt-5">
    <h1 class="text-center">Events</h1>
    <div class="row">
        <?php while($event = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="<?= $event['image']; ?>" class="card-img-top" alt="<?= $event['event_topic']; ?>" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $event['event_topic']; ?></h5>
                        <p class="card-text"><?= $event['short_details']; ?></p>
                        <p><strong>Venue:</strong> <?= $event['venue']; ?></p>
                        <p><strong>Date:</strong> <?= $event['date']; ?> <strong>Time:</strong> <?= $event['time']; ?></p>
                        <a href="event_detail.php?id=<?= $event['id']; ?>" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- Tourism Section -->
<section class="py-5">
    <div class="container">
        <h1 class="text-center mb-4">WISATA</h1>
        <div class="row">
        <?php while($tour = mysqli_fetch_assoc($tourSQL)): ?>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <img src="<?= $tour['photo']; ?>" class="card-img-top" alt="tour image" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?= $tour['title']; ?></h5>
                        <p class="card-text text-justify"><?= $tour['details']; ?></p>
                        <a href="tour.php?tour=<?= $tour['id']; ?>" class="btn btn-primary btn-block">More Details</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
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

</body>
</html>

<?php
require_once 'core/core.php';
include 'includes/header.php';
include 'includes/navigation.php';
$sql = $db->query("SELECT * FROM rooms LIMIT 4");
$tourSQL = $db->query("SELECT * FROM tourism LIMIT 4");
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
    <style>
        .bg-image-full {
            background-position: center;
            background-size: cover;
        }
        .card:hover {
            transform: scale(1.05);
            transition: all 0.3s ease-in-out;
        }
        footer {
            background-color: #343a40;
            color: white;
        }
    </style>
</head>
<body>

<!-- Header Section -->
<header class="py-5 bg-image-full" style="background-image: url('images/slide-2.jpg'); height:300px">
</header>

<!-- Tourism Section -->
<section class="py-5">
    <div class="container">
        <h1 class="text-center mb-4">WISATA</h1>
        <div class="row">
        <?php while($tour = mysqli_fetch_assoc($tourSQL)): ?>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <img src="<?=$tour['photo'];?>" class="card-img-top" alt="tour image" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?=$tour['title'];?></h5>
                        <p class="card-text text-justify"><?=$tour['details'];?></p>
                        <a href="tour.php?tour=<?=$tour['id'];?>" class="btn btn-primary btn-block">More Details</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        </div>
    </div>
</section>

<!-- Event Section -->
<div class="container py-5">
    <div class="text-center mb-4">
        <h3><?= (mysqli_num_rows($result) <= 0) ? 'Tidak Ada Festival Tersedia' : 'FESTIVAL YANG AKAN DATANG!'; ?></h3>
    </div>
    <div class="row">
        <?php if(mysqli_num_rows($result) > 0): ?>
            <?php while($rows = mysqli_fetch_assoc($result)): ?>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card">
                        <img src="<?=$rows['image'];?>" class="card-img-top" alt="event image" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title text-center"><?=$rows['event_topic'];?></h5>
                            <p class="card-text text-justify"><?=$rows['short_details'];?></p>
                            <a href="view.php?view=<?=$rows['id'];?>" class="btn btn-dark btn-block">More Details</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Rooms Section -->
<section class="py-5">
    <div class="container">
        <h1 class="text-center mb-4">PENGINAPAN</h1>
        <div class="row">
        <?php while($room = mysqli_fetch_assoc($sql)): ?>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <img src="<?=$room['photo'];?>" class="card-img-top" alt="room image" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?=$room['room_number'];?></h5>
                        <p class="card-text text-justify"><?=$room['details'];?></p>
                        <a href="details.php?room=<?=$room['id'];?>" class="btn btn-primary btn-block">More Details</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        </div>
    </div>
</section>

<!-- Image Section -->
<section class="py-5 bg-image-full" style="background-image: url('images/slide-2.jpg'); height: 200px;">
</section>

<!-- Footer -->
<footer class="py-4">
    <div class="container text-center">
        <p class="m-0">&copy; 2024 Hotel & Tourism</p>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/popper/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ht/core/core.php';
if (!is_logged_in()) {
    login_error_check();
}

include 'includes/header.php';
include 'includes/navigation.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: loginregist.php");
    exit();
}
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="scss">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="headerindex.css">
    <link rel="stylesheet" href="css/indexcard.css">
    <link rel="stylesheet" href="eventindex.css">

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

        <div class="form-group col-md-4">
            <label>Room Type:</label>
            <select class="form-control" name="type">
                <option value="Executive" <?= (isset($edit['type']) && $edit['type'] == 'Executive') ? 'selected' : ''; ?>>Executive</option>
                <option value="Regular" <?= (isset($edit['type']) && $edit['type'] == 'Regular') ? 'selected' : ''; ?>>Regular</option>
                <option value="Deluxe" <?= (isset($edit['type']) && $edit['type'] == 'Deluxe') ? 'selected' : ''; ?>>Deluxe</option>
            </select>
        </div>

        <div class="form-group col-md-2">
            <label>Room Price:</label>
            <input type="text" class="form-control" value="<?= isset($_GET['edit']) ? $edit['price'] : ''; ?>" name="price">
        </div>

        <div class="form-group col-md-2">
            <label>Rooms Available:</label>
            <input type="number" class="form-control" value="<?= isset($_GET['edit']) ? $edit['rooms'] : ''; ?>" name="rooms">
        </div>

        <div class="form-group col-md-4">
            <label>Room Photo:</label>
            <input type="file" class="form-control" name="photo">
        </div>

        <div class="form-group col-md-4">
            <label>Facility 1 Photo:</label>
            <input type="file" class="form-control" name="facility1">
        </div>

        <div class="form-group col-md-4">
            <label>Facility 2 Photo:</label>
            <input type="file" class="form-control" name="facility2">
        </div>

        <div class="form-group col-md-4">
            <label>Facility 3 Photo:</label>
            <input type="file" class="form-control" name="facility3">
        </div>

        <div class="form-group col-md-4">
            <label>Facility 4 Photo:</label>
            <input type="file" class="form-control" name="facility4">
        </div>

        <div class="form-group col-md-4">
            <label>Description:</label>
            <textarea class="form-control" rows="6" name="description"><?= isset($_GET['edit']) ? $edit['details'] : ''; ?></textarea>
        </div>

        <div class="form-group col-md-4">
            <label></label>
            <input type="submit" class="btn btn-block btn-lg btn-success" value="<?= isset($_GET['edit']) ? 'Update Room' : 'Add Room'; ?>" name="<?= isset($_GET['edit']) ? 'update' : 'submit'; ?>">
        </div>

        <?php if (isset($_GET['edit']) && !empty($_GET['edit'])) : ?>
            <div class="form-group col-md-4">
                <label></label>
                <a class="btn btn-block btn-danger btn-lg" href="rooms.php">Cancel Edit</a>
            </div>
        <?php endif; ?>
    </form>
</div>

<script>
function w3_open() {
    document.getElementsByClassName("w3-sidenav")[0].style.display = "block";
}
function w3_close() {
    document.getElementsByClassName("w3-sidenav")[0].style.display = "none";
}
</script>

<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
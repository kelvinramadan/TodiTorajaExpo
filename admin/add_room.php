<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ht/core/core.php';
if (!is_logged_in()) {
    login_error_check();
}

include 'includes/header.php';
include 'includes/navigation.php';

if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $id = $_GET['edit'];
    $get = $db->query("SELECT * FROM rooms WHERE id = '$id'");
    $edit = mysqli_fetch_assoc($get);
}

// VALIDATING AND MOVING FILE FROM TEMP LOCATION
$fileName = '';
if (!empty($_FILES['file']['name'])) {
    $fileName = $_FILES['file']['name'];
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $fileName = md5(microtime()) . '.' . $ext;
    $tmp_name = $_FILES['file']['tmp_name'];

    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
        $location = $_SERVER['DOCUMENT_ROOT'] . '/ht/images/';
        move_uploaded_file($tmp_name, $location . $fileName);
    } else {
        echo '<div class="w3-center w3-red">The image type must be jpg, jpeg, gif, or png.</div></br>';
    }
}

// INSERTING ROOM INFORMATION INTO DATABASE
if (isset($_POST['submit'])) {
    $number = trim($_POST['number']);
    $type = trim($_POST['type']);
    $price = trim($_POST['price']);
    $details = trim($_POST['description']);
    $rooms = trim($_POST['rooms']);

    if (!empty($number) && !empty($type) && !empty($price) && !empty($details) && !empty($rooms)) {
        $image = 'images/' . $fileName;
        $sql = "INSERT INTO rooms (`room_number`, `type`, `price`, `details`, `photo`, `rooms`)
                VALUES ('$number', '$type', '$price', '$details', '$image', '$rooms')";

        if ($db->query($sql)) {
            $_SESSION['added_event'] = '<div class="w3-center w3-green">Room successfully added!</div></br>';
        }
        header("Location: rooms.php");
    } else {
        echo '<div class="w3-center w3-red">Please fill in all fields.</div></br>';
    }
}

// UPDATING ROOM INFORMATION
if (isset($_POST['update'])) {
    $number = trim($_POST['number']);
    $type = trim($_POST['type']);
    $price = trim($_POST['price']);
    $details = trim($_POST['description']);
    $rooms = trim($_POST['rooms']);

    if (!empty($number) && !empty($type) && !empty($price) && !empty($details) && !empty($rooms)) {
        $toEditID = $_GET['edit'];
        $image = '';

        if (!empty($_FILES['file']['name'])) {
            $image = 'images/' . $fileName;
        }

        $query = "UPDATE rooms SET 
                  `room_number` = '$number', 
                  `type` = '$type', 
                  `details` = '$details', 
                  `price` = '$price', 
                  `rooms` = '$rooms'";

        if ($image !== '') {
            $query .= ", `photo` = '$image'";
        }

        $query .= " WHERE id = '$toEditID'";

        if ($db->query($query)) {
            header("Location: rooms.php");
        } else {
            echo "Error updating room: " . $db->error;
        }
    } else {
        echo '<div class="w3-center w3-red">Please fill in all fields.</div></br>';
    }
}

// DELETE ROOM IMAGE
if (isset($_GET['delete_image'])) {
    $toEditID = $_GET['delete_image'];
    $sql1 = $db->query("SELECT * FROM rooms WHERE id = '$toEditID'");
    $fetch = mysqli_fetch_assoc($sql1);
    $imageURL = $_SERVER['DOCUMENT_ROOT'] . '/ht/' . $fetch['photo'];
    unlink($imageURL);

    $sql = "UPDATE rooms SET `photo` = '' WHERE id = '$toEditID'";
    $db->query($sql);
    header("Location: add_room.php?edit=$toEditID");
}
?>

<div class="w3-container w3-main" style="margin-left:200px">
    <header class="w3-container w3-purple">
        <span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">☰</span>
        <h2 class="text-center">Add a Room</h2>
    </header>
    <br/>
    <form class="form" action="#" method="post" enctype="multipart/form-data">

        <div class="form-group col-md-4">
            <label>Nama Hotel:</label>
            <input type="text" class="form-control" value="<?= isset($_GET['edit']) ? $edit['room_number'] : ''; ?>" name="number">
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
            <label>Harga Kamar:</label>
            <input type="text" class="form-control" value="<?= isset($_GET['edit']) ? $edit['price'] : ''; ?>" name="price">
        </div>

        <div class="form-group col-md-2">
            <label>Kamar Tersedia:</label>
            <input type="number" class="form-control" value="<?= isset($_GET['edit']) ? $edit['rooms'] : ''; ?>" name="rooms">
        </div>

        <div class="form-group col-md-4">
            <?php if (isset($_GET['edit']) && !empty($edit['photo'])) : ?>
                <figure>
                    <h3>Gambar Ruangan</h3>
                    <img src="../<?= $edit['photo']; ?>" alt="room image" class="img-responsive">
                    <figcaption>
                        <a href="add_room.php?delete_image=<?= $id; ?>" class="w3-text-red">Delete Photo</a>
                    </figcaption>
                </figure>
            <?php else : ?>
                <label>Gambar Ruangan:</label>
                <input type="file" class="form-control" name="file">
            <?php endif; ?>
        </div>

        <div class="form-group col-md-4">
            <label>Deskripsi:</label>
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

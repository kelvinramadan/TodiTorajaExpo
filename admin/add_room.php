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

// FUNCTION TO HANDLE FILE UPLOADS
function handleFileUpload($file, $targetDir) {
    $fileName = '';
    if (!empty($file['name'])) {
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $fileName = md5(microtime()) . '.' . $ext;
        $tmpName = $file['tmp_name'];

        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
            move_uploaded_file($tmpName, $targetDir . $fileName);
        } else {
            echo '<div class="w3-center w3-red">The image type must be jpg, jpeg, gif, or png.</div></br>';
        }
    }
    return $fileName;
}

$targetDir = $_SERVER['DOCUMENT_ROOT'] . '/ht/images/';

// INSERTING ROOM INFORMATION INTO DATABASE
if (isset($_POST['submit'])) {
    $number = trim($_POST['number']);
    $type = trim($_POST['type']);
    $price = trim($_POST['price']);
    $details = trim($_POST['description']);
    $rooms = trim($_POST['rooms']);

    $photo = handleFileUpload($_FILES['photo'], $targetDir);
    $facility1 = handleFileUpload($_FILES['facility1'], $targetDir);
    $facility2 = handleFileUpload($_FILES['facility2'], $targetDir);
    $facility3 = handleFileUpload($_FILES['facility3'], $targetDir);
    $facility4 = handleFileUpload($_FILES['facility4'], $targetDir);

    if (!empty($number) && !empty($type) && !empty($price) && !empty($details) && !empty($rooms)) {
        $sql = "INSERT INTO rooms (`room_number`, `type`, `price`, `details`, `photo`, `facility1`, `facility2`, `facility3`, `facility4`, `rooms`)
                VALUES ('$number', '$type', '$price', '$details', 'images/$photo', 'images/$facility1', 'images/$facility2', 'images/$facility3', 'images/$facility4', '$rooms')";

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

    $photo = handleFileUpload($_FILES['photo'], $targetDir);
    $facility1 = handleFileUpload($_FILES['facility1'], $targetDir);
    $facility2 = handleFileUpload($_FILES['facility2'], $targetDir);
    $facility3 = handleFileUpload($_FILES['facility3'], $targetDir);
    $facility4 = handleFileUpload($_FILES['facility4'], $targetDir);

    if (!empty($number) && !empty($type) && !empty($price) && !empty($details) && !empty($rooms)) {
        $toEditID = $_GET['edit'];
        $query = "UPDATE rooms SET 
                  `room_number` = '$number', 
                  `type` = '$type', 
                  `details` = '$details', 
                  `price` = '$price', 
                  `rooms` = '$rooms'";

        if (!empty($photo)) {
            $query .= ", `photo` = 'images/$photo'";
        }
        if (!empty($facility1)) {
            $query .= ", `facility1` = 'images/$facility1'";
        }
        if (!empty($facility2)) {
            $query .= ", `facility2` = 'images/$facility2'";
        }
        if (!empty($facility3)) {
            $query .= ", `facility3` = 'images/$facility3'";
        }
        if (!empty($facility4)) {
            $query .= ", `facility4` = 'images/$facility4'";
        }

        $query .= " WHERE id = '$toEditID'";

        // Tambahkan eksekusi query
        if($db->query($query)) {
            $_SESSION['updated_event'] = '<div class="w3-center w3-green">Room successfully updated!</div></br>';
            exit();
        } else {
            echo '<div class="w3-center w3-red">Error updating room: ' . $db->error . '</div></br>';
        }
    } else {
        echo '<div class="w3-center w3-red">Please fill in all fields.</div></br>';
    }
}
?>

<div class="w3-container w3-main" style="margin-left:260px; padding: 20px;">
    <header class="w3-container w3-purple" style="margin-bottom: 20px;">
        <span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">☰</span>
        <h2 class="text-center">Add a Room</h2>
    </header>
    <br/>
    <form class="form" action="#" method="post" enctype="multipart/form-data">

        <div class="form-group col-md-4">
            <label>Room Number:</label>
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

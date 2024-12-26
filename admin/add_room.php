<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/TodiTorajaExpo/core/core.php';

if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $id = $_GET['edit'];
    // Gunakan prepared statement untuk menghindari SQL injection
    $stmt = $db->prepare("SELECT * FROM rooms WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $edit = $result->fetch_assoc();
    $stmt->close();
}

// FUNCTION TO HANDLE FILE UPLOADS
function handleFileUpload($file, $targetDir) {
    $fileName = '';
    if (!empty($file['name'])) {
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $fileName = md5(microtime()) . '.' . $ext;
        $tmpName = $file['tmp_name'];

        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
            if (move_uploaded_file($tmpName, $targetDir . $fileName)) {
                return $fileName;
            } else {
                echo '<div class="w3-center w3-red">Error uploading file.</div></br>';
                return '';
            }
        } else {
            echo '<div class="w3-center w3-red">The image type must be jpg, jpeg, gif, or png.</div></br>';
            return '';
        }
    }
    return $fileName;
}

$targetDir = $_SERVER['DOCUMENT_ROOT'] . '/TodiTorajaExpo/images/';

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
        // Gunakan prepared statement
        $stmt = $db->prepare("INSERT INTO rooms (room_number, type, price, details, photo, facility1, facility2, facility3, facility4, rooms) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $photoPath = !empty($photo) ? 'images/' . $photo : '';
        $facility1Path = !empty($facility1) ? 'images/' . $facility1 : '';
        $facility2Path = !empty($facility2) ? 'images/' . $facility2 : '';
        $facility3Path = !empty($facility3) ? 'images/' . $facility3 : '';
        $facility4Path = !empty($facility4) ? 'images/' . $facility4 : '';
        
        $stmt->bind_param("ssssssssss", $number, $type, $price, $details, $photoPath, $facility1Path, $facility2Path, $facility3Path, $facility4Path, $rooms);
        
        if ($stmt->execute()) {
            $_SESSION['added_event'] = '<div class="w3-center w3-green">Room successfully added!</div></br>';
            header("Location: rooms.php");
            exit();
        } else {
            echo '<div class="w3-center w3-red">Error adding room: ' . $db->error . '</div></br>';
        }
        $stmt->close();
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
    $toEditID = $_GET['edit'];

    if (!empty($number) && !empty($type) && !empty($price) && !empty($details) && !empty($rooms)) {
        // Start with base query
        $updateFields = array();
        $updateValues = array();
        $updateTypes = "";

        // Add basic fields
        $updateFields[] = "room_number = ?";
        $updateFields[] = "type = ?";
        $updateFields[] = "price = ?";
        $updateFields[] = "details = ?";
        $updateFields[] = "rooms = ?";
        $updateValues = array($number, $type, $price, $details, $rooms);
        $updateTypes = "sssss";

        // Handle file uploads
        $photo = handleFileUpload($_FILES['photo'], $targetDir);
        if (!empty($photo)) {
            $updateFields[] = "photo = ?";
            $updateValues[] = 'images/' . $photo;
            $updateTypes .= "s";
        }

        $facility1 = handleFileUpload($_FILES['facility1'], $targetDir);
        if (!empty($facility1)) {
            $updateFields[] = "facility1 = ?";
            $updateValues[] = 'images/' . $facility1;
            $updateTypes .= "s";
        }

        $facility2 = handleFileUpload($_FILES['facility2'], $targetDir);
        if (!empty($facility2)) {
            $updateFields[] = "facility2 = ?";
            $updateValues[] = 'images/' . $facility2;
            $updateTypes .= "s";
        }

        $facility3 = handleFileUpload($_FILES['facility3'], $targetDir);
        if (!empty($facility3)) {
            $updateFields[] = "facility3 = ?";
            $updateValues[] = 'images/' . $facility3;
            $updateTypes .= "s";
        }

        $facility4 = handleFileUpload($_FILES['facility4'], $targetDir);
        if (!empty($facility4)) {
            $updateFields[] = "facility4 = ?";
            $updateValues[] = 'images/' . $facility4;
            $updateTypes .= "s";
        }

        // Add ID to values and types
        $updateValues[] = $toEditID;
        $updateTypes .= "i";

        // Prepare and execute the update query
        $query = "UPDATE rooms SET " . implode(", ", $updateFields) . " WHERE id = ?";
        $stmt = $db->prepare($query);

        // Create array of references for bind_param
        $refs = array();
        $refs[] = &$updateTypes;
        foreach($updateValues as $key => $value) {
            $refs[] = &$updateValues[$key];
        }
        
        call_user_func_array(array($stmt, 'bind_param'), $refs);

        if ($stmt->execute()) {
            $_SESSION['updated_event'] = '<div class="w3-center w3-green">Room successfully updated!</div></br>';
            header("Location: rooms.php");
            exit();
        } else {
            echo '<div class="w3-center w3-red">Error updating room: ' . $db->error . '</div></br>';
        }
        $stmt->close();
    } else {
        echo '<div class="w3-center w3-red">Please fill in all fields.</div></br>';
    }
}

include 'includes/header.php';
include 'includes/navigation.php';
?>

<div class="w3-container w3-main" style="margin-left:260px; padding: 20px;">
    <header class="w3-container w3-purple" style="margin-bottom: 20px;">
        <span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">☰</span>
        <h2 class="text-center"><?= isset($_GET['edit']) ? 'Edit Room' : 'Add a Room' ?></h2>
    </header>
    <br/>
    <form class="form" action="" method="post" enctype="multipart/form-data">
        <div class="form-group col-md-4">
            <label>Nama Penginapan:</label>
            <input type="text" class="form-control" value="<?= isset($edit['room_number']) ? htmlspecialchars($edit['room_number']) : ''; ?>" name="number" required>
        </div>

        <div class="form-group col-md-4">
            <label>Type kamar:</label>
            <select class="form-control" name="type" required>
                <option value="Executive" <?= (isset($edit['type']) && $edit['type'] == 'Executive') ? 'selected' : ''; ?>>Executive</option>
                <option value="Regular" <?= (isset($edit['type']) && $edit['type'] == 'Regular') ? 'selected' : ''; ?>>Regular</option>
                <option value="Deluxe" <?= (isset($edit['type']) && $edit['type'] == 'Deluxe') ? 'selected' : ''; ?>>Deluxe</option>
            </select>
        </div>

        <div class="form-group col-md-2">
            <label>Harga:</label>
            <input type="text" class="form-control" value="<?= isset($edit['price']) ? htmlspecialchars($edit['price']) : ''; ?>" name="price" required>
        </div>

        <div class="form-group col-md-2">
            <label>Kamar Tersedia:</label>
            <input type="number" class="form-control" value="<?= isset($edit['rooms']) ? htmlspecialchars($edit['rooms']) : ''; ?>" name="rooms" required>
        </div>

        <div class="form-group col-md-4">
            <label>Gambar penginapan:</label>
            <input type="file" class="form-control" name="photo" <?= !isset($_GET['edit']) ? 'required' : ''; ?>>
            <?php if(isset($edit['photo']) && !empty($edit['photo'])): ?>
                <small class="text-muted">Current photo: <?= htmlspecialchars($edit['photo']) ?></small>
            <?php endif; ?>
        </div>

        <div class="form-group col-md-4">
            <label>Facilitas 1 photo :</label>
            <input type="file" class="form-control" name="facility1">
            <?php if(isset($edit['facility1']) && !empty($edit['facility1'])): ?>
                <small class="text-muted">Current photo: <?= htmlspecialchars($edit['facility1']) ?></small>
            <?php endif; ?>
        </div>

        <div class="form-group col-md-4">
            <label>Facilitas 2 Photo:</label>
            <input type="file" class="form-control" name="facility2">
            <?php if(isset($edit['facility2']) && !empty($edit['facility2'])): ?>
                <small class="text-muted">Current photo: <?= htmlspecialchars($edit['facility2']) ?></small>
            <?php endif; ?>
        </div>

        <div class="form-group col-md-4">
            <label>Facilitas 3 Photo:</label>
            <input type="file" class="form-control" name="facility3">
            <?php if(isset($edit['facility3']) && !empty($edit['facility3'])): ?>
                <small class="text-muted">Current photo: <?= htmlspecialchars($edit['facility3']) ?></small>
            <?php endif; ?>
        </div>

        <div class="form-group col-md-4">
            <label>Facilitas 4 Photo:</label>
            <input type="file" class="form-control" name="facility4">
            <?php if(isset($edit['facility4']) && !empty($edit['facility4'])): ?>
                <small class="text-muted">Current photo: <?= htmlspecialchars($edit['facility4']) ?></small>
            <?php endif; ?>
        </div>

        <div class="form-group col-md-4">
            <label>Deskripsi:</label>
            <textarea class="form-control" rows="6" name="description" required><?= isset($edit['details']) ? htmlspecialchars($edit['details']) : ''; ?></textarea>
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
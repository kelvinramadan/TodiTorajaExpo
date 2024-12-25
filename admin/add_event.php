<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/TodiTorajaExpo/core/core.php';

// Check if we're in edit mode
if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $id = $_GET['edit'];
    $get = $db->query("SELECT * FROM events WHERE id = '$id'");
    $edit = mysqli_fetch_assoc($get);
}

// FUNCTION TO HANDLE FILE UPLOADS
// Modifikasi fungsi handleFileUpload
function handleFileUpload($file) {
    $fileName = '';
    if (!empty($file['name'])) {
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $fileName = md5(microtime()) . '.' . $ext;
        $tmpName = $file['tmp_name'];
        
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
            // Change the image storage location to a web-accessible directory
            $location = $_SERVER['DOCUMENT_ROOT'] . '/images/'; // Adjust this path according to your directory structure
            $dbPath = '/images/' . $fileName; // This is the path that will be stored in database
            
            // Create directory if it doesn't exist
            if (!file_exists($location)) {
                mkdir($location, 0777, true);
            }
            
            if (move_uploaded_file($tmpName, $location . $fileName)) {
                return $dbPath;
            }
            return '';
        } else {
            echo '<div class="w3-center w3-red">The image type must be jpg, jpeg, gif, or png.</div></br>';
        }
    }
    return $fileName;
}

// INSERTING EVENT INFORMATION INTO DATABASE
if (isset($_POST['submit'])) {
    $topic = trim($_POST['topic']);
    $venue = trim($_POST['venue']);
    $date = trim($_POST['date']);
    $time = trim($_POST['time']);
    $sdetails = trim($_POST['sdetails']);
    $fdetails = nl2br($_POST['fdetails']);
    
    $image = handleFileUpload($_FILES['file']);

    if (!empty($topic) && !empty($venue) && !empty($date) && !empty($time) && !empty($sdetails) && !empty($fdetails)) {
        // Escape special characters to prevent SQL injection
        $topic = mysqli_real_escape_string($db, $topic);
        $venue = mysqli_real_escape_string($db, $venue);
        $sdetails = mysqli_real_escape_string($db, $sdetails);
        $fdetails = mysqli_real_escape_string($db, $fdetails);
        
        $sql = "INSERT INTO events (`event_topic`, `image`, `venue`, `date`, `time`, `short_details`, `full_details`)
                VALUES ('$topic', '$image', '$venue', '$date', '$time', '$sdetails', '$fdetails')";

        if ($db->query($sql)) {
            $_SESSION['added_event'] = '<div class="w3-center w3-green">Event successfully added!</div></br>';
            header("Location: events.php");
            exit();
        } else {
            echo '<div class="w3-center w3-red">Error: ' . $db->error . '</div></br>';
        }
    } else {
        echo '<div class="w3-center w3-red">Please fill in all fields.</div></br>';
    }
}

// UPDATING EVENT INFORMATION
if (isset($_POST['update'])) {
    $topic = trim($_POST['topic']);
    $venue = trim($_POST['venue']);
    $date = trim($_POST['date']);
    $time = trim($_POST['time']);
    $sdetails = trim($_POST['sdetails']);
    $fdetails = nl2br($_POST['fdetails']);
    
    $image = handleFileUpload($_FILES['file']);

    if (!empty($topic) && !empty($venue) && !empty($date) && !empty($time) && !empty($sdetails) && !empty($fdetails)) {
        // Escape special characters
        $topic = mysqli_real_escape_string($db, $topic);
        $venue = mysqli_real_escape_string($db, $venue);
        $sdetails = mysqli_real_escape_string($db, $sdetails);
        $fdetails = mysqli_real_escape_string($db, $fdetails);
        
        $toEditID = $_GET['edit'];
        $query = "UPDATE events SET 
                  `event_topic` = '$topic',
                  `venue` = '$venue',
                  `date` = '$date',
                  `time` = '$time',
                  `short_details` = '$sdetails',
                  `full_details` = '$fdetails'";

        if (!empty($image)) {
            $query .= ", `image` = '$image'";
        }

        $query .= " WHERE id = '$toEditID'";

        if($db->query($query)) {
            $_SESSION['updated_event'] = '<div class="w3-center w3-green">Event successfully updated!</div></br>';
            header("Location: events.php");
            exit();
        } else {
            echo '<div class="w3-center w3-red">Error updating event: ' . $db->error . '</div></br>';
        }
    } else {
        echo '<div class="w3-center w3-red">Please fill in all fields.</div></br>';
    }
}

include 'includes/header.php';
include 'includes/navigation.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
        .form-group {
            margin-bottom: 20px;
        }
        .preview-image {
            max-width: 200px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="w3-container w3-main" style="margin-left:260px; padding: 20px;">
    <header class="w3-container w3-purple" style="margin-bottom: 20px;">
        <span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">☰</span>
        <h2 class="text-center">Add an Event</h2>
    </header>
    <br/>
    <form class="form" action="#" method="post" enctype="multipart/form-data">
        <div class="form-group col-md-4">
            <label>Event Topic:</label>
            <input type="text" class="form-control" value="<?= isset($_GET['edit']) ? htmlspecialchars($edit['event_topic']) : ''; ?>" name="topic">
        </div>

        <div class="form-group col-md-4">
            <label>Venue:</label>
            <input type="text" class="form-control" value="<?= isset($_GET['edit']) ? htmlspecialchars($edit['venue']) : ''; ?>" name="venue">
        </div>

        <div class="form-group col-md-2">
            <label>Date:</label>
            <input type="date" class="form-control" value="<?= isset($_GET['edit']) ? $edit['date'] : ''; ?>" name="date">
        </div>

        <div class="form-group col-md-2">
            <label>Time:</label>
            <input type="time" class="form-control" value="<?= isset($_GET['edit']) ? $edit['time'] : ''; ?>" name="time">
        </div>

        <div class="form-group col-md-4">
            <label>Event Image:</label>
            <input type="file" class="form-control" name="file" id="imageInput" accept="image/*">
            <div id="imagePreview">
                <?php if(isset($_GET['edit']) && !empty($edit['image'])): ?>
                    <img src="<?= htmlspecialchars($edit['image']); ?>" class="preview-image" alt="Current Image">
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group col-md-4">
            <label>Short Details:</label>
            <textarea class="form-control" rows="4" name="sdetails"><?= isset($_GET['edit']) ? htmlspecialchars($edit['short_details']) : ''; ?></textarea>
        </div>

        <div class="form-group col-md-4">
            <label>Full Details:</label>
            <textarea class="form-control" rows="6" name="fdetails"><?= isset($_GET['edit']) ? htmlspecialchars($edit['full_details']) : ''; ?></textarea>
        </div>

        <div class="form-group col-md-4">
            <label></label>
            <input type="submit" class="btn btn-block btn-lg btn-success" value="<?= isset($_GET['edit']) ? 'Update Event' : 'Add Event'; ?>" name="<?= isset($_GET['edit']) ? 'update' : 'submit'; ?>">
        </div>

        <?php if (isset($_GET['edit']) && !empty($_GET['edit'])) : ?>
            <div class="form-group col-md-4">
                <label></label>
                <a class="btn btn-block btn-danger btn-lg" href="events.php">Cancel Edit</a>
            </div>
        <?php endif; ?>
    </form>
</div>

<script>
// Function to handle image preview
document.getElementById('imageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = `<img src="${e.target.result}" class="preview-image" alt="Preview">`;
        }
        reader.readAsDataURL(file);
    }
});

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
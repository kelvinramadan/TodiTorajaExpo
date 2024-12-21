<?php
// Include database connection
require_once $_SERVER['DOCUMENT_ROOT'].'/ht/core/core.php';

// Custom sanitize function to prevent SQL injection and XSS
function sanitize($input) {
    global $db;
    if(is_array($input)) {
        foreach($input as $key => $value) {
            $input[$key] = sanitize($value);
        }
        return $input;
    }
    if(!empty($input) && is_string($input)) {
        $input = trim($input);
        $input = strip_tags($input);
        return mysqli_real_escape_string($db, $input);
    }
    return $input;
}

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// FIELD VARIABLES with proper sanitization
$topic = isset($_POST['topic']) ? sanitize($_POST['topic']) : '';
$venue = isset($_POST['venue']) ? sanitize($_POST['venue']) : '';
$date = isset($_POST['date']) ? sanitize($_POST['date']) : '';
$time = isset($_POST['time']) ? sanitize($_POST['time']) : '';
$sdetails = isset($_POST['sdetails']) ? sanitize($_POST['sdetails']) : '';
$sdetails2 = isset($_POST['sdetails2']) ? sanitize($_POST['sdetails2']) : '';
$price = isset($_POST['price']) ? sanitize($_POST['price']) : '';
$reservations = isset($_POST['reservations']) ? sanitize($_POST['reservations']) : '';

// Image upload handling with security improvements
$uploadedImages = [];
if (!empty($_FILES)) {
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $maxFileSize = 5 * 1024 * 1024; // 5MB limit
    
    foreach (['file', 'file1', 'file2', 'file3', 'file4'] as $fileKey) {
        if (!empty($_FILES[$fileKey]['name'])) {
            $fileName = $_FILES[$fileKey]['name'];
            $fileSize = $_FILES[$fileKey]['size'];
            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $newFileName = md5(uniqid(rand(), true)) . '.' . $ext;
            $tmp_name = $_FILES[$fileKey]['tmp_name'];

            // Validate file
            if (!in_array($ext, $allowedExtensions)) {
                echo '<div class="w3-center w3-red">Only jpg, jpeg, png, or gif files are allowed.</div>';
                continue;
            }

            if ($fileSize > $maxFileSize) {
                echo '<div class="w3-center w3-red">File size must be less than 5MB.</div>';
                continue;
            }

            // Verify it's actually an image
            if (!getimagesize($tmp_name)) {
                echo '<div class="w3-center w3-red">Invalid image file.</div>';
                continue;
            }

            $location = $_SERVER['DOCUMENT_ROOT'].'/ht/images/';
            if (move_uploaded_file($tmp_name, $location.$newFileName)) {
                $uploadedImages[$fileKey] = 'images/'.$newFileName;
            }
        }
    }
}

// ADD NEW TOUR
if (isset($_POST['add'])) {
    if (!empty($topic) && !empty($venue) && !empty($date) && 
        !empty($time) && !empty($sdetails) && !empty($sdetails2) && 
        !empty($reservations) && !empty($price)) {
        
        $image = $uploadedImages['file'] ?? '';
        $image1 = $uploadedImages['file1'] ?? '';
        $image2 = $uploadedImages['file2'] ?? '';
        $image3 = $uploadedImages['file3'] ?? '';
        $image4 = $uploadedImages['file4'] ?? '';

        // Using prepared statements for security
        $stmt = $db->prepare("INSERT INTO tourism (title, photo, photo1, photo2, photo3, photo4, location, date, time, details, details2, price, reservations) 
                             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("sssssssssssss", 
            $topic, $image, $image1, $image2, $image3, $image4, 
            $venue, $date, $time, $sdetails, $sdetails2, $price, $reservations
        );

        if ($stmt->execute()) {
            $_SESSION['added_event'] = '<div class="w3-center w3-green">Tour Event successfully added!</div>';
            header("Location: tours.php");
            exit();
        } else {
            echo '<div class="w3-center w3-red">Error adding tour: ' . $stmt->error . '</div>';
        }
        $stmt->close();
    } else {
        echo '<div class="w3-center w3-red">Please fill in all required fields.</div>';
    }
}

// UPDATE EXISTING TOUR
else if (isset($_POST['update']) && isset($_GET['edit'])) {
    $toEditID = sanitize($_GET['edit']);
    
    if (!empty($topic) && !empty($venue) && !empty($date) && 
        !empty($time) && !empty($sdetails) && !empty($sdetails2) && 
        !empty($reservations) && !empty($price)) {

        // Get existing images
        $stmt = $db->prepare("SELECT photo, photo1, photo2, photo3, photo4 FROM tourism WHERE id = ?");
        $stmt->bind_param("i", $toEditID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        // Use new images if uploaded, otherwise keep existing ones
        $image = !empty($uploadedImages['file']) ? $uploadedImages['file'] : $row['photo'];
        $image1 = !empty($uploadedImages['file1']) ? $uploadedImages['file1'] : $row['photo1'];
        $image2 = !empty($uploadedImages['file2']) ? $uploadedImages['file2'] : $row['photo2'];
        $image3 = !empty($uploadedImages['file3']) ? $uploadedImages['file3'] : $row['photo3'];
        $image4 = !empty($uploadedImages['file4']) ? $uploadedImages['file4'] : $row['photo4'];

        // Update using prepared statement
        $stmt = $db->prepare("UPDATE tourism SET 
            title=?, photo=?, photo1=?, photo2=?, photo3=?, photo4=?,
            location=?, date=?, time=?, details=?, details2=?, price=?, reservations=?
            WHERE id=?");
            
        $stmt->bind_param("sssssssssssssi",
            $topic, $image, $image1, $image2, $image3, $image4,
            $venue, $date, $time, $sdetails, $sdetails2, $price, $reservations,
            $toEditID
        );

        if ($stmt->execute()) {
            $_SESSION['updated_event'] = '<div class="w3-center w3-green">Tour Event successfully updated!</div>';
            header("Location: tours.php");
            exit();
        } else {
            echo '<div class="w3-center w3-red">Error updating tour: ' . $stmt->error . '</div>';
        }
        $stmt->close();
    } else {
        echo '<div class="w3-center w3-red">Please fill in all required fields.</div>';
    }
}

// LOAD TOUR FOR EDITING
if (isset($_GET['edit'])) {
    $toEditID = sanitize($_GET['edit']);
    $stmt = $db->prepare("SELECT * FROM tourism WHERE id = ?");
    $stmt->bind_param("i", $toEditID);
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_assoc();
    $stmt->close();
}

// CANCEL EDITING
if (isset($_GET['cancelEdit'])) {
    unset($_SESSION['edit']);
    header("Location: add_tour.php");
    exit();
}

// DELETE IMAGE
if (isset($_GET['delete_image'])) {
    $toEditID = sanitize($_GET['delete_image']);
    $stmt = $db->prepare("SELECT photo, photo1, photo2, photo3, photo4 FROM tourism WHERE id = ?");
    $stmt->bind_param("i", $toEditID);
    $stmt->execute();
    $result = $stmt->get_result();
    $fetch = $result->fetch_assoc();

    // Helper function to delete image
    function deleteImage($imagePath, $field, $id, $db) {
        if (!empty($imagePath)) {
            $fullPath = $_SERVER['DOCUMENT_ROOT'].'/ht/'.$imagePath;
            if (file_exists($fullPath) && unlink($fullPath)) {
                $stmt = $db->prepare("UPDATE tourism SET $field = '' WHERE id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->close();
            }
        }
    }

    // Delete all images
    deleteImage($fetch['photo'], 'photo', $toEditID, $db);
    deleteImage($fetch['photo1'], 'photo1', $toEditID, $db);
    deleteImage($fetch['photo2'], 'photo2', $toEditID, $db);
    deleteImage($fetch['photo3'], 'photo3', $toEditID, $db);
    deleteImage($fetch['photo4'], 'photo4', $toEditID, $db);

    header("Location: add_tour.php?edit=$toEditID");
    exit();
}

// Include header and navigation
include 'includes/header.php';
include 'includes/navigation.php';
?>

<div class="w3-container w3-main" style="margin-left:260px; padding: 20px;">
  <header class="w3-container w3-purple" style="margin-bottom: 20px;">
   <span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">☰</span>
   <h2 class="text-center">Add a tour</h2>
 </header>
<br/>

  <div class="row col-sm-12">
          <a href="tours.php" class="btn btn-md btn-primary pull-right">Go to tours</a>
  </div>
<br><br>
  <div class="row">

    <div class="col-md-9 w3-padding">

      <form class="form" method="POST" action="" enctype="multipart/form-data">

        <div class="col-sm-3 form-group">
          <label for="">Title:</label>
          <input type="text" name="topic" value="<?=(isset($toEditID))?''.$rows['title'].'' :'' ; ?>" class="form-control" placeholder="event topic">
        </div>

        <div class="col-sm-3 form-group">
          <label for="">Location:</label>
          <input type="text" name="venue" class="form-control" value="<?=(isset($toEditID))?''.$rows['location'].'' :'' ; ?>" placeholder="venue">
        </div>

        <div class="col-sm-3 form-group">
          <label for="">Date:</label>
          <input type="date" name="date" value="<?=(isset($toEditID))?''.$rows['date'].'' :'' ; ?>" class="form-control">
        </div>

        <div class="col-sm-3 form-group">
          <label for="">Price:</label>
          <input type="text" name="price" value="<?=(isset($toEditID))?''.$rows['price'].'' :'' ; ?>" class="form-control">
        </div>

        <div class="col-sm-3 form-group">
          <label for="">Time:</label>
          <input type="time" name="time" value="<?=(isset($toEditID))?''.$rows['time'].'' :'' ; ?>" class="form-control">
        </div>

        <?php if(!@$rows['photo'] || @$rows['photo']==''): ?>
          <div class="col-sm-3 form-group">
            <label for="">Photo:</label>
            <input type="file" class="form-control" name="file" id="file">
          </div>
        <?php endif;  ?>

        <?php if(!@$rows['photo1'] || @$rows['photo1']==''): ?>
          <div class="col-sm-3 form-group">
            <label for="">Photo1:</label>
            <input type="file" class="form-control" name="file1" id="file1">
          </div>
        <?php endif;  ?>

        <?php if(!@$rows['photo2'] || @$rows['photo2']==''): ?>
          <div class="col-sm-3 form-group">
            <label for="">Photo2:</label>
            <input type="file" class="form-control" name="file2" id="file2">
          </div>
        <?php endif;  ?>

        <?php if(!@$rows['photo3'] || @$rows['photo3']==''): ?>
          <div class="col-sm-3 form-group">
            <label for="">Photo3:</label>
            <input type="file" class="form-control" name="file3" id="file3">
          </div>
        <?php endif;  ?>

        <?php if(!@$rows['photo4'] || @$rows['photo4']==''): ?>
          <div class="col-sm-3 form-group">
            <label for="">Photo4:</label>
            <input type="file" class="form-control" name="file4" id="file4">
          </div>
        <?php endif;  ?>

        <div class="col-sm-3 form-group">
          <label for="">Reserve Spaces:</label>
          <input type="number" name="reservations" value="<?=(isset($toEditID))?''.$rows['reservations'].'' :'' ; ?>" class="form-control">
        </div>


        <div class="col-sm-6 form-group">
          <label for="">Short Details:</label>
          <textarea name="sdetails" class="form-control" col="20" rows="1" ><?=(isset($toEditID))?''.$rows['details'].'' :'' ; ?></textarea>
        </div>

        <div class="col-sm-8 form-group">
          <label for="">Tour Description:</label>
          <textarea name="sdetails2" class="form-control" col="20" rows="7" ><?=(isset($toEditID))?''.$rows['details2'].'' :'' ; ?></textarea>
        </div>

        <div class="col-sm-12">
          <input type="submit" name="<?=(isset($toEditID))?'update' :'add' ;?>" value="<?=(isset($toEditID))?'Edit Tour' :'Add Tour' ; ?>" class="w3-btn w3-indigo w3-btn-block"><br>
          <?php
              if(isset($toEditID)){
                echo '<br>';
                echo ' <a href="add_tour.php?cancelEdit='.$toEditID.'" type="button" name="cancelEdit" class="w3-btn w3-orange w3-btn-block">Cancel Edit</a>';
              }
           ?>
        </div>
      </form>
  </div>
  <div class="col-md-3">
            <?php if (isset($toEditID) && $rows['photo'] != ''): ?>
                <figure>
                    <h3>Event Image</h3>
                    <img src="../<?= $rows['photo']; ?>" alt="event image" class="img-responsive">
                    <figcaption><a href="add_tour.php?delete_image=<?= $toEditID; ?>" class="w3-text-red">Delete Photo</a></figcaption>
                </figure>
            <?php endif; ?>

            <?php if (isset($toEditID) && $rows['photo1'] != ''): ?>
                <figure>
                    <h3>Event Image 1</h3>
                    <img src="../<?= $rows['photo1']; ?>" alt="event image 1" class="img-responsive">
                    <figcaption><a href="add_tour.php?delete_image=<?= $toEditID; ?>" class="w3-text-red">Delete Photo1</a></figcaption>
                </figure>
            <?php endif; ?>

            <?php if (isset($toEditID) && $rows['photo2'] != ''): ?>
                <figure>
                    <h3>Event Image 2</h3>
                    <img src="../<?= $rows['photo2']; ?>" alt="event image 2" class="img-responsive">
                    <figcaption><a href="add_tour.php?delete_image=<?= $toEditID; ?>" class="w3-text-red">Delete Photo2</a></figcaption>
                </figure>
            <?php endif; ?>

            <?php if (isset($toEditID) && $rows['photo3'] != ''): ?>
                <figure>
                    <h3>Event Image 3</h3>
                    <img src="../<?= $rows['photo3']; ?>" alt="event image 3" class="img-responsive">
                    <figcaption><a href="add_tour.php?delete_image=<?= $toEditID; ?>" class="w3-text-red">Delete Photo3</a></figcaption>
                </figure>
            <?php endif; ?>
            
            <?php if (isset($toEditID) && $rows['photo4'] != ''): ?>
                <figure>
                    <h3>Event Image 4</h3>
                    <img src="../<?= $rows['photo4']; ?>" alt="event image 4" class="img-responsive">
                    <figcaption><a href="add_tour.php?delete_image=<?= $toEditID; ?>" class="w3-text-red">Delete Photo4</a></figcaption>
                </figure>
            <?php endif; ?>
        </div>
  </div>
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

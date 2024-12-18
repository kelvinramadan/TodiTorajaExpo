<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ht/core/core.php';
if(!is_logged_in()){
    login_error_check();
}

include 'includes/header.php';
include 'includes/navigation.php';

//FIELD VARIABLES
@$topic = sanitize($_POST['topic']);
@$venue = sanitize($_POST['venue']);
@$date = sanitize($_POST['date']);
@$time = sanitize($_POST['time']);
@$sdetails = sanitize($_POST['sdetails']);
@$sdetails2 = sanitize($_POST['sdetails2']);
@$price = sanitize($_POST['price']);
@$reservations = sanitize($_POST['reservations']);

//VALIDATING AND MOVING OF FILE FROM TEMPORAL LOCATION TO INTENDED LOCATION
$uploadedImages = [];
if (!empty($_FILES)) {
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    foreach (['file', 'file1', 'file2','file3','file4'] as $fileKey) {
        if (!empty($_FILES[$fileKey]['name'])) {
            $fileName = $_FILES[$fileKey]['name'];
            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $newFileName = md5(microtime()).'.'.$ext;
            $tmp_name = $_FILES[$fileKey]['tmp_name'];

            if (in_array($ext, $allowedExtensions)) {
                $location = BASEURL.'images/';
                move_uploaded_file($tmp_name, $location.$newFileName);
                $uploadedImages[$fileKey] = 'images/'.$newFileName; // Store uploaded image paths
            } else {
                echo '<div class="w3-center w3-red">The image type must be jpg, jpeg, gif, or png.</div></br>';
            }
        }
    }
}
// INSERTING THE EVENT INFORMATION IN THE DATABASE
if (isset($_POST['add'])) {
  if (!empty($topic) && !empty($venue) && !empty($date) &&
      !empty($time) && !empty($sdetails) && !empty($sdetails2) && !empty($reservations) &&
      !empty($price)) {
      
      $image = $uploadedImages['file'] ?? '';
      $image1 = $uploadedImages['file1'] ?? '';
      $image2 = $uploadedImages['file2'] ?? '';
      $image3 = $uploadedImages['file3'] ?? '';
      $image4 = $uploadedImages['file4'] ?? '';

      // INSERTING EVENT DETAILS IN THE DATABASE
      $sql = "INSERT INTO tourism (`title`,`photo`,`photo1`,`photo2`,`photo3`,`photo4`,`location`,`date`,`time`,`details`,`details2`,`price`,`reservations`)
              VALUES ('$topic','$image','$image1','$image2','$image3','$image4','$venue','$date','$time', '$sdetails', '$sdetails2','$price','$reservations')";

      $query_run = $db->query($sql);
      if ($query_run) {
          $_SESSION['added_event'] = '<div class="w3-center w3-green">Tour Event successfully added!</div></br>';
      }
      header("Location: tours.php");
  } else {
      echo '<div class="w3-center w3-red">Please fill in all fields.</div></br>';
  }
}

// RUNNING UPDATE IF EDITING
else if (isset($_POST['update'])) {
  if (!empty($topic) && !empty($venue) && !empty($date) &&
      !empty($time) && !empty($sdetails) && !empty($sdetails2) && !empty($reservations) && !empty($price)) {

      $toEditID = $_GET['edit'];
      $sqlSelect = $db->query("SELECT * FROM tourism WHERE id = '$toEditID'");
      $row = mysqli_fetch_assoc($sqlSelect);

      $image = !empty($uploadedImages['file']) ? $uploadedImages['file'] : $row['photo'];
      $image1 = !empty($uploadedImages['file1']) ? $uploadedImages['file1'] : $row['photo1'];
      $image2 = !empty($uploadedImages['file2']) ? $uploadedImages['file2'] : $row['photo2'];
      $image3 = !empty($uploadedImages['file3']) ? $uploadedImages['file3'] : $row['photo3'];
      $image4 = !empty($uploadedImages['file4']) ? $uploadedImages['file4'] : $row['photo4'];

      $query = $db->query("UPDATE tourism SET `title`='$topic', `photo`='$image', `photo1`='$image1', `photo2`='$image2', `photo3`='$image3', `photo4`='$image4',
          `location`='$venue', `date`='$date', `time`='$time', `details`='$sdetails', `details2`='$sdetails2', `price`='$price', `reservations`='$reservations'
          WHERE id = '$toEditID'");
      
      header("Location: tours.php");
  } else {
      echo '<div class="w3-center w3-red">Please fill in all fields.</div></br>';
  }
}

//CODE TO EDIT AN events
if (isset($_GET['edit'])){
  $toEditID = $_GET['edit'];
  $sql = "SELECT * FROM tourism WHERE id = '$toEditID' ";
  $result = $db->query($sql);
  $rows = mysqli_fetch_assoc($result);
}

// Canceling EDITING
if (isset($_GET['cancelEdit'])) {
  unset($_SESSION['edit']);
  header("Location: add_tour.php");
}

// DELETING IMAGE
if (isset($_GET['delete_image'])) {
  $toEditID = $_GET['delete_image'];
  $sql1 = $db->query("SELECT * FROM tourism WHERE id = '$toEditID'");
  $fetch = mysqli_fetch_assoc($sql1);

  // Delete each image if it exists
  if (!empty($fetch['photo'])) {
      $imageURL = $_SERVER['DOCUMENT_ROOT'].'/ht/'.$fetch['photo'];
      unlink($imageURL);
      $db->query("UPDATE tourism SET `photo` = '' WHERE id = '$toEditID'");
  }

  if (!empty($fetch['photo1'])) {
      $imageURL1 = $_SERVER['DOCUMENT_ROOT'].'/ht/'.$fetch['photo1'];
      unlink($imageURL1);
      $db->query("UPDATE tourism SET `photo1` = '' WHERE id = '$toEditID'");
  }

  if (!empty($fetch['photo2'])) {
      $imageURL2 = $_SERVER['DOCUMENT_ROOT'].'/ht/'.$fetch['photo2'];
      unlink($imageURL2);
      $db->query("UPDATE tourism SET `photo2` = '' WHERE id = '$toEditID'");
  }

  if (!empty($fetch['photo3'])) {
    $imageURL3 = $_SERVER['DOCUMENT_ROOT'].'/ht/'.$fetch['photo3'];
    unlink($imageURL3);
    $db->query("UPDATE tourism SET `photo3` = '' WHERE id = '$toEditID'");
}

if (!empty($fetch['photo4'])) {
    $imageURL4 = $_SERVER['DOCUMENT_ROOT'].'/ht/'.$fetch['photo4'];
    unlink($imageURL4);
    $db->query("UPDATE tourism SET `photo4` = '' WHERE id = '$toEditID'");
}

  header("Location: add_tour.php?edit=$toEditID");
}

?>
<div class="w3-container w3-main" style="margin-left:200px">
  <header class="w3-container w3-purple">
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

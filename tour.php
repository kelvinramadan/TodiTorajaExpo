<?php

require_once 'core/core.php';
include 'includes/header.php';
include 'includes/navigation.php';

if(isset($_GET['tour'])) {
  $tourID = $_GET['tour'];
  $select = $db->query("SELECT * FROM tourism WHERE id = '{$tourID}' ");
  $s = $db->query("SELECT * FROM tourism WHERE id = '{$tourID}' ");
  $data = mysqli_fetch_assoc($s);
####################################################################################

if(isset($_POST['reserve'])) {
  if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['people']) && isset($_POST['number'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $people = $_POST['people'];
        $phone = $_POST['number'];

      $save = $db->query("INSERT INTO tour_reserves (tour_id,reservations,cus_name,`email`,`phone`)
                            VALUES ('$tourID','$people','$name','$email','$phone')");

      if($save){
        $newReservations = $data['reservations'] - $people;
        $update = $db->query("UPDATE tourism SET reservations = '$newReservations' WHERE id = '$tourID' ");
      }
      $_SESSION['tour_success'] = 'Reservation successfully made!';
      header("Location: tour.php?tour=$tourID ");


  } else {
    echo 'All fields are required!';
  }
}


} elseif( !(isset($_GET['tour'])) || $_GET['tour']=='' ) {
  header("Location: tourism.php");
}

?>
<link rel="stylesheet" href="tour.css">
<script src="tour.js"></script>
     <!-- Room details -->
<div class="container">
    <?php while($tour = mysqli_fetch_assoc($select)): ?>
       <div class="page-header">
         <h2 class="text-center"><?= $tour['title']; ?></h2>
       </div>

       <div class="row">
         <div class="col-md-6">
           <img class="" style="width:100%; height:400px" src="<?= $tour['photo']; ?>">
         </div>

         <div class="col-md-6">
           <img class="" style="width:100%; height:400px" src="<?= $tour['photo1']; ?>">
         </div>

         <div class="col-md-6">
           <img class="" style="width:100%; height:400px" src="<?= $tour['photo2']; ?>">
         </div>

         <div class="col-md-6">
           <img class="" style="width:100%; height:400px" src="<?= $tour['photo3']; ?>">
         </div>

         <div class="col-md-6">
           <img class="" style="width:100%; height:400px" src="<?= $tour['photo4']; ?>">
         </div>

         <!-- Right collumn for details -->
         <div class="col-md-6">
           <hr />
           <p><b>Location:</b> <?= $tour['location']; ?></p>
           <p><b>Price :</b> Rp.<?= $tour['price']; ?></p>
           <p><b>Short details:</b> <?= $tour['details']; ?></p>
           <p><b>Tour Description :</b> <?= $tour['details2']; ?></p>
           <p><b>Reservations Remaining:</b> <?= $tour['reservations']; ?></p>
           <?=($tour['reservations'] <= 0)?'<p class="text-danger">reservations have been closed on this event!</p>':'';?>
           <hr />
           <div class="row">

              <div class="col-md-12">
                <div class="page-header">
                    <h2 class="text-center">Booking details</h2>
                </div>

                <form action="" method="POST" role="form">
                    <div class="row">

                    <div class="form-group col-md-6">
                        <label for=""></label>
                        <input type="text" name="name" class="form-control " id="" placeholder="Name" <?=($tour['reservations'] <= 0)?'readonly':'';?>>
                    </div>

                    <div class="form-group col-md-6">
                        <label for=""></label>
                        <input type="number" name="people" class="form-control" id="" placeholder="Number of people"  <?=($tour['reservations'] <= 0)?'readonly':'';?>>
                    </div>

                    <div class="form-group col-md-6">
                        <label for=""></label>
                        <input type="text" name="number" class="form-control" id="" placeholder="Contact Number"  <?=($tour['reservations'] <= 0)?'readonly':'';?>>
                    </div>

                    <div class="form-group col-md-6">
                        <label for=""></label>
                        <input type="text" name="email" class="form-control" id="" placeholder="Email Address"  <?=($tour['reservations'] <= 0)?'readonly':'';?>>
                    </div>

                    </div>

                    <button type="submit" name=" <?=($tour['reservations'] <= 0)?'readonly':'reserve';?>" class="btn btn-primary btn-block  <?=($tour['reservations'] <= 0)? 'disabled':'';?>">Book Now!</button>
                </form>

              </div>
           </div>
           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d50782.05403468191!2d119.8630!3d-2.9726!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMsKwNTcnMTQuNiJOIDEyOcKwNTUnNTcuNCJ9!5e0!3m2!1sen!2sid!4v1633679151718" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
         </div>
       </div>
<?php endwhile; ?>

        </div>

<br /><br /><br /><br />

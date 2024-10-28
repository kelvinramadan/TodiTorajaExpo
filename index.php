<?php
require_once 'core/core.php';
include 'includes/header.php';
include 'includes/navigation.php';
$sql = $db->query("SELECT * FROM rooms LIMIT 4");
$tourSQL = $db->query("SELECT * FROM tourism LIMIT 4");
?>


    <!-- Header - set the background image for the header in the line below -->
    <header class="py-5 bg-image-full" style="background-image: url('images/slide-2.jpg'); height:300px">
      
    </header>

    <!-- Content section -->
    <section class="py-5">
      <div class="container">
        <h1>Rooms</h1><hr />
      <div class="row">

      <?php while($room = mysqli_fetch_assoc($sql)): ?>
          <div class="col-lg-3 col-md-4 col-sm-6">
            <h4 class="text-center"><?=$room['room_number'];?></h4>
            <img src="<?=$room['photo'];?>" class="img-responsive" alt="room" width="100%" height="200px">
            <section class="text-justify">
              <p>
                <?=$room['details'];?>
              </p>
              <a href="details.php?room=<?= $room['id']; ?>" class="btn btn-block btn-primary">More Details</a>
            </section>
          </div>

    <?php endwhile; ?>
      </div>
    </section>

    <!-- Image Section - set the background image for the header in the line below -->
    <section class="py-5 bg-image-full" style="background-image: url(images/slide-2.jpg);">
      <!-- Put anything you want here! There is just a spacer below for demo purposes! -->
      <div style="height: 200px;"></div>
    </section>

    <!-- Content section -->
    <section class="py-5">
      <div class="container">
        <h1>Tourism</h1>
        <div class="row">

        <?php while($tour = mysqli_fetch_assoc($tourSQL)): ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
              <h4 class="text-center"><?=$tour['title'];?></h4>
              <img src="<?=$tour['photo'];?>" class="img-responsive" alt="room" width="100%" height="200px">
              <section class="text-justify">
                <p>
                  <?=$tour['details'];?>
                </p>
                <a href="tour.php?tour=<?= $tour['id']; ?>" class="btn btn-block btn-primary">More Details</a>
              </section>
            </div>

      <?php endwhile; ?>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-inverse">
      <div class="container">
        <p class="m-0 text-center ">Copyright &copy; Hotel & Tourism</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  </body>

</html>

<?php
require_once 'core/core.php';
include 'includes/header.php';
include 'includes/navigation.php';

$sql = $db->query("SELECT * FROM rooms");

?>
     <!--END NAV SECTION -->

    <div class="container"><br />
      <div class="row">

    <?php while($room = mysqli_fetch_assoc($sql)): ?>
        <div class="col-lg-3 col-md-4 col-sm-6">
          <h4 class="text-center"><?= $room['room_number']; ?></h4>
          <img src="<?= $room['photo']; ?>" class="img-responsive" alt="room" width="100%" height="200px">
          <section class="text-justify">
            <p>
              <?= $room['details']; ?>
            </p>
            <a href="details.php?room=<?= $room['id']; ?>" class="btn btn-block btn-primary">More Details</a>
          </section>
        </div>
<?php endwhile; ?>

      </div>

    </div>

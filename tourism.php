<?php
require_once 'core/core.php';
include 'includes/header.php';
include 'includes/navigation.php';

$sql = $db->query("SELECT * FROM tourism");

?>
<link rel="stylesheet" href="tourism.css">
<!--END NAV SECTION -->
<div class="container"><br />
  <div class="row" id="tour-cards">
    <?php $count = 0; ?>
    <?php while ($tour = mysqli_fetch_assoc($sql)): ?>
      <div class="col-lg-3 col-md-4 col-sm-6 tour-card">
        <h4 class="text-center"><?= $tour['title']; ?></h4>
        <img src="<?= $tour['photo']; ?>" class="img-responsive" alt="tour" width="100%" height="200px">
        <section class="text-justify">
          <p>
            <?= $tour['details']; ?>
          </p>
          <a href="tour.php?tour=<?= $tour['id']; ?>" class="btn btn-block btn-primary">More Details</a>
        </section>
      </div>
      <?php $count++; ?>
      <?php if ($count == 30)
        break; ?>
    <?php endwhile; ?>
  </div>

  <!-- Hidden cards for slider -->
  <div id="more-cards" class="d-none">
    <?php while ($tour = mysqli_fetch_assoc($sql)): ?>
      <div class="col-lg-3 col-md-4 col-sm-6 tour-card">
        <h4 class="text-center"><?= $tour['title']; ?></h4>
        <img src="<?= $tour['photo']; ?>" class="img-responsive" alt="tour" width="100%" height="200px">
        <section class="text-justify">
          <p>
            <?= $tour['details']; ?>
          </p>
          <a href="tour.php?tour=<?= $tour['id']; ?>" class="btn btn-block btn-primary">More Details</a>
        </section>
      </div>
    <?php endwhile; ?>
  </div>
</div>
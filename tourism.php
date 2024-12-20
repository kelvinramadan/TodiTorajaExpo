<?php
require_once 'core/core.php';
include 'includes/header.php';
include 'includes/navigation.php';

$sql = $db->query("SELECT * FROM tourism");

?>
<link rel="stylesheet" href="tourism.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!--END NAV SECTION -->
<div class="container"><br />
    <div class="row" id="tour-cards">
        <?php $count = 0; ?>
        <?php while ($tour = mysqli_fetch_assoc($sql)): ?>
            <div class="col-lg-4 col-md-6 col-sm-6 tour-card-wrapper">
                <div class="tour-card">
                    <img src="<?= $tour['photo']; ?>" class="img-responsive" alt="<?= $tour['title']; ?>">
                    <section>
                        <h4 class="text-center"><?= $tour['title']; ?></h4>
                        <div class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Toraja, Indonesia</span>
                        </div>
                        <p class="text-justify">
                            <?= substr($tour['details'], 0, 150) . '...'; ?>
                        </p>
                        <a href="tour.php?tour=<?= $tour['id']; ?>" class="btn btn-block btn-primary">More Details</a>
                    </section>
                </div>
            </div>
            <?php $count++; ?>
            <?php if ($count == 30) break; ?>
        <?php endwhile; ?>
    </div>

    <!-- Hidden cards for slider -->
    <div id="more-cards" class="d-none">
        <?php while ($tour = mysqli_fetch_assoc($sql)): ?>
            <div class="col-lg-4 col-md-6 col-sm-6 tour-card-wrapper">
                <div class="tour-card">
                    <img src="<?= $tour['photo']; ?>" class="img-responsive" alt="<?= $tour['title']; ?>">
                    <section>
                        <h4 class="text-center"><?= $tour['title']; ?></h4>
                        <div class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Toraja, Indonesia</span>
                        </div>
                        <p class="text-justify">
                            <?= substr($tour['details'], 0, 150) . '...'; ?>
                        </p>
                        <a href="tour.php?tour=<?= $tour['id']; ?>" class="btn btn-block btn-primary">More Details</a>
                    </section>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
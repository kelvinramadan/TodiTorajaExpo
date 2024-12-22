<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ht/core/core.php';
if(!is_logged_in()){
    login_error_check();
}

include 'includes/header.php';
include 'includes/navigation.php';

$sql = $db->query("SELECT * FROM events");

if(isset($_GET['delete'])){
    $toDeleteID = $_GET['delete'];
    $sql1 = $db->query("SELECT * FROM events WHERE id = '$toDeleteID' LIMIT 1");
    $fetch = mysqli_fetch_assoc($sql1);
    $imageURL = $_SERVER['DOCUMENT_ROOT'].$fetch['image'];
    unlink($imageURL);
    
    $sql = "DELETE FROM events WHERE id = '$toDeleteID'";
    $db->query($sql);
}
?>

<div class="w3-container w3-main" style="margin-left:260px; padding: 20px;">
    <header class="w3-container w3-purple" style="margin-bottom: 20px;">
        <span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">☰</span>
        <h2 class="text-center">Events</h2>
    </header>
    
    <?php if(isset($_SESSION['added_event'])): ?>
        <br>
        <?= $_SESSION['added_event']; ?>
        <?php unset($_SESSION['added_event']); ?>
    <?php endif; ?>

    <div class="row"><br />
        <div class="col-md-12">
            <a href="add_event.php" class="btn btn-primary pull-right">Add an event</a>
        </div>

        <?php while($event = mysqli_fetch_assoc($sql)): ?>
            <div class="col-md-3">
                <div class="card mb-4 shadow-sm">
                    <h3 class="text-center"><?= $event['event_topic']; ?></h3>
                    <!-- Perbaiki tampilan gambar -->
                    <div class="image-wrapper" style="height: 200px; overflow: hidden;">
                        <img src="<?= $event['image']; ?>" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;" alt="event image">
                    </div>
                    <div class="card-body">
                        <section>
                            <p><strong>Venue:</strong> <?= $event['venue']; ?></p>
                            <p><strong>Date:</strong> <?= $event['date']; ?></p>
                            <p><strong>Time:</strong> <?= $event['time']; ?></p>
                            <p><?= $event['short_details']; ?></p>
                        </section>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <a href="add_event.php?edit=<?=$event['id'];?>" class="btn btn-primary btn-block">Edit</a>
                            </div>
                            <div class="col-md-6">
                                <a href="events.php?delete=<?=$event['id'];?>" class="btn btn-danger btn-block" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <br /><br />
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
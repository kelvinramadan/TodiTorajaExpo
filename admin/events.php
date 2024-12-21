<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ht/core/core.php';

// Fungsi untuk membersihkan input
function clean($string) {
    global $db;
    return mysqli_real_escape_string($db, $string);
}

// Handle delete operation
if(isset($_GET['delete'])){
    $toDeleteID = clean($_GET['delete']);
    
    // Ambil informasi gambar terlebih dahulu
    $sql1 = $db->query("SELECT image FROM events WHERE id = '$toDeleteID' LIMIT 1");
    if($sql1 && $fetch = mysqli_fetch_assoc($sql1)) {
        $imageURL = $_SERVER['DOCUMENT_ROOT'].$fetch['image'];
        // Hapus file gambar jika ada
        if(file_exists($imageURL)) {
            unlink($imageURL);
        }
        
        // Hapus record dari database
        $delete_sql = "DELETE FROM events WHERE id = '$toDeleteID'";
        if($db->query($delete_sql)) {
            $_SESSION['success_message'] = "Event berhasil dihapus!";
        } else {
            $_SESSION['error_message'] = "Gagal menghapus event!";
        }
    }
    header("Location: events.php");
    exit();
}

include 'includes/header.php';
include 'includes/navigation.php';
?>

<div class="w3-container w3-main" style="margin-left:260px; padding: 20px;">
    <header class="w3-container w3-purple" style="margin-bottom: 20px;">
        <span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">☰</span>
        <h2 class="text-center">Events</h2>
    </header>
    
    <?php 
    // Tampilkan pesan sukses
    if(isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success_message']; ?>
            <?php unset($_SESSION['success_message']); ?>
        </div>
    <?php endif; ?>

    <?php 
    // Tampilkan pesan error
    if(isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error_message']; ?>
            <?php unset($_SESSION['error_message']); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12">
            <a href="add_event.php" class="btn btn-primary pull-right">Add an event</a>
        </div>
    </div>

    <div class="row mt-4">
        <?php
        // Ambil semua event
        $sql = $db->query("SELECT * FROM events ORDER BY date DESC");
        if($sql) {
            while($event = mysqli_fetch_assoc($sql)): ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <h3 class="card-header text-center"><?= htmlspecialchars($event['event_topic']); ?></h3>
                        <img src="<?= htmlspecialchars($event['image']); ?>" class="card-img-top" 
                             style="width:100%; height:200px; object-fit: cover;" alt="event image">
                        <div class="card-body">
                            <p><strong>Venue:</strong> <?= htmlspecialchars($event['venue']); ?></p>
                            <p><strong>Date:</strong> <?= htmlspecialchars($event['date']); ?></p>
                            <p><strong>Time:</strong> <?= htmlspecialchars($event['time']); ?></p>
                            <p><?= nl2br(htmlspecialchars($event['short_details'])); ?></p>
                            
                            <div class="row mt-3">
                                <div class="col-6">
                                    <a href="add_event.php?edit=<?= $event['id']; ?>" 
                                       class="btn btn-primary btn-block">Edit</a>
                                </div>
                                <div class="col-6">
                                    <a href="events.php?delete=<?= $event['id']; ?>" 
                                       class="btn btn-danger btn-block"
                                       onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile;
        } else {
            echo '<div class="col-12"><div class="alert alert-info">No events found.</div></div>';
        }
        ?>
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

<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
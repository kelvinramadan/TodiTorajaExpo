<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/TodiTorajaExpo/core/core.php';

// Pastikan koneksi database tersedia
if(!isset($db) || !$db) {
    die("Database connection not available");
}

// Handle delete operation
if(isset($_GET['delete'])){
    $toDeleteTour = mysqli_real_escape_string($db, $_GET['delete']);
    // Fetch tour details first
    $sql1 = $db->query("SELECT * FROM tourism WHERE id = '$toDeleteTour' LIMIT 1");
    if($sql1 && $fetch = mysqli_fetch_assoc($sql1)) {
        $imageURL = $_SERVER['DOCUMENT_ROOT'].'/'.$fetch['photo'];
        // Delete file if exists
        if(file_exists($imageURL)) {
            unlink($imageURL);
        }
        // Delete database record
        $sql = "DELETE FROM tourism WHERE id = '$toDeleteTour'";
        if($db->query($sql)) {
            header("Location: tours.php");
            exit();
        }
    }
}

// Fetch all tours
$sql = $db->query("SELECT * FROM tourism");
if(!$sql) {
    die("Error fetching tours: " . $db->error);
}

include 'includes/header.php';
include 'includes/navigation.php';
?>

<div class="w3-container w3-main" style="margin-left:260px; padding: 20px;">
    <header class="w3-container w3-purple" style="margin-bottom: 20px;">
        <span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">☰</span>
        <h2 class="text-center">Destinasi Wisata</h2>
    </header>
    
    <div class="row">
        <div class="col-md-12">
            <a href="add_tour.php" class="btn btn-primary pull-right">Tambah wisata</a>
        </div>
        
        <?php 
        // Check if there are any tours
        if($sql->num_rows > 0):
            while($tour = mysqli_fetch_assoc($sql)): 
        ?>
            <div class="col-md-3">
                <h3 class="text-center"><?= htmlspecialchars($tour['title']); ?></h3>
                <img src="../<?= htmlspecialchars($tour['photo']); ?>" class="img-thumbnail" style="width:100%; height:200px" alt="Tour Image">
                <div class="section">
                    <section>
                        <p><?= htmlspecialchars($tour['details']); ?></p>
                    </section>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a href="add_tour.php?edit=<?= htmlspecialchars($tour['id']); ?>" class="btn btn-primary btn-block">Edit</a>
                    </div>
                    <div class="col-md-6">
                        <a href="tours.php?delete=<?= htmlspecialchars($tour['id']); ?>" class="btn btn-danger btn-block" onclick="return confirm('Are you sure you want to delete this tour?');">Delete</a>
                    </div>
                </div>
            </div>
        <?php 
            endwhile;
        else:
        ?>
            <div class="col-md-12">
                <p class="text-center">Data tidak tersedia.</p>
            </div>
        <?php endif; ?>
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
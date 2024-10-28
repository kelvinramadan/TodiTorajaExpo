<?php
    require_once 'core/core.php';
    include 'includes/header.php';
    include 'includes/navigation.php';
    $sql = "SELECT * FROM events";
    $result = $db->query($sql);
?>

<div class="container">

    <div class="page-header text-center">
        <h3><?php echo (mysqli_num_rows($result) <= 0)? 'There are no upcoming events' :'Upcoming events' ; ?></h3>
    </div>
    <div class="row">
        <br>
   <?php while($rows = mysqli_fetch_assoc($result)): ?>
        <div class="col-sm-3" >
            <div class="w3-card-4" >
                <div class="">
                    <img src="<?=$rows['image']; ?>" style="width:100%; height:200px; padding:0px; margin:0px;" alt="event image" >
                </div>
                <div class="w3-container text-justify">
                    <h4 class="text-center"><b><?=$rows['event_topic']; ?></b></h4>
                    <p>
                        <?=$rows['short_details']; ?>

                    </p>
                </div>
                <footer class="w3-container w3-blue w3-padding">
                    <a type="button" href="view.php?view=<?=$rows['id'];?>" class="w3-btn w3-black w3-btn-block">More details</a>
                </footer>
            </div>
            <br>
        </div>
      <?php endwhile; ?>


    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

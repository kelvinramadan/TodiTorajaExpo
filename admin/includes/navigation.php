<style>
     .navbar {
      margin-bottom: 0;
      border-radius: 0;
      border: none;
    }
</style>
<body>
    <!-- <div id="headerWrapper">
    class="navbar navbar-inverse w3-purple"

  </div> -->
<nav class="w3-sidenav w3-collapse w3-purple w3-card-2 w3-animate-left" style="width:200px;">
  <a href="javascript:void(0)" onclick="w3_close()"
  class="w3-closenav w3-large w3-hide-large">Close ×</a>
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#Navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="index.php" class="navbar-brand active w3-text-white">H&T - Admin</a>
        </div>

        <ul class="nav navbar-nav collapse navbar-collapse" id="Navigation">
          	<a href="#" onclick="w3_close()" class="w3-closenav w3-hide-large">Close x</a>
            <li><a class="w3-text-white" href="reservations.php" >Reservations</a></li>
            <li><a class="w3-text-white" href="tour_reserves.php" >Tour Reserves</a></li>
            <li><a class="w3-text-white" href="events.php" >Events</a></li>
            <li><a class="w3-text-white" href="rooms.php" >Rooms</a></li>
            <li><a class="w3-text-white" href="tours.php" >Tours</a></li>
            <!-- <li><a class="w3-text-white" href="videos.php">Videos</a></li> -->
            <?php if(permission()): ?>
              <li> <a class="w3-text-white" href="users.php" class=" w3-hover-red"><span class="glyphicon glyphicon-user"></span> Users</a> </li>
            <?php endif; ?>
            <li><a class="w3-text-white" href="../index.php"  class="w3-text-white w3-hover-red"><span class="glyphicon glyphicon-map-marker"></span> Visit Site</a></li>
            <li><a class="w3-text-white" href="logout.php">Logout</a></li>
            <li>  <a class="w3-text-white" href="#" data-toggle="dropdown" class="w3-text-white w3-hover-red"><?php echo $user_info['first'].' '.$user_info['last']; ?></a></li>
        </ul>

        <ul class="nav navbar-nav">


            <li class="dropdown">

                  <ul class="dropdown-menu w3-purple" role="menu">

                    <li><a class="w3-text-white" href="#">Change password</a></li>
                  </ul>
            </li>

        </ul>
    </div>
</nav>

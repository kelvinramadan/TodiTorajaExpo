<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ht/core/core.php';

// Fetch summary data
$rooms_query = "SELECT COUNT(*) as total_rooms FROM rooms";
$rooms_result = $db->query($rooms_query);
$total_rooms = $rooms_result->fetch_assoc()['total_rooms'];

$events_query = "SELECT COUNT(*) as total_events FROM events";
$events_result = $db->query($events_query);
$total_events = $events_result->fetch_assoc()['total_events'];

$tourism_query = "SELECT COUNT(*) as total_tours FROM tourism";
$tourism_result = $db->query($tourism_query);
$total_tours = $tourism_result->fetch_assoc()['total_tours'];

$reservations_query = "SELECT COUNT(*) as total_reservations FROM reservations";
$reservations_result = $db->query($reservations_query);
$total_reservations = $reservations_result->fetch_assoc()['total_reservations'];

// Get recent reservations
$recent_reservations = $db->query("SELECT * FROM reservations ORDER BY id DESC LIMIT 5");

// Get recent events
$upcoming_events = $db->query("SELECT * FROM events WHERE date >= CURDATE() ORDER BY date ASC LIMIT 5");

// Get most popular rooms
$popular_rooms = $db->query("SELECT room as room_name, COUNT(*) as booking_count FROM reservations GROUP BY room ORDER BY booking_count DESC LIMIT 5");

include 'includes/header.php';
include 'includes/navigation.php';
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="w3-container w3-main" style="margin-left:260px">
    <header class="w3-container w3-purple">
        <span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">☰</span>
        <h2 class="text-center">Dashboard</h2>
    </header>

    <!-- Stats Cards -->
    <div class="dashboard-stats">
        <div class="stat-card">
            <i class="fas fa-hotel"></i>
            <div class="stat-content">
                <h3>Total Rooms</h3>
                <p class="stat-number"><?php echo $total_rooms; ?></p>
            </div>
        </div>
        <div class="stat-card">
            <i class="fas fa-calendar-alt"></i>
            <div class="stat-content">
                <h3>Active Events</h3>
                <p class="stat-number"><?php echo $total_events; ?></p>
            </div>
        </div>
        <div class="stat-card">
            <i class="fas fa-map-marked-alt"></i>
            <div class="stat-content">
                <h3>Tour Destinations</h3>
                <p class="stat-number"><?php echo $total_tours; ?></p>
            </div>
        </div>
        <div class="stat-card">
            <i class="fas fa-bookmark"></i>
            <div class="stat-content">
                <h3>Total Reservations</h3>
                <p class="stat-number"><?php echo $total_reservations; ?></p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h3>Quick Actions</h3>
        <div class="action-buttons">
            <a href="add_room.php" class="action-btn">
                <i class="fas fa-plus"></i> Add Room
            </a>
            <a href="add_event.php" class="action-btn">
                <i class="fas fa-calendar-plus"></i> Add Event
            </a>
            <a href="add_tour.php" class="action-btn">
                <i class="fas fa-map-pin"></i> Add Tour
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="dashboard-columns">
        <!-- Recent Reservations -->
        <div class="dashboard-column">
            <div class="content-card">
                <h3><i class="fas fa-clock"></i> Recent Reservations</h3>
                <div class="activity-list">
                    <?php while($reservation = mysqli_fetch_assoc($recent_reservations)): ?>
                        <div class="activity-item">
                            <div class="activity-icon blue">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="activity-details">
                                <p class="activity-title"><?php echo htmlspecialchars($reservation['name']); ?></p>
                                <p class="activity-info">Room: <?php echo htmlspecialchars($reservation['room']); ?></p>
                                <p class="activity-date">Check-in: <?php echo htmlspecialchars($reservation['checkin']); ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

        <!-- Upcoming Events -->
        <div class="dashboard-column">
            <div class="content-card">
                <h3><i class="fas fa-calendar"></i> Upcoming Events</h3>
                <div class="activity-list">
                    <?php while($event = mysqli_fetch_assoc($upcoming_events)): ?>
                        <div class="activity-item">
                            <div class="activity-icon purple">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                            <div class="activity-details">
                                <p class="activity-title"><?php echo htmlspecialchars($event['event_topic']); ?></p>
                                <p class="activity-info">Location: <?php echo htmlspecialchars($event['venue']); ?></p>
                                <p class="activity-date">Date: <?php echo htmlspecialchars($event['date']); ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

        <!-- Popular Rooms -->
        <div class="dashboard-column">
            <div class="content-card">
                <h3><i class="fas fa-star"></i> Most Booked Rooms</h3>
                <div class="activity-list">
                    <?php while($room = mysqli_fetch_assoc($popular_rooms)): ?>
                        <div class="activity-item">
                            <div class="activity-icon green">
                                <i class="fas fa-bed"></i>
                            </div>
                            <div class="activity-details">
                                <!-- Ubah room_number menjadi room_name -->
                                <p class="activity-title"><?php echo htmlspecialchars($room['room_name']); ?></p>
                                <p class="activity-info">Bookings: <?php echo $room['booking_count']; ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Dashboard Styles */
.dashboard-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 20px;
    padding: 20px;
}

.stat-card {
    background: white;
    border-radius: 10px;
    padding: 20px;
    display: flex;
    align-items: center;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.stat-card i {
    font-size: 2.5em;
    color: #2D1B69;
    margin-right: 20px;
}

.stat-content h3 {
    margin: 0;
    font-size: 1em;
    color: #666;
}

.stat-number {
    font-size: 1.8em;
    font-weight: bold;
    color: #2D1B69;
    margin: 5px 0 0 0;
}

/* Quick Actions */
.quick-actions {
    padding: 20px;
}

.action-buttons {
    display: flex;
    gap: 15px;
    margin-top: 15px;
}

.action-btn {
    background: #2D1B69;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: background-color 0.3s;
}

.action-btn:hover {
    background: #1a1042;
    color: white;
}

/* Dashboard Columns */
.dashboard-columns {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    padding: 20px;
}

.content-card {
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.content-card h3 {
    margin: 0 0 20px 0;
    display: flex;
    align-items: center;
    gap: 10px;
    color: #2D1B69;
}

.activity-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.activity-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 10px;
    border-radius: 8px;
    background: #f8f9fa;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.activity-icon.blue { background: #4e73df; }
.activity-icon.purple { background: #6f42c1; }
.activity-icon.green { background: #1cc88a; }

.activity-details {
    flex: 1;
}

.activity-title {
    margin: 0;
    font-weight: bold;
    color: #2D1B69;
}

.activity-info {
    margin: 2px 0;
    color: #666;
    font-size: 0.9em;
}

.activity-date {
    margin: 0;
    color: #888;
    font-size: 0.8em;
}

/* Responsive Design */
@media (max-width: 768px) {
    .dashboard-stats {
        grid-template-columns: 1fr;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .dashboard-columns {
        grid-template-columns: 1fr;
    }
}
</style>

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
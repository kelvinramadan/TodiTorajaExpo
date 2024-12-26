<?php
// navigation.php

?>
<nav class="sidebar">
    <div class="brand">
        <i class="fas fa-hotel"></i>
        <span>Adorable Admin</span>
    </div>
    
    <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Cari...">
    </div>
    
    <ul class="nav-links">
        <li>
            <a href="index.php">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="reservations.php">
                <i class="fas fa-calendar-check"></i>
                <span>Reservasi Penginapan</span>
            </a>
        </li>
        <li>
            <a href="tour_reserves.php">
                <i class="fas fa-route"></i>
                <span>Reservasi Wisata</span>
            </a>
        </li>
        <li>
            <a href="events.php">
                <i class="fas fa-calendar-day"></i>
                <span>Kelola Festival</span>
            </a>
        </li>
        <li>
            <a href="rooms.php">
                <i class="fas fa-bed"></i>
                <span>Kamar Penginapan</span>
            </a>
        </li>
        <li>
            <a href="tours.php">
                <i class="fas fa-map-marked-alt"></i>
                <span>Kelola Wisata</span>
            </a>
        </li>
        <li>
            <a href="admin_users.php">
                <i class="fas fa-map-marked-alt"></i>
                <span>Users</span>
            </a>
        </li>
    </ul>
    
    <div class="user-info">
        <i class="fas fa-user-circle"></i>
        <span>admin</span>
    </div>
</nav>

<!-- Add mobile navigation button -->
<div class="mobile-nav">
    <i class="fas fa-bars"></i>
</div>

<!-- Add overlay -->
<div class="overlay"></div>

<style>
.sidebar {
    width: 260px;
    height: 100vh;
    background: #2D1B69;
    padding: 20px;
    color: white;
    position: fixed;
    left: 0;
    top: 0;
}

.brand {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 20px;
    margin-bottom: 30px;
}

.search-box {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    padding: 8px 15px;
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.search-box input {
    background: transparent;
    border: none;
    color: white;
    margin-left: 10px;
    width: 100%;
}

.search-box input::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.nav-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.nav-links li {
    margin-bottom: 5px;
}

.nav-links a {
    display: flex;
    align-items: center;
    gap: 12px;
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    padding: 12px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.nav-links a:hover {
    background: rgba(255, 255, 255, 0.1);
    color: white;
}

.nav-links a.active {
    background: rgba(255, 255, 255, 0.2);
    color: white;
}

.user-info {
    position: absolute;
    bottom: 20px;
    left: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    color: rgba(255, 255, 255, 0.8);
}

/* Add Font Awesome CSS link in your header */
</style>

<!-- Add this in your header.php -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
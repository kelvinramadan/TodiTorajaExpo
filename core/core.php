<!-- CORE.PHP -->

<?php
// Database connection
$db = new mysqli('localhost', 'root', '', 'adorable_db');
if (!$db) {
    die('Could not establish database connection, please review your settings');
}

define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/TodiTorajaExpo/');
include BASEURL.'fpdf/fpdf.php';
session_start();

// Helper functions for user management
function getUserData($userId) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function updateProfileImage($userId, $imagePath) {
    global $db;
    $stmt = $db->prepare("UPDATE users SET profile_image = ? WHERE id = ?");
    $stmt->bind_param("si", $imagePath, $userId);
    return $stmt->execute();
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Redirect if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: loginregist.php');
        exit();
    }
}
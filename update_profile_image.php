<?php
require_once 'core/core.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['profile_image'])) {
        $targetDir = "uploads/profile_images/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        
        $imageFileType = strtolower(pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION));
        $targetFile = $targetDir . $_SESSION['user_id'] . "_" . time() . "." . $imageFileType;
        
        // Check if image file is actual image
        if (getimagesize($_FILES["profile_image"]["tmp_name"])) {
            if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFile)) {
                if (updateProfileImage($_SESSION['user_id'], $targetFile)) {
                    $_SESSION['success'] = "Profile image updated successfully!";
                } else {
                    $_SESSION['error'] = "Error updating profile image in database!";
                }
            } else {
                $_SESSION['error'] = "Error uploading file!";
            }
        } else {
            $_SESSION['error'] = "File is not an image!";
        }
    }
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
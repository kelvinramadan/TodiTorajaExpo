<?php
require_once 'core/core.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => '', 'image_url' => ''];
    
    if (isset($_FILES['profile_image'])) {
        $targetDir = "uploads/profile_images/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        
        $imageFileType = strtolower(pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION));
        $targetFile = $targetDir . $_SESSION['user_id'] . "_" . time() . "." . $imageFileType;
        
        if (getimagesize($_FILES["profile_image"]["tmp_name"])) {
            if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFile)) {
                if (updateProfileImage($_SESSION['user_id'], $targetFile)) {
                    $response['success'] = true;
                    $response['message'] = "Profile image updated successfully!";
                    $response['image_url'] = $targetFile;
                } else {
                    $response['message'] = "Error updating profile image in database!";
                }
            } else {
                $response['message'] = "Error uploading file!";
            }
        } else {
            $response['message'] = "File is not an image!";
        }
    }
    
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        echo json_encode($response);
        exit;
    } else {
        $_SESSION[$response['success'] ? 'success' : 'error'] = $response['message'];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
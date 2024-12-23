<?php
require_once 'core/core.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    $userId = $_SESSION['user_id'];

    // Validate password match
    if ($newPassword !== $confirmPassword) {
        $_SESSION['error'] = "New passwords do not match!";
        header('Location: index.php');
        exit;
    }

    // Get user's current password from database
    $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    // Verify current password
    if (!password_verify($currentPassword, $user['password'])) {
        $_SESSION['error'] = "Current password is incorrect!";
        header('Location: index.php');
        exit;
    }

    // Hash new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update password in database
    try {
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->execute([$hashedPassword, $userId]);
        
        $_SESSION['success'] = "Password successfully updated!";
    } catch (PDOException $e) {
        $_SESSION['error'] = "Failed to update password. Please try again.";
    }

    header('Location: index.php');
    exit;
}
?>
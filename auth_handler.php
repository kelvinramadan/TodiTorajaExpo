<!-- AUTH_HANDLER.php-- >

<?php
require 'core/core.php';

// Function to sanitize input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Registration Handler
if (isset($_POST['register'])) {
    $fullname = sanitize_input($_POST['fullName']);
    $phone = sanitize_input($_POST['phone']);
    $email = sanitize_input($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $confirm_password = $_POST['confirmPassword'];

    // Validate password match
    if ($_POST['password'] !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match!";
        header("Location: loginregist.php");
        exit();
    }

    // Check if email already exists
    $check_email = $db->prepare("SELECT email FROM users WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $result = $check_email->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Email already exists!";
        header("Location: loginregist.php");
        exit();
    }

    // Insert new user
    $stmt = $db->prepare("INSERT INTO users (fullname, phone, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullname, $phone, $email, $password);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Registration successful! Please login.";
        header("Location: loginregist.php");
    } else {
        $_SESSION['error'] = "Registration failed! Please try again.";
        header("Location: loginregist.php");
    }
    exit();
}

// Login Handler
if (isset($_POST['login'])) {
    $email = sanitize_input($_POST['email']);
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            header("Location: index.php");
            exit();
        }
    }
    
    $_SESSION['error'] = "Invalid email or password!";
    header("Location: loginregist.php");
    exit();
}
?>
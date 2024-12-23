<!-- NAVIGATION.PHP -->

<?php
require_once 'core/core.php';
requireLogin();

$userData = getUserData($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel & Tourism Reservation</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

    <style>
        :root {
            --navbar-height: 70px;
            --navbar-brand-size: 24px;
            --nav-link-size: 15px;
            --nav-icon-size: 16px;
            --nav-padding: 12px 20px;
            --active-indicator-height: 4px;
        }

        /* Previous navbar styles remain the same */
        .custom-navbar {
            background: linear-gradient(135deg, #1a1a1a 0%, #363636 100%);
            height: var(--navbar-height);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        /* Previous styles remain... */

        /* New Profile Styles */
        .profile-nav-item {
            display: flex;
            align-items: center;
            margin-left: 15px;
        }

        .profile-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
            cursor: pointer;
        }

        .profile-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            min-width: 200px;
            display: none;
            z-index: 1000;
        }

        .profile-dropdown.show {
            display: block;
        }

        .profile-dropdown-header {
            padding: 15px;
            border-bottom: 1px solid #eee;
            text-align: center;
        }

        .profile-dropdown-header img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .profile-dropdown-content {
            padding: 10px 0;
        }

        .profile-dropdown-item {
            padding: 8px 15px;
            color: #333;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: background-color 0.3s;
        }

        .profile-dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .profile-dropdown-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Password Change Modal Styles */
        .modal-content {
            border-radius: 12px;
        }

        .modal-header {
            background: linear-gradient(135deg, #1a1a1a 0%, #363636 100%);
            color: white;
            border-radius: 12px 12px 0 0;
        }

        .modal-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-hotel"></i>
                by : Adorable
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="fas fa-home"></i>
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tourism.php">
                            <i class="fas fa-map-marked-alt"></i>
                            Tourism
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rooms.php">
                            <i class="fas fa-bed"></i>
                            Rooms
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="payment.php">
                            <i class="fas fa-credit-card"></i>
                            Payment
                        </a>
                    </li>
                    <li class="nav-item profile-nav-item">
    <img src="<?php echo !empty($userData['profile_image']) ? $userData['profile_image'] : 'images/default-avatar.jpg'; ?>" 
         alt="Profile" class="profile-image" id="profileDropdownToggle">
    <div class="profile-dropdown" id="profileDropdown">
        <div class="profile-dropdown-header">
            <form action="update_profile_image.php" method="POST" enctype="multipart/form-data" id="profileImageForm">
                <label for="profileImageInput" class="cursor-pointer">
                    <img src="<?php echo !empty($userData['profile_image']) ? $userData['profile_image'] : 'images/default-avatar.jpg'; ?>" 
                         alt="Profile" class="profile-image-large">
                    <small class="d-block mt-2">Click to change</small>
                </label>
                <input type="file" id="profileImageInput" name="profile_image" class="d-none" accept="image/*">
            </form>
            <h6 class="mb-0"><?php echo htmlspecialchars($userData['fullname']); ?></h6>
            <small class="text-muted"><?php echo htmlspecialchars($userData['email']); ?></small>
        </div>
        <div class="profile-dropdown-content">
            <a href="profile.php" class="profile-dropdown-item">
                <i class="fas fa-user"></i>
                My Profile
            </a>
            <a href="logout.php" class="profile-dropdown-item">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>
        </div>
    </div>
</li>

<!-- Update the password change modal form -->
<div class="modal fade" id="changePasswordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="update_password.php" method="POST" id="changePasswordForm">
                    <div class="form-group">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Change Password</button>
                </form>
            </div>
        </div>
    </div>
    </nav>

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="changePasswordForm">
                        <div class="form-group">
                            <label for="currentPassword">Current Password</label>
                            <input type="password" class="form-control" id="currentPassword" required>
                        </div>
                        <div class="form-group">
                            <label for="newPassword">New Password</label>
                            <input type="password" class="form-control" id="newPassword" required>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmPassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Profile Dropdown and Password Change JavaScript -->
    <script>
        // Profile Dropdown Toggle
        const profileDropdownToggle = document.getElementById('profileDropdownToggle');
        const profileDropdown = document.getElementById('profileDropdown');

        profileDropdownToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            profileDropdown.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!profileDropdown.contains(e.target) && !profileDropdownToggle.contains(e.target)) {
                profileDropdown.classList.remove('show');
            }
        });

        // Password Change Form Handler
        const changePasswordForm = document.getElementById('changePasswordForm');
        changePasswordForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const currentPassword = document.getElementById('currentPassword').value;
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            // Validate passwords match
            if (newPassword !== confirmPassword) {
                alert('New passwords do not match!');
                return;
            }

            // For demo purposes:
            alert('Password change functionality would go here!');
            document.getElementById('changePasswordModal').classList.remove('show');
        });

        // Active state handling (previous code)
        const currentLocation = location.href;
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            if(link.href === currentLocation) {
                link.classList.add('active');
            }
        });
    </script>
</body>
</html>
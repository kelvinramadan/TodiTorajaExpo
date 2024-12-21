<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toraja Travel Portal</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="loginregist.css">
    <style>
        .alert {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            text-align: center;
        }
        .alert-error {
            background-color: #ffebee;
            color: #c62828;
        }
        .alert-success {
            background-color: #e8f5e9;
            color: #2e7d32;
        }
    </style>
</head>
<body>
    <?php require 'core/core.php'; ?>
    
    <!-- Left Information Section -->
    <section class="info-section">
        <div class="info-content">
            <div class="info-header">
                <h1>Toraja</h1>
                <p>Discover the Ancient Traditions</p>
            </div>
            <div class="info-text">
                <p>Experience the unique culture and breathtaking landscapes of Tana Toraja. From traditional burial sites to stunning traditional houses, immerse yourself in this fascinating cultural heritage.</p>
            </div>
            <div class="features">
                <div class="feature-item">
                    <i class="fas fa-hand-pointer"></i>
                    <h3>Mudah Digunakan</h3>
                </div>
                <div class="feature-item">
                    <i class="fas fa-tags"></i>
                    <h3>Harga Terjangkau</h3>
                </div>
                <div class="feature-item">
                    <i class="fas fa-smile"></i>
                    <h3>Ramah</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Right Authentication Section -->
    <section class="auth-section">
        <div class="form-container">
            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php 
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>

            <!-- Sign In Form -->
            <div class="form active" id="signin-form">
                <h2 class="title">Sign In</h2>
                <form action="auth_handler.php" method="POST">
                    <div class="input-field">
                        <input type="email" name="email" required>
                        <label>Email</label>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" required>
                        <label>Password</label>
                    </div>
                    <button type="submit" name="login" class="btn">Login</button>
                    <div class="switch-form">
                        <p>Don't have an account? <a id="show-signup">Sign Up</a></p>
                    </div>
                </form>
            </div>

            <!-- Sign Up Form -->
            <div class="form" id="signup-form">
                <h2 class="title">Create Account</h2>
                <form action="auth_handler.php" method="POST">
                    <div class="input-field">
                        <input type="text" id="fullName" name="fullName" required autocomplete="name">
                        <label for="fullName">Full Name</label>
                    </div>

                    <div class="input-field">
                        <input type="tel" id="phone" name="phone" required autocomplete="tel">
                        <label for="phone">No. Telp</label>
                    </div>

                    <div class="input-field">
                        <input type="email" id="email" name="email" required autocomplete="email">
                        <label for="email">Email</label>
                    </div>

                    <div class="input-field">
                        <input type="password" id="password" name="password" required>
                        <label for="password">Password</label>
                    </div>

                    <div class="input-field">
                        <input type="password" id="confirmPassword" name="confirmPassword" required>
                        <label for="confirmPassword">Confirm Password</label>
                    </div>
                    <button type="submit" name="register" class="btn">Register</button>
                    <div class="switch-form">
                        <p>Already have an account? <a id="show-signin">Sign In</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Background Slideshow -->
    <div class="background-slider">
        <div class="slide active" style="background-image: url('images/toraja.jpg')"></div>
        <div class="slide" style="background-image: url('images/toraja1.jpg')"></div>
        <div class="slide" style="background-image: url('images/toraja2.jpg')"></div>
        <div class="slide" style="background-image: url('images/toraja1.jpg')"></div>
    </div>

    <script>
        // Background Slideshow
        function startBackgroundSlideshow() {
            const slides = document.querySelectorAll('.background-slider .slide');
            let currentSlide = 0;

            setInterval(() => {
                slides[currentSlide].classList.remove('active');
                currentSlide = (currentSlide + 1) % slides.length;
                slides[currentSlide].classList.add('active');
            }, 5000);
        }

        // Form Switching
        const signinForm = document.getElementById('signin-form');
        const signupForm = document.getElementById('signup-form');
        const showSignup = document.getElementById('show-signup');
        const showSignin = document.getElementById('show-signin');

        showSignup.addEventListener('click', () => {
            signinForm.classList.remove('active');
            signupForm.classList.add('active');
        });

        showSignin.addEventListener('click', () => {
            signupForm.classList.remove('active');
            signinForm.classList.add('active');
        });

        // Floating label animation
        const inputs = document.querySelectorAll('.input-field input');
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.classList.add('active');
            });
            input.addEventListener('blur', () => {
                if (input.value === '') {
                    input.classList.remove('active');
                }
            });
        });

        // Start the slideshow
        startBackgroundSlideshow();
    </script>
</body>
</html>
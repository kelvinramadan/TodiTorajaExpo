<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toraja Travel Portal</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            position: relative;
            overflow: hidden;
        }

        /* Left Section - 25% */
        .info-section {
            width: 25%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 2rem;
            position: relative;
            z-index: 2;
        }

        .info-content {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .info-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .info-header h1 {
            font-size: 2.5em;
            margin-bottom: 1rem;
            color: #fff;
        }

        .info-text {
            font-size: 1.1em;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .features {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            gap: 1rem;
            margin-top: 2rem;
        }

        .feature-item {
            text-align: center;
            padding: 0.5rem;
            flex: 1;
        }

        .feature-item i {
            font-size: 1.5em;
            margin-bottom: 1rem;
            color: #2196F3;
        }

        .feature-item h3 {
            font-size: 1.2em;
            margin-bottom: 0.5rem;
        }

        /* Right Section - 75% */
        .auth-section {
            width: 75%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            background: transparent;
        }

        /* Background Slideshow */
        .background-slider {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
            background-size: cover;
            background-position: center;
        }

        .slide.active {
            opacity: 1;
        }

        /* Form Styles */
        .form-container {
            width: 100%;
            max-width: 450px;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        .form {
            display: none;
            animation: fadeIn 0.5s ease-out;
        }

        .form.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .title {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 30px;
            color: #333;
            text-align: center;
        }

        .input-field {
            position: relative;
            margin-bottom: 25px;
        }

        .input-field input {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-bottom: 2px solid #ddd;
            outline: none;
            background: transparent;
            transition: 0.3s;
        }

        .input-field input:focus {
            border-bottom-color: #2196F3;
        }

        .input-field label {
            position: absolute;
            top: 12px;
            left: 0;
            font-size: 16px;
            color: #666;
            pointer-events: none;
            transition: 0.3s;
        }

        .input-field input:focus ~ label,
        .input-field input:valid ~ label {
            top: -20px;
            font-size: 14px;
            color: #2196F3;
        }

        .btn {
            width: 100%;
            height: 45px;
            border: none;
            border-radius: 50px;
            background: #2196F3;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .btn:hover {
            background: #1976D2;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(33, 150, 243, 0.3);
        }

        .switch-form {
            text-align: center;
            color: #666;
        }

        .switch-form a {
            color: #2196F3;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
        }

        .switch-form a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
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
            <!-- Sign In Form -->
            <div class="form active" id="signin-form">
                <h2 class="title">Sign In</h2>
                <div class="input-field">
                    <input type="email" required>
                    <label>Email</label>
                </div>
                <div class="input-field">
                    <input type="password" required>
                    <label>Password</label>
                </div>
                <button class="btn">Login</button>
                <div class="switch-form">
                    <p>Don't have an account? <a id="show-signup">Sign Up</a></p>
                </div>
            </div>

            <!-- Sign Up Form -->
            <div class="form" id="signup-form">
                <h2 class="title">Create Account</h2>
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
                <button class="btn">Register</button>
                <div class="switch-form">
                    <p>Already have an account? <a id="show-signin">Sign In</a></p>
                </div>
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
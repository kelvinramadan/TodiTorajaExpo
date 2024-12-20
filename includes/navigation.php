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

        /* Custom Navbar Styling */
        .custom-navbar {
            background: linear-gradient(135deg, #1a1a1a 0%, #363636 100%);
            height: var(--navbar-height);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: var(--navbar-brand-size) !important;
            color: #fff !important;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
            line-height: var(--navbar-height);
            padding: 0 15px;
            margin: 0;
        }

        .navbar-nav {
            height: var(--navbar-height);
            display: flex;
            align-items: center;
        }

        .navbar-nav .nav-item {
            margin: 0;
            height: 100%;
            display: flex;
            align-items: center;
            position: relative;
        }

        .navbar-nav .nav-link {
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            font-size: var(--nav-link-size) !important;
            color: rgba(255,255,255,0.9) !important;
            padding: var(--nav-padding) !important;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            height: 100%;
            position: relative;
        }

        /* New Active State Styling */
        .navbar-nav .nav-item .nav-link.active {
            background-color: rgba(0, 0, 0, 0.3);
            color: #ffffff !important;
        }

        .navbar-nav .nav-item .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: var(--active-indicator-height);
            background-color: #ffffff;
        }

        .navbar-nav .nav-link i {
            margin-right: 8px;
            font-size: var(--nav-icon-size) !important;
            transition: transform 0.3s ease;
        }

        @media (max-width: 991.98px) {
            .custom-navbar {
                height: auto;
                padding: 10px 0;
            }

            .navbar-brand {
                line-height: normal;
                padding: 10px 15px;
            }

            .navbar-nav {
                height: auto;
                padding: 10px 0;
            }
            
            .navbar-nav .nav-item {
                height: auto;
                margin: 5px 0;
            }

            .navbar-nav .nav-link.active::after {
                height: 100%;
                width: var(--active-indicator-height);
                top: 0;
                left: 0;
            }
            
            .navbar-collapse {
                background: rgba(26,26,26,0.98);
                border-radius: 8px;
                margin-top: 10px;
                padding: 10px;
            }
        }

        body {
            padding-top: var(--navbar-height);
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
                            
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tourism.php">
                            <i class="fas fa-map-marked-alt"></i>
                            
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rooms.php">
                            <i class="fas fa-bed"></i>
                            
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="payment.php">
                            <i class="fas fa-credit-card"></i>
                            
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Add JavaScript for active state handling -->
    <script>
        // Get current page URL
        const currentLocation = location.href;
        
        // Get all nav links
        const navLinks = document.querySelectorAll('.nav-link');
        
        // Loop through each link
        navLinks.forEach(link => {
            // If the link href matches current location
            if(link.href === currentLocation) {
                link.classList.add('active');
            }
        });
    </script>
</body>
</html>
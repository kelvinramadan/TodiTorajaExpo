<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCE - Admin Dashboard</title>
    
    <!-- Essential CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/w3.css" rel="stylesheet">
    
    <!-- Modern UI Libraries -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="css/customs.css" rel="stylesheet">
    <link href="admin/add_event.css" rel="stylesheet">
    
    <!-- Modern UI Theme CSS -->
    <style>
        :root {
            --primary-color: #4355b9;
            --secondary-color: #6576cb;
            --accent-color: #7e57c2;
            --background-color: #f8f9fa;
            --surface-color: #ffffff;
            --text-primary: #2c3e50;
            --text-secondary: #636e72;
            --success-color: #2ecc71;
            --warning-color: #f1c40f;
            --error-color: #e74c3c;
            --border-radius: 8px;
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.07);
            --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background-color);
            color: var(--text-primary);
            line-height: 1.6;
        }

        /* Modern Card Styling */
        .card {
            background: var(--surface-color);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-md);
            border: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        /* Modern Form Controls */
        .form-control {
            border-radius: var(--border-radius);
            border: 1px solid #e1e1e1;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 85, 185, 0.1);
        }

        /* Modern Buttons */
        .btn {
            border-radius: var(--border-radius);
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        /* Header Styling */
        .w3-purple {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color)) !important;
            color: white;
            box-shadow: var(--shadow-md);
        }

        /* Sidebar Modernization */
        .sidebar {
            background: var(--surface-color);
            box-shadow: var(--shadow-lg);
        }

        .nav-links a {
            border-radius: var(--border-radius);
            margin: 0.2rem 0;
            transition: all 0.3s ease;
        }

        .nav-links a:hover {
            background: rgba(67, 85, 185, 0.1);
            transform: translateX(5px);
        }

        /* Mobile Navigation */
        .mobile-nav {
            background: var(--primary-color);
            box-shadow: var(--shadow-md);
        }

        /* Animations */
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <!-- Scripts -->
    <script src="includes/ckeditor/ckeditor.js"></script>
</head>
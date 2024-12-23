<?php
ob_start();
require_once 'core/core.php';
include 'includes/header.php';
include 'includes/navigation.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: loginregist.php');
    exit();
}

// Simple queries without filters
$roomQuery = "SELECT * FROM rooms LIMIT 4";
$sql = $db->query($roomQuery);

$tourQuery = "SELECT * FROM tourism LIMIT 4";
$tourSQL = $db->query($tourQuery);

$result = $db->query("SELECT * FROM events");
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel & Tourism</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="scss">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="headerindex.css">
    <link rel="stylesheet" href="css/indexcard.css">
    <link rel="stylesheet" href="eventindex.css">
</head>
<style>
        /* Custom Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Enhanced Section Headers */
        .section-header {
            position: relative;
            margin-bottom: 3rem;
            padding-bottom: 1rem;
        }

        .section-header h2 {
            font-size: 2.5rem;
            font-weight: 600;
            color: #2c3e50;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1rem;
        }

        .section-header p {
            font-size: 1.1rem;
            color: #666;
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.8;
        }

        .section-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(to right, #219B9D, #219B9D);
            border-radius: 2px;
        }

        /* Enhanced Cards */
        .accommodation-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            background: white;
        }

        .accommodation-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .image-wrapper {
            position: relative;
            overflow: hidden;
            padding-top: 66.67%;
        }

        .image-wrapper img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .accommodation-card:hover .image-wrapper img {
            transform: scale(1.1);
        }

        /* Enhanced Buttons */
        .favorite-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255,255,255,0.9);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 2;
        }

        .favorite-btn:hover {
            background: #219B9D;
            color: white;
            transform: scale(1.1);
        }

        .guest-favorite {
            position: absolute;
            top: 15px;
            left: 15px;
            background: linear-gradient(45deg, #219B9D, #219B9D);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            z-index: 2;
        }

        /* Enhanced View More Button */
        .view-more-btn {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(45deg, #219B9D, #219B9D);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 500;
            margin-top: 2rem;
            transition: all 0.3s ease;
            text-align: center;
        }

        .view-more-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
            color: white;
        }

        /* Enhanced Card Body */
        .card-body {
            padding: 1.5rem;
        }

        .location-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .location-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin: 0;
            color: #2c3e50;
        }

        .rating {
            background: #ffeaa7;
            color: #fdcb6e;
            padding: 4px 8px;
            border-radius: 12px;
            font-weight: 600;
        }

        .accommodation-count {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .card-text {
            color: #666;
            line-height: 1.6;
            margin: 0;
        }

        /* Enhanced Modal */
        .event-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .event-modal.active {
            opacity: 1;
        }

        .modal-content {
            position: relative;
            width: 90%;
            max-width: 800px;
            margin: 50px auto;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transform: translateY(-50px);
            transition: transform 0.3s ease;
        }

        .event-modal.active .modal-content {
            transform: translateY(0);
        }

        /* Enhanced Footer */

        /* Responsive Design */
        @media (max-width: 768px) {
            .section-header h2 {
                font-size: 2rem;
            }
            
            .section-header p {
                font-size: 1rem;
            }
            
            footer .container {
                grid-template-columns: 1fr;
                text-align: center;
            }
            
            footer h4::after {
                left: 50%;
                transform: translateX(-50%);
            }
        }
    </style>
<body>

<!-- Header Section -->
<header class="dynamic-header">
    <section class="hero">
        <div class="hero-slider">
            <!-- Multiple background images for slider -->
            <div class="slide" style="background-image: url('images/toraja.jpg')"></div>
            <div class="slide" style="background-image: url('images/toraja1.jpg')"></div>
            <div class="slide" style="background-image: url('images/toraja2.jpg')"></div>
        </div>
        <div class="overlay"></div>
        
        <div class="hero-content">
            <h1 class="animate-text" style="color:#FFFFFF">TodiToraja</h1>
            <p class="animate-text-delay">Nikmati perjalanan bermakna bersama TodiToraja, menjelajahi keindahan alam dan kekayaan budaya Toraja. Temukan tradisi sakral, situs bersejarah, dan keramahan lokal yang menghubungkan Anda dengan warisan leluhur, menciptakan kenangan tak terlupakan.</p>
            
            <!-- Animated stats -->
            <div class="stats-container">
                <div class="stat-item">
                    <span class="stat-number" data-target="1000">0</span>
                    <span class="stat-label">Wisatawan</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number" data-target="50">0</span>
                    <span class="stat-label">Destinasi</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number" data-target="100">0</span>
                    <span class="stat-label">Hotel</span>
                </div>
            </div>
        </div>
    </section>
</header>


<!-- EVENT SECTION -->
<div class="container mt-5">
<h2 class="text-center">Event & Budaya</h2>
<p class="text-center">Tana Toraja merupakan daerah yang terkenal dengan kekayaan budaya dan tradisi yang sangat unik dan beragam. Setiap tahunnya, berbagai acara budaya dan upacara keagamaan diselenggarakan di wilayah ini, yang tidak hanya menjadi bagian penting dari kehidupan masyarakat setempat tetapi juga berhasil menarik perhatian para wisatawan, baik dari berbagai penjuru Indonesia maupun dari mancanegara.</p>
    <div class="row">
        <?php while($event = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm accommodation-card" onclick="openModal(this)" data-event='<?= json_encode($event); ?>'>
                    <div class="image-wrapper">
                        <img src="<?= $event['image']; ?>" class="card-img-top" alt="<?= $event['event_topic']; ?>">
                        <button class="favorite-btn" onclick="event.stopPropagation()">
                            <i class="far fa-heart"></i>
                        </button>
                        <?php if(isset($event['is_featured'])): ?>
                            <span class="guest-favorite">Guest favorite</span>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="location-wrapper">
                            <h5 class="location-title"><?= $event['event_topic']; ?></h5>
                            <?php if(isset($event['rating'])): ?>
                                <span class="rating">★ <?= $event['rating']; ?></span>
                            <?php endif; ?>
                        </div>
                        <p class="distance-text">Lokasi : <?= $event['venue'] ?? ''; ?></p>
                        <p class="date-text"><?= $event['date']; ?> – <?= $event['time']; ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<div class="event-modal" id="eventModal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModal()">&times;</span>
        <div class="modal-body">
            <div class="modal-image">
                <img id="modalImage" src="" alt="Event Image">
            </div>
            <div class="modal-details">
                <div class="modal-header">
                    <h2 id="modalVenue"></h2>
                    <div class="rating-wrapper">
                        <span class="rating" id="modalRating"></span>
                    </div>
                </div>
                <div class="modal-info">
                    <p class="distance" id="modalDistance"></p>
                    <p class="schedule" id="modalSchedule"></p>
                    <p class="topic" id="modalTopic"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TOURISM SECTION -->
<div class="container mt-5">
<h2 class="text-center">Destinasi Wisata</h2>
<p class="text-center">Tana Toraja memiliki kekayaan alam yang memukau, seperti pegunungan, lembah hijau, dan pemandangan sawah yang indah, serta budaya yang kaya akan nilai-nilai tradisional dan ritual unik. Semua ini menjadikannya salah satu daya tarik utama bagi wisatawan yang ingin menikmati keindahan alam sekaligus mendalami kearifan lokal dan tradisi masyarakat setempat.</p>
    <div class="row">
        <?php 
        $count = 0;
        while($tour = mysqli_fetch_assoc($tourSQL)): 
            if($count >= 3) break;
            $count++;
        ?>
            <div class="col-md-4">
                <a href="tour.php?tour=<?= $tour['id']; ?>" class="text-decoration-none">
                    <div class="card mb-4 shadow-sm accommodation-card">
                        <div class="image-wrapper">
                            <img src="<?= $tour['photo']; ?>" class="card-img-top" alt="<?= $tour['title']; ?>">
                            <button class="favorite-btn" onclick="event.stopPropagation(); event.preventDefault();">
                                <i class="far fa-heart"></i>
                            </button>
                            <?php if(isset($tour['is_featured']) && $tour['is_featured']): ?>
                                <span class="guest-favorite">Guest favorite</span>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <div class="location-wrapper">
                                <h5 class="location-title"><?= $tour['title']; ?></h5>
                                <?php if(isset($tour['rating'])): ?>
                                    <span class="rating">★ <?= $tour['rating']; ?></span>
                                <?php endif; ?>
                            </div>
                            <p class="accommodation-count">
                                <i class="fas fa-building"></i> 
                                <?= isset($tour['accommodations']) ? $tour['accommodations'] . ' akomodasi' : 'NaN akomodasi'; ?>
                            </p>
                            <p class="card-text"><?= substr($tour['details'], 0, 100); ?>...</p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endwhile; ?>
    </div>
    <a href="tourism.php" class="view-more-btn">Lihat Semua Destinasi</a>
</div>

<!-- Rooms Section -->
<section class="py-5">
    <div class="container">
    <h2 class="text-center">Penginapan</h2>
    <p class="text-center">Tana Toraja menawarkan beragam pilihan penginapan, mulai dari hotel berbintang dengan fasilitas lengkap hingga homestay tradisional yang memberikan pengalaman menginap lebih dekat dengan kehidupan dan budaya lokal. Pilihan ini memudahkan wisatawan untuk menikmati keindahan alam Toraja dengan kenyamanan sesuai preferensi mereka.</p>
        <div class="row">
            <?php 
            $count = 0;
            while($room = mysqli_fetch_assoc($sql)): 
                if($count >= 3) break;
                $count++;
            ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="details.php?room=<?= $room['id']; ?>" class="text-decoration-none">
                        <div class="card mb-4 shadow-sm accommodation-card">
                            <div class="image-wrapper">
                                <img src="<?= $room['photo']; ?>" class="card-img-top" alt="Room <?= $room['room_number']; ?>">
                                <button class="favorite-btn" onclick="event.stopPropagation(); event.preventDefault();">
                                    <i class="far fa-heart"></i>
                                </button>
                                <?php if(isset($room['is_featured']) && $room['is_featured']): ?>
                                    <span class="guest-favorite">Guest favorite</span>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <div class="location-wrapper">
                                    <h5 class="location-title">Room <?= $room['room_number']; ?></h5>
                                    <?php if(isset($room['rating'])): ?>
                                        <span class="rating">★ <?= $room['rating']; ?></span>
                                    <?php endif; ?>
                                </div>
                                <p class="accommodation-count">
                                    <i class="fas fa-bed"></i> 
                                    <?php if(isset($room['capacity'])): ?>
                                        <?= $room['capacity']; ?> Orang
                                    <?php endif; ?>
                                </p>
                                <p class="card-text"><?= substr($room['details'], 0, 100); ?>...</p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
        <a href="rooms.php" class="view-more-btn">Lihat Semua Penginapan</a>
    </div>
</section>

<!-- Footer -->
<footer style="background-color: #222222; color: white; padding: 60px 0; font-family: system-ui, -apple-system, sans-serif;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px;">
        <div>
            <h4 style="font-size: 24px; margin: 0 0 20px 0; font-weight: 500;">Tentang Kita</h4>
            <p style="line-height: 1.6; margin: 0; opacity: 0.9;">
                Rasakan keindahan dan budaya Toraja dengan tur berpemandu ahli kami. Kami memberikan petualangan yang tak terlupakan dan pengalaman lokal yang otentik.</p>
        </div>
        <div>
            <h4 style="font-size: 24px; margin: 0 0 20px 0; font-weight: 500;">Kontak Kami</h4>
            <p style="margin: 0 0 15px 0; display: flex; align-items: center; gap: 10px;">
                <span style="color: white;">+62 821 3387 1850</span>
            </p>
            <p style="margin: 0 0 15px 0;">
                <span style="color: white;">info@torajatours.com</span>
            </p>
            <p style="margin: 0;">
                <span style="color: white;">Toraja, Sulawesi Selatan, Indonesia</span>
            </p>
        </div>
        <div>
            <h4 style="font-size: 24px; margin: 0 0 20px 0; font-weight: 500;">Follow Us</h4>
            <div style="display: flex; gap: 15px;">
                <a href="#" style="color: white; text-decoration: none;">
                    <i class="fab fa-facebook" style="font-size: 20px;"></i>
                </a>
                <a href="#" style="color: white; text-decoration: none;">
                    <i class="fab fa-instagram" style="font-size: 20px;"></i>
                </a>
                <a href="#" style="color: white; text-decoration: none;">
                    <i class="fab fa-twitter" style="font-size: 20px;"></i>
                </a>
                <a href="#" style="color: white; text-decoration: none;">
                    <i class="fab fa-youtube" style="font-size: 20px;"></i>
                </a>
            </div>
        </div>
    </div>
    <div style="text-align: center; margin-top: 40px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.1);">
        <p style="margin: 0; opacity: 0.7; font-size: 14px;">&copy; Wisata Toraja 2024. Semua hak dilindungi undang-undang.</p>
    </div>
</footer>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/popper/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
<script src="js/indexcard.js"></script>
<script src="js/eventindex.js"></script>
<script src="headerindex.js"></script>
<script>
        // Enhanced Modal Functionality
        function openModal(card) {
            const modal = document.getElementById('eventModal');
            const eventData = JSON.parse(card.dataset.event);
            
            // Populate modal content
            document.getElementById('modalImage').src = eventData.image;
            document.getElementById('modalVenue').textContent = eventData.venue;
            document.getElementById('modalRating').textContent = eventData.rating ? `★ ${eventData.rating}` : '';
            document.getElementById('modalSchedule').textContent = `${eventData.date} - ${eventData.time}`;
            document.getElementById('modalTopic').textContent = eventData.event_topic;
            
            // Show modal with animation
            modal.style.display = 'block';
            setTimeout(() => modal.classList.add('active'), 10);
            
            // Prevent body scroll
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('eventModal');
            modal.classList.remove('active');
            setTimeout(() => {
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }, 300);
        }

        // Enhanced Scroll Animation
        function revealOnScroll() {
            const elements = document.querySelectorAll('.accommodation-card');
            elements.forEach((element, index) => {
                const rect = element.getBoundingClientRect();
                const isVisible = rect.top < window.innerHeight - 100;
                
                if (isVisible) {
                    setTimeout(() => {
                        element.style.opacity = '1';
                        element.style.transform = 'translateY(0)';
                    }, index * 100);
                }
            });
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Set initial state for cards
            document.querySelectorAll('.accommodation-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(50px)';
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            });

            // Trigger initial reveal
            revealOnScroll();

            // Add scroll listener
            window.addEventListener('scroll', revealOnScroll);
        });
    </script>
</body>
</html>

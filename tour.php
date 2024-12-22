<?php
require_once 'core/core.php';
include 'includes/header.php';
include 'includes/navigation.php';

if(isset($_GET['tour'])) {
  $tourID = $_GET['tour'];
  $select = $db->query("SELECT * FROM tourism WHERE id = '{$tourID}' ");
  $s = $db->query("SELECT * FROM tourism WHERE id = '{$tourID}' ");
  $data = mysqli_fetch_assoc($s);

if(isset($_POST['reserve'])) {
  if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['people']) && isset($_POST['number'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $people = $_POST['people'];
        $phone = $_POST['number'];

      $save = $db->query("INSERT INTO tour_reserves (tour_id,reservations,cus_name,`email`,`phone`)
                            VALUES ('$tourID','$people','$name','$email','$phone')");

      if($save){
        $newReservations = $data['reservations'] - $people;
        $update = $db->query("UPDATE tourism SET reservations = '$newReservations' WHERE id = '$tourID' ");
        
        // Set session for success message
        $_SESSION['booking_success'] = true;
      }
    
  } else {
    echo 'All fields are required!';
  }
}

} elseif(!(isset($_GET['tour'])) || $_GET['tour']=='') {
  header("Location: tourism.php");
}
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
.tour-container {
    padding: 2rem 0;
}

.gallery-section {
    padding: 2rem 0;
    max-width: 1200px;
    margin: 0 auto;
}

.gallery-grid {
    display: flex;
    flex-direction: column;
    gap: 15px; /* Mengurangi gap antar elemen */
}

/* Main image section */
.gallery-main {
    height: 400px; /* Mengurangi tinggi gambar utama */
}

/* Middle and bottom sections */
.gallery-row {
    display: flex;
    gap: 15px; /* Mengurangi gap antar elemen */
    height: 200px; /* Mengurangi tinggi baris gambar */
}

.gallery-row .gallery-image {
    flex: 1;
    height: 100%;
}

.gallery-image {
    position: relative;
    overflow: hidden;
    border-radius: 10px; /* Memperkecil radius sudut */
    box-shadow: 0 3px 10px rgba(0,0,0,0.1); /* Mengurangi bayangan */
    cursor: pointer;
    transition: all 0.4s ease;
}

.gallery-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease-in-out;
}

.gallery-image .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.3);
    opacity: 0;
    transition: opacity 0.4s ease;
}

.gallery-image.active {
    transform: scale(1.05);
    z-index: 10;
}

.gallery-image.active img {
    transform: scale(1.1);
}

.gallery-image.active .overlay {
    opacity: 1;
}

@media (max-width: 768px) {
    .gallery-main {
        height: 250px; /* Mengurangi tinggi gambar utama pada layar kecil */
    }
    
    .gallery-row {
        flex-direction: column;
        height: auto;
    }
    
    .gallery-row .gallery-image {
        height: 150px; /* Mengurangi tinggi gambar pada layar kecil */
    }
}


.tour-details {
    background-color: #f8f9fa;
    padding: 3rem 0;
    margin-bottom: 3rem;
}

.detail-card {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
}

.price-tag {
    background: #007bff;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    display: inline-block;
    margin: 1rem 0;
}

.booking-section {
    background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)),
                url('<?php echo $data['photo']; ?>') center/cover;
    padding: 4rem 0;
    color: white;
}

.booking-form {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.2);
}

.form-control {
    border-radius: 25px;
    padding: 0.8rem 1.2rem;
    margin-bottom: 1rem;
}

.btn-book {
    border-radius: 25px;
    padding: 0.8rem 2rem;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.map-container {
    margin: 3rem 0;
}

.map-container iframe {
    width: 100%;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.footer {
    background: #333;
    color: white;
    padding: 3rem 0;
    margin-top: 4rem;
}

.social-icons a {
    color: white;
    margin: 0 10px;
    font-size: 1.5rem;
    transition: color 0.3s ease;
}

.social-icons a:hover {
    color: #007bff;
}

.success-popup {
    display: none;
    position: fixed;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0,0,0,0.2);
    z-index: 1000;
    text-align: center;
}

.popup-backdrop {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 999;
}

.success-popup h3 {
    color: #28a745;
    margin-bottom: 15px;
}

.success-popup .btn-payment {
    background: #28a745;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    margin-top: 10px;
}

.success-popup .btn-payment:hover {
    background: #218838;
}

</style>

<div class="tour-container">
    <?php while($tour = mysqli_fetch_assoc($select)): ?>
    <div class="container">
        <h1 class="text-center mb-4"><?= $tour['title']; ?></h1>
        
        <!-- Gallery Section -->
        <div class="gallery-section">
          <div class="gallery-grid">
        <!-- Main large image -->
        <div class="gallery-image gallery-main">
            <img src="<?= $tour['photo']; ?>" alt="Main Tour Image">
            <div class="overlay"></div>
        </div>
        
        <!-- Middle row with 2 images -->
        <div class="gallery-row">
            <div class="gallery-image">
                <img src="<?= $tour['photo1']; ?>" alt="Tour Image 1">
                <div class="overlay"></div>
            </div>
            <div class="gallery-image">
                <img src="<?= $tour['photo2']; ?>" alt="Tour Image 2">
                <div class="overlay"></div>
            </div>
        </div>
        
        <!-- Bottom row with 2 images -->
        <div class="gallery-row">
            <div class="gallery-image">
                <img src="<?= $tour['photo3']; ?>" alt="Tour Image 3">
                <div class="overlay"></div>
            </div>
            <div class="gallery-image">
                <img src="<?= $tour['photo4']; ?>" alt="Tour Image 4">
                <div class="overlay"></div>
            </div>
        </div>
    </div>
</div>

        <!-- Tour Details -->
        <div class="tour-details">
            <div class="container">
                <div class="detail-card">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>Tour Overview</h3>
                            <div class="price-tag">
                                <i class="fas fa-tag"></i> Rp.<?= number_format($tour['price'], 0, ',', '.'); ?>
                            </div>
                            <p><i class="fas fa-map-marker-alt text-primary"></i> <?= $tour['location']; ?></p>
                            <p><?= $tour['details']; ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4>Quick Facts</h4>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-users text-primary"></i> Available Slots: <?= $tour['reservations']; ?></li>
                                <li><i class="fas fa-clock text-primary"></i> Duration: Full Day</li>
                                <li><i class="fas fa-language text-primary"></i> Languages: English, Indonesian</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="detail-card">
                    <h3>Tour Description</h3>
                    <p><?= $tour['details2']; ?></p>
                </div>
            </div>
        </div>

        <!-- Booking Section -->
        <div class="booking-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="booking-form">
                            <h3 class="text-center text-dark mb-4">Book Your Tour</h3>
                            <?php if($tour['reservations'] > 0): ?>
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" name="people" class="form-control" placeholder="Number of People" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="number" class="form-control" placeholder="Contact Number" required>
                                    </div>
                                </div>
                                <button type="submit" name="reserve" class="btn btn-primary btn-block btn-book mt-3">Book Now</button>
                            </form>
                            <?php else: ?>
                            <div class="text-center text-danger">
                                <h4>Reservations are currently closed for this tour</h4>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d50782.05403468191!2d119.8630!3d-2.9726!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMsKwNTcnMTQuNiJOIDEyOcKwNTUnNTcuNCJ9!5e0!3m2!1sen!2sid!4v1633679151718" height="450" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
    <?php endwhile; ?>
</div>

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

<div class="popup-backdrop" id="popupBackdrop"></div>
<div class="success-popup" id="successPopup">
    <h3><i class="fas fa-check-circle"></i> Booking Successful!</h3>
    <p>Thank you for your booking. Please proceed to payment page.</p>
    <a href="payment.php" class="btn-payment">Go to Payment</a>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Check if success message exists in PHP session
    <?php if(isset($_SESSION['booking_success']) && $_SESSION['booking_success']): ?>
        document.getElementById('popupBackdrop').style.display = 'block';
        document.getElementById('successPopup').style.display = 'block';
        
        // Clear the session
        <?php unset($_SESSION['booking_success']); ?>
    <?php endif; ?>

    // Add smooth scrolling to all links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Form validation (your existing code)
    const form = document.querySelector('form');
    if(form) {
        form.addEventListener('submit', function(e) {
            const inputs = form.querySelectorAll('input[required]');
            inputs.forEach(input => {
                if(!input.value) {
                    e.preventDefault();
                    input.classList.add('is-invalid');
                } else {
                    input.classList.remove('is-invalid');
                }
            });
        });
    }

    // Image hover effect (your existing code)
    const images = document.querySelectorAll('.gallery-image img');
    images.forEach(img => {
        img.addEventListener('mouseover', function() {
            this.style.transform = 'scale(1.05)';
        });
        img.addEventListener('mouseout', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Close popup when clicking outside
    document.getElementById('popupBackdrop').addEventListener('click', function() {
        this.style.display = 'none';
        document.getElementById('successPopup').style.display = 'none';
    });
});
</script>

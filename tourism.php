<?php
require_once 'core/core.php';
include 'includes/header.php';
include 'includes/navigation.php';

$sql = $db->query("SELECT * FROM tourism");

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
.container {
    padding: 40px 15px;
}

.page-title {
    text-align: center;
    margin-bottom: 50px;
}

.page-title h1 {
    color: #2c3e50;
    font-size: 2.5rem;
    margin-bottom: 15px;
}

.page-title p {
    color: #7f8c8d;
    font-size: 1.1rem;
}

.tour-card-wrapper {
    margin-bottom: 30px;
}

.tour-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.tour-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.tour-card img {
    width: 100%;
    height: 220px;
    object-fit: cover;
}

.tour-card section {
    padding: 25px;
}

.tour-card h4 {
    color: #2c3e50;
    font-size: 1.3rem;
    margin-bottom: 15px;
}

.event-date {
    color: #e74c3c;
    font-weight: 600;
    margin-bottom: 12px;
    font-size: 0.95rem;
}

.event-date i {
    margin-right: 5px;
}

.location {
    color: #7f8c8d;
    margin-bottom: 15px;
    font-size: 0.9rem;
}

.location i {
    color: #e74c3c;
    margin-right: 5px;
}

.tour-card p {
    color: #34495e;
    line-height: 1.6;
    margin-bottom: 20px;
    font-size: 0.95rem;
}

.event-meta {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
    color: #7f8c8d;
    font-size: 0.9rem;
}

.event-meta span {
    display: flex;
    align-items: center;
}

.event-meta i {
    margin-right: 5px;
    color: #e74c3c;
}

.tour-card .btn {
    background-color: #e74c3c;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 6px;
    transition: background-color 0.3s ease;
    text-decoration: none;
    display: inline-block;
    width: 100%;
    text-align: center;
    font-weight: 500;
}

.tour-card .btn:hover {
    background-color: #c0392b;
}

.footer {
    background-color: #2c3e50;
    color: white;
    padding: 3rem 0;
    margin-top: 4rem;
}

.social-icons a {
    color: white;
    margin-right: 15px;
    font-size: 1.5rem;
    transition: color 0.3s ease;
}

.social-icons a:hover {
    color: #e74c3c;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.tour-card {
    animation: fadeIn 0.5s ease-out forwards;
}
</style>

<div class="container">
    <div class="page-title">
        <h1>Destinasi Wisata Budaya Toraja</h1>
        <p>Temukan dan rasakan keunikan budaya Toraja melalui rangkaian destinasi menarik</p>
    </div>
    
    <div class="row" id="tour-cards">
        <?php $count = 0; ?>
        <?php while ($tour = mysqli_fetch_assoc($sql)): ?>
            <div class="col-lg-4 col-md-6 col-sm-6 tour-card-wrapper">
                <div class="tour-card">
                    <img src="<?= $tour['photo']; ?>" class="img-responsive" alt="<?= $tour['title']; ?>">
                    <section>
                        <h4><?= $tour['title']; ?></h4>
                        <div class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Toraja, Indonesia</span>
                        </div>
                        <p class="text-justify">
                            <?= substr($tour['details'], 0, 150) . '...'; ?>
                        </p>
                        <div class="event-meta">
                            <span><i class="fas fa-ticket-alt"></i> Tersedia</span>
                        </div>
                        <a href="tour.php?tour=<?= $tour['id']; ?>" class="btn">Detail Wisata</a>
                    </section>
                </div>
            </div>
            <?php $count++; ?>
            <?php if ($count == 30) break; ?>
        <?php endwhile; ?>
    </div>

    <div id="more-cards" class="d-none">
        <?php while ($tour = mysqli_fetch_assoc($sql)): ?>
            <div class="col-lg-4 col-md-6 col-sm-6 tour-card-wrapper">
                <div class="tour-card">
                    <img src="<?= $tour['photo']; ?>" class="img-responsive" alt="<?= $tour['title']; ?>">
                    <section>
                        <h4><?= $tour['title']; ?></h4>
                        <div class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Toraja, Indonesia</span>
                        </div>
                        <p class="text-justify">
                            <?= substr($tour['details'], 0, 150) . '...'; ?>
                        </p>
                        <div class="event-meta">
                            <span><i class="fas fa-ticket-alt"></i> Tersedia</span>
                        </div>
                        <a href="tour.php?tour=<?= $tour['id']; ?>" class="btn">Detail Wisata</a>
                    </section>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<footer class="footer" style="background-color: #333; color: white; padding: 3rem 0; margin-top: 4rem;">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4>Tentang Kita</h4>
                <p>
                Rasakan keindahan dan budaya Toraja dengan tur berpemandu ahli kami. Kami memberikan petualangan yang tak terlupakan dan pengalaman lokal yang otentik.</p>
            </div>
            <div class="col-md-4">
                <h4>Kontak Kami</h4>
                <p><i class="fas fa-phone"></i> +62 821 3387 1850</p>
                <p><i class="fas fa-envelope"></i> info@torajatours.com</p>
                <p><i class="fas fa-map-marker-alt"></i> Toraja, Sulawesi Selatan, Indonesia</p>
            </div>
            <div class="col-md-4">
                <h4>Follow Us</h4>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <p>&copy; Wisata Toraja 2024. Semua hak dilindungi undang-undang.</p>
        </div>
    </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate cards on scroll
    const cards = document.querySelectorAll('.tour-card');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1
    });

    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.5s ease-out';
        observer.observe(card);
    });
});
</script>
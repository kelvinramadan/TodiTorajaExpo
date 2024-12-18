<?php
// reservation_success.php

// Memastikan data form diterima melalui POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form
    $fullname = htmlspecialchars($_POST['fullname']);
    $in_date = htmlspecialchars($_POST['in_date']);
    $out_date = htmlspecialchars($_POST['out_date']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $roomID = htmlspecialchars($_GET['room']); // Mengambil ID kamar dari query string
} else {
    // Jika halaman diakses langsung, redirect ke halaman form
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Berhasil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-success text-white text-center">
                <h2>Reservasi Berhasil!</h2>
            </div>
            <div class="card-body">
                <p class="lead">Reservasi Anda telah berhasil dilakukan. Berikut adalah detail pemesanan Anda:</p>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nama Lengkap:</strong> <?= $fullname ?></li>
                    <li class="list-group-item"><strong>Tanggal Check-in:</strong> <?= $in_date ?></li>
                    <li class="list-group-item"><strong>Tanggal Check-out:</strong> <?= $out_date ?></li>
                    <li class="list-group-item"><strong>Nomor Telepon:</strong> <?= $phone ?></li>
                    <li class="list-group-item"><strong>Email:</strong> <?= $email ?></li>
                    <li class="list-group-item"><strong>ID Kamar:</strong> <?= $roomID ?></li>
                </ul>
                <div class="text-center mt-4">
                    <a href="index.php" class="btn btn-primary">OK</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

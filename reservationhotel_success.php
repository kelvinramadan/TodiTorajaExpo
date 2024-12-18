<?php
// Ambil data dari POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $inDate = $_POST['in_date'];
    $outDate = $_POST['out_date'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $room = $_POST['room'];
    $totalPrice = $_POST['total_price'];
} else {
    // Redirect jika diakses tanpa data
    header("Location: rooms.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Sukses</title>
</head>
<body>
    <h1>Reservasi Berhasil!</h1>
    <p>Terima kasih telah melakukan reservasi, <?= htmlspecialchars($fullname); ?>.</p>
    <p><strong>Kamar:</strong> <?= htmlspecialchars($room); ?></p>
    <p><strong>Check-in:</strong> <?= htmlspecialchars($inDate); ?></p>
    <p><strong>Check-out:</strong> <?= htmlspecialchars($outDate); ?></p>
    <p><strong>Total Harga:</strong> Rp <?= number_format($totalPrice, 0, ',', '.'); ?></p>
    <p>Silakan hubungi kami di <?= htmlspecialchars($phone); ?> atau <?= htmlspecialchars($email); ?> jika ada pertanyaan.</p>
</body>
</html>

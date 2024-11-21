<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List Booking Hotel</title>
  <link rel="stylesheet" href="payment.css">
</head>
<body>
  <div class="container">
    <h1>List Booking Hotel</h1>
    <table>
      <thead>
        <tr>
          <th>No.</th>
          <th>Nama Hotel</th>
          <th>Tanggal Check-in</th>
          <th>Tanggal Check-out</th>
          <th>Status</th>
          <th>Biaya</th>
          <th>Pembayaran</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Hotel Jakarta</td>
          <td>2024-12-01</td>
          <td>2024-12-05</td>
          <td><span class="status booked">Booked</span></td>
          <td>Rp 2.000.000</td>
          <td><span class="payment-status paid">Sudah Dibayar</span></td>
        </tr>
        <tr>
          <td>2</td>
          <td>Hotel Bali</td>
          <td>2024-12-10</td>
          <td>2024-12-14</td>
          <td><span class="status confirmed">Confirmed</span></td>
          <td>Rp 3.500.000</td>
          <td><span class="payment-status paid">Sudah Dibayar</span></td>
        </tr>
        <tr>
          <td>3</td>
          <td>Hotel Surabaya</td>
          <td>2024-12-15</td>
          <td>2024-12-18</td>
          <td><span class="status pending">Pending</span></td>
          <td>Rp 1.800.000</td>
          <td>
            <button class="pay-button">Bayar Sekarang</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="payment-modal" id="paymentModal">
    <div class="modal-content">
      <h2>Konfirmasi Pembayaran</h2>
      <p>Apakah Anda yakin ingin membayar untuk pemesanan ini?</p>
      <button class="confirm-payment">Ya, Bayar</button>
      <button class="cancel-payment">Batal</button>
    </div>
  </div>

  <script>
    const payButton = document.querySelectorAll('.pay-button');
    const paymentModal = document.getElementById('paymentModal');
    const cancelPayment = document.querySelector('.cancel-payment');
    const confirmPayment = document.querySelector('.confirm-payment');

    payButton.forEach(button => {
      button.addEventListener('click', () => {
        paymentModal.style.display = 'block';
      });
    });

    cancelPayment.addEventListener('click', () => {
      paymentModal.style.display = 'none';
    });

    confirmPayment.addEventListener('click', () => {
      alert('Pembayaran berhasil! Terima kasih.');
      paymentModal.style.display = 'none';
    });
  </script>
</body>
</html>

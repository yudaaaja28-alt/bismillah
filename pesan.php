<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pesanan - CoffeeTime</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { overflow: auto !important; }
        /* CSS Khusus Halaman Pesan */
        .order-container {
            max-width: 500px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 8px; color: #333; }
        .form-group input {
            width: 100%; padding: 12px; border: 1px solid #ddd;
            border-radius: 12px; outline: none; font-size: 16px;
            background: #fff;
        }
        /* Style khusus untuk input tanggal agar terlihat premium */
        input[type="datetime-local"] {
            font-family: 'Poppins', sans-serif;
            color: #c67c4e;
            cursor: pointer;
        }
        .summary-box {
            background: #fdf5e6;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
        }
        .summary-item {
            display: flex; justify-content: space-between;
            margin-bottom: 10px; font-size: 14px;
        }
        .payment-grid {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-top: 10px;
        }
        .pay-option {
            border: 2px solid #eee; padding: 10px; border-radius: 12px;
            text-align: center; cursor: pointer; transition: 0.3s;
        }
        .pay-option input { display: none; }
        .pay-option:has(input:checked) { border-color: #c67c4e; background: #c67c4e; color: white; }
    </style>
</head>
<body class="pesan-page">
     <nav class="navbar">
        <div class="logo" onclick="window.location.href='index.php'" style="cursor:pointer;">
            ← <span>Kembali</span>
        </div>
    </nav>

    <form action="proses-pesan.php" method="POST">
    <div class="order-container">
        <h2 style="margin-bottom: 25px;">Detail Pesanan ✨</h2>

        <div class="form-group">
            <label>Tanggal & Waktu Pesanan</label>
            <input type="datetime-local" id="order-time">
        </div>

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" id="cust-name" placeholder="Siapa nama Anda?">
        </div>

        <div class="form-group">
            <label>Nomor Meja</label>
            <input type="number" id="table-num" placeholder="Nomor meja Anda">
        </div>

        <div class="summary-box">
            <h4 style="color:#c67c4e; margin-bottom:15px;">Ringkasan Kopi</h4>
            <div id="summary-list"></div>
            <hr style="margin: 15px 0; border: 0; border-top: 1px dashed #ccc;">
            <div style="display:flex; justify-content:space-between; font-weight:bold; font-size:18px;">
                <span>Total</span>
                <span id="summary-total">$0.00</span>
            </div>
        </div>

        <label style="font-weight:bold;">Metode Pembayaran</label>
        <div class="payment-grid">
            <label class="pay-option">
                <input type="radio" name="pay" value="Tunai" checked>
                <span>💵 Tunai</span>
            </label>
            <label class="pay-option">
                <input type="radio" name="pay" value="QRIS">
                <span>📱 QRIS</span>
            </label>
            <label class="pay-option">
                <input type="radio" name="pay" value="Debit">
                <span>💳 Debit</span>
            </label>
        </div>

        <input type="hidden" id="cart-data" name="cart_data">
        <input type="hidden" id="total-amount" name="total_amount">

        <button class="btn-hero" onclick="finishOrder()" style="width:100%; margin-top:30px;">
            Konfirmasi & Bayar
        </button>
    </div>
    </form>

    <script src="script.js"></script>
</body>
</html>

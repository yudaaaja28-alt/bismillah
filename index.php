<?php
include ("config.php");

// Ambil data menu dari database bismillah, tabel menu
$sql = "SELECT * FROM menu";
$query = mysqli_query($db, $sql);
$menus = [];
while ($row = mysqli_fetch_assoc($query)) {
    $menus[] = $row;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoffeeTime - Order System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="web-container">
        <section class="screen active" id="welcome-screen">
            <div class="hero-content">
                <h1>Find your cup of coffee here</h1>
                <p>The best grain, the finest roast, the most powerful flavor.</p>
                <button class="btn-hero" onclick="goTo('home-screen')">Order Here</button>
            </div>
        </section>

        <section class="screen" id="home-screen">
            <nav class="navbar">
                <div class="logo">Jenaka<span>Coffee</span></div>
                <div class="nav-right">
                    <div class="nav-links">
                        <span onclick="goTo('welcome-screen')">Home</span>
                        <span class="active">Menu</span>
                    </div>
                    <button class="cart-btn" onclick="toggleCart()">
                        🛒 <span id="cart-count">0</span>
                    </button>
                </div>
            </nav>

            <main class="main-content">
                <header class="content-header">
                    <div class="welcome-text">
                        <h2>Welcome ✨</h2>
                        <p>What would you like to drink today?</p>
                    </div>
                    <input type="text" class="search-box" placeholder="Search your favorite coffee...">
                    <div class="tabs">
                        <button class="tab active">All products</button>
                        <button class="tab">Top picks</button>
                        <button class="tab">Favorites</button>
                    </div>
                </header>

                <div class="menu-grid">
                    <?php
                    $images = [
                        'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxQGcmq1BeHCWkbKZ1JyFI-1yalThu9NrrSg&s',
                        'https://www.cleaneatingkitchen.com/wp-content/uploads/2022/07/espresso-americano-over-ice-with-straw.jpg',
                        'https://radarmukomuko.bacakoran.co/upload/d6d99f8abba13f78e353619c643fc2f1.jpg',
                        'https://img-global.cpcdn.com/steps/62d90b9d6966342e/400x400cq80/photo.jpg',
                        'https://sprudge.com/wp-content/uploads/2016/04/Sprudge-ObjetoEncontrado-JulianaGanan-Sprudge-ObjetoEncontrado-JulianaGanan-BSB_Coffee_Shops_Guide_objeto_latte_art_Lucas_Hamu_01.jpg',
                        'https://images.ctfassets.net/v601h1fyjgba/2L61TpcCFqcNMOtgXklc4s/732a70a58d6dfc25e24378c67900ed16/15697_Keurig_CafeCreations_Salted_Caramel_Latte_Hi.jpg',
                        'https://www.shutterstock.com/image-photo/iced-hazelnut-coffee-latte-topped-260nw-1037594023.jpg',
                        'https://lh7-rt.googleusercontent.com/docsz/AD_4nXdgiLqHY8C6Pap6devV2rJocOuX7Z4HDBMWb_52m0de0795CvBZj-3NN4ry_nIxFEZuJSifurnogNQeUhwhoaAff7YsDy2UL5UcqFli4TS_z0SV1N4p68mZqUTzhUDqgmWPDs24fA?key=8cHwu4uNXVYTBksJTj66fbpX',
                        'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQPS3ZzFw5T4I2i4cB1vzyR4eenkghJ7v6uWw&s',
                        'https://www.citymarket.com/content/v2/binary/image/vanilla.png',
                    ];
                    foreach ($menus as $index => $menu) {
                        $image = $images[$index] ?? $images[0];
                        echo '<div class="coffee-card">';
                        echo '<div class="card-img" style="background-image: url(\'' . $image . '\');">';
                        echo '<button class="plus-btn" onclick="addToCart(\'' . htmlspecialchars($menu['menu']) . '\', ' . $menu['harga'] . ', this)">+</button>';
                        echo '</div>';
                        echo '<div class="card-info">';
                        echo '<h4>' . htmlspecialchars($menu['menu']) . '</h4>';
                        echo '<p class="price">Rp' . number_format($menu['harga'], 2, ',', '.') . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </main>

            <div id="cart-sidebar" class="sidebar">
                <div class="sidebar-header">
                    <h3>My Cart</h3>
                    <button class="close-btn" onclick="toggleCart()">✕</button>
                </div>
                <div id="cart-items" class="sidebar-body"></div>
                <div class="sidebar-footer">
                    <div class="total">
                        <span>Total:</span>
                        <span id="cart-total"></span>
                    </div>
                    <div class="footer-buttons">
                        <button class="cancel-btn" onclick="clearCart()">Batal Pesan</button>
                        <button class="checkout-btn" onclick="checkout()">Pesan Sekarang</button>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="script.js"></script>
</body>
</html>

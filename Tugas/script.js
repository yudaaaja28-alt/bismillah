let cart = JSON.parse(localStorage.getItem('coffeeCart')) || [];

function goTo(screenId) {
    document.querySelectorAll('.screen').forEach(s => s.classList.remove('active'));
    document.getElementById(screenId).classList.add('active');
}

function toggleCart() {
    document.getElementById('cart-sidebar').classList.toggle('open');
}

function addToCart(name, price, element) {
    cart.push({ id: Date.now(), name, price });
    localStorage.setItem('coffeeCart', JSON.stringify(cart));

    // EFEK BERGERAK PADA TOMBOL +
    element.classList.add('clicked');
    element.innerText = "✓";

    setTimeout(() => {
        element.classList.remove('clicked');
        element.innerText = "+";
    }, 600);

    updateUI();

    // Getarkan tombol keranjang
    const cartBtn = document.querySelector('.cart-btn');
    cartBtn.style.transform = "scale(1.2) rotate(-10deg)";
    setTimeout(() => cartBtn.style.transform = "scale(1)", 200);

    if(!document.getElementById('cart-sidebar').classList.contains('open')) {
        setTimeout(toggleCart, 400);
    }
}

function clearCart() {
    if(confirm("Batalkan semua pesanan?")) {
        cart = [];
        localStorage.setItem('coffeeCart', JSON.stringify(cart));
        updateUI();
        toggleCart();
    }
}

function updateUI() {
    const list = document.getElementById('cart-items');
    const totalEl = document.getElementById('cart-total');
    const countEl = document.getElementById('cart-count');

    list.innerHTML = "";
    let total = 0;

    cart.forEach(item => {
        total += item.price;
        list.innerHTML += `
            <div style="display:flex; justify-content:space-between; padding:15px 0; border-bottom:1px dashed #eee;">
                <span>${item.name}</span>
                <strong>Rp${item.price.toLocaleString('id-ID')}</strong>
            </div>
        `;
    });

    countEl.innerText = cart.length;
    totalEl.innerText = `Rp${total.toLocaleString('id-ID')}`;
}

function checkout() {
    let total = 0;
    cart.forEach(item => {
        total += item.price;
    });
    window.location.href = `pesan.php?total=${total}`;
}


       function setCurrentTime() {
            const now = new Date();
            // Format ke YYYY-MM-DDTHH:mm sesuai standar input datetime-local
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            
            const formattedDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;
            document.getElementById('order-time').value = formattedDateTime;
        }
        
        // Jalankan fungsi saat loading
        setCurrentTime();

        // Ambil data dari LocalStorage
        const savedCart = cart;
        const listDiv = document.getElementById('summary-list');
        const totalEl = document.getElementById('summary-total');
        const cartDataInput = document.getElementById('cart-data');
        const totalAmountInput = document.getElementById('total-amount');

        // Get total from URL parameter if available
        const urlParams = new URLSearchParams(window.location.search);
        const urlTotal = parseFloat(urlParams.get('total')) || 0;

        let total = 0;
        savedCart.forEach(item => {
            total += item.price;
            listDiv.innerHTML += `
                <div class="summary-item">
                    <span>${item.name}</span>
                    <strong>Rp${item.price.toLocaleString('id-ID')}</strong>
                </div>
            `;
        });
        totalEl.innerText = `Rp${total.toLocaleString('id-ID')}`;

        // Set hidden inputs
        cartDataInput.value = JSON.stringify(savedCart);
        totalAmountInput.value = total;

        function finishOrder() {
            const name = document.getElementById('cust-name').value;
            const table = document.getElementById('table-num').value;
            const time = document.getElementById('order-time').value; // Ambil nilai dari input tanggal
            const pay = document.querySelector('input[name="pay"]:checked').value;

            if(!name || !table) {
                alert("Harap lengkapi Nama dan Nomor Meja!");
                return;
            }

            // Rapikan format waktu untuk ditampilkan di alert
            const formattedTime = time.replace('T', ' ');

            alert(`Pesanan Berhasil!\n\nWaktu: ${formattedTime}\nNama: ${name}\nMeja: ${table}\nMetode: ${pay}\nTotal: Rp${total.toLocaleString('id-ID')}`);
            
            localStorage.removeItem('coffeeCart');
            window.location.href = 'index.html';
        }
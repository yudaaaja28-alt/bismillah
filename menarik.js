function showPayment(name, price) {
    const modal = document.getElementById('paymentModal');
    const detail = document.getElementById('paymentDetail');
    
    // Format Rupiah
    const priceIDR = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(price);

    detail.innerHTML = `ORDER: ${name} - ${priceIDR}`;
    
    modal.style.display = 'block';
}

function closePayment() {
    const modal = document.getElementById('paymentModal');
    modal.style.display = 'none';
}

// Tutup jika klik di luar kotak
window.onclick = function(event) {
    const modal = document.getElementById('paymentModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
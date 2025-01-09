const cartTrigger = document.getElementById("cartTrigger"),
    sidebarCart = document.getElementById("sidebarCart"),
    closeCart = document.getElementById("closeCart");

// Fungsi untuk membuka sidebar
cartTrigger.addEventListener("click", (e) => {
    cartTrigger.classList.toggle("cart-active");
    sidebarCart.classList.add("sidebar-active");
    e.stopPropagation(); // Mencegah event bubbling agar tidak menutup langsung saat sidebar dibuka
});

// Fungsi untuk menutup sidebar
closeCart.addEventListener("click", () => {
    cartTrigger.classList.remove("cart-active");
    sidebarCart.classList.remove("sidebar-active");
});

// Menutup sidebar jika klik di luar sidebar
document.addEventListener("click", (e) => {
    if (!sidebarCart.contains(e.target) && !cartTrigger.contains(e.target)) {
        cartTrigger.classList.remove("cart-active");
        sidebarCart.classList.remove("sidebar-active");
    }
});

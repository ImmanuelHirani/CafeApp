const triggermenuMobile = document.getElementById("triggermenuMobile"),
    closecartMobile = document.getElementById("closecartMobile"),
    addtoCartMobile = document.getElementById("addtoCartMobile");

triggermenuMobile.addEventListener("click", () => {
    addtoCartMobile.classList.add("cart-mobile-menu-active");
});

closecartMobile.addEventListener("click", () => {
    addtoCartMobile.classList.remove("cart-mobile-menu-active");
});

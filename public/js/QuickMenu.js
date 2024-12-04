const triggermenuopen = document.querySelectorAll(".trigger-menu-open"),
    cartquickMenu = document.getElementById("cartquickMenu"),
    closequickCart = document.getElementById("closequickCart");

triggermenuopen.forEach((triggerMenu) => {
    triggerMenu.addEventListener("click", () => {
        cartquickMenu.classList.add("quick-menu-active");
    });
});

closequickCart.addEventListener("click", () => {
    cartquickMenu.classList.remove("quick-menu-active");
});

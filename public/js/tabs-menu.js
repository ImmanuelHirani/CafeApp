const toggleTabs = document.querySelectorAll(".tabs-toggle-product");
const tabsContent = document.querySelectorAll(".tabs-content-product");

function showTab(index) {
    // Memastikan index tetap dalam range yang valid
    if (index < 0) {
        index = toggleTabs.length - 1; // Wrap ke tab terakhir
    } else if (index >= toggleTabs.length) {
        index = 0; // Wrap ke tab pertama
    }

    tabsContent.forEach((content, contentIndex) => {
        if (contentIndex === index) {
            content.classList.remove("hidden");
        } else {
            content.classList.add("hidden");
        }
    });

    toggleTabs.forEach((tab, tabIndex) => {
        if (tabIndex === index) {
            tab.classList.add("tab-active-product");
        } else {
            tab.classList.remove("tab-active-product");
        }
    });

    // Menyimpan tab yang aktif ke localStorage
    localStorage.setItem("selectedTab", index);
}

// Memuat tab terakhir yang dipilih
const lastSelectedTab = localStorage.getItem("selectedTab");
if (lastSelectedTab !== null) {
    showTab(parseInt(lastSelectedTab));
} else {
    showTab(0);
}

// Event listener untuk klik tab
toggleTabs.forEach((tab, index) => {
    tab.addEventListener("click", () => {
        showTab(index);
    });
});

// Event listener untuk keyboard

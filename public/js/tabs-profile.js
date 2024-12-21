const sideMenuToggleTabs = document.querySelectorAll(".sideMenu-tabs-toggle");
const sideMenuTabsContent = document.querySelectorAll(".sideMenu-tabs-content");

function showSideMenuTab(index) {
    // Ensure the index is within a valid range
    if (index < 0) {
        index = sideMenuToggleTabs.length - 1; // Wrap to the last tab
    } else if (index >= sideMenuToggleTabs.length) {
        index = 0; // Wrap to the first tab
    }

    sideMenuTabsContent.forEach((content, contentIndex) => {
        if (contentIndex === index) {
            content.classList.remove("hidden");
        } else {
            content.classList.add("hidden");
        }
    });

    sideMenuToggleTabs.forEach((tab, tabIndex) => {
        if (tabIndex === index) {
            tab.classList.add("tab-active-profile");
        } else {
            tab.classList.remove("tab-active-profile");
        }
    });

    // Save the active tab to localStorage with a unique key
    localStorage.setItem("sideMenuSelectedTab", index);
}

// Load the last selected tab
const lastSelectedSideMenuTab = localStorage.getItem("sideMenuSelectedTab");
if (lastSelectedSideMenuTab !== null) {
    showSideMenuTab(parseInt(lastSelectedSideMenuTab));
} else {
    showSideMenuTab(0);
}

// Event listener for tab clicks
sideMenuToggleTabs.forEach((tab, index) => {
    tab.addEventListener("click", () => {
        showSideMenuTab(index);
    });
});

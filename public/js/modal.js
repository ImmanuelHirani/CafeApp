const modal = document.getElementById("modal-add-product");
const toggle = document.getElementById("btn-add-product");
const toggleClose = document.getElementById("close-btn");

// Add event listeners
toggle.addEventListener("click", () => {
    modal.showModal();
    document.body.classList.add("overflow-hidden");
});

toggleClose.addEventListener("click", () => {
    modal.close();
    document.body.classList.remove("overflow-hidden");
});

// Add event listener for clicks outside the modal to close it
modal.addEventListener("click", (event) => {
    if (event.target === modal) {
        modal.close();
        document.body.classList.remove("overflow-hidden");
    }
});

// The previous condition was not working correctly because it would only run once
// Instead, you can use the dialog's 'open' event
modal.addEventListener("open", () => {
    document.body.classList.add("overflow-hidden");
});

modal.addEventListener("close", () => {
    document.body.classList.remove("overflow-hidden");
});

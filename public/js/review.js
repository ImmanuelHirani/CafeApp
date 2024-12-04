const reviewTrigger = document.getElementById("reviewTrigger"),
    reviewBox = document.getElementById("reviewBox"),
    closeReviwe = document.getElementById("closeReviwe");

reviewTrigger.addEventListener("click", () => {
    reviewTrigger.classList.add("trigger-active-review");
    reviewBox.classList.add("box-active-review");
});

closeReviwe.addEventListener("click", () => {
    reviewTrigger.classList.remove("trigger-active-review");
    reviewBox.classList.remove("box-active-review");
});

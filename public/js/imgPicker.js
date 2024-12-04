const fileInputs = document.querySelectorAll(".file-img-product");
const imgPreviews = document.querySelectorAll(".img-preview");
const errorMessages = document.querySelectorAll(".error-message");

fileInputs.forEach((fileInput, index) => {
    fileInput.addEventListener("change", (event) => {
        const file = event.target.files[0];
        const imgPreview = imgPreviews[index];
        const errorMessage = errorMessages[index];

        if (file) {
            // Cek tipe file
            const validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
            if (!validImageTypes.includes(file.type)) {
                // Jika file bukan gambar, tampilkan pesan error
                errorMessage.classList.remove("hidden");
                fileInput.value = ""; // Reset input file
                imgPreview.src =
                    "https://salonlfc.com/wp-content/uploads/2018/01/image-not-found-1-scaled.png"; // Gambar pengganti
            } else {
                // Jika file gambar, sembunyikan pesan error dan tampilkan preview
                errorMessage.classList.add("hidden");
                const reader = new FileReader();
                reader.onload = (e) => {
                    imgPreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        } else {
            // Jika tidak ada file, set gambar preview ke gambar pengganti
            imgPreview.src =
                "https://salonlfc.com/wp-content/uploads/2018/01/image-not-found-1-scaled.png";
        }
    });
});

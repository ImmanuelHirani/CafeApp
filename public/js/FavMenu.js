document.addEventListener("DOMContentLoaded", () => {
    // Seleksi semua tombol dengan atribut data-menu-id
    const favoriteButtons = document.querySelectorAll("button[data-menu-id]");

    favoriteButtons.forEach((button) => {
        button.addEventListener("click", async () => {
            const menuID = button.getAttribute("data-menu-id");
            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");

            try {
                const response = await fetch(`/favorite-menu/add`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify({
                        menu_ID: menuID,
                    }),
                });
                const data = await response.json();
                if (response.ok) {
                    // Menampilkan pemberitahuan sukses menggunakan Notyf
                    notyf.success(
                        data.message || "Perubahan favorit berhasil!"
                    );
                } else {
                    // Menampilkan pemberitahuan error menggunakan Notyf
                    notyf.error(
                        data.message || "Terjadi kesalahan, silakan coba lagi."
                    );
                }
            } catch (error) {
                console.error("Error:", error);
                // Menampilkan pemberitahuan error jika terjadi kesalahan jaringan
                notyf.error(
                    "Gagal memproses favorit. Periksa koneksi Anda dan coba lagi."
                );
            }
        });
    });
});

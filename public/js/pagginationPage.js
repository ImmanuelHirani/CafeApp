// Mengambil elemen-elemen yang dibutuhkan
const cardContainers = document.querySelectorAll(".tabs-content-product");
const cards = document.querySelectorAll(".card");
const paginationContainer = document.querySelectorAll(".footer-content-paging");
const pageNumbers = document.querySelectorAll(".page-numbers");
const resultText = document.querySelectorAll(".reasult-paggination");

// Konfigurasi awal
let currentPage = localStorage.getItem("lastVisitedPage")
  ? parseInt(localStorage.getItem("lastVisitedPage"))
  : 1;
let cardsPerPage = 6;

// Fungsi untuk mengatur jumlah kartu per halaman berdasarkan ukuran layar
function updateCardsPerPage() {
  if (window.innerWidth >= 1800) {
    cardsPerPage = 8;
  } else if (window.innerWidth >= 1440) {
    cardsPerPage = 6;
  } else {
    cardsPerPage = 4;
  }
  displayCards(currentPage);
  updatePagination();
}

// Fungsi untuk mendapatkan kartu yang aktif (dari container yang tidak hidden)
function getActiveCards() {
  let activeCards = [];
  cardContainers.forEach((container) => {
    if (!container.classList.contains("hidden")) {
      const containerCards = Array.from(
        container.querySelectorAll(".card")
      ).filter((card) => !card.classList.contains("hidden"));
      activeCards = [...activeCards, ...containerCards];
    }
  });
  return activeCards;
}

// Mendapatkan total halaman yang benar-benar memiliki konten
function getTotalPages() {
  const activeCards = getActiveCards();
  return Math.ceil(activeCards.length / cardsPerPage);
}

// Menampilkan kartu untuk halaman saat ini
function displayCards(page) {
  const activeCards = getActiveCards();
  const totalCards = activeCards.length;

  // Reset currentPage jika melebihi total halaman yang baru
  const totalPages = getTotalPages();
  if (currentPage > totalPages) {
    currentPage = totalPages || 1;
  }

  const startIndex = (currentPage - 1) * cardsPerPage;
  const endIndex = startIndex + cardsPerPage;

  // Sembunyikan semua kartu terlebih dahulu
  cards.forEach((card) => {
    card.style.display = "none";
  });

  // Tampilkan hanya kartu yang aktif dan berada dalam range halaman saat ini
  activeCards.forEach((card, index) => {
    if (index >= startIndex && index < endIndex) {
      card.style.display = "block";
    }
  });

  // Memperbarui teks hasil pagination
  resultText.forEach((text) => {
    if (text) {
      text.textContent = `Showing ${
        totalCards > 0 ? startIndex + 1 : 0
      } to ${Math.min(endIndex, totalCards)} of ${totalCards} Results`;
    }
  });
}

// Mengganti halaman
function changePage(newPage) {
  if (newPage >= 1 && newPage <= getTotalPages()) {
    currentPage = newPage;
    displayCards(currentPage);
    updatePagination();

    // Simpan halaman saat ini ke localStorage
    localStorage.setItem("lastVisitedPage", currentPage);
  }
}

// Membuat tombol navigasi (prev/next) dengan ikon HTML
function createNavButton(type, onClick) {
  const button = document.createElement("button");
  button.className =
    "flex items-center justify-center w-10 h-10 text-gray-600 border border-gray-300 rounded-full hover:bg-gray-50";
  button.setAttribute("type", "button");

  const icon = document.createElement("i");
  icon.className =
    type === "Previous"
      ? "ti ti-chevron-left text-xl"
      : "ti ti-chevron-right text-xl";

  button.appendChild(icon);
  button.addEventListener("click", onClick);

  return button;
}

// Memperbarui pagination
function updatePagination() {
  const totalPages = getTotalPages();

  pageNumbers.forEach((pageNumContainer) => {
    pageNumContainer.innerHTML = "";

    // Tombol sebelumnya
    const prevButton = createNavButton("Previous", () =>
      changePage(currentPage - 1)
    );
    prevButton.disabled = currentPage === 1;
    if (prevButton.disabled) {
      prevButton.classList.add("opacity-50", "cursor-not-allowed");
    }
    pageNumContainer.appendChild(prevButton);

    // Tombol halaman dengan logika ellipsis
    for (let i = 1; i <= totalPages; i++) {
      if (
        i === 1 || // Always show the first page
        i === totalPages || // Always show the last page
        (i >= currentPage - 2 && i <= currentPage + 2) // Show pages near the current page
      ) {
        const button = document.createElement("button");
        button.className = `flex items-center justify-center w-10 h-10 rounded-full ${
          i === currentPage
            ? "text-white bg-secondary-accent-color-admin"
            : "text-gray-600 hover:bg-gray-50"
        }`;
        button.textContent = i;
        button.addEventListener("click", () => changePage(i));
        pageNumContainer.appendChild(button);
      } else if (
        (i === currentPage - 3 && i > 1) || // Add ellipsis before current range
        (i === currentPage + 3 && i < totalPages) // Add ellipsis after current range
      ) {
        const ellipsis = document.createElement("span");
        ellipsis.className = "px-2 text-gray-600";
        ellipsis.textContent = "...";
        pageNumContainer.appendChild(ellipsis);
      }
    }

    // Tombol berikutnya
    const nextButton = createNavButton("Next", () =>
      changePage(currentPage + 1)
    );
    nextButton.disabled = currentPage === totalPages;
    if (nextButton.disabled) {
      nextButton.classList.add("opacity-50", "cursor-not-allowed");
    }
    pageNumContainer.appendChild(nextButton);
  });
}

// Setup Mutation Observer untuk memantau perubahan pada container
const observerConfig = {
  attributes: true,
  attributeFilter: ["class"], // Hanya perhatikan perubahan pada class
  subtree: false, // Tidak perlu memantau child elements
};

const observer = new MutationObserver((mutations) => {
  mutations.forEach((mutation) => {
    if (mutation.type === "attributes" && mutation.attributeName === "class") {
      // Perbarui tampilan ketika ada perubahan class
      displayCards(currentPage);
      updatePagination();
    }
  });
});

// Terapkan observer ke setiap container
cardContainers.forEach((container) => {
  observer.observe(container, observerConfig);
});

// Menangani perubahan ukuran layar
let resizeTimeout;
window.addEventListener("resize", () => {
  clearTimeout(resizeTimeout);
  resizeTimeout = setTimeout(updateCardsPerPage, 250);
});

// Inisialisasi
updateCardsPerPage();

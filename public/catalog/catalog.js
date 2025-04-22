// Carousel Logic
const slideshow = document.getElementById("slideshow");
const slides = slideshow.children;
const totalSlides = slides.length;

let currentIndex = 0;

// Show Slide
function showSlide(index) {
    const offset = index * -100; // Shift by 100% per slide
    slideshow.style.transform = `translateX(${offset}%)`;
}

// Auto Slide with Smooth Transition
function autoSlide() {
    currentIndex++;
    if (currentIndex >= totalSlides) {
        // Reset to the first slide smoothly
        currentIndex = 0;
        slideshow.style.transition = "none"; // Remove transition for instant reset
        slideshow.style.transform = `translateX(0%)`;

        // Reapply smooth transition after resetting
        setTimeout(() => {
            slideshow.style.transition =
                "transform 1.5s cubic-bezier(0.25, 1, 0.5, 1)";
        }, 50);
    } else {
        showSlide(currentIndex);
    }
}

// Start Auto Slide
setInterval(autoSlide, 5000); // Change slide every 5 seconds

const dropdownProyek = document.getElementById("dropdownProyek");
const dropdownMenuProyek = document.getElementById("dropdownMenuProyek");
const dropdownIconProyek = document.getElementById("dropdownIconProyek");
const dropdownTextProyek = document.getElementById("dropdownTextProyek");
const dropdownItemsProyek = dropdownMenuProyek.querySelectorAll("li");

// Toggle untuk buka/tutup dropdown
dropdownProyek.addEventListener("click", function () {
    dropdownMenuProyek.classList.toggle("opacity-100");
    dropdownMenuProyek.classList.toggle("invisible");

    // Rotasi ikon panah
    dropdownIconProyek.classList.toggle("rotate-180");
});

// Update teks saat item dropdown dipilih
dropdownItemsProyek.forEach((item) => {
    item.addEventListener("click", function () {
        // Ganti teks di tombol sesuai dengan pilihan
        dropdownTextProyek.textContent = this.getAttribute("data-value");

        // Tutup dropdown setelah memilih
        dropdownMenuProyek.classList.add("invisible");
        dropdownMenuProyek.classList.remove("opacity-100");
        dropdownIconProyek.classList.remove("rotate-180");
    });
});

// Menutup dropdown saat klik di luar dropdown
document.addEventListener("click", function (event) {
    if (!dropdownProyek.contains(event.target)) {
        dropdownMenuProyek.classList.add("invisible");
        dropdownMenuProyek.classList.remove("opacity-100");
        dropdownIconProyek.classList.remove("rotate-180");
    }
});
const dropdownHarga = document.getElementById("dropdownHarga");
const dropdownMenuHarga = document.getElementById("dropdownMenuHarga");
const dropdownIconHarga = document.getElementById("dropdownIconHarga");
const dropdownTextHarga = document.getElementById("dropdownTextHarga");
const dropdownItemsHarga = dropdownMenuHarga.querySelectorAll("li");

// Toggle untuk buka/tutup dropdown
dropdownHarga.addEventListener("click", function () {
    dropdownMenuHarga.classList.toggle("opacity-100");
    dropdownMenuHarga.classList.toggle("invisible");

    // Rotasi ikon panah
    dropdownIconHarga.classList.toggle("rotate-180");
});

// Update teks saat item dropdown dipilih
dropdownItemsHarga.forEach((item) => {
    item.addEventListener("click", function () {
        // Ganti teks di tombol sesuai dengan pilihan
        dropdownTextHarga.textContent = this.getAttribute("data-value");

        // Tutup dropdown setelah memilih
        dropdownMenuHarga.classList.add("invisible");
        dropdownMenuHarga.classList.remove("opacity-100");
        dropdownIconHarga.classList.remove("rotate-180");
    });
});

// Menutup dropdown saat klik di luar dropdown
document.addEventListener("click", function (event) {
    if (!dropdownHarga.contains(event.target)) {
        dropdownMenuHarga.classList.add("invisible");
        dropdownMenuHarga.classList.remove("opacity-100");
        dropdownIconHarga.classList.remove("rotate-180");
    }
});
const dropdownBangunan = document.getElementById("dropdownBangunan");
const dropdownMenuBangunan = document.getElementById("dropdownMenuBangunan");
const dropdownIconBangunan = document.getElementById("dropdownIconBangunan");
const dropdownTextBangunan = document.getElementById("dropdownTextBangunan");
const dropdownItemsBangunan = dropdownMenuBangunan.querySelectorAll("li");

// Toggle untuk buka/tutup dropdown
dropdownBangunan.addEventListener("click", function () {
    dropdownMenuBangunan.classList.toggle("opacity-100");
    dropdownMenuBangunan.classList.toggle("invisible");

    // Rotasi ikon panah
    dropdownIconBangunan.classList.toggle("rotate-180");
});

// Update teks saat item dropdown dipilih
dropdownItemsBangunan.forEach((item) => {
    item.addEventListener("click", function () {
        // Ganti teks di tombol sesuai dengan pilihan
        dropdownTextBangunan.textContent = this.getAttribute("data-value");

        // Tutup dropdown setelah memilih
        dropdownMenuBangunan.classList.add("invisible");
        dropdownMenuBangunan.classList.remove("opacity-100");
        dropdownIconBangunan.classList.remove("rotate-180");
    });
});

// Menutup dropdown saat klik di luar dropdown
document.addEventListener("click", function (event) {
    if (!dropdownBangunan.contains(event.target)) {
        dropdownMenuBangunan.classList.add("invisible");
        dropdownMenuBangunan.classList.remove("opacity-100");
        dropdownIconBangunan.classList.remove("rotate-180");
    }
});
const dropdownRelevansi = document.getElementById("dropdownRelevansi");
const dropdownMenuRelevansi = document.getElementById("dropdownMenuRelevansi");
const dropdownIconRelevansi = document.getElementById("dropdownIconRelevansi");
const dropdownTextRelevansi = document.getElementById("dropdownTextRelevansi");
const dropdownItemsRelevansi = dropdownMenuRelevansi.querySelectorAll("li");

console.log("Element dropdownRelevansi:", dropdownRelevansi);
console.log("Element dropdownMenuRelevansi:", dropdownMenuRelevansi);

// Toggle untuk buka/tutup dropdown
dropdownRelevansi.addEventListener("click", function (event) {
    console.log("Dropdown relevansi clicked!");
    event.stopPropagation(); // Mencegah event propagasi ke dokumen
    dropdownMenuRelevansi.classList.toggle("opacity-100");
    dropdownMenuRelevansi.classList.toggle("invisible");

    // Rotasi ikon panah
    dropdownIconRelevansi.classList.toggle("rotate-180");
});

// Update teks saat item dropdown dipilih
dropdownItemsRelevansi.forEach((item, index) => {
    console.log(`Item relevansi ${index}:`, item);
    item.addEventListener("click", function (event) {
        console.log("Item relevansi clicked:", this.getAttribute("data-value"));
        event.stopPropagation();

        // Ganti teks di tombol sesuai dengan pilihan
        dropdownTextRelevansi.textContent = this.getAttribute("data-value");

        // Perbarui filters.relevansi
        filters.relevansi = this.getAttribute("data-value");

        // Tutup dropdown setelah memilih
        dropdownMenuRelevansi.classList.add("invisible");
        dropdownMenuRelevansi.classList.remove("opacity-100");
        dropdownIconRelevansi.classList.remove("rotate-180");

        // Render ulang kartu-kartu
        currentPage = 1;
        renderCards();
    });
});

// Menutup dropdown saat klik di luar dropdown
document.addEventListener("click", function (event) {
    if (dropdownRelevansi && !dropdownRelevansi.contains(event.target)) {
        dropdownMenuRelevansi.classList.add("invisible");
        dropdownMenuRelevansi.classList.remove("opacity-100");
        dropdownIconRelevansi.classList.remove("rotate-180");
    }
});

// Inisialisasi slider untuk setiap card
function initCardSliders() {
    const sliderCards = document.querySelectorAll(".slider-card");

    // Loop untuk setiap card slider
    sliderCards.forEach((card, index) => {
        const cardId = card.closest(".card").getAttribute("data-id");

        if (!cardId) {
            console.error("Card tidak memiliki atribut data-id");
            return;
        }

        const prevBtn = card.querySelector(`#prev-btn-${cardId}`);
        const nextBtn = card.querySelector(`#next-btn-${cardId}`);
        const slideWrapper = card.querySelector(`#slide-wrapper-${cardId}`);
        const slides = slideWrapper?.querySelectorAll("div");
        const totalSlides = slides?.length || 0;

        if (!prevBtn || !nextBtn || !slideWrapper || totalSlides === 0) {
            console.error(
                `Slider elements missing or invalid for card ${cardId}`
            );
            return;
        }

        let currentSlideIndex = 0;

        // Fungsi untuk memperbarui posisi slide
        function updateSlidePosition() {
            const slideWidth = slideWrapper.offsetWidth;
            slideWrapper.style.transform = `translateX(-${currentSlideIndex * slideWidth
                }px)`;
            slides.forEach((slide) => {
                slide.style.width = `${slideWidth}px`;
            });
        }

        // Fungsi untuk menggerakkan slide
        function moveSlide(direction) {
            if (direction === "left") {
                currentSlideIndex =
                    currentSlideIndex === 0
                        ? totalSlides - 1
                        : currentSlideIndex - 1;
            } else {
                currentSlideIndex =
                    currentSlideIndex === totalSlides - 1
                        ? 0
                        : currentSlideIndex + 1;
            }
            updateSlidePosition();
        }

        // Hapus event listener lama jika ada
        const newPrevBtn = prevBtn.cloneNode(true);
        const newNextBtn = nextBtn.cloneNode(true);

        prevBtn.parentNode.replaceChild(newPrevBtn, prevBtn);
        nextBtn.parentNode.replaceChild(newNextBtn, nextBtn);

        // Tambahkan event listener baru
        newPrevBtn.addEventListener("click", () => moveSlide("left"));
        newNextBtn.addEventListener("click", () => moveSlide("right"));

        // Inisialisasi posisi slide
        updateSlidePosition();
    });
}

const cards = Array.from(document.querySelectorAll(".card")); // Semua kartu
const cardContainer = document.querySelector(".card-container"); // Kontainer kartu
const cardsPerPage = 9; // Jumlah kartu per halaman
let currentPage = 1;

// Filter state
const filters = {
    proyek: "Semua Proyek",
    price: "Rentang Harga",
    luas: "Luas Bangunan",
    relevansi: "Relevansi",
};

// Fungsi untuk memperbarui jumlah total kartu
const updateTotalResults = (filteredCards) => {
    const totalResultsElement = document.getElementById("total-results");
    totalResultsElement.textContent = filteredCards.length; // Jumlah kartu yang lolos filter
};

const observer = new MutationObserver(() => {
    initCardSliders(); // Inisialisasi slider setelah DOM berubah
});

// Pilih elemen yang perlu diawasi (cardContainer)
const config = { childList: true };

// Mulai mengawasi perubahan
observer.observe(cardContainer, config);

// Fungsi utama untuk menggabungkan search, filter, dan pagination
function renderCards() {
    const query = document.getElementById("search").value.toLowerCase();

    // Filter kartu
    let filteredCards = cards.filter((card) => {
        const cardProyek = card.getAttribute("data-category");
        const cardPrice = parseInt(card.getAttribute("data-price"));
        const cardLuas = parseInt(card.getAttribute("data-luas"));

        // Filter proyek
        const proyekFilter =
            filters.proyek === "Semua Proyek" || cardProyek === filters.proyek;

        // Filter harga
        let priceFilter = true;
        if (filters.price === "Rp < 2M") {
            priceFilter = cardPrice < 2000000000;
        } else if (filters.price === "Rp 2M - 3M") {
            priceFilter = cardPrice >= 2000000000 && cardPrice <= 3000000000;
        } else if (filters.price === "Rp 3M - 4M") {
            priceFilter = cardPrice >= 3000000000 && cardPrice <= 4000000000;
        } else if (filters.price === "Rp > 4M") {
            priceFilter = cardPrice > 4000000000;
        }

        // Filter luas
        let luasFilter = true;
        if (filters.luas === "0 m2 - 60 m2") {
            luasFilter = cardLuas >= 0 && cardLuas <= 60;
        } else if (filters.luas === "61 m2 - 80 m2") {
            luasFilter = cardLuas >= 61 && cardLuas <= 80;
        } else if (filters.luas === "81 m2 - 120 m2") {
            luasFilter = cardLuas >= 81 && cardLuas <= 120;
        } else if (filters.luas === "121 m2 - 200 m2") {
            luasFilter = cardLuas >= 121 && cardLuas <= 200;
        }

        return proyekFilter && priceFilter && luasFilter;
    });

    // Urutkan kartu berdasarkan relevansi
    // Urutkan kartu berdasarkan relevansi
    if (filters.relevansi === "Harga Tertinggi") {
        filteredCards.sort(
            (a, b) =>
                parseInt(b.getAttribute("data-price")) -
                parseInt(a.getAttribute("data-price"))
        );
    } else if (filters.relevansi === "Harga Terendah") {
        filteredCards.sort(
            (a, b) =>
                parseInt(a.getAttribute("data-price")) -
                parseInt(b.getAttribute("data-price"))
        );
    } else if (filters.relevansi === "Relevansi") {
        // Urutkan berdasarkan jenis proyek: Perumahan -> Apartemen -> Komersil
        filteredCards.sort((a, b) => {
            const categoryA = a.getAttribute("data-category");
            const categoryB = b.getAttribute("data-category");

            // Tetapkan nilai prioritas untuk setiap kategori
            const priority = {
                Perumahan: 1,
                Apartemen: 2,
                Komersil: 3,
            };

            // Bandingkan berdasarkan prioritas
            return (priority[categoryA] || 99) - (priority[categoryB] || 99);
        });
    }

    // Terapkan pencarian
    filteredCards = filteredCards.filter((card) =>
        card.textContent.toLowerCase().includes(query)
    );

    // Pagination
    const totalPages = Math.ceil(filteredCards.length / cardsPerPage);
    const start = (currentPage - 1) * cardsPerPage;
    const end = currentPage * cardsPerPage;

    // Render kartu sesuai halaman
    cardContainer.innerHTML = ""; // Menghapus konten sebelumnya

    // Loop dan append tiap kartu ke dalam container
    filteredCards.slice(start, end).forEach((card) => {
        const clonedCard = card.cloneNode(true);
        cardContainer.appendChild(clonedCard);
    });

    setTimeout(() => {
        initCardSliders(); // Pastikan slider diinisialisasi setelah kartu dirender
    }, 50);

    // Render pagination
    renderPagination(totalPages);

    // Perbarui jumlah total kartu
    updateTotalResults(filteredCards);
}
// Fungsi untuk membuat pagination
function renderPagination(totalPages) {
    const pageNumbersContainer = document.getElementById("page-numbers");
    const prevBtn = document.getElementById("prev-btn");
    const nextBtn = document.getElementById("next-btn");

    pageNumbersContainer.innerHTML = ""; // Kosongkan container halaman
    pageNumbersContainer.className = "flex space-x-2";
    prevBtn.disabled = currentPage === 1; // Disable tombol Prev jika di halaman pertama
    nextBtn.disabled = currentPage === totalPages; // Disable tombol Next jika di halaman terakhir

    // Menyembunyikan tombol nomor halaman jika hanya ada 1 halaman
    if (totalPages <= 1) {
        pageNumbersContainer.style.display = "none"; // Sembunyikan tombol nomor halaman
    } else {
        pageNumbersContainer.style.display = "block"; // Tampilkan tombol nomor halaman
        let startPage = Math.max(1, currentPage - 1); // Pastikan startPage minimal 1
        let endPage = Math.min(totalPages, currentPage + 1); // Pastikan endPage tidak melebihi totalPages

        // Sesuaikan start dan end untuk menampilkan 3 tombol jika memungkinkan
        if (endPage - startPage < 2) {
            const diff = 2 - (endPage - startPage);
            if (startPage - diff >= 1) {
                startPage -= diff;
            } else {
                endPage += diff;
            }
        }

        // Membuat tombol nomor halaman
        for (let i = startPage; i <= endPage; i++) {
            const button = document.createElement("button");
            button.textContent = i;
            button.className = `w-10 h-10 ${i === currentPage
                    ? "bg-[#05864D] text-white"
                    : "bg-white text-gray-800 border border-gray-300"
                } rounded-lg font-semibold hover:bg-[#05864D] hover:text-black transition duration-200`;
            button.addEventListener("click", () => {
                currentPage = i; // Perbarui halaman saat ini
                renderCards(); // Render ulang kartu
                renderPagination(totalPages); // Render ulang pagination
            });
            pageNumbersContainer.appendChild(button); // Tambahkan tombol ke container
        }
    }
    // Mengubah warna tombol Previous dan Next berdasarkan status disabled/enabled
    prevBtn.className = `px-4 py-2 ${prevBtn.disabled
            ? "text-gray-400 cursor-not-allowed"
            : "text-gray-800 cursor-pointer font-semibold hover:bg-[#05864D] hover:text-white hover:shadow-lg transition duration-200 rounded-lg"
        }`;
    nextBtn.className = `px-4 py-2 ${nextBtn.disabled
            ? "text-gray-400 cursor-not-allowed"
            : "text-gray-800 cursor-pointer font-semibold hover:bg-[#05864D] hover:text-white hover:shadow-lg transition duration-200 rounded-lg"
        }`;
}

// Event listener untuk pencarian
document.getElementById("search").addEventListener("input", () => {
    currentPage = 1; // Reset ke halaman pertama
    renderCards();
});

// Event listener untuk dropdown filter
document.querySelectorAll("#dropdownMenuProyek li").forEach((item) => {
    item.addEventListener("click", function () {
        filters.proyek = this.getAttribute("data-value");
        currentPage = 1; // Reset ke halaman pertama
        renderCards();
    });
});

document.querySelectorAll("#dropdownMenuHarga li").forEach((item) => {
    item.addEventListener("click", function () {
        filters.price = this.getAttribute("data-value");
        currentPage = 1; // Reset ke halaman pertama
        renderCards();
    });
});

document.querySelectorAll("#dropdownMenuBangunan li").forEach((item) => {
    item.addEventListener("click", function () {
        filters.luas = this.getAttribute("data-value");
        currentPage = 1; // Reset ke halaman pertama
        renderCards();
    });
});

document.querySelectorAll("#dropdownMenuRelevansi li").forEach((item) => {
    item.addEventListener("click", function () {
        filters.relevansi = this.getAttribute("data-value");
        currentPage = 1; // Reset ke halaman pertama
        renderCards();
    });
});

// Event listener untuk pagination tombol prev/next
document.getElementById("prev-btn").addEventListener("click", () => {
    if (currentPage > 1) {
        currentPage--;
        renderCards();
    }
});

document.getElementById("next-btn").addEventListener("click", () => {
    const totalPages = Math.ceil(cards.length / cardsPerPage);
    if (currentPage < totalPages) {
        currentPage++;
        renderCards();
    }
});

// Event listener untuk View More
// document.getElementById("view-more-btn").addEventListener("click", () => {
//   const totalPages = Math.ceil(cards.length / cardsPerPage);
//   if (currentPage < totalPages) {
//     currentPage++;
//     renderCards();
//   }
// });

// Fungsi untuk memeriksa layar responsif
// function handleResponsive() {
//   const isMobile = window.matchMedia("(max-width: 480px)").matches;
//   const viewMoreBtn = document.getElementById("view-more-btn");
//   const prevBtn = document.getElementById("prev-btn");
//   const nextBtn = document.getElementById("next-btn");

//   if (isMobile) {
//     // Tampilkan tombol "View More"
//     viewMoreBtn.classList.remove("hidden");
//     prevBtn.classList.add("hidden");
//     nextBtn.classList.add("hidden");
//   } else {
//     // Tampilkan tombol Prev/Next
//     viewMoreBtn.classList.add("hidden");
//     prevBtn.classList.remove("hidden");
//     nextBtn.classList.remove("hidden");
//   }
// }

// Event listener untuk perubahan ukuran layar
// window.addEventListener("resize", handleResponsive);

// Inisialisasi
// handleResponsive();
renderCards();

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
const cardss = document.querySelectorAll(".card");

// Toggle dropdown
dropdownProyek.addEventListener("click", function () {
    dropdownMenuProyek.classList.toggle("opacity-100");
    dropdownMenuProyek.classList.toggle("invisible");
    dropdownIconProyek.classList.toggle("rotate-180");
});

// Update teks dropdown & filter kartu
dropdownItemsProyek.forEach((item) => {
    item.addEventListener("click", function () {
        const selectedCategory = this.getAttribute("data-value");
        dropdownTextProyek.textContent = selectedCategory;

        // Filter kartu
        cardss.forEach((card) => {
            const cardCategory = card.getAttribute("data-category");

            if (
                selectedCategory === "Semua Proyek" ||
                cardCategory === selectedCategory
            ) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });

        // Tutup dropdown setelah memilih
        dropdownMenuProyek.classList.add("invisible");
        dropdownMenuProyek.classList.remove("opacity-100");
        dropdownIconProyek.classList.remove("rotate-180");
    });
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

// Toggle untuk buka/tutup dropdown
dropdownRelevansi.addEventListener("click", function () {
    dropdownMenuRelevansi.classList.toggle("opacity-100");
    dropdownMenuRelevansi.classList.toggle("invisible");

    // Rotasi ikon panah
    dropdownIconRelevansi.classList.toggle("rotate-180");
});

// Update teks saat item dropdown dipilih
dropdownItemsRelevansi.forEach((item) => {
    item.addEventListener("click", function () {
        // Ganti teks di tombol sesuai dengan pilihan
        dropdownTextRelevansi.textContent = this.getAttribute("data-value");

        // Tutup dropdown setelah memilih
        dropdownMenuRelevansi.classList.add("invisible");
        dropdownMenuRelevansi.classList.remove("opacity-100");
        dropdownIconRelevansi.classList.remove("rotate-180");
    });
});

// Menutup dropdown saat klik di luar dropdown
document.addEventListener("click", function (event) {
    if (!dropdownRelevansi.contains(event.target)) {
        dropdownMenuRelevansi.classList.add("invisible");
        dropdownMenuRelevansi.classList.remove("opacity-100");
        dropdownIconRelevansi.classList.remove("rotate-180");
    }
});

//JavaScript Slider Code

// Ambil semua card slider
const sliderCards = document.querySelectorAll(".slider-card");

sliderCards.forEach((card) => {
    const prevBtn = card.querySelector(".prev-btn");
    const nextBtn = card.querySelector(".next-btn");
    const slideWrapper = card.querySelector(".flex.transition-transform");
    const slides = slideWrapper?.querySelectorAll("div");
    const totalSlides = slides?.length || 0;

    if (!prevBtn || !nextBtn || !slideWrapper || totalSlides === 0) {
        console.error("Slider elements missing or invalid.");
        return;
    }

    let currentSlideIndex = 0;

    function updateSlidePosition() {
        const slideWidth = card.offsetWidth;
        slideWrapper.style.transform = `translateX(-${
            currentSlideIndex * slideWidth
        }px)`;
        slides.forEach((slide) => {
            slide.style.width = `${slideWidth}px`; // Pastikan setiap slide memiliki lebar yang sesuai
        });

        // Tambahan: Pastikan gambar di dalam slide dimuat dengan benar
        slides.forEach((slide) => {
            const img = slide.querySelector("img");
            if (img) {
                img.style.display = "block"; // Pastikan gambar tidak tersembunyi
            }
        });
    }

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

    prevBtn.addEventListener("click", () => moveSlide("left"));
    nextBtn.addEventListener("click", () => moveSlide("right"));

    window.addEventListener("resize", updateSlidePosition);

    updateSlidePosition();
});

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
    cardContainer.innerHTML = "";
    filteredCards
        .slice(start, end)
        .forEach((card) => cardContainer.appendChild(card));

    // Render pagination
    renderPagination(totalPages);

    // Perbarui jumlah total kartu
    updateTotalResults(filteredCards);
}

// Fungsi untuk membuat pagination
// Fungsi untuk membuat pagination
function renderPagination(totalPages) {
    const pageNumbersContainer = document.getElementById("page-numbers");
    const prevBtn = document.getElementById("prev-btn");
    const nextBtn = document.getElementById("next-btn");

    pageNumbersContainer.innerHTML = "";
    prevBtn.disabled = currentPage === 1;
    nextBtn.disabled = currentPage === totalPages;

    // Logic to show only 3 card buttons
    let startPage = Math.max(1, currentPage - 1); // Ensure startPage is at least 1
    let endPage = Math.min(totalPages, currentPage + 1); // Ensure endPage doesn't exceed totalPages

    // Adjust start and end pages to always show 3 buttons if possible
    if (endPage - startPage < 2) {
        const diff = 2 - (endPage - startPage);
        if (startPage - diff >= 1) {
            startPage -= diff;
        } else {
            endPage += diff;
        }
    }

    for (let i = startPage; i <= endPage; i++) {
        const button = document.createElement("button");
        button.textContent = i;

        // Tentukan class berdasarkan halaman saat ini
        button.className = `w-10 h-10 ${
            i === currentPage
                ? "bg-[#05864D] text-white"
                : "bg-white text-gray-800 border border-gray-300"
        } rounded-lg font-semibold hover:bg-[#05864D] hover:text-black transition duration-200`;

        // Tambahkan event listener untuk mengubah halaman
        button.addEventListener("click", () => {
            currentPage = i; // Perbarui halaman saat ini
            renderCards(); // Render ulang kartu
            renderPagination(totalPages); // Render ulang pagination
        });

        // Tambahkan tombol ke container
        pageNumbersContainer.appendChild(button);
    }
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

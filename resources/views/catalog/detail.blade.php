<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- PhotoSwipe CSS -->
    <link rel="stylesheet" href="https://unpkg.com/photoswipe@5/dist/photoswipe.css">

    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}

    <link rel="stylesheet" href="{{ asset('catalog/catalog.css') }}" />
    <title>E-Catalog JGC</title>

    <style>
        /* Make main image full width with rounded corners */
        .main-slider img {
            width: 100%;
            /* max-height: */
            /* Adjust as needed */
            object-fit: cover;
            /* border-radius: 0.5rem; */
        }

        /* Make all thumbnails the same size, same height, and rounded corners */
        .swiper-thumbnails img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 0.5rem;
            cursor: pointer;
        }

        /* Ensure the swiper thumbnail container has a fixed height */
        .swiper-thumbnails .swiper-slide {
            /* Adjust the height as needed */
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body class="">

    @include('catalog.components.navbar')

    <section class="">
        <!-- Main Photo Slider -->
        <div class="swiper-container main-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img class="w-full h-auto aspect-[16/9] object-cover " src="catalog/img/Cleon Park.JPG"
                        alt="Main Photo 1" />
                </div>
                <div class="swiper-slide">
                    <img class="w-full h-auto aspect-[16/9] object-cover " src="catalog/img/cleon/Cleon1.png"
                        alt="Main Photo 2" />
                </div>
                <div class="swiper-slide">
                    <img class="w-full h-auto aspect-[16/9] object-cover " src="catalog/img/cleon_layout1.png"
                        alt="Main Photo 3" />
                </div>
            </div>
        </div>

        <!-- Thumbnails Slider -->
        <div class="swiper-container swiper-thumbnails mt-4 px-4">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img class="w-full h-auto aspect-[16/9] rounded-[10px] border border-[#EEEEF0] object-cover"
                        src="catalog/img/Cleon Park.JPG" alt="Thumbnail 1" />
                </div>
                <div class="swiper-slide">
                    <img class="w-full h-auto aspect-[16/9] rounded-[10px] border border-[#EEEEF0] object-cover"
                        src="catalog/img/cleon/Cleon1.png" alt="Thumbnail 2" />
                </div>
                <div class="swiper-slide">
                    <img class="w-full h-auto aspect-[16/9] rounded-[10px] border border-[#EEEEF0] object-cover"
                        src="catalog/img/cleon_layout1.png" alt="Thumbnail 3" />
                </div>
            </div>
        </div>
    </section>

    <section class="w-full px-4 md:px-8 lg:px-16 pt-3">
        <div class="flex flex-col md:flex-row w-full gap-6">
            <!-- Left Section -->
            <div class="w-full md:w-2/3">
                <div class="flex flex-col md:flex-row items-center md:items-start md:ml-8 mt-6 mb-4">
                    <img src="{{ asset('catalog/img/logo_cleo.png') }}" alt="Cleon Park Logo"
                        class="w-[140px] h-[180px] md:w-[176px] md:h-[220px] md:mr-6 object-cover border rounded-lg" />
                    <div class="w-full text-center md:text-left mt-4 md:mt-0">
                        <h1 class="font-poppins font-semibold text-2xl md:text-4xl text-[#545454] leading-tight mb-2">
                            Cleon Park - Studio
                        </h1>
                        <div class="flex flex-wrap justify-center md:justify-start gap-2 md:gap-4 mt-2">
                            <img src="catalog/img/freedp.png" alt="Free DP"
                                class="w-[90px] h-[35px] md:w-[108px] md:h-[42px]" />
                            <img src="catalog/img/freeBPHTB.png" alt="Free BPHTB"
                                class="w-[110px] h-[35px] md:w-[138px] md:h-[42px]" />
                            <img src="catalog/img/limitedStock.png" alt="Limited Stock"
                                class="w-[130px] h-[35px] md:w-[157px] md:h-[42px]" />
                        </div>
                        <div
                            class="text-[#52525B] text-base md:text-lg flex flex-col md:flex-row items-center justify-center md:justify-start pt-3">
                            <span class="font-poppins font-normal">Start From</span>
                            <span class="px-2 md:px-3 font-poppins font-semibold text-2xl md:text-3xl text-[#52525b]">Rp
                                3.300.000.000</span>
                        </div>
                    </div>
                </div>


                <!-- Detail Section -->
                <div class="md:ml-8 mt-8 border rounded-xl border-[#eeeef0] p-6">
                    <h5 class="font-poppins font-semibold text-xl text-black">Detail</h5>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 mt-4">
                        <div>
                            <p class="text-[#93949d] text-base font-normal">Proyek</p>
                            <div class="flex items-center space-x-2">
                                <img src="{{ asset('catalog/img/house-svgrepo-com 1.png') }}" class="w-8 h-8"
                                    alt="Icon" />
                                <span class="text-black font-medium">Apartemen</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-[#93949d] text-base font-normal">Luas Bangunan</p>
                            <div class="flex items-center space-x-2">
                                <img src="{{ asset('catalog/img/webpack_svgrepo.com.png') }}" class="w-8 h-8"
                                    alt="Icon" />
                                <span class="text-black font-medium">31 m²</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-[#93949d] text-base font-normal">Kamar Tidur</p>
                            <div class="flex items-center space-x-2">
                                <img src="{{ asset('catalog/img/surface 4.png') }}" class="w-8 h-8" alt="Icon" />
                                <span class="text-black font-medium">0</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-[#93949d] text-base font-normal">Kamar Mandi</p>
                            <div class="flex items-center space-x-2">
                                <img src="{{ asset('catalog/img/shower_svgrepo.com.png') }}" class="w-8 h-8"
                                    alt="Icon" />
                                <span class="text-black font-medium">1</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-[#93949d] text-base font-normal">Dapur</p>
                            <div class="flex items-center space-x-2">
                                <img src="{{ asset('catalog/img/refrigerator_svgrepo.com.png') }}" class="w-8 h-8"
                                    alt="Icon" />
                                <span class="text-black font-medium">1</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-[#93949d] text-base font-normal">Lantai</p>
                            <div class="flex items-center space-x-2">
                                <img src="{{ asset('catalog/img/stair 2.png') }}" class="w-8 h-8" alt="Icon" />
                                <span class="text-black font-medium">1 - 10</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-[#93949d] text-base font-normal">Listrik (Watt)</p>
                            <div class="flex items-center space-x-2">
                                <img src="{{ asset('catalog/img/lightning-bolt_svgrepo.com.png') }}" class="w-8 h-8"
                                    alt="Icon" />
                                <span class="text-black font-medium">2200</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-[#93949d] text-base font-normal">Furnitur</p>
                            <div class="flex items-center space-x-2">
                                <img src="{{ asset('catalog/img/sofa_svgrepo.com.png') }}" class="w-8 h-8"
                                    alt="Icon" />
                                <span class="text-black font-medium">Semi Furnish</span>
                            </div>
                        </div>

                    </div>
                </div>



                <!-- Fasilitas Section -->
                <div class="md:ml-8 mt-8 border rounded-xl border-[#eeeef0] p-6">
                    <h5 class="font-poppins font-semibold text-xl text-black">Fasilitas Apartemen</h5>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 mt-4">
                        <div class="relative flex items-center space-x-2 min-w-0 group">
                            <img src="{{ asset('catalog/img/card_svgrepo.com.png') }}" class="w-8 h-8"
                                alt="Icon" />
                            <span class="text-black font-medium truncate" title="Kartu Akses">Kartu Akses</span>
                        </div>
                        <div class="relative flex items-center space-x-2 min-w-0 group">
                            <img src="{{ asset('catalog/img/sink-2_svgrepo.com.png') }}" class="w-8 h-8"
                                alt="Icon" />
                            <span class="text-black font-medium truncate" title="Wastafel">Wastafel</span>
                        </div>
                        <div class="relative flex items-center space-x-2 min-w-0 group">
                            <img src="{{ asset('catalog/img/shower_svgrepo.com.png') }}" class="w-8 h-8"
                                alt="Icon" />
                            <span class="text-black font-medium truncate" title="Shower">Shower</span>
                        </div>
                        <div class="relative flex items-center space-x-2 min-w-0 group">
                            <img src="{{ asset('catalog/img/balcony_svgrepo.com.png') }}" class="w-8 h-8"
                                alt="Icon" />
                            <span class="text-black font-medium truncate" title="Balkon">Balkon</span>
                        </div>
                        <div class="relative flex items-center space-x-2 min-w-0 group">
                            <img src="{{ asset('catalog/img/wifi_svgrepo.com.png') }}" class="w-8 h-8"
                                alt="Icon" />
                            <span class="text-black font-medium truncate" title="Wifi">Wifi</span>
                        </div>
                        <div class="relative flex items-center space-x-2 min-w-0 group">
                            <img src="{{ asset('catalog/img/swim_svgrepo.com.png') }}" class="w-8 h-8"
                                alt="Icon" />
                            <span class="text-black font-medium truncate group-hover:overflow-visible">Kolam
                                Renang</span>
                            <div
                                class="absolute left-0 bottom-full mb-2 w-max max-w-xs p-2 text-xs text-white bg-gray-800 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity">
                                Kolam Renang
                            </div>
                        </div>
                        <div class="relative flex items-center space-x-2 min-w-0 group">
                            <img src="{{ asset('catalog/img/park_svgrepo.com.png') }}" class="w-8 h-8"
                                alt="Icon" />
                            <span class="text-black font-medium truncate" title="Taman">Taman</span>
                        </div>
                        <div class="relative flex items-center space-x-2 min-w-0 group">
                            <img src="{{ asset('catalog/img/atm-money_svgrepo.com.png') }}" class="w-8 h-8"
                                alt="Icon" />
                            <span class="text-black font-medium truncate" title="ATM">ATM</span>
                        </div>
                        <div class="relative flex items-center space-x-2 min-w-0 group">
                            <img src="{{ asset('catalog/img/walk-go-move-next_svgrepo.com.png') }}" class="w-8 h-8"
                                alt="Icon" />
                            <span class="text-black font-medium truncate" title="Jalur Lari">Jalur Lari</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Section (Google Maps) -->
            <div class="w-full md:w-1/3 flex justify-center md:justify-end">
                <div class="w-full md:w-[400px] h-[400px] relative">
                    <iframe class="w-full h-full rounded-xl"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.4237220058457!2d144.95778431560456!3d-37.81362797975144!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d5ceea61d6b%3A0x14bfb2f81b89a1db!2sFederation%20Square!5e0!3m2!1sen!2sus!4v1636993060137!5m2!1sen!2sus"
                        frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </section>


    @include('catalog.components.footer')




    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- PhotoSwipe JS -->
    <script src="https://unpkg.com/photoswipe@5/dist/photoswipe.umd.min.js"></script>
    <script>
        // Initialize Swiper for the main image (disable swipe functionality)
        const mainSwiper = new Swiper(".main-slider", {
            loop: true,
            autoplay: {
                delay: 3000, // Auto-slide every 3 seconds
            },
            allowTouchMove: false // Disable swipe for main slider
        });

        // Initialize Swiper for thumbnails (enable swipe)
        const thumbnailSwiper = new Swiper(".swiper-thumbnails", {
            slidesPerView: 5,
            spaceBetween: 10,
            slideToClickedSlide: true, // Sync with main slider
            allowTouchMove: true // Enable swipe for thumbnails
        });

        mainSwiper.controller.control = thumbnailSwiper;
        thumbnailSwiper.controller.control = mainSwiper;

        // Change the main image when a thumbnail is clicked
        const thumbnails = document.querySelectorAll(".swiper-thumbnails img");
        const mainImage = document.querySelector(".main-slider img");

        thumbnails.forEach((thumbnail, index) => {
            thumbnail.addEventListener("click", () => {
                mainImage.src = thumbnail.src;
            });
        });

        // Initialize PhotoSwipe
        document.querySelectorAll(".main-slider img").forEach((img) => {
            img.addEventListener("click", () => {
                const pswp = new PhotoSwipe({
                    dataSource: [{
                        src: img.src,
                        w: img.naturalWidth,
                        h: img.naturalHeight,
                    }, ],
                    index: 0,
                });

                pswp.init();
            });
        });
    </script>
</body>

</html>

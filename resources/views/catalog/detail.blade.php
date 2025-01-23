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
            max-height:
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

    <section class="w-full ">
        <!-- Main Photo Slider -->
        <div class="swiper-container main-slider w-full">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img class="w-full  sm:max-h-20% md:max-h-1/2 rounded-lg"
                        src="https://i.pinimg.com/736x/36/7e/5e/367e5e0b899fad694a4de1aebcddccda.jpg"
                        alt="Main Photo 1" />
                </div>
                <div class="swiper-slide">
                    <img class="w-full sm:max-h-20% md:max-h-1/2 rounded-lg"
                        src="https://i.pinimg.com/736x/b7/cf/9d/b7cf9d1802b3b54e08ac6f0555ea0432.jpg"
                        alt="Main Photo 2" />
                </div>
                <div class="swiper-slide">
                    <img class="w-full  sm:max-h-20% md:max-h-1/2 rounded-lg"
                        src="https://i.pinimg.com/736x/f7/bb/10/f7bb1038e959bdaef52d5666341003db.jpg"
                        alt="Main Photo 3" />
                </div>
            </div>
        </div>

        <!-- Thumbnails Slider -->
        <div class="swiper-container swiper-thumbnails mt-4 px-4">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img class=" sm:w-[120px] sm:h-[70px] lg:w-[120px] lg:h-[120px] rounded-lg object-cover"
                        src="https://i.pinimg.com/736x/36/7e/5e/367e5e0b899fad694a4de1aebcddccda.jpg"
                        alt="Thumbnail 1" />
                </div>
                <div class="swiper-slide">
                    <img class=" sm:w-[120px] sm:h-[70px] lg:w-[120px] lg:h-[120px] rounded-lg object-cover"
                        src="https://i.pinimg.com/736x/b7/cf/9d/b7cf9d1802b3b54e08ac6f0555ea0432.jpg"
                        alt="Thumbnail 2" />
                </div>
                <div class="swiper-slide">
                    <img class=" sm:w-[120px] sm:h-[70px] lg:w-[120px] lg:h-[120px] rounded-lg object-cover"
                        src="https://i.pinimg.com/736x/f7/bb/10/f7bb1038e959bdaef52d5666341003db.jpg"
                        alt="Thumbnail 3" />
                </div>
            </div>
        </div>
    </section>



    <section class="w-full ">
        <div class="flex w-full flex-col md:flex-row ">
            <!-- Left Section -->
            <div class="w-full md:w-[70%]">

                <div class="flex items-center flex-col md:flex-row md:ml-20 mt-6 mb-4">
                    <div class="flex justify-center items-center mb-4 md:mb-0">
                        <img src="{{ asset('catalog/img/logo_cleo.png') }}" alt="Cleon Park Logo"
                            class="w-[173px] h-[173px] md:mr-6 object-cover border-[1px] rounded-[20px]" />
                    </div>

                    <div class="max-w-full">
                        <div class="text-[48px] font-[Poppins] text-[#545454] mb-2">
                            Vastu - V7
                        </div>
                        <div class="text-[#52525B] text-[16px] ml-2 flex items-center">
                            Start From <span class="text-lg font-bold ml-2">Rp 3.300.000.000</span>
                        </div>
                    </div>
                </div>



                <!-- Parent Container with padding -->
                <div class="flex justify-start  my-8">
                    <!-- Detail Section -->
                    <div class="w-full h-auto md:ml-20 max-w-4xl border-[1px] rounded-[20px] border-[#eeeef0] p-5">
                        <h5 class="font-poppins font-semibold text-[20px] leading-[28px] text-[#000000]">Detail</h5>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6 mt-5">
                            <!-- Proyek -->
                            <div class="w-full h-[65px]">
                                <p class="text-[#93949d] text-[16px] font-normal font-poppins leading-[25.6px] mb-2">
                                    Proyek</p>
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('catalog/img/house-svgrepo-com 1.png') }}"
                                        class="w-[30px] h-[30px]" alt="House Icon" />
                                    <span
                                        class="text-[#000000] text-[16px] font-poppins leading-[40.1px] font-medium">Apartemen</span>
                                </div>
                            </div>
                            <!-- Luas Bangunan -->
                            <div class="w-full h-[65px]">
                                <p class="text-[#93949d] text-[16px] font-normal font-poppins leading-[25.6px] mb-2">
                                    Luas
                                    Bangunan</p>
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('catalog/img/webpack_svgrepo.com.png') }}"
                                        class="w-[30px] h-[30px]" alt="Area Icon" />
                                    <span
                                        class="text-[#000000] text-[16px] font-poppins leading-[40.1px] font-medium">31
                                        m²</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-start  my-8">
                    <!-- Detail Section -->
                    <div class="w-full h-auto md:ml-20 max-w-4xl border-[1px] rounded-[20px] border-[#eeeef0] p-5">
                        <h5 class="font-poppins font-semibold text-[20px] leading-[28px] text-[#000000]">Fasilitas
                            Cluster</h5>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6 mt-5">
                            <!-- Proyek -->
                            <div class="w-full h-[65px]">
                                <p class="text-[#93949d] text-[16px] font-normal font-poppins leading-[25.6px] mb-2">
                                    Proyek</p>
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('catalog/img/house-svgrepo-com 1.png') }}"
                                        class="w-[30px] h-[30px]" alt="House Icon" />
                                    <span
                                        class="text-[#000000] text-[16px] font-poppins leading-[40.1px] font-medium">Apartemen</span>
                                </div>
                            </div>
                            <!-- Luas Bangunan -->
                            <div class="w-full h-[65px]">
                                <p class="text-[#93949d] text-[16px] font-normal font-poppins leading-[25.6px] mb-2">
                                    Luas
                                    Bangunan</p>
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('catalog/img/webpack_svgrepo.com.png') }}"
                                        class="w-[30px] h-[30px]" alt="Area Icon" />
                                    <span
                                        class="text-[#000000] text-[16px] font-poppins leading-[40.1px] font-medium">31
                                        m²</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-[30%] relative max-h-[400px] flex justify-center">
                <div class="relative w-[400px] h-[400px]">
                    <iframe class="w-full h-full rounded-[20px]"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.4237220058457!2d144.95778431560456!3d-37.81362797975144!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d5ceea61d6b%3A0x14bfb2f81b89a1db!2sFederation%20Square!5e0!3m2!1sen!2sus!4v1636993060137!5m2!1sen!2sus"
                        frameborder="0" class="border-0" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>
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

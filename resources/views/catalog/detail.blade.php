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


    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />


    <link rel="stylesheet" href="{{ asset('catalog/catalog.css') }}" />
    <title>E-Catalog JGC</title>

    <style>
        /* Make main image full width with rounded corners */
        .main-slider img {
            width: 100%;
            height: 70vh;
            /* Adjust as needed */
            object-fit: cover;
            border-radius: 0.5rem;
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
            height: 180px;
            /* Adjust the height as needed */
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body class="">

    @include('catalog.components.navbar')

    <section class="w-full">
        <!-- Main Photo Slider -->
        <div class="swiper-container main-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img class="h-auto max-w-full rounded-lg"
                        src="https://images.unsplash.com/photo-1499696010180-025ef6e1a8f9?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1200"
                        alt="Main Photo 1" />
                </div>
                <div class="swiper-slide">
                    <img class="h-auto max-w-full rounded-lg"
                        src="https://images.unsplash.com/photo-1432462770865-65b70566d673?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1200"
                        alt="Main Photo 2" />
                </div>
                <div class="swiper-slide">
                    <img class="h-auto max-w-full rounded-lg"
                        src="https://images.unsplash.com/photo-1493246507139-91e8fad9978e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1200"
                        alt="Main Photo 3" />
                </div>
                <div class="swiper-slide">
                    <img class="h-auto max-w-full rounded-lg"
                        src="https://images.unsplash.com/photo-1499696010180-025ef6e1a8f9?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1200"
                        alt="Main Photo 1" />
                </div>
                <div class="swiper-slide">
                    <img class="h-auto max-w-full rounded-lg"
                        src="https://images.unsplash.com/photo-1432462770865-65b70566d673?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1200"
                        alt="Main Photo 2" />
                </div>
                <div class="swiper-slide">
                    <img class="h-auto max-w-full rounded-lg"
                        src="https://images.unsplash.com/photo-1493246507139-91e8fad9978e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1200"
                        alt="Main Photo 3" />
                </div>
            </div>
        </div>

        <!-- Thumbnails Slider -->
        <div class="swiper-container swiper-thumbnails mt-8 mx-82">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img class="h-auto max-w-full rounded-lg"
                        src="https://images.unsplash.com/photo-1499696010180-025ef6e1a8f9?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=200"
                        alt="Thumbnail 1" />
                </div>
                <div class="swiper-slide">
                    <img class="h-auto max-w-full rounded-lg"
                        src="https://images.unsplash.com/photo-1432462770865-65b70566d673?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=200"
                        alt="Thumbnail 2" />
                </div>
                <div class="swiper-slide">
                    <img class="h-auto max-w-full rounded-lg"
                        src="https://images.unsplash.com/photo-1493246507139-91e8fad9978e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=200"
                        alt="Thumbnail 3" />
                </div>
                <div class="swiper-slide">
                    <img class="h-auto max-w-full rounded-lg"
                        src="https://images.unsplash.com/photo-1499696010180-025ef6e1a8f9?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=200"
                        alt="Thumbnail 1" />
                </div>
                <div class="swiper-slide">
                    <img class="h-auto max-w-full rounded-lg"
                        src="https://images.unsplash.com/photo-1432462770865-65b70566d673?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=200"
                        alt="Thumbnail 2" />
                </div>
                <div class="swiper-slide">
                    <img class="h-auto max-w-full rounded-lg"
                        src="https://images.unsplash.com/photo-1493246507139-91e8fad9978e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=200"
                        alt="Thumbnail 3" />
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

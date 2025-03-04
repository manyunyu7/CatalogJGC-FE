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
        .clip-ticket {
            clip-path: polygon(10% 0%, 90% 0%, 100% 15%, 100% 85%, 90% 100%, 10% 100%, 0% 85%, 0% 15%);
        }

        /* Make main image full width with rounded corners */
        .main-slider img {
            width: 100%;
            height: 100%;
            /* Ensures it fills the parent container */
            max-height: 50vh;
            /* Limits the maximum height */
            object-fit: contain;
            border-radius: 20px !important;
            /* Adjust the value as needed */
            /* Ensures the entire image is visible without cropping */
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
                @foreach ($productImages as $image)
                    <div class="swiper-slide">
                        <img class="w-full h-auto aspect-[16/9] object-cover rounded-[10px] "
                            src="{{ $image->full_img_path }}" alt="Main Photo" />
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Thumbnails Slider -->
        <div class="swiper-container swiper-thumbnails mt-4 px-4">
            <div class="swiper-wrapper">
                @foreach ($productImages as $image)
                    <div class="swiper-slide">
                        <img class="w-full h-auto aspect-[16/9] rounded-[10px] border border-[#EEEEF0] object-cover"
                            src="{{ $image->full_img_path }}" alt="Thumbnail" />
                    </div>
                @endforeach
            </div>
        </div>

    </section>

    <section class="w-full px-4 md:px-8 lg:px-16 pt-3">
        <div class="flex flex-col md:flex-row w-full gap-6">
            <!-- Left Section -->
            <div class="w-full md:w-2/3">
                <div class="flex flex-col md:flex-row items-center md:items-start md:ml-8 mt-6 mb-4">
                    <img src="{{ $typeDetail->cluster_icon_path }}"
                        class="w-[140px] h-[180px] md:w-[176px] md:h-[220px] md:mr-6 object-cover border rounded-lg" />
                    <div class="w-full text-center md:text-left mt-4 md:mt-0">
                        <h1 class="font-poppins font-semibold text-2xl md:text-4xl text-[#545454] leading-tight mb-2">
                            {{ $product->name }} - {{ $typeDetail->name_en }}
                        </h1>
                        <div class="flex flex-wrap justify-center md:justify-start gap-2 md:gap-4 mt-2">
                            @if (!empty($product->promos))
                                @foreach ($product->promos as $promo)
                                    <span
                                        class=" bg-no-repeat text-white px-6 py-2 text-md flex items-center justify-center"
                                        style="background-image: url('{{ asset('catalog/img/promo_tag.png') }}'); background-size: 100% 100%;">
                                        {{ $promo->name_id }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-gray-500">No promos available.</span>
                            @endif
                        </div>
                        <div
                            class="text-[#52525B] text-base md:text-lg flex flex-col md:flex-row items-center justify-center md:justify-start pt-3">
                            <span class="font-poppins font-normal">{{ $product->price->prefix ?? '' }}</span>
                            <span class="px-2 md:px-3 font-poppins font-semibold text-2xl md:text-3xl text-[#52525b]">
                                @if ($product->price != null)
                                    {{ 'Rp' . $product->price->formatted_price ?? '' }}
                                @endif
                            </span>
                        </div>
                    </div>
                </div>


                <!-- Detail Section -->
                <!-- Detail Section -->
                <div class="md:ml-8 mt-8 border rounded-xl border-[#eeeef0] p-6">
                    <h5 class="font-poppins font-semibold text-xl text-black">Detail</h5>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 mt-4">
                        <div>
                            <p class="text-[#93949d] text-base font-normal">Proyek</p>
                            <div class="flex items-center space-x-2">
                                <img src="{{ asset('catalog/img/house-svgrepo-com 1.png') }}" class="w-8 h-8"
                                    alt="Icon" />
                                <span class="text-black font-medium">{{$product->propertyTypeName}}</span>
                            </div>
                        </div>

                        @if ($typeDetail->luas_bangunan)
                            <div>
                                <p class="text-[#93949d] text-base font-normal">Luas Bangunan</p>
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('catalog/img/webpack_svgrepo.com.png') }}" class="w-8 h-8"
                                        alt="Icon" />
                                    <span class="text-black font-medium">{{ $typeDetail->luas_bangunan }} m²</span>
                                </div>
                            </div>
                        @endif

                        @if ($typeDetail->bedroom || $typeDetail->bedroom_bonus)
                            <div>
                                <p class="text-[#93949d] text-base font-normal">Kamar Tidur</p>
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('catalog/img/surface 4.png') }}" class="w-8 h-8"
                                        alt="Icon" />
                                    <span class="text-black font-medium">
                                        {{ $typeDetail->bedroom }} @if ($typeDetail->bedroom_bonus > 0)
                                            +{{ $typeDetail->bedroom_bonus }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        @endif

                        @if ($typeDetail->bathroom || $typeDetail->bathroom_bonus)
                            <div>
                                <p class="text-[#93949d] text-base font-normal">Kamar Mandi</p>
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('catalog/img/shower_svgrepo.com.png') }}" class="w-8 h-8"
                                        alt="Icon" />
                                    <span class="text-black font-medium">
                                        {{ $typeDetail->bathroom }} @if ($typeDetail->bathroom_bonus > 0)
                                            +{{ $typeDetail->bathroom_bonus }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        @endif

                        @if ($typeDetail->kitchen || $typeDetail->kitchen_bonus)
                            <div>
                                <p class="text-[#93949d] text-base font-normal">Dapur</p>
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('catalog/img/refrigerator_svgrepo.com.png') }}" class="w-8 h-8"
                                        alt="Icon" />
                                    <span class="text-black font-medium">{{ $typeDetail->kitchen }} @if ($typeDetail->kitchen_bonus > 0)
                                            +{{ $typeDetail->kitchen_bonus }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        @endif

                        @if ($typeDetail->floor)
                            <div>
                                <p class="text-[#93949d] text-base font-normal">Lantai</p>
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('catalog/img/stair 2.png') }}" class="w-8 h-8" alt="Icon" />
                                    <span class="text-black font-medium">{{ $typeDetail->floor }} Lantai</span>
                                </div>
                            </div>
                        @endif

                        @if ($typeDetail->electricity)
                            <div>
                                <p class="text-[#93949d] text-base font-normal">Listrik (Watt)</p>
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('catalog/img/lightning-bolt_svgrepo.com.png') }}"
                                        class="w-8 h-8" alt="Icon" />
                                    <span class="text-black font-medium">{{ $typeDetail->electricity }} Watt</span>
                                </div>
                            </div>
                        @endif

                        @if ($typeDetail->furnish != null)
                            <div>
                                <p class="text-[#93949d] text-base font-normal">Furnitur</p>
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('catalog/img/sofa_svgrepo.com.png') }}" class="w-8 h-8"
                                        alt="Icon" />
                                    <span class="text-black font-medium">{{ $typeDetail->furnish }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>





                <!-- Fasilitas Section -->
                <div class="md:ml-8 mt-8 border rounded-xl border-[#eeeef0] p-6">
                    <h5 class="font-poppins font-semibold text-xl text-black">Fasilitas
                        {{-- {{$product->propertyTypeName}} --}}
                    </h5>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 mt-4">
                        @forelse ($facilitiesTransaction as $facility)
                            <div class="relative flex items-center space-x-2 min-w-0 group">
                                <img src="{{ $facility->fasilitas->img_full_path }}" class="w-5 h-5"
                                    alt="{{ $facility->fasilitas->img_full_path }}" />
                                <span class="text-black font-medium truncate"
                                    title="{{ $facility->fasilitas->name }}">{{ $facility->fasilitas->name }}</span>
                            </div>
                        @empty
                            <div class="text-gray-500">No facilities available.</div>
                        @endforelse
                    </div>
                </div>

            </div>

            <!-- Right Section (Google Maps) -->
            <div class="w-full md:w-1/3 flex justify-center md:justify-end">
                <div class="w-full md:w-[400px] h-[400px] relative mt-5">
                    @if ($productInformationDetail?->map_embed_code)
                        {!! $productInformationDetail->map_embed_code !!}
                    @endif
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

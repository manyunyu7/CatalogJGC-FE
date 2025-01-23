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

    <!-- PhotoSwipe CSS -->
    <link rel="stylesheet" href="https://unpkg.com/photoswipe@5/dist/photoswipe.css">


    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link rel="stylesheet" href="{{ asset('catalog/catalog.css') }}" />
    <title>E-Catalog JGC</title>
</head>

<body class="">
    @include('catalog.components.navbar')

    <!-- Slideshow -->
    <section class="relative mx-auto w-full max-w-screen-lg overflow-hidden">
        <div class="slideshow-container w-full flex transition-transform duration-700 ease-in-out" id="slideshow">
            <!-- Banner 1 -->
            <div class="slide flex-shrink-0 w-full flex justify-center">
                <div class="image-wrapper">
                    <img src="{{ asset('catalog/img/baner/banner1.png') }}" alt="Banner 1"
                        class="object-cover rounded-b-3xl" />
                </div>
            </div>
            <!-- Banner 2 -->
            <div class="slide flex-shrink-0 w-full flex justify-center">
                <div class="image-wrapper">
                    <img src="{{ asset('catalog/img/baner/banner2.png') }}" alt="Banner 2"
                        class="object-cover rounded-b-3xl" />
                </div>
            </div>
            <!-- Banner 3 -->
            <div class="slide flex-shrink-0 w-full flex justify-center">
                <div class="image-wrapper">
                    <img src="{{ asset('catalog/img/baner/banner3.png') }}" alt="Banner 3"
                        class="object-cover rounded-b-3xl" />
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-14">
        <div class="container mx-auto text-center space-y-2">
            <!-- Judul -->
            <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-[35px] font-semibold font-poppins">#GoodLifeMatters</h2>
            <!-- Deskripsi -->
            <p class="text-lg sm:text-xl md:text-2xl lg:text-[30px] font-medium font-poppins">Temukan Properti Impian
                Anda</p>
        </div>
    </section>

    <!-- Search Section -->
    <section class="container mx-auto py-3 px-4">
        <div class="filter flex flex-wrap gap-4 justify-between">
            <!-- Search Input -->
            <div class="search flex flex-col w-full sm:w-1/2 md:w-1/4">
                <label class="text-black font-medium font-poppins mb-2" for="search">Cari</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <img src="{{ asset('catalog/img/search.png') }}" alt="Search Icon" class="w-[24px] h-[24px]" />
                    </span>
                    <input type="text" id="search" placeholder="Masukkan nama proyek atau cluster"
                        class="w-full border border-gray-300 rounded-md pl-10 pr-4 py-2 focus:outline-none focus:border-green-600 focus:ring-1 focus:ring-green-600" />
                </div>
            </div>

            <!-- Proyek Dropdown -->
            <div class="proyek flex flex-col w-full sm:w-1/3 md:w-1/5">
                <label class="text-black font-medium mb-2 font-poppins" for="proyek">Proyek</label>
                <div class="relative border border-black rounded-md">
                    <!-- Span for Icon and Background -->
                    <span class="absolute inset-y-0 left-0 flex items-center px-2 py-2 bg-cari rounded-l-md">
                        <img src="{{ asset('catalog/img/proyek.png') }}" alt="Proyek Icon" class="w-5 h-5" />
                    </span>
                    <!-- Dropdown Button -->
                    <button id="dropdownProyek"
                        class="font-poppins inline-flex justify-between w-full px-4 py-2 text-black text-sm rounded-md focus:outline-none shadow-md">
                        <span id="dropdownTextProyek" class="pl-8">Semua Proyek</span>
                        <svg id="dropdownIconProyek"
                            class="w-4 h-4 ml-2 mt-1 transform transition-transform duration-300"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <!-- Dropdown Menu -->
                    <ul id="dropdownMenuProyek"
                        class="absolute right-0 mt-2 w-full bg-white border border-gray-300 rounded-md shadow-lg opacity-0 invisible transition-opacity duration-300 z-50">
                        <li class="px-4 py-2 text-black hover:bg-cari hover:text-white cursor-pointer"
                            data-value="Semua Proyek">Semua Proyek</li>
                        <li class="px-4 py-2 text-black hover:bg-cari hover:text-white cursor-pointer"
                            data-value="Perumahan">Perumahan</li>
                        <li class="px-4 py-2 text-black hover:bg-cari hover:text-white cursor-pointer"
                            data-value="Apartemen">Apartemen</li>
                        <li class="px-4 py-2 text-black hover:bg-cari hover:text-white cursor-pointer"
                            data-value="Komersil">Komersil</li>
                    </ul>
                </div>
            </div>

            <!-- Rentang Harga Dropdown -->
            <div class="harga flex flex-col w-full sm:w-1/3 md:w-1/5">
                <label class="text-black font-medium mb-2 font-poppins" for="harga">Rentang Harga</label>
                <div class="relative border border-black rounded-md">
                    <span class="absolute inset-y-0 left-0 flex items-center">
                        <span
                            class="text-white font-semibold absolute inset-y-0 left-0 flex items-center px-2 py-2 bg-cari rounded-l-md">Rp</span>
                    </span>
                    <button id="dropdownHarga"
                        class="font-poppins inline-flex justify-between w-full px-4 py-2 text-black text-sm rounded-md focus:outline-none shadow-md">
                        <span id="dropdownTextHarga" class="pl-8">Rentang Harga</span>
                        <svg id="dropdownIconHarga"
                            class="w-4 h-4 ml-2 mt-1 transform transition-transform duration-300"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <ul id="dropdownMenuHarga"
                        class="absolute right-0 mt-2 w-full bg-white border border-gray-300 rounded-md shadow-lg opacity-0 invisible transition-opacity duration-300 z-50">
                        <li class="px-4 py-2 text-black hover:bg-cari hover:text-white cursor-pointer"
                            data-value="Rentang Harga">Rentang Harga</li>
                        <li class="px-4 py-2 text-black hover:bg-cari hover:text-white cursor-pointer"
                            data-value="Rp < 2M">Rp &lt; 2M</li>
                        <li class="px-4 py-2 text-black hover:bg-cari hover:text-white cursor-pointer"
                            data-value="Rp 2M - 3M">Rp 2M - 3M</li>
                        <li class="px-4 py-2 text-black hover:bg-cari hover:text-white cursor-pointer"
                            data-value="Rp 3M - 4M">Rp 3M - 4M</li>
                        <li class="px-4 py-2 text-black hover:bg-cari hover:text-white cursor-pointer"
                            data-value="Rp > 4M">Rp &gt; 4M</li>
                    </ul>
                </div>
            </div>

            <!-- Luas Bangunan Dropdown -->
            <div class="bangunan flex flex-col w-full sm:w-1/3 md:w-1/5">
                <label class="text-black font-medium mb-2 font-poppins" for="luas">Luas Bangunan</label>
                <div class="relative border border-black rounded-md">
                    <!-- Span for Icon and Background -->
                    <span class="absolute inset-y-0 left-0 flex items-center px-2 py-2 bg-cari rounded-l-md">
                        <img src="{{ asset('catalog/img/luasbangunan.png') }}" alt="Luas Bangunan Icon"
                            class="w-5 h-5" />
                    </span>
                    <!-- Dropdown Button -->
                    <button id="dropdownBangunan"
                        class="font-poppins inline-flex justify-between w-full px-4 py-2 text-black text-sm rounded-md focus:outline-none shadow-md">
                        <span id="dropdownTextBangunan" class="pl-8">Luas Bangunan</span>
                        <svg id="dropdownIconBangunan"
                            class="w-4 h-4 ml-2 mt-1 transform transition-transform duration-300"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <!-- Dropdown Menu -->
                    <ul id="dropdownMenuBangunan"
                        class="absolute right-0 mt-2 w-full bg-white border border-gray-300 rounded-md shadow-lg opacity-0 invisible transition-opacity duration-300 z-50">
                        <li class="px-4 py-2 text-black hover:bg-cari hover:text-white cursor-pointer"
                            data-value="Luas Bangunan">Luas Bangunan</li>
                        <li class="px-4 py-2 text-black hover:bg-cari hover:text-white cursor-pointer"
                            data-value="0 m2 - 60 m2">0 m2 - 60 m2</li>
                        <li class="px-4 py-2 text-black hover:bg-cari hover:text-white cursor-pointer"
                            data-value="61 m2 - 80 m2">61 m2 - 80 m2</li>
                        <li class="px-4 py-2 text-black hover:bg-cari hover:text-white cursor-pointer"
                            data-value="81 m2 - 120 m2">81 m2 - 120 m2</li>
                        <li class="px-4 py-2 text-black hover:bg-cari hover:text-white cursor-pointer"
                            data-value="121 m2 - 200 m2">121 m2 - 200 m2</li>
                    </ul>
                </div>
            </div>

            <!-- Search Button -->
            <div class="button search flex flex-col w-full sm:w-1/3 md:w-[120px] md:justify-end">
                <button
                    class="font-poppins bg-cari text-white font-bold py-2 px-6 rounded-md hover:bg-green-600 transition-colors w-full">Cari</button>
            </div>
        </div>
    </section>

    <section class="container mx-auto py-10 px-4">
        <div class="resultrelevansi flex justify-between items-center">
            <!-- Bagian kiri -->
            <div class="text-black">
                <span class="text-[16px] font-medium font-poppins"> Showing <span id="total-results"
                        class="text-gray-500 font-medium text-[16px]">0</span> Results </span>
            </div>

            <div class="relative inline-block text-left">
                <!-- Tombol Dropdown -->
                <button id="dropdownRelevansi"
                    class="font-poppins inline-flex justify-between items-center w-[223px] h-[42px] px-4 py-2 text-white bg-cari text-[16px] rounded-md focus:outline-none shadow-md">
                    <!-- Ikon Filter -->
                    <img src="img/filter.png" alt="" class="w-[14px] h-[14px]" />
                    <span id="dropdownTextRelevansi">Relevansi</span>
                    <!-- Teks di sini akan berubah -->
                    <!-- Ikon Panah ke Bawah -->
                    <svg id="dropdownIconRelevansi" class="w-4 h-4 ml-2 transform transition-transform duration-300"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <ul id="dropdownMenuRelevansi"
                    class="absolute right-0 mt-2 w-56 bg-white border border-gray-300 rounded-md shadow-lg opacity-0 invisible transition-opacity duration-300 z-50">
                    <li class="px-4 py-2 rounded-md text-black hover:bg-cari font-poppins hover:text-white cursor-pointer"
                        data-value="Relevansi">Relevansi</li>
                    <li class="px-4 py-2 rounded-md text-black hover:bg-cari font-poppins hover:text-white cursor-pointer"
                        data-value="Harga Tertinggi">Harga Tertinggi</li>
                    <li class="px-4 py-2 rounded-md text-black hover:bg-cari font-poppins hover:text-white cursor-pointer"
                        data-value="Harga Terendah">Harga Terendah</li>
                </ul>
            </div>
        </div>
    </section>

    <div
        class="produk card-container container mx-auto px-4 py-8 grid gap-6 grid-cols-3 xa:grid-cols-1 xb:grid-cols-1 xc:grid-cols-1 xd:grid-cols-1 xe:grid-cols-1 xs:grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
        @foreach ($products as $item)
            <div class="relative card" data-category="Apartemen" data-price="1200000000" data-harga="1200000000"
                data-luas="23">
                <!-- Banner Promo -->
                <div class="absolute top-[-6px] right-0 mr-[-7px] z-10">
                    <img src="{{ asset('catalog/img/promo.png') }}" alt="Promo" class="w-[100px] h-[100px]" />
                </div>
                <div
                    class="slider-card relative bg-white border-[1px] dark:border-gray-700 border-gray-200 rounded-[21.23px] shadow w-full h-auto overflow-hidden">
                    <!-- Gambar Utama -->
                    <div class="flex transition-transform duration-300" id="slide-wrapper-{{ $loop->iteration }}">
                        @foreach ($item->images as $image)
                            <div class="flex-shrink-0">
                                <img class="w-full h-48 object-cover sm:h-56" src="{{ $image['full_image_path'] }}"
                                    alt="" />
                            </div>
                        @endforeach

                    </div>

                    <!-- Left Button -->
                    <button class="absolute left-2 transform -translate-y-32 p-2" id="prev-btn-1">
                        <img src="{{ asset('catalog/img/Left.png') }}" alt="Left" class="w-8 h-8" />
                    </button>

                    <!-- Right Button -->
                    <button class="absolute right-2 transform -translate-y-32 p-2" id="next-btn-1">
                        <img src="{{ asset('catalog/img/Right.png') }}" alt="Right" class="w-8 h-8" />
                    </button>

                    <!-- Konten Card -->
                    <div class="p-4">
                        <a href="page1.html">
                            <h5 class="text-2xl font-poppins font-semibold text-[#545454] truncate">
                                {{ $item->parent_name }} -
                                {{ $item->category_name }}
                            </h5>
                        </a>
                        <div class="flex items-center gap-2 mt-2 overflow-hidden">
                            <span
                                class="truncate px-3 py-1 font-poppins font-normal text-sm text-[#545454] border-[#545454] border-[0.99px] rounded-xl text-[clamp(10px, 1vw, 14px)]">
                                Apartemen </span>
                            <span
                                class="truncate px-3 py-1 font-poppins font-normal text-sm text-[#545454] border-[#545454] border-[0.99px] rounded-xl text-[clamp(10px, 1vw, 14px)]">
                                LB: 23 m² </span>
                        </div>
                        <div class="flex items-center space-x-4 mt-4">
                            <div class="flex items-center">
                                <img src="{{ asset('catalog/img/surface 4.png') }}" class="w-6 h-6 sm:w-8 sm:h-8" />
                                <span class="ml-1 truncate text-sm">0</span>
                            </div>
                            <div class="flex items-center">
                                <img src="{{ asset('catalog/img/bath_svgrepo.com.png') }}"
                                    class="w-6 h-6 sm:w-8 sm:h-8" />
                                <span class="ml-1 truncate text-sm">1</span>
                            </div>
                            <div class="flex items-center">
                                <img src="{{ asset('catalog/img/stair 2.png') }}" class="w-6 h-6 sm:w-8 sm:h-8" />
                                <span class="ml-1 truncate text-sm">1 - 10</span>
                            </div>
                            <div class="flex items-center">
                                <img src="{{ asset('catalog/img/sofa_svgrepo.com.png') }}"
                                    class="w-6 h-6 sm:w-8 sm:h-8" />
                                <span class="ml-1 truncate text-sm">1</span>
                            </div>
                            <div class="flex items-center">
                                <img src="{{ asset('catalog/img/refrigerator_svgrepo.com.png') }}"
                                    class="w-6 h-6 sm:w-8 sm:h-8" />
                                <span class="ml-1 truncate text-sm">1</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 border-t border-slate-950 flex items-center justify-between">
                        <span class="text-sm font-poppins font-normal text-[#545454]">Mulai dari</span>
                        <span class="text-2xl font-poppins font-semibold text-[#4f935f]">Rp 1.200.000.000</span>
                    </div>
                </div>
            </div>
        @endforeach


    </div>


    <div class="flex justify-center items-center gap-4 mt-12">
        <button id="view-more-btn"
            class="hidden px-4 py-2 bg-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-400 transition-all duration-200">
            View More
        </button>
        <button id="prev-btn"
            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-400 transition-all duration-200"
            disabled>
            Prev
        </button>
        <div id="page-numbers" class="flex gap-2"></div>
        <button id="next-btn"
            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-400 transition-all duration-200">
            Next
        </button>
    </div>
    <!-- Footer Section -->
    @include('catalog.components.footer')


    <script src="{{ asset('catalog/catalog.js') }}"></script>
</body>

</html>

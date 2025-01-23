<footer class="w-full mt-12 bg-gray-100">
    <!-- Background Wrapper -->
    <div class="absolute inset-0">
        <img class="w-full h-full object-cover" src="{{ asset('catalog/img/Background.jpg') }}" alt="Background Image" />
    </div>

    <!-- Footer Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-6 py-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Logo Section -->
            <div class="flex justify-center md:justify-start">
                <img src="{{ asset('catalog/img/jgc.png') }}" alt="Jakarta Garden City Logo" class="w-[220px] h-[136px]">
            </div>

            <!-- Contact Information -->
            <div>
                <h3 class="text-[#05864d] text-lg font-semibold mb-4">Hubungi Kami</h3>
                <ul class="space-y-4">
                    <li class="flex items-center space-x-4">
                        <img src="{{ asset('catalog/img/hubungi/alamat.png') }}" alt="Alamat" class="w-5 h-5">
                        <span class="text-gray-700 text-sm">Jl. Raya Cakung Clincing Km 0.5</span>
                    </li>
                    <li class="flex items-center space-x-4">
                        <img src="{{ asset('catalog/img/hubungi/call.png') }}" alt="Call" class="w-5 h-5">
                        <span class="text-gray-700 text-sm">(021) 4683 8888</span>
                    </li>
                    <li class="flex items-center space-x-4">
                        <img src="{{ asset('catalog/img/hubungi/whatsapp.png') }}" alt="WhatsApp" class="w-5 h-5">
                        <span class="text-gray-700 text-sm">0813 8888 4446</span>
                    </li>
                    <li class="flex items-center space-x-4">
                        <img src="{{ asset('catalog/img/hubungi/mail.png') }}" alt="Mail" class="w-5 h-5">
                        <span class="text-gray-700 text-sm">Sales.jgc@modernland.co.id</span>
                    </li>
                </ul>
            </div>

            <!-- Social Media Links -->
            <div>
                <h3 class="text-[#05864d] text-lg font-semibold mb-4">Social Media</h3>
                <ul class="space-y-4">
                    <li class="flex items-center space-x-4">
                        <img src="{{ asset('catalog/img/socmed/facebook_footer.png') }}" alt="Facebook" class="w-5 h-5">
                        <span class="text-gray-700 text-sm">Jakarta Garden City</span>
                    </li>
                    <li class="flex items-center space-x-4">
                        <img src="{{ asset('catalog/img/socmed/ig_footer.png') }}" alt="Instagram" class="w-5 h-5">
                        <span class="text-gray-700 text-sm">@jakartagardencity</span>
                    </li>
                    <li class="flex items-center space-x-4">
                        <img src="{{ asset('catalog/img/socmed/tk_footer.png') }}" alt="TikTok" class="w-5 h-5">
                        <span class="text-gray-700 text-sm">@official_jgc</span>
                    </li>
                    <li class="flex items-center space-x-4">
                        <img src="{{ asset('catalog/img/socmed/yt_footer.png') }}" alt="YouTube" class="w-5 h-5">
                        <span class="text-gray-700 text-sm">jakartagardencityofficial</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Footer Divider and Copyright -->
        <div class="border-t border-gray-300 mt-8 pt-6 text-center">
            <p class="text-sm text-gray-600">&copy; 2024 Jakarta Garden City owned by PT Modernland Realty Tbk</p>
        </div>
    </div>

    <!-- Decorative Ribbon -->
    <div class="relative">
        <img class="w-full h-auto object-contain" src="{{ asset('catalog/img/Pita.png') }}" alt="Bottom Overlay">
    </div>
</footer>

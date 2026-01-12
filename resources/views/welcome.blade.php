<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>KOSTKU - Hunian Kotak Modern</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600,700,900&display=swap" rel="stylesheet" />
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            /* Area Biru Kotak */
            .blue-bg-box {
                background-color: #4338ca;
                position: absolute;
                right: 0;
                top: 0;
                bottom: 0;
                width: 49%;
                z-index: 10;
            }

            @media (max-width: 1024px) {
                .blue-bg-box { width: 100%; opacity: 0.95; }
            }

            /* Swiper Navigation Custom */
            .swiper-button-next, .swiper-button-prev {
                color: white !important;
                background: rgba(0,0,0,0.5);
                width: 45px !important;
                height: 45px !important;
                border-radius: 20px;
                opacity: 0;
                transition: all 0.3s ease;
            }
            .swiper-button-next::after, .swiper-button-prev::after { font-size: 16px !important; }
            .mySwiper:hover .swiper-button-next, .mySwiper:hover .swiper-button-prev { opacity: 1; }
            
            .swiper-pagination-bullet-active { background: white !important; width: 30px !important; border-radius: 5px; }
        </style>
    </head>
    <body class="antialiased font-sans bg-white overflow-x-hidden">
        
        <div class="relative min-h-screen w-full flex flex-col">
            
            <div class="fixed inset-0 z-0">
                <img src="{{ asset('images/kamar.jpeg') }}" class="w-full h-full object-cover" alt="Background">
                <div class="absolute inset-0 bg-white/50 backdrop-blur-[8px]"></div>
            </div>

            <div class="blue-bg-box shadow-[-10px_0_30px_rgba(0,0,0,0.1)]"></div>

            <div class="relative z-30 flex flex-col min-h-screen">
                
                <nav class="flex items-center justify-between px-10 py-8">
                    <div class="text-2xl font-black text-slate-900 tracking-tighter">
                        KOST<span class="text-indigo-600">KU</span>
                    </div>
                </nav>

                <div class="flex-grow flex items-center">
                    <div class="container mx-auto px-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        
                        <div class="max-w-xl py-10">
                            <h1 class="text-7xl font-black text-slate-900 leading-tight mb-6">
                                Hunian<br><span class="text-indigo-600">Pilihan.</span>
                            </h1>
                            <p class="text-slate-600 font-medium text-xl mb-10 leading-relaxed">
                                Temukan kenyamanan maksimal dengan pilihan kamar kost terbaik yang cocok untuk Anda.
                            </p>
                            <a href="{{ route('login') }}" class="inline-block px-14 py-5 bg-pink-500 hover:bg-pink-600 text-white text-sm font-black uppercase tracking-widest rounded-xl transition-all shadow-xl shadow-pink-200 hover:-translate-y-1">
                                MULAI CARI SEKARANG
                            </a>
                        </div>

                        <div class="relative h-[500px] w-full lg:pl-10">
                            <div class="swiper mySwiper h-full w-full rounded-3xl overflow-hidden shadow-2xl">
                                <div class="swiper-wrapper">
                                    
                                    <div class="swiper-slide relative">
                                        <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?q=80&w=2070" class="w-full h-full object-cover">
                                        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent p-10">
                                            <h3 class="text-white text-2xl font-bold mb-2">Ingin kos dengan pilihan bagus?</h3>
                                            <p class="text-gray-300">Nikmati fasilitas premium dengan harga terjangkau.</p>
                                        </div>
                                    </div>

                                    <div class="swiper-slide relative">
                                        <img src="https://images.unsplash.com/photo-1598928506311-c55ded91a20c?q=80&w=2070" class="w-full h-full object-cover">
                                        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent p-10">
                                            <h3 class="text-white text-2xl font-bold mb-2">Ruang Bersih & Nyaman</h3>
                                            <p class="text-gray-300">Standar kebersihan tinggi untuk kesehatan Anda.</p>
                                        </div>
                                    </div>

                                </div>

                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            var swiper = new Swiper(".mySwiper", {
                loop: true,
                speed: 1000,
                autoplay: { delay: 5000 },
                navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
                pagination: { el: ".swiper-pagination", clickable: true },
            });
        </script>
    </body>
</html>
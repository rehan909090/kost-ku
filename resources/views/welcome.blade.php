<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KOSTKU</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Elemen Background Biru Sisi Kanan - SEKARANG MELENGKUNG ATAS & BAWAH */
        .blue-bg-box {
            background: linear-gradient(135deg, #4338ca 0%, #312e81 100%);
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 45%;
            z-index: 10;
            /* Lengkungan di pojok kiri atas dan kiri bawah */
            border-top-left-radius: 120px; 
            border-bottom-left-radius: 120px;
        }

        @media (max-width: 1024px) {
            .blue-bg-box { 
                width: 100%; 
                opacity: 0.98; 
                border-top-left-radius: 0; 
                border-bottom-left-radius: 0; 
            }
        }

        /* Swiper Navigation Custom */
        .swiper-button-next, .swiper-button-prev {
            color: white !important;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            width: 50px !important;
            height: 50px !important;
            border-radius: 50%;
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        .swiper-button-next:hover, .swiper-button-prev:hover {
            background: #ec4899;
            border-color: transparent;
        }

        .swiper-button-next::after, .swiper-button-prev::after { font-size: 18px !important; font-weight: bold; }
        
        .swiper-pagination-bullet { background: rgba(255,255,255,0.5) !important; opacity: 1; }
        .swiper-pagination-bullet-active { background: #ec4899 !important; width: 30px !important; border-radius: 5px; }

        .fade-up {
            animation: fadeUp 1s ease-out forwards;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="antialiased font-sans bg-slate-50 overflow-x-hidden">
    
    <div class="relative min-h-screen w-full flex flex-col">
        
        <div class="fixed inset-0 z-0">
            <img src="{{ asset('images/kamar.jpeg') }}" class="w-full h-full object-cover" alt="Background">
            <div class="absolute inset-0 bg-white/60 backdrop-blur-md"></div>
        </div>

        <div class="blue-bg-box shadow-2xl"></div>

        <div class="relative z-30 flex flex-col min-h-screen">
            
            <nav class="flex items-center justify-between px-8 lg:px-16 py-8">
                <div class="text-3xl font-black text-slate-900 tracking-tighter">
                    KOST<span class="text-indigo-600">KU</span>
                </div>
            </nav>

            <div class="flex-grow flex items-center">
                <div class="container mx-auto px-8 lg:px-16 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    
                    <div class="max-w-xl py-10 fade-up">
                        <span class="inline-block px-4 py-1.5 mb-6 text-xs font-black tracking-[0.2em] text-white bg-indigo-600 rounded-full uppercase">
                            Premium Living Experience
                        </span>
                        <h1 class="text-6xl lg:text-8xl font-black text-slate-900 leading-[1.1] mb-8">
                            Kost<br><span class="text-indigo-600">Ku.</span>
                        </h1>
                        <p class="text-slate-500 font-medium text-lg lg:text-xl mb-12 leading-relaxed max-w-md">
                            Temukan kamar kost impian Anda dengan fasilitas modern, lingkungan aman, dan harga yang transparan.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-10 py-5 bg-pink-500 hover:bg-pink-600 text-white text-sm font-black uppercase tracking-widest rounded-2xl transition-all shadow-2xl shadow-pink-200 hover:-translate-y-1 active:scale-95">
                                Cari Kamar Sekarang
                            </a>
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-10 py-5 bg-white border-2 border-slate-200 text-slate-900 text-sm font-black uppercase tracking-widest rounded-2xl transition-all hover:bg-slate-50 hover:border-indigo-600 active:scale-95">
                                Daftar Akun
                            </a>
                        </div>
                    </div>

                    <div class="relative h-[450px] lg:h-[550px] w-full fade-up lg:translate-x-24" style="animation-delay: 0.2s;">
                        <div class="swiper mySwiper h-full w-full rounded-[2.5rem] overflow-hidden shadow-[0_50px_100px_-20px_rgba(0,0,0,0.5)]">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide relative">
                                    <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?q=80&w=2070" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent p-12 flex flex-col justify-end">
                                        <h3 class="text-white text-3xl font-extrabold mb-3">Premium Loft</h3>
                                        <p class="text-gray-300 font-medium italic">Kenyamanan hotel bintang lima dalam kamar kost Anda.</p>
                                    </div>
                                </div>
                                <div class="swiper-slide relative">
                                    <img src="https://images.unsplash.com/photo-1598928506311-c55ded91a20c?q=80&w=2070" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent p-12 flex flex-col justify-end">
                                        <h3 class="text-white text-3xl font-extrabold mb-3">Modern Studio</h3>
                                        <p class="text-gray-300 font-medium italic">Didesain khusus untuk produktivitas dan istirahat maksimal.</p>
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
            grabCursor: true,
            speed: 1200,
            parallax: true,
            autoplay: { delay: 4500, disableOnInteraction: false },
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
            pagination: { el: ".swiper-pagination", clickable: true },
        });
    </script>
</body>
</html>
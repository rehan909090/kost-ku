<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail & Fasilitas Kamar') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6">
                <a href="{{ route('customer.dashboard') }}" class="text-indigo-600 hover:text-indigo-800 font-bold flex items-center gap-2 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar Kamar
                </a>
            </div>

            <div class="bg-white shadow-2xl rounded-3xl overflow-hidden border border-gray-100">
                
                <div class="h-96 bg-gray-200 relative group">
                    @if($kamar->foto_kamar)
                        <img src="{{ asset('storage/' . $kamar->foto_kamar) }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                            <svg class="w-16 h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="font-medium">Foto Belum Diunggah</span>
                        </div>
                    @endif
                    <div class="absolute bottom-6 left-6">
                        <span class="bg-indigo-600/90 backdrop-blur-md text-white px-6 py-2 rounded-2xl text-xs font-black uppercase tracking-[0.2em] shadow-2xl">
                            Tipe {{ $kamar->tipe }}
                        </span>
                    </div>
                </div>

                <div class="p-8 md:p-12">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 border-b border-gray-100 pb-8 gap-4">
                        <div>
                            <h1 class="text-5xl font-black text-gray-900 tracking-tighter">Kamar {{ $kamar->nomor_kamar }}</h1>
                            <p class="text-gray-500 mt-2 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                Tersedia untuk dihuni segera
                            </p>
                        </div>
                        <div class="bg-indigo-50 p-6 rounded-3xl border border-indigo-100 w-full md:w-auto text-center md:text-right">
                            <p class="text-xs text-indigo-400 uppercase font-black tracking-widest mb-1">Harga Sewa</p>
                            <p class="text-4xl font-black text-indigo-600">
                                Rp {{ number_format($kamar->harga_per_bulan, 0, ',', '.') }}
                                <span class="text-sm text-indigo-400 font-medium tracking-normal">/ bln</span>
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <div class="space-y-6">
                            <div class="bg-slate-50 p-6 rounded-3xl border border-slate-100">
                                <h3 class="text-sm font-black text-slate-800 mb-5 uppercase tracking-widest flex items-center gap-2">
                                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    Spesifikasi Kamar
                                </h3>
                                <ul class="space-y-4">
                                    <li class="flex justify-between items-center text-sm">
                                        <span class="text-gray-500 font-medium">Ukuran Luas</span>
                                        <span class="text-gray-900 font-bold bg-white px-3 py-1 rounded-lg shadow-sm">{{ $kamar->ukuran ?? '3x4 m' }}</span>
                                    </li>
                                    <li class="flex justify-between items-center text-sm">
                                        <span class="text-gray-500 font-medium">Fasilitas Mandi</span>
                                        <span class="text-gray-900 font-bold bg-white px-3 py-1 rounded-lg shadow-sm">{{ $kamar->kamar_mandi ?? 'Dalam' }}</span>
                                    </li>
                                    <li class="flex justify-between items-center text-sm">
                                        <span class="text-gray-500 font-medium">Token Listrik</span>
                                        <span class="text-gray-900 font-bold bg-white px-3 py-1 rounded-lg shadow-sm">{{ $kamar->listrik ?? 'Termasuk' }}</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="p-6">
                                <h3 class="text-sm font-black text-red-600 mb-4 uppercase tracking-widest">🛡️ Keamanan</h3>
                                <div class="flex flex-wrap gap-2">
                                    @if($kamar->keamanan)
                                        @foreach(explode(',', $kamar->keamanan) as $aman)
                                            <span class="text-xs font-bold text-gray-700 bg-red-50 px-3 py-2 rounded-lg border border-red-100">
                                                {{ trim($aman) }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="text-xs text-gray-400 italic">Standar Keamanan Kost</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="space-y-8">
                            <div>
                                <h3 class="text-sm font-black text-emerald-600 mb-4 uppercase tracking-widest">✨ Fasilitas Kamar</h3>
                                <div class="flex flex-wrap gap-3">
                                    @if($kamar->fasilitas)
                                        @foreach(explode(',', $kamar->fasilitas) as $fasil)
                                            <span class="bg-emerald-50 text-emerald-700 px-4 py-2 rounded-2xl text-xs font-bold border border-emerald-100 flex items-center gap-2">
                                                <svg class="w-3 h-3 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                                {{ trim($fasil) }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="text-xs text-gray-400 italic">Fasilitas standar lengkap</span>
                                    @endif
                                </div>
                            </div>

                            <div class="bg-amber-50 p-6 rounded-3xl border border-amber-100">
                                <h3 class="text-sm font-black text-amber-700 mb-4 uppercase tracking-widest flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    Akses Lokasi
                                </h3>
                                <div class="space-y-2">
                                    @if($kamar->lokasi_akses)
                                        @foreach(explode(',', $kamar->lokasi_akses) as $lokasi)
                                            <p class="text-sm text-amber-900 font-medium flex items-start gap-2">
                                                <span class="mt-1 w-1.5 h-1.5 rounded-full bg-amber-400 shrink-0"></span>
                                                {{ trim($lokasi) }}
                                            </p>
                                        @endforeach
                                    @else
                                        <p class="text-xs text-amber-600/60 italic">Lokasi strategis dekat jalan utama</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-16 relative">
                        <div class="absolute inset-0 bg-indigo-600 rounded-[2.5rem] rotate-1 scale-[1.02] opacity-10"></div>
                        <div class="relative bg-gray-900 rounded-[2.5rem] p-8 md:p-12 flex flex-col md:flex-row justify-between items-center shadow-2xl overflow-hidden">
                            <div class="absolute -top-24 -left-24 w-64 h-64 bg-indigo-500 rounded-full blur-[100px] opacity-20"></div>
                            
                            <div class="text-center md:text-left mb-8 md:mb-0 relative z-10">
                                <h2 class="text-white text-3xl font-black tracking-tight mb-2">Siap untuk memesan?</h2>
                                <p class="text-gray-400 text-base max-w-sm">Pastikan Anda telah menyetujui syarat & ketentuan sewa di kost kami.</p>
                            </div>
                            
                            <a href="{{ route('customer.pesan.create', $kamar->id) }}" class="group relative z-10 w-full md:w-auto bg-indigo-500 hover:bg-indigo-400 text-white font-black py-5 px-14 rounded-2xl transition duration-300 transform hover:-translate-y-1 shadow-[0_20px_50px_rgba(79,70,229,0.3)] text-center uppercase tracking-[0.1em] flex items-center justify-center gap-3">
                                Booking Kamar Ini
                                <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail & Fasilitas Kamar') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
                
                <div class="h-80 bg-gray-200 relative">
                    @if($kamar->foto_kamar)
                        <img src="{{ asset('storage/' . $kamar->foto_kamar) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <span>Foto tidak tersedia</span>
                        </div>
                    @endif
                    <div class="absolute bottom-4 left-6">
                        <span class="bg-indigo-600 text-white px-6 py-2 rounded-full text-sm font-bold shadow-lg uppercase tracking-widest">
                            Tipe {{ $kamar->tipe }}
                        </span>
                    </div>
                </div>

                <div class="p-8">
                    <div class="flex justify-between items-center mb-8 border-b pb-6">
                        <h1 class="text-4xl font-extrabold text-gray-900">Kamar {{ $kamar->nomor_kamar }}</h1>
                        <div class="text-right">
                            <p class="text-sm text-gray-500 uppercase font-bold tracking-tighter">Harga Sewa</p>
                            <p class="text-3xl font-black text-indigo-600">Rp {{ number_format($kamar->harga_per_bulan) }}<span class="text-sm text-gray-400 font-normal">/bulan</span></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        
                        <div class="bg-indigo-50 p-6 rounded-2xl border border-indigo-100">
                            <h3 class="text-lg font-bold text-indigo-800 mb-4 flex items-center italic">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Elemen Wajib & Penting
                            </h3>
                            <ul class="space-y-3 text-gray-700">
                                <li class="flex justify-between border-b border-indigo-200 pb-1">
                                    <span class="font-medium">Ukuran Kamar</span>
                                    <span class="text-gray-900 font-bold">{{ $kamar->ukuran ?? '-' }}</span>
                                </li>
                                <li class="flex justify-between border-b border-indigo-200 pb-1">
                                    <span class="font-medium">Kamar Mandi</span>
                                    <span class="text-gray-900 font-bold">{{ $kamar->kamar_mandi ?? '-' }}</span>
                                </li>
                                <li class="flex justify-between border-b border-indigo-200 pb-1">
                                    <span class="font-medium">Sistem Listrik</span>
                                    <span class="text-gray-900 font-bold">{{ $kamar->listrik ?? '-' }}</span>
                                </li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-green-700 mb-4 border-b pb-2 italic">Kenyamanan & Fasilitas</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach(explode(',', $kamar->fasilitas) as $fasil)
                                    <span class="bg-white border border-green-200 text-green-700 px-4 py-2 rounded-xl text-sm font-semibold shadow-sm">
                                        ✨ {{ trim($fasil) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <div class="bg-red-50 p-6 rounded-2xl border border-red-100">
                            <h3 class="text-lg font-bold text-red-800 mb-4 italic">Sistem Keamanan</h3>
                            <ul class="space-y-2 text-gray-700">
                                @if($kamar->keamanan)
                                    @foreach(explode(',', $kamar->keamanan) as $aman)
                                        <li class="flex items-center">
                                            <span class="text-red-500 mr-2">🛡️</span> {{ trim($aman) }}
                                        </li>
                                    @endforeach
                                @else
                                    <li class="text-gray-400 italic">Data keamanan belum tersedia</li>
                                @endif
                            </ul>
                        </div>

                        <div class="bg-yellow-50 p-6 rounded-2xl border border-yellow-100">
                            <h3 class="text-lg font-bold text-yellow-800 mb-4 italic">Lokasi & Akses</h3>
                            <ul class="space-y-2 text-gray-700">
                                @if($kamar->lokasi_akses)
                                    @foreach(explode(',', $kamar->lokasi_akses) as $lokasi)
                                        <li class="flex items-center">
                                            <span class="mr-2 text-yellow-600">📍</span> {{ trim($lokasi) }}
                                        </li>
                                    @endforeach
                                @else
                                    <li class="text-gray-400 italic">Data lokasi belum tersedia</li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="mt-12 bg-gray-900 rounded-2xl p-8 flex flex-col md:flex-row justify-between items-center shadow-2xl">
                        <div class="text-center md:text-left mb-6 md:mb-0">
                            <p class="text-white text-lg font-bold">Tertarik dengan kamar ini?</p>
                            <p class="text-gray-400 text-sm">Pastikan Anda telah membaca semua detail fasilitas di atas.</p>
                        </div>
                        <a href="{{ route('customer.pesan.create', $kamar->id) }}" class="w-full md:w-auto bg-indigo-500 hover:bg-indigo-400 text-white font-black py-4 px-12 rounded-xl transition duration-300 transform hover:scale-105 shadow-lg text-center uppercase tracking-widest">
                            Lanjut ke Pembayaran →
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
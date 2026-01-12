<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Status Sewa Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Alert Success/Error --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 font-medium rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if($sewaAktif)
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-indigo-100">
                    <div class="md:flex">
                        {{-- Bagian Foto Kamar --}}
                        <div class="md:w-1/3 relative h-64 md:h-auto">
                            <img src="{{ $sewaAktif->kamar->foto_kamar ? asset('storage/' . $sewaAktif->kamar->foto_kamar) : 'https://via.placeholder.com/600x400' }}" 
                                 class="absolute inset-0 h-full w-full object-cover" alt="Foto Kamar">
                        </div>

                        {{-- Bagian Detail --}}
                        <div class="p-8 md:w-2/3">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-3xl font-black text-slate-900 tracking-tight">Kamar {{ $sewaAktif->kamar->nomor_kamar }}</h3>
                                    <p class="text-indigo-600 font-bold text-lg uppercase tracking-wider">{{ $sewaAktif->kamar->tipe }}</p>
                                </div>
                                <span class="px-4 py-1.5 rounded-lg text-xs font-black uppercase tracking-widest {{ $sewaAktif->status_sewa == 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700 border border-orange-200' }}">
                                    {{ $sewaAktif->status_sewa }}
                                </span>
                            </div>

                            @php
                                // Menggunakan Carbon secara eksplisit untuk menjamin akurasi hari
                                $now = \Carbon\Carbon::now()->startOfDay();
                                $end = \Carbon\Carbon::parse($sewaAktif->tanggal_selesai)->startOfDay();
                                $diff = $now->diffInDays($end, false);
                                
                                // Jika sisa hari 0 tapi masih hari ini, tetap tampilkan 0 atau hari terakhir
                                $sisaHariDisplay = $diff > 0 ? $diff : 0;
                            @endphp

                            {{-- Card Sisa Hari --}}
                            <div class="mt-8 bg-gradient-to-br from-indigo-600 to-violet-700 p-7 rounded-2xl text-white shadow-xl shadow-indigo-200">
                                <div class="flex items-center justify-between flex-wrap gap-6">
                                    <div class="flex flex-col">
                                        <p class="text-indigo-100 text-xs font-bold uppercase tracking-widest opacity-80 mb-1">Sisa Waktu Tinggal</p>
                                        <h4 class="text-4xl font-black flex items-baseline gap-2">
                                            {{ $sisaHariDisplay }}
                                            <span class="text-xl font-medium text-indigo-100">Hari Lagi</span>
                                        </h4>
                                    </div>
                                    <div class="md:text-right">
                                        <p class="text-indigo-100 text-xs uppercase font-bold tracking-widest opacity-80 mb-1">Jatuh Tempo</p>
                                        <p class="text-xl font-extrabold italic">
                                            {{ \Carbon\Carbon::parse($sewaAktif->tanggal_selesai)->translatedFormat('d F Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Detail Tanggal --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8">
                                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                                    <p class="text-[10px] text-slate-400 uppercase font-black tracking-widest mb-2">Check-in</p>
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 bg-white rounded-lg shadow-sm">📅</div>
                                        <p class="font-bold text-slate-700">{{ \Carbon\Carbon::parse($sewaAktif->tanggal_masuk)->translatedFormat('d M Y') }}</p>
                                    </div>
                                </div>
                                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 border-l-4 border-l-indigo-500">
                                    <p class="text-[10px] text-slate-400 uppercase font-black tracking-widest mb-2">Check-out</p>
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 bg-white rounded-lg shadow-sm">🔑</div>
                                        <p class="font-bold text-slate-700">{{ \Carbon\Carbon::parse($sewaAktif->tanggal_selesai)->translatedFormat('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Action Button --}}
                            @if($sewaAktif->status_sewa == 'Aktif')
                            <div class="mt-10">
                                <form action="{{ route('customer.checkout', $sewaAktif->id) }}" method="POST" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin mengajukan berhenti sewa? Status Anda akan berubah menjadi Proses Keluar.')">
                                    @csrf
                                    <button type="submit" class="group w-full flex items-center justify-center gap-2 bg-white border-2 border-rose-500 text-rose-500 hover:bg-rose-500 hover:text-white font-black py-4 rounded-2xl transition-all duration-300 shadow-lg shadow-rose-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Ajukan Berhenti Sewa (Check Out)
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                {{-- Empty State --}}
                <div class="text-center bg-white py-20 px-10 rounded-3xl shadow-sm border-2 border-dashed border-slate-200">
                    <div class="bg-slate-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                        <img src="https://cdn-icons-png.flaticon.com/512/619/619153.png" class="w-12 h-12 grayscale opacity-40">
                    </div>
                    <h3 class="text-2xl font-black text-slate-800 tracking-tight">Kamu Belum Menyewa Kamar</h3>
                    <p class="text-slate-500 mt-3 mb-10 max-w-sm mx-auto leading-relaxed">
                        Coba lihat kamar impian kamu disini.
                    </p>
                    <a href="{{ route('customer.cari-kamar') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-10 py-4 rounded-2xl font-black shadow-xl shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-1 transition-all">
                        Cari Kamar Sekarang
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
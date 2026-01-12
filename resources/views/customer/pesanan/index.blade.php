<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Sewa Saya') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm flex items-center justify-between">
                    <div>
                        <p class="font-bold">Berhasil</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-green-700 font-bold">&times;</button>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                <div class="flex items-center justify-between mb-6 border-b pb-4">
                    <h3 class="text-lg font-bold text-gray-700">Daftar Transaksi</h3>
                    <span class="text-sm text-gray-500">{{ $transaksis->count() }} Transaksi ditemukan</span>
                </div>

                <div class="space-y-4">
                    @forelse($transaksis as $t)
                        <div class="border rounded-xl p-6 flex flex-col md:flex-row justify-between items-center hover:shadow-md transition-all duration-200 bg-white border-gray-100">
                            
                            <div class="flex items-center gap-6">
                                <div class="bg-indigo-600 p-4 rounded-xl text-white font-bold text-xl shadow-lg shadow-indigo-100">
                                    #{{ $t->kamar->nomor_kamar ?? '?' }}
                                </div>
                                <div>
                                    <p class="text-xs text-indigo-500 font-bold uppercase tracking-widest">{{ $t->kamar->tipe ?? 'Tipe Tidak Diketahui' }}</p>
                                    <p class="text-2xl font-black text-gray-900">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</p>
                                    <p class="text-xs text-gray-500 flex items-center gap-1 mt-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        Dipesan: {{ $t->created_at->format('d M Y, H:i') }}
                                    </p>
                                    
                                    {{-- Informasi Sisa Hari (Dibulatkan) --}}
                                    @if($t->status_sewa == 'Aktif')
                                        @php
                                            $tglHabis = \Carbon\Carbon::parse($t->created_at)->addDays(30);
                                            $sisaHari = ceil(now()->diffInDays($tglHabis, false));
                                        @endphp
                                        <p class="text-[10px] font-bold mt-2 {{ $sisaHari <= 5 ? 'text-red-500' : 'text-green-600' }}">
                                            Sisa Sewa: {{ $sisaHari > 0 ? $sisaHari . ' Hari Lagi' : 'Habis Masa Sewa' }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-4 md:mt-0 text-center md:text-right flex flex-col items-center md:items-end gap-2">
                                
                                @if($t->status == 'Menunggu Verifikasi')
                                    <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-amber-50 text-amber-700 text-xs font-bold uppercase border border-amber-200">
                                        <span class="relative flex h-2 w-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                                        </span>
                                        Menunggu Konfirmasi
                                    </span>

                                @elseif($t->status_sewa == 'Proses Keluar')
                                    <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-orange-50 text-orange-700 text-xs font-bold uppercase border border-orange-200">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                        Proses Keluar
                                    </span>
                                    <p class="text-[10px] text-gray-400 italic">Menunggu verifikasi kunci oleh Admin</p>

                                @elseif($t->status_sewa == 'Selesai')
                                    <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-gray-100 text-gray-500 text-xs font-bold uppercase border border-gray-200">
                                        Sewa Selesai
                                    </span>

                                @elseif($t->status == 'Lunas')
                                    <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold uppercase border border-emerald-200 mb-2">
                                        ✅ Pembayaran Lunas
                                    </span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-16 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                            <p class="text-gray-500">Belum ada riwayat transaksi.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
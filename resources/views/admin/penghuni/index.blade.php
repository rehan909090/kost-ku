<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Penghuni Aktif') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-gray-700">Penghuni Saat Ini</h3>
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-xs font-bold">
                        {{ $penghunis->count() }} Orang Terdaftar
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($penghunis as $item)
                        @php
                            // Logika masa berlaku 30 hari
                            $tglMasuk = \Carbon\Carbon::parse($item->created_at);
                            $tglHabis = $tglMasuk->copy()->addDays(30);
                            
                            // Gunakan ceil untuk membulatkan ke atas agar tidak muncul angka desimal (koma)
                            $sisaHari = ceil(now()->diffInDays($tglHabis, false));
                            $persentase = max(0, min(100, ($sisaHari / 30) * 100));
                        @endphp

                        <div class="border rounded-xl p-5 shadow-sm hover:shadow-md transition-all bg-white group">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-indigo-600 transition">{{ $item->user->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $item->user->email }}</p>
                                </div>
                                <span class="bg-indigo-600 text-white text-xs font-black px-3 py-1 rounded-lg shadow-sm">
                                    {{ $item->kamar->nomor_kamar ?? '?' }}
                                </span>
                            </div>

                            <div class="space-y-2 mb-4 bg-gray-50 p-3 rounded-lg">
                                <div class="flex justify-between text-xs">
                                    <span class="text-gray-500">Mulai Kost:</span>
                                    <span class="font-bold text-gray-700">{{ $tglMasuk->format('d M Y') }}</span>
                                </div>
                                <div class="flex justify-between text-xs">
                                    <span class="text-gray-500">Habis Kontrak:</span>
                                    <span class="font-bold text-gray-700">{{ $tglHabis->format('d M Y') }}</span>
                                </div>
                            </div>

                            <div class="mb-2">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-[10px] font-bold uppercase tracking-tighter text-gray-400">Masa Sewa</span>
                                    <span class="text-[10px] font-bold {{ $sisaHari <= 5 ? 'text-red-600' : 'text-green-600' }}">
                                        {{ $sisaHari > 0 ? $sisaHari . ' Hari Lagi' : 'Habis' }}
                                    </span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-2">
                                    <div class="{{ $sisaHari <= 5 ? 'bg-red-500' : 'bg-green-500' }} h-2 rounded-full transition-all duration-500" 
                                         style="width: {{ $persentase }}%"></div>
                                </div>
                            </div>
                            
                            <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center">
                                <div class="text-[10px] font-bold uppercase py-1 px-2 rounded bg-blue-50 text-blue-600">
                                    {{ $item->status_sewa }}
                                </div>

                                <a href="https://wa.me/{{ $item->user->nomor_wa ?? '' }}" target="_blank" class="inline-flex items-center gap-1 text-green-600 hover:text-green-700 text-xs font-black uppercase tracking-tighter">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                                    Hubungi via WA
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-20">
                            <div class="bg-gray-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <h4 class="text-gray-500 font-bold">Belum Ada Penghuni Aktif</h4>
                            <p class="text-gray-400 text-sm">Transaksi yang sudah lunas akan muncul di sini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Penghuni Aktif') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($penghunis as $item)
                    @php
                        // Logika masa berlaku (misal 30 hari dari tanggal bayar)
                        $tglMasuk = \Carbon\Carbon::parse($item->created_at);
                        $tglHabis = $tglMasuk->copy()->addDays(30);
                        $sisaHari = now()->diffInDays($tglHabis, false);
                    @endphp

                    <div class="border rounded-xl p-4 shadow-sm hover:shadow-md transition">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">{{ $item->user->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $item->user->email }}</p>
                            </div>
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                Kamar {{ $item->kamar->nomor_kamar }}
                            </span>
                        </div>

                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Mulai Kost:</span>
                                <span class="font-medium">{{ $tglMasuk->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Habis Kontrak:</span>
                                <span class="font-medium">{{ $tglHabis->format('d M Y') }}</span>
                            </div>
                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-1">
                            <div class="bg-{{ $sisaHari <= 5 ? 'red' : 'green' }}-600 h-2.5 rounded-full" 
                                 style="width: {{ max(0, min(100, ($sisaHari / 30) * 100)) }}%"></div>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <p class="text-xs {{ $sisaHari <= 5 ? 'text-red-600 font-bold' : 'text-gray-500' }}">
                                @if($sisaHari > 0)
                                    Sisa {{ $sisaHari }} Hari Lagi
                                @else
                                    <span class="text-red-600">Masa Sewa Habis!</span>
                                @endif
                            </p>
                            <a href="https://wa.me/{{ $item->user->nomor_wa ?? '' }}" class="text-green-600 hover:text-green-700 text-xs font-bold">
                                Hubungi via WA
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @if($penghunis->isEmpty())
                    <p class="text-center text-gray-500 py-10">Belum ada penghuni aktif.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
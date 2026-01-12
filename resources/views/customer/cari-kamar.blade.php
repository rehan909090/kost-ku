<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cari Kamar Kost Tersedia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($kamars as $kamar)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 transition hover:shadow-lg">
                        <img src="{{ $kamar->foto_kamar ? asset('storage/' . $kamar->foto_kamar) : 'https://via.placeholder.com/400x300?text=No+Image' }}" class="h-48 w-full object-cover">
                        <div class="p-5">
                            <div class="flex justify-between items-start">
                                <h3 class="font-bold text-lg text-gray-900">Kamar {{ $kamar->nomor_kamar }}</h3>
                                <span class="bg-indigo-100 text-indigo-700 text-xs px-2 py-1 rounded font-bold">{{ $kamar->tipe }}</span>
                            </div>
                            <p class="text-gray-500 text-sm mt-2 line-clamp-2">Fasilitas: {{ $kamar->fasilitas }}</p>
                            
                            <div class="mt-5 flex justify-between items-center border-t pt-4">
                                <div>
                                    <p class="text-xs text-gray-400">Harga per bulan</p>
                                    <p class="text-indigo-600 font-bold text-lg">Rp {{ number_format($kamar->harga_per_bulan, 0, ',', '.') }}</p>
                                </div>
                                <a href="{{ route('customer.pesan.review', $kamar->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition font-semibold">
                                    Pesan Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-20 bg-white rounded-xl shadow">
                        <img src="https://cdn-icons-png.flaticon.com/512/619/619153.png" class="w-20 h-20 mx-auto mb-4 opacity-20">
                        <p class="text-gray-500 italic text-lg">Maaf, saat ini belum ada kamar yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Cari Kamar Kost Tersedia') }}
            </h2>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 rounded shadow-sm flex items-center animate-fade-in-down">
                    <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm font-bold">{{ session('success') }}</span>
                </div>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($kamars as $kamar)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
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
                                <a href="{{ route('pesan.review', $kamar->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded">Pesan Sekarang</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-20 bg-white rounded-xl shadow">
                        <p class="text-gray-500 italic text-lg">Maaf, saat ini belum ada kamar yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
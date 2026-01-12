<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Sewa Saya') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-6 border-b pb-2 text-gray-700">Daftar Transaksi</h3>

                <div class="space-y-4">
                    @forelse($transaksis as $t)
                        <div class="border rounded-xl p-6 flex flex-col md:flex-row justify-between items-center hover:shadow-md transition bg-white">
                            <div class="flex items-center gap-6">
                                <div class="bg-indigo-100 p-4 rounded-lg text-indigo-700 font-bold text-xl">
                                    #{{ $t->kamar->nomor_kamar }}
                                </div>
                                <div>
                                    <p class="text-sm text-gray-400 font-bold uppercase tracking-widest">{{ $t->kamar->tipe }}</p>
                                    <p class="text-xl font-black text-gray-800">Rp {{ number_format($t->total_harga) }}</p>
                                    <p class="text-sm text-gray-500 italic">Dipesan pada: {{ $t->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>

                            <div class="mt-4 md:mt-0 text-center md:text-right">
                                @if($t->status == 'Menunggu Verifikasi')
                                    <span class="inline-block px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold uppercase tracking-tighter border border-yellow-200">
                                        ⏳ Menunggu Konfirmasi Admin
                                    </span>
                                @else
                                    <div class="flex flex-col items-center md:items-end">
                                        <span class="inline-block px-4 py-2 rounded-full bg-green-100 text-green-700 text-xs font-bold uppercase tracking-tighter border border-green-200">
                                            ✅ Pembayaran Lunas
                                        </span>
                                        <p class="text-[10px] text-gray-400 mt-2 font-medium italic">Kamar ini sudah resmi milik Anda</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <div class="flex justify-center mb-4 text-gray-300">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <p class="text-gray-500 font-medium">Anda belum pernah melakukan pemesanan.</p>
                            <a href="{{ route('customer.dashboard') }}" class="mt-4 inline-block text-indigo-600 font-bold hover:underline">Cari Kamar Sekarang &rarr;</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
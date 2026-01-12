<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Transaksi Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-b border-gray-200">
                
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-sm" role="alert">
                        <p class="font-bold">Berhasil!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-indigo-600 text-white text-left text-xs uppercase tracking-widest font-bold">
                                <th class="px-6 py-4">Tgl Masuk</th>
                                <th class="px-6 py-4">Nama Customer</th>
                                <th class="px-6 py-4">Kamar</th>
                                <th class="px-6 py-4">Total Harga</th>
                                <th class="px-6 py-4 text-center">Bukti Bayar</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @forelse($transaksis as $t)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm">
                                    {{ $t->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $t->user->name }}
                                </td>
                                <td class="px-6 py-4 font-bold">
                                    No. {{ $t->kamar->nomor_kamar }}
                                </td>
                                <td class="px-6 py-4 text-indigo-600 font-bold">
                                    Rp {{ number_format($t->total_harga) }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($t->bukti_pembayaran)
                                        <a href="{{ asset('storage/' . $t->bukti_pembayaran) }}" target="_blank" 
                                           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-bold italic underline">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            Lihat Bukti
                                        </a>
                                    @else
                                        <span class="text-red-400 italic text-xs">Belum Upload</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($t->status != 'Lunas / Terkonfirmasi')
                                        <form action="{{ route('admin.transaksi.konfirmasi', $t->id) }}" method="POST" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin mengonfirmasi transaksi ini? Tindakan ini akan otomatis mengubah status kamar menjadi Terisi.');">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-xs font-black py-2 px-4 rounded-full shadow transition-all uppercase tracking-tighter">
                                                Konfirmasi Transaksi
                                            </button>
                                        </form>
                                    @else
                                        <div class="flex flex-col items-center">
                                            <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-[10px] font-black uppercase shadow-sm">
                                                ✓ Lunas
                                            </span>
                                            <span class="text-[9px] text-gray-400 mt-1 italic">Confirmed by Admin</span>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-20 text-center text-gray-400 italic">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 mb-2 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        Belum ada transaksi yang masuk.
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
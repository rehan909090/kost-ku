<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Transaksi Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-sm rounded flex justify-between" role="alert">
                        <div>
                            <p class="font-bold">Berhasil!</p>
                            <p>{{ session('success') }}</p>
                        </div>
                        <button onclick="this.parentElement.remove()" class="font-bold">&times;</button>
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-indigo-600 text-white text-left text-xs uppercase tracking-widest font-bold">
                                <th class="px-6 py-4">Tgl Masuk</th>
                                <th class="px-6 py-4">Nama Customer</th>
                                <th class="px-6 py-4">Kamar</th>
                                <th class="px-6 py-4 text-center">Status Sewa</th>
                                <th class="px-6 py-4 text-center">Bukti Bayar</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @forelse($transaksis as $t)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm whitespace-nowrap">
                                    {{ $t->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">{{ $t->user->name }}</div>
                                    <div class="text-[10px] text-gray-400">{{ $t->user->email }}</div>
                                </td>
                                <td class="px-6 py-4 font-bold text-indigo-600">
                                    No. {{ $t->kamar->nomor_kamar ?? '-' }}
                                </td>
                                
                                <td class="px-6 py-4 text-center">
                                    @if($t->status_sewa == 'Proses Keluar')
                                        <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-[10px] font-black uppercase animate-pulse">
                                            ⚠️ Minta Keluar
                                        </span>
                                    @elseif($t->status_sewa == 'Aktif')
                                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-[10px] font-black uppercase">
                                            Sedang Kos
                                        </span>
                                    @elseif($t->status_sewa == 'Selesai')
                                        <span class="bg-gray-100 text-gray-500 px-3 py-1 rounded-full text-[10px] font-black uppercase">
                                            Selesai
                                        </span>
                                    @else
                                        <span class="text-gray-300 text-[10px] italic">N/A</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if($t->bukti_pembayaran)
                                        <a href="{{ asset('storage/' . $t->bukti_pembayaran) }}" target="_blank" 
                                           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-bold italic underline text-xs">
                                            Lihat Bukti
                                        </a>
                                    @else
                                        <span class="text-red-400 italic text-xs">Belum Upload</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-center">
                                    {{-- AKSI 1: Konfirmasi Pembayaran Lunas (Sewa Baru) --}}
                                    @if($t->status != 'Lunas' && $t->status_sewa != 'Selesai')
                                        <form action="{{ route('admin.transaksi.konfirmasi', $t->id) }}" method="POST" 
                                              onsubmit="return confirm('Konfirmasi pembayaran dan aktifkan sewa?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-[10px] font-black py-2 px-4 rounded-lg shadow transition-all uppercase">
                                                Konfirmasi Bayar
                                            </button>
                                        </form>

                                    {{-- AKSI 2: Konfirmasi Check Out (Jika user mengajukan keluar) --}}
                                    @elseif($t->status_sewa == 'Proses Keluar')
                                        <form action="{{ route('admin.transaksi.konfirmasiCheckout', $t->id) }}" method="POST" 
                                              onsubmit="return confirm('Konfirmasi kunci sudah diterima dan selesaikan sewa?')">
                                            @csrf
                                            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white text-[10px] font-black py-2 px-4 rounded-lg shadow transition-all uppercase">
                                                Konfirmasi Check Out
                                            </button>
                                        </form>

                                    {{-- STATUS: Jika sudah lunas dan tidak ada aksi --}}
                                    @elseif($t->status == 'Lunas' && $t->status_sewa == 'Aktif')
                                        <div class="flex flex-col items-center">
                                            <span class="text-emerald-600 font-black text-[10px] uppercase">✓ Terkonfirmasi</span>
                                            <span class="text-[9px] text-gray-400 italic">User Aktif</span>
                                        </div>
                                    @else
                                        <span class="text-gray-300 text-[10px] italic">No Action Needed</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-20 text-center text-gray-400 italic">
                                    Belum ada transaksi yang masuk.
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
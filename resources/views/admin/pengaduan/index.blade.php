<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Keluhan & Pengaduan Penghuni') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        <p class="font-bold">Berhasil!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 text-left text-xs uppercase font-bold text-gray-600">
                                <th class="px-4 py-3 border">Tanggal</th>
                                <th class="px-4 py-3 border">Penghuni</th>
                                <th class="px-4 py-3 border">Masalah / Deskripsi</th>
                                <th class="px-4 py-3 border text-center">Foto</th>
                                <th class="px-4 py-3 border text-center">Status</th>
                                <th class="px-4 py-3 border text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengaduans as $p)
                            <tr class="text-sm border-b hover:bg-gray-50 transition {{ $p->judul == 'Pengajuan Berhenti Kost' ? 'bg-red-50' : '' }}">
                                <td class="px-4 py-3 border text-gray-600">
                                    {{ $p->created_at->format('d M Y') }}
                                </td>
                                <td class="px-4 py-3 border">
                                    <div class="font-bold text-gray-900">{{ $p->user->name }}</div>
                                    <div class="text-xs text-gray-500">ID User: #{{ $p->user_id }}</div>
                                </td>
                                <td class="px-4 py-3 border">
                                    @if($p->judul == 'Pengajuan Berhenti Kost')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-red-600 text-white mb-1 shadow-sm uppercase">
                                            Urgent: Check Out
                                        </span>
                                    @endif
                                    <span class="block font-bold {{ $p->judul == 'Pengajuan Berhenti Kost' ? 'text-red-700' : 'text-indigo-600' }}">
                                        {{ $p->judul }}
                                    </span>
                                    <p class="text-gray-600 text-xs mt-1 italic">"{{ $p->deskripsi }}"</p>
                                </td>
                                <td class="px-4 py-3 border text-center">
                                    @if($p->foto_kerusakan)
                                        <a href="{{ asset('storage/'.$p->foto_kerusakan) }}" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-xs">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            Lihat Foto
                                        </a>
                                    @else
                                        <span class="text-gray-400 italic text-xs">Tidak Ada Foto</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 border text-center">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider
                                        {{ $p->status == 'Menunggu' ? 'bg-yellow-100 text-yellow-700 border border-yellow-300' : ($p->status == 'Proses' ? 'bg-blue-100 text-blue-700 border border-blue-300' : 'bg-green-100 text-green-700 border border-green-300') }}">
                                        {{ $p->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 border">
                                    <div class="flex flex-col gap-2">
                                        <form action="{{ route('admin.pengaduan.update', $p->id) }}" method="POST" class="flex items-center gap-1">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="text-[10px] border-gray-300 rounded p-1 focus:ring-indigo-500 w-full">
                                                <option value="Menunggu" {{ $p->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                                <option value="Proses" {{ $p->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                                <option value="Selesai" {{ $p->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                            <button type="submit" class="bg-indigo-600 text-white px-2 py-1 rounded text-[10px] hover:bg-indigo-700 transition font-bold">
                                                Update
                                            </button>
                                        </form>

                                        @if($p->judul == 'Pengajuan Berhenti Kost')
                                            {{-- PASTIKAN NAMA ROUTE INI SAMA DENGAN DI WEB.PHP --}}
                                            <a href="{{ route('admin.penghuni.index') }}" class="text-center bg-red-600 text-white px-2 py-1.5 rounded text-[10px] font-black hover:bg-red-800 transition uppercase shadow-sm">
                                                Proses Check Out Sekarang
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-12 text-gray-400 italic bg-gray-50">
                                    <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    Belum ada laporan kerusakan atau pengajuan berhenti.
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
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
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-left text-xs uppercase font-bold text-gray-600">
                                <th class="px-4 py-3 border">Tanggal</th>
                                <th class="px-4 py-3 border">Penghuni</th>
                                <th class="px-4 py-3 border">Masalah</th>
                                <th class="px-4 py-3 border">Foto</th>
                                <th class="px-4 py-3 border">Status Sekarang</th>
                                <th class="px-4 py-3 border text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengaduans as $p)
                            <tr class="text-sm border-b hover:bg-gray-50">
                                <td class="px-4 py-3 border">{{ $p->created_at->format('d/m/Y') }}</td>
                                <td class="px-4 py-3 border font-bold">{{ $p->user->name }}</td>
                                <td class="px-4 py-3 border">
                                    <span class="block font-bold text-indigo-600">{{ $p->judul }}</span>
                                    <span class="text-gray-500 text-xs">{{ $p->deskripsi }}</span>
                                </td>
                                <td class="px-4 py-3 border text-center">
                                    @if($p->foto_kerusakan)
                                        <a href="{{ asset('storage/'.$p->foto_kerusakan) }}" target="_blank" class="text-blue-500 underline text-xs">Lihat Foto</a>
                                    @else
                                        <span class="text-gray-400 italic text-xs">No Photo</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 border text-center">
                                    <span class="px-2 py-1 rounded text-[10px] font-bold uppercase
                                        {{ $p->status == 'Menunggu' ? 'bg-yellow-100 text-yellow-700' : ($p->status == 'Proses' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700') }}">
                                        {{ $p->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 border">
                                    <form action="{{ route('admin.pengaduan.update', $p->id) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="text-xs border-gray-300 rounded p-1">
                                            <option value="Menunggu" {{ $p->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                            <option value="Proses" {{ $p->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                            <option value="Selesai" {{ $p->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                        <button type="submit" class="bg-indigo-600 text-white px-2 py-1 rounded text-xs hover:bg-indigo-700">Update</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-10 text-gray-400 italic">Belum ada laporan kerusakan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
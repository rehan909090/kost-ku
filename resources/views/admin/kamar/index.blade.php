<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight italic">
                {{ __('Daftar Kamar Kost') }}
            </h2>
            <a href="{{ route('admin.kamar.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow transition">
                + Tambah Kamar Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6 bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center justify-between">
                <form action="{{ route('admin.kamar.index') }}" method="GET" class="flex items-center gap-4">
                    <div>
                        <label class="text-sm font-bold text-gray-600 mr-2">Filter Status:</label>
                        <select name="status" onchange="this.form.submit()" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            <option value="">Semua Kamar</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Kosong (Tersedia)</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Terisi (Booked)</option>
                        </select>
                    </div>
                    @if(request('status'))
                        <a href="{{ route('admin.kamar.index') }}" class="text-xs text-red-500 underline">Reset Filter</a>
                    @endif
                </form>
                <div class="text-sm text-gray-500">
                    Menampilkan {{ $kamars->count() }} dari {{ $kamars->total() }} total kamar
                </div>
            </div>

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-left text-sm uppercase text-gray-600">
                                <th class="px-4 py-3 border">Foto</th>
                                <th class="px-4 py-3 border">No. Kamar</th>
                                <th class="px-4 py-3 border">Tipe</th>
                                <th class="px-4 py-3 border">Harga/Bulan</th>
                                <th class="px-4 py-3 border">Status</th>
                                <th class="px-4 py-3 border text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kamars as $kamar)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 border text-center">
                                        @if($kamar->foto_kamar)
                                            <img src="{{ asset('storage/' . $kamar->foto_kamar) }}" alt="Foto Kamar" class="w-20 h-20 object-cover rounded-md mx-auto shadow-sm">
                                        @else
                                            <div class="w-20 h-20 bg-gray-100 rounded-md mx-auto flex items-center justify-center">
                                                <span class="text-gray-400 italic text-[10px]">No Photo</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 border font-bold text-gray-700">{{ $kamar->nomor_kamar }}</td>
                                    <td class="px-4 py-3 border">{{ $kamar->tipe }}</td>
                                    <td class="px-4 py-3 border text-indigo-600 font-bold">Rp {{ number_format($kamar->harga_per_bulan, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 border text-center">
                                        <span class="px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider {{ $kamar->is_tersedia ? 'bg-green-100 text-green-700 border border-green-200' : 'bg-red-100 text-red-700 border border-red-200' }}">
                                            {{ $kamar->is_tersedia ? 'Kosong' : 'Terisi' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 border text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('admin.kamar.edit', $kamar->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs font-bold transition">Edit</a>
                                            <form action="{{ route('admin.kamar.destroy', $kamar->id) }}" method="POST" onsubmit="return confirm('Hapus kamar ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs font-bold transition">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-10 text-center text-gray-500 italic">
                                        Data tidak ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-6">
                        {{ $kamars->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
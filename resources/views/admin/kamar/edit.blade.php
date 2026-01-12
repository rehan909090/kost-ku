<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kamar: ') }} {{ $kamar->nomor_kamar }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
                    <p class="font-bold">Terjadi kesalahan:</p>
                    <ul class="list-disc ml-5 mt-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 border-t-4 border-yellow-500">
                <form action="{{ route('admin.kamar.update', $kamar->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2 italic uppercase text-sm tracking-wider">1. Status & Informasi Utama</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold text-gray-700 mb-2">Nomor Kamar</label>
                                <input type="text" name="nomor_kamar" value="{{ old('nomor_kamar', $kamar->nomor_kamar) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block font-bold text-gray-700 mb-2">Status Ketersediaan</label>
                                <select name="is_tersedia" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500">
                                    <option value="1" {{ $kamar->is_tersedia ? 'selected' : '' }}>Tersedia (Kosong)</option>
                                    <option value="0" {{ !$kamar->is_tersedia ? 'selected' : '' }}>Penuh (Terisi)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block font-bold text-gray-700 mb-2">Tipe Kamar</label>
                                <select name="tipe" class="w-full border-gray-300 rounded-lg shadow-sm">
                                    <option value="Reguler" {{ $kamar->tipe == 'Reguler' ? 'selected' : '' }}>Reguler</option>
                                    <option value="VIP" {{ $kamar->tipe == 'VIP' ? 'selected' : '' }}>VIP</option>
                                    <option value="VVIP" {{ $kamar->tipe == 'VVIP' ? 'selected' : '' }}>VVIP</option>
                                </select>
                            </div>
                            <div>
                                <label class="block font-bold text-gray-700 mb-2">Harga Per Bulan (Rp)</label>
                                <input type="number" name="harga_per_bulan" value="{{ old('harga_per_bulan', $kamar->harga_per_bulan) }}" class="w-full border-gray-300 rounded-lg shadow-sm">
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-blue-700 mb-4 border-b pb-2 italic uppercase text-sm tracking-wider">2. Detail Fisik & Fasilitas</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block font-bold text-gray-700 mb-2">Ukuran</label>
                                <input type="text" name="ukuran" value="{{ old('ukuran', $kamar->ukuran) }}" placeholder="3x4 Meter" class="w-full border-gray-300 rounded-lg shadow-sm">
                            </div>
                            <div>
                                <label class="block font-bold text-gray-700 mb-2">KM</label>
                                <input type="text" name="kamar_mandi" value="{{ old('kamar_mandi', $kamar->kamar_mandi) }}" placeholder="KM Dalam" class="w-full border-gray-300 rounded-lg shadow-sm">
                            </div>
                            <div>
                                <label class="block font-bold text-gray-700 mb-2">Listrik</label>
                                <input type="text" name="listrik" value="{{ old('listrik', $kamar->listrik) }}" placeholder="Token" class="w-full border-gray-300 rounded-lg shadow-sm">
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block font-bold text-gray-700 mb-2 text-sm">Fasilitas Utama (Pisahkan dengan koma)</label>
                            <textarea name="fasilitas" class="w-full border-gray-300 rounded-lg shadow-sm" rows="2">{{ old('fasilitas', $kamar->fasilitas) }}</textarea>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-red-700 mb-4 border-b pb-2 italic uppercase text-sm tracking-wider">3. Keamanan & Lokasi</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold text-gray-700 mb-2 text-sm">Detail Keamanan</label>
                                <textarea name="keamanan" class="w-full border-gray-300 rounded-lg shadow-sm" rows="3">{{ old('keamanan', $kamar->keamanan) }}</textarea>
                            </div>
                            <div>
                                <label class="block font-bold text-gray-700 mb-2 text-sm">Lokasi & Akses</label>
                                <textarea name="lokasi_akses" class="w-full border-gray-300 rounded-lg shadow-sm" rows="3">{{ old('lokasi_akses', $kamar->lokasi_akses) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8 p-4 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                        <label class="block font-bold text-gray-700 mb-2 text-sm">Ganti Foto Kamar</label>
                        <div class="flex items-center gap-6">
                            @if($kamar->foto_kamar)
                                <img src="{{ asset('storage/' . $kamar->foto_kamar) }}" class="w-24 h-24 object-cover rounded-lg shadow">
                            @endif
                            <input type="file" name="foto_kamar" class="text-sm text-gray-500">
                        </div>
                        <p class="text-xs text-gray-400 mt-2">*Kosongkan jika tidak ingin mengganti foto saat ini.</p>
                    </div>

                    <div class="flex justify-end gap-4 border-t pt-6">
                        <a href="{{ route('admin.kamar.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 font-bold transition">
                            Batal
                        </a>
                        <button type="submit" class="bg-yellow-500 text-white px-8 py-2 rounded-lg hover:bg-yellow-600 shadow-md transform transition hover:-translate-y-1 font-bold">
                            Update Data Kamar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
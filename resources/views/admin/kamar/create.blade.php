<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kamar Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 border-t-4 border-indigo-600">
                <form action="{{ route('admin.kamar.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-indigo-700 mb-4 border-b pb-2 italic">1. Informasi Dasar</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Nomor Kamar</label>
                                <input type="text" name="nomor_kamar" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Contoh: A-01" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Tipe Kamar</label>
                                <select name="tipe" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="Reguler">Reguler</option>
                                    <option value="VIP">VIP</option>
                                    <option value="VVIP">VVIP</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Harga Per Bulan (Rp)</label>
                                <input type="number" name="harga_per_bulan" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="1000000" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Foto Kamar</label>
                                <input type="file" name="foto_kamar" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-blue-700 mb-4 border-b pb-2 italic">2. Elemen Wajib & Fasilitas</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block font-bold text-gray-700 mb-2">Ukuran Kamar</label>
                                <input type="text" name="ukuran" placeholder="3x4 Meter" class="w-full border-gray-300 rounded-lg shadow-sm">
                            </div>
                            <div>
                                <label class="block font-bold text-gray-700 mb-2">Tipe KM</label>
                                <input type="text" name="kamar_mandi" placeholder="KM Dalam" class="w-full border-gray-300 rounded-lg shadow-sm">
                            </div>
                            <div>
                                <label class="block font-bold text-gray-700 mb-2">Listrik</label>
                                <input type="text" name="listrik" placeholder="Token / Include" class="w-full border-gray-300 rounded-lg shadow-sm">
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700 font-bold mb-2">Fasilitas Utama (Pisahkan dengan koma)</label>
                            <textarea name="fasilitas" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" rows="2" placeholder="AC, Kasur, Lemari, WiFi"></textarea>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-red-700 mb-4 border-b pb-2 italic">3. Keamanan & Akses Lokasi</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold text-gray-700 mb-2">Detail Keamanan (Gunakan Koma)</label>
                                <textarea name="keamanan" placeholder="CCTV 24 Jam, Parkir Motor, Jam Malam 23.00" class="w-full border-gray-300 rounded-lg shadow-sm" rows="3"></textarea>
                            </div>
                            <div>
                                <label class="block font-bold text-gray-700 mb-2">Lokasi & Akses (Gunakan Koma)</label>
                                <textarea name="lokasi_akses" placeholder="5 Menit ke Kampus, Dekat Minimarket, Akses Grab" class="w-full border-gray-300 rounded-lg shadow-sm" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 border-t pt-6">
                        <a href="{{ route('admin.kamar.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition font-bold">
                            Batal
                        </a>
                        <button type="submit" class="bg-indigo-600 text-white px-8 py-2 rounded-lg hover:bg-indigo-700 shadow-lg transform transition hover:-translate-y-1 font-bold">
                            Simpan Data Kamar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
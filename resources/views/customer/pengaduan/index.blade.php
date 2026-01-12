<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="font-bold text-lg mb-4">Buat Pengaduan</h3>
                    <form action="{{ route('customer.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-bold">Judul Masalah</label>
                            <input type="text" name="judul" class="w-full border-gray-300 rounded-lg" placeholder="Contoh: Kran Air Bocor" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-bold">Deskripsi</label>
                            <textarea name="deskripsi" class="w-full border-gray-300 rounded-lg" rows="4" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-bold">Foto Kerusakan (Opsional)</label>
                            <input type="file" name="foto_kerusakan" class="w-full">
                        </div>
                        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg w-full">Kirim Aduan</button>
                    </form>
                </div>

                <div class="md:col-span-2 bg-white p-6 rounded-lg shadow">
                    <h3 class="font-bold text-lg mb-4">Riwayat Pengaduan</h3>
                    <div class="space-y-4">
                        @foreach($pengaduans as $p)
                        <div class="border p-4 rounded-lg flex justify-between items-center">
                            <div>
                                <h4 class="font-bold">{{ $p->judul }}</h4>
                                <p class="text-sm text-gray-500">{{ $p->created_at->format('d M Y') }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-bold 
                                {{ $p->status == 'Menunggu' ? 'bg-yellow-100 text-yellow-600' : ($p->status == 'Proses' ? 'bg-blue-100 text-blue-600' : 'bg-green-100 text-green-600') }}">
                                {{ $p->status }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
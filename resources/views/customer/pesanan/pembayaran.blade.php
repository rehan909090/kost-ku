<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow">
            <h2 class="text-2xl font-bold mb-6">Detail Pembayaran</h2>
            <div class="grid grid-cols-2 gap-4 border-b pb-4 mb-4">
                <p>Kamar:</p> <p class="font-bold">Kamar {{ $kamar->nomor_kamar }}</p>
                <p>Harga:</p> <p class="text-indigo-600 font-bold">Rp {{ number_format($kamar->harga_per_bulan) }}</p>
            </div>
            
            <div class="bg-yellow-50 p-4 rounded-lg mb-6 text-sm text-yellow-800">
                <strong>Informasi Transfer:</strong><br>
                DANA : 082171728788 a/n Kost-Ku
            </div>

            <form action="{{ route('customer.checkout', $kamar->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-4">
        <label class="block font-bold mb-2">Upload Bukti Transfer</label>
        <input type="file" name="bukti_pembayaran" class="w-full border p-2 rounded" required>
    </div>
    <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700">
        Kirim Bukti & Konfirmasi Pesanan
    </button>
</form>
        </div>
    </div>
</x-app-layout>
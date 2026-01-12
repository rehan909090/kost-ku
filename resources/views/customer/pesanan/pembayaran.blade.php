<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Konfirmasi Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-2xl rounded-3xl overflow-hidden border border-gray-100">
                
                <div class="bg-indigo-600 p-8 text-white">
                    <h2 class="text-2xl font-black uppercase tracking-tight">Selesaikan Pesanan</h2>
                    <p class="text-indigo-100 text-sm mt-1">Silakan lakukan transfer dan unggah bukti pembayaran di bawah ini.</p>
                </div>

                <div class="p-8">
                    <div class="flex items-center justify-between bg-slate-50 p-6 rounded-2xl border border-slate-100 mb-8">
                        <div class="flex items-center gap-4">
                            <div class="bg-white p-3 rounded-xl shadow-sm text-indigo-600 font-black text-xl">
                                #{{ $kamar->nomor_kamar }}
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Tipe Kamar</p>
                                <p class="text-lg font-bold text-gray-800">{{ $kamar->tipe }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Bayar</p>
                            <p class="text-2xl font-black text-indigo-600">Rp {{ number_format($kamar->harga_per_bulan, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-sm font-black text-gray-700 uppercase tracking-widest mb-4 flex items-center gap-2">
                            <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM5 12a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path></svg>
                            Metode Transfer
                        </h3>
                        <div class="bg-amber-50 border-2 border-dashed border-amber-200 p-6 rounded-2xl relative overflow-hidden">
                            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div>
                                    <p class="text-amber-800 font-black text-xl tracking-tight">E-Wallet DANA</p>
                                    <p class="text-amber-700 text-2xl font-mono mt-1">0821 7172 8788</p>
                                    <p class="text-amber-600 text-sm font-bold uppercase mt-1">a/n Kost-Ku Manager</p>
                                </div>
                                <div class="bg-white px-4 py-2 rounded-xl shadow-sm border border-amber-100 self-start md:self-center">
                                    <span class="text-xs font-black text-amber-500 italic">OTOMATIS TERVERIFIKASI</span>
                                </div>
                            </div>
                            <div class="absolute -right-4 -bottom-4 text-amber-100 opacity-50 transform -rotate-12">
                                <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('customer.store-pembayaran', $kamar->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-black text-gray-700 uppercase tracking-widest mb-3">Unggah Bukti Transfer</label>
                            <div class="relative border-2 border-gray-200 border-dashed rounded-2xl p-8 transition-all hover:border-indigo-400 group">
                                <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required onchange="previewFile()">
                                <div class="text-center" id="upload-placeholder">
                                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3 group-hover:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <p class="text-gray-500 font-bold text-sm">Klik atau seret gambar ke sini</p>
                                    <p class="text-gray-400 text-xs mt-1">PNG, JPG, JPEG (Maks. 2MB)</p>
                                </div>
                                <div id="preview-container" class="hidden">
                                    <p class="text-indigo-600 font-bold text-sm">File terpilih: <span id="file-name"></span></p>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-5 rounded-2xl transition-all shadow-[0_15px_30px_rgba(79,70,229,0.3)] transform hover:-translate-y-1 uppercase tracking-widest flex items-center justify-center gap-2">
                            Konfirmasi Pembayaran
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </button>
                    </form>

                    <div class="mt-8 text-center">
                        <a href="{{ route('customer.pesan.review', $kamar->id) }}" class="text-sm font-bold text-gray-400 hover:text-gray-600 transition">Batal dan kembali ke detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewFile() {
            const input = document.getElementById('bukti_pembayaran');
            const placeholder = document.getElementById('upload-placeholder');
            const preview = document.getElementById('preview-container');
            const fileName = document.getElementById('file-name');

            if (input.files && input.files[0]) {
                placeholder.classList.add('hidden');
                preview.classList.remove('hidden');
                fileName.textContent = input.files[0].name;
            }
        }
    </script>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Statistik Admin') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500">
                    <p class="text-sm text-gray-500 font-bold uppercase">Total Kamar</p>
                    <p class="text-3xl font-black text-gray-800">{{ $totalKamar }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-yellow-500">
                    <p class="text-sm text-gray-500 font-bold uppercase">Perlu Verifikasi</p>
                    <p class="text-3xl font-black text-yellow-600">{{ $transaksiPending }}</p>
                    <p class="text-xs text-gray-400 mt-1 italic">Transaksi belum dicek</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500">
                    <p class="text-sm text-gray-500 font-bold uppercase">Kamar Kosong</p>
                    <p class="text-3xl font-black text-green-600">{{ $kamarKosong }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-indigo-500">
                    <p class="text-sm text-gray-500 font-bold uppercase">Pendapatan</p>
                    <p class="text-xl font-black text-gray-800">Rp {{ number_format($totalPendapatan) }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm">
                    <h3 class="text-lg font-bold mb-4 text-gray-700 text-center uppercase tracking-wider">Status Ketersediaan Kamar</h3>
                    <div class="w-full" style="max-height: 300px;">
                        <canvas id="chartKamar"></canvas>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm">
                    <h3 class="text-lg font-bold mb-6 text-gray-700 uppercase tracking-wider text-center">Aksi Cepat</h3>
                    <div class="grid grid-cols-1 gap-4">
                        <a href="{{ route('admin.transaksi.index') }}" class="flex items-center justify-between p-4 bg-yellow-50 hover:bg-yellow-100 border border-yellow-200 rounded-xl transition group">
                            <span class="font-bold text-yellow-800 italic">Cek Transaksi Masuk</span>
                            <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-xs">{{ $transaksiPending }} Baru</span>
                        </a>
                        <a href="{{ route('admin.kamar.create') }}" class="flex items-center justify-between p-4 bg-blue-50 hover:bg-blue-100 border border-blue-200 rounded-xl transition">
                            <span class="font-bold text-blue-800 italic">Tambah Kamar Baru</span>
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"/></svg>
                        </a>
                    </div>
                    <div class="mt-8 p-4 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                        <p class="text-sm text-gray-500 italic text-center">
                            "Sistem otomatis akan menyembunyikan kamar jika transaksi sudah dikonfirmasi lunas."
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chartKamar').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Kamar Terisi', 'Kamar Kosong'],
                datasets: [{
                    label: 'Jumlah Kamar',
                    data: [{{ $kamarTerisi }}, {{ $kamarKosong }}],
                    backgroundColor: [
                        'rgba(79, 70, 229, 0.8)', // Indigo (Terisi)
                        'rgba(16, 185, 129, 0.8)'  // Green (Kosong)
                    ],
                    borderColor: [
                        '#4F46E5',
                        '#10B981'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                cutout: '70%' // Membuat efek ring lebih tipis
            }
        });
    </script>
</x-app-layout>
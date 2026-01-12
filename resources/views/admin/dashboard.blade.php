<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Statistik Admin') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500 transition hover:shadow-md">
                    <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Total Kamar</p>
                    <p class="text-3xl font-black text-gray-800">{{ $totalKamar ?? 0 }}</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-yellow-500 transition hover:shadow-md">
                    <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Bayar Pending</p>
                    <div class="flex items-center justify-between">
                        <p class="text-3xl font-black text-yellow-600">{{ $transaksiPending ?? 0 }}</p>
                        <svg class="w-8 h-8 text-yellow-200" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM5 12a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-red-500 transition hover:shadow-md">
                    <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Laporan Masalah</p>
                    <div class="flex items-center justify-between">
                        <p class="text-3xl font-black text-red-600">{{ $pengaduanPending ?? 0 }}</p>
                        <svg class="w-8 h-8 text-red-200" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500 transition hover:shadow-md">
                    <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Kamar Kosong</p>
                    <p class="text-3xl font-black text-green-600">{{ $kamarKosong ?? 0 }}</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-indigo-500 transition hover:shadow-md">
                    <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Total Income</p>
                    <p class="text-xl font-black text-gray-800">Rp{{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm">
                    <h3 class="text-lg font-bold mb-4 text-gray-700 text-center uppercase tracking-widest">Status Hunian Kamar</h3>
                    <div style="height: 300px;">
                        <canvas id="chartKamar"></canvas>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold mb-6 text-gray-700 uppercase tracking-wider text-center border-b pb-2">Butuh Tindakan Segera</h3>
                    <div class="space-y-4">
                        
                        <a href="{{ route('admin.transaksi.index') }}" class="flex items-center justify-between p-4 bg-yellow-50 hover:bg-yellow-100 rounded-xl transition group">
                            <div class="flex items-center">
                                <div class="p-2 bg-yellow-500 rounded-lg mr-3 shadow-sm text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <span class="font-bold text-yellow-900 uppercase text-xs">Konfirmasi Pembayaran</span>
                            </div>
                            <span class="bg-yellow-200 text-yellow-800 px-3 py-1 rounded-full text-xs font-black">{{ $transaksiPending ?? 0 }}</span>
                        </a>

                        <a href="{{ route('admin.pengaduan.index') }}" class="flex items-center justify-between p-4 bg-red-50 hover:bg-red-100 rounded-xl transition group">
                            <div class="flex items-center">
                                <div class="p-2 bg-red-500 rounded-lg mr-3 shadow-sm text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                </div>
                                <span class="font-bold text-red-900 uppercase text-xs">Kelola Pengaduan</span>
                            </div>
                            <span class="bg-red-200 text-red-800 px-3 py-1 rounded-full text-xs font-black">{{ $pengaduanPending ?? 0 }}</span>
                        </a>

                        <a href="{{ route('admin.kamar.index') }}" class="flex items-center justify-between p-4 bg-indigo-50 hover:bg-indigo-100 rounded-xl transition group">
                            <div class="flex items-center">
                                <div class="p-2 bg-indigo-500 rounded-lg mr-3 shadow-sm text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                </div>
                                <span class="font-bold text-indigo-900 uppercase text-xs">Kelola Data Kamar</span>
                            </div>
                            <svg class="w-5 h-5 text-indigo-400 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"></path></svg>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('chartKamar').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Terisi (Terpesan)', 'Kosong (Tersedia)'],
                    datasets: [{
                        data: [{{ $kamarTerisi ?? 0 }}, {{ $kamarKosong ?? 0 }}],
                        backgroundColor: ['#4F46E5', '#10B981'],
                        hoverOffset: 10,
                        borderWidth: 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } }
                    },
                    cutout: '75%'
                }
            });
        });
    </script>
</x-app-layout>
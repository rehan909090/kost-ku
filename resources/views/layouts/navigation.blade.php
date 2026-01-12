<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="font-bold text-2xl text-indigo-600 tracking-tighter">
                        KOST<span class="text-gray-800">KU</span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    {{-- MENU KHUSUS ADMIN --}}
                    @if(auth()->user()->role === 'admin')
                        <x-nav-link :href="route('admin.kamar.index')" :active="request()->routeIs('admin.kamar.*')">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                {{ __('Kelola Kamar') }}
                            </span>
                        </x-nav-link>

                        <x-nav-link :href="route('admin.transaksi.index')" :active="request()->routeIs('admin.transaksi.*')">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                {{ __('Transaksi Masuk') }}
                            </span>
                        </x-nav-link>

                        <x-nav-link :href="route('admin.kelola.penghuni')" :active="request()->routeIs('admin.kelola.penghuni')">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13.481 4.03a3.5 3.5 0 11-6.961 0 3.5 3.5 0 016.961 0z"/></svg>
                                {{ __('Penghuni') }}
                            </span>
                        </x-nav-link>

                        <x-nav-link :href="route('admin.pengaduan.index')" :active="request()->routeIs('admin.pengaduan.*')">
                            <span class="flex items-center text-red-600 font-semibold">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                {{ __('Laporan Masalah') }}
                            </span>
                        </x-nav-link>

                    {{-- MENU KHUSUS CUSTOMER --}}
                    @else
                        <x-nav-link :href="route('customer.dashboard')" :active="request()->routeIs('customer.dashboard')">
                            {{ __('Cari Kamar') }}
                        </x-nav-link>

                        <x-nav-link :href="route('customer.pesan.index')" :active="request()->routeIs('customer.pesan.*')">
                            {{ __('Riwayat Sewa') }}
                        </x-nav-link>

                        <x-nav-link :href="route('customer.pengaduan.index')" :active="request()->routeIs('customer.pengaduan.*')">
                            {{ __('Pusat Bantuan / Aduan') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="mr-3 text-right">
                    <div class="text-xs text-gray-400 font-bold uppercase tracking-widest">{{ auth()->user()->role }}</div>
                    <div class="text-sm font-medium text-gray-500">{{ auth()->user()->name }}</div>
                </div>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="bg-indigo-100 p-2 rounded-full">
                                <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if(auth()->user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.kamar.index')" :active="request()->routeIs('admin.kamar.*')">
                    {{ __('Kelola Kamar') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.transaksi.index')" :active="request()->routeIs('admin.transaksi.index')">
                    {{ __('Transaksi Masuk') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.pengaduan.index')" :active="request()->routeIs('admin.pengaduan.index')">
                    {{ __('Pengaduan (Laporan)') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('customer.dashboard')" :active="request()->routeIs('customer.dashboard')">
                    {{ __('Cari Kamar') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('customer.pesan.index')" :active="request()->routeIs('customer.pesan.index')">
                    {{ __('Riwayat Sewa') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('customer.pengaduan.index')" :active="request()->routeIs('customer.pengaduan.index')">
                    {{ __('Pengaduan / Bantuan') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
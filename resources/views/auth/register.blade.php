<x-guest-layout>
    <div class="relative min-h-screen w-full flex items-center justify-center overflow-hidden">
        
        <div class="fixed inset-0 z-0">
            <img src="{{ asset('images/kamar.jpeg') }}" 
                 class="w-full h-full object-cover" 
                 alt="Background Kamar">
            <div class="absolute inset-0 bg-white/20 backdrop-blur-[5px]"></div>
        </div>

        <div class="fixed inset-0 z-10 pointer-events-none">
            <div class="absolute right-0 top-0 h-full w-full bg-indigo-700 opacity-90" 
                 style="clip-path: polygon(100% 0, 100% 100%, 40% 100%, 90% 0);"></div>
        </div>

        <div class="relative z-20 w-full max-w-[500px] px-6 py-10"> 
            <div class="bg-white/80 backdrop-blur-xl p-8 md:p-10 rounded-[40px] shadow-2xl border border-white/50">
                
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-black text-slate-900 tracking-tighter">
                        KOST<span class="text-indigo-600">KU</span>
                    </h2>
                    <p class="text-sm text-slate-600 font-semibold mt-2 uppercase tracking-widest">Buat Akun Baru</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Nama Lengkap')" class="font-bold text-slate-700" />
                        <x-text-input id="name" class="block mt-1 w-full bg-white/50 border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl px-4 py-3" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" class="font-bold text-slate-700" />
                        <x-text-input id="email" class="block mt-1 w-full bg-white/50 border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl px-4 py-3" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" class="font-bold text-slate-700" />
                        <x-text-input id="password" class="block mt-1 w-full bg-white/50 border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl px-4 py-3"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="font-bold text-slate-700" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full bg-white/50 border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl px-4 py-3"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="mt-8">
                        <button type="submit" class="w-full py-4 bg-pink-500 hover:bg-pink-600 text-white font-black uppercase tracking-widest rounded-full transition-all shadow-lg shadow-pink-200 active:scale-95">
                            DAFTAR SEKARANG
                        </button>
                    </div>

                    <div class="text-center mt-6">
                        <p class="text-sm text-gray-600">
                            Sudah punya akun? 
                            <a href="{{ route('login') }}" class="text-indigo-600 font-black hover:underline uppercase tracking-tighter">Login di sini</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
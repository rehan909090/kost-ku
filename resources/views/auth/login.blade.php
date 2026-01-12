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

        <div class="relative z-20 w-full max-w-[450px] px-6"> 
            <div class="bg-white/80 backdrop-blur-xl p-10 rounded-[40px] shadow-2xl border border-white/50">
                
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-black text-slate-900 tracking-tighter">
                        KOST<span class="text-indigo-600">KU</span>
                    </h2>
                    <p class="text-sm text-slate-600 font-semibold mt-2 uppercase tracking-widest">Silahkan Login</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Email')" class="font-bold text-slate-700" />
                        <x-text-input id="email" class="block mt-1 w-full bg-white/50 border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl px-4 py-3" type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" class="font-bold text-slate-700" />
                        <x-text-input id="password" class="block mt-1 w-full bg-white/50 border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl px-4 py-3"
                                        type="password" name="password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm" name="remember">
                            <span class="ms-2 text-sm text-gray-600">Ingat Saya</span>
                        </label>
                        
                        <a class="text-sm text-indigo-600 font-bold hover:text-indigo-800" href="{{ route('password.request') }}">
                            Lupa?
                        </a>
                    </div>

                    <div class="mt-8">
                        <button type="submit" class="w-full py-4 bg-pink-500 hover:bg-pink-600 text-white font-black uppercase tracking-widest rounded-full transition-all shadow-lg active:scale-95">
                            MASUK
                        </button>
                    </div>

                    <div class="text-center mt-6">
                        <p class="text-sm text-gray-500">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" class="text-indigo-600 font-black hover:underline">DAFTAR</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tiket Clone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white h-screen w-full overflow-hidden">
    
    <div class="flex w-full h-full">
        
        <div class="w-full lg:w-[45%] xl:w-[40%] flex flex-col justify-center px-8 md:px-16 lg:px-20 py-12 bg-white relative z-10">
            
            <div class="max-w-[420px] w-full mx-auto">
                <div class="mb-10">
                   <span class="bg-blue-600 text-white p-2 rounded-lg font-bold text-xl inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        TiketClone
                   </span>
                </div>

                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-slate-900 tracking-tight">Selamat Datang</h2>
                    <p class="text-slate-500 mt-2 text-base">Masukan detail akun anda untuk memulai perjalanan.</p>
                </div>

                @if(session('error'))
                    <div class="flex items-center p-4 mb-6 text-sm text-red-800 border border-red-200 rounded-xl bg-red-50" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            {{ session('error') }}
                        </div>
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" 
                               class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 outline-none focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-all duration-200 placeholder:text-slate-400" 
                               required placeholder="nama@email.com">
                    </div>
                    
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="block text-sm font-semibold text-slate-700">Password</label>
                            <a href="#" class="text-xs font-semibold text-blue-600 hover:text-blue-700">Lupa Password?</a>
                        </div>
                        <input type="password" name="password" 
                               class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 outline-none focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-all duration-200 placeholder:text-slate-400" 
                               required placeholder="••••••••">
                    </div>
                    
                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3.5 rounded-xl hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-600/30 transition-all duration-300 transform active:scale-[0.98]">
                        Masuk Sekarang
                    </button>
                </form>

                <div class="relative flex py-8 items-center">
                    <div class="flex-grow border-t border-slate-200"></div>
                    <span class="flex-shrink mx-4 text-slate-400 text-xs font-semibold uppercase tracking-wide">Atau lanjut dengan</span>
                    <div class="flex-grow border-t border-slate-200"></div>
                </div>

                <a href="{{ route('google.login') }}" class="flex items-center justify-center gap-3 w-full bg-white border border-slate-200 text-slate-700 font-semibold py-3 rounded-xl hover:bg-slate-50 hover:border-slate-300 transition duration-200 group">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" class="w-5 h-5 group-hover:scale-110 transition-transform duration-300">
                    <span>Google Account</span>
                </a>

                <p class="text-center text-sm text-slate-500 mt-10">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:text-blue-700 hover:underline transition">Daftar disini</a>
                </p>
            </div>
        </div>

        <div class="hidden lg:block lg:w-[55%] xl:w-[60%] relative h-full overflow-hidden">
            <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?q=80&w=2649&auto=format&fit=crop" 
                 class="absolute inset-0 w-full h-full object-cover transition-transform duration-[10s] hover:scale-105" 
                 alt="Resort View">
            
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/30 to-transparent"></div>
            
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>

            <div class="absolute bottom-0 left-0 right-0 p-16 xl:p-24 text-white z-20">
                <div class="bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-3xl max-w-xl shadow-2xl">
                    <div class="flex items-center gap-2 mb-4 text-blue-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <span class="text-sm font-bold tracking-widest uppercase">Premium Experience</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold leading-tight mb-4">
                        Jelajahi dunia dengan cara yang lebih mudah.
                    </h2>
                    <p class="text-slate-300 text-lg leading-relaxed">
                        Nikmati akses eksklusif ke ribuan hotel dan penerbangan terbaik dengan harga yang tidak ada duanya.
                    </p>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru - TiketClone</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white h-screen w-full overflow-hidden">

    <div class="flex w-full h-full">
        
        <div class="w-full lg:w-[45%] xl:w-[40%] h-full bg-white relative z-10 overflow-y-auto">
            <div class="flex flex-col justify-center min-h-full px-8 md:px-16 lg:px-20 py-12">
                
                <div class="max-w-[420px] w-full mx-auto">
                    <div class="mb-8">
                        <span class="bg-brand-600 text-white p-2 rounded-lg font-bold text-lg inline-flex items-center gap-2 shadow-lg shadow-brand-500/30">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            TiketClone
                        </span>
                    </div>

                    <div class="mb-8">
                        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Mulai Perjalanan Anda</h1>
                        <p class="text-slate-500 mt-2 text-base">Buat akun baru dalam hitungan detik untuk mendapatkan penawaran terbaik.</p>
                    </div>

                    @if($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-4 rounded-xl mb-6 text-sm flex items-start gap-3 shadow-sm">
                            <svg class="w-5 h-5 shrink-0 mt-0.5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h4 class="font-bold mb-1">Periksa input Anda</h4>
                                <ul class="list-disc pl-4 space-y-1 text-red-600/90">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('register.post') }}" method="POST" class="space-y-5">
                        @csrf
                        
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                            <input type="text" name="name" 
                                   class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 outline-none focus:bg-white focus:border-brand-600 focus:ring-1 focus:ring-brand-600 transition-all duration-200 placeholder:text-slate-400" 
                                   placeholder="Contoh: Budi Santoso" value="{{ old('name') }}" required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Email</label>
                            <input type="email" name="email" 
                                   class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 outline-none focus:bg-white focus:border-brand-600 focus:ring-1 focus:ring-brand-600 transition-all duration-200 placeholder:text-slate-400" 
                                   placeholder="nama@email.com" value="{{ old('email') }}" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
                                <input type="password" name="password" 
                                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 outline-none focus:bg-white focus:border-brand-600 focus:ring-1 focus:ring-brand-600 transition-all duration-200 placeholder:text-slate-400" 
                                       placeholder="Min. 6 karakter" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi</label>
                                <input type="password" name="password_confirmation" 
                                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 outline-none focus:bg-white focus:border-brand-600 focus:ring-1 focus:ring-brand-600 transition-all duration-200 placeholder:text-slate-400" 
                                       placeholder="Ulangi password" required>
                            </div>
                        </div>

                        <button class="w-full bg-brand-600 text-white font-bold py-3.5 rounded-xl hover:bg-brand-700 hover:shadow-lg hover:shadow-brand-600/30 transition-all duration-300 transform active:scale-[0.98] mt-2">
                            Daftar Sekarang
                        </button>
                    </form>

                    <div class="mt-8 text-center text-sm text-slate-500">
                        Sudah menjadi member? 
                        <a href="{{ route('login') }}" class="font-bold text-brand-600 hover:text-brand-700 hover:underline transition">Masuk ke akun Anda</a>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="hidden lg:block lg:w-[55%] xl:w-[60%] relative h-full overflow-hidden bg-slate-900">
            <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=2670&auto=format&fit=crop" 
                 class="absolute inset-0 w-full h-full object-cover opacity-90 transition-transform duration-[20s] hover:scale-110" 
                 alt="Luxury Hotel Pool">
            
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent"></div>
            
            <div class="absolute bottom-0 left-0 p-16 xl:p-24 text-white z-20 w-full">
                
                <div class="grid grid-cols-2 gap-6 mb-8 max-w-lg">
                    <div class="bg-white/10 backdrop-blur-sm p-4 rounded-2xl border border-white/10">
                        <div class="text-3xl font-bold mb-1">500+</div>
                        <div class="text-sm text-slate-300">Maskapai Partner</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm p-4 rounded-2xl border border-white/10">
                        <div class="text-3xl font-bold mb-1">1Jt+</div>
                        <div class="text-sm text-slate-300">Hotel Pilihan</div>
                    </div>
                </div>

                <h2 class="text-4xl font-bold leading-tight mb-4">
                    Bergabung bersama jutaan traveler lainnya.
                </h2>
                <p class="text-slate-300 text-lg leading-relaxed max-w-xl">
                    Dapatkan akses eksklusif ke harga member, promo flash sale, dan kumpulkan poin untuk liburan gratis berikutnya.
                </p>
            </div>
        </div>

    </div>

</body>
</html>
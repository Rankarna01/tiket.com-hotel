<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru - TiketClone</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        'brand-blue': '#005CEE',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 h-screen flex items-center justify-center p-4">

    <div class="bg-white p-8 md:p-10 rounded-2xl shadow-xl w-full max-w-md border border-gray-100">
        
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-slate-800">Buat Akun Baru</h1>
            <p class="text-slate-500 text-sm mt-1">Gabung dan nikmati promo spesial!</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border border-red-100 text-red-600 px-4 py-3 rounded-xl mb-6 text-sm flex items-start gap-2">
                <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <ul class="list-disc pl-4 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" 
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-blue focus:border-brand-blue outline-none transition text-sm" 
                       placeholder="Contoh: Budi Santoso" value="{{ old('name') }}" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                <input type="email" name="email" 
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-blue focus:border-brand-blue outline-none transition text-sm" 
                       placeholder="nama@email.com" value="{{ old('email') }}" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
                <input type="password" name="password" 
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-blue focus:border-brand-blue outline-none transition text-sm" 
                       placeholder="Minimal 6 karakter" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" 
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-blue focus:border-brand-blue outline-none transition text-sm" 
                       placeholder="Ulangi password" required>
            </div>

            <button class="w-full bg-brand-blue text-white font-bold py-3.5 rounded-xl hover:brightness-110 shadow-lg shadow-blue-500/30 transition transform active:scale-[0.98]">
                Daftar Sekarang
            </button>
        </form>

        <div class="mt-8 text-center text-sm text-slate-600">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="font-bold text-brand-blue hover:underline">Masuk di sini</a>
        </div>

    </div>

</body>
</html>
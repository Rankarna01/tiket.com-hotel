<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tiket Clone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 h-screen flex items-center justify-center font-sans">
    
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-sm border border-slate-100">
        
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-slate-800">Selamat Datang Kembali</h2>
            <p class="text-slate-500 text-sm mt-1">Silakan masuk ke akun Anda</p>
        </div>

        @if(session('error'))
            <div class="bg-red-50 text-red-600 text-sm p-3 rounded-lg mb-4 border border-red-100">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" 
                       class="w-full border border-slate-300 rounded-xl px-4 py-2.5 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition" 
                       required placeholder="nama@email.com">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Password</label>
                <input type="password" name="password" 
                       class="w-full border border-slate-300 rounded-xl px-4 py-2.5 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition" 
                       required placeholder="••••••••">
            </div>
            
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-500/30">
                Masuk
            </button>
        </form>

        <div class="relative flex py-6 items-center">
            <div class="flex-grow border-t border-slate-200"></div>
            <span class="flex-shrink mx-4 text-slate-400 text-xs font-medium uppercase">Atau masuk dengan</span>
            <div class="flex-grow border-t border-slate-200"></div>
        </div>

        <a href="{{ route('google.login') }}" class="flex items-center justify-center gap-3 w-full bg-white border border-slate-300 text-slate-700 font-bold py-2.5 rounded-xl hover:bg-slate-50 transition shadow-sm group">
            <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" class="w-5 h-5 group-hover:scale-110 transition">
            <span>Google</span>
        </a>

        <p class="text-center text-sm text-slate-600 mt-8">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">Daftar Sekarang</a>
        </p>

    </div>

</body>
</html>
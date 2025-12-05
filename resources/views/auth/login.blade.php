<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login Admin</title>
</head>
<body class="bg-slate-100 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-96">
        <h2 class="text-2xl font-bold text-center mb-6 text-slate-800">Admin Login</h2>
        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" class="w-full border rounded-lg px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Password</label>
                <input type="password" name="password" class="w-full border rounded-lg px-3 py-2" required>
            </div>
            <button class="w-full bg-blue-600 text-white font-bold py-2 rounded-lg hover:bg-blue-700">Masuk</button>
        </form>
    </div>
</body>
</html>
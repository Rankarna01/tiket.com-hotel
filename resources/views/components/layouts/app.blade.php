<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking - Mirip Tiket.com</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        // Kita siapkan slot warna primary tiket.com (biru)
                        // Nanti bisa kita sesuaikan hex code-nya sesuai slicing kamu
                        'brand-blue': '#005CEE', 
                        'brand-yellow': '#FEDD00',
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Mencegah flash unstyled content (opsional) */
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-poppins bg-gray-50 text-gray-800 antialiased">

    {{-- <x-shared.navbar /> --}}

    <x-shared.navbar />
    
    <main class="min-h-screen">
        {{ $slot }}
    </main>

    <x-shared.footer />

</body>
</html>
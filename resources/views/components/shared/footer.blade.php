<footer class="bg-white pt-16 pb-8 border-t border-slate-200 mt-20 font-poppins">
    <div class="mx-auto max-w-[120rem] px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 mb-16">
            
            <div class="lg:col-span-3 space-y-6">
                <a href="{{ route('home') }}" class="flex items-center gap-1 group mb-4">
                    <span class="text-4xl font-bold text-blue-600 tracking-tighter">tiket</span>
                    <div class="w-3 h-3 rounded-full bg-yellow-400 mt-3"></div>
                    <span class="text-4xl font-bold text-blue-600 tracking-tighter">clone</span>
                </a>

                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 flex-shrink-0">
                            <i class="fa-brands fa-whatsapp text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 mb-0.5">WhatsApp</p>
                            <p class="text-sm font-bold text-slate-800 hover:text-blue-600 cursor-pointer">+62 858 1150 0888</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 flex-shrink-0">
                            <i class="fa-regular fa-envelope text-lg"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 mb-0.5">Email</p>
                            <p class="text-sm font-bold text-slate-800 hover:text-blue-600 cursor-pointer">cs@tiketclone.com</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-6 grid grid-cols-2 md:grid-cols-3 gap-8">
                
                <div>
                    <h4 class="font-bold text-slate-900 mb-4">Eksplorasi</h4>
                    <ul class="space-y-3 text-sm text-slate-600">
                        <li><a href="{{ route('home') }}#inspirasi" class="hover:text-blue-600 transition">Inspirasi Liburan</a></li>
                        <li><a href="{{ route('home') }}#destinasi" class="hover:text-blue-600 transition">Destinasi Favorit</a></li>
                        <li><a href="{{ route('home') }}#partner" class="hover:text-blue-600 transition">Partner Hotel</a></li>
                        <li><a href="{{ route('home') }}#promo" class="hover:text-blue-600 transition">Promo & Diskon</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 mb-4">Layanan</h4>
                    <ul class="space-y-3 text-sm text-slate-600">
                        <li><a href="{{ route('home') }}" class="hover:text-blue-600 transition">Booking Hotel</a></li>
                        <li><a href="{{ route('home') }}#special-offer" class="hover:text-blue-600 transition">Special Offer</a></li>
                        <li><a href="#" class="hover:text-blue-600 transition">Cek Pesanan</a></li>
                        <li><a href="#" class="hover:text-blue-600 transition">Tiket Points</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 mb-4">Akun</h4>
                    <ul class="space-y-3 text-sm text-slate-600">
                        @auth
                            <li><a href="#" class="hover:text-blue-600 transition text-blue-600 font-semibold">Halo, {{ Auth::user()->name }}</a></li>
                            @if(Auth::user()->role === 'admin')
                                <li><a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition">Dashboard Admin</a></li>
                            @endif
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="hover:text-red-600 transition">Keluar</button>
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}" class="hover:text-blue-600 transition">Masuk (Login)</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-blue-600 transition">Daftar Akun</a></li>
                            <li><a href="{{ route('login') }}" class="hover:text-blue-600 transition">Akses Admin</a></li>
                        @endauth
                    </ul>
                </div>
            </div>

            <div class="lg:col-span-3">
                <h4 class="font-bold text-slate-900 mb-4">Lebih murah di aplikasi</h4>
                <div class="space-y-3">
                    <a href="#" class="block w-40 hover:opacity-80 transition">
                        <img src="https://s-light.tiket.photos/t/01E25EBZS3W0FY9GTG6C42E1SE/original/core-fe/2023/10/02/1fb1b9f7-d1c1-4f4a-b3d0-fbc4bf650d46-1696218535267-2e77104dddb49130433a2fa22f28a1ff.png" alt="App Store" class="w-full">
                    </a>
                    <a href="#" class="block w-40 hover:opacity-80 transition">
                        <img src="https://s-light.tiket.photos/t/01E25EBZS3W0FY9GTG6C42E1SE/original/core-fe/2023/10/02/02f04be0-f138-40ba-8029-a903ca5e8f7c-1696218550137-4101e40f1d4d7099144a3f1ccd37d22c.png" alt="Google Play" class="w-full">
                    </a>
                </div>
            </div>

        </div>

        <div class="border-t border-slate-100 pt-8 pb-12">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6 text-center md:text-left">
                
                <div class="flex items-center gap-3">
                    <img src="https://s-light.tiket.photos/t/01E25EBZS3W0FY9GTG6C42E1SE/original/core-fe/2023/10/02/9bd6e26d-c968-4312-9877-b106bcf2d098-1696218640180-2c67098b30425b39967bbda9fec47b50.png" class="h-8 object-contain opacity-80 grayscale hover:grayscale-0 transition">
                    <div class="text-[10px] text-slate-500 leading-tight font-medium">
                        Partner Resmi<br>Kemenparekraf RI
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <a href="#" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-blue-600 hover:text-white transition"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-pink-600 hover:text-white transition"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-sky-500 hover:text-white transition"><i class="fa-brands fa-twitter"></i></a>
                </div>
            </div>
        </div>

        <div class="border-t border-slate-100 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-xs text-slate-500">
                &copy; 2011-2025 PT. Global Tiket Clone Network. All Rights Reserved.
            </p>
            <div class="flex items-center gap-1 opacity-80">
                <span class="text-blue-500 font-bold text-lg">blibli</span>
                <span class="text-yellow-400 font-bold text-lg">tiket</span>
            </div>
        </div>

    </div>
</footer>
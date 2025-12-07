<div class="mb-8 w-full max-w-6xl mx-auto"> <div class="flex justify-between items-center mb-4 px-1">
        <h3 class="text-lg font-bold text-slate-900">Serunya Nginep di Sini</h3>
        
        <div class="flex gap-2">
            <button onclick="scrollSlider('left')" class="w-10 h-10 flex items-center justify-center bg-white border border-slate-200 rounded-lg hover:bg-slate-50 hover:shadow-sm transition focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-slate-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>
            <button onclick="scrollSlider('right')" class="w-10 h-10 flex items-center justify-center bg-white border border-slate-200 rounded-lg hover:bg-slate-50 hover:shadow-sm transition focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-slate-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>
    </div>
    
    <div id="slider-container" class="flex gap-4 overflow-x-auto pb-4 custom-scrollbar snap-x scroll-smooth no-scrollbar">
        
        <div class="min-w-[280px] md:min-w-[320px] bg-white border border-slate-100 rounded-xl p-4 flex gap-4 snap-start hover:shadow-md transition">
            <div class="w-12 h-12 flex-shrink-0">
                <img src="https://s-light.tiket.photos/t/01E25EBZS3W0FY9GTG6C42E1SE/t_htl-mobile/test-discovery/2024/03/13/39ad8e8c-44b8-490f-a280-8878878694b2-1710323343561-61949c9e236e9ced5c5e1194a37a0d89.png" alt="Icon" class="w-full h-full rounded-lg object-cover">
            </div>
            <div>
                <h4 class="font-bold text-slate-800 text-sm mb-1">Bisa buat nginep rame-rame</h4>
                <p class="text-slate-600 text-xs leading-relaxed">Nikmati fasilitas menarik, seperti ruang tamu yang luas untuk kumpul keluarga.</p>
            </div>
        </div>

        <div class="min-w-[280px] md:min-w-[320px] bg-white border border-slate-100 rounded-xl p-4 flex gap-4 snap-start hover:shadow-md transition">
            <div class="w-12 h-12 flex-shrink-0">
                <img src="https://s-light.tiket.photos/t/01E25EBZS3W0FY9GTG6C42E1SE/original/test-discovery/2024/03/13/d5ba33c3-8230-4fcd-80e5-849c846fadf1-1710323343007-c5ffd73e671f1e5e7860ec61ae975290.png" alt="Icon" class="w-full h-full rounded-lg object-cover">
            </div>
            <div>
                <h4 class="font-bold text-slate-800 text-sm mb-1">Cocok buat rileks dan recharge</h4>
                <p class="text-slate-600 text-xs leading-relaxed">Manjakan diri dengan bathtub dan layanan spa yang tersedia.</p>
            </div>
        </div>

        <div class="min-w-[280px] md:min-w-[320px] bg-white border border-slate-100 rounded-xl p-4 flex gap-4 snap-start hover:shadow-md transition">
            <div class="w-12 h-12 flex-shrink-0">
                <img src="https://s-light.tiket.photos/t/01E25EBZS3W0FY9GTG6C42E1SE/t_htl-mobile/test-discovery/2024/03/13/b91b798e-b14f-4511-b698-172cf05d4f7c-1710323343300-e46777ab6afaa30ed4067a5e81b04f84.png" alt="Icon" class="w-full h-full rounded-lg object-cover">
            </div>
            <div>
                <h4 class="font-bold text-slate-800 text-sm mb-1">Tersedia tempat makan</h4>
                <p class="text-slate-600 text-xs leading-relaxed">Nggak perlu keluar buat beli makanan! Ada restoran enak di akomodasi ini.</p>
            </div>
        </div>

        <div class="min-w-[280px] md:min-w-[320px] bg-white border border-slate-100 rounded-xl p-4 flex gap-4 snap-start hover:shadow-md transition">
            <div class="w-12 h-12 flex-shrink-0">
                <img src="https://s-light.tiket.photos/t/01E25EBZS3W0FY9GTG6C42E1SE/t_htl-mobile/hotel/2023/01/31/40083cc7-7ce9-4865-a3c5-35f22a15ac35-1675163575465-eaf1265a47d5b5def99bc6245e1cb8bf.png" alt="Icon" class="w-full h-full rounded-lg object-cover">
            </div>
            <div>
                <h4 class="font-bold text-slate-800 text-sm mb-1">Dekat dengan alam</h4>
                <p class="text-slate-600 text-xs leading-relaxed">Lokasi yang asri dengan pemandangan hijau yang menyegarkan mata.</p>
            </div>
        </div>
        
         <div class="min-w-[280px] md:min-w-[320px] bg-white border border-slate-100 rounded-xl p-4 flex gap-4 snap-start hover:shadow-md transition">
            <div class="w-12 h-12 flex-shrink-0 bg-slate-100 rounded-lg flex items-center justify-center text-2xl">
                🏪
            </div>
            <div>
                <h4 class="font-bold text-slate-800 text-sm mb-1">Dekat Pusat Belanja</h4>
                <p class="text-slate-600 text-xs leading-relaxed">Akses mudah ke mall dan pusat oleh-oleh terdekat.</p>
            </div>
        </div>

    </div>
</div>

<script>
    function scrollSlider(direction) {
        const container = document.getElementById('slider-container');
        // Jarak scroll disesuaikan dengan lebar card + gap (320px + 16px gap)
        const scrollAmount = 336; 

        if (direction === 'left') {
            container.scrollBy({
                left: -scrollAmount,
                behavior: 'smooth'
            });
        } else {
            container.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        }
    }
</script>

<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
</style>
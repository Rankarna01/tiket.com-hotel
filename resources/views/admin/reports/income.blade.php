<x-layouts.admin>
    <h1 class="text-2xl font-bold text-slate-800 mb-6">Laporan Pendapatan</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-green-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-xl">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </div>
                <div>
                    <p class="text-sm text-slate-500">Total Pendapatan Bersih</p>
                    <h3 class="text-3xl font-bold text-slate-800">IDR {{ number_format($totalRevenue) }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-blue-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-xl">
                    <i class="fa-solid fa-receipt"></i>
                </div>
                <div>
                    <p class="text-sm text-slate-500">Transaksi Berhasil</p>
                    <h3 class="text-3xl font-bold text-slate-800">{{ $successCount }}x</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <h3 class="font-bold text-lg mb-4">Rincian Per Bulan</h3>
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-slate-200 text-slate-500 text-sm">
                    <th class="py-3">Bulan</th>
                    <th class="py-3">Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($monthlyRevenue as $data)
                <tr class="border-b border-slate-100">
                    <td class="py-3 font-bold text-slate-700">{{ $data->months }}</td>
                    <td class="py-3 text-green-600 font-bold">IDR {{ number_format($data->sums) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.admin>
@extends('layouts.app') {{-- Sesuaikan dengan layout adminmu --}}

@section('content')
<div class="container mx-auto px-6 py-8">
    
    <h3 class="text-gray-700 text-3xl font-medium mb-6">Dashboard Admin</h3>

    {{-- GRID INFO BOX --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        {{-- BOX 1: TOTAL USER --}}
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500 flex items-center">
            <div class="p-3 rounded-full bg-blue-100 mr-4">
                {{-- Icon User --}}
                <svg class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium uppercase">Total Pengguna</p>
                <p class="text-2xl font-bold text-gray-700">{{ $totalUsers }}</p>
            </div>
        </div>

        {{-- BOX 2: TOTAL HOTEL --}}
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500 flex items-center">
            <div class="p-3 rounded-full bg-green-100 mr-4">
                {{-- Icon Hotel (Building) --}}
                <svg class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium uppercase">Total Hotel</p>
                <p class="text-2xl font-bold text-gray-700">{{ $totalHotels }}</p>
            </div>
        </div>

        {{-- BOX 3: TOTAL LOKASI --}}
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500 flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 mr-4">
                {{-- Icon Map --}}
                <svg class="h-8 w-8 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium uppercase">Destinasi</p>
                <p class="text-2xl font-bold text-gray-700">{{ $totalLocations }}</p>
            </div>
        </div>

        {{-- BOX 4: TOTAL PARTNER --}}
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500 flex items-center">
            <div class="p-3 rounded-full bg-purple-100 mr-4">
                {{-- Icon Handshake/Users --}}
                <svg class="h-8 w-8 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium uppercase">Mitra Hotel</p>
                <p class="text-2xl font-bold text-gray-700">{{ $totalPartners }}</p>
            </div>
        </div>
    </div>

    {{-- SECTION TAMBAHAN: USER TERBARU --}}
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-700">Pengguna Baru Terdaftar</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Gabung</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($latestUsers as $user)
                    <tr>
                        <td class="py-4 px-6 text-sm font-medium text-gray-900">{{ $user->name }}</td>
                        <td class="py-4 px-6 text-sm text-gray-500">{{ $user->email }}</td>
                        <td class="py-4 px-6 text-sm text-gray-500">{{ $user->created_at->diffForHumans() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            {{-- Pastikan route ini ada, atau ganti href="#" jika belum ada --}}
            <a href="{{ route('users.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">Lihat Semua Pengguna &rarr;</a>
        </div>
    </div>

</div>
@endsection
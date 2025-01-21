<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10 px-6">
        <div class="max-w-screen-xl mx-auto">

            {{-- Filter Waktu --}}
            <div class="flex justify-start mb-6">
                <form method="GET" action="{{ route('dashboard') }}" class="flex items-center space-x-4">
                    <label for="time_frame" class="text-lg font-semibold text-gray-700">Filter Waktu:</label>
                    <select name="time_frame" id="time_frame" onchange="this.form.submit()" class="px-4 py-2 bg-blue-100 text-gray-700 border border-gray-300 rounded-lg focus:outline-none">
                        <option value="daily" {{ request('time_frame') == 'daily' ? 'selected' : '' }}>Harian</option>
                        <option value="weekly" {{ request('time_frame') == 'weekly' ? 'selected' : '' }}>Mingguan</option>
                        <option value="monthly" {{ request('time_frame') == 'monthly' ? 'selected' : '' }}>Bulanan</option>
                    </select>
                </form>
            </div>

            {{-- Statistik --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                {{-- Pengguna Aktif --}}
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h5 class="text-xl font-semibold text-blue-700">Pengguna Aktif</h5>
                    <p class="text-3xl font-bold text-blue-800">{{ $activeUsers ?? 0 }}</p>
                </div>

                {{-- Jumlah Chirps --}}
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h5 class="text-xl font-semibold text-green-700">Jumlah Chirps</h5>
                    <p class="text-3xl font-bold text-green-800">{{ $chirpsCount ?? 0 }}</p>
                </div>

                {{-- Laporan Pelanggaran --}}
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h5 class="text-xl font-semibold text-red-700">Laporan Pelanggaran</h5>
                    <p class="text-3xl font-bold text-red-800">{{ $reportCount ?? 0 }}</p>
                </div>

            </div>

            {{-- Grafik Aktivitas Pengguna --}}
            <div class="bg-white rounded-lg shadow-md mt-6 p-6">
                <h4 class="text-center text-2xl font-semibold text-gray-800 mb-4">Aktivitas Pengguna</h4>
                <canvas id="dashboardChart" class="w-full h-72"></canvas>
            </div>

        </div>
    </div>
</x-app-layout>

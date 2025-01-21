<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Tambahkan CSS Quill -->
        <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('#chirpForm');
            const editor = new Quill('#editor', { theme: 'snow' });

            form.addEventListener('submit', function (e) {
                e.preventDefault(); // Mencegah pengiriman form standar

                // Ambil konten dari editor Quill
                const message = editor.root.innerHTML;

                // Buat objek FormData
                const formData = new FormData(form);
                formData.append('message', message); // Tambahkan data message ke FormData

                // Kirim data menggunakan fetch
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Pastikan CSRF token ada
                    },
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        window.location.href = "{{ route('chirps.index') }}"; // Redirect ke halaman setelah sukses
                    } else {
                        console.error('Gagal mengirim data!');
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const activeUsers = {{ $activeUsers ?? 0 }};
            const chirpsCount = {{ $chirpsCount ?? 0 }};
            const reportCount = {{ $reportCount ?? 0 }};
            const timeFrame = '{{ request('time_frame', 'daily') }}';

            const ctx = document.getElementById('dashboardChart').getContext('2d');
            const dashboardChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Harian', 'Mingguan', 'Bulanan'],
                    datasets: [{
                        label: 'Jumlah Aktivitas',
                        data: [
                            chirpsCount, 
                            chirpsCount * 7, 
                            chirpsCount * 30
                        ], // Gunakan variabel JavaScript untuk menghindari masalah dengan PHP
                        backgroundColor: ['#3b82f6', '#22c55e', '#ef4444'],
                        borderColor: ['#2563eb', '#16a34a', '#dc2626'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                font: {
                                    size: 10 // Ukuran font lebih kecil untuk label sumbu Y
                                }
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    size: 10 // Ukuran font lebih kecil untuk label sumbu X
                                }
                            }
                        }
                    }
                }
            });
        </script>
            <script>
        var ctx = document.getElementById('dashboardChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Hari 1', 'Hari 2', 'Hari 3', 'Hari 4', 'Hari 5'],
                datasets: [{
                    label: 'Aktivitas',
                    data: [{{ $chirpsCount ?? 0 }}, 12, 19, 3, 5], 
                    borderColor: '#4CAF50',
                    backgroundColor: 'rgba(76, 175, 80, 0.2)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
            }
        });
    </script>

    </body>
</html>

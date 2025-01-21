<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Reports') }}
            </h2>
        </x-slot>

        @if(session('status'))
            <div class="bg-green-100 text-green-800 p-4 rounded-sm my-4">{{ session('status') }}</div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left">Reporter</th>
                        <th class="px-6 py-3 text-left">Reported</th>
                        <th class="px-6 py-3 text-left">Reason</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reports as $report)
                        <tr>
                            <td class="px-6 py-4">{{ $report->reporter->name }}</td>
                            <td class="px-6 py-4">
                                @if($report->reported_type === 'App\Models\Chirp' && $report->reported)
                                 {!! $report->reported->message ?? 'Deleted Chirp' !!}
                                @elseif($report->reported_type === 'App\Models\User' && $report->reported)
                                {{ $report->reported->name ?? 'Deleted User' }}
                                @else
                                    <span class="italic bold inline-block px-3 py-1 text-xs font-medium bg-red-100 text-red-600 rounded-sm">Deleted</span>
                                @endif
                            </td>
    
                            <td class="px-6 py-4">{{ $report->reason }}</td>
                            <td class="px-6 py-4 space-x-2">
                                <form action="{{ route('admin.reports.action', $report) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="action" value="delete">
                                    <button class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                                </form>

                                @if($report->reported_type === 'User')
                                    <form action="{{ route('admin.reports.action', $report) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="action" value="deactivate">
                                        <button class="bg-blue-500 text-white px-3 py-1 rounded">Deactivate</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

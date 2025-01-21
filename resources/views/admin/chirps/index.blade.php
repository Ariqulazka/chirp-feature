<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Header -->
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Chirps') }}
            </h2>
        </x-slot>

        <!-- Status Notification -->
        @if (session('status'))
            <div class="bg-green-100 text-green-800 p-4 rounded-sm mb-4 sm:mb-6 shadow-md animate-fade-in">
                {{ session('status') }}
            </div>
        @endif

        <!-- Chirps Table -->
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 sm:px-6 py-3 text-center font-medium">User</th>
                        <th class="px-4 sm:px-6 py-3 text-center font-medium">Chirp</th>
                        <th class="px-4 sm:px-6 py-3 text-center font-medium">Posted At</th>
                        <th class="px-4 sm:px-6 py-3 text-center font-medium">Status</th>
                        <th class="px-4 sm:px-6 py-3 text-center font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
    @foreach($chirps as $chirp)
        <tr class="{{ $chirp->is_reviewed ? 'bg-green-50' : 'bg-red-50' }} hover:bg-indigo-50 transition duration-200 transform hover:scale-[1.01]">
            <!-- User -->
            <td class="px-4 sm:px-6 py-4 text-center text-gray-800">{{ $chirp->user->name }}</td>

            <!-- Chirp -->
            <td class="px-4 sm:px-6 py-4 text-center text-gray-600">
                <p class="truncate max-w-md">
                    {!! Str::limit($chirp->message, 50) !!}
                </p>
            </td>

            <!-- Posted At -->
            <td class="px-4 sm:px-6 py-4 text-center text-gray-600">{{ $chirp->created_at->format('d M Y') }}</td>

            <!-- Review Status -->
            <td class="px-4 sm:px-6 py-4 text-center">
                @if($chirp->is_reviewed)
                    <span class="inline-block px-3 py-1 text-xs font-medium bg-green-100 text-green-600 rounded-sm">
                        Reviewed
                    </span>
                @else
                    <span class="inline-block px-3 py-1 text-xs font-medium bg-red-100 text-red-600 rounded-sm">
                        Not Reviewed
                    </span>
                @endif
            </td>

            <!-- Actions -->
            <td class="px-4 sm:px-6 py-4 space-y-2 sm:space-y-0 sm:space-x-4 flex sm:flex-row flex-col items-center justify-center text-sm">
                <!-- Delete Action -->
                <form action="{{ route('admin.chirps.destroy', $chirp->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 px-3 py-1 rounded-sm transition-all duration-300 transform hover:scale-105 text-xs">
                        Delete
                    </button>
                </form>

                <!-- Mark for Review -->
                @if(!$chirp->is_reviewed)
                    <form action="{{ route('admin.chirps.review', $chirp->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 px-3 py-1 rounded-sm transition-all duration-300 transform hover:scale-105 text-xs">
                            Mark for Review
                        </button>
                    </form>
                @else
                    <button class="bg-gray-300 text-gray-600 cursor-not-allowed px-3 py-1 rounded-sm text-xs" disabled>
                        Reviewed
                    </button>
                @endif
            </td>
        </tr>
    @endforeach
</tbody>

            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $chirps->links() }}
        </div>
    </div>
</x-app-layout>

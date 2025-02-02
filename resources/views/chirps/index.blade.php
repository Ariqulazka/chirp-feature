<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Chirps') }}
            </h2>
        </x-slot>

        <form id="chirpForm" action="{{ route('chirps.store') }}" method="POST">
            @csrf
            <!-- Editor WYSIWYG -->
            <label for="message" class="block text-lg font-medium text-gray-700 mb-2">Message</label>
            <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                <div id="editor">
                    {!! old('message', '') !!}
                </div>
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
            </div>
            <x-primary-button class="mt-4">{{ __('Chirp') }}</x-primary-button>
        </form>

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($chirps as $chirp)
                @if ($chirp->is_deleted)
                    <!-- Jika Chirp Dihapus -->
                    <div class="p-6 flex space-x-2 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800">{{ $chirp->user->name }}</span>
                                    <small class="ml-2 text-sm text-gray-600">{{ $chirp->created_at->format('j M Y, g:i a') }}</small>
                                </div>
                            </div>
                            <p class="mt-4 text-lg text-gray-900">This chirp has been deleted by the admin.</p>
                            <small class="text-sm text-gray-600">Reason: {{ $chirp->deleted_reason }}</small>
                        </div>
                    </div>
                @else
                    <!-- Chirp yang tidak dihapus -->
                    <div class="p-6 flex space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800">{{ $chirp->user->name }}</span>
                                    <small class="ml-2 text-sm text-gray-600">{{ $chirp->created_at->format('j M Y, g:i a') }}</small>
                                    @unless ($chirp->created_at->eq($chirp->updated_at))
                                        <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                    @endunless
                                </div>
                                @if ($chirp->user->is(auth()->user()))
                                    <x-dropdown>
                                        <x-slot name="trigger">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            <x-dropdown-link :href="route('chirps.edit', $chirp)">
                                                {{ __('Edit') }}
                                            </x-dropdown-link>
                                            <form method="POST" action="{{ route('chirps.destroy', $chirp) }}">
                                                @csrf
                                                @method('delete')
                                                <textarea name="reason" class="w-full mt-2 p-2 border rounded" placeholder="Reason for deletion (optional)"></textarea>
                                            <x-dropdown-link :href="route('chirps.destroy', $chirp)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                @endif
                            </div>
                            <p class="mt-4 text-lg text-gray-900">{!! $chirp->message !!}</p>

                            <!-- Report Button Form -->
                            <form action="{{ route('report.store') }}" method="POST" class="mt-4">
                                @csrf
                                <input type="hidden" name="reported_id" value="{{ $chirp->id }}">
                                <input type="hidden" name="reported_type" value="{{ \App\Models\Chirp::class }}">
                                <textarea name="reason" class="w-full mt-2 p-2 border rounded" placeholder="Why do you want to report this chirp?" required></textarea>
                                <button type="submit" class="bg-red-500 text-white mt-2 px-4 py-2 rounded-sm hover:bg-red-600">Report</button>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>

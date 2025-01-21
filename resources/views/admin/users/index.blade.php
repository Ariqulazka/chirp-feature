<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <x-slot name="header">
         @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator'))
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ Auth::user()->hasRole('admin') ? __('Manage Users') : __('Users') }}
            </h2>
        @endif
        </x-slot>
        @if (session('status'))
            <div class="bg-green-100 text-green-800 p-4 rounded-sm mb-4 sm:mb-6 shadow-md animate-fade-in">
                {{ session('status') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 sm:px-6 py-3 text-center font-medium">Name</th>
                        <th class="px-4 sm:px-6 py-3 text-center font-medium">Email</th>
                        <th class="px-4 sm:px-6 py-3 text-center font-medium">Chirps Count</th>
                        <th class="px-4 sm:px-6 py-3 text-center font-medium">Role</th>
                        <th class="px-4 sm:px-6 py-3 text-center font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($users as $user)
                        <tr class="hover:bg-indigo-50 transition duration-200 transform hover:scale-[1.01]">
                            <td class="px-4 sm:px-6 py-4 text-center text-gray-800">{{ $user->name }}</td>
                            <td class="px-4 sm:px-6 py-4 text-center text-gray-600">{{ $user->email }}</td>
                            <td class="px-4 sm:px-6 py-4 text-center text-gray-600">{{ $user->chirps_count }}</td>
                            <td class="px-4 sm:px-6 py-4 text-center">
                                @foreach($user->roles as $role)
                                    <span class="inline-block px-3 py-1 text-xs font-medium 
                                        {{ $role->name === 'admin' ? 'bg-red-100 text-red-600' : 
                                           ($role->name === 'moderator' ? 'bg-blue-100 text-blue-600' : 'bg-green-100 text-green-600') }} 
                                        rounded-sm mb-1 animate-fade-in">
                                        {{ ucfirst($role->name) }}
                                    </span>
                                @endforeach
                            </td>
                            <td class="px-4 sm:px-6 py-4 space-y-2 sm:space-y-0 sm:space-x-4 flex sm:flex-row flex-col items-center justify-center text-sm">
                                @if(auth()->user()->hasRole('admin'))
                                    @if(auth()->user()->id !== $user->id)
                                        @if($user->is_active)
                                            <form action="{{ route('admin.users.deactivate', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="bg-red-500 text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 px-3 py-1 rounded-sm transition-all duration-300 transform hover:scale-105 text-xs">Deactivate</button>
                                            </form>
                                        @else
                                            <button class="bg-gray-300 text-gray-600 cursor-not-allowed focus:outline-none focus:ring-2 focus:ring-gray-300 px-3 py-1 rounded-sm text-xs">Deactivated</button>
                                        @endif

                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="bg-red-500 text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 px-3 py-1 rounded-sm transition-all duration-300 transform hover:scale-105 text-xs">Delete</button>
                                        </form>

                                        <form action="{{ route('admin.users.setRole', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            <div class="relative inline-block">
                                                <select name="role" class="block w-full sm:w-32 py-1.5 px-2 border border-gray-300 rounded-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-700 transition-all duration-300 text-xs">
                                                    <option value="admin" {{ $user->roles->contains('admin') ? 'selected' : '' }}>Admin</option>
                                                    <option value="moderator" {{ $user->roles->contains('moderator') ? 'selected' : '' }}>Moderator</option>
                                                    <option value="user" {{ $user->roles->contains('user') ? 'selected' : '' }}>User</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="bg-gray-800 text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 ml-0 sm:ml-2 px-3 py-1 rounded-sm transition-all duration-300 transform hover:scale-105 text-xs">Set Role</button>
                                        </form>
                                    @else
                                        <button class="bg-gray-300 text-gray-600 cursor-not-allowed focus:outline-none focus:ring-2 focus:ring-gray-300 ml-0 sm:ml-2 px-3 py-1 rounded-sm text-xs" disabled>You cannot change your own role</button>
                                    @endif
                                @else
                                    <button class="bg-gray-300 text-gray-600 cursor-not-allowed focus:outline-none focus:ring-2 focus:ring-gray-300 ml-0 sm:ml-2 px-3 py-1 rounded-sm text-xs" disabled>Not allowed</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

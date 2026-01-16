<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <x-slot name="header">
        <div class="flex justify-between items-center h-10 -my-6">
            
            <div class="flex items-center space-x-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('My Profile') }}
                </h2>

                {{-- CONDITIONAL LOGIC: ROLE BASED --}}
                
                {{-- 1. SYSTEM ADMIN: Sees Audit Logs --}}
                @if(Auth::user()->role === 'system_admin')
                    <a href="{{ route('audit.logs') }}" class="bg-red-700 text-white text-sm font-bold py-2 px-4 rounded-lg shadow hover:bg-red-800 transition">
                        View System Logs
                    </a>

                {{-- 2. EVENT ADMIN: Sees Create Event --}}
                @elseif(Auth::user()->role === 'event_admin')
                    <a href="{{ route('admin.events.create') }}" class="bg-green-600 text-white text-sm font-bold py-2 px-4 rounded-lg shadow hover:bg-green-700 transition">
                        Create New Event
                    </a>

                {{-- 3. REGULAR USER: Sees Register Event --}}
                @else
                    <a href="{{ route('events.available') }}" class="bg-indigo-600 text-white text-sm font-bold py-2 px-4 rounded-lg shadow hover:bg-indigo-700 transition">
                        Register Event
                    </a>
                @endif
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-600 text-white font-bold py-2 px-4 rounded hover:bg-red-700 transition">
                    Log Out
                </button>
            </form>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl">
                
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative m-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="p-8">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="col-span-1 flex flex-col items-center text-center">
                            <div class="w-40 h-40 rounded-full overflow-hidden border-4 border-indigo-100 shadow-lg mb-4">
                                @if(Auth::user()->profile_image)
                                    <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-indigo-50 flex items-center justify-center text-indigo-300">
                                        <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                                    </div>
                                @endif
                            </div>
                            <label for="profile_image" class="cursor-pointer bg-indigo-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow hover:bg-indigo-700 transition">
                                Change Photo
                            </label>
                            <input id="profile_image" name="profile_image" type="file" class="hidden">
                        </div>

                        <div class="col-span-1 md:col-span-2 space-y-6">
                            <h3 class="text-lg font-bold text-gray-900 border-b pb-2 mb-4">Personal Information</h3>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                                <input type="text" name="contact_number" value="{{ old('contact_number', Auth::user()->contact_number) }}" class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
                            </div>
                            <div class="pt-4 flex justify-end">
                                <button type="submit" class="px-6 py-3 bg-indigo-600 text-white font-bold rounded-lg shadow hover:bg-indigo-700 transition duration-150">
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
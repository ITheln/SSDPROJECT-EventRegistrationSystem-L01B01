<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>

            <div class="flex items-center gap-3">
                
                <a href="{{ route('events.create') }}" class="px-4 py-2 bg-blue-600 text-white font-bold rounded-lg shadow hover:bg-blue-700 transition duration-150">
                    Back
                </a>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white font-bold rounded-lg shadow hover:bg-red-700 transition duration-150">
                        Log Out
                    </button>
                </form>
            </div>
            
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold">Manage Your Events</h3>
                        <a href="{{ route('events.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            + Create New Event
                        </a>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($events as $event)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $event->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $event->event_date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-bold">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">No events found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
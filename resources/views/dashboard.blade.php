<div class="p-6 bg-white border-b border-gray-200">
    <div class="mb-4">
    <a href="{{ route('events.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
        {{ __('+ Create New Event') }}
    </a>
</div>
    <h3 class="text-lg font-bold mb-4">Manage Your Events</h3>
    
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($events as $event)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $event->title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $event->event_date }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE') <button type="submit" class="text-red-600 hover:text-red-900 font-bold">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">No events found. Click "Create Event" to add one.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    
                    <h3 class="text-lg font-bold mb-6 border-b pb-2">Event Details</h3>

                    <form method="POST" action="{{ route('events.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Event Title</label>
                            <input type="text" id="title" name="title" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" placeholder="e.g. Annual Tech Conference" required>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea id="description" name="description" rows="4" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" placeholder="Enter event details here..." required></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="event_date" class="block text-sm font-medium text-gray-700 mb-1">Event Date</label>
                                <input type="datetime-local" id="event_date" name="event_date" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" required>
                            </div>

                            <div>
                                <label for="max_capacity" class="block text-sm font-medium text-gray-700 mb-1">Maximum Capacity</label>
                                <input type="number" id="max_capacity" name="max_capacity" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" placeholder="e.g. 100" required>
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-4 pt-4 border-t mt-6">
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-200 text-gray-800 font-semibold rounded-lg hover:bg-gray-300 transition duration-150">
                                Cancel
                            </a>

                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-bold rounded-lg shadow-md hover:bg-blue-700 transition duration-150">
                                Save Event
                            </button>
                        </div>

                    </form>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
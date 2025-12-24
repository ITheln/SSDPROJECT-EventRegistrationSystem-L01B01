<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('events.store') }}">
                    @csrf <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Event Title</label>
                        <input type="text" name="title" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Description</label>
                        <textarea name="description" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 w-full" rows="3" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Event Date</label>
                        <input type="datetime-local" name="event_date" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Maximum Capacity</label>
                        <input type="number" name="max_capacity" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 w-full" required>
                    </div>

                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('Save Event') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
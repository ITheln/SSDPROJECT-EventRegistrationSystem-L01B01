<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('System Audit Logs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">User</th>
                            <th class="border p-2">Action</th>
                            <th class="border p-2">IP Address</th>
                            <th class="border p-2">Details</th>
                            <th class="border p-2">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                        <tr>
                            <td class="border p-2">{{ $log->user->name ?? 'System' }}</td>
                            <td class="border p-2 font-bold">{{ $log->action }}</td>
                            <td class="border p-2">{{ $log->ip_address }}</td>
                            <td class="border p-2 text-sm">{{ $log->details }}</td>
                            <td class="border p-2 text-xs">{{ $log->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
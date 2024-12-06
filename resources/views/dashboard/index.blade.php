<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Waste Transport Services</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.5/cdn.min.js" defer></script>
    @vite('resources/css/app.css')
</head>

<body class="font-sans bg-gray-50">
    <!-- Navigation -->
    <x-navbar />

    <div className="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">

        <div class="py-6 mb-12">
            <h1 class="text-4xl font-light text-center mb-8 mt-12 text-gray-800">Your Requests</h1>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Create Request Button -->
                <div class="mb-6 mt-8 flex w-full justify-end">
                    <button
                        onclick="window.createModal.showModal()"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md">
                        Create New Request
                    </button>
                </div>

                @if (session('success'))
                <div class="bg-green-50 text-green-700 px-6 py-3 rounded-lg mb-8 text-center shadow-sm border border-green-200 max-w-2xl mx-auto">
                    {{ session('success') }}
                </div>
                @endif

                <!-- Modal -->
                <dialog id="createModal" class="modal rounded-lg shadow-lg p-0 backdrop:bg-gray-500/50">
                    <div class="max-w-md w-96">
                        <div class="bg-white px-6 py-4 sm:px-6 sm:py-4">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-medium">Create New Request</h3>
                                <button
                                    onclick="window.createModal.close()"
                                    class="text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Close</span>
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <form action="{{ route('resdem.store') }}" method="POST">
                                @csrf
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Service</label>
                                        <select name="servid" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 uppercase">
                                            @foreach($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->wtype }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Quantity</label>
                                        <input type="number" name="quantity" required min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Demand Date</label>
                                        <input type="date" name="demand" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                </div>
                                <div class="mt-6 flex justify-end space-x-3">
                                    <button
                                        type="button"
                                        onclick="window.createModal.close()"
                                        class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                                        Cancel
                                    </button>
                                    <button
                                        type="submit"
                                        class="rounded-md bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">
                                        Create
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </dialog>

                <!-- ResDems List -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        @if($resdems->isEmpty())
                        <p class="text-gray-500 text-center py-4">No requests found.</p>
                        @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Service</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Demand Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($resdems as $resdem)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full uppercase
                                                    {{ ['bg-blue-100 text-blue-800', 'bg-green-100 text-green-800', 'bg-yellow-100 text-yellow-800',
                                                       'bg-red-100 text-red-800', 'bg-purple-100 text-purple-800'][crc32($resdem->service->wtype) % 5] }}">
                                                {{ $resdem->service->wtype }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $resdem->quantity }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $resdem->demand->format('M d, Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <form action="{{ route('resdem.destroy', $resdem) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer />
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Calendar | Waste Transport Services</title>
    @vite('resources/css/app.css')
</head>

<body class="font-sans bg-gray-50">
    <!-- Navigation -->
    <x-navbar />

    <div className="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
        <div class="py-6 mb-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <!-- Service Header -->
                    <div class="p-6 bg-gray-50 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-semibold text-gray-800 uppercase">
                                @if($service)
                                Calendar for: {{ $service->wtype }}
                                @else
                                Complete Calendar
                                @endif
                            </h2>
                            <div class="flex items-center space-x-4">
                                <label for="service" class="text-sm font-medium text-gray-700">Filter by Service:</label>
                                <select
                                    id="service"
                                    class="mt-1 block w-64 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md uppercase"
                                    onchange="window.location.href = this.value ? '/calendar/' + this.value : '/calendar'">
                                    <option value="">All Services</option>
                                    @foreach($services as $s)
                                    <option value="{{ $s->id }}" {{ ($service && $service->id == $s->id) ? 'selected' : '' }}>
                                        {{ $s->wtype }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Calendar Table -->
                    <div class="p-6">
                        @if($calendar->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500 text-lg">No calendar entries found.</p>
                        </div>
                        @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Service Type
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Description
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($calendar as $entry)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $entry->sdate->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                            $colors = [
                                            'bg-blue-100 text-blue-800' => 0,
                                            'bg-green-100 text-green-800' => 1,
                                            'bg-yellow-100 text-yellow-800' => 2,
                                            'bg-red-100 text-red-800' => 3,
                                            'bg-purple-100 text-purple-800' => 4,
                                            'bg-pink-100 text-pink-800' => 5,
                                            ];
                                            $colorIndex = crc32($entry->service->wtype) % count($colors);
                                            $colorClass = array_keys($colors)[$colorIndex];
                                            @endphp
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $colorClass }} uppercase">
                                                {{ $entry->service->wtype }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $entry->service->description }}
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
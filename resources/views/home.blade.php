<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waste Transport Services</title>
    @vite('resources/css/app.css')
</head>

<body class="font-sans">
    <!-- Navigation -->
    <x-navbar />

    <!-- Hero Section -->
    <div class="relative pt-16">
        <div class="absolute inset-0">
            <img src="{{URL::asset('/images/waste-transport-hero.webp')}}" alt="Waste Transport" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gray-900 opacity-60"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                Efficient Waste Management for a Cleaner Tomorrow
            </h1>
            <p class="mt-6 text-xl text-gray-300 max-w-3xl">
                Providing systematic waste collection services to keep our community clean and sustainable. Access your collection calendar and stay informed about pickup schedules.
            </p>
            <div class="mt-10">
                <a href="{{ route('calendar.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                    View Collection Calendar
                </a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Our Services
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    Comprehensive waste management solutions for our community
                </p>
            </div>

            <div class="mt-16">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition">
                        <div class="w-12 h-12 bg-green-100 rounded-md flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Annual Calendar</h3>
                        <p class="mt-2 text-gray-500">Advanced scheduling for the entire year, helping you plan ahead for all waste collection types.</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition">
                        <div class="w-12 h-12 bg-green-100 rounded-md flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Multiple Waste Types</h3>
                        <p class="mt-2 text-gray-500">Specialized collection for different waste categories including general, recyclable, and organic waste.</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition">
                        <div class="w-12 h-12 bg-green-100 rounded-md flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Daily Updates</h3>
                        <p class="mt-2 text-gray-500">Stay informed about collection schedules and any changes through our notification system.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer />
</body>

</html>
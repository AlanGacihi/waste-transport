<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Waste Transport Services</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.5/cdn.min.js" defer></script>
    @vite('resources/css/app.css')
</head>

<body class="font-sans bg-gray-50">
    <!-- Navigation -->
    <x-navbar />

    <div className="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Header with Create Button -->
                <div class="mb-6 flex justify-between items-center">
                    <h1 class="text-2xl font-semibold text-gray-900">Services</h1>
                    <button
                        onclick="window.createModal.showModal()"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md">
                        Add Service
                    </button>
                </div>

                @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
                @endif

                <!-- Create/Edit Modal -->
                <dialog id="createModal" class="modal rounded-lg shadow-lg p-0 backdrop:bg-gray-500/50 w-96">
                    <div class="w-full max-w-md">
                        <div class="bg-white px-6 py-4">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-medium" id="modalTitle">Add Service</h3>
                                <button onclick="window.createModal.close()" class="text-gray-400 hover:text-gray-500">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <form id="serviceForm" method="POST">
                                @csrf
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Service Type</label>
                                        <input type="text" name="wtype" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Description</label>
                                        <textarea name="description" required rows="3"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                                    </div>
                                </div>
                                <div class="mt-6 flex justify-end space-x-3">
                                    <button type="button" onclick="window.createModal.close()"
                                        class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        class="rounded-md bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </dialog>

                <!-- Services List -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($services as $service)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full uppercase
                                                {{ ['bg-blue-100 text-blue-800', 'bg-green-100 text-green-800',
                                                   'bg-yellow-100 text-yellow-800', 'bg-red-100 text-red-800'][$loop->index % 4] }}">
                                                {{ $service->wtype }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $service->description }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <button data-service-id="{{ $service->id }}" onclick="editService(this.dataset.serviceId)" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                                            <form action="{{ route('admin.destroy', $service) }}" method="POST" class="inline">
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
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Function to handle editing a service
            async function editService(serviceId) {
                try {
                    // Fetch service data
                    const response = await fetch(`/admin/${serviceId}/edit`);
                    const service = await response.json();

                    // Update form
                    const form = document.getElementById('serviceForm');
                    form.action = `/admin/${serviceId}`;
                    form.querySelector('input[name="wtype"]').value = service.wtype;
                    form.querySelector('textarea[name="description"]').value = service.description;

                    // Add method spoofing for PUT request
                    if (!form.querySelector('input[name="_method"]')) {
                        const methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        methodField.value = 'PUT';
                        form.appendChild(methodField);
                    }

                    // Update modal title
                    document.getElementById('modalTitle').textContent = 'Edit Service';

                    // Show modal
                    window.createModal.showModal();
                } catch (error) {
                    console.error('Error fetching service:', error);
                    alert('Error loading service data');
                }
            }

            // Reset form when modal is closed
            window.createModal.addEventListener('close', () => {
                const form = document.getElementById('serviceForm');
                form.reset();
                form.action = "{{ route('admin.store') }}";
                const methodField = form.querySelector('input[name="_method"]');
                if (methodField) methodField.remove();
                document.getElementById('modalTitle').textContent = 'Add Service';
            });

            // Add confirmation for delete
            document.querySelectorAll('form[action*="destroy"]').forEach(form => {
                form.addEventListener('submit', (e) => {
                    if (!confirm('Are you sure you want to delete this service?')) {
                        e.preventDefault();
                    }
                });
            });
        </script>
    </div>

    <x-footer />
</body>

</html>

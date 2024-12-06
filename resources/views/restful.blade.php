<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waste Management RESTful Client Interface</title>
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body class="bg-gray-100">
    <div id="app" class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <span class="text-2xl font-semibold text-gray-800">Waste Management RESTful Client</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button @click="currentTab = 'services'" :class="{'text-green-600': currentTab === 'services'}" class="px-3 py-2 rounded-md text-sm font-medium hover:text-green-600">Services</button>
                        <button @click="currentTab = 'calendar'" :class="{'text-green-600': currentTab === 'calendar'}" class="px-3 py-2 rounded-md text-sm font-medium hover:text-green-600">Calendar</button>
                        <button @click="currentTab = 'menu'" :class="{'text-green-600': currentTab === 'menu'}" class="px-3 py-2 rounded-md text-sm font-medium hover:text-green-600">Menu Items</button>
                        <button @click="currentTab = 'resdems'" :class="{'text-green-600': currentTab === 'resdems'}" class="px-3 py-2 rounded-md text-sm font-medium hover:text-green-600">Resdems</button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto py-6 px-4">

            <!-- Services Tab -->
            <div v-if="currentTab === 'services'" class="space-y-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-800">Services</h2>
                    <div>
                        <div class="flex space-x-4">
                            <button @click="showServiceModal = true" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">Add Service</button>
                            <button @click="generatePdf('services')" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                                Download Services Report
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waste Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="service in services" :key="service.id">
                                <td class="px-6 py-4 whitespace-nowrap uppercase">@{{ service.wtype }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">@{{ service.description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <button @click="editService(service)" class="text-green-600 hover:text-green-900 mr-4">Edit</button>
                                    <button @click="deleteService(service.id)" class="text-red-600 hover:text-red-900">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Calendar Tab -->
            <div v-if="currentTab === 'calendar'" class="space-y-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-800">Calendar</h2>
                    <button @click="showCalendarModal = true" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">Add to Calendar</button>
                </div>

                <div class="mb-6 bg-white p-4 rounded-lg shadow">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Generate PDF Report</h3>
                    <div class="space-y-4">

                        <!-- Calendar Tab -->
                        <div class="flex items-center space-x-4">
                            <select v-model="selectedService" class="rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-6 py-2 border uppercase">
                                <option value="">All Services</option>
                                <option v-for="service in services" :key="service.id" :value="service.id">
                                    @{{ service.wtype }}
                                </option>
                            </select>
                            <button @click="generatePdf('calendar')" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                                Download Calendar
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waste Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="event in calendar" :key="event.id">
                                <td class="px-6 py-4 whitespace-nowrap uppercase">@{{ event.service.wtype }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">@{{ event.service.description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">@{{ new Date(event.sdate).toLocaleDateString() }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <button @click="editCalendar(event)" class="text-green-600 hover:text-blue-900 mr-4">Edit</button>
                                    <button @click="deleteCalendar(event.id)" class="text-red-600 hover:text-red-900">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Resdems Tab -->
            <div v-if="currentTab === 'resdems'" class="space-y-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-800">Resdems</h2>
                </div>

                <div class="mb-6 bg-white p-4 rounded-lg shadow">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Generate PDF Report</h3>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-6">
                            <input type="date" v-model="startDate" class="rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-1.5 border">
                            <input type="date" v-model="endDate" class="rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-1.5 border">
                            <button @click="generatePdf('resdems')" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                                Download Resdems Report
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waste Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Demand</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="resdem in resdems" :key="resdem.id">
                                <td class="px-6 py-4 whitespace-nowrap">#@{{ resdem.id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap uppercase">@{{ resdem.service.wtype }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">@{{ resdem.service.description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">@{{ new Date(resdem.demand).toLocaleDateString() }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <button @click="deleteResdem(resdem.id)" class="text-red-600 hover:text-red-900">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div v-if="currentTab === 'menu'" class="space-y-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-800">Menu Items</h2>
                    <button @click="showMenuItemModal = true" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Add Menu Item</button>
                </div>

                <div class="bg-white shadow rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Available</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="menuItem in menuItems" :key="menuItem.id">
                                <td class="px-6 py-4 whitespace-nowrap">@{{ menuItem.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">@{{ menuItem.is_available ? 'Yes' : 'No' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <button
                                        @click="toggleMenuItemAvailability(menuItem)"
                                        class="text-sm text-green-600 hover:text-blue-900 mr-6">
                                        Toggle Availability
                                    </button>
                                    <button @click="editMenuItem(menuItem)" class="text-green-600 hover:text-blue-900 mr-4">Edit</button>
                                    <button @click="deleteMenuItem(menuItem.id)" class="text-red-600 hover:text-red-900">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <!-- Service Modal -->
        <div v-if="showServiceModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-medium text-gray-900 mb-4">@{{ editingService ? 'Edit Service' : 'Add Service' }}</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Waste Type</label>
                        <input type="text" v-model="serviceForm.wtype" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <input type="text" v-model="serviceForm.description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button @click="showServiceModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 border rounded-md">Cancel</button>
                        <button @click="saveService" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Calendar Modal -->
        <div v-if="showCalendarModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-medium text-gray-900 mb-4">@{{ editingCalendar ? 'Edit Event' : 'Add Event' }}</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Service</label>
                        <select v-model="calendarForm.servid" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 uppercase">
                            <option v-for="service in services" :key="service.id" :value="service.id">
                                @{{ service.wtype }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" v-model="calendarForm.sdate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button @click="showCalendarModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 border rounded-md">Cancel</button>
                        <button @click="saveCalendar" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Item Modal -->
        <div v-if="showMenuItemModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-medium text-gray-900 mb-4">@{{ editingMenuItem ? 'Edit Menu Item' : 'Add Menu Item' }}</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" v-model="menuItemForm.name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" v-model="menuItemForm.is_available" class="rounded border-gray-300 text-green-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <label class="ml-2 block text-sm text-gray-900">Is Available</label>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button @click="showMenuItemModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 border rounded-md">Cancel</button>
                        <button @click="saveMenuItem" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add this script tag just before the closing </body> tag
        const {
            createApp,
            ref
        } = Vue;

        // Configure Axios defaults
        axios.defaults.baseURL = '/api';
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.defaults.headers.common['Accept'] = 'application/json';

        // Add CSRF token to all requests if using Laravel's CSRF protection
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (token) {
            axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
        }

        const app = createApp({
            data() {
                return {
                    currentTab: 'services',
                    services: [],
                    calendar: [],
                    resdems: [],
                    menuItems: [],
                    showServiceModal: false,
                    showCalendarModal: false,
                    showMenuItemModal: false,
                    editingService: null,
                    editingCalendar: null,
                    editingMenuItem: null,
                    serviceForm: {
                        wtype: '',
                        description: ''
                    },
                    calendarForm: {
                        serviceId: '',
                        sdate: '',
                    },
                    menuItemForm: {
                        name: '',
                        available: true,
                    },
                    selectedService: '',
                    startDate: '',
                    endDate: '',
                }
            },
            watch: {
                // Watch for tab changes to reload data
                currentTab(newTab) {
                    this.loadTabData(newTab);
                }
            },
            methods: {
                // Load data based on current tab
                async loadTabData(tab) {
                    switch (tab) {
                        case 'services':
                            await this.fetchServices();
                            break;
                        case 'calendar':
                            await this.fetchCalendar();
                            break;
                        case 'menu':
                            await this.fetchMenuItems();
                            break;
                        case 'resdems':
                            await this.fetchResdems();
                            break;
                    }
                },
                async fetchServices() {
                    try {
                        const response = await axios.get('/services');
                        this.services = response.data.data || response.data;
                        console.log('Services loaded:', this.services);
                    } catch (error) {
                        console.error('Error fetching services:', error.response?.data || error);
                        alert('Error loading services. Check console for details.');
                    }
                },
                async saveService() {
                    try {
                        if (this.editingService) {
                            await axios.put(`/services/${this.editingService.id}`, this.serviceForm);
                        } else {
                            await axios.post('/services', this.serviceForm);
                        }
                        await this.fetchServices();
                        this.showServiceModal = false;
                        this.resetServiceForm();
                    } catch (error) {
                        console.error('Error saving service:', error.response?.data || error);
                        alert('Error saving service. Check console for details.');
                    }
                },
                async deleteService(id) {
                    if (confirm('Are you sure you want to delete this service?')) {
                        try {
                            await axios.delete(`/services/${id}`);
                            await this.fetchServices();
                        } catch (error) {
                            console.error('Error deleting service:', error.response?.data || error);
                            alert('Error deleting service. Check console for details.');
                        }
                    }
                },
                editService(service) {
                    this.editingService = service;
                    this.serviceForm = {
                        wtype: service.wtype,
                        description: service.description,
                    };
                    this.showServiceModal = true;
                },
                resetServiceForm() {
                    this.serviceForm = {
                        wtype: '',
                        description: '',
                    };
                    this.editingService = null;
                },

                // Calendar
                async fetchCalendar() {
                    try {
                        const response = await axios.get('/calendar');
                        this.calendar = response.data.data || response.data;
                        console.log('Calendar loaded:', this.calendar);
                    } catch (error) {
                        console.error('Error fetching calendar:', error.response?.data || error);
                        alert('Error loading calendar. Check console for details.');
                    }
                },
                async saveCalendar() {
                    try {
                        if (this.editingCalendar) {
                            await axios.put(`/calendar/${this.editingCalendar.id}`, this.calendarForm);
                        } else {
                            await axios.post('/calendar', this.calendarForm);
                        }
                        await this.fetchCalendar();
                        this.showCalendarModal = false;
                        this.resetCalendarForm();
                    } catch (error) {
                        console.error('Error saving calendar event:', error.response?.data || error);
                        alert('Error saving calendar event. Check console for details.');
                    }
                },
                async deleteCalendar(id) {
                    if (confirm('Are you sure you want to delete this calendar event?')) {
                        try {
                            await axios.delete(`/calendar/${id}`);
                            await this.fetchCalendar();
                        } catch (error) {
                            console.error('Error deleting calendar event:', error.response?.data || error);
                            alert('Error deleting calendar event. Check console for details.');
                        }
                    }
                },
                editCalendar(event) {
                    this.editingCalendar = event;
                    this.calendarForm = {
                        servid: event.service.id,
                        sdate: event.sdate,
                    };
                    this.showCalendarModal = true;
                },
                resetCalendarForm() {
                    this.calendarForm = {
                        servid: '',
                        sdate: '',
                    };
                    this.editingCalendar = null;
                },

                // Menu Items
                async fetchMenuItems() {
                    try {
                        const response = await axios.get('/menu-items');
                        this.menuItems = response.data.data || response.data;
                        console.log('Menu items loaded:', this.menuItems);
                    } catch (error) {
                        console.error('Error fetching menu items:', error.response?.data || error);
                        alert('Error loading menu items. Check console for details.');
                    }
                },
                async saveMenuItem() {
                    try {
                        if (this.editingMenuItem) {
                            await axios.put(`/menu-items/${this.editingMenuItem.id}`, this.menuItemForm);
                        } else {
                            await axios.post('/menu-items', this.menuItemForm);
                        }
                        await this.fetchMenuItems();
                        this.showMenuItemModal = false;
                        this.resetMenuItemForm();
                    } catch (error) {
                        console.error('Error saving menu item:', error.response?.data || error);
                        alert('Error saving menu item. Check console for details.');
                    }
                },
                async deleteMenuItem(id) {
                    if (confirm('Are you sure you want to delete this menu item?')) {
                        try {
                            await axios.delete(`/menu-items/${id}`);
                            await this.fetchMenuItems();
                        } catch (error) {
                            console.error('Error deleting menu item:', error.response?.data || error);
                            alert('Error deleting menu item. Check console for details.');
                        }
                    }
                },
                editMenuItem(menuItem) {
                    this.editingMenuItem = menuItem;
                    this.menuItemForm = {
                        name: menuItem.name,
                        is_available: menuItem.is_available
                    };
                    this.showMenuItemModal = true;
                },
                resetMenuItemForm() {
                    this.menuItemForm = {
                        name: '',
                        is_available: true
                    };
                    this.editingMenuItem = null;
                },
                async toggleMenuItemAvailability(menuItem) {
                    try {
                        await axios.put(`/menu-items/${menuItem.id}/toggle`);
                        await this.fetchMenuItems();
                    } catch (error) {
                        console.error('Error toggling menu item availability:', error.response?.data || error);
                        alert('Error updating menu item. Check console for details.');
                    }
                },

                // Resdems
                async fetchResdems() {
                    try {
                        const response = await axios.get('/resdems');
                        this.resdems = response.data.data || response.data;
                        console.log('Resdems loaded:', this.resdems);
                    } catch (error) {
                        console.error('Error fetching resdems:', error.response?.data || error);
                        alert('Error loading resdems. Check console for details.');
                    }
                },
                async deleteResdem(id) {
                    if (confirm('Are you sure you want to delete this resdem?')) {
                        try {
                            await axios.delete(`/resdems/${id}`);
                            await this.fetchResdems();
                        } catch (error) {
                            console.error('Error updating resdem:', error.response?.data || error);
                            alert('Error updating resdem. Check console for details.');
                        }
                    }
                },

                async generatePdf(reportType) {
                    try {
                        // Validate inputs for orders report
                        if (reportType === 'resdems' && (!this.startDate || !this.endDate)) {
                            alert('Please select both start and end dates');
                            return;
                        }

                        // Create form data
                        const formData = new FormData();
                        formData.append('report_type', reportType);

                        if (reportType === 'resdems') {
                            formData.append('start_date', this.startDate);
                            formData.append('end_date', this.endDate);
                        } else if (reportType === 'calendar' && this.selectedService) {
                            formData.append('service_id', this.selectedService);
                            console.log('Selected service:', this.selectedService);
                        }

                        // Make request
                        const response = await axios.post('/generate-pdf', formData, {
                            responseType: 'blob'
                        });

                        // Create download link
                        const url = window.URL.createObjectURL(new Blob([response.data]));
                        const link = document.createElement('a');
                        link.href = url;
                        link.setAttribute('download', `waste-management-report-${reportType}-report.pdf`);
                        document.body.appendChild(link);
                        link.click();
                        link.remove();
                        window.URL.revokeObjectURL(url);
                    } catch (error) {
                        console.error('Error generating PDF:', error);
                        alert('Error generating PDF. Please check console for details.');
                    }
                }

            },
            mounted() {
                // Load initial data for the current tab
                this.loadTabData(this.currentTab);
            }
        }).mount('#app');
    </script>

</body>

</html>
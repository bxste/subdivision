<x-adminApp-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Tenant') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="min-h-screen flex items-center justify-center">
                        <div class="max-w-lg w-full p-6 bg-white rounded-lg shadow-lg">
                            <div class="flex justify-center mb-8">
                                <!-- Replace the image source with your logo -->
                                <img src="" alt="Logo" class="w-30 h-20">
                            </div>
                            <h1 class="text-2xl font-semibold text-center text-gray-500 mt-8 mb-6">Create Tenant</h1>
                            
                            <form action="{{ route('admin.residentForms.storeTenant') }}" method="post">
                                @csrf

                                <input type="hidden" name="homeownerId" value="{{ $homeownerId }}">

                                <div class="flex space-x-4">
                                    <div class="mb-4 flex-1">
                                        <label for="first_name" class="block mb-2 text-sm text-gray-600">First Name</label>
                                        <input type="text" name="first_name" id="first_name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                                    </div>

                                    <div class="mb-4 flex-1">
                                        <label for="middle_initial" class="block mb-2 text-sm text-gray-600">Middle Initial</label>
                                        <input type="text" name="middle_initial" id="middle_initial" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                                    </div>

                                    <div class="mb-4 flex-1">
                                        <label for="last_name" class="block mb-2 text-sm text-gray-600">Last Name</label>
                                        <input type="text" name="last_name" id="last_name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                                    </div>
                                </div>

                                <div class="flex space-x-4">
                                    <div class="mb-4 flex-1">
                                        <label for="gender" class="block mb-2 text-sm text-gray-600">Gender</label>
                                        <select id="gender" name="gender" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>

                                    <div class="mb-4 flex-1">
                                        <label for="household_size" class="block mb-2 text-sm text-gray-600">Occupants</label>
                                        <input type="number" name="household_size" id="household_size" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" min="1" max="10" required>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="email" class="block mb-2 text-sm text-gray-600">Email</label>
                                    <input type="text" name="email" id="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                                </div>

                                <div class="mb-4">
                                    <label for="phone_number" class="block mb-2 text-sm text-gray-600">Phone Number</label>
                                    <input type="text" name="phone_number" id="phone_number" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                                </div>

                                <div class="flex space-x-4">
                                    <div class="mb-4 flex-1">
                                        <label for="occupation" class="block mb-2 text-sm text-gray-600">Occupation</label>
                                        <input type="text" name="occupation" id="occupation" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                                    </div>

                                    <div class="mb-4 flex-1">
                                        <label for="religion" class="block mb-2 text-sm text-gray-600">Religion</label>
                                        <input type="text" name="religion" id="religion" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                                    </div>

                                    <div class="mb-4 flex-1">
                                        <label for="disability" class="block mb-2 text-sm text-gray-600">Disability</label>
                                        <input type="text" name="disability" id="disability" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                                    </div>
                                </div>

                                <div class="flex space-x-4">
                                    <div class="mb-4 flex-1">
                                        <label for="acknowledgement_on_community_rules" class="block mb-2 text-sm text-gray-600">Acknowledgement</label>
                                        <select id="acknowledgement_on_community_rules" name="acknowledgement_on_community_rules" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>

                                    <div class="mb-4 flex-1">
                                        <label for="payment_status" class="block mb-2 text-sm text-gray-600">Payment Status</label>
                                        <select id="payment_status" name="payment_status" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                                            <option value="paid">Paid</option>
                                            <option value="unpaid">Unpaid</option>
                                        </select>
                                    </div>

                                    <div class="mb-4 flex-1">
                                        <label for="violation" class="block mb-2 text-sm text-gray-600">Violation</label>
                                        <select id="violation" name="violation" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Add more form fields as needed -->

                                <!-- Submit button -->
                                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mb-2">Create Tenant</button>
                            </form>

                            @if(session()->has('message'))
                                <div>{{ session('message') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-adminApp-layout>

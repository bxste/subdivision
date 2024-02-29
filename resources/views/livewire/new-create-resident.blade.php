<!-- resources/views/livewire/create-resident.blade.php -->
<div class="min-h-screen flex items-center justify-center">
    <div class="max-w-lg w-full p-6 bg-white rounded-lg shadow-lg">
        <div class="flex justify-center mb-8">
            <!-- Replace the image source with your logo -->
            <img src="" alt="Logo" class="w-30 h-20">
        </div>
        <h1 class="text-2xl font-semibold text-center text-gray-500 mt-8 mb-6">Create Resident</h1>
        <form wire:submit.prevent="createResident">
            <div class="flex space-x-4">
                <div class="mb-4 flex-1">
                    <label for="block" class="block mb-2 text-sm text-gray-600">Block</label>
                    <input wire:model="block" type="text" id="block" name="block" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                </div>

                <div class="mb-4 flex-1">
                    <label for="lot" class="block mb-2 text-sm text-gray-600">Lot</label>
                    <input wire:model="lot" type="text" id="lot" name="lot" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                </div>

                <div class="mb-4 flex-2">
                    <label for="street" class="block mb-2 text-sm text-gray-600">Street</label>
                    <input wire:model="street" type="text" id="street" name="street" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                </div>
            </div>
            <div class="flex space-x-4">
                <div class="mb-4 flex-2">
                    <label for="first_name" class="block mb-2 text-sm text-gray-600">First Name</label>
                    <input wire:model="first_name" type="text" id="first_name" name="first_name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                </div>

                <div class="mb-4 flex-1">
                    <label for="middle_initial" class="block mb-2 text-sm text-gray-600">Middle Initial</label>
                    <input wire:model="middle_initial" type="text" id="middle_initial" name="middle_initial" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                </div>

                <div class="mb-4 flex-1">
                    <label for="last_name" class="block mb-2 text-sm text-gray-600">Last Name</label>
                    <input wire:model="last_name" type="text" id="last_name" name="last_name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                </div>
            </div>
            <div class="flex space-x-4">

                <div class="mb-4 flex-1">
                    <label for="gender" class="block mb-2 text-sm text-gray-600">Gender</label>
                    <select wire:model="gender" id="gender" name="gender" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="mb-4 flex-1">
                    <label for="household_size" class="block mb-2 text-sm text-gray-600">Occupants</label>
                    <input wire:model="household_size" type="number" id="household_size" name="household_size" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" min="1" max="10" required>
                </div>

            </div>

            <div class="mb-4">
                <label for="email" class="block mb-2 text-sm text-gray-600">Email</label>
                <input wire:model="email" type="text" id="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
            </div>
            <div class="mb-4">
                <label for="phone_number" class="block mb-2 text-sm text-gray-600">Phone Number</label>
                <input wire:model="phone_number" type="text" id="phone_number" name="phone_number" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
            </div>
            <div class="flex space-x-4">

                <div class="mb-4 flex-1">
                    <label for="occupation" class="block mb-2 text-sm text-gray-600">Occupation</label>
                    <input wire:model="occupation" type="text" id="occupation" name="occupation" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                </div>

                <div class="mb-4 flex-1">
                    <label for="religion" class="block mb-2 text-sm text-gray-600">Religion</label>
                    <input wire:model="religion" type="text" id="religion" name="religion" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                </div>

                <div class="mb-4 flex-1">
                    <label for="disability" class="block mb-2 text-sm text-gray-600">Disability</label>
                    <input wire:model="disability" type="text" id="disability" name="disability" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                </div>

            </div>

            <div class="flex space-x-4">

                <div class="mb-4 flex-1">
                    <label for="acknowledgement_on_community_rules" class="block mb-2 text-sm text-gray-600">Acknowledgement</label>
                    <select wire:model="acknowledgement_on_community_rules" id="acknowledgement_on_community_rules" name="acknowledgement_on_community_rules" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>

                <div class="mb-4 flex-1">
                    <label for="payment_status" class="block mb-2 text-sm text-gray-600">Payment Status</label>
                    <select wire:model="payment_status" id="payment_status" name="payment_status" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                        <option value="paid">Paid</option>
                        <option value="unpaid">Unpaid</option>
                    </select>
                </div>

                <div class="mb-4 flex-1">
                    <label for="violation" class="block mb-2 text-sm text-gray-600">Violation</label>
                    <select wire:model="violation" id="violation" name="violation" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>

            </div>


            <!-- Submit button -->
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mb-2">Create Resident</button>

        </form>
        @if(session()->has('message'))
        <div>{{ session('message') }}</div>
        @endif
    </div>
</div>

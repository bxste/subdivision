<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (optional, if you need JavaScript features) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}" />

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>
    
    <!-- about -->
    <div class="container">
        <div class="row g-4 py-2">
            <div class="col-12 ">
                <!-- About Section -->
                <div class="bg-white p-3 shadow-sm rounded-sm">
                    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                        <span class="text-green-500">
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <span class="tracking-wide">About</span>
                    </div>
                    <div class="text-gray-700">
                        <div class="grid md:grid-cols-2 text-sm">
                            <!-- Example of using a foreach loop -->
                            @foreach($homeowners as $homeowner)
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Block Number</div>
                                <div class="px-4 py-2">{{ $homeowner->block }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Lot</div>
                                <div class="px-4 py-2">{{ $homeowner->lot }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Street</div>
                                <div class="px-4 py-2">{{ $homeowner->street }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">First Name</div>
                                <div class="px-4 py-2">{{ $homeowner->first_name }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Middle Initial</div>
                                <div class="px-4 py-2">{{ $homeowner->middle_initial }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Last Name</div>
                                <div class="px-4 py-2">{{ $homeowner->last_name }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Religion</div>
                                <div class="px-4 py-2">{{ $homeowner->religion }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Email</div>
                                <div class="px-4 py-2">{{ $homeowner->email }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Phone Number</div>
                                <div class="px-4 py-2">{{ $homeowner->phone_number }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Household Size</div>
                                <div class="px-4 py-2">{{ $homeowner->household_size }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Occupation</div>
                                <div class="px-4 py-2">{{ $homeowner->occupation }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Status</div>
                                <div class="px-4 py-2">{{ $homeowner->status }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Acknowledgement on Community Rules</div>
                                <div class="px-4 py-2">{{ $homeowner->acknowledgement_on_community_rules }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Disability</div>
                                <div class="px-4 py-2">{{ $homeowner->disability }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Gender</div>
                                <div class="px-4 py-2">{{ $homeowner->gender }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Payment Status</div>
                                <div class="px-4 py-2">{{ $homeowner->payment_status }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Violation</div>
                                <div class="px-4 py-2">{{ $homeowner->violation }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Relationship to Homeowner</div>
                                <div class="px-4 py-2">{{ $homeowner->relationship_to_homeowner }}</div>
                            </div>
                            @endforeach
                            <div>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- vehicle -->
    <!-- Vehicles Section -->
<div class="container py-4">
    <div class="bg-white p-3 shadow-sm rounded-sm">
        <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
            <span class="text-green-500">
                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </span>
            <span class="tracking-wide">Vehicles</span>
        </div>
        <div class="text-gray-700">
            <div class="grid md:grid-cols-1 text-sm">
                @foreach($vehicles as $vehicleCollection)
                    @foreach($vehicleCollection as $vehicle)
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-semibold">Car Type</div>
                            <div class="px-4 py-2">{{ $vehicle->type }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-semibold">Car Model</div>
                            <div class="px-4 py-2">{{ $vehicle->model }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-semibold">Car Maker</div>
                            <div class="px-4 py-2">{{ $vehicle->make }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-semibold">Plate Number</div>
                            <div class="px-4 py-2">{{ $vehicle->plate_number }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-semibold">Sticker Number</div>
                            <div class="px-4 py-2">{{ $vehicle->sticker_number }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-semibold">Color</div>
                            <div class="px-4 py-2">{{ $vehicle->color }}</div>
                        </div>
                        <hr>
                        <!-- Add other vehicle details here -->
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>

</x-app-layout>


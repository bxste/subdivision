<x-adminApp-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $resident->first_name }}'s Records
            @if($resident->status === 'owned')
                (Homeowner)
            @elseif($resident->status === 'tenant')
                (Tenant)
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (session('status'))
                    <div class="mb-3 inline-flex w-full items-center rounded-lg bg-green-100 border-l-4 border-green-500 px-6 py-5 text-base text-green-700" role="alert">
                        <span class="mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5 text-green-500">
                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        {{ session('status') }}
                    </div>
                    @php
                        // Clear the 'status' session value
                        session()->forget('status');
                    @endphp
                @endif

                <div class="p-6 text-gray-900">
                <div class="bg-gray-200 p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold mb-4">Vehicle Information</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                        @foreach ($vehicles as $vehicles)
                            <p class="text-gray-700 mb-2"><span class="font-bold">Name:</span> {{ $resident->first_name }} {{ $resident->middle_initial }} {{ $resident->last_name }}</p>
                            <p class="text-gray-700 mb-2"><span class="font-bold">Type:</span> {{ $vehicles->type }}</p>
                            <p class="text-gray-700 mb-2"><span class="font-bold">Model:</span> {{ $vehicles->model }}</p>
                            <p class="text-gray-700 mb-2"><span class="font-bold">Make:</span> {{ $vehicles->make }}</p>
                            <p class="text-gray-700 mb-2"><span class="font-bold">Color:</span> {{ $vehicles->color }}</p>
                            <p class="text-gray-700 mb-2"><span class="font-bold">Plate number:</span> {{ $vehicles->plate_number }}</p>
                            <p class="text-gray-700 mb-2"><span class="font-bold">Sticker number:</span> {{ $vehicles->sticker_number }}</p>
                            <a href="{{ route('admin.resident.editVehicle',['homeownerId' => $resident->id, 'vehicleId' => $vehicles->id]) }}" class="inline-block bg-blue-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                                Edit Vehicle Information
                            </a>
                            <form action="{{ route('archive.vehicle', ['vehicleId' => $vehicles->id]) }}" method="POST" class="group relative">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mt-2 p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                    </svg>
                                    <div class="opacity-0 bg-gray-700 text-white text-xs rounded-md py-1 px-2 absolute bottom-8 left-1/2 transform -translate-x-1/2 transition-opacity group-hover:opacity-100">
                                        Archive
                                    </div>
                                </button>
                            </form>
                        @endforeach
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('admin.resident.createVehicle', ['homeownerId' => $resident->id]) }}" class="inline-block bg-blue-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                            Add Vehicle Information
                        </a>

                        
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <div class="bg-gray-200 p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold mb-4">Pet Information</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                        @foreach ($pets as $pets)
                            <p class="text-gray-700 mb-2"><span class="font-bold">Name:</span> {{ $resident->first_name }} {{ $resident->middle_initial }} {{ $resident->last_name }}</p>
                            <p class="text-gray-700 mb-2"><span class="font-bold">Type:</span> {{ $pets->type_of_pets }}</p>
                            <p class="text-gray-700 mb-2"><span class="font-bold">Breed:</span> {{ $pets->breed }}</p>
                            <p class="text-gray-700 mb-2"><span class="font-bold">Vaccinated:</span> {{ $pets->vaccinated }}</p>
                            <p class="text-gray-700 mb-2"><span class="font-bold">Age:</span> {{ $pets->age }}</p>
                            <p class="text-gray-700 mb-2"><span class="font-bold">Color:</span> {{ $pets->color }}</p>
                            

                            <a href="{{ route('admin.resident.editPet',['homeownerId' => $resident->id, 'petId' => $pets->id]) }}" class="inline-block bg-blue-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                                Edit Pet Information
                            </a>

                            <form action="{{ route('archive.pet', ['petId' => $pets->id]) }}" method="POST" class="group relative">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mt-2 p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                    </svg>
                                    <div class="opacity-0 bg-gray-700 text-white text-xs rounded-md py-1 px-2 absolute bottom-8 left-1/2 transform -translate-x-1/2 transition-opacity group-hover:opacity-100">
                                        Archive
                                    </div>
                                </button>
                            </form>
                        @endforeach
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('admin.resident.createPet', ['homeownerId' => $resident->id]) }}" class="inline-block bg-blue-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                            Add Pet Information
                        </a>

                        
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>

</x-adminApp-layout>

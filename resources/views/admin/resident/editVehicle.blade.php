<x-adminApp-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Vehicle Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mx-auto p-4">
                        <h1 class="text-2xl font-bold mb-4">Update Vehicle</h1>

                        <form action="{{route('admin.resident.updateVehicle')}}" method="post" class="max-w-md mx-auto bg-white p-8 rounded shadow-md">
                            @csrf
                            @method('put')

                            <input type="hidden" name="vehicleId" value="{{ $vehicleId }}">
                            <input type="hidden" name="homeownerId" value="{{ $homeownerId }}">

                            <div class="mb-4">
                                <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Type</label>
                                <input type="text" name="type" id="type" placeholder="{{ $vehicle->type }}" class="w-full p-2 border border-gray-300 rounded" required>
                            </div>

                            <div class="mb-4">
                                <label for="model" class="block text-gray-700 text-sm font-bold mb-2">Model</label>
                                <input type="text" name="model" id="model" placeholder="{{ $vehicle->model }}" class="w-full p-2 border border-gray-300 rounded" required>
                            </div>              
                            
                            <div class="mb-4">
                                <label for="make" class="block text-gray-700 text-sm font-bold mb-2">Make</label>
                                <input type="text" name="make" id="make" placeholder="{{ $vehicle->make }}" class="w-full p-2 border border-gray-300 rounded" required>
                            </div>

                            <div class="mb-4">
                                <label for="color" class="block text-gray-700 text-sm font-bold mb-2">Color</label>
                                <input type="text" name="color" id="color" placeholder="{{ $vehicle->color }}" class="w-full p-2 border border-gray-300 rounded" required>
                            </div>

                            <div class="mb-4">
                                <label for="plate_number" class="block text-gray-700 text-sm font-bold mb-2">Plate Number</label>
                                <input type="text" name="plate_number" id="plate_number" placeholder="{{ $vehicle->plate_number }}" class="w-full p-2 border border-gray-300 rounded" required>
                            </div>

                            <div class="mb-4">
                                <label for="sticker_number" class="block text-gray-700 text-sm font-bold mb-2">Sticker Number</label>
                                <input type="text" name="sticker_number" id="sticker_number" placeholder="{{ $vehicle->sticker_number }}"  class="w-full p-2 border border-gray-300 rounded" required>
                            </div>


                            <!-- Add more form fields as needed -->

                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-adminApp-layout>

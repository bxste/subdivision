<x-adminApp-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Vehicle Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mx-auto p-4">
                        <h1 class="text-2xl font-bold mb-4">Create Pet</h1>

                        <form action="{{route('admin.resident.storePet')}}" method="post" class="max-w-md mx-auto bg-white p-8 rounded shadow-md">
                            @csrf
                            
                            <input type="hidden" name="homeownerId" value="{{ $homeownerId }}">
                            <div class="mb-4">
                                <label for="type_of_pets" class="block text-gray-700 text-sm font-bold mb-2">Type</label>
                                <input type="text" name="type_of_pets" id="type_of_pets" class="w-full p-2 border border-gray-300 rounded" required>
                            </div>

                            <div class="mb-4">
                                <label for="breed" class="block text-gray-700 text-sm font-bold mb-2">Breed</label>
                                <input type="text" name="breed" id="breed" class="w-full p-2 border border-gray-300 rounded" required>
                            </div>              
                            
                            <div class="mb-4">
                                <label for="vaccinated" class="block text-gray-700 text-sm font-bold mb-2">Vaccinated</label>
                                <input type="text" name="vaccinated" id="vaccinated" class="w-full p-2 border border-gray-300 rounded" required>
                            </div>

                            <div class="mb-4">
                                <label for="age" class="block text-gray-700 text-sm font-bold mb-2">Age</label>
                                <input type="text" name="age" id="age" class="w-full p-2 border border-gray-300 rounded" required>
                            </div>

                            <div class="mb-4">
                                <label for="color" class="block text-gray-700 text-sm font-bold mb-2">Color</label>
                                <input type="text" name="color" id="color" class="w-full p-2 border border-gray-300 rounded" required>
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

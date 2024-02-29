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
                        <h1 class="text-2xl font-bold mb-4">Update Pet</h1>

                        <form action="{{route('admin.resident.updatePet')}}" method="post" class="max-w-md mx-auto bg-white p-8 rounded shadow-md">
                            @csrf
                            @method('put')

                            <input type="hidden" name="petId" value="{{ $petId }}">
                            <input type="hidden" name="homeownerId" value="{{ $homeownerId }}">

                            <div class="mb-4">
                                <label for="type_of_pets" class="block text-gray-700 text-sm font-bold mb-2">Type</label>
                                <input type="text" name="type_of_pets" id="type_of_pets" placeholder="{{ $pet->type_of_pets }}" class="w-full p-2 border border-gray-300 rounded" required>
                            </div>

                            <div class="mb-4">
                                <label for="breed" class="block text-gray-700 text-sm font-bold mb-2">Breed</label>
                                <input type="text" name="breed" id="breed" placeholder="{{ $pet->breed }}" class="w-full p-2 border border-gray-300 rounded" required>
                            </div>              
                            
                            <div class="mb-4">
                                <label for="vaccinated" class="block text-gray-700 text-sm font-bold mb-2">Vaccinated</label>
                                <input type="text" name="vaccinated" id="vaccinated" placeholder="{{ $pet->vaccinated }}" class="w-full p-2 border border-gray-300 rounded" required>
                            </div>

                            <div class="mb-4">
                                <label for="age" class="block text-gray-700 text-sm font-bold mb-2">Age</label>
                                <input type="text" name="age" id="age" placeholder="{{ $pet->age }}" class="w-full p-2 border border-gray-300 rounded" required>
                            </div>

                            <div class="mb-4">
                                <label for="color" class="block text-gray-700 text-sm font-bold mb-2">Color</label>
                                <input type="text" name="color" id="color" placeholder="{{ $pet->color }}" class="w-full p-2 border border-gray-300 rounded" required>
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

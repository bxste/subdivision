<div class="container mx-auto" >
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
    <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-2 mb-4">
        <input type="text" wire:model.live="search" class="w-full md:w-auto px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" placeholder="Search...">

        <select wire:model.live="pagination" class="w-full md:w-auto px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500 mt-2 md:mt-0">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
    </div>

    <div class="overflow-x-auto">
        <table class="mx-auto border-collapse border border-gray-300 w-full">
            
            <thead>
                <tr class="bg-gray-100">
                    <!-- Vehicle Information -->
                    <th class="px-4 py-2">Type</th>
                    <th class="px-4 py-2">Model</th>
                    <th class="px-4 py-2">Make</th>
                    <th class="px-4 py-2">Color</th>
                    <th class="px-4 py-2">Plate Number</th>
                    <th class="px-4 py-2">Sticker Number</th>
                    <th class="px-4 py-2">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($archivedData as $vehicle)
                    <tr class="border-b border-gray-300">
                        <!-- Vehicle Information -->
                        <td class="px-4 py-2">{{ $vehicle->type }}</td>
                        <td class="px-4 py-2">{{ $vehicle->model }}</td>
                        <td class="px-4 py-2">{{ $vehicle->make }}</td>
                        <td class="px-4 py-2">{{ $vehicle->color }}</td>
                        <td class="px-4 py-2">{{ $vehicle->plate_number }}</td>
                        <td class="px-4 py-2">{{ $vehicle->sticker_number }}</td>

                        <!-- Options -->
                        <td class="px-4 py-2">
                            <form action="{{ route('vehicle.unarchiveData', ['archivedVehicleId' => $vehicle->id]) }}" method="POST">
                                @csrf
                                @method('GET')
                                <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Unarchive Vehicle</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
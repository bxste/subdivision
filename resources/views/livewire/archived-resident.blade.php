<div class="container mx-auto" >
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
                    <!-- Personal Information -->
                    <th class="px-4 py-2">Full Name</th>

                    <!-- Address Information -->
                    <th class="px-4 py-2">Address</th>

                    <!-- Religion -->
                    <th class="px-4 py-2 ">Religion</th>

                    <!-- Household Information -->
                    <th class="px-4 py-2">Occupants</th>
                    <th class="px-4 py-2">Status</th>

                    <th class="px-4 py-2">Payment Status</th>
                    <th class="px-4 py-2">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($archivedData as $archivedData)
                <tr class="border-b border-gray-300">
                    <!-- Personal Information -->
                    <td class="px-4 py-2">{{ $archivedData->first_name }} {{ $archivedData->middle_initial }} {{ $archivedData->last_name }}</td>

                    <!-- Address Information -->
                    <td class="px-4 py-2">Blk. {{ $archivedData->block }} lot {{ $archivedData->lot }} {{ $archivedData->street }} st.</td>

                    <!-- Religion -->
                    <td class="px-4 py-2">{{ $archivedData->religion }}</td>

                    <!-- Household Information -->
                    <td class="px-4 py-2">{{ $archivedData->household_size }}</td>
                    <td class="px-4 py-2">{{ $archivedData->status }}</td>
                    <td class="px-4 py-2">{{ $archivedData->payment_status }}</td>
                    <td class="px-4 py-2">
                    
                    <form action="{{ route('admin.unarchiveData', ['archivedResidentId' => $archivedData->id]) }}" method="POST">
                        @csrf
                        @method('GET')
                        <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Unarchive Resident</button>
                    </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
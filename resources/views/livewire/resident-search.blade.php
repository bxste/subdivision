<div class="container mx-auto">
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
                    <th class="px-4 py-2 text-left">Full Name</th>

                    <!-- Address Information -->
                    <th class="px-4 py-2 text-left">Address</th>

                    <!-- Religion -->
                    <th class="px-4 py-2 text-left">Religion</th>

                    <!-- Household Information -->
                    <th class="px-4 py-2 text-left">Occupants</th>
                    <th class="px-4 py-2 text-left">Status</th>

                    <th class="px-4 py-2 text-left">Payment Status</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($residents as $resident)
                    <tr class="border-b border-gray-300" >
                        <td class="p-4">{{ $resident->first_name }} {{ $resident->middle_initial }} {{ $resident->last_name }}</td>
                        <td class="p-4">Blk. {{ $resident->block }} lot {{ $resident->lot }} {{ $resident->street }} st.</td>
                        <td class="p-4">{{ $resident->religion }}</td>
                        <td class="p-4">{{ $resident->household_size }}</td>
                        <td class="p-4">{{ $resident->status }}</td>
                        <td class="p-4">
                            <button 
                                class="relative grid items-center font-sans font-bold uppercase whitespace-nowrap select-none
                                    @if($resident->payment_status == 'paid') bg-green-500/20 text-green-600 @else bg-red-500/20 text-red-600 @endif
                                    py-1 px-2 text-xs rounded-md" 
                                data-resident-id="{{ $resident->id }}" 
                                wire:click="changePaymentStatus('{{ $resident->id }}', '{{ $resident->payment_status }}')">
                                {{ $resident->payment_status }}
                            </button>
                        </td>

                        <td class="p-4">
                            <div class="relative inline-block text-gray-700 hover:text-gray-900 group">
                                <a href="{{ route('admin.residentForms.editResident', $resident->id) }}" class="inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                                <div class="opacity-0 bg-gray-700 text-white text-xs rounded-md py-1 px-2 absolute bottom-8 left-1/2 transform -translate-x-1/2 transition-opacity group-hover:opacity-100">
                                    Edit
                                </div>
                            </div>

                            @if($resident->status != 'tenant')
                                <a href="{{ route('admin.residentForms.createTenant', ['residentId' => $resident->id]) }}" class="inline-block text-gray-700 hover:text-gray-900 group relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                    </svg>
                                    <div class="opacity-0 bg-gray-700 text-white text-xs rounded-md py-1 px-2 absolute bottom-8 left-1/2 transform -translate-x-1/2 transition-opacity group-hover:opacity-100">
                                        Add Tenant
                                    </div>
                                </a>
                            @endif


                            <a href="{{ route('admin.resident.additionalInfo', ['residentId' => $resident->id]) }}" class="inline-block text-gray-700 hover:text-gray-900 group relative">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <div class="opacity-0 bg-gray-700 text-white text-xs rounded-md py-1 px-2 absolute bottom-8 left-1/2 transform -translate-x-1/2 transition-opacity group-hover:opacity-100">
                                    More Info
                                </div>
                            </a>

                            <form action="{{ route('archive.resident', ['residentId' => $resident->id]) }}" method="POST" class="group relative">
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

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $residents->links() }}
    </div>
</div>

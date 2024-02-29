<x-adminApp-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resident Information') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
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

                @if ($errors->any())
                    <div class="mb-2">
                        <div class="flex p-4 mb-4 text-sm text-#84212b rounded-lg bg-red-200" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="#cf8767" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Danger</span>
                            <div>
                                <h4 style="font-size: 16px; font-weight: bold;">Import Failed</h4>
                                <span class="font-medium">Ensure that these requirements are met:</span>
                                <ul class="mt-1.5 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <h4 class="text-2xl font-semibold mb-2">Import Resident/tenant Data</h4>
                
                <form action="{{ url('resident/import') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                    @csrf
                    
                    <label for="import_file" class="block text-sm font-medium text-gray-700">Choose Excel File</label>
                    <input type="file" name="import_file" id="import_file" class="mt-1 p-2 border rounded-md" />
                    <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Import</button>
                </form>

                <h4 class="text-2xl font-semibold mb-2">Import Pet Data</h4>

                <form action="{{ url('resident/petImport') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                    @csrf

                    <label for="import_file" class="block text-sm font-medium text-gray-700">Choose Excel File</label>
                    <input type="file" name="import_file" id="import_file" class="mt-1 p-2 border rounded-md" />
                    <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Import</button>
                </form>

                <h4 class="text-2xl font-semibold mb-2">Import Vehicle Data</h4>

                <form action="{{ url('resident/vehicleImport') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                    @csrf

                    <label for="import_file" class="block text-sm font-medium text-gray-700">Choose Excel File</label>
                    <input type="file" name="import_file" id="import_file" class="mt-1 p-2 border rounded-md" />
                    <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Import</button>
                </form>

                <hr class="my-4">
                
                <a href="{{ route('admin.residentForms.createResident') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    INSERT RESIDENT RECORD
                </a>
                @livewire('resident-search')
                
            </div>
        </div>
    </div>
</x-adminApp-layout>

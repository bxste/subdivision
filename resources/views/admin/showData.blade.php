<x-adminApp-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resident Information') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                                
                @livewire('resident-search')
                
            </div>
        </div>
    </div>
</x-adminApp-layout>

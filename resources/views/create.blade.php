<!-- create.blade.php -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <title>Tailwind CSS Table Design</title>

<x-app-layout class="bg-gray-100 p-4">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Waiver') }}
        </h2>
    </x-slot>
    @if (session('status'))
    <div class="mb-2 inline-flex w-full items-center rounded-lg bg-red-200 border-l-4 border-red-500 p-4 text-base text-red-700" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="#cf8767" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span>
            {{ session('status') }}
        </span>
    </div>
        @php
            // Clear the 'status' session value
            session()->forget('status');
        @endphp
    @endif
    <div class="p-6 space-y-6 container mx-auto relative w-full h-full max-w-2xl px-7 md:h-auto">
        <form action="/create" method="POST" class="w-full max-w-xl">
            @csrf 
            <div class="grid grid-cols-5.5 gap-6 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="col-span-6 sm:col-span-3">
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Bonnie">
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Green">
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">phone_number</label>
                    <input type="number" name="phone_number" id="phone_number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="123-456-7890" >
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="homeowner_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">homeowner_id</label>
                    <input type="number" name="homeowner_id" id="homeowner_id" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="e.g. 001" >
                </div>
                <div class="col-span-6">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waiver Details</label>
                    <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="'Broken Gate' - Please provide more details in this area."></textarea>
                </div> 
                <div class="">
                    <button class="bg-gray-800 hover:bg-gray-900 text-white py-2 px-6 rounded-lg" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>



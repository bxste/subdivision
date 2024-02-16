
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
                    <input type="number" name="phone_number" id="phone_number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="example@company.com" >
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="homeowner_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">homeowner_id</label>
                    <input type="number" name="homeowner_id" id="homeowner_id" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="e.g. React developer" >
                </div>
                <div class="col-span-6">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Biography</label>
                    <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="👨‍💻Full-stack web developer. Open-source contributor."></textarea>
                </div> 
                <div class="">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-6 rounded-lg " type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>



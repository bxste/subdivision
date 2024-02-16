<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<title>Tailwind CSS Table Design</title>

<x-app-layout class="bg-gray-100 p-4">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report Incident') }}
        </h2>
    </x-slot>
    <div class="container mx-auto relative w-full h-full max-w-2xl px-7 md:h-auto g-4 p-6">
        <form action="/incidents" method="POST" class="w-full max-w-xl">
            @csrf 
            <div class="grid grid-cols-6 gap-6 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <!-- 1 -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="reporter_first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                    <input type="text" name="reporter_first_name" id="reporter_first_name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Bonnie">
                </div>
                <!-- 2 -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="reporter_last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                    <input type="text" name="reporter_last_name" id="reporter_last_name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Green">
                </div>
                <!-- 3 -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="reporter_phone_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
                    <input type="tel" name="reporter_phone_number" id="reporter_phone_number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="123-456-7890" >
                </div>
                <!-- 4 -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="reporter_block_num" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Homeowner ID</label>
                    <input type="number" name="reporter_block_num" id="reporter_block_num" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="e.g. 12345" >
                </div>
                <!-- 5 -->
                <div class="col-span-6">
                    <label for="incident_details" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Incident Details</label>
                    <textarea id="incident_details" name="incident_details" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="👨‍💻Full-stack web developer. Open-source contributor."></textarea>
                </div> 
                <!-- 6 -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="location_details" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Location Details</label>
                    <input type="text" name="location_details" id="location_details" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="e.g. 123 Main St">
                </div>
                <!-- 7 -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="incident_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Incident Type</label>
                    <input type="text" name="incident_type" id="incident_type" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="e.g. Theft">
                </div>
                <!-- 8 -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="person_behind_incident" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Person Behind Incident</label>
                    <input type="text" name="person_behind_incident" id="person_behind_incident" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="e.g. John Doe" >
                </div>
                <!-- 9 -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="person_behind_incident_block_num" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Person Behind Incident's Homeowner ID</label>
                    <input type="number" name="person_behind_incident_block_num" id="person_behind_incident_block_num" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="e.g. 54321" >
                </div>
                <!-- 10 -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="incident_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Incident Date</label>
                    <input type="date" name="incident_date" id="incident_date" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                </div>
                <!-- 11 -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="incident_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Incident Time</label>
                    <input type="time" name="incident_time" id="incident_time" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                </div>
                <div class="">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-6 rounded-lg " type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
    </x-app-layout>


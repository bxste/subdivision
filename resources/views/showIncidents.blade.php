<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <title>Tailwind CSS Table Design</title>
</head>
<body>
<x-app-layout class="bg-gray-100 p-4">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Monitor Reported Incident') }}
        </h2>
    </x-slot>
  <div class="container mx-auto g-4 py-6">
    <table class="min-w-full bg-white border border-gray-300 shadow-sm rounded-lg overflow-hidden">
      <thead class="bg-gray-200">
        <tr>
          <th class="py-2 px-4 border-b">Reporter Block Number</th>
          <th class="py-2 px-4 border-b">Reporter First Name</th>
          <th class="py-2 px-4 border-b">Reporter Last Name</th>
          <th class="py-2 px-4 border-b">Reporter Phone Number</th>
          <th class="py-2 px-4 border-b">Date of the Incident</th>

          <th class="py-2 px-4 border-b">Date of the Incident</th>
          <th class="py-2 px-4 border-b">Date of the Incident</th>
          <th class="py-2 px-4 border-b">Date of the Incident</th>
          <th class="py-2 px-4 border-b">Date of the Incident</th>
          <th class="py-2 px-4 border-b">Date of the Incident</th>
          <th class="py-2 px-4 border-b">Date of the Incident</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($incidents_data as $incidents_data)
        <tr class="border-b">
            <td class="py-6 px-8 border-b text-center">{{$incidents_data->reporter_block_num}}</td>
            <td class="py-6 px-8 border-b text-center">{{$incidents_data->reporter_first_name}}</td>
            <td class="py-6 px-8 border-b text-center">{{$incidents_data->reporter_last_name}}</td>
            <td class="py-6 px-8 border-b text-center">{{$incidents_data->reporter_phone_number}}</td>
            <td class="py-6 px-8 border-b text-center">{{$incidents_data->incident_date}}</td>

            <td class="py-6 px-8 border-b text-center">{{$incidents_data->incident_time}}</td>
            <td class="py-6 px-8 border-b text-center">{{$incidents_data->location_details}}</td>
            <td class="py-6 px-8 border-b text-center">{{$incidents_data->incident_details}}</td>
            <td class="py-6 px-8 border-b text-center">{{$incidents_data->incident_type}}</td>
            <td class="py-6 px-8 border-b text-center">{{$incidents_data->person_behind_incident}}</td>
            <td class="py-6 px-8 border-b text-center">{{$incidents_data->person_behind_incident_block_num}}</td>
        </tr>
        @endforeach
        <!-- Add more rows as needed -->
      </tbody>
    </table>
  </div>
</x-app-layout>
</body>
</html>



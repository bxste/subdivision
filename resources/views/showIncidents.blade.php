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
  

  <!-- ssss -->
  <div class="container mx-auto g-4 py-6">
        <table class="min-w-full bg-white border border-gray-300 shadow-sm rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 border-b text-center">Reporter First Name</th>
                    <th class="py-2 px-4 border-b text-center">Reporter Last Name</th>
                    <th class="py-2 px-4 border-b text-center">Incident Type</th>
                    <th class="py-2 px-4 border-b text-center">Status</th>
                    <th class="py-2 px-4 border-b text-center">More</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($incidents_data as $incidents_data)
                <tr class="border-b">
                    <td class="py-6 px-8 border-b text-center">{{$incidents_data->reporter_first_name}}</td>
                    <td class="py-6 px-8 border-b text-center">{{$incidents_data->reporter_last_name}}</td>
                    <td class="py-6 px-8 border-b text-center">{{$incidents_data->incident_type}}</td>
                    <td class="py-6 px-8 border-b text-center">{{$incidents_data->status}}</td>
                    <td class="py-6 px-8 border-b text-center">
                        <button class="bg-transparent hover:bg-blue-400 text-blue-400 font-semibold hover:text-white py-2 px-4 border border-blue-400 hover:border-transparent rounded" onclick="toggleDetails({{ $loop->index }})">
                            View More
                        </button>
                    </td>
                    
                </tr>
                <tr id="details_{{ $loop->index }}" class="hidden">
                    <td colspan="5">
                        <div class="flex flex-wrap justify-center">
                            
                            <div class="w-full bg-gray-200 px-4 py-2 border-b border-gray-300"><strong>Reporter Block Number:</strong> {{$incidents_data->reporter_block_num}}</div>
                            <div class="w-full bg-gray-100 px-4 py-2 border-b border-gray-300"><strong>Reporter Phone Number:</strong> {{$incidents_data->reporter_phone_number}}</div>
                            <div class="w-full bg-gray-200 px-4 py-2 border-b border-gray-300"><strong>Date of the Incident:</strong> {{$incidents_data->incident_date}}</div>
                            <div class="w-full bg-gray-100 px-4 py-2 border-b border-gray-300"><strong>Time of the Incident:</strong> {{$incidents_data->incident_time}}</div>
                            <div class="w-full bg-gray-200 px-4 py-2 border-b border-gray-300"><strong>Location of Incident:</strong> {{$incidents_data->location_details}}</div>
                            <div class="w-full bg-gray-100 px-4 py-2 border-b border-gray-300"><strong>Incident Details:</strong> {{$incidents_data->incident_details}}</div>
                            <div class="w-full bg-gray-200 px-4 py-2 border-b border-gray-300"><strong>Incident Type:</strong> {{$incidents_data->incident_type}}</div>
                            <div class="w-full bg-gray-100 px-4 py-2 border-b border-gray-300"><strong>Person Behind Incident:</strong> {{$incidents_data->person_behind_incident}}</div>
                            <div class="w-full bg-gray-200 px-4 py-2 border-b border-gray-300"><strong>Person Behind Incident Block Number:</strong> {{$incidents_data->person_behind_incident_block_num}}</div>
                        </div>
                        <hr class="my-4">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

    <script>
        function toggleDetails(index) {
            var detailsRow = document.getElementById('details_' + index);
            detailsRow.classList.toggle('hidden');
        }
    </script>
</x-app-layout>
</body>
</html>



<x-adminApp-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Incident Report') }}
        </h2>
    </x-slot>

    <div class="container mx-auto g-4 py-6">
        <table class="min-w-full bg-white border border-gray-300 shadow-sm rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 border-b text-center">Reporter Block Number</th>
                    <th class="py-2 px-4 border-b text-center">More</th>
                    <th class="py-2 px-4 border-b text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($forms as $incidents_data)
                <tr class="border-b">
                    <td class="py-6 px-8 border-b text-center">{{$incidents_data->reporter_block_num}}</td>
                    <td class="py-6 px-8 border-b text-center">
                        <button class="bg-gray-800 hover:bg-gray-900 text-white py-2 px-6 rounded-lg" onclick="toggleDetails({{ $loop->index }})">
                            View More
                        </button>
                    </td>
                    <td>
                    <form action="{{ route('admin.forms.updateStatus', $incidents_data) }}" method="POST" class="flex justify-center">
                        @csrf
                        @method('POST')
                        <select name="status" id="status" class="block mr-2 appearance-none bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <option value="in_progress" {{ $incidents_data->status === 'in_progress' ? 'selected' : ''}}>Pending</option>
                            <option value="done" {{ $incidents_data->status === 'done' ? 'selected' : ''}}>Done</option>
                        </select>
                        <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white py-2 px-6 rounded-lg">
                            Update Status
                        </button>
                    </form>
                    </td>
                </tr>
                <tr id="details_{{ $loop->index }}" class="hidden">
                    <td colspan="3">
                        <div class="flex flex-wrap justify-center">
                            <div class="w-full bg-gray-100 px-4 py-2 border-b border-gray-300"><strong>Reporter First Name:</strong> {{$incidents_data->reporter_first_name}}</div>
                            <div class="w-full bg-gray-200 px-4 py-2 border-b border-gray-300"><strong>Reporter Last Name:</strong> {{$incidents_data->reporter_last_name}}</div>
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

    <script>
        function toggleDetails(index) {
            var detailsRow = document.getElementById('details_' + index);
            detailsRow.classList.toggle('hidden');
        }
    </script>
</x-adminApp-layout>

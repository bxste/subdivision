<!-- show.blade.php //waiver -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <title>Tailwind CSS Table Design</title>
</head>
<body>
  <div>
    <x-app-layout class="bg-gray-100 p-4 space-y-6">
      <x-slot name="header">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              {{ __('Monitor Waiver') }}
          </h2>
      </x-slot>
    <div class="container mx-auto g-4 py-6">
      <table class="min-w-full bg-white border border-gray-300 shadow-sm rounded-lg overflow-hidden">
        <thead class="bg-gray-200">
          <tr>
            <th class="py-2 px-4 border-b">Homeowner ID</th>
            <th class="py-2 px-4 border-b">First Name</th>
            <th class="py-2 px-4 border-b">Last Name</th>
            <th class="py-2 px-4 border-b">Phone Number</th>
            <th class="py-2 px-4 border-b">Description</th>
            <th class="py-2 px-4 border-b">Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $data)
          <tr class="border-b">
              <td class="py-6 px-8 border-b text-center">{{$data->homeowner_id}}</td>
              <td class="py-6 px-8 border-b text-center">{{$data->first_name}}</td>
              <td class="py-6 px-8 border-b text-center">{{$data->last_name}}</td>
              <td class="py-6 px-8 border-b text-center">{{$data->phone_number}}</td>
              <td class="py-6 px-8 border-b text-center">{{$data->description}}</td>
              <td class="py-6 px-8 border-b text-center">{{$data->status}}</td>
          </tr>
          @endforeach
          <!-- Add more rows as needed -->
        </tbody>
      </table>
    </div>
  </x-app-layout>
  </div>
</body>
</html>


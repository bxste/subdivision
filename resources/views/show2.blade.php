<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <title>Tailwind CSS Table Design</title>
</head>
<body class="bg-gray-100 p-4">

  <div class="container mx-auto ">
    <table class="min-w-full bg-white border border-gray-300 shadow-sm rounded-lg overflow-hidden">
      <thead class="bg-gray-200">
        <tr>
          <th class="py-2 px-4 border-b">Homeowner ID</th>
          <th class="py-2 px-4 border-b">Name</th>
          <th class="py-2 px-4 border-b">Phone Number</th>
          <th class="py-2 px-4 border-b">Description</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $data)
        <tr class="border-b">
            <td class="py-6 px-8 border-b text-center">{{$data->homeowner_id}}</td>
            <td class="py-6 px-8 border-b text-center">{{$data->name}}</td>
            <td class="py-6 px-8 border-b text-center">{{$data->phone_number}}</td>
            <td class="py-6 px-8 border-b text-center">{{$data->description}}</td>
        </tr>
        @endforeach
        <!-- Add more rows as needed -->
      </tbody>
    </table>
  </div>

</body>
</html>


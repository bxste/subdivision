<table>
    <thead>
        <tr>
            <th class="px-2 py-3 text-left">Homeowner Id</th>
            <th class="px-2 py-3 text-left">Name</th>
            <th class="px-2 py-3 text-left">Phone_Number</th>
            <th class="px-2 py-3 text-left">Description</th>
        </tr>
    </thead>

    <tbody>
            
                @foreach ($data as $data)
                    <tr>
                        <td>{{$data->name}}</td>
                        <td>{{$data->phone_number}}</td>
                        <td>{{$data->description}}</td>
                        <td>{{$data->homeowner_id}}</td>
                    </tr>
                @endforeach
            
        </tbody>
</table>
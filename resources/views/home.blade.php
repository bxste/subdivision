<h1 class="mb-5 mt-4">Therre are {{$data->count()}} data in {{ Auth::user()->name }}</h1>
<div>
    <table>
        <thead>
             <tr>
                <td>naame</td>
                <td>num</td>
                <td>des</td>
                <td>id</td>
            </tr>
        </thead>
        <tbody>
            @if ($userData->count()>0)
                @foreach ($data as $data)
                    <tr>
                        <td>{{$data->name}}</td>
                        <td>{{$data->phone_number}}</td>
                        <td>{{$data->description}}</td>
                        <td>{{$data->homeowner_id}}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

<div class="py=12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <table class="w-full bg=white">
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
    </div>
</div>
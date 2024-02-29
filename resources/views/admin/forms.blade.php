<x-adminApp-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

           <div class="container mx-auto g-4 py-6">
                <table class="min-w-full bg-white border border-gray-300 shadow-sm rounded-lg overflow-hidden">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-2 px-4 border-b text-center">Homeowner ID</th>
                            <th class="py-2 px-4 border-b text-center">First Name</th>
                            <th class="py-2 px-4 border-b text-center">Last Name</th>
                            <th class="py-2 px-4 border-b text-center">Email</th>
                            <th class="py-2 px-4 border-b text-center">Phone Number</th>
                            <th class="py-2 px-4 border-b text-center">Description</th>
                            <th class="py-2 px-4 border-b text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($forms as $form)
                        <tr class="border-b">
                            <td class="py-6 px-8 border-b text-center">{{ $form->homeowner_id }}</td>
                            <td class="py-6 px-8 border-b text-center">{{ $form->first_name }}</td>
                            <td class="py-6 px-8 border-b text-center">{{ $form->last_name }}</td>
                            <td class="py-6 px-8 border-b text-center">{{ $form->email }}</td>
                            <td class="py-6 px-8 border-b text-center">{{ $form->phone_number }}</td>
                            <td class="py-6 px-8 border-b text-center">{{ $form->description }}</td>
                            <td class="py-6 px-8 border-b text-center">
                                <form action="{{ route('admin.forms.updateStatus', $form) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <select name="status" id="status" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="in_progress" {{ $form->status === 'in_progress' ? 'selected' : ''}}>Pending</option>
                                        <option value="done" {{ $form->status === 'done' ? 'selected' : ''}}>Done</option>
                                    </select>
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 mt-2 rounded">
                                        Update Status
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
</x-adminApp-layout>

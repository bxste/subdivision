    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach(auth()->user()->notifications as $notification)
                        <div class="bg-blue-300 p-3 m-3">
                            {{ $notification->data["name"] }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
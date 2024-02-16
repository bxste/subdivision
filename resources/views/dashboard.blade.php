<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (optional, if you need JavaScript features) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div> -->
        </div>
    </div>
    <div class="container py-2">
        
        
        <div class="row g-4 py-2">
            <div class="col-6 ">
                <!-- About Section -->
                <div class="bg-white p-3 shadow-sm rounded-sm">
                    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                        <span clas="text-green-500">
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <span class="tracking-wide">About</span>
                    </div>
                    <div class="text-gray-700">
                        <div class="grid md:grid-cols-2 text-sm">
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">First Name</div>
                                <div class="px-4 py-2">{{ Auth::user()->name }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Last Name</div>
                                <div class="px-4 py-2">Doe</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Gender</div>
                                <div class="px-4 py-2">Female</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Contact No.</div>
                                <div class="px-4 py-2">+11 998001001</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Current Address</div>
                                <div class="px-4 py-2">Beech Creek, PA, Pennsylvania</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Permanant Address</div>
                                <div class="px-4 py-2">Arlington Heights, IL, Illinois</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Email.</div>
                                <div class="px-4 py-2">
                                    <a class="text-blue-800" href="mailto:jane@example.com">jane@example.com</a>
                                </div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Birthday</div>
                                <div class="px-4 py-2">Feb 06, 1998</div>
                            </div>
                        </div>
                    </div>
                    <button
                        class="block w-full text-blue-800 text-sm font-semibold rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4">Show
                        Full Information</button>
                </div>
                <!-- End of about section -->
            </div>
            <div class="col-6">
                <div class="bg-white p-3 shadow-sm rounded-sm">
                    <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Waiver Requirements:</h2>
                    <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
                        <li class="flex items-center">
                            <svg class="w-3.5 h-3.5 me-2 text-green-500 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            At least 10 characters
                        </li>
                        <li class="flex items-center">
                            <svg class="w-3.5 h-3.5 me-2 text-green-500 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            At least one lowercase character
                        </li>
                        <li class="flex items-center">
                            <svg class="w-3.5 h-3.5 me-2 text-gray-500 dark:text-gray-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            At least one special character, e.g., ! @ # ?
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12">
                
            <div class=" bg-white overflow-hidden shadow-sm">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <!-- <h3 class="text-center mt-5">Full Calendar</h3> -->
                            <div class="col-md-10 offset-1 mt-5 mb-5 pb-2">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var booking = @json($events);
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: booking,
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDays){
                    $('#bookingModal').modal('toggle');

                    $.ajax({
                            success:function(response)
                            {
                                $('#bookingModal').modal('hide')
                                $('#calendar').fullCalendar('renderEvents', {
                                    'title': response.title,
                                    'start': response.start_date,
                                    'end': response.end_date,
                                    'color': response.color,
                                });

                            },
                            error:function(error)
                            {
                                if(error.responseJSON.errors) {
                                    $('#titleError').html(error.responseJSON.errors.title);
                                }
                            },
                        })
                },
                
                
                selectAllow: function(event)
                {
                    return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1, 'second').utcOffset(false), 'day');
                },
            });
            $("#bookingModal").on("hidden.bs.modal", function(){
                $('#saveBtn').unbind();
            });

        });
    </script>
</x-app-layout>


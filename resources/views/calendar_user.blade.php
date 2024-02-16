<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<body>
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

        <div class="container">
            <div class="row g-2">
                <div class="col-6">
                    <div class="p-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">sMy Profile</div>
                </div>
                <div class="col-6">
                    <div class="p-3 bg-white overflow-hidden shadow-sm sm:rounded-lg ">My Checklist</div>
                </div>
                <div class="col-6">
                    <div class="p-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <a href="{{url('/create')}}">Apply for Waiver</a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <a href="{{url('/show')}}">Monitor Waiver</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container py-2">
            <div class="row g-2 py-2">
                <div class="col-6">
                    <!-- About Section -->
                    <div class="bg-white p-3 shadow-sm rounded-sm">
                        <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                            <span class="text-green-500">
                                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
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
                                <!-- Add other details here -->
                            </div>
                        </div>
                        <button class="block w-full text-blue-800 text-sm font-semibold rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4">Show Full Information</button>
                    </div>
                    <!-- End of about section -->
                </div>
                <div class="col-6">
                    <div class="bg-white p-3 shadow-sm rounded-sm">
                        <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Waiver Requirements:</h2>
                        <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
                            <!-- Add waiver requirements here -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="pt-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <!-- <h3 class="text-center mt-5">Full Calendar</h3> -->
                            <div class="pl-0 col-md-11 offset-1 mt-5 mb-5">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- <h3 class="text-center mt-5">Full Calendar</h3> -->
                <div class="col-md-11 offset-1 mt-5 mb-5">
                    <div id="calendar"></div>
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
</body>
</html>

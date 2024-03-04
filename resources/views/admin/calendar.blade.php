<x-adminApp-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Calendar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <div>
            <!-- Modal -->
        <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="exampleModalLabel" >Booking Title</h2>
                    <button type="button" class="close" aria-label="Close" onclick="closeModal()">
                    <span aria-hidden="true">&times;</span>
                </button>

                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="title" placeholder="Event Name">
                    <span id="titleError" class="text-danger"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="saveBtn" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Save changes</button>
                </div>
                </div>
            </div>
        </div>
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
                    left: 'prev,next, today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: booking,
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDays){
                    $('#bookingModal').modal('toggle');

                    $('#saveBtn').click(function(){
                        var title = $('#title').val();
                        var start_date = moment(start).format('YYYY-MM-DD');
                        var end_date = moment(end).format('YYYY-MM-DD');

                        $.ajax({
                            url:"{{ route('calendar.store') }}",
                            type:"POST",
                            data:{ title, start_date, end_date},
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
                    })
                },
                editable: true,
                eventDrop: function(event){
                    var id = event.id;
                    var start_date = moment(event.start).format('YYYY-MM-DD HH:mm:ss');
                    var end_date = moment(event.end).format('YYYY-MM-DD HH:mm:ss');

                    $.ajax({
                            url:"{{ route('calendar.update', '') }}" + '/' + id,
                            type:"PATCH",
                            data:{start_date, end_date},
                            success:function(response)
                            {
                                swal("Good job!", "Event Updated!", "success");

                            },
                            error:function(error)
                            {
                                console.log(error)
                            },
                        })
                },
                eventClick: function(event){
                    var id = event.id;
                    
                    if(confirm('Are you sure you want to remove the event?')){
                        $.ajax({
                            url:"{{ route('calendar.destroy', '') }}" + '/' + id,
                            type:"DELETE",
                            success:function(response)
                            {
                                $('#calendar').fullCalendar('removeEvents', response);
                                swal("Good job!", "Event Deleted!", "success");

                            },
                            error:function(error)
                            {
                                console.log(error)
                            },
                        });
                    }
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
                </div>
            </div>
        </div>
    </div>
</x-adminApp-layout>

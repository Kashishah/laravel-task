@extends('layout')


@section('title')
guest booking
@endsection


@section('body')

<div class="error-message">
    @if (session('error'))
    <div class="text text-danger">{{ session('error')  }}</div>
    @endif
</div>



<div class="form mt-3">
    <div class="card mb-3" id="firstCard">
        <div class="card-body">
            <form id="guestForm" method="post">
                @csrf
                <div class="mb-3 row">
                    <label for="guest_name" class="col-sm-2 col-form-label">Guest name</label>
                    <div class="col-sm-10">
                        <input type="text" name="guest_name" class="form-control" id="guest_name">
                    </div>
                    <div id="error-message-guest"></div>
                </div>

                <div class="mb-3 row">
                    <label for="total_rooms" class="col-sm-2 col-form-label">Total rooms</label>
                    <div class="col-sm-2">
                        <input type="number" name="total_rooms" class="form-control" id="total_rooms">
                    </div>
                    <div id="error-message-rooms"></div>
                </div>

                <div class="mb-3">
                    <button type="submit" id="nextBtn" class="btn btn-danger text-white">Next</button>
                </div>
            </form>
        </div>
    </div>


    <div class="cards" id="cards">

    </div>

    <div class="mt-5 mb-5" id="save-data-button">
        <button type="submit" class="btn btn-danger">Save all data</button>
    </div>


</div>



@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        const globalVar = {
            globalId
        };
        $('#save-data-button').hide();
        $('#error-message-guest').hide()
        $('#error-message-rooms').hide()
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var globalId;
        var formIds = [];


        $('#guestForm').on('submit', function(e) {
            e.preventDefault();
            var guest_name = $('#guest_name').val();
            var total_rooms = $('#total_rooms').val();
            if (guest_name == '' || total_rooms == '') {
                $('#error-message-guest').addClass('text text-danger').text('Please fill the value first').show();
                $('#error-message-rooms').addClass('text text-danger').text('Please fill the value first').show();
                return
            } else {
                $('#error-message-guest').hide()
                $('#error-message-rooms').hide()
                $.ajax({
                    dataType: "json",
                    type: "POST",
                    url: '{{ route("guest.store") }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    data: {
                        'guest_name': guest_name,
                        'total_rooms': total_rooms
                    },
                    success: function(response) {
                        if (response.status == true) {
                            globalVar.globalId = response.id;
                            $('#firstCard').hide();

                            for (var i = 1; i <= total_rooms; i++) {
                                $('#cards').append(
                                    `
                                    <div class="card mb-2" id="card-` + i + `">
                                    <div class="card-body mb-3">
                                        <div class="d-flex justify-content-between">
                                            <span class="room-head mb-3">Room # ` + i + `</span>
                                            <div>
                                                <button id="add_guest" data-id="` + i + `" class="btn btn-danger"> + Add Guest</button>
                                            </div>
                                        </div>

                                        <form action="" class="secondForm d-flex row" id="form-` + i + `">
                                            <div class="mb-3 col">
                                                <label for="name_of_guest" class="col-form-label">Name of Guest</label>
                                                <div class="">
                                                    <input type="text" name="name_of_guest" class="name_of_guest form-control" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="start_date" class="col-form-label">Start date</label>
                                                <div class="">
                                                    <input class="form-control start_date" name="start_date" type="date" min="2024-08-21" max="2024-08-28">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="end_date" class="col-form-label">End date</label>
                                                <div class="">
                                                    <input class="form-control end_date" name="end_date" type="date" min="2024-08-21" max="2024-08-28" required>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="mb-3 col">
                                                    <label for="name_of_guest" class="col-form-label">Name of Guest</label>
                                                    <div class="">
                                                        <input type="text" name="name_of_guest" class="name_of_guest form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label for="start_date" class="col-form-label">Start date</label>
                                                    <div class="">
                                                        <input class="form-control start_date" name="start_date" type="date" min="2024-08-21" max="2024-08-28" required>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label for="end_date" class="col-form-label">End date</label>
                                                    <div class="">
                                                        <input class="form-control end_date" name="end_date" type="date" min="2024-08-21" max="2024-08-28" required>
                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                </div>

                                    `
                                );
                            }
                        }
                        $('#save-data-button').show();
                    }
                });
            }
        });





        // On click of add guest fetch id of that form and add one more field start
        $(document).on('click', '#add_guest', function() {
            var id = $(this).data('id');
            var formId = $('#form-' + id);
            formId.append(`<div class="row">
                                                <div class="mb-3 col">
                                                    <label for="name_of_guest" class="col-form-label">Name of Guest</label>
                                                    <div class="">
                                                        <input type="text" name="name_of_guest" class="name_of_guest form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label for="start_date" class="col-form-label">Start date</label>
                                                    <div class="">
                                                        <input class="form-control start_date" name="start_date" type="date" min="2024-08-21" max="2024-08-28" required>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label for="end_date" class="col-form-label">End date</label>
                                                    <div class="">
                                                        <input class="form-control end_date" name="end_date" type="date" min="2024-08-21" max="2024-08-28"  required>
                                                    </div>
                                                </div>`);

        });
        // On click of add guest fetch id of that form and add one more field  end



        $('#save-data-button').on('click', function(e) {
            e.preventDefault()
            // $('#firstCard').append('');
           
            var guestname_values = [];
            var start_date = [];
            var end_date = [];

            $("[id^='form-']").each(function() {
                $(this).find('input[name="name_of_guest"]').each(function() {
                    guestname_values.push($(this).val());
                });

                $(this).find('input[name="start_date"]').each(function() {
                    start_date.push($(this).val());
                });

                $(this).find('input[name="end_date"]').each(function() {
                    end_date.push($(this).val());
                });
            });


            $.ajax({
                dataType: 'json',
                type: 'POST',
                url: '{{ route("room_booking.store") }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                data: {
                    'guest_id': globalVar.globalId,
                    'name_of_guest': guestname_values,
                    'start_date': start_date,
                    'end_date': end_date,
                },
                success: function(response) {
                    if (response.status == true) {
                        alert('data inserted');
                    }
                },
            })
        });
    });
</script>
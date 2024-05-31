<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient Appointment Record</title>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="bg-white text-blue-900">

<!-- Header -->
@include('compulsory.header')

<!-- Navbar -->
<div class="mt-[6rem]">
    @include('users.receptionist.navbar')
</div>

<div class="ml-[6.25rem] py-1 flex flex-wrap border-b-blue-600" id="editPatientAppointment">
    <div class="w-[70rem] mt-4 p-10 rounded-md shadow-lg items-center overflow-y-auto max-h-[73vh] mx-auto bg-gray-200 border border-blue-200 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
        <div class="grid mb-7">
            <h1 class="text-2xl font-medium mb-7 text-center text-blue-500">Edit Appointment Record</h1>
            <hr class="border-opacity-50 border-blue-600 w-full mb-6">
        </div>
        <form action="{{ route('receptionist_user.patient_record.update_appointment.update', $appointmentRecord) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <input type="hidden" id="appointment_status" name="appointment_status"
                       class="form-input bg-red-50 focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                       value="{{ $appointmentRecord->status }}" required>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="patient_id" class="block text-sm font-medium mb-1">Patient ID</label>
                    <input type="number" id="patient_id" name="patient_id"
                           class="form-input bg-red-50 focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           value="{{ $appointmentRecord->patient_id }}" required readonly>
                </div>
                {{--<div class="mb-4">
                    <label for="doctor_id" class="block text-sm font-medium mb-1">Doctor</label>
                    <select id="doctor_id" name="doctor_id" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500" required>
                        <option value="{{ $appointmentRecord->doctor_id }}">{{ $appointmentRecord->doctor_name }}</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                        @endforeach
                    </select>
                </div>--}}
                <div class="mb-4">
                    <label for="doctor_id" class="block text-sm font-medium mb-1">Doctor</label>
                    <select id="doctor_id" name="doctor_id" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500" required>
                        @php
                            $sortedDoctors = $doctors->sortBy('name'); // Sort the doctors array alphabetically by name
                        @endphp
                        @foreach($sortedDoctors as $doctor)
                            @if($doctor->id === $doctor_id)
                                <option value="{{ $doctor->id }}" selected>{{ $doctor->name }}</option>
                            @else
                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="appointment_day" class="block text-sm font-medium mb-1">Schedule Days</label>
                    <select id="appointment_day" name="appointment_day" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500" value="{{ $appointmentRecord->appointment_day }}" required>

                    </select>
                </div>

                <div class="mb-4">
                    <label for="appointment_time" class="block text-sm font-medium mb-1">Schedule Times</label>
                    <select id="appointment_time" name="appointment_time" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500" required>
                        @foreach($allScheduleDaysTimes as $allScheduleTimes)
                            @if($allScheduleTimes->start_time == $appointmentRecord->appointment_time)
                                <option value="{{ date('H:i A', strtotime($allScheduleTimes->start_time)) }}" selected>{{date('H:i A', strtotime($allScheduleTimes->start_time)) . ' - ' . date('H:i A', strtotime($allScheduleTimes->end_time))}}</option>
                            @else
                                <option value="{{ date('H:i A', strtotime($allScheduleTimes->start_time)) }}">{{date('H:i A', strtotime($allScheduleTimes->start_time)) . ' - ' . date('H:i A', strtotime($allScheduleTimes->end_time))}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="appointment_date" class="block text-sm font-medium mb-1">Appointment Date</label>
                    <input type="date" id="appointment_date" name="appointment_date" class="form-input focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500" value="{{ $appointmentRecord->appointment_date }}" required>
                    <div id="date_error" class="text-red-500 text-sm hidden"></div>
                    <div id="date_time_error" class="text-red-500 text-sm hidden"></div>
                </div>
                <div class="mb-4 col-span-2">
                    <label for="reason" class="block text-sm font-medium mb-1">Reason</label>
                    <textarea id="reason" name="reason" class="form-textarea focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500" required>{{ $appointmentRecord->reason }}</textarea>
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md" id="submit_btn">Update Appointment
                </button>
            </div>
        </form>
    </div>
</div>
<!-- Footer -->
<div class="mt-[2.4rem] bg-gray-200">
    @include('compulsory.footer')
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous">
</script>
<script>
    // AJAX Setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    // Fetch available days when the page loads
    $(document).ready(function() {
        let doctorId = $('#doctor_id').val();
        $.ajax({
            url: '{{ route("fetch_available_days") }}',
            type: 'GET',
            data: {
                doctor_id: doctorId
            },
            success: function(response) {
                $('#appointment_day').html(response);
                // Pre-select the day based on the value from the database
                let selectedDay = '{{ $appointmentRecord->appointment_day }}';
                $('#appointment_day').val(selectedDay);
            },
            error: function(xhr) {
                console.log('Error:', xhr);
            }
        });
    });


    // Fetch available times when the page loads
    /*$(document).ready(function() {
        let doctorId = $('#doctor_id').val();
        let appointmentDay = $('#appointment_day').val();

        $.ajax({
            url: '{{--{{ route("fetch_available_times") }}--}}',
            type: 'GET',
            data: {
                doctor_id: doctorId,
                appointment_day: appointmentDay // Assuming you want to fetch times based on the initially selected day
            },
            success: function(response) {
                $('#appointment_time').html(response);
                // Pre-select the time based on the value from the database
                /!*let startTime = '{{--{{ date("h:i A", strtotime($appointmentRecord->appointment_time)) }}--}}';
                let endTime = '{{--{{ date("h:i A", strtotime($appointmentRecord->appointment_time . '+30 minutes')) }}--}}';*!/
                let selectedTime = '{{--{{$start_time}}--}}' + ' - ' + '{{--{{$end_time}}--}}';
                $('#appointment_time').val(selectedTime);

                console.log(selectedTime);
            },
            error: function(xhr) {
                console.log('Error:', xhr);
            }
        });
    });*/


    // Fetch Available Day
    $('#doctor_id').change(function () {
        let doctorId = $(this).val();

        $.ajax({
            url: '{{ route("fetch_available_days") }}',
            type: 'GET',
            data: {
                doctor_id: doctorId
            },
            success: function (response) {
                $('#appointment_day').html(response);
                // Pre-select the day based on the value from the database
                /*let selectedDay = '{{--{{ $appointmentRecord->appointment_day }}--}}';
                $('#appointment_day').val(selectedDay);*/
            },
            error: function (xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    // Fetch Available Times
    $('#doctor_id, #appointment_day').change(function() {
        let doctorId = $('#doctor_id').val();
        let appointmentDay = $('#appointment_day').val();

        $.ajax({
            url: '{{ route("fetch_available_times") }}',
            type: 'GET',
            data: {
                doctor_id: doctorId,
                appointment_day: appointmentDay,
            },
            success: function(response) {
                $('#appointment_time').html(response);
            },
            error: function(xhr) {
                console.log('Error:', xhr);
            }
        });
    });


    // Validate selected date against schedule day
    $(document).ready(function() {
        function validateDateAndDay() {
            let selectedDate = new Date($('#appointment_date').val());
            let selectedDayName = selectedDate.toLocaleString('en-US', { weekday: 'long' });

            let appointmentDay = $('#appointment_day').val();

            // Check if selected date day matches the schedule day
            if (selectedDayName !== appointmentDay) {
                $('#date_error').text('Selected date does not match the schedule day.').removeClass('hidden');
            } else {
                $('#date_error').text('').addClass('hidden');
            }
        }

        $('#appointment_date, #appointment_day').change(validateDateAndDay);

        // Clear error message when changing the "Schedule Days" field
        $('#appointment_day').change(function() {
            let selectedDate = new Date($('#appointment_date').val());
            let selectedDayName = selectedDate.toLocaleString('en-US', { weekday: 'long' });

            let appointmentDay = $(this).val();

            // Check if selected date day matches the schedule day
            if (selectedDayName === appointmentDay) {
                $('#date_error').text('').addClass('hidden');
            }
        });
    });


    // Validate form before submission
    $(document).ready(function() {
        $('form').submit(function(event) {
            let selectedDate = new Date($('#appointment_date').val());
            let selectedDayName = selectedDate.toLocaleString('en-US', { weekday: 'long' });
            let appointmentDay = $('#appointment_day').val();

            // Check if selected date day matches the schedule day
            if (selectedDayName !== appointmentDay) {
                // Prevent form submission
                event.preventDefault();
                $('#date_error').text('Selected date does not match the schedule day.').removeClass('hidden');
            } else {
                $('#date_error').text('').addClass('hidden');
            }
        });
    });

    // Validate form before submission
    $(document).ready(function() {
        $('#submit_btn').click(function(event) {
            // Prevent the default form submission
            event.preventDefault();

            let selectedDate = $('#appointment_date').val();
            let selectedTime = $('#appointment_time').val();
            let doctorId = $('#doctor_id').val();

            // Perform AJAX request to check appointment existence
            $.ajax({
                url: '{{ route("check_appointment_existence") }}',
                type: 'GET',
                data: {
                    appointment_date: selectedDate,
                    appointment_time: selectedTime,
                    doctor_id: doctorId
                },
                success: function(response) {
                    if (response.exists) {
                        // Appointment already exists, show error message
                        $('#date_time_error').text('Appointment for selected date and time already exists.').removeClass('hidden');
                    } else {
                        // Appointment does not exist, submit the form
                        $('#date_time_error').text('').addClass('hidden');
                        // Trigger the form submission
                        $('form').submit();
                    }
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                }
            });
        });
    });

    // Function to initialize tooltips
    function initializeTooltips() {
        tippy('.navbar-items', {
            content(reference) {
                return reference.getAttribute('data-tooltip');
            },
            // placement: 'right',
        });
    }

    // Initialize tooltips when the page loads
    window.addEventListener('load', initializeTooltips);

    // Function to remove tooltips
    function removeTooltips() {
        const tooltips = document.querySelectorAll('[data-tooltip]');
        tooltips.forEach(tooltip => {
            const instance = tooltip._tippy;
            if (instance) {
                instance.destroy(); // Remove the tooltip
            }
        });
    }

    // Navbar Collapsed and Expand
    const collapseNavbarBtn = document.getElementById('collapseNavbar');
    const navbarContainer = document.getElementById('navbarContainer');
    // const collapseIcon = document.getElementById('collapseIcon');
    const editPatientAppointment = document.getElementById('editPatientAppointment');

    collapseNavbarBtn.addEventListener('click', function () {
        navbarContainer.classList.toggle('collapsed');
        if (navbarContainer.classList.contains('collapsed')) {
            navbarContainer.style.width = '80px';
            editPatientAppointment.style.marginLeft = '100px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M15 8A7 7 0 1 0 1 8a7 7 0 0 0 14 0ZM4.75 7.25a.75.75 0 0 0 0 1.5h4.69L8.22 9.97a.75.75 0 1 0 1.06 1.06l2.5-2.5a.75.75 0 0 0 0-1.06l-2.5-2.5a.75.75 0 0 0-1.06 1.06l1.22 1.22H4.75Z" clip-rule="evenodd" /></svg>';

            initializeTooltips();
        } else {
            navbarContainer.style.width = 'auto';
            editPatientAppointment.style.marginLeft = '175px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm10.25.75a.75.75 0 0 0 0-1.5H6.56l1.22-1.22a.75.75 0 0 0-1.06-1.06l-2.5 2.5a.75.75 0 0 0 0 1.06l2.5 2.5a.75.75 0 1 0 1.06-1.06L6.56 8.75h4.69Z" clip-rule="evenodd" /></svg>';

            removeTooltips();
        }
    });
</script>

</body>
</html>

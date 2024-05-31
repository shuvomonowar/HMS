<div class="w-[60rem] ml-[2rem] overflow-y-auto max-h-[73vh] mx-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
    <div>
        <span id="closeDoctorAppointmentStatusModalBtn" class="cursor-pointer inline-block transition-transform duration-300 transform-gpu hover:rotate-90">
            <img src="{{ asset('images/appointment/close.png') }}" alt="Close Icon" class="w-7 h-7">
        </span>
    </div>
    <div class="grid mb-7">
        <h1 class="text-2xl font-medium text-center mb-4 text-blue-500">Add New Appointment</h1>
        <hr class="border-opacity-50 border-blue-600 w-full mb-6">
    </div>
    <form action="{{ route('receptionist_user.patient_record.appointment_record.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Doctor Selection -->
            <div class="mb-4">
                <label for="doctor_id" class="block text-sm font-medium mb-1">Doctor</label>
                <select id="doctor_id" name="doctor_id" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-blue-50 focus:outline-none focus:border-blue-500" required>
                    <option value="">Select Doctor</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Appointment Day Selection -->
            <div class="mb-4">
                <label for="appointment_day" class="block text-sm font-medium mb-1">Schedule Days</label>
                <select id="appointment_day" name="appointment_day" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-blue-50 focus:outline-none focus:border-blue-500" required>
                    <!-- AJAX response will populate this dropdown -->
                </select>
            </div>

            <!-- Appointment Times Radio Buttons -->
            {{--<div class="mb-4">
               <label for="appointment_times" class="block text-sm font-medium mb-1">Schedule Times</label>
               <div id="appointment_times" class="space-y-2 bg-blue-50 px-3 py-2 mr-[4.3rem] rounded-md border border-b-neutral-400" required>
                   <!-- AJAX response will populate this div -->
               </div>
           </div>--}}

            <!-- Appointment Times Selection -->
            <div class="mb-4">
                <label for="appointment_time" class="block text-sm font-medium mb-1">Schedule Times</label>
                <select id="appointment_time" name="appointment_time" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-blue-50 focus:outline-none focus:border-blue-500" required>
                    <!-- AJAX response will populate this dropdown -->
                </select>
            </div>

            <!-- Appointment Date Calendar -->
            <div class="mb-4">
                <label for="appointment_date" class="block text-sm font-medium mb-1">Appointment Date</label>
                <input type="date" id="appointment_date" name="appointment_date" class="form-input focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md border border-b-neutral-400 bg-blue-50 focus:outline-none focus:border-blue-500" required>
                <div id="date_error" class="text-red-500 text-sm hidden"></div>
                <div id="date_time_error" class="text-red-500 text-sm hidden"></div>
            </div>
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md" id="submit_btn">Find Status
            </button>
        </div>
    </form>
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
            },
            error: function (xhr) {
                console.log('Error:', xhr);
            }
        });
    });


    // Fetch Available Times
    $(document).ready(function() {
        $('#doctor_id, #appointment_day').change(function() {
            let doctorId = $('#doctor_id').val();
            let appointmentDay = $('#appointment_day').val();

            $.ajax({
                url: '{{ route("fetch_available_times") }}',
                type: 'GET',
                data: {
                    doctor_id: doctorId,
                    appointment_day: appointmentDay
                },
                success: function(response) {
                    $('#appointment_time').html(response); // Populate the div with radio buttons
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                }
            });
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

</script>

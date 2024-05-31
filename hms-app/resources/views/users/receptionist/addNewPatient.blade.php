<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Patient</title>
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

<div class="ml-[6.25rem] py-1 flex flex-wrap border-b-blue-600" id="addNewPatient">
    <div class="w-[70rem] mt-4 p-10 rounded-md shadow-lg items-center overflow-y-auto max-h-[73vh] mx-auto bg-gray-200 border border-blue-200 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
        <!-- Add search box, search button, and name dropdown -->
        <div class="bg-gray-300 rounded-2xl flex flex-col py-6">
            <div class="grid">
                <h1 class="text-2xl font-medium mb-2 text-center text-blue-500">Search Existing Patient</h1>
                <hr class="border-opacity-50 border-white w-full mb-6">
            </div>
            <div class="flex flex-row items-center ml-[2rem]">
                <div class="relative flex ml-[15rem]">
                    <input type="tel" id="phone_search" class="form-input focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-blue-50 focus:outline-none focus:border-blue-500" pattern="[0-9]{11}" title="Please enter a valid 11-digit phone number" placeholder="Search Using Phone Number ..." required>
                    <button type="button" id="search_button" class="text-white px-4 py-2 ml-3 rounded-md bg-blue-400 hover:bg-blue-500 transition duration-300 ease-in-out transform hover:scale-110" data-tippy-content="Find Existing Patient">
                        <img src="{{ asset('images/patient/search_white.png') }}" alt="Search Icon" class="w-6 h-6">
                    </button>
                </div>
            </div>
            <div class="flex flex-row items-center ml-[4.5rem] border border-gray-400 mt-4 mr-[5rem] rounded-lg">
                <div class="flex flex-row items-center mb-4 mt-2 ml-[1.7rem]">
                    <label for="id_dropdown" class="block text-md font-medium mb-1 mr-2 mt-2">Patient ID</label>
                    <select id="id_dropdown" class="form-select focus:bg-white rounded-md px-3 py-2 border border-b-neutral-400 focus:outline-none focus:border-blue-500 mt-2 w-[15rem]" required>
                        <!-- Dropdown options will be populated dynamically -->
                    </select>
                </div>
                <div class="flex flex-row items-center mb-4 mt-4 ml-6">
                    <label for="patient_name" class="block text-sm font-medium mb-1 mr-2">Patient Name</label>
                    <input type="text" id="patient_name" name="patient_name"
                           class="form-input focus:bg-white w-[15rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500" required readonly>
                </div>
                <div>
                    <button type="button" id="go_button" class="text-white bg-blue-500 px-4 py-2 mt-4 ml-4 mb-4 rounded-md hover:bg-blue-600">
                        Go to Record
                    </button>
                </div>
            </div>
        </div>
        <div class="grid">
            <hr class="border-opacity-50 border-white w-full mb-6 mt-8">
            <h1 class="text-2xl font-medium mb-1 text-center text-blue-500">Add New Patient</h1>
            <hr class="border-opacity-50 border-white w-full mb-1 mt-3">
        </div>
        <form id="addPatientForm" action="{{ route("receptionist_user.add_patient.store") }}" method="POST">
            @csrf
            <div class="grid">
                <h2 class="text-blue-800 mt-9 mb-2">Patient General Information</h2>
                <hr class="border-opacity-50 border-blue-600 w-full mb-6">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="first_name" class="block text-sm font-medium mb-1">First Name</label>
                    <input type="text" id="first_name" name="first_name"
                           class="form-input focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="last_name" class="block text-sm font-medium mb-1">Last Name</label>
                    <input type="text" id="last_name" name="last_name"
                           class="form-input focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="gender" class="block text-sm font-medium mb-1">Gender</label>
                    <select id="gender" name="gender"
                            class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500"
                            required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="blood_group" class="block text-sm font-medium mb-1">Blood Group</label>
                    <select id="blood_group" name="blood_group" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500" required>
                        <option value="">Select Blood Group</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="birth_date" class="block text-sm font-medium mb-1">Birth Date</label>
                    <input type="date" id="birth_date" name="birth_date"
                           class="form-input focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500" required>
                </div>
                {{--<div class="mb-4">
                    <label for="age" class="block text-sm font-medium mb-1">Age</label>
                    <input type="text" id="age" name="age"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           pattern="[0-9]+" title="Please enter numbers only" required>
                </div>--}}
                <div class="mb-4 col-span-2">
                    <label for="address" class="block text-sm font-medium mb-1">Address</label>
                    <textarea id="address" name="address"
                              class="form-textarea focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500"
                              required></textarea>
                </div>
                <div class="mb-4">
                    <label for="phone_number" class="block text-sm font-medium mb-1">Phone</label>
                    <input type="tel" id="phone_number" name="phone_number"
                           class="form-input focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500"
                           pattern="[0-9]{11}" title="Please enter a valid 11-digit phone number" required>
                </div>
                @error('message')
                <div class="text-red-500 text-xs mt-2 text-center">{{ $message }}</div>
                @enderror
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" id="email" name="email"
                           class="form-input focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <div class="grid">
                <h2 class="text-blue-800 mt-9 mb-2">Patient Appointment Information</h2>
                <hr class="border-opacity-50 border-blue-600 w-full mb-6">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Doctor Selection -->
                <div class="mb-4">
                    <label for="doctor_id" class="block text-sm font-medium mb-1">Doctor</label>
                    <select id="doctor_id" name="doctor_id" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500" required>
                        <option value="">Select Doctor</option>
                        @php
                            $sortedDoctors = $doctors->sortBy('name'); // Sort the doctors array alphabetically by name
                        @endphp
                        @foreach($sortedDoctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Appointment Day Selection -->
                <div class="mb-4">
                    <label for="appointment_day" class="block text-sm font-medium mb-1">Schedule Days</label>
                    <select id="appointment_day" name="appointment_day" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500" required>
                        <!-- AJAX response will populate this dropdown -->
                    </select>
                </div>

                <!-- Appointment Date Calendar -->
                <div class="mb-4">
                    <label for="appointment_date" class="block text-sm font-medium mb-1">Appointment Date</label>
                    <input type="date" id="appointment_date" name="appointment_date" class="form-input focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500" required>
                    <div id="date_error" class="text-red-500 text-sm hidden"></div>
                    <div id="date_time_error" class="text-red-500 text-sm hidden"></div>
                </div>

                <!-- Appointment Times Radio Buttons -->
                {{--<div class="mb-4">
                    <label for="appointment_times" class="block text-sm font-medium mb-1">Schedule Times</label>
                    <div id="appointment_times" class="space-y-2 bg-blue-50 px-3 py-2 mr-[4.3rem] rounded-md border border-b-neutral-400">
                        <!-- AJAX response will populate this div -->
                    </div>
                </div>--}}

                <!-- Appointment Times Selection -->
                <div class="mb-4">
                    <label for="appointment_time" class="block text-sm font-medium mb-1">Schedule Times</label>
                    <select id="appointment_time" name="appointment_time" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500" required>
                        <!-- AJAX response will populate this dropdown -->
                    </select>
                </div>

                <!-- Reason -->
                <div class="mb-4 col-span-2">
                    <label for="reason" class="block text-sm font-medium mb-1">Reason</label>
                    <textarea id="reason" name="reason" class="form-textarea bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md" required></textarea>
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md" id="submit_btn">Add
                    Patient
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
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
<script>
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
    const addNewPatient = document.getElementById('addNewPatient');

    collapseNavbarBtn.addEventListener('click', function () {
        navbarContainer.classList.toggle('collapsed');
        if (navbarContainer.classList.contains('collapsed')) {
            navbarContainer.style.width = '80px';
            addNewPatient.style.marginLeft = '100px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M15 8A7 7 0 1 0 1 8a7 7 0 0 0 14 0ZM4.75 7.25a.75.75 0 0 0 0 1.5h4.69L8.22 9.97a.75.75 0 1 0 1.06 1.06l2.5-2.5a.75.75 0 0 0 0-1.06l-2.5-2.5a.75.75 0 0 0-1.06 1.06l1.22 1.22H4.75Z" clip-rule="evenodd" /></svg>';

            initializeTooltips();
        } else {
            navbarContainer.style.width = 'auto';
            addNewPatient.style.marginLeft = '175px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm10.25.75a.75.75 0 0 0 0-1.5H6.56l1.22-1.22a.75.75 0 0 0-1.06-1.06l-2.5 2.5a.75.75 0 0 0 0 1.06l2.5 2.5a.75.75 0 1 0 1.06-1.06L6.56 8.75h4.69Z" clip-rule="evenodd" /></svg>';

            removeTooltips();
        }
    });

    // Add New Patient Error Message
    document.addEventListener('DOMContentLoaded', function () {
        const errorMessage = '{{ session('add_patient_error') }}'

        if (errorMessage) {
            Command: toastr["error"](errorMessage, "Error")

            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        }
    });

    // AJAX Setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    // Fetch Available Days
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
    /*$(document).ready(function() {
        $('form').submit(function(event) {
            // event.preventDefault(); // Prevent default form submission

            let selectedDate = $('#appointment_date').val();
            let selectedTime = $('#appointment_time').val();
            let doctorId = $('#doctor_id').val();

            // Perform AJAX request to check if the appointment exists
            $.ajax({
                url: '{{--{{ route("check_appointment_existence") }}--}}',
                type: 'GET',
                data: {
                    appointment_date: selectedDate,
                    appointment_time: selectedTime,
                    doctor_id: doctorId
                },
                success: function(response) {
                    if (response.exists) {
                        event.preventDefault();
                        // Appointment already exists, show error message
                        $('#date_time_error').text('Appointment for selected date and time already exists.').removeClass('hidden');
                        return false; // Explicitly return false to prevent further submission
                    } else {
                        // Appointment does not exist, submit the form normally
                        $('#date_time_error').text('').addClass('hidden');
                    }
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                }
            });
        });
    });*/

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
    })

    // Find that patient is available or not
    $(document).ready(function() {
        $('#search_button').click(function() {
            let phoneNumber = $('#phone_search').val();

            // Perform AJAX request to fetch names associated with the mobile number
            $.ajax({
                url: '{{ route("search_phone_number") }}',
                type: 'GET',
                data: {
                    phone_number: phoneNumber
                },
                success: function(response) {
                    // Clear previous options in the dropdown
                    $('#id_dropdown').empty();

                    // Populate the dropdown with fetched names
                    if (response.ids.length > 0) {
                        response.ids.forEach(function(id) {
                            $('#id_dropdown').append($('<option>', {
                                value: id,
                                text: id
                            }));
                        });

                        // Manually trigger change event after populating the dropdown
                        $('#id_dropdown').trigger('change');
                    } else {
                        // If no names found, display a message
                        $('#id_dropdown').append($('<option>', {
                            value: '',
                            text: 'No record found'
                        }));
                    }
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                }
            });
        });

        // Fetch patient name when an ID is selected from the dropdown
        $('#id_dropdown').change(function() {
            let selectedId = $(this).val();

            // Perform AJAX request to fetch patient name
            $.ajax({
                url: '{{ route("fetch_patient_name") }}',
                type: 'GET',
                data: {
                    patient_id: selectedId
                },
                success: function(response) {
                    // Fill the patient name field with the fetched name
                    $('#patient_name').val(response.name);
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                }
            });
        });
    });

    // Initialize tooltips when the page loads
    window.addEventListener('load', function () {
        tippy('#search_button', {
            placement: 'top', // Set the placement to 'right'
            arrow: true // Ensure the arrow points towards the button
        });
    });

    // Go to appointment record
    $(document).ready(function() {
        $('#go_button').click(function() {
            // Check if the patient record ID field is empty
            let patientId = $('#id_dropdown').val();
            if (patientId) {
                // If not empty, construct the URL for the appointment record using the patient ID
                let url = '{{ route("receptionist_user.patient_record.appointment_record.show", ":patientId") }}';
                url = url.replace(':patientId', patientId);
                // Redirect to the appointment record page
                window.location.href = url;
            } else {
                // If the patient record ID field is empty, show an alert or handle the case accordingly
                alert('Please select a patient from the dropdown.');
            }
        });
    });
</script>

</body>
</html>

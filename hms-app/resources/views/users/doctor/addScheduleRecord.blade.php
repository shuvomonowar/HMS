<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Schedule</title>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="bg-white text-blue-900">

<!-- Header -->
@include('compulsory.header')

<!-- Navbar -->
<div class="mt-[6rem]">
    @include('users.doctor.navbar')
</div>

<div class="ml-[6.25rem] py-1 flex flex-wrap border-b-blue-600" id="addNewSchedule">
    <div class="w-[70rem] mt-4 p-10 rounded-md shadow-lg items-center overflow-y-auto max-h-[73vh] mx-auto bg-gray-200 border border-blue-200 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
        <div class="grid mb-[4rem]">
            <h1 class="text-2xl font-medium mb-1 text-center text-blue-500">Add New Schedule</h1>
            <hr class="border-opacity-50 border-white w-full mb-1 mt-3">
        </div>
        <form id="addScheduleForm" action="{{ route('doctor_user.add_schedule.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                {{--<label for="doctor_id" class="block text-sm font-medium mb-1">Doctor ID</label>--}}
                {{--<input type="number" id="doctor_id" name="doctor_id"
                       class="form-input bg-red-50 focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                       value="{{ $doctorID }}" required readonly>--}}
                <input type="hidden" id="doctor_id" name="doctor_id" value="{{ $doctorID }}" required>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="schedule_day" class="block text-sm font-medium mb-1">Schedule Day</label>
                    <select id="schedule_day" name="schedule_day" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500" required>
                        <option value="">Select Day</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="end_time" class="block text-sm font-medium mb-1">Start Time</label>
                    <input type="time" id="end_time" name="end_time"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md" required>
                </div>
                <div class="mb-4">
                    <label for="start_time" class="block text-sm font-medium mb-1">End Time</label>
                    <input type="time" id="start_time" name="start_time"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md" required>
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md" id="submit_btn">Add
                    Schedule
                </button>
            </div>
        </form>
    </div>
</div>
<!-- Footer -->
<div class="mt-[8.2rem] bg-gray-200">
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
    const addNewSchedule = document.getElementById('addNewSchedule');

    collapseNavbarBtn.addEventListener('click', function () {
        navbarContainer.classList.toggle('collapsed');
        if (navbarContainer.classList.contains('collapsed')) {
            navbarContainer.style.width = '80px';
            addNewSchedule.style.marginLeft = '100px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M15 8A7 7 0 1 0 1 8a7 7 0 0 0 14 0ZM4.75 7.25a.75.75 0 0 0 0 1.5h4.69L8.22 9.97a.75.75 0 1 0 1.06 1.06l2.5-2.5a.75.75 0 0 0 0-1.06l-2.5-2.5a.75.75 0 0 0-1.06 1.06l1.22 1.22H4.75Z" clip-rule="evenodd" /></svg>';

            initializeTooltips();
        } else {
            navbarContainer.style.width = 'auto';
            addNewSchedule.style.marginLeft = '175px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm10.25.75a.75.75 0 0 0 0-1.5H6.56l1.22-1.22a.75.75 0 0 0-1.06-1.06l-2.5 2.5a.75.75 0 0 0 0 1.06l2.5 2.5a.75.75 0 1 0 1.06-1.06L6.56 8.75h4.69Z" clip-rule="evenodd" /></svg>';

            removeTooltips();
        }
    });

    // Add New Schedule Error Message
    document.addEventListener('DOMContentLoaded', function () {
        const errorMessage = '{{ session('add_schedule_error') }}'

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

    // Find that doctor is available or not
    $(document).ready(function() {
        $('#search_button').click(function() {
            let doctorName = $('#doctor_name').val();

            // Perform AJAX request to fetch names associated with the mobile number
            $.ajax({
                url: '{{ route("system_admin.search_doctor_name") }}',
                type: 'GET',
                data: {
                    doctor_name: doctorName
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

        // Fetch doctor specialization when an ID is selected from the dropdown
        $('#id_dropdown').change(function() {
            let selectedId = $(this).val();

            // Perform AJAX request to fetch doctor specialization
            $.ajax({
                url: '{{ route("system_admin.fetch_doctor_specialization") }}',
                type: 'GET',
                data: {
                    doctor_id: selectedId
                },
                success: function(response) {
                    // Fill the doctor specialization field from the fetched id
                    $('#doctor_specialization').val(response.specialization);
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

    // Go to doctor record
    $(document).ready(function() {
        $('#go_button').click(function() {
            // Check if the doctor record ID field is empty
            let doctorId = $('#id_dropdown').val();
            if (doctorId) {
                // Redirect to the doctor record page
                window.location.href = '{{ route("system_admin.doctor_record") }}';
            } else {
                // If the doctor record ID field is empty, show an alert or handle the case accordingly
                alert('Please select a doctor from the dropdown.');
            }
        });
    });
</script>

</body>
</html>

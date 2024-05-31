<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Doctor</title>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="bg-white text-blue-900">

<!-- Header -->
@include('compulsory.header')

<!-- Navbar -->
<div class="mt-[6rem]">
    @include('admin.system.navbar')
</div>

<div class="ml-[6.25rem] py-1 flex flex-wrap border-b-blue-600" id="addNewDoctor">
    <div class="w-[70rem] mt-4 p-10 rounded-md shadow-lg items-center overflow-y-auto max-h-[73vh] mx-auto bg-gray-200 border border-blue-200 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
        <!-- Add search box, search button, and name dropdown -->
        <div class="bg-gray-300 rounded-2xl flex flex-col py-6">
            <div class="grid">
                <h1 class="text-2xl font-medium mb-2 text-center text-blue-500">Search Existing Doctor</h1>
                <hr class="border-opacity-50 border-white w-full mb-6">
            </div>
            <div class="flex flex-row items-center ml-[2rem]">
                <div class="relative flex ml-[15rem]">
                    <input type="text" id="doctor_name" class="form-input focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-blue-50 focus:outline-none focus:border-blue-500" pattern="[0-9]{11}" title="Please enter a valid 11-digit phone number" placeholder="Doctor Name..." required>
                    <button type="button" id="search_button" class="text-white px-4 py-2 ml-3 rounded-md bg-blue-400 hover:bg-blue-500 transition duration-300 ease-in-out transform hover:scale-110" data-tippy-content="Find Existing Doctor">
                        <img src="{{ asset('images/patient/search_white.png') }}" alt="Search Icon" class="w-6 h-6">
                    </button>
                </div>
            </div>
            <div class="flex flex-row items-center ml-[4.5rem] border border-gray-400 mt-4 mr-[5rem] rounded-lg">
                <div class="flex flex-row items-center mb-4 mt-2 ml-[1.7rem]">
                    <label for="id_dropdown" class="block text-md font-medium mb-1 mr-2 mt-2">Doctor ID</label>
                    <select id="id_dropdown" class="form-select focus:bg-white rounded-md px-3 py-2 border border-b-neutral-400 focus:outline-none focus:border-blue-500 mt-2 w-[15rem]" required>
                        <!-- Dropdown options will be populated dynamically -->
                    </select>
                </div>
                <div class="flex flex-row items-center mb-4 mt-4 ml-6">
                    <label for="doctor_specialization" class="block text-sm font-medium mb-1 mr-2">Specialization</label>
                    <input type="text" id="doctor_specialization" name="doctor_specialization"
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
            <h1 class="text-2xl font-medium mb-1 text-center text-blue-500">Add New Doctor</h1>
            <hr class="border-opacity-50 border-white w-full mb-1 mt-3">
        </div>
        <form id="addDoctorForm" action="{{ route("system_admin.add_doctor.store") }}" method="POST">
            @csrf
            <div class="grid">
                <h2 class="text-blue-800 mt-9 mb-2">Doctor General Information</h2>
                <hr class="border-opacity-50 border-blue-600 w-full mb-6">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium mb-1">Doctor Name</label>
                    <input type="text" id="name" name="name"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md" required>
                </div>
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium mb-1">User Name</label>
                    <input type="text" id="username" name="username"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md" required>
                </div>
                <div class="mb-4">
                    <label for="qualification" class="block text-sm font-medium mb-1">Qualification</label>
                    <input type="text" id="qualification" name="qualification"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md" required>
                </div>
                <div class="mb-4">
                    <label for="specialization" class="block text-sm font-medium mb-1">Specialization</label>
                    <select id="specialization" name="specialization" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500" required>
                        <option value="">Select Specialization</option>
                        <option value="Pediatrics">Pediatrics</option>
                        <option value="Cardiology">Cardiology</option>
                        <option value="Orthopedics">Orthopedics</option>
                        <option value="Neurology">Neurology</option>
                        <option value="Medicine">Medicine</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="phone_number" class="block text-sm font-medium mb-1">Phone</label>
                    <input type="tel" id="phone_number" name="phone_number"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           pattern="[0-9]{11}" title="Please enter a valid 11-digit phone number" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" id="email" name="email"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium mb-1">Password</label>
                    <input type="password" id="password" name="password"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           minlength="8" maxlength="16" required>
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md" id="submit_btn">Add
                    Doctor
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
    const addNewDoctor = document.getElementById('addNewDoctor');

    collapseNavbarBtn.addEventListener('click', function () {
        navbarContainer.classList.toggle('collapsed');
        if (navbarContainer.classList.contains('collapsed')) {
            navbarContainer.style.width = '80px';
            addNewDoctor.style.marginLeft = '100px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M15 8A7 7 0 1 0 1 8a7 7 0 0 0 14 0ZM4.75 7.25a.75.75 0 0 0 0 1.5h4.69L8.22 9.97a.75.75 0 1 0 1.06 1.06l2.5-2.5a.75.75 0 0 0 0-1.06l-2.5-2.5a.75.75 0 0 0-1.06 1.06l1.22 1.22H4.75Z" clip-rule="evenodd" /></svg>';

            initializeTooltips();
        } else {
            navbarContainer.style.width = 'auto';
            addNewDoctor.style.marginLeft = '175px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm10.25.75a.75.75 0 0 0 0-1.5H6.56l1.22-1.22a.75.75 0 0 0-1.06-1.06l-2.5 2.5a.75.75 0 0 0 0 1.06l2.5 2.5a.75.75 0 1 0 1.06-1.06L6.56 8.75h4.69Z" clip-rule="evenodd" /></svg>';

            removeTooltips();
        }
    });

    // Add New Doctor Error Message
    document.addEventListener('DOMContentLoaded', function () {
        const errorMessage = '{{ session('add_doctor_error') }}'

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Doctor Appointment Record</title>
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
    @vite('resources/css/app.css')
    <style>
        @keyframes slide-up {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>

<!-- Header -->
@include('compulsory.header')

<div class="flex flex-1">
    <!-- Navbar -->
    <div class="mt-[6rem]">
        @include('users.receptionist.navbar')
    </div>

    <!-- Content Area -->
    <div class="mt-[5rem] ml-[9.4rem] py-1 flex-row flex-wrap" id="doctorAppointmentRecordContainer">
        <!-- Search Navbar -->
        <div class="flex items-center bg-white p-2 mb-3 gap-4 border border-blue-100 rounded-md py-2 mr-[4rem]">
            <div>
                <select id="appointment_doctor_id" class="border border-gray-300 rounded-lg py-1 px-4 focus:outline-none focus:border-blue-500" required>
                    <option value="">Select Doctor</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <input type="date" id="appointment_doctor_date" class="border border-gray-300 rounded-lg py-1 px-4 focus:outline-none focus:border-blue-500" required>
            </div>
            <button id="searchButton" class="bg-blue-200 text-white px-4 py-1 rounded-md flex transition duration-300 ease-in-out transform hover:scale-110" data-tippy-content="Find Appointment">
                <img src="{{ asset('images/patient/find.png') }}" alt="Search Icon" class="w-6 h-6">
            </button>
        </div>
        <!-- Doctor Appointment Records Content -->
        <div
            class="h-[32.3rem] flex-1 bg-white rounded-lg shadow-md table-container border border-blue-100 mr-[3.9rem]">
            <div class="overflow-x-scroll overflow-y-scroll scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100 max-h-full">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <!-- Table Headers -->
                    <thead class="table-header sticky top-0">
                    <caption class="sticky top-0 bg-blue-400 py-0.5 text-lg text-white">Doctor Appointment Record</caption>
                    <tr>
                        <!-- Add your table headers here -->
                        <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            SL
                        </th>
                        <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Doctor ID
                        </th>
                        <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Doctor Name
                        </th>
                        <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Doctor Specialization
                        </th>
                        <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Patient ID
                        </th>
                        <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Patient Name
                        </th>
                        <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Appointment Date
                        </th>
                        <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Appointment Day
                        </th>
                        <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Appointment Time
                        </th>
                        <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Appointment Serial
                        </th>
                        <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Assigned Date-Time
                        </th>
                    </tr>
                    </thead>
                    <!-- Table Body -->
                    <tbody id="doctorAppointmentRecordTable" class="bg-white divide-y divide-gray-200">
                    @include('users.receptionist.doctorAppointmentRecordTable', ['doctorAppointmentRecords' => $doctorAppointmentRecords, 'doctors' => $doctors])
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="mt-[1.4rem] bg-gray-200">
    @include('compulsory.footer')
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteConfirmationModal"
     class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="mb-4">
            <p class="text-lg font-semibold">Are you sure you want to delete this appointment record?</p>
        </div>
        <div class="flex justify-end">
            <button id="cancelDeleteBtn"
                    class="bg-gray-400 hover:bg-gray-500 text-white py-2 px-4 rounded mr-2 focus:outline-none">Cancel
            </button>
            <button id="confirmDeleteBtn"
                    class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded focus:outline-none">Delete
            </button>
        </div>
    </div>
</div>

<!-- Modal for doctor appointment record -->
<div id="searchResultsModal"
     class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="w-[80rem] ml-[2rem] overflow-y-auto max-h-[73vh] mx-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
            <div class="mt-5">
        <span id="closeModalBtn" class="cursor-pointer inline-block transition-transform duration-300 transform-gpu hover:rotate-90">
            <img src="{{ asset('images/appointment/close.png') }}" alt="Close Icon" class="w-7 h-7">
        </span>
            </div>
            <div class="grid mb-7">
                <h1 class="text-2xl font-medium text-center mb-4 text-blue-500">Appointment List</h1>
                <hr class="border-opacity-50 border-blue-600 mb-6 mr-[3.5rem]">
            </div>
            <div
                class="h-[35rem] flex-1 bg-white rounded-lg shadow-md overflow-x-auto table-container border border-blue-100 mr-[3.9rem] overflow-y-scroll scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <!-- Table Headers -->
                    <thead class="table-header">
                    <tr>
                        <!-- Add your table headers here -->
                        <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            SL
                        </th>
                        <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Patient ID
                        </th>
                        <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Patient Name
                        </th>
                        <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Doctor ID
                        </th>
                        <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Doctor Name
                        </th>
                        <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Appointment Date
                        </th>
                        <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Appointment Day
                        </th>
                        <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Appointment Time
                        </th>
                        <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Appointment Serial
                        </th>
                        <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Reason
                        </th>
                        <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Assigned Date-Time
                        </th>
                    </tr>
                    </thead>
                    <!-- Table Body -->
                    <tbody id="doctorAppointmentRecordTables" class="bg-white divide-y divide-gray-200">
                    {{--@include('users.receptionist.showDoctorAppointmentRecordTable', ['doctorAppointmentRecord' => $doctorAppointmentRecord])--}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
<script>
    const pageContent = document.getElementById('doctorAppointmentRecordContainer');
    const confirmationModal = document.getElementById('deleteConfirmationModal');
    const confirmBtn = document.getElementById('confirmDeleteBtn');
    const cancelBtn = document.getElementById('cancelDeleteBtn');

    // AJAX Setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
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
    const patientAppointmentRecordContainer = document.getElementById('doctorAppointmentRecordContainer');

    collapseNavbarBtn.addEventListener('click', function () {
        navbarContainer.classList.toggle('collapsed');
        if (navbarContainer.classList.contains('collapsed')) {
            navbarContainer.style.width = '80px';
            patientAppointmentRecordContainer.style.marginLeft = '150px';
            patientAppointmentRecordContainer.style.marginRight = '1px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M15 8A7 7 0 1 0 1 8a7 7 0 0 0 14 0ZM4.75 7.25a.75.75 0 0 0 0 1.5h4.69L8.22 9.97a.75.75 0 1 0 1.06 1.06l2.5-2.5a.75.75 0 0 0 0-1.06l-2.5-2.5a.75.75 0 0 0-1.06 1.06l1.22 1.22H4.75Z" clip-rule="evenodd" /></svg>';

            initializeTooltips();
        } else {
            navbarContainer.style.width = 'auto';
            patientAppointmentRecordContainer.style.marginLeft = '245px';
            patientAppointmentRecordContainer.style.marginRight = '1px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm10.25.75a.75.75 0 0 0 0-1.5H6.56l1.22-1.22a.75.75 0 0 0-1.06-1.06l-2.5 2.5a.75.75 0 0 0 0 1.06l2.5 2.5a.75.75 0 1 0 1.06-1.06L6.56 8.75h4.69Z" clip-rule="evenodd" /></svg>';

            removeTooltips();
        }
    });

    // Initialize tooltips when the page loads
    window.addEventListener('load', function () {
        tippy('#searchButton', {
            placement: 'top', // Set the placement to 'right'
            arrow: true // Ensure the arrow points towards the button
        });
    });

    // Show Doctor Appointment Record Modal Expand-Collapsed
    const searchAppointmentBtn = document.getElementById('searchButton');
    const searchAppointmentModal = document.getElementById('searchResultsModal');
    const closeModalBtn = document.getElementById('closeModalBtn');

    searchAppointmentBtn.addEventListener('click', () => {
        const doctorID = document.getElementById('appointment_doctor_id').value.trim();
        const appointmentDate = document.getElementById('appointment_doctor_date').value.trim();

        // Check if the fields are not empty
        if (doctorID !== '' && appointmentDate !== '') {
            // If fields are not empty, show the modal
            searchAppointmentModal.classList.remove('hidden');
        } else {
            // If fields are empty, show a message or perform other actions
            alert('Please enter both doctor name and appointment date.');
        }
    });

    closeModalBtn.addEventListener('click', () => {
        searchAppointmentModal.classList.add('hidden');
    });


    $(document).ready(function() {
        $('#searchButton').click(function() {
            // Get the input values
            let doctorId = $('#appointment_doctor_id').val();
            let appointmentDate = $('#appointment_doctor_date').val();

            // Make AJAX request to search for appointments
            $.ajax({
                url: "{{ route('doctor_record.search_appointment') }}",
                type: 'GET',
                data: {
                    doctor_id: doctorId,
                    appointment_date: appointmentDate
                },
                success: function(response) {
                    // Update UI with search results
                    $('#doctorAppointmentRecordTables').html(response);
                },
                error: function(error) {
                    console.error('Error:', error);
                    // Handle error
                }
            });
        });
    });
</script>

</body>
</html>

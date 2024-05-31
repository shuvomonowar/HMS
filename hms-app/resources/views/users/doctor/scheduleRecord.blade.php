<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Schedule Record</title>
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
        @include('users.doctor.navbar')
    </div>

    <!-- Content Area -->
    <div class="mt-[6rem] ml-[9rem] mr-[2rem] w-full py-1 flex flex-2 gap-5" id="scheduleRecordContainer">
        <!-- Patient Records Content -->
        <div class="grow basis-11/12">
            <div class="h-[35rem] flex-1 bg-white rounded-lg shadow-md table-container border border-blue-100">
                <div class="overflow-x-scroll overflow-y-scroll scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100 max-h-full">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <!-- Table Headers -->
                        <thead class="table-header sticky top-0">
                        <caption class="sticky top-0 bg-blue-400 py-0.5 text-lg text-white">Schedule Record</caption>
                        <tr>
                            <!-- Add your table headers here -->
                            <th class="px-4 py-2 bg-gray-100 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                Actions
                            </th>
                            <th class="px-4 py-2 bg-gray-100 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                SL
                            </th>
                            <th class="px-4 py-2 bg-gray-100 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                Schedule Day
                            </th>
                            <th class="px-4 py-2 bg-gray-100 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                Start Time
                            </th>
                            <th class="px-4 py-2 bg-gray-100 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                End Time
                            </th>
                        </tr>
                        </thead>
                        <!-- Table Body -->
                        <tbody id="scheduleRecordTable" class="bg-white divide-y divide-gray-200">
                        @include('users.doctor.scheduleRecordTable', ['scheduleRecords' => $scheduleRecords])
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Secondary Navbar -->
        <div class="grow basis-1/12">
            <nav class="h-[35rem] flex flex-col gap-5 mb-3 items-center px-4 py-2 border border-blue-100 rounded-lg">
                <div class="flex items-center mt-[1rem]">
                    <div class="relative flex items-center">
                        <label>
                            <input id="searchInput" name="searchInput" type="text"
                                   class="border border-gray-300 rounded-lg py-1 px-4 focus:outline-none focus:border-blue-500"
                                   placeholder="Search Schedule...">
                        </label>
                        <svg class="absolute right-0 mr-4 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"/>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <a href="{{ route('doctor_user.add_schedule', $doctorID) }}">
                        <button type="button"
                                class="inline-flex items-center justify-center bg-gray-100 border border-gray-300 rounded-lg py-1 px-3 transition duration-300 hover:bg-blue-100 hover:ring-1 hover:ring-blue-300">
                            <img src="{{ asset('images/schedule/schedule_add.png') }}" alt="View Icon" class="w-6 h-6 mr-2">
                            <span class="text-lg text-blue-400">Add New Schedule</span>
                        </button>
                    </a>
                </div>
            </nav>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="mt-[1.1rem] bg-gray-200">
    @include('compulsory.footer')
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteConfirmationModal"
     class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="mb-4">
            <p class="text-lg font-semibold">Are you sure you want to delete this schedule?</p>
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
<script>
    const pageContent = document.getElementById('doctorRecordContainer');
    const confirmationModal = document.getElementById('deleteConfirmationModal');
    const confirmBtn = document.getElementById('confirmDeleteBtn');
    const cancelBtn = document.getElementById('cancelDeleteBtn');

    // AJAX Setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Delete Patient Record
    function deleteSchedule(scheduleId) {
        confirmationModal.classList.remove('hidden');

        function confirmDelete() {
            $.ajax({
                url: `/doctor_user/schedule_record/${scheduleId}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.success) {
                        $(`#scheduleRecordTable tr[data-id='${scheduleId}']`).remove();

                        Command: toastr["success"]("The schedule is deleted successfully.", "Success")

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
                    } else {
                        Command: toastr["error"]("Something went wrong to delete this schedule record.", "Error")

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
                },
                error: function (error) {
                    console.error('Error:', error);
                    Command: toastr["error"]("Something went wrong to delete this schedule record.", "Error")

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
                },
                complete: function () {
                    confirmBtn.removeEventListener('click', confirmDelete);
                    cancelBtn.removeEventListener('click', cancelDelete);

                    confirmationModal.classList.add('hidden');
                }
            });
        }

        function cancelDelete() {
            confirmBtn.removeEventListener('click', confirmDelete);
            cancelBtn.removeEventListener('click', cancelDelete);

            confirmationModal.classList.add('hidden');
        }

        confirmBtn.addEventListener('click', confirmDelete);
        cancelBtn.addEventListener('click', cancelDelete);
    }

    // Search Schedule Record
    $(document).ready(function () {
        $(document).on('keyup', '#searchInput', function (e) {
            e.preventDefault();
            let search_string = $(this).val();
            $.ajax({
                url: "{{ route('doctor_user.schedule_record.search', $doctorID) }}",
                method: 'GET',
                data: {search_string: search_string},
                success: function (res) {
                    $('#scheduleRecordTable').html(res);
                }
            });
        });
    });

    // Add New Patient Success Message
    document.addEventListener('DOMContentLoaded', function () {
        const successMessage = '{{ session('add_patient_success') }}'; // Access flash message
        const errorMessage = '{{ session('add_patient_error') }}'

        if (successMessage) {
            Command: toastr["success"](successMessage, "Success")

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

    // Edit Schedule Record Success Message
    document.addEventListener('DOMContentLoaded', function () {
        const successMessage = '{{ session('edit_schedule_success') }}'; // Access flash message

        if (successMessage) {
            Command: toastr["success"](successMessage, "Success")

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
    const scheduleRecordContainer = document.getElementById('scheduleRecordContainer');

    collapseNavbarBtn.addEventListener('click', function () {
        navbarContainer.classList.toggle('collapsed');

        if (navbarContainer.classList.contains('collapsed')) {
            // Navbar is collapsed, initialize tooltips
            navbarContainer.style.width = '80px';
            scheduleRecordContainer.style.marginLeft = '145px';
            scheduleRecordContainer.style.marginRight = '30px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M15 8A7 7 0 1 0 1 8a7 7 0 0 0 14 0ZM4.75 7.25a.75.75 0 0 0 0 1.5h4.69L8.22 9.97a.75.75 0 1 0 1.06 1.06l2.5-2.5a.75.75 0 0 0 0-1.06l-2.5-2.5a.75.75 0 0 0-1.06 1.06l1.22 1.22H4.75Z" clip-rule="evenodd" /></svg>';

            // Initialize tooltips
            initializeTooltips();
        } else {
            // Navbar is expanded, remove tooltips
            navbarContainer.style.width = 'auto';
            scheduleRecordContainer.style.marginLeft = '270px';
            scheduleRecordContainer.style.marginRight = '35px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm10.25.75a.75.75 0 0 0 0-1.5H6.56l1.22-1.22a.75.75 0 0 0-1.06-1.06l-2.5 2.5a.75.75 0 0 0 0 1.06l2.5 2.5a.75.75 0 1 0 1.06-1.06L6.56 8.75h4.69Z" clip-rule="evenodd" /></svg>';

            // Remove tooltips
            removeTooltips();
        }
    });
</script>

</body>
</html>

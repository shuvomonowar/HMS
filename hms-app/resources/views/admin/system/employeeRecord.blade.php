<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Employee Record</title>
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
        @include('admin.system.navbar')
    </div>

    <!-- Content Area -->
    <div class="mt-[5rem] ml-[9.4rem] py-1 flex flex-wrap border-b-blue-700" id="employeeRecordContainer">

        <!-- Secondary Navbar -->
        <nav class="w-[82.7rem] flex flex-2 gap-7 mb-3 items-center px-4 py-1.5 border border-blue-100 rounded-lg">
            <div class="flex items-center">
                <div class="relative flex items-center">
                    <label>
                        <input id="searchInput" name="searchInput" type="text"
                               class="border border-gray-300 rounded-lg py-1 px-4 focus:outline-none focus:border-blue-500"
                               placeholder="Search Employee...">
                    </label>
                    <svg class="absolute right-0 mr-4 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                </div>
            </div>
            <div>
                <a href="{{ route('system_admin.add_employee') }}">
                    <button type="button"
                            class="inline-flex items-center justify-center bg-gray-100 rounded-lg py-1 px-3 transition duration-300 hover:bg-blue-100 hover:ring-1 hover:ring-blue-300">
                        <img src="{{ asset('images/employee/add_employee.png') }}" alt="View Icon" class="w-6 h-6 mr-2">
                        <span class="text-lg text-blue-400">Add New Employee</span>
                    </button>
                </a>
            </div>
        </nav>

        <!-- Employee Records Content -->
        <div class="flex-1">
            <div class="bg-blue-400 py-0.5 text-lg text-white items-center w-[82.7rem] pl-[38rem]">Employee Record</div>
            <div class="h-[30.5rem] w-[82.7rem] flex-1 bg-white rounded-lg shadow-md table-container border border-blue-100">
                <div class="overflow-x-scroll overflow-y-scroll scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100 max-h-full">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <!-- Table Headers -->
                        <thead class="table-header sticky top-0">
                        <tr>
                            <!-- Add your table headers here -->
                            <th class="px-4 py-2 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                            <th class="px-4 py-2 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                SL
                            </th>
                            {{--<th class="px-4 py-2 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>--}}
                            <th class="px-4 py-2 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                First Name
                            </th>
                            <th class="px-4 py-2 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Last Name
                            </th>
                            <th class="px-4 py-2 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Username
                            </th>
                            <th class="px-4 py-2 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Department
                            </th>
                            <th class="px-4 py-2 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Salary
                            </th>
                            <th class="px-4 py-2 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Hire Date
                            </th>
                            <th class="px-4 py-2 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Designation
                            </th>
                            <th class="px-4 py-2 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Employment Type
                            </th>
                            <th class="px-4 py-2 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Gender
                            </th>
                            <th class="px-4 py-2 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Birth Date
                            </th>
                            <th class="px-4 py-2 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Address
                            </th>
                            <th class="px-4 py-2 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                NID
                            </th>
                            <th class="px-4 py-2 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Phone
                            </th>
                            <th class="px-4 py-2 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th class="px-4 py-2 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Password
                            </th>
                            <th class="px-4 py-2 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Created On</th>
                        </tr>
                        </thead>
                        <!-- Table Body -->
                        <tbody id="employeeRecordTable" class="bg-white divide-y divide-gray-200">
                        @include('admin.system.employeeRecordTable', ['employeeRecords' => $employeeRecords])
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="mt-[1.5rem] bg-gray-200">
    @include('compulsory.footer')
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteConfirmationModal"
     class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="mb-4">
            <p class="text-lg font-semibold">Are you sure you want to delete this employee?</p>
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
    const addEmployeeBtn = document.getElementById('addEmployeeBtn');
    const addEmployeeForm = document.getElementById('addEmployeeForm');
    const closeAddEmployeeFormBtn = document.getElementById('closeAddEmployeeForm');
    const pageContent = document.getElementById('employeeRecordContainer');
    const confirmationModal = document.getElementById('deleteConfirmationModal');
    const confirmBtn = document.getElementById('confirmDeleteBtn');
    const cancelBtn = document.getElementById('cancelDeleteBtn');

    // AJAX Setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Delete Employee Record
    function deleteEmployee(employeeId) {
        confirmationModal.classList.remove('hidden');

        function confirmDelete() {
            $.ajax({
                url: `/system_admin/employee_record/${employeeId}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.success) {
                        $(`#employeeRecordTable tr[data-id='${employeeId}']`).remove();

                        Command: toastr["success"]("The record is deleted successfully.", "Success")

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
                        Command: toastr["error"]("Something went wrong to delete this record.", "Error")

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
                    Command: toastr["error"]("Something went wrong to delete this record.", "Error")

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

    // Search Employee Record
    $(document).ready(function () {
        $(document).on('keyup', '#searchInput', function (e) {
            e.preventDefault();
            let search_string = $(this).val();
            $.ajax({
                url: "{{ route('system_admin.employee_record.search') }}",
                method: 'GET',
                data: {search_string: search_string},
                success: function (res) {
                    $('#employeeRecordTable').html(res);
                }
            });
        });
    });

    // Add New Employee Success Message
    document.addEventListener('DOMContentLoaded', function () {
        const successMessage = '{{ session('add_employee_success') }}'; // Access flash message

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

    // Edit Employee Record Success Message
    document.addEventListener('DOMContentLoaded', function () {
        const successMessage = '{{ session('edit_employee_success') }}'; // Access flash message

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
    // const collapseIcon = document.getElementById('collapseIcon');
    const employeeRecordContainer = document.getElementById('employeeRecordContainer');

    collapseNavbarBtn.addEventListener('click', function () {
        navbarContainer.classList.toggle('collapsed');
        if (navbarContainer.classList.contains('collapsed')) {
            navbarContainer.style.width = '80px';
            employeeRecordContainer.style.marginLeft = '145px';
            employeeRecordContainer.style.marginRight = '1px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M15 8A7 7 0 1 0 1 8a7 7 0 0 0 14 0ZM4.75 7.25a.75.75 0 0 0 0 1.5h4.69L8.22 9.97a.75.75 0 1 0 1.06 1.06l2.5-2.5a.75.75 0 0 0 0-1.06l-2.5-2.5a.75.75 0 0 0-1.06 1.06l1.22 1.22H4.75Z" clip-rule="evenodd" /></svg>';

            // Initialize tooltips
            initializeTooltips();
        } else {
            navbarContainer.style.width = '145px';
            employeeRecordContainer.style.marginLeft = '180px';
            employeeRecordContainer.style.marginRight = '4px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm10.25.75a.75.75 0 0 0 0-1.5H6.56l1.22-1.22a.75.75 0 0 0-1.06-1.06l-2.5 2.5a.75.75 0 0 0 0 1.06l2.5 2.5a.75.75 0 1 0 1.06-1.06L6.56 8.75h4.69Z" clip-rule="evenodd" /></svg>';

            // Remove tooltips
            removeTooltips();
        }
    });
</script>

</body>
</html>

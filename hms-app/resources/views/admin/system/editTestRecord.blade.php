<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient Test Record</title>
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

<div class="ml-[6.25rem] py-1 flex flex-wrap border-b-blue-600" id="editPatientAppointment">
    <div class="w-[70rem] mt-4 p-10 rounded-md shadow-lg items-center overflow-y-auto max-h-[73vh] mx-auto bg-gray-200 border border-blue-200 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
        <div class="grid mb-7">
            <h1 class="text-2xl font-medium mb-7 text-center text-blue-500">Edit Test Record</h1>
            <hr class="border-opacity-50 border-blue-600 w-full mb-6">
        </div>
        <form action="{{ route('system_admin.patient_record.test_record.update_test.update', $patientTestId) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                <div class="mb-4">
                    <label for="patient_test_id" class="block text-sm font-medium mb-1">Test Group ID</label>
                    <input type="text" id="patient_test_id" name="patient_test_id"
                           class="form-input bg-red-50 focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           value="{{ $patientTestRecord->patient_test_id }}" required readonly>
                </div>
                <fieldset class="border border-blue-400 p-3 rounded-lg mr-4">
                    <legend class="text-base font-medium text-blue-600 mb-2">Test Record 1</legend>
                    <div class="grid grid-cols-2">
                        <div class="mb-4">
                            <label for="test_category_1" class="block text-sm font-medium mb-1">Test Category</label>
                            <select id="test_category_1" name="test_category_1" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-blue-50 focus:outline-none focus:border-blue-500" required>
                                <!-- AJAX response will populate this dropdown -->
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="test_name_1" class="block text-sm font-medium mb-1">Test Name</label>
                            <select id="test_name_1" name="test_name_1" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-blue-50 focus:outline-none focus:border-blue-500" required>
                                <!-- AJAX response will populate this dropdown -->
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="test_cost_1" class="block text-sm font-medium mb-1">Test Cost</label>
                            <input type="number" id="test_cost_1" name="test_cost_1" class="form-input focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-blue-50 focus:outline-none focus:border-blue-500" min="0" required>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="border border-blue-400 p-3 rounded-lg mr-4">
                    <legend class="text-base font-medium text-blue-600 mb-2">Test Record 2</legend>
                    <div class="grid grid-cols-2">
                        <div class="mb-4">
                            <label for="test_category_2" class="block text-sm font-medium mb-1">Test Category</label>
                            <select id="test_category_2" name="test_category_2" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-blue-50 focus:outline-none focus:border-blue-500">
                                <!-- AJAX response will populate this dropdown -->
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="test_name_2" class="block text-sm font-medium mb-1">Test Name</label>
                            <select id="test_name_2" name="test_name_2" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-blue-50 focus:outline-none focus:border-blue-500">
                                <!-- AJAX response will populate this dropdown -->
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="test_cost_2" class="block text-sm font-medium mb-1">Test Cost</label>
                            <input type="number" id="test_cost_2" name="test_cost_2" class="form-input focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-blue-50 focus:outline-none focus:border-blue-500" min="0">
                        </div>
                    </div>
                </fieldset>

                <fieldset class="border border-blue-400 p-3 rounded-lg mr-4">
                    <legend class="text-base font-medium text-blue-600 mb-2">Test Record 3</legend>
                    <div class="grid grid-cols-2">
                        <div class="mb-4">
                            <label for="test_category_3" class="block text-sm font-medium mb-1">Test Category</label>
                            <select id="test_category_3" name="test_category_3" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-blue-50 focus:outline-none focus:border-blue-500">
                                <!-- AJAX response will populate this dropdown -->
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="test_name_3" class="block text-sm font-medium mb-1">Test Name</label>
                            <select id="test_name_3" name="test_name_3" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-blue-50 focus:outline-none focus:border-blue-500">
                                <!-- AJAX response will populate this dropdown -->
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="test_cost_3" class="block text-sm font-medium mb-1">Test Cost</label>
                            <input type="number" id="test_cost_3" name="test_cost_3" class="form-input focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-blue-50 focus:outline-none focus:border-blue-500" min="0">
                        </div>
                    </div>
                </fieldset>

                <fieldset class="border border-blue-400 p-3 rounded-lg mr-4">
                    <legend class="text-base font-medium text-blue-600 mb-2">Test Record 4</legend>
                    <div class="grid grid-cols-2">
                        <div class="mb-4">
                            <label for="test_category_4" class="block text-sm font-medium mb-1">Test Category</label>
                            <select id="test_category_4" name="test_category_4" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-blue-50 focus:outline-none focus:border-blue-500">
                                <!-- AJAX response will populate this dropdown -->
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="test_name_4" class="block text-sm font-medium mb-1">Test Name</label>
                            <select id="test_name_4" name="test_name_4" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-blue-50 focus:outline-none focus:border-blue-500">
                                <!-- AJAX response will populate this dropdown -->
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="test_cost_4" class="block text-sm font-medium mb-1">Test Cost</label>
                            <input type="number" id="test_cost_4" name="test_cost_4" class="form-input focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-blue-50 focus:outline-none focus:border-blue-500" min="0">
                        </div>
                    </div>
                </fieldset>

                <fieldset class="border border-blue-400 p-3 rounded-lg mr-4">
                    <legend class="text-base font-medium text-blue-600 mb-2">Test Record 5</legend>
                    <div class="grid grid-cols-2">
                        <div class="mb-4">
                            <label for="test_category_5" class="block text-sm font-medium mb-1">Test Category</label>
                            <select id="test_category_5" name="test_category_5" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-blue-50 focus:outline-none focus:border-blue-500">
                                <!-- AJAX response will populate this dropdown -->
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="test_name_5" class="block text-sm font-medium mb-1">Test Name</label>
                            <select id="test_name_5" name="test_name_5" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-blue-50 focus:outline-none focus:border-blue-500">
                                <!-- AJAX response will populate this dropdown -->
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="test_cost_5" class="block text-sm font-medium mb-1">Test Cost</label>
                            <input type="number" id="test_cost_5" name="test_cost_5" class="form-input focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-blue-50 focus:outline-none focus:border-blue-500" min="0">
                        </div>
                    </div>
                </fieldset>

                <div class="mb-4">
                    <label for="delivery_date" class="block text-sm font-medium mb-1">Delivery Date</label>
                    <input type="date" id="delivery_date" name="delivery_date" class="form-input focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md border border-b-neutral-400 bg-blue-50 focus:outline-none focus:border-blue-500" value="{{ $patientTestRecord->test_delivery_date }}" required>
                </div>
                <div class="mb-4">
                    <label for="test_status" class="block text-sm font-medium mb-1">Test Status</label>
                    <select id="test_status" name="test_status" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-blue-50 focus:outline-none focus:border-blue-500" required>
                        <option value="">Select Status</option>
                        <option value="Payment Completed">Payment Completed</option>
                        <option value="Test completed">Test Completed</option>
                        <option value="Processing Test Data">Processing Test Data</option>
                        <option value="Report Ready to Deliver">Report Ready to Deliver</option>
                    </select>
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md" id="submit_btn">Update Test Record
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

    // Fetch Available Test Category
    $(document).ready(function() {
        $.ajax({
            url: '{{ route("system_admin.fetch_available_test_categories") }}',
            type: 'GET',
            success: function(response) {
                $('#test_category_1').html(response);

                // Decode the JSON-encoded test_category array
                let testCategories = {!! json_encode($patientTestRecord->test_category) !!};

                // Select the first element of the testCategories array
                let selectedCategory = testCategories.length > 0 ? testCategories[0] : '';

                // Iterate over each category option and set the selected option
                $('#test_category_1').val(selectedCategory);
                $('#test_category_1').trigger('change');
            },
            error: function(xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    // Fetch Available Test Name
    $('#test_category_1').change(function () {
        let testCategory = $(this).val();

        $.ajax({
            url: '{{ route("system_admin.fetch_available_test_names") }}',
            type: 'GET',
            data: {
                test_category: testCategory
            },
            success: function (response) {
                $('#test_name_1').html(response);
                let testNames = {!! json_encode($patientTestRecord->test_name) !!};
                let selectedName = testNames.length > 0 ? testNames[0] : '';
                $('#test_name_1').val(selectedName);
                $('#test_name_1').trigger('change');
            },
            error: function (xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    // Update test cost based on selected test name
    $('#test_name_1').change(function () {
        let testName = $(this).val();

        $.ajax({
            url: '{{ route("system_admin.fetch_test_cost") }}',
            type: 'GET',
            data: {
                test_name: testName
            },
            success: function (response) {
                $('#test_cost_1').val(response);
            },
            error: function (xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    $(document).ready(function() {
        $.ajax({
            url: '{{ route("system_admin.fetch_available_test_categories") }}',
            type: 'GET',
            success: function(response) {
                $('#test_category_2').html(response);

                // Decode the JSON-encoded test_category array
                let testCategories = {!! json_encode($patientTestRecord->test_category) !!};

                // Select the first element of the testCategories array
                let selectedCategory = testCategories.length > 0 ? testCategories[1] : '';

                // Iterate over each category option and set the selected option
                $('#test_category_2').val(selectedCategory);
                $('#test_category_2').trigger('change');
            },
            error: function(xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    // Fetch Available Test Name
    $('#test_category_2').change(function () {
        let testCategory = $(this).val();

        $.ajax({
            url: '{{ route("system_admin.fetch_available_test_names") }}',
            type: 'GET',
            data: {
                test_category: testCategory
            },
            success: function (response) {
                $('#test_name_2').html(response);
                let testNames = {!! json_encode($patientTestRecord->test_name) !!};
                let selectedName = testNames.length > 0 ? testNames[1] : '';
                $('#test_name_2').val(selectedName);
                $('#test_name_2').trigger('change');
            },
            error: function (xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    // Update test cost based on selected test name
    $('#test_name_2').change(function () {
        let testName = $(this).val();

        $.ajax({
            url: '{{ route("system_admin.fetch_test_cost") }}',
            type: 'GET',
            data: {
                test_name: testName
            },
            success: function (response) {
                $('#test_cost_2').val(response);
            },
            error: function (xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    $(document).ready(function() {
        $.ajax({
            url: '{{ route("system_admin.fetch_available_test_categories") }}',
            type: 'GET',
            success: function(response) {
                $('#test_category_3').html(response);

                // Decode the JSON-encoded test_category array
                let testCategories = {!! json_encode($patientTestRecord->test_category) !!};

                // Select the first element of the testCategories array
                let selectedCategory = testCategories.length > 0 ? testCategories[2] : '';

                // Iterate over each category option and set the selected option
                $('#test_category_3').val(selectedCategory);
                $('#test_category_3').trigger('change');
            },
            error: function(xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    // Fetch Available Test Name
    $('#test_category_3').change(function () {
        let testCategory = $(this).val();

        $.ajax({
            url: '{{ route("system_admin.fetch_available_test_names") }}',
            type: 'GET',
            data: {
                test_category: testCategory
            },
            success: function (response) {
                $('#test_name_3').html(response);
                let testNames = {!! json_encode($patientTestRecord->test_name) !!};
                let selectedName = testNames.length > 0 ? testNames[2] : '';
                $('#test_name_3').val(selectedName);
                $('#test_name_3').trigger('change');
            },
            error: function (xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    // Update test cost based on selected test name
    $('#test_name_3').change(function () {
        let testName = $(this).val();

        $.ajax({
            url: '{{ route("system_admin.fetch_test_cost") }}',
            type: 'GET',
            data: {
                test_name: testName
            },
            success: function (response) {
                $('#test_cost_3').val(response);
            },
            error: function (xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    $(document).ready(function() {
        $.ajax({
            url: '{{ route("system_admin.fetch_available_test_categories") }}',
            type: 'GET',
            success: function(response) {
                $('#test_category_4').html(response);

                // Decode the JSON-encoded test_category array
                let testCategories = {!! json_encode($patientTestRecord->test_category) !!};

                // Select the first element of the testCategories array
                let selectedCategory = testCategories.length > 0 ? testCategories[3] : '';

                // Iterate over each category option and set the selected option
                $('#test_category_4').val(selectedCategory);
                $('#test_category_4').trigger('change');
            },
            error: function(xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    // Fetch Available Test Name
    $('#test_category_4').change(function () {
        let testCategory = $(this).val();

        $.ajax({
            url: '{{ route("system_admin.fetch_available_test_names") }}',
            type: 'GET',
            data: {
                test_category: testCategory
            },
            success: function (response) {
                $('#test_name_4').html(response);
                let testNames = {!! json_encode($patientTestRecord->test_name) !!};
                let selectedName = testNames.length > 0 ? testNames[3] : '';
                $('#test_name_4').val(selectedName);
                $('#test_name_4').trigger('change');
            },
            error: function (xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    // Update test cost based on selected test name
    $('#test_name_4').change(function () {
        let testName = $(this).val();

        $.ajax({
            url: '{{ route("system_admin.fetch_test_cost") }}',
            type: 'GET',
            data: {
                test_name: testName
            },
            success: function (response) {
                $('#test_cost_4').val(response);
            },
            error: function (xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    $(document).ready(function() {
        $.ajax({
            url: '{{ route("system_admin.fetch_available_test_categories") }}',
            type: 'GET',
            success: function(response) {
                $('#test_category_5').html(response);

                // Decode the JSON-encoded test_category array
                let testCategories = {!! json_encode($patientTestRecord->test_category) !!};

                // Select the first element of the testCategories array
                let selectedCategory = testCategories.length > 0 ? testCategories[4] : '';

                // Iterate over each category option and set the selected option
                $('#test_category_5').val(selectedCategory);
                $('#test_category_5').trigger('change');
            },
            error: function(xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    // Fetch Available Test Name
    $('#test_category_5').change(function () {
        let testCategory = $(this).val();

        $.ajax({
            url: '{{ route("system_admin.fetch_available_test_names") }}',
            type: 'GET',
            data: {
                test_category: testCategory
            },
            success: function (response) {
                $('#test_name_5').html(response);
                let testNames = {!! json_encode($patientTestRecord->test_name) !!};
                let selectedName = testNames.length > 0 ? testNames[4] : '';
                $('#test_name_5').val(selectedName);
                $('#test_name_5').trigger('change');
            },
            error: function (xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    // Update test cost based on selected test name
    $('#test_name_5').change(function () {
        let testName = $(this).val();

        $.ajax({
            url: '{{ route("system_admin.fetch_test_cost") }}',
            type: 'GET',
            data: {
                test_name: testName
            },
            success: function (response) {
                $('#test_cost_5').val(response);
            },
            error: function (xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    // Status Status Selected
    $(document).ready(function() {
        let selectedStatus = '{{ $patientTestRecord->test_status }}';
        $('#test_status').val(selectedStatus);
    });

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

    // Test cost increment and decrement
    document.getElementById('test_cost').addEventListener('keypress', function(event) {
        handleKeyPress(event);
    });

    function handleKeyPress(event) {
        let key = event.key;
        let value = parseInt(event.target.value, 10);
        value = isNaN(value) ? 0 : value;
        if (key === '+' || key === '=') {
            value++;
        } else if (key === '-') {
            value = value > 0 ? value - 1 : 0;
        }
        event.target.value = value;
    }
</script>

</body>
</html>

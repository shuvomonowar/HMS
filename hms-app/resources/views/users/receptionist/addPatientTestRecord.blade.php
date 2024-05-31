<div class="w-[60rem] ml-[2rem] overflow-y-auto max-h-[73vh] mx-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
    <div>
        <span id="closeModalBtn" class="cursor-pointer inline-block transition-transform duration-300 transform-gpu hover:rotate-90">
            <img src="{{ asset('images/appointment/close.png') }}" alt="Close Icon" class="w-7 h-7">
        </span>
    </div>
    <div class="grid mb-7">
        <h1 class="text-2xl font-medium text-center mb-4 text-blue-500">Add New Test</h1>
        <hr class="border-opacity-50 border-blue-600 w-full mb-6">
    </div>
    <form action="{{ route('receptionist_user.patient_record.test_record.store', $testID) }}" method="POST">
        @csrf
        <div class="flex flex-col gap-4">
            <div class="mb-4">
                <label for="patient_test_id" class="block text-sm font-medium mb-1">Patient Test ID</label>
                <input type="number" id="patient_test_id" name="patient_test_id"
                       class="form-input w-[25rem] rounded-md px-3 py-2 shadow-md border border-b-neutral-400 bg-red-50 focus:outline-none focus:border-blue-500"
                       value="{{ $testID }}" readonly>
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
                <label for="delivery_date" class="block text-sm font-medium mb-1">Test Delivery Date</label>
                <input type="date" id="delivery_date" name="delivery_date" class="form-input focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500" required>
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
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Add Test Record
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

    // Fetch Available Test Category
    $(document).ready(function() {
        $.ajax({
            url: '{{ route("fetch_available_test_categories") }}',
            type: 'GET',
            success: function (response) {
                $('#test_category_1').append(response);
                $('#test_category_2').append(response);
                $('#test_category_3').append(response);
                $('#test_category_4').append(response);
                $('#test_category_5').append(response);
            },
            error: function (xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    // Fetch Available Test Name
    $('#test_category_1').change(function () {
        let testCategory = $(this).val();

        $.ajax({
            url: '{{ route("fetch_available_test_names") }}',
            type: 'GET',
            data: {
                test_category: testCategory
            },
            success: function (response) {
                $('#test_name_1').html(response);
            },
            error: function (xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    $('#test_category_2').change(function () {
        let testCategory = $(this).val();

        $.ajax({
            url: '{{ route("fetch_available_test_names") }}',
            type: 'GET',
            data: {
                test_category: testCategory
            },
            success: function (response) {
                $('#test_name_2').html(response);
            },
            error: function (xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    $('#test_category_3').change(function () {
        let testCategory = $(this).val();

        $.ajax({
            url: '{{ route("fetch_available_test_names") }}',
            type: 'GET',
            data: {
                test_category: testCategory
            },
            success: function (response) {
                $('#test_name_3').html(response);
            },
            error: function (xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    $('#test_category_4').change(function () {
        let testCategory = $(this).val();

        $.ajax({
            url: '{{ route("fetch_available_test_names") }}',
            type: 'GET',
            data: {
                test_category: testCategory
            },
            success: function (response) {
                $('#test_name_4').html(response);
            },
            error: function (xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    $('#test_category_5').change(function () {
        let testCategory = $(this).val();

        $.ajax({
            url: '{{ route("fetch_available_test_names") }}',
            type: 'GET',
            data: {
                test_category: testCategory
            },
            success: function (response) {
                $('#test_name_5').html(response);
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
            url: '{{ route("fetch_test_cost") }}', // Use the defined route
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

    $('#test_name_2').change(function () {
        let testName = $(this).val();

        $.ajax({
            url: '{{ route("fetch_test_cost") }}', // Use the defined route
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

    $('#test_name_3').change(function () {
        let testName = $(this).val();

        $.ajax({
            url: '{{ route("fetch_test_cost") }}', // Use the defined route
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

    $('#test_name_4').change(function () {
        let testName = $(this).val();

        $.ajax({
            url: '{{ route("fetch_test_cost") }}', // Use the defined route
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

    $('#test_name_5').change(function () {
        let testName = $(this).val();

        $.ajax({
            url: '{{ route("fetch_test_cost") }}', // Use the defined route
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

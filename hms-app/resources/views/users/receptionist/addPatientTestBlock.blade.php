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
    <form action="{{ route('receptionist_user.patient_record.test_block_record.store', $patientID) }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label for="patient_id" class="block text-sm font-medium mb-1">Patient ID</label>
                <input type="number" id="patient_id" name="patient_id"
                       class="form-input w-[25rem] rounded-md px-3 py-2 shadow-md border border-b-neutral-400 bg-red-50 focus:outline-none focus:border-blue-500"
                       value="{{ $patientID }}" readonly>
            </div>
            <div class="mb-4">
                <label for="doctor_id" class="block text-sm font-medium mb-1">Appointment Doctor</label>
                <select id="doctor_id" name="doctor_id" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-blue-50 focus:outline-none focus:border-blue-500" required>
                    <option value="">Select Doctor</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->doctor_id }}">{{ $doctor->doctor_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Add Test Group
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
                $('#test_category').append(response);
            },
            error: function (xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    // Fetch Available Test Name
    $('#test_category').change(function () {
        let testCategory = $(this).val();

        $.ajax({
            url: '{{ route("fetch_available_test_names") }}',
            type: 'GET',
            data: {
                test_category: testCategory
            },
            success: function (response) {
                $('#test_name').html(response);
            },
            error: function (xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    // Update test cost based on selected test name
    $('#test_name').change(function () {
        let testName = $(this).val();

        $.ajax({
            url: '{{ route("fetch_test_cost") }}', // Use the defined route
            type: 'GET',
            data: {
                test_name: testName
            },
            success: function (response) {
                $('#test_cost').val(response);
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

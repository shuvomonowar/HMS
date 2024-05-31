<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient Record</title>
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

<div class="ml-[6rem] py-1 flex flex-wrap border-b-blue-600" id="editPatient">
    <div class="w-[70rem] mt-4 p-10 rounded-md shadow-lg items-center overflow-y-auto max-h-[73vh] mx-auto bg-gray-200 border border-blue-200 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
        <div class="grid mb-7">
            <h1 class="text-2xl font-medium mb-7 text-center text-blue-500">Edit Patient Record</h1>
            <hr class="border-opacity-50 border-blue-600 w-full mb-6">
        </div>
        <form action="{{ route('system_admin.patient_record.update', $patientRecord) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="first_name" class="block text-sm font-medium mb-1">First Name</label>
                    <input type="text" id="first_name" name="first_name"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           value="{{ $patientRecord->first_name }}" required>
                </div>
                <div class="mb-4">
                    <label for="last_name" class="block text-sm font-medium mb-1">Last Name</label>
                    <input type="text" id="last_name" name="last_name"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           value="{{ $patientRecord->last_name }}" required>
                </div>
                <div class="mb-4">
                    <label for="gender" class="block text-sm font-medium mb-1">Gender</label>
                    <select id="gender" name="gender"
                            class="form-select bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                            required>
                        <option value="Male" {{ $patientRecord->gender === 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $patientRecord->gender === 'Female' ? 'selected' : '' }}>Female
                        </option>
                        <option value="Other" {{ $patientRecord->gender === 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="blood_group" class="block text-sm font-medium mb-1">Blood Group</label>
                    <select id="blood_group" name="blood_group" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500" required>
                        <option value="">Select Blood Group</option>
                        <option value="A+" {{ $patientRecord->blood_group === 'A+' ? 'selected' : '' }}>A+</option>
                        <option value="A-" {{ $patientRecord->blood_group === 'A-' ? 'selected' : '' }}>A-</option>
                        <option value="B+" {{ $patientRecord->blood_group === 'B+' ? 'selected' : '' }}>B+</option>
                        <option value="B-" {{ $patientRecord->blood_group === 'B-' ? 'selected' : '' }}>B-</option>
                        <option value="AB+" {{ $patientRecord->blood_group === 'AB+' ? 'selected' : '' }}>AB+</option>
                        <option value="AB-" {{ $patientRecord->blood_group === 'AB-' ? 'selected' : '' }}>AB-</option>
                        <option value="O+" {{ $patientRecord->blood_group === 'O+' ? 'selected' : '' }}>O+</option>
                        <option value="O-" {{ $patientRecord->blood_group === 'O-' ? 'selected' : '' }}>O-</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="birth_date" class="block text-sm font-medium mb-1">Birth Date</label>
                    <input type="date" id="birth_date" name="birth_date"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           value="{{ $patientRecord->birth_date }}" required>
                </div>
                {{--<div class="mb-4">
                    <label for="age" class="block text-sm font-medium mb-1">Age</label>
                    <input type="text" id="age" name="age"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           pattern="[0-9]+" title="Please enter numbers only"
                           value="{{ $patientRecord->age }}" required>
                </div>--}}
                <div class="mb-4 col-span-2">
                    <label for="address" class="block text-sm font-medium mb-1">Address</label>
                    <textarea id="address" name="address"
                              class="form-textarea bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                              required>{{ $patientRecord->address }}
                    </textarea>
                </div>
                <div class="mb-4">
                    <label for="phone_number" class="block text-sm font-medium mb-1">Phone</label>
                    <input type="tel" id="phone_number" name="phone_number"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           pattern="[0-9]{11}" title="Please enter a valid 11-digit phone number"
                           value="{{ $patientRecord->phone_number }}" required>
                </div>
                {{--@error('add_phone_number_error')
                <div class="text-red-500 text-xs mt-2 text-center">{{ $message }}</div>
                @enderror--}}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" id="email" name="email"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           value="{{ $patientRecord->email }}" required>
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Update
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
    const editPatientContainer = document.getElementById('editPatient');

    collapseNavbarBtn.addEventListener('click', function () {
        navbarContainer.classList.toggle('collapsed');
        if (navbarContainer.classList.contains('collapsed')) {
            navbarContainer.style.width = '80px';
            editPatientContainer.style.marginLeft = '85px';
            editPatientContainer.style.marginRight = '1px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M15 8A7 7 0 1 0 1 8a7 7 0 0 0 14 0ZM4.75 7.25a.75.75 0 0 0 0 1.5h4.69L8.22 9.97a.75.75 0 1 0 1.06 1.06l2.5-2.5a.75.75 0 0 0 0-1.06l-2.5-2.5a.75.75 0 0 0-1.06 1.06l1.22 1.22H4.75Z" clip-rule="evenodd" /></svg>';

            initializeTooltips();
        } else {
            navbarContainer.style.width = 'auto';
            editPatientContainer.style.marginLeft = '220px';
            editPatientContainer.style.marginRight = '5px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm10.25.75a.75.75 0 0 0 0-1.5H6.56l1.22-1.22a.75.75 0 0 0-1.06-1.06l-2.5 2.5a.75.75 0 0 0 0 1.06l2.5 2.5a.75.75 0 1 0 1.06-1.06L6.56 8.75h4.69Z" clip-rule="evenodd" /></svg>';

            removeTooltips();
        }
    });
</script>

</body>
</html>

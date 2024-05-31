<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee Record</title>
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

<div class="ml-[6.25rem] py-1 flex flex-wrap border-b-blue-600" id="editEmployee">
    <div class="w-[70rem] mt-4 p-10 rounded-md shadow-lg items-center overflow-y-auto max-h-[73vh] mx-auto bg-gray-200 border border-blue-200">
        <div class="grid">
            <h1 class="text-2xl font-medium mb-1 text-center text-blue-500">Edit Employee Record</h1>
            <hr class="border-opacity-50 border-blue-300 w-full mb-9 mt-3">
        </div>
        <form action="{{ route('system_admin.employee_record.update', $employeeRecord) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="first_name" class="block text-sm font-medium mb-1">First Name</label>
                    <input type="text" id="first_name" name="first_name"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           value="{{ $employeeRecord->first_name }}" required>
                </div>
                <div class="mb-4">
                    <label for="last_name" class="block text-sm font-medium mb-1">Last Name</label>
                    <input type="text" id="last_name" name="last_name"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           value="{{ $employeeRecord->last_name }}" required>
                </div>
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium mb-1">User Name</label>
                    <input type="text" id="username" name="username"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           value="{{ $employeeRecord->username }}" required readonly>
                </div>
                <div class="mb-4">
                    <label for="department" class="block text-sm font-medium mb-1">Department</label>
                    <select id="department" name="department"
                            class="form-select bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                            required>
                        <option value="Doctor" {{ $employeeRecord->department === 'Doctor' ? 'selected' : '' }}>Doctor
                        </option>
                        <option value="Nurse" {{ $employeeRecord->department === 'Nurse' ? 'selected' : '' }}>Nurse
                        </option>
                        <option value="Receptionist" {{ $employeeRecord->department === 'Receptionist' ? 'selected' : '' }}>
                            Receptionist
                        </option>
                        <option value="Account" {{ $employeeRecord->department === 'Account' ? 'selected' : '' }}>
                            Account
                        </option>
                        <option value="Laboratory & Diagnostic Technician" {{ $employeeRecord->department === 'Laboratory & Diagnostic Technician' ? 'selected' : '' }}>
                            Laboratory & Diagnostic Technician
                        </option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="salary" class="block text-sm font-medium mb-1">Salary</label>
                    <input type="text" id="salary" name="salary"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           value="{{ $employeeRecord->salary }}" pattern="[0-9]+" title="Please enter numbers only"
                           required>
                </div>
                <div class="mb-4">
                    <label for="hire_date" class="block text-sm font-medium mb-1">Hire Date</label>
                    <input type="date" id="hire_date" name="hire_date"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           value="{{ $employeeRecord->hire_date }}" required>
                </div>
                <div class="mb-4">
                    <label for="designation" class="block text-sm font-medium mb-1">Designation</label>
                    <select id="designation" name="designation"
                            class="form-select bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                            required>
                        <option value="Doctor" {{ $employeeRecord->designation === 'Doctor' ? 'selected' : '' }}>
                            Doctor
                        </option>
                        <option value="Nurse" {{ $employeeRecord->designation === 'Nurse' ? 'selected' : '' }}>Nurse
                        </option>
                        <option value="Receptionist" {{ $employeeRecord->designation === 'Receptionist' ? 'selected' : '' }}>
                            Receptionist
                        </option>
                        <option value="Account" {{ $employeeRecord->designation === 'Accountant' ? 'selected' : '' }}>
                            Account
                        </option>
                        <option value="Laboratory Technician" {{ $employeeRecord->designation === 'Laboratory Technician' ? 'selected' : '' }}>
                            Laboratory Technician
                        </option>
                        <option value="Diagnostic Technician" {{ $employeeRecord->designation === 'Diagnostic Technician' ? 'selected' : '' }}>
                            Diagnostic Technician
                        </option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="employment_type" class="block text-sm font-medium mb-1">Employment Type</label>
                    <select id="employment_type" name="employment_type"
                            class="form-select bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                            required>
                        <option value="Full Time" {{ $employeeRecord->employment_type === 'Full Time' ? 'selected' : '' }}>
                            Full Time
                        </option>
                        <option value="Part Time" {{ $employeeRecord->employment_type === 'Part Time' ? 'selected' : '' }}>
                            Part Time
                        </option>
                        <option value="Contract" {{ $employeeRecord->employment_type === 'Contract' ? 'selected' : '' }}>
                            Contract
                        </option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="gender" class="block text-sm font-medium mb-1">Gender</label>
                    <select id="gender" name="gender"
                            class="form-select bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                            required>
                        <option value="Male" {{ $employeeRecord->gender === 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $employeeRecord->gender === 'Female' ? 'selected' : '' }}>Female
                        </option>
                        <option value="Other" {{ $employeeRecord->gender === 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="birth_date" class="block text-sm font-medium mb-1">Birth Date</label>
                    <input type="date" id="birth_date" name="birth_date"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           value="{{ $employeeRecord->birth_date }}" required>
                </div>
                <div class="mb-4 col-span-2">
                    <label for="address" class="block text-sm font-medium mb-1">Address</label>
                    <textarea id="address" name="address"
                              class="form-textarea bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                              required>{{ $employeeRecord->address }}
                    </textarea>
                </div>
                <div class="mb-4">
                    <label for="nid" class="block text-sm font-medium mb-1">NID</label>
                    <input type="text" id="nid" name="nid"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           value="{{ $employeeRecord->nid }}" pattern="[0-9]{10}" title="Please enter numbers only"
                           required>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium mb-1">Phone</label>
                    <input type="tel" id="phone" name="phone"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           pattern="[0-9]{11}" title="Please enter a valid 11-digit phone number"
                           value="{{ $employeeRecord->phone }}" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" id="email" name="email"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           value="{{ $employeeRecord->email }}" required>
                </div>
                <div class="flex">
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium mb-1">Password</label>
                        <input type="password" id="password" name="password"
                               class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                               value="{{ $employeeRecord->password }}" minlength="8" maxlength="16" required>
                    </div>
                    <button type="button" id="togglePassword"
                            class="mr-2 focus:outline-none bg-white mt-6 mb-4 ml-2 p-2 rounded-lg hover:bg-blue-100">
                        <img src="{{ asset('images/login/show_icon.png') }}" alt="Show Password" class="w-5 h-5">
                    </button>
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Update
                    Record
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
    const collapseIcon = document.getElementById('collapseIcon');
    const editEmployee = document.getElementById('editEmployee');

    collapseNavbarBtn.addEventListener('click', function () {
        navbarContainer.classList.toggle('collapsed');
        if (navbarContainer.classList.contains('collapsed')) {
            navbarContainer.style.width = '80px';
            editEmployee.style.marginLeft = '100px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M15 8A7 7 0 1 0 1 8a7 7 0 0 0 14 0ZM4.75 7.25a.75.75 0 0 0 0 1.5h4.69L8.22 9.97a.75.75 0 1 0 1.06 1.06l2.5-2.5a.75.75 0 0 0 0-1.06l-2.5-2.5a.75.75 0 0 0-1.06 1.06l1.22 1.22H4.75Z" clip-rule="evenodd" /></svg>';

            initializeTooltips();
        } else {
            navbarContainer.style.width = 'auto';
            editEmployee.style.marginLeft = '175px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm10.25.75a.75.75 0 0 0 0-1.5H6.56l1.22-1.22a.75.75 0 0 0-1.06-1.06l-2.5 2.5a.75.75 0 0 0 0 1.06l2.5 2.5a.75.75 0 1 0 1.06-1.06L6.56 8.75h4.69Z" clip-rule="evenodd" /></svg>';

            removeTooltips();
        }
    });

    // Toggle Password Show and Hide
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.querySelector('img').src = type === 'password' ? '{{ asset('images/login/show_icon.png') }}' : '{{ asset('images/login/hide_icon.png') }}';
    });
</script>

</body>
</html>

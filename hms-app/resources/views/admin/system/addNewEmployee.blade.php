<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Employee</title>
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

<div class="ml-[6.25rem] py-1 flex flex-wrap border-b-blue-600" id="addNewEmployee">
    <div class="w-[70rem] mt-4 p-10 rounded-md shadow-lg items-center overflow-y-auto max-h-[73vh] mx-auto bg-gray-200 border border-blue-200 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
        <div class="grid">
            <h1 class="text-2xl font-medium mb-1 text-center text-blue-500">Add New Employee</h1>
            <hr class="border-opacity-50 border-blue-300 w-full mb-9 mt-3">
        </div>
        <form id="addEmployeeForm" action="{{ route("system_admin.add_employee.store") }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="first_name" class="block text-sm font-medium mb-1">First Name</label>
                    <input type="text" id="first_name" name="first_name"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md" required>
                </div>
                <div class="mb-4">
                    <label for="last_name" class="block text-sm font-medium mb-1">Last Name</label>
                    <input type="text" id="last_name" name="last_name"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md" required>
                </div>
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium mb-1">User Name</label>
                    <input type="text" id="username" name="username"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md" required>
                </div>
                @error('message')
                <div class="text-red-500 text-xs mt-2 text-center">{{ $message }}</div>
                @enderror
                <div class="mb-4">
                    <label for="department" class="block text-sm font-medium mb-1">Department</label>
                    <select id="department" name="department"
                            class="form-select bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                            required>
                        <option value="Doctor">Doctor</option>
                        <option value="Nurse">Nurse</option>
                        <option value="Receptionist">Receptionist</option>
                        <option value="Account">Account</option>
                        <option value="Laboratory & Diagnostic Technician">Laboratory & Diagnostic Technician</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="salary" class="block text-sm font-medium mb-1">Salary</label>
                    <input type="text" id="salary" name="salary"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           pattern="[0-9]+" title="Please enter numbers only" required>
                </div>
                <div class="mb-4">
                    <label for="hire_date" class="block text-sm font-medium mb-1">Hire Date</label>
                    <input type="date" id="hire_date" name="hire_date"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md" required>
                </div>
                <div class="mb-4">
                    <label for="designation" class="block text-sm font-medium mb-1">Designation</label>
                    <select id="designation" name="designation"
                            class="form-select bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                            required>
                        <option value="Doctor">Doctor</option>
                        <option value="Nurse">Nurse</option>
                        <option value="Receptionist">Receptionist</option>
                        <option value="Account">Account</option>
                        <option value="Laboratory Technician">Laboratory Technician</option>
                        <option value="Diagnostic Technician">Diagnostic Technician</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="employment_type" class="block text-sm font-medium mb-1">Employment Type</label>
                    <select id="employment_type" name="employment_type"
                            class="form-select bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                            required>
                        <option value="full_time">Full Time</option>
                        <option value="part_time">Part Time</option>
                        <option value="contract">Contract</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="gender" class="block text-sm font-medium mb-1">Gender</label>
                    <select id="gender" name="gender"
                            class="form-select bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                            required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="birth_date" class="block text-sm font-medium mb-1">Birth Date</label>
                    <input type="date" id="birth_date" name="birth_date"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md" required>
                </div>
                <div class="mb-4 col-span-2">
                    <label for="address" class="block text-sm font-medium mb-1">Address</label>
                    <textarea id="address" name="address"
                              class="form-textarea bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                              required></textarea>
                </div>
                <div class="mb-4">
                    <label for="nid" class="block text-sm font-medium mb-1">NID</label>
                    <input type="text" id="nid" name="nid"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           pattern="[0-9]{10}" title="Please enter a valid 10-digit NID number" required>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium mb-1">Phone</label>
                    <input type="tel" id="phone" name="phone"
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
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Add
                    Employee
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
    const addNewEmployee = document.getElementById('addNewEmployee');

    collapseNavbarBtn.addEventListener('click', function () {
        navbarContainer.classList.toggle('collapsed');
        if (navbarContainer.classList.contains('collapsed')) {
            navbarContainer.style.width = '80px';
            addNewEmployee.style.marginLeft = '100px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M15 8A7 7 0 1 0 1 8a7 7 0 0 0 14 0ZM4.75 7.25a.75.75 0 0 0 0 1.5h4.69L8.22 9.97a.75.75 0 1 0 1.06 1.06l2.5-2.5a.75.75 0 0 0 0-1.06l-2.5-2.5a.75.75 0 0 0-1.06 1.06l1.22 1.22H4.75Z" clip-rule="evenodd" /></svg>';

            initializeTooltips();
        } else {
            navbarContainer.style.width = 'auto';
            addNewEmployee.style.marginLeft = '175px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm10.25.75a.75.75 0 0 0 0-1.5H6.56l1.22-1.22a.75.75 0 0 0-1.06-1.06l-2.5 2.5a.75.75 0 0 0 0 1.06l2.5 2.5a.75.75 0 1 0 1.06-1.06L6.56 8.75h4.69Z" clip-rule="evenodd" /></svg>';

            removeTooltips();
        }
    });

    // Username field validation
    document.getElementById('username').addEventListener('input', function () {
        let usernameInput = this.value.toLowerCase().replace(/\s+/g, ''); // Convert to lowercase and remove spaces
        this.value = usernameInput; // Update the input value
    });
</script>

</body>
</html>

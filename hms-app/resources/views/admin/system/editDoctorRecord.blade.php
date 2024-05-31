<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor Record</title>
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

<div class="ml-[6rem] py-1 flex flex-wrap border-b-blue-600" id="editDoctor">
    <div class="w-[70rem] mt-4 p-10 rounded-md shadow-lg items-center overflow-y-auto max-h-[73vh] mx-auto bg-gray-200 border border-blue-200 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
        <div class="grid mb-7">
            <h1 class="text-2xl font-medium mb-7 text-center text-blue-500">Edit Doctor Record</h1>
            <hr class="border-opacity-50 border-blue-600 w-full mb-6">
        </div>
        <form action="{{ route('system_admin.doctor_record.update', $doctorRecord) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium mb-1">Doctor Name</label>
                    <input type="text" id="name" name="name"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           value="{{ $doctorRecord->name }}" required>
                </div>
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium mb-1">User Name</label>
                    <input type="text" id="username" name="username"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           value="{{ $doctorRecord->username }}" required>
                </div>
                <div class="mb-4">
                    <label for="qualification" class="block text-sm font-medium mb-1">Qualification</label>
                    <input type="text" id="qualification" name="qualification"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           value="{{ $doctorRecord->qualification }}" required>
                </div>
                <div class="mb-4">
                    <label for="specialization" class="block text-sm font-medium mb-1">Specialization</label>
                    <select id="specialization" name="specialization" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500" required>
                        <option value="">Select Specialization</option>
                        <option value="Pediatrics" {{ $doctorRecord->specialization === 'Pediatrics' ? 'selected' : '' }}>Pediatrics</option>
                        <option value="Cardiology" {{ $doctorRecord->specialization === 'Cardiology' ? 'selected' : '' }}>Cardiology</option>
                        <option value="Orthopedics" {{ $doctorRecord->specialization === 'Orthopedics' ? 'selected' : '' }}>Orthopedics</option>
                        <option value="Neurology" {{ $doctorRecord->specialization === 'Neurology' ? 'selected' : '' }}>Neurology</option>
                        <option value="Medicine" {{ $doctorRecord->specialization === 'Medicine' ? 'selected' : '' }}>Medicine</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="phone_number" class="block text-sm font-medium mb-1">Phone</label>
                    <input type="tel" id="phone_number" name="phone_number"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           pattern="[0-9]{11}" title="Please enter a valid 11-digit phone number"
                           value="{{ $doctorRecord->phone_number }}" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" id="email" name="email"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           value="{{ $doctorRecord->email }}" required>
                </div>
                <div class="flex">
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium mb-1">Password</label>
                        <input type="password" id="password" name="password"
                               class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                               value="{{ $doctorRecord->password }}" minlength="8" maxlength="16" required>
                    </div>
                    <button type="button" id="togglePassword"
                            class="mr-2 focus:outline-none bg-white mt-6 mb-4 ml-2 p-2 rounded-lg hover:bg-blue-100">
                        <img src="{{ asset('images/login/show_icon.png') }}" alt="Show Password" class="w-5 h-5">
                    </button>
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Update
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
    const editDoctorContainer = document.getElementById('editDoctorRecord');

    collapseNavbarBtn.addEventListener('click', function () {
        navbarContainer.classList.toggle('collapsed');
        if (navbarContainer.classList.contains('collapsed')) {
            navbarContainer.style.width = '80px';
            editDoctorContainer.style.marginLeft = '85px';
            editDoctorContainer.style.marginRight = '1px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M15 8A7 7 0 1 0 1 8a7 7 0 0 0 14 0ZM4.75 7.25a.75.75 0 0 0 0 1.5h4.69L8.22 9.97a.75.75 0 1 0 1.06 1.06l2.5-2.5a.75.75 0 0 0 0-1.06l-2.5-2.5a.75.75 0 0 0-1.06 1.06l1.22 1.22H4.75Z" clip-rule="evenodd" /></svg>';

            initializeTooltips();
        } else {
            navbarContainer.style.width = 'auto';
            editDoctorContainer.style.marginLeft = '220px';
            editDoctorContainer.style.marginRight = '5px';
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

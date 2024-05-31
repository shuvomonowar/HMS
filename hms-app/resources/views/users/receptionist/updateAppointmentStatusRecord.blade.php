<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Patient</title>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="bg-white text-blue-900">

<!-- Header -->
@include('compulsory.header')

<!-- Navbar -->
<div class="mt-[6rem]">
    @include('users.receptionist.navbar')
</div>

<div class="ml-[6.25rem] py-1 flex flex-wrap border-b-blue-600" id="changeAppointmentStatus">
    <div class="w-[70rem] mt-4 p-10 rounded-md shadow-lg items-center overflow-y-auto max-h-[73vh] mx-auto bg-gray-200 border border-blue-200 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
        <div class="grid mb-1">
            <h1 class="text-blue-500">General Information</h1>
            <hr class="border-opacity-50 border-blue-600 w-[38.1rem] mb-6">
        </div>
        <div class="flex flex-row gap-10 mb-[4rem]">
            <div class="px-[2rem] py-[0.7rem] bg-red-400">
                <h1 class="text-lg">Appointment ID: <span>{{ $appointmentRecord->id }}</span></h1>
            </div>
            <div class="px-[2rem] py-[0.7rem] bg-green-400">
                <h1 class="text-lg">Patient ID: <span>{{ $appointmentRecord->patient_id }}</span></h1>
            </div>
            <div class="px-[2rem] py-[0.7rem] bg-orange-400">
                <h1 class="text-lg">Doctor ID: <span>{{ $appointmentRecord->doctor_id }}</span></h1>
            </div>
        </div>
        <div class="grid mb-7">
            <h1 class="text-2xl font-medium mb-7 text-center text-blue-500">Update Appointment Status</h1>
            <hr class="border-opacity-50 border-blue-600 w-full mb-6">
        </div>
        <form action="{{ route('receptionist_user.appointment_record.appointment_status.update', $appointmentRecord) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-0">
                <input type="hidden" id="patient_id" name="patient_id"
                       class="form-input bg-red-50 focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                       value="{{ $appointmentRecord->patient_id }}" required>
            </div>
            <div class="mb-0">
                <input type="hidden" id="patient_name" name="patient_name"
                       class="form-input bg-red-50 focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                       value="{{ $appointmentRecord->patient_name }}" required>
            </div>
            <div class="mb-0">
                <input type="hidden" id="doctor_id" name="doctor_id"
                       class="form-input bg-red-50 focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                       value="{{ $appointmentRecord->doctor_id }}" required>
            </div>
            <div class="mb-0">
                <input type="hidden" id="doctor_name" name="doctor_name"
                       class="form-input bg-red-50 focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                       value="{{ $appointmentRecord->doctor_name }}" required>
            </div>
            <div class="mb-0">
                <input type="hidden" id="appointment_date" name="appointment_date"
                       class="form-input bg-red-50 focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                       value="{{ $appointmentRecord->appointment_date }}" required>
            </div>
            <div class="mb-0">
                <input type="hidden" id="appointment_day" name="appointment_day"
                       class="form-input bg-red-50 focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                       value="{{ $appointmentRecord->appointment_day }}" required>
            </div>
            <div class="mb-0">
                <input type="hidden" id="appointment_time" name="appointment_time"
                       class="form-input bg-red-50 focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                       value="{{ $appointmentRecord->appointment_time }}" required>
            </div>
            <div class="mb-0">
                <input type="hidden" id="appointment_serial" name="appointment_serial"
                       class="form-input bg-red-50 focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                       value="{{ $appointmentRecord->appointment_serial }}" required>
            </div>
            <div class="mb-0">
                <input type="hidden" id="reason" name="reason"
                       class="form-input bg-red-50 focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                       value="{{ $appointmentRecord->reason }}" required>
            </div>
            <div class="flex flex-row gap-5">
                <div class="mb-4">
                    <label for="appointment_status" class="block text-sm font-medium mb-1">Appointment Status</label>
                    <select id="appointment_status" name="appointment_status"
                            class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500"
                            required>
                        <option value="">Select Status</option>
                        <option value="Present" {{ $appointmentRecord->status === 'Present' ? 'selected' : '' }}>Present</option>
                        <option value="Absent" {{ $appointmentRecord->status === 'Absent' ? 'selected' : '' }}>Absent</option>
                    </select>
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md" id="submit_status_btn">Update Status
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Footer -->
<div class="mt-[8.2rem] bg-gray-200">
    @include('compulsory.footer')
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous">
</script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
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
    const changeAppointmentStatus = document.getElementById('changeAppointmentStatus');

    collapseNavbarBtn.addEventListener('click', function () {
        navbarContainer.classList.toggle('collapsed');
        if (navbarContainer.classList.contains('collapsed')) {
            navbarContainer.style.width = '80px';
            changeAppointmentStatus.style.marginLeft = '100px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M15 8A7 7 0 1 0 1 8a7 7 0 0 0 14 0ZM4.75 7.25a.75.75 0 0 0 0 1.5h4.69L8.22 9.97a.75.75 0 1 0 1.06 1.06l2.5-2.5a.75.75 0 0 0 0-1.06l-2.5-2.5a.75.75 0 0 0-1.06 1.06l1.22 1.22H4.75Z" clip-rule="evenodd" /></svg>';

            initializeTooltips();
        } else {
            navbarContainer.style.width = 'auto';
            changeAppointmentStatus.style.marginLeft = '175px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm10.25.75a.75.75 0 0 0 0-1.5H6.56l1.22-1.22a.75.75 0 0 0-1.06-1.06l-2.5 2.5a.75.75 0 0 0 0 1.06l2.5 2.5a.75.75 0 1 0 1.06-1.06L6.56 8.75h4.69Z" clip-rule="evenodd" /></svg>';

            removeTooltips();
        }
    });
</script>

</body>
</html>

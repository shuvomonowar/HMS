<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor Schedule Record</title>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="bg-white text-blue-900">

<!-- Header -->
@include('compulsory.header')

<!-- Navbar -->
<div class="mt-[6rem]">
    @include('users.doctor.navbar')
</div>

<div class="ml-[5rem] py-1 flex flex-wrap border-b-blue-600" id="editScheduleRecord">
    <div class="w-[70rem] mt-4 p-10 rounded-md shadow-lg items-center overflow-y-auto max-h-[73vh] mx-auto bg-gray-200 border border-blue-200 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
        <div class="grid mb-7">
            <h1 class="text-2xl font-medium mb-7 text-center text-blue-500">Edit Schedule Record</h1>
            <hr class="border-opacity-50 border-blue-600 w-full mb-6">
        </div>
        <form action="{{ route('doctor_user.update_schedule.update', $scheduleRecord) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <input type="hidden" id="doctor_id" name="doctor_id"
                       class="form-input bg-red-50 focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                       value="{{ $scheduleRecord->doctor_id }}" required>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="schedule_day" class="block text-sm font-medium mb-1">Schedule Day</label>
                    <select id="schedule_day" name="schedule_day" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500" required>
                        <option value="">Select Day</option>
                        <option value="Saturday" {{ $scheduleRecord->schedule_day === 'Saturday' ? 'selected' : '' }}>Saturday</option>
                        <option value="Sunday" {{ $scheduleRecord->schedule_day === 'Sunday' ? 'selected' : '' }}>Sunday</option>
                        <option value="Monday" {{ $scheduleRecord->schedule_day === 'Monday' ? 'selected' : '' }}>Monday</option>
                        <option value="Tuesday" {{ $scheduleRecord->schedule_day === 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                        <option value="Wednesday" {{ $scheduleRecord->schedule_day === 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                        <option value="Thursday" {{ $scheduleRecord->schedule_day === 'Thursday' ? 'selected' : '' }}>Thursday</option>
                        <option value="Friday" {{ $scheduleRecord->schedule_day === 'Friday' ? 'selected' : '' }}>Friday</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="start_time" class="block text-sm font-medium mb-1">End Time</label>
                    <input type="time" id="start_time" name="start_time"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           value="{{ $scheduleRecord->start_time }}" required>
                </div>
                <div class="mb-4">
                    <label for="end_time" class="block text-sm font-medium mb-1">Start Time</label>
                    <input type="time" id="end_time" name="end_time"
                           class="form-input bg-white focus:bg-white w-[25rem] rounded-md px-3 py-2 shadow-md"
                           value="{{ $scheduleRecord->end_time }}" required>
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md" id="submit_btn">Update Schedule
                </button>
            </div>
        </form>
    </div>
</div>
<!-- Footer -->
<div class="mt-[8.5rem] bg-gray-200">
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
    const editScheduleRecord = document.getElementById('editScheduleRecord');

    collapseNavbarBtn.addEventListener('click', function () {
        navbarContainer.classList.toggle('collapsed');
        if (navbarContainer.classList.contains('collapsed')) {
            navbarContainer.style.width = '80px';
            editScheduleRecord.style.marginLeft = '120px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M15 8A7 7 0 1 0 1 8a7 7 0 0 0 14 0ZM4.75 7.25a.75.75 0 0 0 0 1.5h4.69L8.22 9.97a.75.75 0 1 0 1.06 1.06l2.5-2.5a.75.75 0 0 0 0-1.06l-2.5-2.5a.75.75 0 0 0-1.06 1.06l1.22 1.22H4.75Z" clip-rule="evenodd" /></svg>';

            initializeTooltips();
        } else {
            navbarContainer.style.width = 'auto';
            editScheduleRecord.style.marginLeft = '130px';
            collapseNavbarBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm10.25.75a.75.75 0 0 0 0-1.5H6.56l1.22-1.22a.75.75 0 0 0-1.06-1.06l-2.5 2.5a.75.75 0 0 0 0 1.06l2.5 2.5a.75.75 0 1 0 1.06-1.06L6.56 8.75h4.69Z" clip-rule="evenodd" /></svg>';

            removeTooltips();
        }
    });
</script>

</body>
</html>

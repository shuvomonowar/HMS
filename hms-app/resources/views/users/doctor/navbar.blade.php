<div class="fixed text-black mr-8 rounded-lg shadow-md h-[35rem] transition-all duration-300 navbar bg-gray-300 collapsed" id="navbarContainer" style="width: 80px;">
    <style>
        .navbar {
            width: 80px;
        }
        .navbar-item {
            display: flex;
            align-items: center;
        }
        .navbar-item img {
            width: 25px;
            height: 25px;
        }
        .collapsed .navbar-item .item-text {
            display: none;
        }
    </style>
    <nav id="navbarMenu" class="transition-all duration-300">
        <ul class="gap-4">
            <a href="{{ route('doctor_user.dashboard', ['username' => Session::get('username')]) }}">
                <li class="px-6 py-3 transition duration-300 navbar-item">
                    <span class="item-text font-thin text-lg text-blue-500">Dashboard</span>
                </li>
            </a>
            <a href="{{ route('doctor_user.schedule_record', session('username')) }}" class="navbar-items" data-tooltip="Schedule Record">
                <li class="px-6 py-3 hover:bg-gray-300 transition duration-300 navbar-item flex items-center">
                    <img src="{{ asset('images/navbar/schedule_record.png') }}" alt="View Icon" class="w-6 h-6 mr-2">
                    <span class="item-text font-thin">Schedule Record</span>
                </li>
            </a>

            <a href="{{ route('doctor_user.appointment_record', session('username')) }}" class="navbar-items" data-tooltip="Appointment Record">
                <li class="px-6 py-3 hover:bg-gray-300 transition duration-300 navbar-item flex items-center">
                    <img src="{{ asset('images/navbar/appointment_record.png') }}" alt="View Icon" class="w-6 h-6 mr-2">
                    <span class="item-text font-thin">Appointment Record</span>
                </li>
            </a>
            <a href="{{ route('doctor_user.logout') }}" class="navbar-items" data-tooltip="Logout">
                <li class="px-6 py-3 hover:bg-gray-300 transition duration-300 navbar-item flex items-center">
                    <img src="{{ asset('images/navbar/logout_icon.png') }}" alt="View Icon" class="w-6 h-6 mr-2">
                    <span class="item-text font-thin">Logout</span>
                </li>
            </a>
        </ul>
    </nav>
    <form id="logoutForm" action="{{ route('doctor_user.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <button id="collapseNavbar" class="absolute top-1/2 transform -translate-y-1/2 right-0 w-12 text-center px-3 py-2 border-l border-gray-200 hover:bg-gray-100 focus:outline-none opacity-50 mt-[16rem]">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5">
            <path fill-rule="evenodd" d="M15 8A7 7 0 1 0 1 8a7 7 0 0 0 14 0ZM4.75 7.25a.75.75 0 0 0 0 1.5h4.69L8.22 9.97a.75.75 0 1 0 1.06 1.06l2.5-2.5a.75.75 0 0 0 0-1.06l-2.5-2.5a.75.75 0 0 0-1.06 1.06l1.22 1.22H4.75Z" clip-rule="evenodd" />
        </svg>
    </button>
</div>
{{--<script>
    const collapseNavbarBtn = document.getElementById('collapseNavbar');
    const navbarContainer = document.getElementById('navbarContainer');
    const collapseIcon = document.getElementById('collapseIcon');

    collapseNavbarBtn.addEventListener('click', function () {
        navbarContainer.classList.toggle('collapsed');
        if (navbarContainer.classList.contains('collapsed')) {
            navbarContainer.style.width = '80px';
            employeeRecordContainer.style.marginLeft = '150px';
            collapseIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M15 8A7 7 0 1 0 1 8a7 7 0 0 0 14 0ZM4.75 7.25a.75.75 0 0 0 0 1.5h4.69L8.22 9.97a.75.75 0 1 0 1.06 1.06l2.5-2.5a.75.75 0 0 0 0-1.06l-2.5-2.5a.75.75 0 0 0-1.06 1.06l1.22 1.22H4.75Z" clip-rule="evenodd" /></svg>';
        } else {
            navbarContainer.style.width = 'auto';
            employeeRecordContainer.style.marginLeft = '255px';
            collapseIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm10.25.75a.75.75 0 0 0 0-1.5H6.56l1.22-1.22a.75.75 0 0 0-1.06-1.06l-2.5 2.5a.75.75 0 0 0 0 1.06l2.5 2.5a.75.75 0 1 0 1.06-1.06L6.56 8.75h4.69Z" clip-rule="evenodd" /></svg>';
        }
    });
</script>--}}

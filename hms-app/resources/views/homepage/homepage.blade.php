<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMS</title>
    @vite('resources/css/app.css')
</head>
<body>
    <!-- Header -->
    @include('compulsory.header')

    <!-- Content -->
    <div class="mt-[6rem] ml-[2rem]">
        <nav class="w-[50rem] flex flex-2 gap-7 mb-3 items-center px-4 py-2">
            <a href="{{ route('system_admin.login') }}">
                <button type="button" class="inline-flex items-center justify-center py-2 px-4 bg-blue-500 hover:bg-blue-700 text-white rounded-lg font-medium">
                    <img src="{{ asset('images/homepage/admin.png') }}" alt="System Admin" class="w-6 h-6 mr-2">
                    <span class="text-lg text-white">System Admin Login</span>
                </button>
            </a>
            <a href="{{ route('receptionist_user.login') }}">
                <button type="button" class="inline-flex items-center justify-center py-2 px-4 bg-green-500 hover:bg-green-700 text-white rounded-lg font-medium">
                    <img src="{{ asset('images/homepage/receptionist.png') }}" alt="Receptionist" class="w-6 h-6 mr-2">
                    <span class="text-lg text-white">Receptionist Login</span>
                </button>
            </a>
            <a href="{{ route('doctor_user.login') }}">
                <button type="button" class="inline-flex items-center justify-center py-2 px-4 bg-purple-500 hover:bg-purple-700 text-white rounded-lg font-medium">
                    <img src="{{ asset('images/homepage/doctor.png') }}" alt="Doctor" class="w-6 h-6 mr-2">
                    <span class="text-lg text-white">Doctor Login</span>
                </button>
            </a>
        </nav>
    </div>

    <!-- Footer -->
    <div class="mt-[33.6rem] bg-gray-200">
        @include('compulsory.footer')
    </div>

</body>
</html>

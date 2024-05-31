<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-blue-100 flex justify-center items-center min-h-screen">
<div class="bg-white p-6 sm:p-10 rounded-lg shadow-md max-w-md w-full">
    <h2 class="text-3xl font-medium mb-5 text-center text-blue-500 font-serif">System Admin Login</h2>
    <form action="{{ route('system_admin.login') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
            <input type="text" id="username" name="username" class="w-full px-3 py-2 border border-b-neutral-400 rounded-lg bg-gray-200 focus:outline-none focus:border-blue-500" value="{{ old('username') }}" required>
            @error('username')
            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-7 relative">
            <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
            <div class="relative">
                <input type="password" id="password" name="password" class="w-full px-3 py-2 bg-gray-200 border border-b-neutral-400 rounded-lg focus:outline-none pr-10 focus:border-blue-500" value="{{ old('password') }}" required>
                <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 mx-3 focus:outline-none">
                    <img src="{{ asset('images/login/show_icon.png') }}" alt="Show Password" class="w-5 h-5">
                </button>
            </div>
            @error('password')
            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="user" class="block text-sm font-medium mb-1">Login As</label>
            <select id="user" name="user" class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500" required>
                <option value="">Select User</option>
                <option value="System Admin">System Admin</option>
                <option value="Receptionist">Receptionist</option>
                <option value="Doctor">Doctor</option>
            </select>
        </div>
        <div class="flex justify-center mb-2">
            <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none text-lg font-bold">Login</button>
        </div>
        @error('message')
        <div class="text-red-500 text-xs mt-2 text-center">{{ $message }}</div>
        @enderror
    </form>
</div>
<script>
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

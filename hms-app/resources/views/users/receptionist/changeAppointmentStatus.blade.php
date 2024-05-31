<div class="w-[30rem] ml-[2rem] overflow-y-auto max-h-[73vh] mx-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
    <div>
        <span id="closeStatusModalBtn" class="cursor-pointer inline-block transition-transform duration-300 transform-gpu hover:rotate-90">
            <img src="{{ asset('images/appointment/close.png') }}" alt="Close Icon" class="w-7 h-7">
        </span>
    </div>
    <div class="grid mb-7">
        <h1 class="text-2xl font-medium text-center mb-4 text-blue-500">Change Appointment Status</h1>
        <hr class="border-opacity-50 border-blue-600 w-full mb-6">
    </div>
    <div class="flex flex-col">
        <div class="mb-2">
            <label for="appointment_status" class="block text-sm font-medium mb-1">Appointment Status</label>
            <select id="appointment_status" name="appointment_status"
                    class="form-select focus:bg-white w-[25rem] rounded-md px-3 py-2 border border-b-neutral-400 bg-white focus:outline-none focus:border-blue-500"
                    required>
                <option value="">Select Status</option>
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
            </select>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md" id="submit_status_btn">Update Status
            </button>
        </div>
    </div>
</div>

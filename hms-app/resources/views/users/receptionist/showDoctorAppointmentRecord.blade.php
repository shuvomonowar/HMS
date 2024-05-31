<div class="w-[70rem] ml-[2rem] overflow-y-auto max-h-[73vh] mx-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
    <div class="mt-5">
        <span id="closeModalBtn" class="cursor-pointer inline-block transition-transform duration-300 transform-gpu hover:rotate-90">
            <img src="{{ asset('images/appointment/close.png') }}" alt="Close Icon" class="w-7 h-7">
        </span>
    </div>
    <div class="grid mb-7">
        <h1 class="text-2xl font-medium text-center mb-4 text-blue-500">Appointment List</h1>
        <hr class="border-opacity-50 border-blue-600 mb-6 mr-[3.5rem]">
    </div>
    <div
        class="h-[35rem] flex-1 bg-white rounded-lg shadow-md overflow-x-auto table-container border border-blue-100 mr-[3.9rem] overflow-y-scroll scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <!-- Table Headers -->
            <thead class="table-header">
            <tr>
                <!-- Add your table headers here -->
                <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                </th>
                <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    SL
                </th>
                {{--                <th class="px-4 py-2 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>--}}
                <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Patient ID
                </th>
                <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Patient Name
                </th>
                <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Doctor ID
                </th>
                <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Doctor Name
                </th>
                <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Appointment Date
                </th>
                <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Appointment Day
                </th>
                <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Appointment Time
                </th>
                <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Appointment Serial
                </th>
                <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Reason
                </th>
                <th class="px-4 py-2 bg-gray-100 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Assigned Date-Time
                </th>
            </tr>
            </thead>
            <!-- Table Body -->
            <tbody id="doctorAppointmentRecordTables" class="bg-white divide-y divide-gray-200">
            @include('users.receptionist.showDoctorAppointmentRecordTable', ['doctorAppointmentRecords' => $doctorAppointmentRecords])
            </tbody>
        </table>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmationModal"
         class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="mb-4">
                <p class="text-lg font-semibold">Are you sure you want to delete this appointment record?</p>
            </div>
            <div class="flex justify-end">
                <button id="cancelDeleteBtn"
                        class="bg-gray-400 hover:bg-gray-500 text-white py-2 px-4 rounded mr-2 focus:outline-none">Cancel
                </button>
                <button id="confirmDeleteBtn"
                        class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded focus:outline-none">Delete
                </button>
            </div>
        </div>
    </div>
</div>

{{--<script>
    // Add event listener to the close icon
    document.getElementById('closeModalBtn').addEventListener('click', function () {
        // Reload the page
        location.reload();
    });
</script>--}}

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script>
    const confirmationModal = document.getElementById('deleteConfirmationModal');
    const confirmBtn = document.getElementById('confirmDeleteBtn');
    const cancelBtn = document.getElementById('cancelDeleteBtn');

    // Delete Patient Appointment Record
    function deleteDoctorAppointmentRecord(appointmentId) {
        confirmationModal.classList.remove('hidden');

        function confirmDelete() {
            $.ajax({
                url: `/user/receptionist/doctor_record/appointment_record/${appointmentId}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.success) {
                        $(`#doctorAppointmentRecordTables tr[data-id='${appointmentId}']`).remove();

                        Command: toastr["success"]("The appointment record is deleted successfully.", "Success")

                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    } else {
                        Command: toastr["error"]("Something went wrong to delete this appointment record.", "Error")

                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                },
                error: function (error) {
                    console.error('Error:', error);
                    Command: toastr["error"]("Something went wrong to delete this appointment record.", "Error")

                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                },
                complete: function () {
                    confirmBtn.removeEventListener('click', confirmDelete);
                    cancelBtn.removeEventListener('click', cancelDelete);

                    confirmationModal.classList.add('hidden');
                }
            });
        }

        function cancelDelete() {
            confirmBtn.removeEventListener('click', confirmDelete);
            cancelBtn.removeEventListener('click', cancelDelete);

            confirmationModal.classList.add('hidden');
        }

        confirmBtn.addEventListener('click', confirmDelete);
        cancelBtn.addEventListener('click', cancelDelete);
    }
</script>

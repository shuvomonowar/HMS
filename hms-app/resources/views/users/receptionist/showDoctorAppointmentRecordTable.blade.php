@php use Carbon\Carbon; @endphp
    <!-- Add your table rows here -->
@foreach($doctorAppointmentRecord as $key => $appointment)
    <tr data-id="{{ $appointment->id }}">
        {{--<td class="px-4 py-4 whitespace-no-wrap w-1/10 border-r border-b border-t border-r-gray-300 border-gray-200 border-t-blue-100">
            <div class="flex gap-4 ml-[0.6rem]">
                --}}{{--<a href="{{ route("receptionist_user.patient_record.edit_appointment.edit", $appointment->id) }}" data-tippy-content="Edit Appointment" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none">
                    <button>
                        <img src="{{ asset('images/record/edit.png') }}" alt="Edit Icon" class="w-6 h-6">
                    </button>
                </a>--}}{{--
                --}}{{--<button onclick="deleteDoctorAppointmentRecord({{ $appointment->id }})" data-tippy-content="Delete Appointment" class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none">
                    <img src="{{ asset('images/record/delete.png') }}" alt="Delete Icon" class="w-5 h-5">
                </button>--}}{{--
            </div>
        </td>--}}
        <td class="px-6 py-4 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $key + 1 }}</td>
        {{--        <td class="px-4 py-2 whitespace-no-wrap w-1/10">{{ $appointment->id }}</td>--}}
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $appointment->doctor_id }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $appointment->doctor_name }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $appointment->patient_id }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $appointment->patient_name }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $appointment->appointment_date }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $appointment->appointment_day }}</td>
        {{--<td class="px-4 py-2 whitespace-no-wrap w-1/10">{{ $appointment->appointment_time }}</td>--}}
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ date('h:i A', strtotime($appointment->appointment_time)) }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $appointment->appointment_serial }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $appointment->reason }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border-l border-t border-b border-gray-200 border-t-blue-100">{{ Carbon::parse($appointment->created_at)->format('Y-m-d h:i A') }}</td>
    </tr>
@endforeach

<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        tippy('[data-tippy-content]');
    });

</script>

<script>
    /*// AJAX Setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /!*const confirmationModal = document.getElementById('deleteConfirmationModal');
    const confirmBtn = document.getElementById('confirmDeleteBtn');
    const cancelBtn = document.getElementById('cancelDeleteBtn');*!/

    // Delete Patient Appointment Record
    function deleteDoctorAppointmentRecord(appointmentId) {
        /!*confirmationModal.classList.remove('hidden');*!/

        function confirmDelete() {
            $.ajax({
                url: `/user/receptionist/doctor_record/appointment_record/${appointmentId}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{--{{ csrf_token() }}--}}'
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
                /!*complete: function () {
                    confirmBtn.removeEventListener('click', confirmDelete);
                    cancelBtn.removeEventListener('click', cancelDelete);

                    confirmationModal.classList.add('hidden');
                }*!/
            });
        }

        /!*function cancelDelete() {
            confirmBtn.removeEventListener('click', confirmDelete);
            cancelBtn.removeEventListener('click', cancelDelete);

            confirmationModal.classList.add('hidden');
        }

        confirmBtn.addEventListener('click', confirmDelete);
        cancelBtn.addEventListener('click', cancelDelete);*!/
    }*/
</script>

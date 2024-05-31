const confirmationModal = document.getElementById('deleteConfirmationModal');
const confirmBtn = document.getElementById('confirmDeleteBtn');
const cancelBtn = document.getElementById('cancelDeleteBtn');

// Delete Patient Appointment Record
function deletePatientAppointment(appointmentId) {
    confirmationModal.classList.remove('hidden');

    function confirmDelete() {
        $.ajax({
            url: `/user/receptionist/patient_record/appointment_record${appointmentId}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.success) {
                    $(`#patientAppointmentRecordTable tr[data-id='${appointmentId}']`).remove();

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

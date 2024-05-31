function deletePatient(patientId) {
    confirmationModal.classList.remove('hidden');

    function confirmDelete() {
        $.ajax({
            url: `/receptionist_user/patient_record/${patientId}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.success) {
                    $(`#patientRecordTable tr[data-id='${patientId}']`).remove();

                    Command: toastr["success"]("The patient record is deleted successfully.", "Success")

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
                    Command: toastr["error"]("Something went wrong to delete this patient record.", "Error")

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
                Command: toastr["error"]("Something went wrong to delete this patient record.", "Error")

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

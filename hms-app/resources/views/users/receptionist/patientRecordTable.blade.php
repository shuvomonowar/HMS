@php use Carbon\Carbon; @endphp
    <!-- Add your table rows here -->
@foreach($patientRecords as $key => $patient)
    <tr data-id="{{ $patient->id }}">
        <td class="px-3 py-4 w-full border-r border-b border-t border-r-gray-300 border-gray-200 border-t-blue-100">
            <div class="flex gap-4">
                <a href="{{ route("receptionist_user.edit_patient.edit", $patient->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none" data-tippy-content="Edit Patient">
                    {{--<img src="{{ asset('images/record/edit.png') }}" alt="Edit Icon" class="w-6 h-6">--}}
                    <button>
                        <img src="{{ asset('images/record/edit.png') }}" alt="Edit Icon" class="w-6 h-6">
                    </button>
                </a>
                <button onclick="deletePatient({{ $patient->id }})" data-tippy-content="Delete Patient" class="bg-red-500 hover:bg-red-700 text-white py-1 px-[0.5rem] rounded focus:outline-none">
                    <img src="{{ asset('images/record/delete.png') }}" alt="Delete Icon" class="w-6 h-5">
                </button>
                <a href="{{ route("receptionist_user.patient_record.appointment_record.show", $patient->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none" data-tippy-content="View Appointment">
                    {{--<img src="{{ asset('images/patient/appointment.png') }}" alt="Appointment Icon" class="w-6 h-6">--}}
                    <button>
                        <img src="{{ asset('images/patient/appointment.png') }}" alt="Appointment Icon" class="w-6 h-6">
                    </button>
                </a>
                <a href="{{ route("receptionist_user.patient_record.test_record.show", $patient->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-1 rounded focus:outline-none" data-tippy-content="View Test">
                    {{--<img src="{{ asset('images/patient/appointment.png') }}" alt="Appointment Icon" class="w-6 h-6">--}}
                    <button>
                        <img src="{{ asset('images/test/test.png') }}" alt="Appointment Icon" class="w-8 h-6">
                    </button>
                </a>
            </div>
        </td>
        <td class="px-6 py-4 border border-gray-200 border-t-blue-100">{{ $key + 1 }}</td>
        {{--<td class="px-4 py-2">{{ $patient->id }}</td>--}}
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $patient->first_name }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $patient->last_name }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $patient->gender }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $patient->blood_group }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $patient->birth_date }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $patient->age }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $patient->address }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $patient->phone_number }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $patient->email }}</td>
        {{--<td class="px-4 py-2 border-l border-t border-b border-gray-200 border-t-blue-100">{{ $patient->created_at }}</td>--}}
        <td class="px-4 py-2 border-l border-t border-b border-gray-200 border-t-blue-100">{{ Carbon::parse($patient->created_at)->format('Y-m-d h:i A') }}</td>
    </tr>
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function() {
        tippy('[data-tippy-content]');
    });
</script>

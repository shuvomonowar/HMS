@php use Carbon\Carbon; @endphp
<!-- Add your table rows here -->
@foreach($patientAppointmentRecords as $key => $appointment)
    <tr data-id="{{ $appointment->id }}">
        <td class="px-4 py-4 whitespace-no-wrap w-1/6 border-r border-b border-t border-r-gray-300 border-gray-200 border-t-blue-100">
            <div class="flex gap-4 ml-[1.2rem]">
                {{--<a href="{{ route("receptionist_user.patient_record.edit_appointment.edit", $appointment->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none">
                    <button>
                        <img src="{{ asset('images/record/edit.png') }}" alt="Edit Icon" class="w-6 h-6">
                    </button>
                </a>
                <button onclick="deletePatientAppointment({{ $appointment->id }})" class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none">
                    <img src="{{ asset('images/record/delete.png') }}" alt="Delete Icon" class="w-5 h-5">
                </button>--}}
                <a href="{{ route("receptionist_user.patient_record.edit_appointment.edit", $appointment->id) }}" data-tippy-content="Edit Appointment" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none">
                    <button>
                        <img src="{{ asset('images/record/edit.png') }}" alt="Edit Icon" class="w-6 h-6">
                    </button>
                </a>
                <button onclick="deletePatientAppointment({{ $appointment->id }})" data-tippy-content="Delete Appointment" class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none">
                    <img src="{{ asset('images/record/delete.png') }}" alt="Delete Icon" class="w-5 h-5">
                </button>
                {{--<button type="button" id="changeAppointmentStatusBtn" onclick="changeAppointmentStatus({{ $appointment->id }})" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none">
                    <img src="{{ asset('images/appointment/status.png') }}" alt="Status Icon" class="w-5 h-5">
                </button>--}}
                <a href="{{ route("receptionist_user.appointment_record.appointment_status.edit", $appointment->id) }}" data-tippy-content="Update Appointment Status" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none">
                    <button>
                        <img src="{{ asset('images/appointment/status.png') }}" alt="Edit Icon" class="w-6 h-6">
                    </button>
                </a>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $key + 1 }}</td>
        {{--        <td class="px-4 py-2 whitespace-no-wrap w-1/10">{{ $appointment->id }}</td>--}}
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $appointment->patient_id }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $appointment->doctor_name }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $appointment->appointment_date }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $appointment->appointment_day }}</td>
        {{--<td class="px-4 py-2 whitespace-no-wrap w-1/10">{{ $appointment->appointment_time }}</td>--}}
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ date('h:i A', strtotime($appointment->appointment_time)) }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $appointment->appointment_serial }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $appointment->reason }}</td>
        {{--<td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $appointment->status }}</td>--}}
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100"
            @if($appointment->status == 'Present')
                style="color: limegreen; font-weight: bold;"
            @elseif($appointment->status == 'Absent')
                style="color: red; font-weight: bold;"
            @else
                style="color: dodgerblue; font-weight: bold;"
            @endif
        >
            {{ $appointment->status }}
        </td>

        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border-l border-t border-b border-gray-200 border-t-blue-100">{{ Carbon::parse($appointment->created_at)->format('Y-m-d h:i A') }}</td>
    </tr>
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function() {
        tippy('[data-tippy-content]');
    });
</script>

@php use Carbon\Carbon; @endphp
    <!-- Add your table rows here -->
@foreach($doctorAppointmentRecords as $key => $appointment)
    @php
        // Fetch the doctor specialization corresponding to the appointment
        $doctor = $doctors->where('id', $appointment->doctor_id)->first();
    @endphp
    <tr data-id="{{ $appointment->id }}">
        <td class="px-6 py-4 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $key + 1 }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $appointment->doctor_id }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $appointment->doctor_name }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">
            <!-- Display doctor specialization -->
            @if($doctor)
                {{ $doctor->specialization }}
            @else
                Not Specified
            @endif
        </td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $appointment->patient_id }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $appointment->patient_name }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $appointment->appointment_date }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $appointment->appointment_day }}</td>
        {{--<td class="px-4 py-2 whitespace-no-wrap w-1/10">{{ $appointment->appointment_time }}</td>--}}
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ date('h:i A', strtotime($appointment->appointment_time)) }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $appointment->appointment_serial }}</td>
        {{--<td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $appointment->reason }}</td>--}}
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border-l border-t border-b border-gray-200 border-t-blue-100">{{ Carbon::parse($appointment->created_at)->format('Y-m-d h:i A') }}</td>
    </tr>
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function() {
        tippy('[data-tippy-content]');
    });
</script>

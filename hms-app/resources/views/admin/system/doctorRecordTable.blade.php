@php use Carbon\Carbon; @endphp
    <!-- Add your table rows here -->
@foreach($doctorRecords as $key => $doctor)
    <tr data-id="{{ $doctor->id }}">
        <td class="px-3 py-4 border-r border-b border-t border-r-gray-300 border-gray-200 border-t-blue-100">
            <div class="flex gap-4">
                <a href="{{ route("system_admin.edit_doctor.edit", $doctor->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none" data-tippy-content="Edit Doctor">
                    {{--<img src="{{ asset('images/record/edit.png') }}" alt="Edit Icon" class="w-6 h-6">--}}
                    <button>
                        <img src="{{ asset('images/record/edit.png') }}" alt="Edit Icon" class="w-6 h-6">
                    </button>
                </a>
                <button onclick="deleteDoctor({{ $doctor->id }})" data-tippy-content="Delete Doctor" class="bg-red-500 hover:bg-red-700 text-white py-1 px-[0.5rem] rounded focus:outline-none">
                    <img src="{{ asset('images/record/delete.png') }}" alt="Delete Icon" class="w-6 h-5">
                </button>
                <a href="{{ route("system_admin.schedule_record.show", $doctor->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none" data-tippy-content="View Schedule">
                    {{--<img src="{{ asset('images/patient/appointment.png') }}" alt="Appointment Icon" class="w-6 h-6">--}}
                    <button>
                        <img src="{{ asset('images/doctor/schedule.png') }}" alt="Schedule Icon" class="w-6 h-6">
                    </button>
                </a>
            </div>
        </td>
        <td class="px-6 py-4 border border-gray-200 border-t-blue-100">{{ $key + 1 }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $doctor->id }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $doctor->name }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $doctor->username }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $doctor->specialization }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $doctor->qualification }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $doctor->phone_number }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $doctor->email }}</td>
        {{--<td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $doctor->password }}</td>--}}
        <td class="px-4 py-2 border-l border-t border-b border-gray-200 border-t-blue-100">{{ Carbon::parse($doctor->created_at)->format('Y-m-d h:i A') }}</td>
    </tr>
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function() {
        tippy('[data-tippy-content]');
    });
</script>

@php use Carbon\Carbon; @endphp
<!-- Add your table rows here -->
@foreach($scheduleRecords as $key => $schedule)
    <tr data-id="{{ $schedule->id }}">
        <td class="px-4 py-4 whitespace-no-wrap w-1/6 border-r border-b border-t border-r-gray-300 border-gray-200 border-t-blue-100">
            <div class="flex gap-4 ml-[1.6rem]">
                <a href="{{ route("system_admin.edit_schedule.edit", $schedule->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none" data-tippy-content="Edit Schedule">
                    {{--<img src="{{ asset('images/record/edit.png') }}" alt="Edit Icon" class="w-6 h-6">--}}
                    <button>
                        <img src="{{ asset('images/record/edit.png') }}" alt="Edit Icon" class="w-6 h-6">
                    </button>
                </a>
                <button onclick="deleteSchedule({{ $schedule->id }})" data-tippy-content="Delete Schedule" class="bg-red-500 hover:bg-red-700 text-white py-1 px-[0.5rem] rounded focus:outline-none">
                    <img src="{{ asset('images/record/delete.png') }}" alt="Delete Icon" class="w-6 h-5">
                </button>
            </div>
        </td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $key + 1 }}</td>
        {{--<td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $schedule->doctor_id }}</td>--}}
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $schedule->schedule_day }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ Carbon::parse($schedule->start_time)->format('h:i A') }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ Carbon::parse($schedule->end_time)->format('h:i A') }}</td>
    </tr>
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function() {
        tippy('[data-tippy-content]');
    });
</script>

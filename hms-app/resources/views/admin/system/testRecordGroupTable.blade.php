@php use Carbon\Carbon; @endphp
    <!-- Add your table rows here -->
@foreach($patientTests as $key => $test)
    <tr data-id="{{ $test->id }}">
        <td class="px-4 py-4 whitespace-no-wrap w-1/6 border-r border-b border-t border-r-gray-300 border-gray-200 border-t-blue-100">
            <div class="flex gap-4 ml-[3rem]">
                {{--<a href="{{ route("receptionist_user.patient_record.test_record.edit_test.edit", $test->id) }}" data-tippy-content="Edit test" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none">
                    <button>
                        <img src="{{ asset('images/record/edit.png') }}" alt="Edit Icon" class="w-6 h-6">
                    </button>
                </a>--}}
                <button onclick="deletePatientTest({{ $test->id }})" data-tippy-content="Delete test" class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none">
                    <img src="{{ asset('images/record/delete.png') }}" alt="Delete Icon" class="w-5 h-5">
                </button>
                <a href="{{ route("system_admin.patient_record.test_records.show", $test->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-1 rounded focus:outline-none" data-tippy-content="View Test Records">
                    <button>
                        <img src="{{ asset('images/test/test.png') }}" alt="Appointment Icon" class="w-8 h-6">
                    </button>
                </a>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $key + 1 }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $test->patient_id }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $test->patient_name }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $test->app_doc_id }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $test->app_doc_name }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border-l border-t border-b border-gray-200 border-t-blue-100">{{ Carbon::parse($test->created_at)->format('Y-m-d h:i A') }}</td>
    </tr>
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function() {
        tippy('[data-tippy-content]');
    });
</script>

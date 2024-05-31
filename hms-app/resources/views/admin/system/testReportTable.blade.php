<!-- Add your table rows here -->
@foreach($patientTestReports as $key => $report)
    <tr data-id="{{ $report->id }}">
        <td class="px-3 py-4 border-r border-b border-t border-r-gray-300 border-gray-200 border-t-blue-100">
            <div class="flex gap-4">
                <a href="{{ route("receptionist_user.patient_record.test_record.edit_test.edit", $report->id) }}" data-tippy-content="Download Test Report" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2.5 rounded focus:outline-none">
                    <button>
                        <img src="{{ asset('images/report/download.png') }}" alt="Edit Icon" class="w-7 h-5">
                    </button>
                </a>
                <button onclick="deletePatientTestReport({{ $report->id }})" data-tippy-content="Delete Test Report" class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none">
                    <img src="{{ asset('images/record/delete.png') }}" alt="Delete Icon" class="w-7 h-5">
                </button>
                <a href="{{ route("receptionist_user.patient_record.test_record.edit_test.edit", $report->id) }}" data-tippy-content="Edit Test Report" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2.5 rounded focus:outline-none">
                    <button>
                        <img src="{{ asset('images/report/edit.png') }}" alt="Edit Icon" class="w-7 h-5">
                    </button>
                </a>
            </div>
        </td>
        <td class="px-6 py-4 border border-gray-200 border-t-blue-100">{{ $key + 1 }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $report->patient_id }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $report->patient_test_id }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $report->id }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">
            @foreach($report->test_category as $index => $category)
                {{ $index + 1 }}. {{ $category }}<br>
            @endforeach
        </td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">
            @foreach($report->test_name as $index => $name)
                {{ $index + 1 }}. {{ $name }}<br>
            @endforeach
        </td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $report->app_doc_id }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $report->app_doc_name }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $report->test_delivery_date }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100 text-green-500 font-bold">{{ $report->test_status }}</td>
    </tr>
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function() {
        tippy('[data-tippy-content]');
    });
</script>

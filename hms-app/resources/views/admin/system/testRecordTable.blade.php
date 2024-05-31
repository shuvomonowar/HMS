<!-- Add your table rows here -->
@foreach($patientTestRecords as $key => $test)
    <tr data-id="{{ $test->id }}">
        <td class="px-4 py-4 whitespace-no-wrap w-1/6 border-r border-b border-t border-r-gray-300 border-gray-200 border-t-blue-100">
            <div class="flex gap-4 ml-[2.5rem]">
                <a href="{{ route("system_admin.patient_record.test_record.edit_test.edit", $test->id) }}" data-tippy-content="Edit test" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none">
                    <button>
                        <img src="{{ asset('images/record/edit.png') }}" alt="Edit Icon" class="w-6 h-6">
                    </button>
                </a>
                <button onclick="deletePatientTests({{ $test->id }})" data-tippy-content="Delete test" class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none">
                    <img src="{{ asset('images/record/delete.png') }}" alt="Delete Icon" class="w-5 h-5">
                </button>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $key + 1 }}</td>
        {{--<td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $test->patient_test_id }}</td>--}}
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">
            @foreach($test->test_category as $index => $category)
                {{ $index + 1 }}. {{ $category }}<br>
            @endforeach
        </td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">
            @foreach($test->test_name as $index => $name)
                {{ $index + 1 }}. {{ $name }}<br>
            @endforeach
        </td>
        {{--<td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">
            @foreach($test->test_cost as $index => $cost)
                ({{ $index + 1 }}) {{ $cost }}<br>
            @endforeach
        </td>--}}
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $test->total_cost }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100">{{ $test->test_delivery_date }}</td>
        <td class="px-4 py-2 whitespace-no-wrap w-1/10 border border-gray-200 border-t-blue-100 text-green-500 font-bold">{{ $test->test_status }}</td>
    </tr>
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function() {
        tippy('[data-tippy-content]');
    });
</script>

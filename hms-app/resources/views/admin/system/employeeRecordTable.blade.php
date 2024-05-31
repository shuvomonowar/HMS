@php use Carbon\Carbon; @endphp
<!-- Add your table rows here -->
@foreach($employeeRecords as $key => $employee)
    <tr data-id="{{ $employee->id }}">
        <td class="px-3 py-4 w-full border-r border-b border-t border-r-gray-300 border-gray-200 border-t-blue-100">
            <div class="flex">
                    <a href="{{ route("system_admin.edit_employee.edit", $employee->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none">
                        <button>
                            <img src="{{ asset('images/record/edit.png') }}" alt="Edit Icon" class="w-5 h-5 mr-5">
                        </button>
                    </a>
                <button onclick="deleteEmployee({{ $employee->id }})" class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none ml-2">
                    <img src="{{ asset('images/record/delete.png') }}" alt="Delete Icon" class="w-5 h-5 mr-5">
                </button>
            </div>
        </td>
        <td class="px-6 py-4 border border-gray-200 border-t-blue-100">{{ $key + 1 }}</td>
        {{--<td class="px-4 py-2 whitespace-no-wrap w-1/12">{{ $employee->id }}</td>--}}
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $employee->first_name }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $employee->last_name }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $employee->username }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $employee->department }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $employee->salary }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $employee->hire_date }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $employee->designation }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $employee->employment_type }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $employee->gender }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $employee->birth_date }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $employee->address }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $employee->nid }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $employee->phone }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $employee->email }}</td>
        <td class="px-4 py-2 border border-gray-200 border-t-blue-100">{{ $employee->password }}</td>
        <td class="px-4 py-2 border-l border-t border-b border-gray-200 border-t-blue-100">{{ Carbon::parse($employee->created_at)->format('Y-m-d h:i A') }}</td>
    </tr>
@endforeach

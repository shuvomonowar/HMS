<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\System\EmployeeRecordRequest;
use App\Models\Admin\System\EmployeeRecord;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmployeeRecordController extends Controller
{
    /**
     * Display a listing of the employee records.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $employeeRecords = EmployeeRecord::all();
        return view('admin.system.employeeRecord', compact('employeeRecords'));
    }

    /**
     * Show the form for creating a new employee record.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        return view('admin.system.addNewEmployee');
    }

    /**
     * Store a newly created employee record in storage.
     *
     * @param EmployeeRecordRequest $request
     * @return RedirectResponse
     */
    /*public function store(EmployeeRecordRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        try {
            $employeeRecord = new EmployeeRecord($validatedData);
            $isSaved = $employeeRecord->save();

            if ($isSaved) {
                return redirect()->route('system_admin.employee_record')->with('success', 'Employee record created successfully.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Failed to create new employee record. Please try again.');
            }
        } catch (Exception $e) {
            // Log::error('Error creating employee record: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to create new employee record. Please try again.');
        }
    }*/

    public function store(EmployeeRecordRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        try {
            // Check if the username already exists
            $existingUsername = EmployeeRecord::where('username', $validatedData['username'])->exists();
            if ($existingUsername) {
                return redirect()->back()->withInput()->with('add_employee_error', 'Username is already taken. Please choose a different username.');
            }

            $employeeRecord = EmployeeRecord::create($validatedData);

            if ($employeeRecord) {
                return redirect()->route('system_admin.employee_record')->with('add_employee_success', 'Employee record created successfully.');
            } else {
                return redirect()->back()->withInput()->with('add_employee_error', 'Failed to create new employee record. Please try again.');
            }
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('add_employee_error', 'Failed to create new employee record. Please try again.');
        }
    }

    /**
     * Display the specified employee record.
     *
     * @param EmployeeRecord $employeeRecord
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    /*public function show(EmployeeRecord $employeeRecord): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('admin.system.employee_records.show', compact('employeeRecord'));
    }*/

    /**
     * Show the form for editing the specified employee record.
     *
     * @param EmployeeRecord $employeeRecord
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function edit(EmployeeRecord $employeeRecord): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('admin.system.editEmployeeRecord', compact('employeeRecord'));
    }

    /**
     * Update the specified employee record in storage.
     *
     * @param EmployeeRecordRequest $request
     * @param EmployeeRecord $employeeRecord
     * @return RedirectResponse
     */
    public function update(EmployeeRecordRequest $request, EmployeeRecord $employeeRecord): RedirectResponse
    {
        $validatedData = $request->validated();
        $employeeRecord->update($validatedData);
        return redirect()->route('system_admin.employee_record')->with('edit_employee_success', 'Employee record updated successfully.');
    }

    /**
     * Remove the specified employee record from storage.
     *
     * @param EmployeeRecord $employeeRecord
     * @return JsonResponse
     */
    public function destroy(EmployeeRecord $employeeRecord): JsonResponse
    {
        $employeeRecord->delete();

        return response()->json(['success' => 'Employee record deleted successfully']);
    }


    /**
     * Search all patient records from the storage.
     * @param Request $request
     * @return string
     */
    public function search(Request $request): string
    {
        $searchQuery = $request->search_string;

        $employeeRecords = EmployeeRecord::where('first_name', 'like', '%' . $searchQuery . '%')
            ->orWhere('last_name', 'like', '%' . $searchQuery . '%')
            ->orWhere('username', 'like', '%' . $searchQuery . '%')
            ->orWhere('department', 'like', '%' . $searchQuery . '%')
            ->orWhere('designation', 'like', '%' . $searchQuery . '%')
//            ->orWhere('id', 'like', '%' . $searchQuery . '%')
            ->orWhere('salary', 'like', '%' . $searchQuery . '%')
            ->orWhere('employment_type', 'like', '%' . $searchQuery . '%')
            ->orWhere('gender', 'like', '%' . $searchQuery . '%')
            ->orWhere('address', 'like', '%' . $searchQuery . '%')
            ->orWhere('nid', 'like', '%' . $searchQuery . '%')
            ->orWhere('phone', 'like', '%' . $searchQuery . '%')
            ->orWhere('email', 'like', '%' . $searchQuery . '%')
            ->orWhere('password', 'like', '%' . $searchQuery . '%')
            ->orWhereDate('hire_date', $searchQuery)
            ->orWhereDate('birth_date', $searchQuery)
            ->get();

        if ($employeeRecords->count() >= 1) {
            return view('admin.system.employeeRecordTable', compact('employeeRecords'))->render();
        } else {
            return '<tr><td colspan="13" class="text-center py-4 text-red-500 text-lg">No record found.</td></tr>';
        }
    }
}


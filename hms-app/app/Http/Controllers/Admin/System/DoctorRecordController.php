<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\System\DoctorRecordRequest;
use App\Models\Users\Doctor\DoctorRecord;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorRecordController extends Controller
{
    /**
     * Display a listing of the doctor records.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $doctorRecords = DoctorRecord::all();
        return view('admin.system.doctorRecord', compact('doctorRecords'));
    }

    /**
     * Show the form for creating a new doctor record.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        return view('admin.system.addDoctorRecord');
    }

    /**
     * Store a newly created patient record in storage.
     *
     * @param DoctorRecordRequest $request
     * @return RedirectResponse
     */
    public function store(DoctorRecordRequest $request, DoctorRecord $doctorRecord): RedirectResponse
    {
        $validatedData = $request->validated();

        try {
            // Check if the username already exists
            $existingUsername = DoctorRecord::where('username', $validatedData['username'])->exists();
            if ($existingUsername) {
                return redirect()->back()->withInput()->with('add_doctor_error', 'Username is already taken. Please choose a different username.');
            }

            $doctorRecord = $doctorRecord->create([
                'name' => $validatedData['name'],
                'username' => $validatedData['username'],
                'specialization' => $validatedData['specialization'],
                'qualification' => $validatedData['qualification'],
                'phone_number' => $validatedData['phone_number'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            if ($doctorRecord) {
                return redirect()->route('system_admin.doctor_record')->with('add_doctor_success', 'Doctor record created successfully.');
            } else {
                return redirect()->back()->withInput()->with('add_doctor_error', 'Failed to create new doctor record. Please try again.');
            }
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('add_doctor_error', 'Failed to create new doctor record. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified patient record.
     *
     * @param DoctorRecord $doctorRecord
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function edit(DoctorRecord $doctorRecord): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('admin.system.editDoctorRecord', compact('doctorRecord'));
    }

    /**
     * Update the specified patient record in storage.
     *
     * @param DoctorRecordRequest $doctorRecordRequest
     * @param DoctorRecord $doctorRecord
     * @return RedirectResponse
     */
    public function update(DoctorRecordRequest $doctorRecordRequest, DoctorRecord $doctorRecord): RedirectResponse
    {
        $validatedData = $doctorRecordRequest->validated();

        try {
            // Store the data in the database
            $doctorRecord = $doctorRecord->update([
                'name' => $validatedData['name'],
                'username' => $validatedData['username'],
                'specialization' => $validatedData['specialization'],
                'qualification' => $validatedData['qualification'],
                'phone_number' => $validatedData['phone_number'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            if ($doctorRecord) {
                return redirect()->route('system_admin.doctor_record')->with('edit_doctor_success', 'Doctor record updated successfully.');
            } else {
                // dd($doctorRecord);
                return redirect()->route('system_admin.doctor_record')->with('edit_doctor_error', 'Error to update doctor record.');
            }
        } catch (Exception $e) {
            dd($e);
            // return redirect()->back()->withInput()->with('edit_doctor_error', 'Failed to edit doctor record. Please try again.');
        }
    }

    /**
     * Remove the specified doctor record from storage.
     *
     * @param DoctorRecord $doctorRecord
     * @return JsonResponse
     */
    public function destroy(DoctorRecord $doctorRecord): JsonResponse
    {
        $doctorRecord->delete();

        return response()->json(['success' => 'Doctor record deleted successfully']);
    }

    /**
     * Search doctor record from the storage.
     * @param Request $request
     * @return string
     */

    public function search(Request $request): string
    {
        $searchQuery = $request->search_string;

        $doctorRecords = DoctorRecord::where('name', 'like', '%' . $searchQuery . '%')
            ->orWhere('specialization', 'like', '%' . $searchQuery . '%')
            ->orWhere('qualification', 'like', '%' . $searchQuery . '%')
            ->orWhere('phone_number', 'like', '%' . $searchQuery . '%')
            ->orWhere('email', 'like', '%' . $searchQuery . '%')
            ->orWhereDate('created_at', $searchQuery)
            ->get();

        if ($doctorRecords->count() >= 1) {
            return view('admin.system.doctorRecordTable', compact('doctorRecords'))->render();
        } else {
            return '<tr><td colspan="13" class="text-center py-4 text-red-500 text-lg">No record found.</td></tr>';
        }
    }

    /**
     * Retrieve id using phone number.
     */
    public function searchByDoctorName(Request $request): JsonResponse
    {
        // Retrieve the doctor name from the request
        $doctorName = $request->input('doctor_name');

        // Query the database to find records with the given doctor name
        $records = DoctorRecord::where('name', $doctorName)->get();

        // Extract first name and last name, concatenate them, and store in an array
        $ids = [];
        foreach ($records as $record) {
            $doctorId = $record->id;
            $ids[] = $doctorId;
        }

        // Return the names as a JSON response
        return response()->json(['ids' => $ids]);
    }

    /**
     * Fetching patient name using patient id.
     */
    public function fetchDoctorSpecialization(Request $request): JsonResponse
    {
        // Retrieve the doctor ID from the request
        $doctorId = $request->input('doctor_id');

        // Fetch the doctor record based on the ID
        $doctorRecord = DoctorRecord::find($doctorId);
        $specialization = $doctorRecord->specialization;

        // Check if the doctor record exists
        if ($doctorRecord) {
            // If the doctor record exists, return the doctor name
            return response()->json(['specialization' => $specialization]);
        } else {
            // If the patient record does not exist, return an error or handle the case accordingly
            return response()->json(['error' => 'Doctor not found'], 404);
        }
    }
}

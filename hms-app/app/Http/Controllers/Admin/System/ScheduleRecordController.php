<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\System\ScheduleRecordRequest;
use App\Models\Users\Doctor\ScheduleRecord;
use App\Models\Users\Receptionist\PatientRecord;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ScheduleRecordController extends Controller
{
    /**
     * Display a listing of the schedules.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $scheduleRecords = ScheduleRecord::all();
        return view('admin.system.scheduleRecord', compact('scheduleRecords'));
    }

    /**
     * Retrieve all schedule record for a given doctor.
     *
     * @param int $doctorId
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function show(int $doctorId): \Illuminate\Foundation\Application|View|Factory|Application
    {
        // Retrieve all schedule records for the given doctor
        $scheduleRecords = ScheduleRecord::where('doctor_id', $doctorId)->get();

        return view('admin.system.scheduleRecord', compact('scheduleRecords'), ['doctorID' => $doctorId]);
    }

    /**
     * Show the form for creating a new schedule record.
     *
     * @param int $doctorID
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(int $doctorID): \Illuminate\Foundation\Application|View|Factory|Application
    {
        return view('admin.system.addScheduleRecord', ['doctorID' => $doctorID]);
    }

    /**
     * Store a newly created schedule record in storage.
     *
     * @param ScheduleRecordRequest $request
     * @return RedirectResponse
     */
    public function store(ScheduleRecordRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        // Log::info("Schedule record: $validatedData");

        try {
            $start_time = date('H:i', strtotime($validatedData['start_time']));
            $end_time = date('H:i', strtotime($validatedData['end_time']));


            // Store the data in the database
            $scheduleRecord = ScheduleRecord::create([
                'doctor_id' => $validatedData['doctor_id'],
                'schedule_day' => $validatedData['schedule_day'],
                'start_time' => $start_time,
                'end_time' => $end_time,
            ]);

            if ($scheduleRecord) {
                return redirect()->route('system_admin.schedule_record.show', $validatedData['doctor_id'])->with('add_schedule_success', 'New schedule record created successfully.');
            } else {
                // dd($validatedData);
                return redirect()->back()->withInput()->with('add_schedule_error', 'Failed to create new schedule record. Please try again.');
            }
        } catch (Exception $e) {
            dd($e);
            // return redirect()->back()->withInput()->with('add_schedule_error', 'Failed to create new schedule record. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified schedule record.
     *
     * @param ScheduleRecord $scheduleRecord
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function edit(ScheduleRecord $scheduleRecord): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('admin.system.editScheduleRecord', compact('scheduleRecord'));
    }

    /**
     * Update the specified patient record in storage.
     *
     * @param ScheduleRecordRequest $scheduleRecordRequest
     * @param ScheduleRecord $scheduleRecord
     * @return RedirectResponse
     */
    public function update(ScheduleRecordRequest $scheduleRecordRequest, ScheduleRecord $scheduleRecord): RedirectResponse
    {
        $validatedData = $scheduleRecordRequest->validated();

        try {
            $start_time = date('H:i', strtotime($validatedData['start_time']));
            $end_time = date('H:i', strtotime($validatedData['end_time']));

            // Store the data in the database
            $scheduleRecord = $scheduleRecord->update([
                'doctor_id' => $validatedData['doctor_id'],
                'schedule_day' => $validatedData['schedule_day'],
                'start_time' => $start_time,
                'end_time' => $end_time,
            ]);

            if ($scheduleRecord) {
                return redirect()->route('system_admin.schedule_record.show', $validatedData['doctor_id'])->with('edit_schedule_success', 'Schedule record updated successfully.');
            } else {
                dd($scheduleRecord);
                // return redirect()->back()->withInput()->with('edit_schedule_error', 'Failed to edit schedule record. Please try again.');
            }
        } catch (Exception $e) {
            dd($e);
            // return redirect()->back()->withInput()->with('edit_schedule_error', 'Failed to edit schedule record. Please try again.');
        }
    }

    /**
     * Remove the specified schedule record from storage.
     *
     * @param ScheduleRecord $scheduleRecord
     * @return JsonResponse
     */
    public function destroy(ScheduleRecord $scheduleRecord): JsonResponse
    {
        $scheduleRecord->delete();

        return response()->json(['success' => 'Schedule record deleted successfully']);
    }

    /**
     * Search all patient records from the storage.
     * @param Request $request
     * @return string
     */

    public function search(Request $request, int $doctorID): string
    {
        $searchQuery = $request->search_string;

        $scheduleRecords = ScheduleRecord::where(function ($query) use ($searchQuery) {
            $query->where('schedule_day', 'like', '%' . $searchQuery . '%')
                ->orWhere('start_time', 'like', '%' . $searchQuery . '%')
                ->orWhere('end_time', 'like', '%' . $searchQuery . '%');
        })
            ->where('doctor_id', $doctorID)
            ->select('schedule_records.*')
            ->get();

        if ($scheduleRecords->count() >= 1) {
            return view('admin.system.scheduleRecordTable', compact('scheduleRecords'))->render();
        } else {
            return '<tr><td colspan="13" class="text-center py-4 text-red-500 text-lg">No record found.</td></tr>';
        }
    }

    /**
     * Retrieve id using phone number.
     */
    public function searchByPhoneNumber(Request $request): JsonResponse
    {
        // Retrieve the mobile number from the request
        $phoneNumber = $request->input('phone_number');

        // Query the database to find records with the given mobile number
        $records = PatientRecord::where('phone_number', $phoneNumber)->get();

        // Extract first name and last name, concatenate them, and store in an array
        $ids = [];
        foreach ($records as $record) {
            /*$fullName = $record->first_name . ' ' . $record->last_name;*/
            $patientId = $record->id;
            $ids[] = $patientId;
        }

        // Return the names as a JSON response
        return response()->json(['ids' => $ids]);
    }

    /**
     * Fetching patient name using patient id.
     */
    public function fetchPatientName(Request $request): JsonResponse
    {
        // Retrieve the patient ID from the request
        $patientId = $request->input('patient_id');

        // Fetch the patient record based on the ID
        $patientRecord = PatientRecord::find($patientId);
        $full_name = $patientRecord->first_name . ' ' . $patientRecord->last_name;

        // Check if the patient record exists
        if ($patientRecord) {
            // If the patient record exists, return the patient name
            return response()->json(['name' => $full_name]); // Assuming 'full_name' is a field in your Patient model
        } else {
            // If the patient record does not exist, return an error or handle the case accordingly
            return response()->json(['error' => 'Patient not found'], 404);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Receptionist\PatientRecordRequest;
use App\Models\Users\Doctor\DoctorRecord;
use App\Models\Users\Receptionist\AppointmentRecord;
use App\Models\Users\Receptionist\PatientRecord;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminPatientRecordController extends Controller
{
    /**
     * Display a listing of the patient records.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $patientRecords = PatientRecord::all(); // Fetch all patient records

        return view('admin.system.patientRecord', compact('patientRecords'));
    }

    /**
     * Show the form for creating a new patient record.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $doctors = DoctorRecord::all(); // Fetch all doctor records

        return view('admin.system.addPatientRecord', ['doctors' => $doctors]);
    }

    /**
     * Store a newly created patient record in storage.
     *
     * @param PatientRecordRequest $request
     * @return RedirectResponse
     */
    public function store(PatientRecordRequest $request): RedirectResponse
    {
        $validatedData = $request->validated(); // Validate the form data

        try {
            // Calculate age based on date of birth
            $dateOfBirth = Carbon::parse($validatedData['birth_date']);
            $age = $dateOfBirth->age;

            // Store the data in the database
            $patientRecord = PatientRecord::create([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'gender' => $validatedData['gender'],
                'blood_group' => $validatedData['blood_group'],
                'birth_date' => $validatedData['birth_date'],
                'age' => $age,
                'address' => $validatedData['address'],
                'phone_number' => $validatedData['phone_number'],
                'email' => $validatedData['email'],
            ]);

            if ($patientRecord) {
                $doctor = DoctorRecord::find($validatedData['doctor_id']); // Find doctor record from doctor id
                $doctor_name = $doctor->name; // Find doctor name

                $appointmentTime = date('H:i', strtotime($validatedData['appointment_time'])); // Make appointment time to 24 hours format from 12 hours format
                $appointmentDay = date('l', strtotime($validatedData['appointment_date'])); // Find appointment day from date

                if ($appointmentDay == $validatedData['appointment_day']) {
                    // Find appointment serial
                    $appointmentCount = AppointmentRecord::where('doctor_name', $doctor_name)
                        ->where('appointment_date', $validatedData['appointment_date'])
                        ->count();

                    // Find patient name
                    $patientRecords = PatientRecord::find($patientRecord->id);
                    $patientFirstName = $patientRecords->first_name;
                    $patientLastName = $patientRecords->last_name;
                    $patientName = $patientFirstName . ' ' . $patientLastName;

                    // Store the data in the database
                    $appointmentRecord = AppointmentRecord::create([
                        'patient_id' => $patientRecords->id,
                        'patient_name' => $patientName,
                        'doctor_id' => $validatedData['doctor_id'],
                        'doctor_name' => $doctor_name,
                        'appointment_date' => $validatedData['appointment_date'],
                        'appointment_day' => $appointmentDay,
                        'appointment_time' => $appointmentTime,
                        'appointment_serial' => $appointmentCount + 1,
                        'reason' => $validatedData['reason']
                    ]);

                    if ($appointmentRecord) {
                        // dd($validatedData);
                        return redirect()->route('system_admin.patient_record')->with('add_patient_success', 'New patient added successfully.');
                    } else {
                        $patientRecord->delete();
                        // dd($validatedData);
                        return redirect()->back()->withInput()->with('add_patient_error', 'Failed to create new patient record. Please try again.');
                    }
                } else {
                    $patientRecord->delete();
                    // dd($validatedData);
                    return redirect()->back()->withInput()->with('add_patient_error', 'Selected date does not match with the available schedule day.');
                }
            } else {
                // dd($validatedData);
                return redirect()->back()->withInput()->with('add_patient_error', 'Failed to create new patient record. Please try again.');
            }
        } catch (Exception $e) {
            dd($e);
            // return redirect()->back()->withInput()->with('add_patient_error', 'Failed to create new patient record. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified patient record.
     *
     * @param PatientRecord $patientRecord
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function edit(PatientRecord $patientRecord): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('admin.system.editPatientRecord', compact('patientRecord'));
    }

    /**
     * Update the specified patient record in storage.
     *
     * @param PatientRecordRequest $request
     * @param PatientRecord $patientRecord
     * @return RedirectResponse
     */
    public function update(PatientRecordRequest $request, PatientRecord $patientRecord): RedirectResponse
    {
        $validatedData = $request->validated();

        try {
            // Calculate age based on date of birth
            $dateOfBirth = Carbon::parse($validatedData['birth_date']);
            $age = $dateOfBirth->age;

            // Store the data in the database
            $patientRecord = $patientRecord->update([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'gender' => $validatedData['gender'],
                'blood_group' => $validatedData['blood_group'],
                'birth_date' => $validatedData['birth_date'],
                'age' => $age,
                'address' => $validatedData['address'],
                'phone_number' => $validatedData['phone_number'],
                'email' => $validatedData['email'],
            ]);

            if ($patientRecord) {
                return redirect()->route('system_admin.patient_record')->with('edit_patient_success', 'Patient record updated successfully.');
            } else {
                dd($patientRecord);
                // return redirect()->route('system_admin.patient_record')->with('edit_patient_error', 'Error to update patient record.');
            }
        } catch (Exception $e) {
            dd($e);
            // return redirect()->back()->withInput()->with('edit_patient_error', 'Failed to edit patient record. Please try again.');
        }
    }

    /**
     * Remove the specified patient record from storage.
     *
     * @param PatientRecord $patientRecord
     * @return JsonResponse
     */
    public function destroy(PatientRecord $patientRecord): JsonResponse
    {
        $patientRecord->delete(); // Delete patient record

        return response()->json(['success' => 'Patient record deleted successfully']);
    }

    /**
     * Search all patient records from the storage.
     * @param Request $request
     * @return string
     */

    public function search(Request $request): string
    {
        $searchQuery = $request->search_string;

        // Fetch patient records
        $patientRecords = PatientRecord::where('first_name', 'like', '%' . $searchQuery . '%')
            ->orWhere('last_name', 'like', '%' . $searchQuery . '%')
            //->orWhere('id', 'like', '%' . $searchQuery . '%')
            ->orWhere('gender', 'like', '%' . $searchQuery . '%')
            ->orWhere('address', 'like', '%' . $searchQuery . '%')
            ->orWhere('phone_number', 'like', '%' . $searchQuery . '%')
            ->orWhere('email', 'like', '%' . $searchQuery . '%')
            ->orWhere('age', 'like', '%' . $searchQuery . '%')
            ->orWhereDate('birth_date', $searchQuery)
            ->orWhereDate('created_at', $searchQuery)
            ->get();

        if ($patientRecords->count() >= 1) {
            return view('admin.system.patientRecordTable', compact('patientRecords'))->render();
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

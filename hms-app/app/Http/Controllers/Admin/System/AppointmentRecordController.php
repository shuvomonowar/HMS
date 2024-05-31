<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Receptionist\AppointmentRecordRequest;
use App\Models\Users\Doctor\DoctorRecord;
use App\Models\Users\Doctor\ScheduleRecord;
use App\Models\Users\Receptionist\AppointmentRecord;
use App\Models\Users\Receptionist\PatientRecord;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AppointmentRecordController extends Controller
{
    /**
     * Display all patient appointment records.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $doctors = DoctorRecord::all();
        $patientAppointmentRecords = AppointmentRecord::all();
        return view('admin.system.appointmentRecords', compact('patientAppointmentRecords'), ['doctors' => $doctors]);
    }


    /**
     * Show the form for creating a new appointment record.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        return view('users.receptionist.addPatientAppointmentRecord');
    }

    /**
     * Store a new appointment record.
     *
     **/

    public function store(AppointmentRecordRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        // Log::info("ValidatedItem: $validatedData");

        // Find doctor name
        $doctor = DoctorRecord::find($validatedData['doctor_id']);
        $doctor_name = $doctor->name;

        // Find patient name
        $patientRecord = PatientRecord::find($validatedData['patient_id']);
        /*$patientRecord = PatientRecord::where('id', $validatedData['patient_id'])
            ->select('first_name', 'last_name')
            ->get();*/

        $patientFirstName = $patientRecord->first_name;
        $patientLastName = $patientRecord->last_name;
        $patientName = $patientFirstName . ' ' . $patientLastName;

        // $scheduleRecord = ScheduleRecord::where('doctor_id', $doctor->id)->first();
        // $scheduleRecord->appointment_status = "Booked";
        // $scheduleRecord->save();

        try {
            $appointmentTime = date('H:i', strtotime($validatedData['appointment_time']));

            $appointmentDay = date('l', strtotime($validatedData['appointment_date']));

            if ($appointmentDay == $validatedData['appointment_day']) {
                // Find appointment serial
                $appointmentCount = AppointmentRecord::where('doctor_name', $doctor_name)
                    ->where('appointment_date', $validatedData['appointment_date'])
                    ->count();

                // Store the data in the database
                $appointmentRecord = AppointmentRecord::create([
                    'patient_id' => $validatedData['patient_id'],
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
                    return redirect()->route('system_admin.patient_record.appointment_record.show', $validatedData['patient_id'])->with('add_appointment_success', 'New Appointment record created successfully.');
                } else {
                    // dd($validatedData);
                    return redirect()->back()->withInput()->with('add_appointment_error', 'Failed to create new appointment record. Please try again.');
                }
            } else {
                // dd($validatedData);
                return redirect()->back()->withInput()->with('add_appointment_error', 'Selected date does not match with the available schedule day.');
            }
        } catch (Exception $e) {
            dd($e);
            // dd($patientRecord);
            // return redirect()->back()->withInput()->with('add_appointment_error', 'Failed to create new appointment record. Please try again.');
        }
    }


    /**
     * Retrieve all appointment records for a given patient.
     *
     * @param int $patientId
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function show(int $patientId): \Illuminate\Foundation\Application|View|Factory|Application
    {
        // Retrieve all appointment records for the given patient
        $patientAppointmentRecords = AppointmentRecord::where('patient_id', $patientId)->get();
        $doctors = DoctorRecord::all();

        return view('admin.system.appointmentRecord', compact('patientAppointmentRecords'), ['doctors' => $doctors, 'patientID' => $patientId]);
    }

    /**
     * Show the form for editing the specified patient appointment record.
     *
     * @param AppointmentRecord $appointmentRecord
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function edit(AppointmentRecord $appointmentRecord): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $doctors = DoctorRecord::all();

        // Find doctor_id using doctor_name from AppointmentRecord
        $doctorRecord = DoctorRecord::where('name', $appointmentRecord->doctor_name)->first();
        $doctor_id = $doctorRecord->id;

        // Find start_time and end_time
        $scheduleRecord = ScheduleRecord::where('doctor_id', $doctor_id)
            ->where('schedule_day', $appointmentRecord->appointment_day)
            -> where('start_time', $appointmentRecord->appointment_time)
            ->first();

        $start_time = date('H:i A', strtotime($scheduleRecord->start_time));
        $end_time = date('H:i A', strtotime($scheduleRecord->end_time));
        /*$start_time = '09:00 AM';
        $end_time = '09:30 AM';*/

        $allScheduleDaysTimes = ScheduleRecord::all()->where('schedule_day', $appointmentRecord->appointment_day);

        /*if($allScheduleDaysTimes) {
            // dd($allScheduleDaysTimes);
            return view('users.receptionist.editPatientAppointmentRecord', compact('appointmentRecord'), ['doctors' => $doctors, 'doctor_id' => $doctor_id, 'start_time' => $start_time, 'end_time' => $end_time, 'allScheduleDaysTimes' => $allScheduleDaysTimes]);
        }

        else {
            dd($allScheduleDaysTimes);
        }*/

        return view('admin.system.editAppointmentRecord', compact('appointmentRecord'), ['doctors' => $doctors, 'doctor_id' => $doctor_id, 'start_time' => $start_time, 'end_time' => $end_time, 'allScheduleDaysTimes' => $allScheduleDaysTimes]);
    }

    /**
     * Update the specified patient appointment record in storage.
     *
     * @param AppointmentRecordRequest $request
     * @param AppointmentRecord $appointmentRecord
     * @return RedirectResponse
     */
    public function update(AppointmentRecordRequest $request, AppointmentRecord $appointmentRecord): RedirectResponse
    {
        $validatedData = $request->validated();

        $doctor = DoctorRecord::find($validatedData['doctor_id']);
        $doctor_name = $doctor->name;

        /*$patient = PatientRecord::find($validatedData['patient_id']);
        $patient_name = $patient->first_name . ' ' . $patient->last_name;*/

        try {
            $appointmentTime = date('H:i', strtotime($validatedData['appointment_time']));

            $appointmentDay = date('l', strtotime($validatedData['appointment_date']));

            if ($appointmentDay == $validatedData['appointment_day']) {
                // Find appointment serial
                $appointmentCount = AppointmentRecord::where('doctor_name', $doctor_name)
                    ->where('appointment_date', $validatedData['appointment_date'])
                    ->count();

                // Store the data in the database
                $appointmentRecord = $appointmentRecord->update([
                    'patient_id' => $validatedData['patient_id'],
                    /*'patient_name' => $patient_name,*/
                    'doctor_id' => $validatedData['doctor_id'],
                    'doctor_name' => $doctor_name,
                    'appointment_date' => $validatedData['appointment_date'],
                    'appointment_day' => $appointmentDay,
                    'appointment_time' => $appointmentTime,
                    'appointment_serial' => $appointmentCount + 1,
                    'reason' => $validatedData['reason']
                ]);

                if ($appointmentRecord) {
                    // Update the Schedule Record
                    /*$scheduleRecord = ScheduleRecord::where('doctor_id', $doctor->id)->first();
                    $scheduleRecord->appointment_status = "Booked";
                    $scheduleRecord->save();*/
                    // return redirect()->route('receptionist_user.patient_record')->with('edit_appointment_success', 'Patient Appointment record updated successfully.');
                    // return redirect()->back()->with('edit_appointment_success', 'Patient Appointment record updated successfully.');
                    // return redirect()->route('receptionist_user.patient_record.appointment_records')->with('edit_appointment_success', 'Appointment record updated successfully.');
                    // dd($validatedData);
                    return redirect()->route('system_admin.patient_record.appointment_record.show', $validatedData['patient_id'])->with('edit_appointment_success', 'Appointment record updated successfully.');
                } else {
                    // dd($validatedData);
                    return redirect()->back()->withInput()->with('edit_appointment error', 'Failed to edit appointment record. Please try again.');
                }
            } else {
                // dd($validatedData);
                return redirect()->back()->withInput()->with('edit_appointment error', 'Failed to edit appointment record. Appointment day and date is not matched. Please try again.');
            }
        } catch (Exception $e) {
            dd($e);
            // return redirect()->back()->withInput()->with('error', 'Failed to edit appointment record. Please try again.');
        }
    }

    /**
     * Remove the specified patient appointment record from storage.
     *
     * @param int $appointmentId
     * @return JsonResponse
     */
    public function destroy(int $appointmentId): JsonResponse
    {
        try {
            // Find AppointmentRecord by ID
            $appointmentRecord = AppointmentRecord::find($appointmentId);

            // Find doctor_id using doctor_name from AppointmentRecord
            /*$doctorRecord = DoctorRecord::where('name', $appointmentRecord->doctor_name)->first();
            $doctor_id = $doctorRecord->id;*/

            // Find corresponding ScheduleRecord and update appointment_status
            /*$scheduleRecord = ScheduleRecord::where('doctor_id', $doctor_id)
                ->where('date', $appointmentRecord->appointment_date)
                ->where('start_time', $appointmentRecord->appointment_time)
                ->first();*/

            /*if ($scheduleRecord) {
                $scheduleRecord->appointment_status = "Available";
                $scheduleRecord->save();
            }*/

            // Delete the AppointmentRecord
            $appointmentRecord->delete();

            /*Log::info("Doctor ID: $doctor_id");
            Log::info("Schedule Record: $scheduleRecord");*/

            return response()->json(['success' => 'Patient appointment record deleted successfully']);
        } catch (Exception $e) {
            dd($e);
            // return redirect()->back()->withInput()->with('error', 'Failed to delete appointment record. Please try again.');
        }
    }

    /**
     * Search all patient records from the storage.
     * @param Request $request
     * @return string
     */
    public function search(Request $request, int $patientID): string
    {
        $searchQuery = $request->search_string;

        $patientAppointmentRecords = AppointmentRecord::where(function ($query) use ($searchQuery) {
            $query->where('patient_id', 'like', '%' . $searchQuery . '%')
                ->orWhere('doctor_name', 'like', '%' . $searchQuery . '%')
                ->orWhere('reason', 'like', '%' . $searchQuery . '%')
                ->orWhereDate('appointment_date', $searchQuery);
        })
            ->where('patient_id', $patientID)
            ->select('appointment_records.*')
            ->get();

        if ($patientAppointmentRecords->count() >= 1) {
            return view('admin.system.appointmentRecordTable', compact('patientAppointmentRecords'))->render();
        } else {
            return '<tr><td colspan="13" class="text-center py-4 text-red-500 text-lg">No record found.</td></tr>';
        }
    }

    /**
     * Fetch available days of a specific doctor schedule
     *
     */
    public function fetchAvailableDays(Request $request): string
    {
        // Get doctor ID from the request
        $doctorId = $request->doctor_id;

        // Fetch available appointment dates for the selected doctor
        $availableDay = ScheduleRecord::where('doctor_id', $doctorId)
            ->distinct('schedule_day')
            ->pluck('schedule_day');

        // Return available dates as options for the dropdown
        $options = '<option value="">Select Day</option>';
        foreach ($availableDay as $schedule_day) {
            $options .= '<option value="' . $schedule_day . '">' . $schedule_day . '</option>';
        }

        return $options;
    }

    /**
     * Fetch available times of a specific doctor schedule day
     *
     */
    public function fetchAvailableTimes(Request $request): string
    {
        // Get doctor ID and appointment date from the request
        $doctorId = $request->doctor_id;
        $appointmentDay = $request->appointment_day;

        // Fetch available appointment times for the selected doctor and date
        $availableTimes = ScheduleRecord::where('doctor_id', $doctorId)
            ->where('schedule_day', $appointmentDay)
            ->select('start_time', 'end_time')
            ->get(); // Retrieve both start and end times


        $html = '';
        foreach ($availableTimes as $time) {
            // Format the start and end times in AM/PM format
            $start_time = date('h:i A', strtotime($time->start_time));
            $end_time = date('h:i A', strtotime($time->end_time));

            // Create radio buttons with formatted times
            /*$html .= '<div>';
            $html .= '<input type="radio" id="' . $time->start_time . '" name="appointment_time" value="' . $time->start_time . '" required="required">';
            $html .= '<label for="' . $time->start_time . '">' . $start_time . ' - ' . $end_time . '</label>';
            $html .= '</div>';*/
            // Create dropdown selection option
            $html .= '<option value="' . $start_time . '">' . $start_time . ' - ' . $end_time . '</option>';
        }

        return $html;
    }

    /**
     * Check existing time and date of a specific doctor schedule day
     *
     */
    public function checkAppointmentExistence(Request $request): JsonResponse
    {
        $appointment_time = date('H:i', strtotime($request->input('appointment_time')));

        $doctorRecord = DoctorRecord::where('id',$request->input('doctor_id'))->first();

        // Retrieve the appointment date, time, and doctor ID from the request
        $appointmentDate = $request->input('appointment_date');
        $appointmentTime = $appointment_time;
        $doctorName = $doctorRecord->name;

        // Query the AppointmentRecord model to check if an appointment exists
        $existingAppointment = AppointmentRecord::where('appointment_date', $appointmentDate)
            ->where('appointment_time', $appointmentTime)
            ->where('doctor_name', $doctorName)
            ->exists();

        // Return a JSON response indicating whether the appointment exists or not
        return response()->json(['exists' => $existingAppointment]);
    }
}

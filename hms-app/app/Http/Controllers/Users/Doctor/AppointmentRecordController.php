<?php

namespace App\Http\Controllers\Users\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Receptionist\AppointmentRecordRequest;
use App\Models\Users\Doctor\DoctorRecord;
use App\Models\Users\Doctor\ScheduleRecord;
use App\Models\Users\Receptionist\AppointmentRecord;
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
    public function index(string $username): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $doctorRecord = DoctorRecord::where('username', $username)
            ->select('id')
            ->first();

        $doctorId = $doctorRecord->id;

        $patientAppointmentRecords = AppointmentRecord::where('doctor_id', $doctorId)->get();

        return view('users.doctor.appointmentRecord', compact('patientAppointmentRecords'), ['doctorID' => $doctorId]);
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
    public function search(Request $request, int $doctorID): string
    {
        $searchDate = $request->search_date;

        $patientAppointmentRecords = AppointmentRecord::whereDate('appointment_date', $searchDate)
            ->where('doctor_id', $doctorID)
            ->select('appointment_records.*')
            ->get();

        if ($patientAppointmentRecords->count() >= 1) {
            return view('users.doctor.appointmentRecordTable', compact('patientAppointmentRecords'))->render();
        } else {
            return '<tr><td colspan="13" class="text-center py-4 text-red-500 text-lg">No record found.</td></tr>';
        }
    }
}

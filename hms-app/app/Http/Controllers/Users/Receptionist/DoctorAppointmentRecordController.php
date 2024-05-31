<?php

namespace App\Http\Controllers\Users\Receptionist;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Receptionist\SearchDoctorAppointmentRecordRequest;
use App\Models\Users\Doctor\DoctorRecord;
use App\Models\Users\Receptionist\AppointmentRecord;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class DoctorAppointmentRecordController extends Controller
{
    /**
     * Display all patient appointment records.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $doctors = DoctorRecord::all();
        $doctorAppointmentRecords = AppointmentRecord::all();
        return view('users.receptionist.doctorAppointmentRecords', compact('doctorAppointmentRecords'), ['doctors' => $doctors]);
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

            return response()->json(['success' => 'Doctor appointment record deleted successfully']);
        } catch (Exception $e) {
            dd($e);
            // return redirect()->back()->withInput()->with('error', 'Failed to delete appointment record. Please try again.');
        }
    }

    /**
     * Find appointment record for specific doctor
     */
    public function searchAppointment(Request $request): string
    {
        /*$validatedData = $searchDoctorAppointmentRecordRequest->validated();

        // Retrieve data from the request
        $doctorName = $validatedData['doctor_name'];
        $appointmentDate = $validatedData['appointment_date'];

        // Perform the search query
        $doctorAppointmentRecords = AppointmentRecord::where('doctor_name', $doctorName)
            ->where('appointment_date', $appointmentDate)
            ->get();

        if ($doctorAppointmentRecords->count() >= 1) {
            return response()->json(view('users.receptionist.doctorAppointmentRecordTable', compact('doctorAppointmentRecords'))->render());
        } else {
            return '<tr><td colspan="13" class="text-center py-4 text-red-500 text-lg">No record found.</td></tr>';
        }*/

        // Retrieve data from the request
        $doctorId = $request->input('doctor_id');
        $appointmentDate = $request->input('appointment_date');

        // Log::info("ValidatedData: $doctorName, $appointmentDate");

        // Perform the search query
        $doctorAppointmentRecord = AppointmentRecord::where('doctor_id', $doctorId)
            ->where('appointment_date', $appointmentDate)
            ->get();

        // Log::info("ValidatedData: $doctorAppointmentRecord");

        // Return the search results
        if ($doctorAppointmentRecord->count() >= 1) {
            return view('users.receptionist.showDoctorAppointmentRecordTable', compact('doctorAppointmentRecord'));
        } else {
            // dd($doctorAppointmentRecords);
            return '<tr><td colspan="13" class="text-center py-4 text-red-500 text-lg">No record found.</td></tr>';
        }
    }
}

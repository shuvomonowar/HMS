<?php

namespace App\Http\Controllers\Users\Receptionist;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Receptionist\PatientTestBlockRequest;
use App\Http\Requests\Users\Receptionist\PatientTestRecordRequest;
use App\Models\Users\Doctor\DoctorRecord;
use App\Models\Users\Receptionist\AppointmentRecord;
use App\Models\Users\Receptionist\PatientRecord;
use App\Models\Users\Receptionist\PatientTest;
use App\Models\Users\Receptionist\PatientTestRecord;
use App\Models\Users\Receptionist\TestRecord;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PatientTestRecordController extends Controller
{
    /**
     * Display all patient test records.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $patientTestRecords = PatientTestRecord::all();
        return view('users.receptionist.patientTestRecords', compact('patientTestRecords'));
    }


    /**
     * Show the form for creating a new appointment record.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        /*$doctors = DoctorRecord::all();
        $tests = TestRecord::all();*/
        return view('users.receptionist.addPatientTestRecord');
    }

    /**
     * Store a new test block.
     *
     **/

    public function storeBlock(PatientTestBlockRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

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

        try {
            // Store the data in the database
            $testRecord = PatientTest::create([
                'patient_id' => $validatedData['patient_id'],
                'patient_name' => $patientName,
                'app_doc_id' => $validatedData['doctor_id'],
                'app_doc_name' => $doctor_name,
            ]);
            if ($testRecord) {
                // dd($validatedData);
                return redirect()->route('receptionist_user.patient_record.test_record.show', $validatedData['patient_id'])->with('add_test_success', 'New test record group created successfully.');
            } else {
                // dd($validatedData);
                return redirect()->back()->withInput()->with('add_test_error', 'Failed to create new test record. Please try again.');
            }
        } catch (Exception $e) {
            dd($e);
            // dd($patientRecord);
            // return redirect()->back()->withInput()->with('add_test_error', 'Failed to create new test record. Please try again.');
        }
    }

    /**
     * Store a new test record.
     *
     **/

    public function store(PatientTestRecordRequest $request, int $testID): RedirectResponse
    {
        $validatedData = $request->validated();

        try {
            $testCategories = [];
            $testNames = [];
            $testCosts = [];

            $totalCost = 0;

            for ($i = 1; $i <= 5; $i++) {
                if (!empty($validatedData['test_category_' . $i]) && !empty($validatedData['test_name_' . $i]) && !empty($validatedData['test_cost_' . $i])) {
                    $testCategories[] = $validatedData['test_category_' . $i];
                    $testNames[] = $validatedData['test_name_' . $i];
                    $testCosts[] = $validatedData['test_cost_' . $i];

                    $totalCost += $validatedData['test_cost_' . $i];
                }
            }
            $testCategoriesJson = json_encode($testCategories);
            $testNamesJson = json_encode($testNames);
            $testCostsJson = json_encode($testCosts);

            // Store the data in the database
            $testRecord = PatientTestRecord::create([
                'patient_test_id' => $testID,
                'test_category' => $testCategoriesJson,
                'test_name' => $testNamesJson,
                'test_cost' => $testCostsJson,
                'total_cost' => $totalCost,
                'test_delivery_date' => $validatedData['delivery_date'],
                'test_status' => $validatedData['test_status'],
            ]);
            if ($testRecord) {
                // dd($validatedData);
                return redirect()->route('receptionist_user.patient_record.test_records.show', $testID)->with('add_test_success', 'New test record created successfully.');
            } else {
                // dd($validatedData);
                return redirect()->back()->withInput()->with('add_test_error', 'Failed to create new test record. Please try again.');
            }
        } catch (Exception $e) {
            dd($e);
            // dd($patientRecord);
            // return redirect()->back()->withInput()->with('add_test_error', 'Failed to create new test record. Please try again.');
        }
    }


    /**
     * Retrieve all patient test group records for a given patient.
     *
     * @param int $patientId
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function show(int $patientId): \Illuminate\Foundation\Application|View|Factory|Application
    {
        // Retrieve all test records for the given patient
        $patientTests = PatientTest::where('patient_id', $patientId)->get();
        $doctors = AppointmentRecord::where('patient_id', $patientId)->get();

        return view('users.receptionist.patientTestRecord', compact('patientTests'), ['doctors' => $doctors, 'patientID' => $patientId]);
    }

    /**
     * Retrieve all test records in a specific test group record for a given patient.
     *
     * @param int $testId
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function show_tests(int $testId): \Illuminate\Foundation\Application|View|Factory|Application
    {
        // Retrieve all test records for the given patient
        $patientTestRecords = PatientTestRecord::where('patient_test_id', $testId)->get();
        $doctors = DoctorRecord::all();
        $tests = TestRecord::all();

        $patientTestRecords = $patientTestRecords->map(function ($record) {
            $record->test_category = json_decode($record->test_category);
            $record->test_name = json_decode($record->test_name);
            $record->test_cost = json_decode($record->test_cost);
            return $record;
        });

        return view('users.receptionist.patientTestsRecord', compact('patientTestRecords'), ['doctors' => $doctors, 'tests' => $tests, 'testID' => $testId]);
    }

    /**
     * Show the form for editing the specified patient test record.
     *
     * @param int $patientTestId
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function edit(int $patientTestId): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $doctors = DoctorRecord::all();

        // $patientTestRecord = PatientTestRecord::find($patientTestId)->get();

        $patientTestRecord = PatientTestRecord::find($patientTestId);

        $patientTestRecord->test_category = json_decode($patientTestRecord->test_category, true);
        $patientTestRecord->test_name = json_decode($patientTestRecord->test_name, true);
        $patientTestRecord->test_cost = json_decode($patientTestRecord->test_cost, true);

        // Ensure that test_category, test_name, and test_cost are arrays
        $patientTestRecord->test_category = is_array($patientTestRecord->test_category) ? $patientTestRecord->test_category : [$patientTestRecord->test_category];
        $patientTestRecord->test_name = is_array($patientTestRecord->test_name) ? $patientTestRecord->test_name : [$patientTestRecord->test_name];
        $patientTestRecord->test_cost = is_array($patientTestRecord->test_cost) ? $patientTestRecord->test_cost : [$patientTestRecord->test_cost];

        return view('users.receptionist.editPatientTestRecord', compact('patientTestRecord'), ['doctors' => $doctors, 'patientTestId' => $patientTestId]);
    }

    /**
     * Update the specified patient appointment record in storage.
     *
     * @param PatientTestRecordRequest $patientTestRecordRequest
     * @return RedirectResponse
     */
    public function update(PatientTestRecordRequest $patientTestRecordRequest, int $patientTestId): RedirectResponse
    {
        $validatedData = $patientTestRecordRequest->validated();

        try {
            $testCategories = [];
            $testNames = [];
            $testCosts = [];

            $totalCost = 0;

            for ($i = 1; $i <= 5; $i++) {
                if (!empty($validatedData['test_category_' . $i]) && !empty($validatedData['test_name_' . $i]) && !empty($validatedData['test_cost_' . $i])) {
                    $testCategories[] = $validatedData['test_category_' . $i];
                    $testNames[] = $validatedData['test_name_' . $i];
                    $testCosts[] = $validatedData['test_cost_' . $i];

                    $totalCost += $validatedData['test_cost_' . $i];
                }
            }
            $testCategoriesJson = json_encode($testCategories);
            $testNamesJson = json_encode($testNames);
            $testCostsJson = json_encode($testCosts);

            // Retrieve the record to update
            $patientTestRecord = PatientTestRecord::findOrFail($patientTestId);

            // Update the record
            $patientTestRecord->update([
                'patient_test_id' => $validatedData['patient_test_id'],
                'test_category' => $testCategoriesJson,
                'test_name' => $testNamesJson,
                'test_cost' => $testCostsJson,
                'total_cost' => $totalCost,
                'test_delivery_date' => $validatedData['delivery_date'],
                'test_status' => $validatedData['test_status'],
            ]);

            return redirect()->route('receptionist_user.patient_record.test_records.show', $validatedData['patient_test_id'])->with('edit_test_success', 'Test record updated successfully.');
        } catch (Exception $e) {
            dd($e);
            // return redirect()->back()->withInput()->with('error', 'Failed to edit test record. Please try again.');
        }
    }

    /**
     * Remove the specified patient test group from storage.
     *
     * @param int $testId
     * @return JsonResponse
     */
    public function destroyTest(int $testId): JsonResponse
    {
        try {
            // Find AppointmentRecord by ID
            $patient_test = PatientTest::find($testId);

            // Delete the AppointmentRecord
            $patient_test->delete();

            return response()->json(['success' => 'Patient test group deleted successfully']);
        } catch (Exception $e) {
            dd($e);
            // return redirect()->back()->withInput()->with('error', 'Failed to delete appointment record. Please try again.');
        }
    }

    /**
     * Remove the specified patient test group from storage.
     *
     * @param int $testId
     * @return JsonResponse
     */
    public function destroyTests(int $testId): JsonResponse
    {
        try {
            // Find AppointmentRecord by ID
            $patient_test = PatientTestRecord::find($testId);

            // Delete the AppointmentRecord
            $patient_test->delete();

            return response()->json(['success' => 'Patient test group deleted successfully']);
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
    public function searchTest(Request $request): string
    {
        $searchQuery = $request->search_string;

        $patientTests = PatientTest::where('patient_id', $request->patientID)
            ->where(function ($query) use ($searchQuery) {
                $query->where('patient_name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('app_doc_id', 'like', '%' . $searchQuery . '%')
                    ->orWhere('app_doc_name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('created_at', 'like', '%' . $searchQuery . '%');
            })
            ->get();

        if ($patientTests->count() >= 1) {
            return view('users.receptionist.patientTestRecordTable', compact('patientTests'))->render();
        } else {
            return '<tr><td colspan="13" class="text-center py-4 text-red-500 text-lg">No record found.</td></tr>';
        }
    }

    /**
     * Search all patient records from the storage.
     * @param Request $request
     * @return string
     */
    public function searchTests(Request $request): string
    {
        $searchQuery = $request->search_string;

        $patientTestRecords = PatientTestRecord::where(function ($query) use ($searchQuery) {
            $query->where('patient_test_records.total_cost', 'like', '%' . $searchQuery . '%')
                ->orWhere('patient_test_records.test_status', 'like', '%' . $searchQuery . '%')
                ->orWhere('patient_test_records.test_delivery_date', 'like', '%' . $searchQuery . '%');
        })
            ->where('patient_test_records.patient_test_id', $request->testID)
            ->select('patient_test_records.*', 'patient_tests.patient_id')
            ->join('patient_tests', 'patient_test_records.patient_test_id', '=', 'patient_tests.id')
            ->get();

        $patientTestRecords = $patientTestRecords->map(function ($record) {
            $record->test_category = json_decode($record->test_category);
            $record->test_name = json_decode($record->test_name);
            $record->test_cost = json_decode($record->test_cost);
            return $record;
        });

        if ($patientTestRecords->count() >= 1) {
            return view('users.receptionist.patientTestsRecordTable', compact('patientTestRecords'))->render();
        } else {
            return '<tr><td colspan="13" class="text-center py-4 text-red-500 text-lg">No record found.</td></tr>';
        }
    }

    /**
     * Fetch available test category
     *
     */
    public function fetchAvailableTestCategories(): string
    {
        // Fetch available appointment dates for the selected doctor
        $availableTestCategory = TestRecord::distinct('test_category')->pluck('test_category');

        // Return available dates as options for the dropdown
        $options = '<option value="">Select Category</option>';
        foreach ($availableTestCategory as $test_category) {
            $options .= '<option value="' . $test_category . '">' . $test_category . '</option>';
        }

        return $options;
    }

    /**
     * Fetch available test name of a specific test category
     *
     */
    public function fetchAvailableTestNames(Request $request): string
    {
        // Get doctor ID from the request
        $testCategory = $request->test_category;

        // Fetch available appointment dates for the selected doctor
        $availableTestName = TestRecord::where('test_category', $testCategory)
            ->distinct('test_category')
            ->pluck('test_name');

        // Return available dates as options for the dropdown
        $options = '<option value="">Select Test Name</option>';
        foreach ($availableTestName as $test_name) {
            $options .= '<option value="' . $test_name . '">' . $test_name . '</option>';
        }

        return $options;
    }

    /**
     * Fetch test cost of a specific test name
     *
     */
    public function fetchTestCost(Request $request)
    {
        $testName = $request->input('test_name');

        // Fetch the test cost based on the selected test name
        $testCost = TestRecord::where('test_name', $testName)->value('test_cost');

        return response()->json($testCost);
    }


    // Calculate total cost
    public function calculateTotalCost($patient_test_id): JsonResponse
    {
        // Retrieve test records for the patient
        $testRecords = PatientTestRecord::where('patient_test_id', $patient_test_id)->get();

        // Calculate total cost
        $totalCost = $testRecords->sum('test_cost');

        // Return total cost as JSON response
        return response()->json(['totalCost' => $totalCost]);
    }
}

<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Models\Users\Receptionist\PatientTestRecord;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TestReportRecordController extends Controller
{
    /**
     * Display all patient appointment records.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $patientTestReports = PatientTestRecord::where('test_status', 'Report Ready to Deliver')
            ->select('patient_test_records.*', 'patient_tests.patient_id', 'patient_tests.app_doc_id', 'patient_tests.app_doc_name')
            ->join('patient_tests', 'patient_test_records.patient_test_id', '=', 'patient_tests.id')
            ->get();

        $patientTestReports = $patientTestReports->map(function ($record) {
            $record->test_category = json_decode($record->test_category);
            $record->test_name = json_decode($record->test_name);
            $record->test_cost = json_decode($record->test_cost);
            return $record;
        });

        return view('admin.system.testReport', compact('patientTestReports'));
    }

    /**
     * Remove the specified patient test report from storage.
     *
     * @param int $reportId
     * @return JsonResponse
     */
    public function destroy(int $reportId): JsonResponse
    {
        try {
            // Find Test Report by ID
            $patient_test = PatientTestRecord::find($reportId);

            // Delete the Test Report
            $patient_test->delete();

            return response()->json(['success' => 'Patient test report deleted successfully']);
        } catch (Exception $e) {
            dd($e);
            // return redirect()->back()->withInput()->with('error', 'Failed to delete appointment record. Please try again.');
        }
    }

    /**
     * Search all test reports from the storage using test id
     * @param Request $request
     * @return string
     */

    public function search(Request $request): string
    {
        $searchQuery = $request->search_string;

        $patientTestReports = PatientTestRecord::where(function ($query) use ($searchQuery) {
            $query->where('patient_test_records.id', 'like', '%' . $searchQuery . '%')
                ->orWhere('patient_tests.patient_id', 'like', '%' . $searchQuery . '%');
        })
            ->where('patient_test_records.test_status', 'Report Ready to Deliver')
            ->select('patient_test_records.*', 'patient_tests.patient_id', 'patient_tests.app_doc_id', 'patient_tests.app_doc_name')
            ->join('patient_tests', 'patient_test_records.patient_test_id', '=', 'patient_tests.id')
            ->get();

        $patientTestReports = $patientTestReports->map(function ($record) {
            $record->test_category = json_decode($record->test_category);
            $record->test_name = json_decode($record->test_name);
            $record->test_cost = json_decode($record->test_cost);
            return $record;
        });

        if ($patientTestReports->count() >= 1) {
            return view('admin.system.testReportTable', compact('patientTestReports'))->render();
        } else {
            return '<tr><td colspan="13" class="text-center py-4 text-red-500 text-lg">No record found.</td></tr>';
        }
    }
}

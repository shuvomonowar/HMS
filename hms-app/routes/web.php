<?php

use App\Http\Controllers\Admin\System\AdminPatientRecordController;
use App\Http\Controllers\Admin\System\AppointmentRecordController;
use App\Http\Controllers\Admin\System\DoctorRecordController;
use App\Http\Controllers\Admin\System\EmployeeRecordController;
use App\Http\Controllers\Admin\System\LoginController;
use App\Http\Controllers\Admin\System\LogoutController;
use App\Http\Controllers\Admin\System\ScheduleRecordController;
use App\Http\Controllers\Admin\System\TestRecordController;
use App\Http\Controllers\Admin\System\TestReportRecordController;
use App\Http\Controllers\Users\Receptionist\DashboardController;
use App\Http\Controllers\Users\Receptionist\DoctorAppointmentRecordController;
use App\Http\Controllers\Users\Receptionist\PatientAppointmentRecordController;
use App\Http\Controllers\Users\Receptionist\PatientRecordController;
use App\Http\Controllers\Users\Receptionist\PatientTestRecordController;
use App\Http\Controllers\Users\Receptionist\PatientTestReportController;
use App\Http\Controllers\Users\Doctor\DashboardController as DoctorDashboardController;
use App\Http\Controllers\Users\Doctor\ScheduleRecordController as DoctorScheduleRecordController;
use App\Http\Controllers\Users\Doctor\AppointmentRecordController as DoctorPatientAppointmentRecordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
})->name('welcome');*/

/*
 * Application Homepage
*/
Route::get('/', function () {
    return view('/homepage/homepage');
})->name('homepage');

/*
 * System Admin
*/

// System Admin Login
Route::get('/system_admin/login', function () {
    return view('admin.system.login');
})->name('system_admin.login');

Route::post('/system_admin/login', [LoginController::class, 'login'])->name('system_admin.login');

Route::middleware('system_admin')->group(function () {
    // System Admin Dashboard
    Route::get('/system_admin/dashboard', function () {
        return view('admin.system.dashboard');
    })->name('system_admin.dashboard');

    // Fetch All Employee Records
    Route::get('/system_admin/employee_record', [EmployeeRecordController::class, 'index'])
        ->name('system_admin.employee_record')
        ->middleware('auth:system_admin');

    // Create New Employee Record
    Route::get('/system_admin/add_employee', [EmployeeRecordController::class, 'create'])
        ->name('system_admin.add_employee')
        ->middleware('auth:system_admin');

    Route::post('/system_admin/add_employee/store', [EmployeeRecordController::class, 'store'])
    ->name('system_admin.add_employee.store')
        ->middleware('auth:system_admin');

    // Edit Any Specific Employee Record
    Route::get('/system_admin/edit_employee/{employeeRecord}', [EmployeeRecordController::class, 'edit'])
        ->name('system_admin.edit_employee.edit')
        ->middleware('auth:system_admin');

    Route::put('/system_admin/employee_record/{employeeRecord}', [EmployeeRecordController::class, 'update'])
        ->name('system_admin.employee_record.update')
        ->middleware('auth:system_admin');

    // Delete Any Specific Employee Record
    Route::delete('/system_admin/employee_record/{employeeRecord}', [EmployeeRecordController::class, 'destroy'])
        ->name('system_admin.employee_record.destroy')
        ->middleware('auth:system_admin');

    // Search Employee Record
    Route::get('/system_admin/employee_record/search', [EmployeeRecordController::class, 'search'])->name('system_admin.employee_record.search');

    // Fetch All Patient Records
    Route::get('/system_admin/patient_record', [AdminPatientRecordController::class, 'index'])
        ->name('system_admin.patient_record')
        ->middleware('auth:system_admin');

    // Create New Patient Record
    Route::get('/system_admin/add_patient', [AdminPatientRecordController::class, 'create'])
        ->name('system_admin.add_patient')
        ->middleware('auth:system_admin');

    Route::post('/system_admin/add_patient/store', [AdminPatientRecordController::class, 'store'])
        ->name('system_admin.add_patient.store')
        ->middleware('auth:system_admin');

    // Edit Any Specific Patient Record
    Route::get('/system_admin/edit_patient/{patientRecord}', [AdminPatientRecordController::class, 'edit'])
        ->name('system_admin.edit_patient.edit')
        ->middleware('auth:system_admin');

    Route::put('/system_admin/update_patient/{patientRecord}', [AdminPatientRecordController::class, 'update'])
        ->name('system_admin.patient_record.update')
        ->middleware('auth:system_admin');

    // Delete Any Specific Patient Record
    Route::delete('/system_admin/patient_record/{patientRecord}', [AdminPatientRecordController::class, 'destroy'])
        /*->name('system_admin.patient_record.destroy')*/
        ->middleware('auth:system_admin');

    // Search Patient Records
    Route::get('/system_admin/patient_record/search', [AdminPatientRecordController::class, 'search'])->name('system_admin.patient_record.search');

    // Search Phone Number
    Route::get('/system_admin/patient_record/search_phone_number', [AdminPatientRecordController::class, 'searchByPhoneNumber'])->name('system_admin.search_phone_number');

    // Fetch Patient Name
    Route::get('/system_admin/patient_record/fetch_patient_name', [AdminPatientRecordController::class, 'fetchPatientName'])->name('system_admin.fetch_patient_name');

    // Fetch All Appointment Records
    Route::get('/system_admin/patient_record/appointment_records', [AppointmentRecordController::class, 'index'])
        ->name('system_admin.patient_record.appointment_records')
        ->middleware('auth:system_admin');

    // Fetch Any Specific Patient's Appointment Records
    Route::get('/system_admin/patient_record/appointment_record/{patientId}', [AppointmentRecordController::class, 'show'])
        ->name('system_admin.patient_record.appointment_record.show')
        ->middleware('auth:system_admin');

    // Add New Appointment Record for a Patient
    Route::post('/system_admin/patient_record/appointment_record/{patientId}', [AppointmentRecordController::class, 'store'])
        ->name('system_admin.patient_record.appointment_record.store')
        ->middleware('auth:system_admin');

    // Edit Any Specific Appointment Record
    Route::get('/system_admin/patient_record/edit_appointment/{appointmentRecord}', [AppointmentRecordController::class, 'edit'])
        ->name('system_admin.patient_record.edit_appointment.edit')
        ->middleware('auth:system_admin');

    Route::put('/system_admin/patient_record/update_appointment/{appointmentRecord}', [AppointmentRecordController::class, 'update'])
        ->name('system_admin.patient_record.update_appointment.update')
        ->middleware('auth:system_admin');

    // Delete Any Specific Appointment Record
    Route::delete('/system_admin/patient_record/appointment_record/{appointmentId}', [AppointmentRecordController::class, 'destroy'])
        /*->name('receptionist_user.patient_record.appointment_record.destroy')*/
        ->middleware('auth:system_admin');

    Route::get('/system_admin/search_appointment_record/search/{patientID}', [AppointmentRecordController::class, 'search'])->name('system_admin.patient_record.appointment_record.search');

    Route::get('/system_admin/schedule/fetch_available_days', [AppointmentRecordController::class, 'fetchAvailableDays'])->name('system_admin.fetch_available_days');

    Route::get('/system_admin/schedule/fetch_available_times', [AppointmentRecordController::class, 'fetchAvailableTimes'])->name('system_admin.fetch_available_times');

    Route::get('/system_admin/appointment/check_appointment_existence', [AppointmentRecordController::class, 'checkAppointmentExistence'])->name('system_admin.check_appointment_existence');

    // System Admin Patient Test Record
    Route::get('/system_admin/patient_record/test_records', [TestRecordController::class, 'index'])
        ->name('system_admin.patient_record.test_records')
        ->middleware('auth:system_admin');

    Route::get('/system_admin/patient_record/test_record/{patientId}', [TestRecordController::class, 'show'])
        ->name('system_admin.patient_record.test_record.show')
        ->middleware('auth:system_admin');

    Route::get('/system_admin/patient_record/test_records/{testId}', [TestRecordController::class, 'show_tests'])
        ->name('system_admin.patient_record.test_records.show')
        ->middleware('auth:system_admin');

    Route::post('/system_admin/patient_record/test_block_record/{patientId}', [TestRecordController::class, 'storeTestGroup'])
        ->name('system_admin.patient_record.test_block_record.store')
        ->middleware('auth:system_admin');

    Route::post('/system_admin/patient_record/test_record/{testID}', [TestRecordController::class, 'store'])
        ->name('system_admin.patient_record.test_record.store')
        ->middleware('auth:system_admin');

    Route::get('/system_admin/patient_record/test_record/edit_test/{patientTestId}', [TestRecordController::class, 'edit'])
        ->name('system_admin.patient_record.test_record.edit_test.edit')
        ->middleware('auth:system_admin');

    Route::put('/system_admin/patient_record/test_record/update_test/{patientTestId}', [TestRecordController::class, 'update'])
        ->name('system_admin.patient_record.test_record.update_test.update')
        ->middleware('auth:system_admin');

    Route::delete('/system_admin/patient_record/patient_test/{testId}', [TestRecordController::class, 'destroyTest'])
        /*->name('receptionist_user.patient_record.test_record.destroy')*/
        ->middleware('auth:system_admin');

    Route::delete('/system_admin/patient_record/test_record/{testId}', [TestRecordController::class, 'destroyTests'])
        /*->name('receptionist_user.patient_record.test_record.destroy')*/
        ->middleware('auth:system_admin');

    Route::get('/system_admin/test_record/fetch_available_test_names', [TestRecordController::class, 'fetchAvailableTestNames'])->name('system_admin.fetch_available_test_names');

    Route::get('/system_admin/test_record/fetch_available_test_categories', [TestRecordController::class, 'fetchAvailableTestCategories'])->name('system_admin.fetch_available_test_categories');

    Route::get('/system_admin/test_record/fetch_test_cost', [TestRecordController::class, 'fetchTestCost'])->name('system_admin.fetch_test_cost');

    Route::get('/system_admin/test_record/search_test/{patientID}', [TestRecordController::class, 'searchTest'])->name('system_admin.test_record.search_test');

    Route::get('/system_admin/test_record/search_tests/{testID}', [TestRecordController::class, 'searchTests'])->name('system_admin.test_record.search_tests');

    Route::get('/system_admin/test_records/calculate_total_cost/{patient_test_id}', [TestRecordController::class, 'calculateTotalCost'])->name('system_admin.test_records.calculate_total_cost');

    // System Admin Patient Test Report
    Route::get('/system_admin/test_records/test_reports', [TestReportRecordController::class, 'index'])
        ->name('system_admin.test_records.test_reports')
        ->middleware('auth:system_admin');

    Route::delete('/system_admin/patient_record/test_record/test_report/{reportId}', [TestReportRecordController::class, 'destroy'])
        /*->name('system_admin.patient_record.test_record.test_report.destroy')*/
        ->middleware('auth:system_admin');

    Route::get('/system_admin/test_report/search', [TestReportRecordController::class, 'search'])->name('system_admin.test_report.search');

    // System Admin Doctor Record
    Route::get('/system_admin/doctor_record', [DoctorRecordController::class, 'index'])
        ->name('system_admin.doctor_record')
        ->middleware('auth:system_admin');

    Route::get('/system_admin/add_doctor', [DoctorRecordController::class, 'create'])
        ->name('system_admin.add_doctor')
        ->middleware('auth:system_admin');

    Route::post('/system_admin/add_doctor/store', [DoctorRecordController::class, 'store'])
        ->name('system_admin.add_doctor.store')
        ->middleware('auth:system_admin');

    Route::get('/system_admin/edit_doctor/{doctorRecord}', [DoctorRecordController::class, 'edit'])
        ->name('system_admin.edit_doctor.edit')
        ->middleware('auth:system_admin');

    Route::put('/system_admin/update_doctor/{doctorRecord}', [DoctorRecordController::class, 'update'])
        ->name('system_admin.doctor_record.update')
        ->middleware('auth:system_admin');

    Route::delete('/system_admin/doctor_record/{doctorRecord}', [DoctorRecordController::class, 'destroy'])
        /*->name('system_admin.doctor_record.destroy')*/
        ->middleware('auth:system_admin');

    Route::get('/system_admin/doctor_record/search', [DoctorRecordController::class, 'search'])->name('system_admin.doctor_record.search');

    Route::get('/system_admin/doctor_record/search_doctor_name', [DoctorRecordController::class, 'searchByDoctorName'])->name('system_admin.search_doctor_name');

    Route::get('/system_admin/doctor_record/fetch_doctor_specialization', [DoctorRecordController::class, 'fetchDoctorSpecialization'])->name('system_admin.fetch_doctor_specialization');

    // System Admin Schedule Record
    Route::get('/system_admin/schedule_record/{doctorId}', [ScheduleRecordController::class, 'show'])
        ->name('system_admin.schedule_record.show')
        ->middleware('auth:system_admin');

    Route::get('/system_admin/add_schedule/{doctorID}', [ScheduleRecordController::class, 'create'])
        ->name('system_admin.add_schedule')
        ->middleware('auth:system_admin');

    Route::post('/system_admin/add_schedule/store', [ScheduleRecordController::class, 'store'])
        ->name('system_admin.add_schedule.store')
        ->middleware('auth:system_admin');

    Route::get('/system_admin/edit_schedule/{scheduleRecord}', [ScheduleRecordController::class, 'edit'])
        ->name('system_admin.edit_schedule.edit')
        ->middleware('auth:system_admin');

    Route::put('/system_admin/update_schedule/{scheduleRecord}', [ScheduleRecordController::class, 'update'])
        ->name('system_admin.update_schedule.update')
        ->middleware('auth:system_admin');

    Route::delete('/system_admin/schedule_record/{scheduleRecord}', [ScheduleRecordController::class, 'destroy'])
        /*->name('system_admin.schedule_record.destroy')*/
        ->middleware('auth:system_admin');

    Route::get('/system_admin/search_schedule_record/search/{doctorID}', [ScheduleRecordController::class, 'search'])->name('system_admin.schedule_record.search');
});

Route::get('/system_admin/logout', [LogoutController::class, 'logout'])->name('system_admin.logout');


/*
 * Receptionist User
*/
Route::get('/user/receptionist/login', function () {
    return view('users.receptionist.login');
})->name('receptionist_user.login');

Route::post('user/receptionist/login', [App\Http\Controllers\Users\Receptionist\LoginController::class, 'login'])->name('receptionist_user.login');

Route::middleware('receptionist_user')->group(function () {
    Route::get('/user/receptionist/dashboard/{username}', [DashboardController::class, 'dashboard'])
        ->name('receptionist_user.dashboard')
        ->middleware('auth:employee_record');

    Route::get('/user/receptionist/patient_record', [PatientRecordController::class, 'index'])
        ->name('receptionist_user.patient_record')
        ->middleware('auth:employee_record');

    Route::get('/user/receptionist/add_patient', [PatientRecordController::class, 'create'])
        ->name('receptionist_user.add_patient')
        ->middleware('auth:employee_record');

    Route::post('/user/receptionist/add_patient/store', [PatientRecordController::class, 'store'])
        ->name('receptionist_user.add_patient.store')
        ->middleware('auth:employee_record');

    Route::get('/user/receptionist/edit_patient/{patientRecord}', [PatientRecordController::class, 'edit'])
        ->name('receptionist_user.edit_patient.edit')
        ->middleware('auth:employee_record');

    Route::put('/user/receptionist/update_patient/{patientRecord}', [PatientRecordController::class, 'update'])
        ->name('receptionist_user.patient_record.update')
        ->middleware('auth:employee_record');

    Route::delete('/user/receptionist/patient_record/{patientRecord}', [PatientRecordController::class, 'destroy'])
        /*->name('receptionist_user.patient_record.destroy')*/
        ->middleware('auth:employee_record');

    Route::get('/user/receptionist/patient_record/search', [PatientRecordController::class, 'search'])->name('receptionist_user.patient_record.search');

    Route::get('/user/receptionist/patient_record/search_phone_number', [PatientRecordController::class, 'searchByPhoneNumber'])->name('search_phone_number');


    // Patient & Doctor Appointment Records
    Route::get('user/receptionist/patient_record/appointment_records', [PatientAppointmentRecordController::class, 'index'])
        ->name('receptionist_user.patient_record.appointment_records')
        ->middleware('auth:employee_record');

    Route::get('user/receptionist/doctor_record/appointment_records', [DoctorAppointmentRecordController::class, 'index'])
        ->name('receptionist_user.doctor_record.appointment_records')
        ->middleware('auth:employee_record');

    Route::get('/user/receptionist/patient_record/appointment_record/{patientId}', [PatientAppointmentRecordController::class, 'show'])
        ->name('receptionist_user.patient_record.appointment_record.show')
        ->middleware('auth:employee_record');

    Route::post('/user/receptionist/patient_record/appointment_record/{patientId}', [PatientAppointmentRecordController::class, 'store'])
        ->name('receptionist_user.patient_record.appointment_record.store')
        ->middleware('auth:employee_record');

    Route::get('/user/receptionist/patient_record/edit_appointment/{appointmentRecord}', [PatientAppointmentRecordController::class, 'edit'])
        ->name('receptionist_user.patient_record.edit_appointment.edit')
        ->middleware('auth:employee_record');

    Route::put('/user/receptionist/patient_record/update_appointment/{appointmentRecord}', [PatientAppointmentRecordController::class, 'update'])
        ->name('receptionist_user.patient_record.update_appointment.update')
        ->middleware('auth:employee_record');

    Route::delete('/user/receptionist/patient_record/appointment_record/{appointmentId}', [PatientAppointmentRecordController::class, 'destroy'])
        /*->name('receptionist_user.patient_record.appointment_record.destroy')*/
        ->middleware('auth:employee_record');

    /*Route::patch('/user/receptionist/patient_record/appointment_record/appointment_status/{appointmentId}', [PatientAppointmentRecordController::class, 'updateAppointmentStatus'])
        ->name('receptionist_user.patient_record.update_appointment.update_appointment_status')
        ->middleware('auth:employee_record');*/

    Route::get('/user/receptionist/appointment_record/appointment_status/edit/{appointmentRecord}', [PatientAppointmentRecordController::class, 'editAppointmentStatus'])
        ->name('receptionist_user.appointment_record.appointment_status.edit')
        ->middleware('auth:employee_record');

    Route::put('/user/receptionist/appointment_record/appointment_status/update/{appointmentRecord}', [PatientAppointmentRecordController::class, 'updateAppointmentStatus'])
        ->name('receptionist_user.appointment_record.appointment_status.update')
        ->middleware('auth:employee_record');

    Route::get('/patient_record/fetch_patient_name', [PatientRecordController::class, 'fetchPatientName'])->name('fetch_patient_name');

    Route::delete('/user/receptionist/doctor_record/appointment_record/{appointmentId}', [DoctorAppointmentRecordController::class, 'destroy'])
        /*->name('receptionist_user.doctor_record.appointment_record.destroy')*/
        ->middleware('auth:employee_record');

    Route::get('/search_appointment_record/search/{patientID}', [PatientAppointmentRecordController::class, 'search'])->name('receptionist_user.patient_record.appointment_record.search');

    Route::get('/schedule/fetch_available_days', [PatientAppointmentRecordController::class, 'fetchAvailableDays'])->name('fetch_available_days');

    Route::get('/schedule/fetch_available_times', [PatientAppointmentRecordController::class, 'fetchAvailableTimes'])->name('fetch_available_times');

    Route::get('/appointment/check_appointment_existence', [PatientAppointmentRecordController::class, 'checkAppointmentExistence'])->name('check_appointment_existence');

    Route::get('/doctor_record/search_appointment', [DoctorAppointmentRecordController::class, 'searchAppointment'])
        ->name('doctor_record.search_appointment');
        /*->middleware('auth:employee_record');*/

    // Patient Test Record
    Route::get('/user/receptionist/patient_record/test_records', [PatientTestRecordController::class, 'index'])
        ->name('receptionist_user.patient_record.test_records')
        ->middleware('auth:employee_record');

    Route::get('/user/receptionist/patient_record/test_record/{patientId}', [PatientTestRecordController::class, 'show'])
        ->name('receptionist_user.patient_record.test_record.show')
        ->middleware('auth:employee_record');

    Route::get('/user/receptionist/patient_record/test_records/{testId}', [PatientTestRecordController::class, 'show_tests'])
        ->name('receptionist_user.patient_record.test_records.show')
        ->middleware('auth:employee_record');

    Route::post('/user/receptionist/patient_record/test_block_record/{patientId}', [PatientTestRecordController::class, 'storeBlock'])
        ->name('receptionist_user.patient_record.test_block_record.store')
        ->middleware('auth:employee_record');

    Route::post('/user/receptionist/patient_record/test_record/{testID}', [PatientTestRecordController::class, 'store'])
        ->name('receptionist_user.patient_record.test_record.store')
        ->middleware('auth:employee_record');

    Route::get('/user/receptionist/patient_record/test_record/edit_test/{patientTestId}', [PatientTestRecordController::class, 'edit'])
        ->name('receptionist_user.patient_record.test_record.edit_test.edit')
        ->middleware('auth:employee_record');

    Route::put('/user/receptionist/patient_record/test_record/update_test/{patientTestId}', [PatientTestRecordController::class, 'update'])
        ->name('receptionist_user.patient_record.test_record.update_test.update')
        ->middleware('auth:employee_record');

    Route::delete('/user/receptionist/patient_record/patient_test/{testId}', [PatientTestRecordController::class, 'destroyTest'])
        /*->name('receptionist_user.patient_record.test_record.destroy')*/
        ->middleware('auth:employee_record');

    Route::delete('/user/receptionist/patient_record/test_record/{testId}', [PatientTestRecordController::class, 'destroyTests'])
        /*->name('receptionist_user.patient_record.test_record.destroy')*/
        ->middleware('auth:employee_record');

    Route::get('/test_record/fetch_available_test_names', [PatientTestRecordController::class, 'fetchAvailableTestNames'])->name('fetch_available_test_names');

    Route::get('/test_record/fetch_available_test_categories', [PatientTestRecordController::class, 'fetchAvailableTestCategories'])->name('fetch_available_test_categories');

    Route::get('/test_record/fetch_test_cost', [PatientTestRecordController::class, 'fetchTestCost'])->name('fetch_test_cost');

    Route::get('/user/receptionist/test_record/search_test/{patientID}', [PatientTestRecordController::class, 'searchTest'])->name('receptionist_user.test_record.search_test');

    Route::get('/user/receptionist/test_record/search_tests/{testID}', [PatientTestRecordController::class, 'searchTests'])->name('receptionist_user.test_record.search_tests');

    Route::get('/test_records/calculate_total_cost/{patient_test_id}', [PatientTestRecordController::class, 'calculateTotalCost'])->name('test_records.calculate_total_cost');

    // Patient Test Report
    Route::get('/user/receptionist/test_records/test_reports', [PatientTestReportController::class, 'index'])
        ->name('receptionist_user.test_records.test_reports')
        ->middleware('auth:employee_record');

    Route::get('/user/receptionist/test_report/search', [PatientTestReportController::class, 'search'])->name('receptionist_user.test_report.search');

    // Route::get('/user/receptionist/test_report/patient_id/search', [PatientTestReportController::class, 'searchPatientID'])->name('receptionist_user.test_report.patient_id.search');

});

Route::get('/receptionist_user/logout', [App\Http\Controllers\Users\Receptionist\LogoutController::class, 'logout'])->name('receptionist_user.logout');


/*
 * Doctor User
*/
Route::get('/user/doctor/login', function () {
    return view('users.doctor.login');
})->name('doctor_user.login');

Route::post('user/doctor/login', [App\Http\Controllers\Users\Doctor\LoginController::class, 'login'])->name('doctor_user.login');

Route::middleware('doctor_user')->group(function () {
    Route::get('/user/doctor/dashboard/{username}', [DoctorDashboardController::class, 'dashboard'])
        ->name('doctor_user.dashboard')
        ->middleware('auth:doctor_record');

    Route::get('/user/doctor/schedule_record/{username}', [DoctorScheduleRecordController::class, 'index'])
        ->name('doctor_user.schedule_record')
        ->middleware('auth:doctor_record');

    Route::get('/user/doctor/add_schedule/{doctorID}', [DoctorScheduleRecordController::class, 'create'])
        ->name('doctor_user.add_schedule')
        ->middleware('auth:doctor_record');

    Route::post('/user/doctor/add_schedule/store', [DoctorScheduleRecordController::class, 'store'])
        ->name('doctor_user.add_schedule.store')
        ->middleware('auth:doctor_record');

    Route::get('/user/doctor/edit_schedule/{scheduleRecord}', [DoctorScheduleRecordController::class, 'edit'])
        ->name('doctor_user.edit_schedule.edit')
        ->middleware('auth:doctor_record');

    Route::put('/user/doctor/update_schedule/{scheduleRecord}', [DoctorScheduleRecordController::class, 'update'])
        ->name('doctor_user.update_schedule.update')
        ->middleware('auth:doctor_record');

    Route::delete('/doctor_user/schedule_record/{scheduleRecord}', [DoctorScheduleRecordController::class, 'destroy'])
        ->middleware('auth:doctor_record');

    Route::get('/user/doctor/appointment_record/{username}', [DoctorPatientAppointmentRecordController::class, 'index'])
        ->name('doctor_user.appointment_record')
        ->middleware('auth:doctor_record');
});

Route::get('/user/doctor/search_schedule_record/{doctorID}', [DoctorScheduleRecordController::class, 'search'])->name('doctor_user.schedule_record.search');

Route::get('/user/doctor/search_appointment/{doctorID}', [DoctorPatientAppointmentRecordController::class, 'search'])
    ->name('doctor_user.appointment_record.search');

Route::get('/doctor_user/logout', [App\Http\Controllers\Users\Doctor\LogoutController::class, 'logout'])->name('doctor_user.logout');

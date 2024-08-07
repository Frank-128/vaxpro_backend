<?php
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\WardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\VaccinationSchedulesController;
use App\Http\Controllers\CertificatesController;
use App\Http\Controllers\ChatMessageController;
use Illuminate\Support\Facades\Route;

Route::post('createVaccine', [VaccinationController::class, 'createVaccine']);
Route::get('getVaccines', [VaccinationController::class, 'getVaccines']);
Route::get('getVaccine/{id}', [VaccinationController::class, 'getVaccine']);
Route::put('updateVaccine/{id}', [VaccinationController::class, 'updateVaccine']);
Route::delete('deleteVaccine/{id}', [VaccinationController::class, 'deleteVaccine']);
Route::post('parentChildData', [ChildController::class, 'parentChildData']);
Route::get('getSavedSchedules/{id}', [VaccinationSchedulesController::class, 'getSavedSchedules']);
Route::get('getChildParentData', [ChildController::class, 'getChildParentData']);
Route::get('children', [ChildController::class, 'children']);
Route::get('parents', [ParentController::class, 'parents']);
Route::get('getChildData/{id}', [ChildController::class, 'getChildData']);
Route::post('getAllChildSchedules', [VaccinationSchedulesController::class, 'vaccine']);
Route::get('getVacSchedules/{id}', [VaccinationSchedulesController::class, 'getVacSchedules']);
Route::post('updateChildVacSchedule', [VaccinationSchedulesController::class, 'updateChildVacSchedule']);
Route::get('getChildVaccines/{id}', [VaccinationController::class, 'getChildVaccines']);
Route::post('all_children',[ChildController::class,'children_data']);
Route::get('fetchVaccineIds/{id}', [VaccinationController::class, 'fetchVaccineIds']);
Route::post('updateSelectedVacs', [VaccinationSchedulesController::class,'updateSelectedVacs']);
Route::post('updateChildParentInfo', [ChildController::class,'updateChildParentInfo']);
Route::post('submitFeedback', [FeedbackController::class, 'submitFeedback']);
Route::get('getFeedback/{facility_ids}', [FeedbackController::class, 'getFeedback']);
Route::get('isVaccinationComplete/{id}', [VaccinationController::class, 'isVaccinationComplete']);


Route::middleware(['auth:sanctum', 'tokenExpiration'])->group(function () {

    //auth endpoints
    Route::post('/register', [AuthController::class, 'register']);
    Route::patch('update_user/{id}', [AuthController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/comm_health_worker_logout', [AuthController::class, 'comm_health_worker_logout']);

    //user endpoints
    Route::get('/user', [UserController::class, 'userData']);
    Route::delete('/user/{id}', [UserController::class, 'destroy']);
    Route::get('/all_users/{id}', [UserController::class, 'allUsers']);

    // child vaccination details
    Route::get('/child_vaccinations/{id}', [UserController::class, 'childData']);

    //address endpoints
    Route::get('districts_wards/{district_id}', [WardController::class, 'districts_wards']);

    //roles endpoints
    Route::get("/roles", [RoleController::class, "index"]);

    //certificates

    // booking endpoints

    // report endpoints
    Route::post('reports',[ReportController::class,'reportData']);

    //send msg endpoint
    Route::get('/get_messages',[ChatMessageController::class,'getMessages']);
    Route::post('send_message',[ChatMessageController::class,'store']);
});
//Roles
Route::post('/new_role', [RoleController::class, 'store']);
Route::delete('delete_role/{id}', [RoleController::class, 'destroy']);

Route::post("/certificates", [CertificatesController::class,"store"]);
Route::get("/certificates/{id}", [CertificatesController::class,"show"]);
Route::get("/get_certificate_status/{id}", [CertificatesController::class,"get_certificate_status"]);

Route::post('add_booking', [BookingController::class, 'store']);
Route::get('hospital_bookings/{id}', [BookingController::class,'show']);
Route::get("indexBooking/{card_no}", [BookingController::class,'indexBooking']);
Route::put('/update_booking/{id}', [BookingController::class, 'update']);

//parent bookings
Route::get('parent_bookings/{id}', [BookingController::class,'parent_bookings']);
Route::get('delete_booking/{id}', [BookingController::class, 'destroy']);

//Password recovery
Route::get('password-recovery/{contacts}', [UserController::class, 'passwordRecovery']);
Route::get('resend-code/{contacts}', [UserController::class, 'resendCode']);
Route::post('recovery_questions',[UserController::class,'recoveryQuestion']);
Route::put('password_update',[UserController::class,'updatePassword']);

//password recovery regions, it is here cause of that
Route::get('/regions', [RegionController::class, 'showAll']);
Route::get('region_districts/{region_id}', [DistrictController::class, 'region_districts']);



// regions endpoints
Route::post('region', [RegionController::class, 'create']);
Route::get('region/{id}', [RegionController::class, 'show']);
Route::put('region/{id}', [RegionController::class, 'update']);
Route::delete('region/{id}', [RegionController::class, 'destroy']);

// district endpoints
Route::get('district_facilities/{id}', [DistrictController::class, 'show_facilities']);
Route::get('district_wards/{id}', [DistrictController::class, 'show_wards']);
Route::get('districts', [DistrictController::class, 'showAll']);
Route::post('district', [DistrictController::class, 'create']);
Route::get('district/{id}', [DistrictController::class, 'show']);
Route::put('district/{id}', [DistrictController::class, 'update']);
Route::delete('district/{id}', [DistrictController::class, 'destroy']);


// wards endpoints
Route::get('wards', [WardController::class, 'showAll']);
Route::post('ward', [WardController::class, 'create']);
Route::get('ward/{id}', [WardController::class, 'show']);
Route::put('ward/{id}', [WardController::class, 'update']);
Route::delete('ward/{id}', [WardController::class, 'destroy']);

// facility endpoints
Route::get('facilities', [FacilityController::class, 'showAll']);
Route::post('facility', [FacilityController::class, 'create']);
Route::get('facility/{id}', [FacilityController::class, 'show']);
Route::get('get_facility/{id}', [FacilityController::class, 'get_facility']);
Route::put('facility/{id}', [FacilityController::class, 'update']);
Route::delete('facility/{id}', [FacilityController::class, 'destroy']);

// children



// send sms
Route::post('send_sms', [SMSController::class, 'sendSms']);
Route::post('sms', [SMSController::class, 'sms_oasis']);




Route::post('/login', [AuthController::class, 'login']);
Route::post('/comm_health_worker_login', [AuthController::class, 'comm_health_worker_login']);
Route::post('/parent_login', [AuthController::class, 'parent_login']);


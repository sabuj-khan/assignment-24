<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventCategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use App\Models\User;
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

Route::get('/', function () {
    return view('welcome');
});

// Page Routes
Route::get('/loginPage', [PageController::class, 'userLoginPage']);
Route::get('/userRegistration', [PageController::class, 'userRegistrationPage']);
Route::get('/sendOtp', [PageController::class, 'sendOtpToEmail']);
Route::get('/verifyOtp', [PageController::class, 'otpVerificationforpass']);
Route::get('/resetPassword', [PageController::class, 'resetUseerPassword'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/userProfile', [PageController::class, 'userProfilePage'])->middleware([TokenVerificationMiddleware::class]);

// Event Category Page Route
Route::get('/eventCategory', [PageController::class, 'eventCategoryPage'])->middleware([TokenVerificationMiddleware::class]);

// Events Page Route
Route::get('/eventPage', [PageController::class, 'eventPageShow'])->middleware([TokenVerificationMiddleware::class]);

// Task Page Route
Route::get('/taskPage', [PageController::class, 'taskPageShow'])->middleware([TokenVerificationMiddleware::class]);



// User Logout
Route::get('/logout', [PageController::class, 'userLogout']);


// Ajux Api Route

Route::post('/user-register', [UserController::class, 'userRegistration']);
Route::post('/user-login', [UserController::class, 'userLoggingIn']);
Route::post('/send-otp', [UserController::class, 'sendOTPCode']);
Route::post('/otp-verify', [UserController::class, 'OTPVerification']);

Route::post('/password-reset', [UserController::class, 'resetPassword'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/user-profile-info', [UserController::class, 'userProfileInfo'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/update_user', [UserController::class, 'updateUserProfile'])->middleware([TokenVerificationMiddleware::class]);


// Event Category Ajux API
Route::get('/event-Category-list', [EventCategoryController::class, 'eventCategoryList'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/event-category-create', [EventCategoryController::class, 'eventCategoryCreating'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/event-category-update', [EventCategoryController::class, 'eventCategoryUpdate'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/event-category-delete', [EventCategoryController::class, 'eventCategoryDelete'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/event-category-by-Id', [EventCategoryController::class, 'eventCategoryById'])->middleware([TokenVerificationMiddleware::class]);

// Event Ajux API Route
Route::get('/event-list', [EventController::class, 'eventListShow'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/event-create', [EventController::class, 'eventCreation'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/event-update', [EventController::class, 'eventUpdating'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/event-delete', [EventController::class, 'eventDeleting'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/event-by-id', [EventController::class, 'eventById'])->middleware([TokenVerificationMiddleware::class]);

// Task Ajux API
Route::get('/task-list', [TaskController::class, 'allTaskList'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/task-create', [TaskController::class, 'taskCreation'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/task-update', [TaskController::class, 'taskUpdating'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/task-delete', [TaskController::class, 'taskDeleting'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/task-by-id', [TaskController::class, 'taskById'])->middleware([TokenVerificationMiddleware::class]);


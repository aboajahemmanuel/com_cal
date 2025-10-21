<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CalendarEventController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IssuerController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\PasswordChnageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [WelcomeController::class, 'index']);

Route::post('fetch-category', [PublicController::class, 'fetchCategory']);
Route::post('fetch-color', [PublicController::class, 'fetchColor']);
Route::post('/log-calendar-save', [CalendarEventController::class, 'logSaveToCalendar'])->name('log-calendar-save');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', UserController::class);
    Route::post('deleteUser/{id}', [UserController::class, 'destroy'])->name('deleteUser');
    Route::post('/status-user/{id}', [UserController::class, 'statususer'])->name('statusUser');
    Route::post('/userStatus/{id}', [UserController::class, 'userStatus'])->name('userStatus');

    Route::resource('roles', RoleController::class);
    Route::post('deleteRole/{id}', [RoleController::class, 'destroy'])->name('deleteRole');
    Route::resource('permissions', PermissionController::class);
    Route::post('deletePermissions/{id}', [PermissionController::class, 'destroy'])->name('deletePermissions');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class);
    Route::post('deleteCategory/{id}', [CategoryController::class, 'destroy'])->name('deleteCategory');
    Route::post('/status-category/{id}', [CategoryController::class, 'statuscategory'])->name('statusCategory');

    Route::post('catupdate/{id}', [CategoryController::class, 'update'])->name('catUpdate');
    Route::post('/catstatus/{id}', [CategoryController::class, 'catstatus'])->name('CatStatus');

    Route::get('groups', [GroupController::class, 'index']);
    Route::post('groups/store', [GroupController::class, 'store'])->name('groupStore');
    Route::post('updateGroup/{id}', [GroupController::class, 'edit'])->name('updateGroup');
    Route::post('deleteGroup/{id}', [GroupController::class, 'delete'])->name('deleteGroup');

    Route::get('/events', [EventController::class, 'allevents'])->name('events');
    Route::get('/pending-events', [EventController::class, 'pendingEvents'])->name('pendingEvents');

    Route::post('/add-event', [EventController::class, 'addevent'])->name('addEvent');
    Route::post('/edit-event/{id}', [EventController::class, 'editevent'])->name('editEvent');
    Route::post('/delete-event/{id}', [EventController::class, 'deleteEvent'])->name('deleteEvent');
    Route::post('/status-event/{id}', [EventController::class, 'statusevent'])->name('statusEvent');
    Route::post('/eventStatus/{id}', [EventController::class, 'eventstatus'])->name('EventStatus');

    Route::get('/pending-request/{id}', [EventController::class, 'pending_request'])->name('pending_request');

    Route::get('/issuers', [IssuerController::class, 'index'])->name('issuers');
    Route::post('/add-issuer', [IssuerController::class, 'store'])->name('addIssuer');
    Route::post('/edit-issuer/{id}', [IssuerController::class, 'update'])->name('editIssuer');
    Route::post('/delete-issuer/{id}', [IssuerController::class, 'destroy'])->name('deleteIssuer');
    Route::post('import-security', [IssuerController::class, 'importExcel'])->name('importExcel');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile-update', [ProfileController::class, 'updateprofile'])->name('Updateprofile');

    Route::get('/logActivity', [LogActivityController::class, 'logActivity']);
});

Route::get('/password/change', [PasswordChnageController::class, 'showChangePasswordForm'])->name('password_change');
Route::post('/password/change', [PasswordChnageController::class, 'changePassword'])->name('password_update');

//Route::match(['get','post'],'/search', 'SearchController@search');
// ADMIN AUTH ROUTES
Route::post('/adminlogin', [AuthController::class, 'adminlogin'])->name('Adminlogin');
Route::post('/fogertpassword', [AuthController::class, 'adminforgetpassword'])->name('Adminforgetpassword');
Route::get('/reset-password/{token}', [AuthController::class, 'adminresetpassword']);
Route::post('reset-password', [AuthController::class, 'adminresetpasswordsubmit'])->name('Adminresetpasswordsubmit');

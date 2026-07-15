<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegistrationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Api\RoleController as ApiRoleController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\Api\MajorController as ApiMajorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\UserController as ApiUserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Api\StudentController as ApiStudentController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\Api\EnrollmentController as ApiEnrollmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { return view('landing-page.index'); });
Route::get('/sign-in', function () { return view('registration.sign-in'); })->name('registration.sign-in');
Route::get('/sign-up', function () { return view('registration.sign-up'); })->name('registration.sign-up');

Route::post('/sign-in/auth', [RegistrationController::class, 'sign_in'])->name('sign-in');
Route::post('/sign-up/auth', [RegistrationController::class, 'sign_up'])->name('sign-up');
Route::get('/sign-out', [RegistrationController::class, 'sign_out'])->name('sign-out');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:3')->group(function () {
        /* Role Management*/
        Route::get('/role/index', [RoleController::class, 'index'])->name('role.index');
        Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
        Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::get('/role/detail/{id}', [RoleController::class, 'detail'])->name('role.detail');
        
        /* Major Management*/
        Route::get('/major/index', [MajorController::class, 'index'])->name('major.index');
        Route::get('/major/create', [MajorController::class, 'create'])->name('major.create');
        Route::get('/major/edit/{id}', [MajorController::class, 'edit'])->name('major.edit');
        Route::get('/major/detail/{id}', [MajorController::class, 'detail'])->name('major.detail');

        /* User Management*/
        Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
        Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::get('/user/detail/{id}', [UserController::class, 'detail'])->name('user.detail');

        /* Enrollment Management*/
        Route::get('/enrollment/index', [EnrollmentController::class, 'index'])->name('enrollment.index');

        /* Student Management*/
        Route::get('/student/index', [StudentController::class, 'index'])->name('student.index');
        Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
        Route::get('/student/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
        Route::get('/student/detail/{id}', [StudentController::class, 'detail'])->name('student.detail');
        
        /* Student Management*/
        Route::get('/enrollment/index', [EnrollmentController::class, 'index'])->name('enrollment.index');
        Route::get('/enrollment/create', [EnrollmentController::class, 'create'])->name('enrollment.create');
        Route::get('/enrollment/edit/{id}', [EnrollmentController::class, 'edit'])->name('enrollment.edit');
        Route::get('/enrollment/detail/{id}', [EnrollmentController::class, 'detail'])->name('enrollment.detail');

        Route::prefix('api')->group(function () {
            Route::get('/role/all', [ApiRoleController::class, 'getAll'])->name('api.role.all');
            Route::post('/role/store', [ApiRoleController::class, 'store'])->name('api.role.store');
            Route::post('/role/update/{id}', [ApiRoleController::class, 'update'])->name('api.role.update');
            Route::get('/role/find/{id}', [ApiRoleController::class, 'find'])->name('api.role.find');
            Route::get('/role/destroy/{id}', [ApiRoleController::class, 'destroy'])->name('api.role.destroy');
            
            Route::get('/major/all', [ApiMajorController::class, 'getAll'])->name('api.major.all');
            Route::post('/major/store', [ApiMajorController::class, 'store'])->name('api.major.store');
            Route::post('/major/update/{id}', [ApiMajorController::class, 'update'])->name('api.major.update');
            Route::get('/major/find/{id}', [ApiMajorController::class, 'find'])->name('api.major.find');
            Route::get('/major/destroy/{id}', [ApiMajorController::class, 'destroy'])->name('api.major.destroy');

            Route::get('/user/all', [ApiUserController::class, 'getAll'])->name('api.user.all');
            Route::post('/user/store', [ApiUserController::class, 'store'])->name('api.user.store');
            Route::post('/user/update/{id}', [ApiUserController::class, 'update'])->name('api.user.update');
            Route::get('/user/find/{id}', [ApiUserController::class, 'find'])->name('api.user.find');
            Route::get('/user/destroy/{id}', [ApiUserController::class, 'destroy'])->name('api.user.destroy');
            
            Route::get('/student/all', [ApiStudentController::class, 'getAll'])->name('api.student.all');
            Route::post('/student/store', [ApiStudentController::class, 'store'])->name('api.student.store');
            Route::post('/student/update/{id}', [ApiStudentController::class, 'update'])->name('api.student.update');
            Route::get('/student/find/{id}', [ApiStudentController::class, 'find'])->name('api.student.find');
            Route::get('/student/destroy/{id}', [ApiStudentController::class, 'destroy'])->name('api.student.destroy');
            Route::post('/student/export', [ApiStudentController::class, 'export'])->name('api.student.export');
            Route::post('/student/import', [ApiStudentController::class, 'import'])->name('api.student.import');
            
            Route::get('/enrollment/all', [ApiEnrollmentController::class, 'getAll'])->name('api.enrollment.all');
            Route::post('/enrollment/store', [ApiEnrollmentController::class, 'store'])->name('api.enrollment.store');
            Route::post('/enrollment/update/{id}', [ApiEnrollmentController::class, 'update'])->name('api.enrollment.update');
            Route::get('/enrollment/find/{id}', [ApiEnrollmentController::class, 'find'])->name('api.enrollment.find');
            Route::get('/enrollment/destroy/{id}', [ApiEnrollmentController::class, 'destroy'])->name('api.enrollment.destroy');
            Route::get('/enrollment/history/{id}', [ApiEnrollmentController::class, 'history'])->name('api.enrollment.history');
        });
    });
});

Route::get('error/403', function () { return view('error.403'); })->name('error.403');
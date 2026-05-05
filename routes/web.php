<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Models\Student;
use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use App\Http\Controllers\StudentController;



/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/login', [WebAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [WebAuthController::class, 'login']);

Route::get('/register', function () {
    return view('auth.register');
});

Route::post('/register', [WebAuthController::class, 'register']);

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | HOME + LOGOUT
    |--------------------------------------------------------------------------
    */
    Route::get('/home', function () {
        return view('home');
    });

    Route::post('/logout', [WebAuthController::class, 'logout']);

    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')
        ->middleware('role:super-admin')
        ->group(function () {

            Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

            Route::get('/logs', function () {
                $logs = AuditLog::with('user')
                    ->latest()
                    ->paginate(20);

                return view('admin.logs', compact('logs'));
            })->name('admin.logs');

            Route::get('/logs/{id}', function ($id) {
                $log = AuditLog::with('user')->findOrFail($id);
                return view('admin.log_show', compact('log'));
            })->name('admin.logs.show');

            Route::get('/users', [UserManagementController::class, 'index']);
            Route::post('/users/{user}/role', [UserManagementController::class, 'assignRole']);

            Route::get('/students', [StudentController::class, 'index'])
                ->name('admin.students');
        });

    /*
    |--------------------------------------------------------------------------
    | DEPARTMENT ROUTES
    |--------------------------------------------------------------------------
    */
    Route::prefix('department')
        ->middleware('role:department')
        ->group(function () {

            Route::get('/home', function () {
                return view('department.home');
            });
        });

    /*
    |--------------------------------------------------------------------------
    | EXAM CONTROLLER ROUTES
    |--------------------------------------------------------------------------
    */
    Route::prefix('exam')
        ->middleware('role:exam-controller')
        ->group(function () {

            Route::get('/home', function () {
                return view('exam.home');
            });

            Route::get('/student/search', [StudentController::class, 'searchPage']);
            Route::get('/student/search-result', [StudentController::class, 'search']);

            Route::get('/student/show/{id}', [StudentController::class, 'show']);

            Route::get('/student/edit/{id}', [StudentController::class, 'edit']);
            Route::post('/student/update/{id}', [StudentController::class, 'update']);
        });

});






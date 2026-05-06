<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Models\Student;
use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DepartmentController;




    Route::get('/', function () {
        return redirect('/login');
    });

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/login', [WebAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [WebAuthController::class, 'login']);

Route::get('/register', [WebAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [WebAuthController::class, 'register']);

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {


    //pdf route
    Route::get('/students/pdf', [StudentController::class, 'exportPdf']);

    

    /*
    |--------------------------------------------------------------------------
    | HOME + LOGOUT
    |--------------------------------------------------------------------------
    */
    Route::get('/home', function () {
        $user = auth()->user();
        
        if ($user->hasRole('super-admin')) {
            return redirect('/admin/dashboard');
        } elseif ($user->hasRole('dept')) {
            return redirect('/dept/home');
        } elseif ($user->hasRole('exam-controller')) {
            return redirect('/exam/home');
        }
        
        return view('home');
    })->name('home');

    Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')
        ->middleware('role:super-admin')
        ->group(function () {

            Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

            Route::get('/logs', function () {
                $logs = AuditLog::with('user')->latest()->paginate(20);
                return view('admin.logs', compact('logs'));
            })->name('admin.logs');

            Route::get('/logs/{id}', function ($id) {
                $log = AuditLog::with('user')->findOrFail($id);
                return view('admin.log_show', compact('log'));
            })->name('admin.logs.show');

            Route::get('/users', [UserManagementController::class, 'index'])->name('admin.users');
            Route::post('/users/{user}/role', [UserManagementController::class, 'assignRole'])->name('admin.users.role');

            Route::get('/students', [StudentController::class, 'index'])->name('admin.students');
        });

    /*
    |--------------------------------------------------------------------------
    | DEPARTMENT ROUTES
    |--------------------------------------------------------------------------
    */
    Route::prefix('dept')
    ->middleware('role:dept')
    ->group(function () {

        // Dashboard
        Route::get('/home', [DepartmentController::class, 'dashboard'])
            ->name('dept.home');

        // Student Search Page
        Route::get('/students', [DepartmentController::class, 'index'])
            ->name('dept.students');

        // Search
        Route::get('/students/search', [DepartmentController::class, 'search'])
            ->name('dept.students.search');

        Route::get('/students/advanced-search', [DepartmentController::class, 'advancedSearch'])
            ->name('dept.students.advanced');

        Route::get('/students/bulk-search', [DepartmentController::class, 'bulkSearch'])
            ->name('dept.students.bulk');

        Route::get('/students/statistics', [DepartmentController::class, 'statistics'])
            ->name('dept.students.statistics');

        Route::get('/students/export', [DepartmentController::class, 'export'])
            ->name('dept.students.export');

        Route::get('/students/suggestions', [DepartmentController::class, 'suggestions'])
            ->name('dept.students.suggestions');

        Route::get('/students/{id}', [DepartmentController::class, 'show'])
            ->where('id', '[0-9]+')
            ->name('dept.students.show');
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
            })->name('exam.home');

            /*
            | FIXED: removed {id} to use student_id query
            | /exam/student/show?student_id=101
            */
            Route::get('/student/search', [StudentController::class, 'searchPage'])
                ->name('exam.student.search');

            Route::get('/student/show', [StudentController::class, 'show'])
                ->name('exam.student.show');

            Route::get('/student/search-result', [StudentController::class, 'search'])
                ->name('exam.student.result');

            Route::get('/student/edit/{id}', [StudentController::class, 'edit'])
                ->name('exam.student.edit');

            Route::post('/student/update/{id}', [StudentController::class, 'update'])
                ->name('exam.student.update');
        });

});


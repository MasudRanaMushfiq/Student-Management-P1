<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Models\Student;
use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Http\Request;




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
    |-------------------------
    | HOME
    |-------------------------
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

        Route::get('/logs', function () {

            $logs = \App\Models\AuditLog::with('user')
                ->latest()
                ->paginate(20);

            return view('admin.logs', compact('logs'));
        })->name('admin.logs');


        Route::get('/logs/{id}', function ($id) {

            $log = \App\Models\AuditLog::with('user')->findOrFail($id);

            return view('admin.log_show', compact('log'));
        })->name('admin.logs.show');

            Route::get('/dashboard', function () {

                $users = User::with('roles')->get();
                $students = Student::paginate(10);

                $logs = \App\Models\AuditLog::with('user')
                    ->latest()
                    ->take(10)
                    ->get();

                return view('admin.dashboard', compact('users', 'students', 'logs'));
            });

            Route::get('/users', [UserManagementController::class, 'index']);

            Route::post('/users/{user}/role', [UserManagementController::class, 'assignRole']);

            Route::get('/students', function () {
                $students = Student::paginate(10);
                return view('admin.students', compact('students'));

            });

            
        });

    /*
    |--------------------------------------------------------------------------
    | DEPT ROUTES
    |--------------------------------------------------------------------------
    */
    Route::prefix('dept')
        ->middleware('role:dept')
        ->group(function () {

            Route::get('/home', function () {
                return view('dept.home');
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

            // SEARCH
            Route::get('/student/search', function () {
                return view('exam.search');
            });

            // SHOW STUDENT
            Route::get('/student/show', function (Request $request) {

                $student = Student::where('student_id', $request->student_id)->first();

                if (!$student) {
                    return redirect()->back()->with('error', 'Student not found');
                }

                return view('exam.show', compact('student'));
            });

            // EDIT STUDENT
            Route::get('/student/edit/{id}', function ($id) {

                $student = Student::findOrFail($id);

                return view('exam.edit', compact('student'));
            });

            // UPDATE STUDENT
            Route::post('/student/update/{id}', function (Request $request, $id) {

                $request->validate([
                    'fullname' => 'required|string|max:255'
                ]);

                $student = Student::findOrFail($id);

                $student->update([
                    'fullname' => $request->fullname
                ]);

                return redirect('/exam/student/show?student_id=' . $student->student_id)
                    ->with('success', 'Student updated successfully');
            });

            /*
            |--------------------------------------------------------------------------
            | AUDIT LOG ROUTES
            |--------------------------------------------------------------------------
            */


        });
});




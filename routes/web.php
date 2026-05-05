<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Models\Student;
use App\Models\User;


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
    | NORMAL USER HOME
    |-------------------------
    */
    Route::get('/home', function () {
        return view('home');
    });

    Route::post('/logout', [WebAuthController::class, 'logout']);

    /*
    |--------------------------------------------------------------------------
    | SUPER ADMIN ROUTES
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')
->middleware('role:super-admin')
->group(function () {

    // Dashboard (users + students overview)
    Route::get('/dashboard', function () {
        $users = User::with('roles')->get();
        $students = Student::paginate(100);

        return view('admin.dashboard', compact('users', 'students'));
    });

    // User management page
    Route::get('/users', [UserManagementController::class, 'index']);

    Route::post('/users/{user}/role', [UserManagementController::class, 'assignRole']);

    // Separate students page (optional)
    Route::get('/students', function () {
        $students = Student::paginate(100);
        return view('admin.students', compact('students'));
        });
    });


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

        // STEP 1: search page
        Route::get('/student/search', function () {
            return view('exam.search');
        });

        // STEP 2: show student
        Route::get('/student/show', function (Illuminate\Http\Request $request) {

            $student = \App\Models\Student::where('student_id', $request->student_id)->first();

            if (!$student) {
                return redirect()->back()->with('error', 'Student not found');
            }

            return view('exam.show', compact('student'));
        });

        // STEP 3: edit page
        Route::get('/student/edit/{id}', function ($id) {

            $student = \App\Models\Student::findOrFail($id);

            return view('exam.edit', compact('student'));
        });

        // STEP 4: update name
        Route::post('/student/update/{id}', function (Illuminate\Http\Request $request, $id) {

            $request->validate([
       'fullname' => 'required|string|max:255'
        ]);

        $student = \App\Models\Student::findOrFail($id);
        $student->fullname = $request->fullname;
        $student->save();

        // redirect back to show page
    return redirect('/exam/student/show?student_id=' . $student->student_id)
        ->with('success', 'Student updated successfully');
                });

    });
});


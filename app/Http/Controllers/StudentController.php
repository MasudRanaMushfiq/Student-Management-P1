<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;



class StudentController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | ADMIN DASHBOARD
    |--------------------------------------------------------------------------
    */
    public function dashboard(Request $request)
    {
        $users = User::with('roles')->get();

        $logs = AuditLog::with('user')
            ->latest()
            ->take(10)
            ->get();

        $tableMap = [
            'student13' => 'Session 2013-14',
            'student14' => 'Session 2014-15',
            'student15' => 'Session 2015-16',
            'student16' => 'Session 2016-17',
            'student17' => 'Session 2017-18',
        ];

        $allowedTables = array_keys($tableMap);

        $table = $request->get('table', 'student13');

        if (!in_array($table, $allowedTables)) {
            $table = 'student13';
        }

        $department = $request->get('department', null);

        $query = DB::table($table);

        if (!empty($department)) {
            $query->where('department', $department);
        }

        $students = $query->paginate(10);

        return view('admin.dashboard', compact(
            'users',
            'logs',
            'students',
            'table',
            'tableMap',
            'allowedTables',
            'department'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN STUDENTS LIST
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $tableMap = [
            'student13' => 'Session 2013-14',
            'student14' => 'Session 2014-15',
            'student15' => 'Session 2015-16',
            'student16' => 'Session 2016-17',
            'student17' => 'Session 2017-18',
        ];

        $allowedTables = array_keys($tableMap);

        $table = $request->get('table', 'student13');

        if (!in_array($table, $allowedTables)) {
            $table = 'student13';
        }

        $department = $request->get('department', null);

        $query = DB::table($table);

        if (!empty($department)) {
            $query->where('department', $department);
        }

        $students = $query->paginate(10);

        return view('admin.students', compact(
            'students',
            'table',
            'tableMap',
            'allowedTables',
            'department'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | EXAM: SEARCH PAGE
    |--------------------------------------------------------------------------
    */
    public function searchPage()
    {
        return view('exam.search');
    }

    /*
    |--------------------------------------------------------------------------
    | EXAM: SEARCH STUDENT
    |--------------------------------------------------------------------------
    */
    public function search(Request $request)
    {
        $request->validate([
            'student_id' => 'required'
        ]);

        $student = Student::where('student_id', $request->student_id)->first();

        if (!$student) {
            return back()->with('error', 'Student not found');
        }

        return view('exam.show', compact('student'));
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW STUDENT
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('exam.show', compact('student'));
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT STUDENT
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('exam.edit', compact('student'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE STUDENT
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fullname' => 'required|string|max:255'
        ]);

        $student = Student::findOrFail($id);

        $student->update([
            'fullname' => $request->fullname
        ]);

        return redirect()
            ->route('exam.student.search')
            ->with('success', 'Student updated successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE STUDENT
    |--------------------------------------------------------------------------
    */
    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Student created successfully',
            'data' => $student
        ]);
    }

    //pdf export
    public function exportPdf(Request $request)
    {
        $table = $request->get('table', 'student13');

        $students = DB::table($table)
            ->limit(200)   // CRITICAL FIX
            ->get();

        $pdf = Pdf::loadView('admin.students_pdf', compact('students', 'table'));

        return $pdf->download('admin_students_list.pdf');
    }

}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    // FIXED: your real table names
    private $sessionTables = [
        '13' => 'student13',
        '14' => 'student14',
        '15' => 'student15',
        '16' => 'student16',
        '17' => 'student17',
    ];

    // Show search page
    public function index()
    {
        $sessions = array_keys($this->sessionTables);

        return view('department.students.index', [
            'sessions' => $sessions,
            'students' => null
        ]);
    }

    // Handle search
    public function search(Request $request)
    {
        $dept = $request->get('dept');
        $hall = $request->get('hall');
        $start = $request->get('start_session');
        $end = $request->get('end_session');

        // Step 1: Select tables based on range
        $tables = [];

        if ($start && $end) {

            // FIX: force correct order
            $keys = ['13', '14', '15', '16', '17'];

            $startIndex = array_search($start, $keys);
            $endIndex = array_search($end, $keys);

            if ($startIndex !== false && $endIndex !== false) {

                for ($i = $startIndex; $i <= $endIndex; $i++) {
                    $tables[] = $this->sessionTables[$keys[$i]];
                }
            }

        } else {
            // If no range selected → use all tables
            $tables = array_values($this->sessionTables);
        }

        // Safety check
        if (empty($tables)) {
            return redirect()->back()->with('error', 'No valid session tables found');
        }

        // Step 2: Build UNION query
        $query = DB::table($tables[0]);

        for ($i = 1; $i < count($tables); $i++) {
            $query->unionAll(DB::table($tables[$i]));
        }

        // Step 3: Wrap UNION
        $finalQuery = DB::query()->fromSub($query, 'students');

        // Step 4: Apply filters

        if (!empty($dept)) {
            $finalQuery->where('department', $dept);
        }

        if (!empty($hall)) {
            $finalQuery->where('hall', $hall);
        }

        // Step 5: Pagination
        $students = $finalQuery->paginate(50)->appends($request->all());

        // Step 6: Return view
        return view('department.students.index', [
            'sessions' => array_keys($this->sessionTables),
            'students' => $students
        ]);
    }

    // DASHBOARD (REAL TIME STATS)
    public function dashboard()
    {
        $tables = [
            'student13',
            'student14',
            'student15',
            'student16',
            'student17'
        ];

        $totalStudents = 0;

        foreach ($tables as $table) {
            $totalStudents += DB::table($table)->count();
        }

        return view('department.home', [
            'stats' => [
                'total_students' => $totalStudents,
                'total_departments' => DB::table('student14')->distinct()->count('department'),
                'active_sessions' => count($tables)
            ]
        ]);
    }
}


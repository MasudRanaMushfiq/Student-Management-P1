<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AuditLog;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
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

        $students = \DB::table($table)->paginate(10);

        return view('admin.dashboard', compact(
            'users',
            'logs',
            'students',
            'table',
            'tableMap',
            'allowedTables'
        ));
    }
}

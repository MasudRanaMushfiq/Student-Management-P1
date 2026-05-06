<!DOCTYPE html>
<html>
<head>
    <title>All Students</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background: #f4f6f9;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 220px;
            height: 100%;
            background: #1f2937;
            color: white;
            padding-top: 20px;
        }

        .sidebar h2 {
            text-align: center;
            font-size: 18px;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #ddd;
            text-decoration: none;
            font-size: 14px;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background: #374151;
            color: white;
        }

        .main {
            margin-left: 220px;
        }

        .topbar {
            background: white;
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
        }

        .content {
            padding: 20px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        .header {
            margin-bottom: 15px;
        }

        .header h1 {
            font-size: 20px;
            margin: 0;
        }

        .meta {
            font-size: 13px;
            color: #555;
            margin-top: 5px;
        }

        .action-bar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 15px;
        }

        .btn-primary {
            padding: 8px 14px;
            font-size: 14px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .card {
            background: white;
            padding: 15px;
            border-radius: 6px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        th {
            background: #f9fafb;
        }

        .pagination {
            margin-top: 15px;
            display: flex;
            justify-content: center;
        }

        .pagination nav {
            font-size: 13px;
        }

        .pagination svg {
            width: 14px;
            height: 14px;
        }

        .pagination a,
        .pagination span {
            padding: 4px 8px;
            margin: 0 2px;
            border-radius: 4px;
            text-decoration: none;
            border: 1px solid #ddd;
            color: #333;
            font-size: 13px;
        }

        .pagination .active span {
            background: #2563eb;
            color: white;
            border-color: #2563eb;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>

<div class="sidebar">
    <h2>Super Admin</h2>

    <a href="/admin/dashboard">Dashboard</a>
    <a href="/admin/dashboard?section=students" class="active">Students</a>
    <a href="{{ route('admin.logs') }}">Audit Logs</a>

    <form method="POST" action="/logout" style="margin-top: 20px; padding: 0 20px;">
        @csrf
        <button class="btn-danger" style="width:100%;">Logout</button>
    </form>
</div>

<div class="main">

    <div class="topbar">
        <h1>All Students</h1>
        <div>Welcome, {{ auth()->user()->name }}</div>
    </div>

    <div class="content">

        <div class="container">

            <div class="header">
                <h1>All Students</h1>

                <p class="meta">
                    Current Session/Table:
                    <b>{{ strtoupper($table) }}</b>
                </p>

                <p class="meta">
                    Total Students: {{ $students->total() }}
                </p>
            </div>

            <!-- RIGHT-ALIGNED DOWNLOAD BUTTON -->
            <div class="action-bar">
                <a href="{{ url('students/pdf') }}" target="_blank" class="btn-primary">
                    Download PDF
                </a>
            </div>

            <div class="card">

                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Exam Roll</th>
                            <th>Student ID</th>
                            <th>Full Name</th>
                            <th>Department</th>
                            <th>Hall</th>
                            <th>Mobile</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->exam_roll }}</td>
                                <td>{{ $student->student_id }}</td>
                                <td>{{ $student->fullname }}</td>
                                <td>{{ $student->department }}</td>
                                <td>{{ $student->hall }}</td>
                                <td>{{ $student->mobile_no }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

            <div class="pagination">
                {{ $students->appends(['table' => $table])->links() }}
            </div>

        </div>

    </div>

</div>

</body>
</html>


<!DOCTYPE html>
<html>
<head>
    <title>Super Admin Dashboard</title>

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

        /* SIDEBAR */
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

        .sidebar a:hover {
            background: #374151;
            color: white;
        }

        /* MAIN AREA */
        .main {
            margin-left: 220px;
        }

        /* TOP BAR */
        .topbar {
            background: white;
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar h1 {
            font-size: 18px;
            margin: 0;
        }

        .content {
            padding: 20px;
        }

        /* CARD */
        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        h2 {
            margin-top: 0;
            font-size: 16px;
        }

        /* TABLE */
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

        select {
            padding: 6px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .btn {
            padding: 6px 10px;
            border: none;
            background: #2563eb;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 13px;
        }

        .btn:hover {
            background: #1d4ed8;
        }

        .btn-danger {
            background: #dc2626;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Super Admin</h2>

    <a href="#">Dashboard</a>
    <a href="#">Users</a>
    <a href="#">Students</a>

    <!-- ✅ AUDIT LOGS (PROPER LARAVEL ROUTE) -->
    <a href="{{ route('admin.logs') }}">Audit Logs</a>

    <a href="#">Settings</a>

    <form method="POST" action="/logout" style="margin-top: 20px; padding: 0 20px;">
        @csrf
        <button class="btn btn-danger" style="width:100%;">Logout</button>
    </form>
</div>

<!-- MAIN -->
<div class="main">

    <!-- TOP BAR -->
    <div class="topbar">
        <h1>Dashboard</h1>
        <div>Welcome, {{ auth()->user()->name }}</div>
    </div>

    <div class="content">

        <!-- USERS -->
        <div class="card">
            <h2>All Users</h2>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Assign</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>

                            <td>
                                {{ $user->getRoleNames()->first() ?? 'No Role' }}
                            </td>

                            <td>
                                <form method="POST" action="/admin/users/{{ $user->id }}/role">
                                    @csrf

                                    <select name="role">
                                        <option value="dept" {{ $user->hasRole('dept') ? 'selected' : '' }}>
                                            Dept
                                        </option>

                                        <option value="exam-controller" {{ $user->hasRole('exam-controller') ? 'selected' : '' }}>
                                            Exam Controller
                                        </option>

                                        <option value="super-admin" {{ $user->hasRole('super-admin') ? 'selected' : '' }}>
                                            Super Admin
                                        </option>
                                    </select>

                                    <button type="submit" class="btn">Assign</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- STUDENTS -->
        <div class="card">
            <h2>Students</h2>

            <a href="/admin/students">
                <button class="btn">View All Students</button>
            </a>
        </div>

        <!-- RECENT LOGS PREVIEW (OPTIONAL BUT USEFUL) -->
        <div class="card">
            <h2>Recent Activity</h2>

            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Action</th>
                        <th>Model</th>
                        <th>Time</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td>{{ $log->user->name ?? 'System' }}</td>
                            <td>{{ $log->action }}</td>
                            <td>{{ class_basename($log->model_type) }}</td>
                            <td>{{ $log->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>

</div>

</body>
</html>


<!DOCTYPE html>
<html>
<head>
    <title>Audit Logs</title>

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

        .sidebar a.active,
        .sidebar a:hover {
            background: #374151;
            color: white;
        }

        /* MAIN */
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

        /* ORIGINAL STYLES */
        .container {
            max-width: 1000px;
            margin: auto;
        }

        h2 {
            margin-bottom: 15px;
            font-size: 20px;
            color: #ffffff;
        }

        .card {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        th {
            background: #f9fafb;
            font-weight: bold;
            color: #1a202a;
        }

        tr:hover {
            background: #f3f4f6;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            color: white;
        }

        .create { background: #16a34a; }
        .update { background: #2563eb; }
        .delete { background: #dc2626; }

        .pagination {
            margin-top: 15px;
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
    <a href="/admin/dashboard?section=students">Students</a>
    <a href="{{ route('admin.logs') }}" class="active">Audit Logs</a>

    <form method="POST" action="/logout" style="margin-top: 20px; padding: 0 20px;">
        @csrf
        <button class="btn-danger" style="width:100%;">Logout</button>
    </form>
</div>

<div class="main">

    <div class="topbar">
        <h1>Audit Logs</h1>
        <div>Welcome, {{ auth()->user()->name }}</div>
    </div>

    <div class="content">

        <!-- ORIGINAL CONTENT START -->
        <div class="container">

            <h2 style="color: black">Audit Logs</h2>

            <div class="card">

                <table>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Action</th>
                            <th>Model</th>
                            <th>Time</th>
                            <th>Details</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td>
                                    {{ $log->user->name ?? 'System' }}
                                </td>

                                <td>
                                    <span class="badge {{ $log->action }}">
                                        {{ strtoupper($log->action) }}
                                    </span>
                                </td>

                                <td>
                                    {{ class_basename($log->model_type) }}
                                </td>

                                <td>
                                    {{ $log->created_at->diffForHumans() }}
                                </td>

                                <td>
                                    <a href="{{ route('admin.logs.show', $log->id) }}">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination">
                    {{ $logs->links() }}
                </div>

            </div>

        </div>
        <!-- ORIGINAL CONTENT END -->

    </div>

</div>

</body>
</html>


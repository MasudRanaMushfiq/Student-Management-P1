<!DOCTYPE html>
<html>
<head>
    <title>Department Dashboard</title>

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
            color: #d1d5db;
            text-decoration: none;
            font-size: 14px;
        }

        .sidebar a:hover {
            background: #1f2937;
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
            align-items: center;
        }

        .logout-btn {
            background: #ff0101;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: rgba(220, 52, 52, 0.533);
        }

        .content {
            padding: 20px;
        }

        /* COMPACT STATS */
        .stats {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin: 15px 0;
        }

        .stat {
            background: white;
            padding: 10px 15px;
            border-radius: 6px;
            flex: 1;
            min-width: 150px;
            border: 1px solid #e5e7eb;
        }

        .stat h3 {
            margin: 0;
            font-size: 18px;
            color: #111827;
        }

        .stat span {
            font-size: 12px;
            color: #6b7280;
        }

        /* BUTTONS */
        .actions {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Department</h2>

    <a href="#">Dashboard</a>
    <a href="{{ route('dept.students') }}">Students</a>
</div>

<div class="main">

    <!-- TOPBAR -->
    <div class="topbar">
        <h3 style="margin:0;">Department Dashboard</h3>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <div class="content">

        <h3 style="margin-bottom:5px;">Welcome</h3>
        <p style="color:#6b7280; font-size:13px; margin-top:0;">
            Department Panel Overview
        </p>

        <!-- COMPACT STATS -->
        <div class="stats">

            <div class="stat">
                <h3>{{ $stats['total_students'] ?? 0 }}</h3>
                <span>Total Students</span>
            </div>

            <div class="stat">
                <h3>{{ $stats['total_departments'] ?? 0 }}</h3>
                <span>Departments</span>
            </div>

            <div class="stat">
                <h3>{{ $stats['active_sessions'] ?? 0 }}</h3>
                <span>Sessions</span>
            </div>

        </div>

        <!-- ACTIONS -->
        <div class="actions">
            <a href="{{ route('dept.students') }}" class="btn btn-primary">
                Go to Student Search
            </a>
        </div>

    </div>

</div>

</body>
</html>

